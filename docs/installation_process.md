# Fract2 CMS Installationsprozess

## Inhaltsverzeichnis
1. [Überblick](#überblick)
2. [Systemanforderungen](#systemanforderungen)
3. [Vorbereitungen](#vorbereitungen)
4. [Installationsschritte](#installationsschritte)
5. [Konfiguration nach der Installation](#konfiguration-nach-der-installation)
6. [Fehlerbehebung](#fehlerbehebung)
7. [Aktualisierungsprozess](#aktualisierungsprozess)

## Überblick

Der Installationsprozess von Fract2 CMS wurde entwickelt, um eine einfache und reibungslose Einrichtung zu gewährleisten. Das System nutzt ein spezielles Installationsskript, das den Benutzer durch den gesamten Prozess führt.

## Systemanforderungen

- PHP 7.4 oder höher
- PostgreSQL 12+ oder MariaDB 10.3+
- Apache 2.4+ oder Nginx 1.18+
- Mindestens 64 MB RAM für PHP
- 100 MB freier Festplattenspeicher

## Vorbereitungen

1. Laden Sie das Fract2 CMS-Installationspaket herunter.
2. Entpacken Sie das Archiv in das gewünschte Verzeichnis auf Ihrem Webserver.
3. Stellen Sie sicher, dass das Webserver-Benutzerkotnto Schreibrechte für das Installationsverzeichnis hat.

## Installationsschritte

1. Öffnen Sie ein Terminal und navigieren Sie zum Installationsverzeichnis.

2. Führen Sie das Installationsskript aus:
   ```
   ./fract2-install.sh
   ```

3. Folgen Sie den Anweisungen des Skripts:
   - Wählen Sie das zu verwendende Datenbanksystem (PostgreSQL oder MariaDB)
   - Geben Sie die Datenbankverbindungsdaten ein
   - Wählen Sie den Installationsmodus (Standard oder Erweitert)
   - Konfigurieren Sie den Admin-Benutzer

4. Das Skript führt folgende Aktionen aus:
   - Überprüfung der Systemanforderungen
   - Erstellung der Datenbankstruktur
   - Kopieren der Fract2-Dateien an den richtigen Ort
   - Generierung der Konfigurationsdateien
   - Einrichtung des Admin-Benutzers

5. Nach Abschluss der Installation erhalten Sie eine Zusammenfassung und weitere Anweisungen.

## Konfiguration nach der Installation

1. Öffnen Sie die Datei `config/config.yaml` und passen Sie die Einstellungen nach Bedarf an.
2. Konfigurieren Sie Ihren Webserver, um auf das Fract2-Installationsverzeichnis zu zeigen.
3. Setzen Sie die entsprechenden Berechtigungen für Verzeichnisse und Dateien:
   ```
   chmod 755 /pfad/zu/fract2
   chmod 750 /pfad/zu/fract2/config
   chmod 644 /pfad/zu/fract2/index.php
   ```

## Fehlerbehebung

- **Datenbankkonnektivitätsprobleme**: Überprüfen Sie die Verbindungsdaten in `config/database.yaml`.
- **Berechtigungsfehler**: Stellen Sie sicher, dass der Webserver-Benutzer die notwendigen Schreibrechte hat.
- **Fehlende PHP-Erweiterungen**: Installieren Sie fehlende Erweiterungen über Ihren Paketmanager.

## Aktualisierungsprozess

1. Sichern Sie Ihre aktuelle Fract2-Installation und Datenbank.
2. Laden Sie das neue Fract2-Updatepaket herunter.
3. Führen Sie das Update-Skript aus:
   ```
   ./fract2-update.sh
   ```
4. Folgen Sie den Anweisungen des Skripts, um die Aktualisierung abzuschließen.

Für detaillierte Informationen zu spezifischen Versionsupgrades, konsultieren Sie bitte die Upgrade-Dokumentation der jeweiligen Version.