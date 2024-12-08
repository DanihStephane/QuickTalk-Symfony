<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class ChatController extends AbstractController
{
    #[Route('/chat', name: 'app_chat')]
    public function index(MessageRepository $messageRepository): Response
    {
        return $this->render('chat/index.html.twig', [
            'messages' => $messageRepository->findBy([], ['createdAt' => 'ASC'])
        ]);
    }

    #[Route('/chat/send', name: 'app_chat_send', methods: ['POST'])]
    public function send(
        Request $request,
        EntityManagerInterface $entityManager,
        HubInterface $hub
    ): Response {
        $content = $request->request->get('content');
        
        $message = new Message();
        $message->setSender($this->getUser());
        $message->setContent($content);
        
        $entityManager->persist($message);
        $entityManager->flush();

        $update = new Update(
            'chat',
            json_encode([
                'id' => $message->getId(),
                'content' => $message->getContent(),
                'sender' => $message->getSender()->getUsername(),
                'createdAt' => $message->getCreatedAt()->format('Y-m-d H:i:s')
            ])
        );

        $hub->publish($update);

        return $this->json(['status' => 'sent']);
    }
}