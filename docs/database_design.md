# Fract2 CMS Datenbankdesign

## Inhaltsverzeichnis
1. [Überblick](#überblick)
2. [Unterstützte Datenbanksysteme](#unterstützte-datenbanksysteme)
3. [Datenbankverbindungsklassen](#datenbankverbindungsklassen)
4. [Abfrageklassen](#abfrageklassen)
5. [Datenbankschema](#datenbankschema)
6. [Konfiguration](#konfiguration)
7. [Performance-Optimierungen](#performance-optimierungen)
8. [Sicherheitsüberlegungen](#sicherheitsüberlegungen)
9. [Migrationen und Versionierung](#migrationen-und-versionierung)
10. [Erweiterbarkeit](#erweiterbarkeit)
11. [Zukünftige Entwicklungen](#zukünftige-entwicklungen)

## Überblick

Das Datenbankdesign von Fract2 CMS ist darauf ausgelegt, Flexibilität, Leistung und Sicherheit zu bieten. Es unterstützt mehrere Datenbanksysteme und verwendet eine abstrakte Schnittstelle, um die Entwicklung und Wartung zu vereinfachen.

## Unterstützte Datenbanksysteme

Fract2 CMS unterstützt derzeit zwei Hauptdatenbanksysteme:

1. **PostgreSQL**: Ein leistungsstarkes, Open-Source-Objektrelationales Datenbanksystem.
2. **MariaDB**: Ein Community-entwickelter Fork von MySQL mit erweiterten Funktionen.

Die Unterstützung für beide Systeme ermöglicht es Benutzern, das für ihre Bedürfnisse am besten geeignete System zu wählen.

## Datenbankverbindungsklassen

### PostgresConnection

Datei: `system/core/database/postgres/PostgresConnection.php`

Funktionalität:
- Erstellt eine PDO-Verbindung zur PostgreSQL-Datenbank
- Implementiert Connection-Pooling für verbesserte Performance
- Setzt datenbankspezifische Konfigurationen

Codebeispiel:
```php
public function connect()
{
	$dsn = "pgsql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['database']}";
	$options = [
		\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
		\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
		\PDO::ATTR_EMULATE_PREPARES => false,
	];

	$this->connection = new \PDO($dsn, $this->config['user'], $this->config['password'], $options);
	$this->setPerformanceConfigs();

	return $this->connection;
}
```

### MariaDBConnection

Datei: `system/core/database/mariadb/MariaDBConnection.php`

Funktionalität:
- Ähnlich wie PostgresConnection, aber für MariaDB optimiert
- Implementiert MariaDB-spezifische Verbindungsoptionen

Codebeispiel:
```php
public function connect()
{
	$dsn = "mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['database']};charset=utf8mb4";
	$options = [
		\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
		\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
		\PDO::ATTR_EMULATE_PREPARES => false,
		\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
	];

	$this->connection = new \PDO($dsn, $this->config['user'], $this->config['password'], $options);
	$this->setPerformanceConfigs();

	return $this->connection;
}
```

## Abfrageklassen

### PostgresQuery und MariaDBQuery

Dateien: 
- `system/core/database/postgres/PostgresQuery.php`
- `system/core/database/mariadb/MariaDBQuery.php`

Funktionalität:
- CRUD-Operationen (Create, Read, Update, Delete)
- Vorbereitung und Ausführung von SQL-Abfragen
- Behandlung von Tabellenpräfixen

Codebeispiel (PostgresQuery):
```php
public function select($table, $columns = ['*'], $where = [], $orderBy = [], $limit = null, $offset = null)
{
	$table = $this->tablePrefix . $table;
	$sql = "SELECT " . implode(', ', $columns) . " FROM $table";

	if (!empty($where)) {
		$sql .= " WHERE " . $this->buildWhereClause($where);
	}

	if (!empty($orderBy)) {
		$sql .= " ORDER BY " . implode(', ', $orderBy);
	}

	if ($limit !== null) {
		$sql .= " LIMIT $limit";
	}

	if ($offset !== null) {
		$sql .= " OFFSET $offset";
	}

	$stmt = $this->connection->prepare($sql);
	$stmt->execute($where);
	return $stmt->fetchAll();
}
```

## Datenbankschema

Das Datenbankschema von Fract2 CMS ist modular aufgebaut und unterstützt die Erweiterung durch Pakete. Kernkomponenten umfassen:

1. **Benutzer und Berechtigungen**
   - users
   - roles
   - permissions
   - user_roles

2. **Inhalte**
   - content_types
   - content_items
   - content_revisions

3. **Medien**
   - media_items
   - media_folders

4. **Taxonomie**
   - taxonomies
   - terms

5. **Konfiguration**
   - config_items

6. **Logging**
   - system_logs

Jedes Paket kann bei Bedarf eigene Tabellen hinzufügen.

## Konfiguration

Die Datenbankkonfiguration wird in `config/database.yaml` gespeichert:

```yaml
postgresql:
  host: localhost
  port: 5432
  database: fract2_db
  user: fract2_user
  password: secure_password
  config:
	shared_buffers: 256MB
	work_mem: 16MB
	
mariadb:
  host: localhost
  port: 3306
  database: fract2_db
  user: fract2_user
  password: secure_password
  config:
	innodb_buffer_pool_size: 256M
	
cms:
  default_db: postgresql
  table_prefix: f2_
```

## Performance-