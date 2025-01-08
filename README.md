# Application de Chat en Temps Réel avec Symfony 7

Cette application est un système de chat en temps réel construit avec Symfony 7, utilisant Mercure pour la communication en temps réel et Doctrine pour la persistance des données.

## 🚀 Fonctionnalités

- Authentication utilisateur
- Messages en temps réel
- Historique des messages
- Interface responsive
- Notifications en temps réel
- Persistance des messages

## 📋 Prérequis

- PHP 8.2 ou supérieur
- Composer
- MySQL/MariaDB
- Node.js (pour Mercure)
- Symfony CLI

## 🛠 Installation

1. Cloner le projet
```bash
git clone [url-du-projet]
cd [nom-du-projet]
```

2. Installer les dépendances
```bash
composer install
```

3. Configurer les variables d'environnement
```bash
cp .env .env.local
```
Modifier les variables suivantes dans `.env.local`:
- `DATABASE_URL`
- `MERCURE_JWT_SECRET`
- `APP_SECRET`

4. Créer la base de données
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Installer et démarrer Mercure
```bash
# Installation avec Symfony Flex
composer require symfony/mercure-bundle

# Démarrer le hub Mercure (dans un terminal séparé)
symfony run mercure
```

## 🚦 Démarrage

1. Lancer le serveur Symfony
```bash
symfony server:start
```

2. Accéder à l'application
```
https://localhost:8000
```

## 👥 Création d'utilisateurs

### Via la console

1. Générer un hash de mot de passe
```bash
php bin/console security:hash-password
```

2. Utiliser le hash généré pour créer un utilisateur dans la base de données
```sql
INSERT INTO user (email, roles, password, username) 
VALUES ('user@example.com', '["ROLE_USER"]', 'le_hash_généré', 'username');
```

## 🏗 Structure du projet

```
.
├── config/
│   ├── packages/
│   │   └── mercure.yaml     # Configuration Mercure
├── src/
│   ├── Controller/
│   │   └── ChatController.php
│   ├── Entity/
│   │   ├── Message.php
│   │   └── User.php
│   └── Repository/
│       ├── MessageRepository.php
│       └── UserRepository.php
└── templates/
    └── chat/
        └── index.html.twig
```

## 🔒 Sécurité

- Tous les messages sont liés à des utilisateurs authentifiés
- Les connexions Mercure sont sécurisées par JWT
- Protection CSRF activée
- Validation des données entrantes

## 🔧 Configuration Mercure

Le fichier `config/packages/mercure.yaml` configure :
- L'URL du hub Mercure
- Les permissions de publication/abonnement
- La configuration JWT

## 💻 Développement

### Conventions de code

- PSR-12 pour le style de code PHP
- Utilisation des attributs PHP 8 pour les annotations
- Types stricts activés

### Tests

Pour lancer les tests :
```bash
php bin/phpunit
```

## 🔍 Debugging

1. Logs Symfony
```bash
tail -f var/log/dev.log
```

2. Profiler Symfony
- Accessible via la barre de debug en mode dev
- URL: `/_profiler`

## 📱 Interface utilisateur

L'interface utilise :
- CSS personnalisé pour le style
- JavaScript vanilla pour les interactions
- Mercure pour les mises à jour en temps réel

## 🤝 Contribution

1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

free : https://github.com/DanihStephane

## 🆘 Support

Pour toute question ou problème :
1. Consulter la documentation
2. Vérifier les issues existantes
3. Ouvrir une nouvelle issue si nécessaire

## 🔮 Roadmap

- [ ] Système de salons de discussion
- [ ] Messages privés
- [ ] Envoi de fichiers
- [ ] Émojis et réactions
- [ ] Liste des utilisateurs en ligne
- [ ] Historique de messages searchable
