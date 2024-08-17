# Structure des Packages du CMS Fract2

## Table des Matières
1. [Aperçu](#aperçu)
2. [Structure des Packages](#structure-des-packages)
3. [Packages de Base](#packages-de-base)
4. [Packages Personnalisés](#packages-personnalisés)
5. [Gestion des Packages](#gestion-des-packages)
6. [Dépendances](#dépendances)
7. [Meilleures Pratiques](#meilleures-pratiques)
8. [Développement de Packages](#développement-de-packages)
9. [Distribution de Packages](#distribution-de-packages)

## Aperçu

Le système de packages est un composant central de l'architecture du CMS Fract2. Il permet une structure modulaire et extensible qui permet aux développeurs d'ajouter de nouvelles fonctionnalités ou de modifier les existantes sans altérer le cœur du système. Ce document décrit la structure et la gestion des packages dans le CMS Fract2.

## Structure des Packages

Un package typique de Fract2 a la structure suivante :

```
nom-du-package/
├── config/
│   └── config.yaml
├── src/
│   ├── Functions/
│   ├── Handlers/
│   └── Services/
├── templates/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── migrations/
├── tests/
└── package.yaml
```

- `config/` : Contient les configurations spécifiques au package
- `src/` : Contient le code source PHP du package
  - `Functions/` : Contient des composants fonctionnels
  - `Handlers/` : Contient des gestionnaires de requêtes
  - `Services/` : Contient des services et fonctions auxiliaires
- `templates/` : Templates TWIG pour la sortie
- `assets/` : Ressources statiques telles que CSS, JavaScript et images
- `migrations/` : Migrations de base de données pour le package
- `tests/` : Tests unitaires et d'intégration
- `package.yaml` : Métadonnées et configuration du package

## Packages de Base

Le CMS Fract2 inclut les packages de base suivants :

1. **f2.core** : Fonctionnalités de base du CMS
2. **f2.users** : Gestion des utilisateurs et authentification
3. **f2.content** : Gestion et administration du contenu
4. **f2.media** : Gestion des médias
5. **f2.seo** : Optimisations et outils SEO

Ces packages de base fournissent les fonctionnalités fondamentales du CMS et servent d'exemples pour le développement de packages personnalisés.

## Packages Personnalisés

Les développeurs peuvent créer leurs propres packages pour étendre la fonctionnalité de Fract2. Un package personnalisé doit :

1. Suivre la structure décrite ci-dessus
2. Utiliser un préfixe d'espace de noms unique
3. Contenir une documentation claire et des commentaires
4. Fournir des tests unitaires pour les fonctionnalités critiques

## Gestion des Packages

Le CMS Fract2 utilise son propre système de gestion de packages :

- Installation : `php fract2 package:install nom-du-package`
- Mise à jour : `php fract2 package:update nom-du-package`
- Suppression : `php fract2 package:remove nom-du-package`
- Activation/Désactivation : `php fract2 package:toggle nom-du-package`

Ces commandes interagissent avec le système de packages pour gérer le cycle de vie des packages au sein du CMS.

## Dépendances

Les dépendances des packages sont définies dans le fichier `package.yaml` :

```yaml
name: mon-package
version: 1.0.0
dependencies:
  - f2.core: "^2.0"
  - f2.users: "^1.5"
```

Le système de gestion des packages résout automatiquement les dépendances et s'assure que tous les packages requis sont installés.

## Meilleures Pratiques

1. Gardez les packages aussi petits et ciblés que possible
2. Utilisez la programmation fonctionnelle lorsque cela a du sens
3. Suivez les normes de codage de Fract2
4. Documentez minutieusement les API publiques
5. Écrivez des tests complets pour vos packages
6. Utilisez le versionnage sémantique pour vos packages
7. Évitez un couplage étroit entre les packages
8. Utilisez l'injection de dépendances pour une meilleure modularité

## Développement de Packages

Lors du développement d'un nouveau package :

1. Utilisez la commande de création de package : `php fract2 package:create nom-du-package`
2. Implémentez les interfaces et hooks requis
3. Utilisez l'API de Fract2 pour interagir avec les fonctionnalités de base
4. Suivez les conventions de nommage pour les fonctions, les gestionnaires et les services
5. Utilisez le conteneur d'injection de dépendances intégré
6. Tirez parti des packages de base existants plutôt que de réinventer la fonctionnalité

## Distribution de Packages

Pour distribuer votre package :

1. Assurez-vous que tous les tests passent et que le package est bien documenté
2. Créez un fichier `README.md` avec des instructions d'installation et d'utilisation
3. Utilisez la commande de construction de package : `php fract2 package:build nom-du-package`
4. Publiez votre package sur le dépôt de packages Fract2 ou votre propre canal de distribution

N'oubliez pas que les packages distribués doivent être autonomes et ne pas dépendre de ressources externes qui pourraient ne pas être disponibles sur le système de l'utilisateur final.

En suivant ces directives, vous pouvez créer des packages robustes et maintenables qui étendent la fonctionnalité du CMS Fract2 tout en adhérant à ses principes de simplicité et d'efficacité.