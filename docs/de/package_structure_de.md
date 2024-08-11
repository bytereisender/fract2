# Fract2 CMS Paketstruktur

## Inhaltsverzeichnis
1. [Überblick](#überblick)
2. [Paketaufbau](#paketaufbau)
3. [Kernpakete](#kernpakete)
4. [Benutzerdefinierte Pakete](#benutzerdefinierte-pakete)
5. [Paketmanagement](#paketmanagement)
6. [Abhängigkeiten](#abhängigkeiten)
7. [Besten Praktiken](#besten-praktiken)

## Überblick

Das Paketsystem ist ein zentraler Bestandteil der Fract2 CMS-Architektur. Es ermöglicht eine modulare und erweiterbare Struktur, die es Entwicklern erlaubt, neue Funktionen hinzuzufügen oder bestehende anzupassen, ohne den Kern des Systems zu verändern.

## Paketaufbau

Ein typisches Fract2-Paket hat folgende Struktur:

```
paketname/
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

- `config/`: Enthält paketspezifische Konfigurationen
- `src/`: Enthält den PHP-Quellcode des Pakets
  - `Functions/`: Enthält funktionale Komponenten
  - `Handlers/`: Enthält Request-Handler
  - `Services/`: Enthält Dienste und Hilfsfunktionen
- `templates/`: TWIG-Templates für die Ausgabe
- `assets/`: Statische Ressourcen wie CSS, JavaScript und Bilder
- `migrations/`: Datenbankmigrationen für das Paket
- `tests/`: Unit- und Integrationstests
- `package.yaml`: Metadaten und Konfiguration des Pakets

## Kernpakete

Fract2 CMS enthält folgende Kernpakete:

1. **f2.core**: Grundlegende CMS-Funktionalitäten
2. **f2.users**: Benutzerverwaltung und Authentifizierung
3. **f2.content**: Content-Management und -Verwaltung
4. **f2.media**: Medienverwaltung
5. **f2.seo**: SEO-Optimierungen und -Tools

## Benutzerdefinierte Pakete

Entwickler können eigene Pakete erstellen, um die Funktionalität von Fract2 zu erweitern. Ein benutzerdefiniertes Paket sollte:

1. Der oben beschriebenen Struktur folgen
2. Eine eindeutige Namespace-Präfix verwenden
3. Klare Dokumentation und Kommentare enthalten
4. Unit-Tests für kritische Funktionalitäten bereitstellen

## Paketmanagement

Fract2 CMS verwendet ein eigenes Paketmanagement-System:

- Installation: `php fract2 package:install paketname`
- Aktualisierung: `php fract2 package:update paketname`
- Entfernung: `php fract2 package:remove paketname`
- Aktivierung/Deaktivierung: `php fract2 package:toggle paketname`

## Abhängigkeiten

Paketabhängigkeiten werden in der `package.yaml`-Datei definiert:

```yaml
name: mein-paket
version: 1.0.0
dependencies:
  - f2.core: "^2.0"
  - f2.users: "^1.5"
```

Das Paketmanagement-System löst Abhängigkeiten automatisch auf und stellt sicher, dass alle erforderlichen Pakete installiert sind.

## Besten Praktiken

1. Halten Sie Pakete so klein und fokussiert wie möglich
2. Verwenden Sie funktionale Programmierung, wo es sinnvoll ist
3. Folgen Sie den Fract2 Coding Standards
4. Dokumentieren Sie öffentliche APIs gründlich
5. Schreiben Sie umfassende Tests für Ihre Pakete
6. Verwenden Sie semantische Versionierung für Ihre Pakete

Durch Befolgen dieser Richtlinien können Entwickler robuste und wartbare Erweiterungen für Fract2 CMS erstellen.