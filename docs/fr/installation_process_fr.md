# Processus d'Installation du CMS Fract2

## Table des Matières
1. [Aperçu](#aperçu)
2. [Prérequis Système](#prérequis-système)
3. [Étapes de Pré-installation](#étapes-de-pré-installation)
4. [Étapes d'Installation](#étapes-dinstallation)
5. [Configuration Post-installation](#configuration-post-installation)
6. [Dépannage](#dépannage)
7. [Mise à Jour du CMS Fract2](#mise-à-jour-du-cms-fract2)

## Aperçu

Le processus d'installation du CMS Fract2 est conçu pour être simple et convivial. Ce document vous guidera à travers les étapes nécessaires pour mettre en place votre CMS Fract2.

## Prérequis Système

Avant de commencer l'installation, assurez-vous que votre système répond aux exigences suivantes :

- PHP 7.4 ou supérieur
- PostgreSQL 12+ ou MariaDB 10.3+
- Apache 2.4+ ou Nginx 1.18+
- Minimum 64 Mo de RAM alloués à PHP
- 100 Mo d'espace disque libre
- Composer (optionnel, mais recommandé)
- Git (optionnel)

## Étapes de Pré-installation

1. Téléchargez le package d'installation du CMS Fract2 depuis le site officiel ou le dépôt.
2. Extrayez le contenu du package dans le répertoire d'installation souhaité.
3. Assurez-vous que votre serveur web a les droits d'écriture sur le répertoire d'installation.

## Étapes d'Installation

1. Ouvrez un terminal et naviguez vers le répertoire contenant les fichiers d'installation de Fract2.

2. Exécutez le script d'installation :
   ```
   ./fract2-setup.sh
   ```

3. Le script effectuera les actions suivantes :
   - Détecter votre système d'exploitation
   - Extraire les fichiers de `distribution.tar` dans un nouveau répertoire `fract2`
   - Afficher la progression avec une sortie colorée

4. Suivez les invites à l'écran. Il vous sera demandé de :
   - Choisir le système de base de données (PostgreSQL ou MariaDB)
   - Fournir les détails de connexion à la base de données
   - Configurer l'utilisateur administrateur

5. Si Composer est disponible sur votre système, le script installera automatiquement les dépendances. Sinon, vous recevrez des instructions pour une installation manuelle.

6. Le script proposera d'initialiser un dépôt Git pour votre installation Fract2. Vous pouvez choisir de le faire ou non.

## Configuration Post-installation

Après avoir terminé l'installation :

1. Naviguez vers le répertoire `fract2` nouvellement créé.
2. Ouvrez le fichier `config/config.yaml` et ajustez les paramètres selon vos besoins.
3. Configurez votre serveur web pour qu'il pointe vers le répertoire d'installation de Fract2.
4. Définissez les permissions appropriées pour les répertoires et les fichiers :
   ```
   chmod 755 /chemin/vers/fract2
   chmod 750 /chemin/vers/fract2/config
   chmod 644 /chemin/vers/fract2/index.php
   ```

5. Accédez à votre CMS Fract2 via un navigateur web et complétez toutes les étapes de configuration supplémentaires demandées.

## Dépannage

Si vous rencontrez des problèmes lors de l'installation :

- **Problèmes d'Extraction** : Assurez-vous d'avoir les droits d'écriture dans le répertoire cible.
- **Erreurs Composer** : Vérifiez votre installation Composer et essayez d'exécuter `composer install` manuellement dans le répertoire Fract2.
- **Erreurs d'Initialisation Git** : Assurez-vous que Git est correctement installé et que vous avez les permissions nécessaires.
- **Problèmes de Connexion à la Base de Données** : Vérifiez vos identifiants de base de données et assurez-vous que le serveur de base de données est en cours d'exécution.
- **Erreurs de Permission** : Vérifiez les permissions des fichiers et répertoires, ainsi que le propriétaire du processus du serveur web.

Pour les problèmes persistants, consultez la documentation détaillée ou contactez la communauté de support.

## Mise à Jour du CMS Fract2

Pour mettre à jour votre installation du CMS Fract2 :

1. Sauvegardez votre installation Fract2 actuelle et votre base de données.
2. Téléchargez le dernier package de mise à jour Fract2.
3. Exécutez le script de mise à jour :
   ```
   ./fract2-update.sh
   ```
4. Suivez les instructions à l'écran pour terminer le processus de mise à jour.

Consultez toujours la documentation de mise à jour spécifique à la version pour connaître les étapes ou considérations supplémentaires.

N'oubliez pas de tester le processus de mise à jour dans un environnement de test avant de l'appliquer à votre site de production.

En suivant ces étapes, vous devriez avoir une installation fonctionnelle du CMS Fract2. Pour des informations plus détaillées sur l'utilisation et la configuration de Fract2, veuillez consulter le manuel d'utilisation et le guide d'administration.