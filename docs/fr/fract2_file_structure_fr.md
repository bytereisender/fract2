# Structure des Fichiers du CMS Fract2

## Table des Matières
1. [Aperçu](#aperçu)
2. [Structure de Développement](#structure-de-développement)
3. [Structure de Distribution](#structure-de-distribution)
4. [Structure Installée](#structure-installée)
5. [Fichiers Clés](#fichiers-clés)
6. [Visualisation de la Structure](#visualisation-de-la-structure)

## Aperçu

La structure des fichiers du CMS Fract2 est conçue pour fournir une séparation claire entre le développement, la distribution et l'installation. Cette structure favorise un développement efficace et simplifie le processus de déploiement, tout en prenant en compte la documentation multilingue.

## Structure de Développement

```
fract2-development/
├── config/
│   ├── config.yaml
│   └── database.yaml
├── docs/
│   ├── de/
│   │   ├── architecture_overview_de.md
│   │   ├── database_design_de.md
│   │   ├── fract2_file_structure_de.md
│   │   ├── installation_process_de.md
│   │   ├── package_structure_de.md
│   │   └── security_considerations_de.md
│   ├── en/
│   │   ├── architecture_overview_en.md
│   │   ├── database_design_en.md
│   │   ├── fract2_file_structure_en.md
│   │   ├── installation_process_en.md
│   │   ├── package_structure_en.md
│   │   └── security_considerations_en.md
│   ├── es/
│   │   ├── architecture_overview_es.md
│   │   ├── database_design_es.md
│   │   ├── fract2_file_structure_es.md
│   │   ├── installation_process_es.md
│   │   ├── package_structure_es.md
│   │   └── security_considerations_es.md
│   ├── fr/
│   │   ├── architecture_overview_fr.md
│   │   ├── database_design_fr.md
│   │   ├── fract2_file_structure_fr.md
│   │   ├── installation_process_fr.md
│   │   ├── package_structure_fr.md
│   │   └── security_considerations_fr.md
│   ├── ru/
│   │   ├── architecture_overview_ru.md
│   │   ├── database_design_ru.md
│   │   ├── fract2_file_structure_ru.md
│   │   ├── installation_process_ru.md
│   │   ├── package_structure_ru.md
│   │   └── security_considerations_ru.md
│   └── fract2-file-structure.mermaid
├── packages/
│   ├── f2.atom.tar/
│   ├── f2.content.tar/
│   └── f2.users.tar/
├── system/
│   ├── bootstrap/
│   │   └── tarStreamWrapper.php
│   └── core.tar/
│       └── database/
│           ├── mariadb/
│           │   ├── MariaDBConnection.php
│           │   └── MariaDBQuery.php
│           └── postgres/
│               ├── PostgresConnection.php
│               └── PostgresQuery.php
├── templates/
│   └── index.twig
├── LICENSE.md
├── README.md
├── fract2-dist-packager.sh
└── index.php
```

## Fichiers Clés

- `LICENSE.md`: Licence BSD 3-Clause du projet
- `README.md`: Aperçu du projet et documentation
- `fract2-dist-packager.sh`: Script pour créer le package de distribution
- `index.php`: Point d'entrée principal de l'application

Pour des informations plus détaillées sur des composants spécifiques, veuillez consulter les documents suivants :
- [Aperçu de l'Architecture](architecture_overview_fr.md)
- [Conception de la Base de Données](database_design_fr.md)
- [Processus d'Installation](installation_process_fr.md)
- [Structure des Paquets](package_structure_fr.md)
- [Considérations de Sécurité](security_considerations_fr.md)

## Visualisation de la Structure

Pour une représentation visuelle de la structure des fichiers, veuillez vous référer au fichier `fract2-file-structure.mermaid` dans le répertoire `docs`.

[... Reste du contenu ...]