# Структура файлов CMS Fract2

## Содержание
1. [Обзор](#обзор)
2. [Структура разработки](#структура-разработки)
3. [Структура дистрибутива](#структура-дистрибутива)
4. [Установленная структура](#установленная-структура)
5. [Ключевые файлы](#ключевые-файлы)
6. [Визуализация структуры](#визуализация-структуры)

## Обзор

Структура файлов CMS Fract2 разработана таким образом, чтобы обеспечить четкое разделение между разработкой, дистрибуцией и установкой. Эта структура способствует эффективной разработке и упрощает процесс развертывания, одновременно поддерживая многоязычную документацию.

## Структура разработки

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

## Ключевые файлы

- `LICENSE.md`: Лицензия BSD 3-Clause проекта
- `README.md`: Обзор проекта и документация
- `fract2-dist-packager.sh`: Скрипт для создания дистрибутивного пакета
- `index.php`: Основная точка входа приложения

Для получения более подробной информации о конкретных компонентах, пожалуйста, обратитесь к следующим документам:
- [Обзор архитектуры](architecture_overview_ru.md)
- [Дизайн базы данных](database_design_ru.md)
- [Процесс установки](installation_process_ru.md)
- [Структура пакетов](package_structure_ru.md)
- [Вопросы безопасности](security_considerations_ru.md)

## Визуализация структуры

Для визуального представления структуры файлов, пожалуйста, обратитесь к файлу `fract2-file-structure.mermaid` в директории `docs`.

[... Остальное содержание ...]