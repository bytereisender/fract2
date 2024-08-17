# Conception de la Base de Données du CMS Fract2

## Table des Matières
1. [Aperçu](#aperçu)
2. [Systèmes de Bases de Données Pris en Charge](#systèmes-de-bases-de-données-pris-en-charge)
3. [Classes de Connexion à la Base de Données](#classes-de-connexion-à-la-base-de-données)
4. [Classes de Requête](#classes-de-requête)
5. [Schéma de Base de Données](#schéma-de-base-de-données)
6. [Configuration](#configuration)
7. [Optimisations de Performance](#optimisations-de-performance)
8. [Considérations de Sécurité](#considérations-de-sécurité)
9. [Migrations et Versionnage](#migrations-et-versionnage)
10. [Extensibilité](#extensibilité)
11. [Développements Futurs](#développements-futurs)

## Aperçu

La conception de la base de données du CMS Fract2 est conçue pour offrir flexibilité, performance et sécurité. Elle prend en charge plusieurs systèmes de bases de données et utilise une interface abstraite pour simplifier le développement et la maintenance.

## Systèmes de Bases de Données Pris en Charge

Le CMS Fract2 prend actuellement en charge deux principaux systèmes de bases de données :

1. **PostgreSQL** : Un système de gestion de base de données relationnelle-objet puissant et open-source.
2. **MariaDB** : Un fork développé par la communauté de MySQL avec des fonctionnalités améliorées.

La prise en charge des deux systèmes permet aux utilisateurs de choisir celui qui convient le mieux à leurs besoins.

## Classes de Connexion à la Base de Données

### PostgresConnection

Fichier : `system/core/database/postgres/PostgresConnection.php`

Fonctionnalités :
- Crée une connexion PDO à la base de données PostgreSQL
- Implémente le pooling de connexions pour améliorer les performances
- Définit des configurations spécifiques à la base de données

Exemple de code :
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

Fichier : `system/core/database/mariadb/MariaDBConnection.php`

Fonctionnalités :
- Similaire à PostgresConnection, mais optimisé pour MariaDB
- Implémente des options de connexion spécifiques à MariaDB

Exemple de code :
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

## Classes de Requête

### PostgresQuery et MariaDBQuery

Fichiers : 
- `system/core/database/postgres/PostgresQuery.php`
- `system/core/database/mariadb/MariaDBQuery.php`

Fonctionnalités :
- Opérations CRUD (Create, Read, Update, Delete)
- Préparation et exécution de requêtes SQL
- Gestion des préfixes de table

Exemple de code (PostgresQuery) :
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

## Schéma de Base de Données

Le schéma de base de données du CMS Fract2 est modulaire et supporte l'extension via des packages. Les composants principaux incluent :

1. **Utilisateurs et Permissions**
   - users
   - roles
   - permissions
   - user_roles

2. **Contenu**
   - content_types
   - content_items
   - content_revisions

3. **Médias**
   - media_items
   - media_folders

4. **Taxonomie**
   - taxonomies
   - terms

5. **Configuration**
   - config_items

6. **Journalisation**
   - system_logs

Chaque package peut ajouter ses propres tables selon les besoins.

## Configuration

La configuration de la base de données est stockée dans `config/database.yaml` :

```yaml
postgresql:
  host: localhost
  port: 5432
  database: fract2_db
  user: fract2_user
  password: mot_de_passe_sécurisé
  
  # Optimisations de performance
  config:
    shared_buffers: 256MB
    work_mem: 16MB
    maintenance_work_mem: 128MB
    effective_cache_size: 1GB
    max_connections: 100
    
  # Pooling de connexions avec PgBouncer
  pgbouncer:
    enabled: true
    max_client_conn: 1000
    default_pool_size: 20

mariadb:
  host: localhost
  port: 3306
  database: fract2_db
  user: fract2_user
  password: mot_de_passe_sécurisé
  
  # Optimisations de performance
  config:
    innodb_buffer_pool_size: 256M
    innodb_log_file_size: 64M
    innodb_flush_log_at_trx_commit: 2
    query_cache_size: 64M
    max_connections: 100
    
  # Pooling de connexions avec ProxySQL
  proxysql:
    enabled: true
    max_connections: 1000
    default_pool_size: 20

cms:
  default_db: postgresql
  table_prefix: f2_
```

## Optimisations de Performance

1. **Cache de Requêtes** : Implémentation d'un cache de requêtes pour réduire la charge de la base de données.
2. **Pooling de Connexions** : Utilisation de PgBouncer pour PostgreSQL et ProxySQL pour MariaDB pour gérer efficacement les connexions à la base de données.
3. **Stratégie d'Indexation** : Planification et implémentation soigneuses des index de base de données pour accélérer les requêtes.
4. **Optimisation des Requêtes** : Analyse et optimisation régulières des requêtes de base de données.
5. **Partitionnement** : Implémentation du partitionnement de tables pour les grands ensembles de données lorsque c'est approprié.

## Considérations de Sécurité

1. **Requêtes Préparées** : Utilisation de requêtes préparées pour toutes les requêtes de base de données afin de prévenir l'injection SQL.
2. **Principe du Moindre Privilège** : Les utilisateurs de la base de données ne reçoivent que les permissions dont ils ont besoin.
3. **Chiffrement** : Les données sensibles sont chiffrées dans la base de données.
4. **Journalisation d'Audit** : Implémentation de la journalisation d'audit pour les opérations sensibles de la base de données.
5. **Sauvegardes Régulières** : Sauvegardes automatisées et régulières de la base de données avec un stockage sécurisé.

## Migrations et Versionnage

1. **Système de Migration** : Implémentation d'un système de migration de base de données pour gérer les changements de schéma.
2. **Contrôle de Version** : Tous les changements de schéma de base de données sont versionnés.
3. **Capacité de Rollback** : Chaque migration inclut une méthode de rollback correspondante.
4. **Tests Automatisés** : Les migrations sont automatiquement testées dans un environnement de staging avant d'être appliquées en production.

## Extensibilité

1. **Extensions Basées sur les Packages** : Les packages peuvent définir leurs propres tables de base de données et relations.
2. **Système de Hooks** : Fournit des hooks pour que les packages modifient ou étendent les opérations de base de données principales.
3. **Types de Champs Personnalisés** : Support pour des types de champs personnalisés que les packages peuvent définir et utiliser.

## Développements Futurs

1. **Support Multi-base de données** : Support prévu pour l'utilisation simultanée de plusieurs systèmes de bases de données.
2. **Sharding** : Implémentation du sharding de base de données pour le passage à l'échelle horizontal.
3. **Intégration NoSQL** : Intégration prévue avec des bases de données NoSQL pour des cas d'utilisation spécifiques.
4. **Synchronisation en Temps Réel** : Développement de la synchronisation de base de données en temps réel pour les configurations en cluster.
5. **Optimisations Basées sur l'IA** : Intégration de l'IA pour l'optimisation prédictive des requêtes et l'indexation.

Cette conception de base de données fournit une base flexible, sécurisée et performante pour le CMS Fract2, avec des voies claires pour l'expansion et l'optimisation futures.