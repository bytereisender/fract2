# Fract2 CMS File Structure

## Table of Contents
1. [Overview](#overview)
2. [Development Structure](#development-structure)
3. [Distribution Structure](#distribution-structure)
4. [Installed Structure](#installed-structure)
5. [Key Files](#key-files)
6. [Visualization of Structure](#visualization-of-structure)

## Overview

The file structure of Fract2 CMS is designed to provide a clear separation between development, distribution, and installation. This structure promotes efficient development and simplifies the deployment process, while also accommodating multilingual documentation.

## Development Structure

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

## Key Files

- `LICENSE.md`: BSD 3-Clause License of the project
- `README.md`: Project overview and documentation
- `fract2-dist-packager.sh`: Script for creating the distribution package
- `index.php`: Main entry point of the application

For more detailed information about specific components, please refer to the following documents:
- [Architecture Overview](architecture_overview_en.md)
- [Database Design](database_design_en.md)
- [Installation Process](installation_process_en.md)
- [Package Structure](package_structure_en.md)
- [Security Considerations](security_considerations_en.md)

## Visualization of Structure

For a visual representation of the file structure, please refer to the `fract2-file-structure.mermaid` file in the `docs` directory.

[... Rest of the content ...]