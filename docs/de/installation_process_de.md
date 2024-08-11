# Fract2 CMS Installationsprozess

## Inhaltsverzeichnis
1. [Überblick](#überblick)
2. [Systemanforderungen](#systemanforderungen)
3. [Vorbereitung](#vorbereitung)
4. [Installationsschritte](#installationsschritte)
5. [Zusätzliche Funktionen](#zusätzliche-funktionen)
6. [Konfiguration nach der Installation](#konfiguration-nach-der-installation)
7. [Fehlerbehebung](#fehlerbehebung)

## Überblick

Der Installationsprozess von Fract2 CMS wurde entwickelt, um eine einfache und reibungslose Einrichtung zu gewährleisten. Das System nutzt ein spezielles Installationsskript (`fract2-setup.sh`) und ein komprimiertes Distributionspaket (`distribution.tar`) für den gesamten Prozess.

## Systemanforderungen

- PHP 7.4 oder höher
- PostgreSQL 12+ oder MariaDB 10.3+
- Apache 2.4+ oder Nginx 1.18+
- Mindestens 64 MB RAM für PHP
- 100 MB freier Festplattenspeicher
- (Optional) Composer
- (Optional) Git

## Vorbereitung

1. Kopieren Sie `fract2-setup.sh` und `distribution.tar` in das gewünschte Verzeichnis auf Ihrem Server.
2. Stellen Sie sicher, dass Sie Ausführungsrechte für `fract2-setup.sh` haben.

## Installationsschritte

1. Öffnen Sie ein Terminal und navigieren Sie zum Verzeichnis, das `fract2-setup.sh` enthält.

2. Führen Sie das Installationsskript aus:
   ```
   ./fract2-setup.sh
   ```

3. Das Skript führt folgende Aktionen aus:
   - Erkennung des Betriebssystems
   - Extraktion der Dateien aus `distribution.tar` in ein neues Verzeichnis `fract2`
   - Anzeige des Fortschritts mit farbiger Ausgabe

4. Folgen Sie den Anweisungen auf dem Bildschirm.

## Zusätzliche Funktionen

### Composer-Initialisierung
Wenn Composer auf Ihrem System verfügbar ist, wird das Skript automatisch die Abhängigkeiten installieren. Falls nicht, erhalten Sie eine Benachrichtigung mit Anweisungen zur manuellen Installation.

### Git-Repository-Initialisierung
Das Skript bietet die Option, ein Git-Repository für Ihre Fract2-Installation zu initialisieren. Sie werden gefragt, ob Sie dies möchten.

## Konfiguration nach der Installation

1. Navigieren Sie zum neu erstellten `fract2`-Verzeichnis.
2. Öffnen Sie die Datei `config/config.yaml` und passen Sie die Einstellungen nach Bedarf an.
3. Konfigurieren Sie Ihren Webserver, um auf das Fract2-Installationsverzeichnis zu zeigen.
4. Setzen Sie die entsprechenden Berechtigungen für Verzeichnisse und Dateien:
   ```
   chmod 755 /pfad/zu/fract2
   chmod 750 /pfad/zu/fract2/config
   chmod 644 /pfad/zu/fract2/index.php
   ```

## Fehlerbehebung

- **Extraktionsprobleme**: Stellen Sie sicher, dass Sie Schreibrechte im Zielverzeichnis haben.
- **Composer-Fehler**: Überprüfen Sie Ihre Composer-Installation und führen Sie `composer install` manuell im Fract2-Verzeichnis aus.
- **Git-Initialisierungsfehler**: Stellen Sie sicher, dass Git korrekt installiert ist und Sie die notwendigen Berechtigungen haben.
- **Berechtigungsfehler**: Überprüfen Sie die Dateiberechtigungen und den Besitzer des Webserver-Prozesses.

Bei anhaltenden Problemen konsultieren Sie bitte die ausführliche Dokumentation oder wenden Sie sich an den Support.