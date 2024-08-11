# Fract2 CMS Dateistruktur

## Inhaltsverzeichnis
1. [Überblick](#überblick)
2. [Entwicklungsstruktur](#entwicklungsstruktur)
3. [Distributionsstruktur](#distributionsstruktur)
4. [Installierte Struktur](#installierte-struktur)
5. [Wichtige Dateien](#wichtige-dateien)
6. [Visualisierung der Struktur](#visualisierung-der-struktur)

## Überblick

Die Dateistruktur des Fract2 CMS ist so konzipiert, dass sie eine klare Trennung zwischen Entwicklung, Distribution und Installation ermöglicht. Diese Struktur fördert eine effiziente Entwicklung und vereinfacht den Bereitstellungsprozess, während sie auch mehrsprachige Dokumentation berücksichtigt.

## Entwicklungsstruktur

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

## Wichtige Dateien

- `LICENSE.md`: BSD 3-Clause Lizenz des Projekts
- `README.md`: Projektübersicht und Dokumentation
- `fract2-dist-packager.sh`: Skript zur Erstellung des Distributionspakets
- `index.php`: Haupteinstiegspunkt der Anwendung

Für detailliertere Informationen zu spezifischen Komponenten lesen Sie bitte die folgenden Dokumente:
- [Architekturüberblick](architecture_overview_de.md)
- [Datenbankdesign](database_design_de.md)
- [Installationsprozess](installation_process_de.md)
- [Paketstruktur](package_structure_de.md)
- [Sicherheitsüberlegungen](security_considerations_de.md)

## Visualisierung der Struktur

Für eine visuelle Darstellung der Dateistruktur siehe die Datei `fract2-file-structure.mermaid` im Verzeichnis `docs`.

[... Rest des Inhalts ...]