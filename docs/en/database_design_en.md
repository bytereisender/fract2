# Fract2 CMS Database Design

## Table of Contents
1. [Overview](#overview)
2. [Supported Database Systems](#supported-database-systems)
3. [Database Connection Classes](#database-connection-classes)
4. [Query Classes](#query-classes)
5. [Database Schema](#database-schema)
6. [Configuration](#configuration)
7. [Performance Optimizations](#performance-optimizations)
8. [Security Considerations](#security-considerations)
9. [Migrations and Versioning](#migrations-and-versioning)
10. [Extensibility](#extensibility)
11. [Future Developments](#future-developments)

## Overview

The database design of Fract2 CMS is built to provide flexibility, performance, and security. It supports multiple database systems and uses an abstract interface to simplify development and maintenance.

## Supported Database Systems

Fract2 CMS currently supports two main database systems:

1. **PostgreSQL**: A powerful, open-source object-relational database system.
2. **MariaDB**: A community-developed fork of MySQL with enhanced features.

Support for both systems allows users to choose the system that best fits their needs.

## Database Connection Classes

### PostgresConnection

File: `system/core/database/postgres/PostgresConnection.php`

Functionality:
- Creates a PDO connection to the PostgreSQL database
- Implements connection pooling for improved performance
- Sets database-specific configurations

Code example:
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

File: `system/core/database/mariadb/MariaDBConnection.php`

Functionality:
- Similar to PostgresConnection, but optimized for MariaDB
- Implements MariaDB-specific connection options

Code example:
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

## Query Classes

### PostgresQuery and MariaDBQuery

Files: 
- `system/core/database/postgres/PostgresQuery.php`
- `system/core/database/mariadb/MariaDBQuery.php`

Functionality:
- CRUD operations (Create, Read, Update, Delete)
- Preparation and execution of SQL queries
- Handling of table prefixes

Code example (PostgresQuery):
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

## Database Schema

The database schema of Fract2 CMS is modular and supports extension through packages. Core components include:

1. **Users and Permissions**
   - users
   - roles
   - permissions
   - user_roles

2. **Content**
   - content_types
   - content_items
   - content_revisions

3. **Media**
   - media_items
   - media_folders

4. **Taxonomy**
   - taxonomies
   - terms

5. **Configuration**
   - config_items

6. **Logging**
   - system_logs

Each package can add its own tables as needed.

## Configuration

The database configuration is stored in `config/database.yaml`:

```yaml
postgresql:
  host: localhost
  port: 5432
  database: fract2_db
  user: fract2_user
  password: secure_password
  
  # Performance optimizations
  config:
    shared_buffers: 256MB
    work_mem: 16MB
    maintenance_work_mem: 128MB
    effective_cache_size: 1GB
    max_connections: 100
    
  # Connection Pooling with PgBouncer
  pgbouncer:
    enabled: true
    max_client_conn: 1000
    default_pool_size: 20

mariadb:
  host: localhost
  port: 3306
  database: fract2_db
  user: fract2_user
  password: secure_password
  
  # Performance optimizations
  config:
    innodb_buffer_pool_size: 256M
    innodb_log_file_size: 64M
    innodb_flush_log_at_trx_commit: 2
    query_cache_size: 64M
    max_connections: 100
    
  # Connection Pooling with ProxySQL
  proxysql:
    enabled: true
    max_connections: 1000
    default_pool_size: 20

cms:
  default_db: postgresql
  table_prefix: f2_
```

## Performance Optimizations

1. **Query Caching**: Implementation of a query cache to reduce database load.
2. **Connection Pooling**: Use of PgBouncer for PostgreSQL and ProxySQL for MariaDB to manage database connections efficiently.
3. **Indexing Strategy**: Careful planning and implementation of database indexes to speed up queries.
4. **Query Optimization**: Regular analysis and optimization of database queries.
5. **Partitioning**: Implementation of table partitioning for large datasets where appropriate.

## Security Considerations

1. **Prepared Statements**: Use of prepared statements for all database queries to prevent SQL injection.
2. **Least Privilege Principle**: Database users are given only the permissions they need.
3. **Encryption**: Sensitive data is encrypted in the database.
4. **Audit Logging**: Implementation of audit logging for sensitive database operations.
5. **Regular Backups**: Automated, regular backups of the database with secure storage.

## Migrations and Versioning

1. **Migration System**: Implementation of a database migration system to manage schema changes.
2. **Version Control**: All database schema changes are version controlled.
3. **Rollback Capability**: Each migration includes a corresponding rollback method.
4. **Automated Testing**: Migrations are automatically tested in a staging environment before being applied to production.

## Extensibility

1. **Package-based Extensions**: Packages can define their own database tables and relationships.
2. **Hook System**: Provides hooks for packages to modify or extend core database operations.
3. **Custom Field Types**: Support for custom field types that packages can define and use.

## Future Developments

1. **Multi-database Support**: Planned support for using multiple database systems simultaneously.
2. **Sharding**: Implementation of database sharding for horizontal scaling.
3. **NoSQL Integration**: Planned integration with NoSQL databases for specific use cases.
4. **Real-time Sync**: Development of real-time database synchronization for clustered setups.
5. **AI-powered Optimizations**: Integration of AI for predictive query optimization and indexing.

This database design provides a flexible, secure, and performant foundation for the Fract2 CMS, with clear paths for future expansion and optimization.