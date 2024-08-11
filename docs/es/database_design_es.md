# Diseño de Base de Datos del CMS Fract2

## Tabla de Contenidos
1. [Visión General](#visión-general)
2. [Sistemas de Bases de Datos Soportados](#sistemas-de-bases-de-datos-soportados)
3. [Clases de Conexión a Base de Datos](#clases-de-conexión-a-base-de-datos)
4. [Clases de Consulta](#clases-de-consulta)
5. [Esquema de Base de Datos](#esquema-de-base-de-datos)
6. [Configuración](#configuración)
7. [Optimizaciones de Rendimiento](#optimizaciones-de-rendimiento)
8. [Consideraciones de Seguridad](#consideraciones-de-seguridad)
9. [Migraciones y Versionado](#migraciones-y-versionado)
10. [Extensibilidad](#extensibilidad)
11. [Desarrollos Futuros](#desarrollos-futuros)

## Visión General

El diseño de base de datos del CMS Fract2 está construido para proporcionar flexibilidad, rendimiento y seguridad. Soporta múltiples sistemas de bases de datos y utiliza una interfaz abstracta para simplificar el desarrollo y mantenimiento.

## Sistemas de Bases de Datos Soportados

Fract2 CMS actualmente soporta dos sistemas principales de bases de datos:

1. **PostgreSQL**: Un potente sistema de base de datos objeto-relacional de código abierto.
2. **MariaDB**: Un fork desarrollado por la comunidad de MySQL con características mejoradas.

El soporte para ambos sistemas permite a los usuarios elegir el sistema que mejor se adapte a sus necesidades.

## Clases de Conexión a Base de Datos

### PostgresConnection

Archivo: `system/core/database/postgres/PostgresConnection.php`

Funcionalidad:
- Crea una conexión PDO a la base de datos PostgreSQL
- Implementa agrupación de conexiones para mejorar el rendimiento
- Establece configuraciones específicas de la base de datos

Ejemplo de código:
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

Archivo: `system/core/database/mariadb/MariaDBConnection.php`

Funcionalidad:
- Similar a PostgresConnection, pero optimizado para MariaDB
- Implementa opciones de conexión específicas de MariaDB

Ejemplo de código:
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

## Clases de Consulta

### PostgresQuery y MariaDBQuery

Archivos: 
- `system/core/database/postgres/PostgresQuery.php`
- `system/core/database/mariadb/MariaDBQuery.php`

Funcionalidad:
- Operaciones CRUD (Crear, Leer, Actualizar, Eliminar)
- Preparación y ejecución de consultas SQL
- Manejo de prefijos de tabla

Ejemplo de código (PostgresQuery):
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

## Esquema de Base de Datos

El esquema de base de datos del CMS Fract2 es modular y soporta extensión a través de paquetes. Los componentes principales incluyen:

1. **Usuarios y Permisos**
   - users
   - roles
   - permissions
   - user_roles

2. **Contenido**
   - content_types
   - content_items
   - content_revisions

3. **Medios**
   - media_items
   - media_folders

4. **Taxonomía**
   - taxonomies
   - terms

5. **Configuración**
   - config_items

6. **Registro**
   - system_logs

Cada paquete puede añadir sus propias tablas según sea necesario.

## Configuración

La configuración de la base de datos se almacena en `config/database.yaml`:

```yaml
postgresql:
  host: localhost
  port: 5432
  database: fract2_db
  user: fract2_user
  password: contraseña_segura
  
  # Optimizaciones de rendimiento
  config:
    shared_buffers: 256MB
    work_mem: 16MB
    maintenance_work_mem: 128MB
    effective_cache_size: 1GB
    max_connections: 100
    
  # Agrupación de conexiones con PgBouncer
  pgbouncer:
    enabled: true
    max_client_conn: 1000
    default_pool_size: 20

mariadb:
  host: localhost
  port: 3306
  database: fract2_db
  user: fract2_user
  password: contraseña_segura
  
  # Optimizaciones de rendimiento
  config:
    innodb_buffer_pool_size: 256M
    innodb_log_file_size: 64M
    innodb_flush_log_at_trx_commit: 2
    query_cache_size: 64M
    max_connections: 100
    
  # Agrupación de conexiones con ProxySQL
  proxysql:
    enabled: true
    max_connections: 1000
    default_pool_size: 20

cms:
  default_db: postgresql
  table_prefix: f2_
```

## Optimizaciones de Rendimiento

1. **Caché de Consultas**: Implementación de un caché de consultas para reducir la carga de la base de datos.
2. **Agrupación de Conexiones**: Uso de PgBouncer para PostgreSQL y ProxySQL para MariaDB para gestionar eficientemente las conexiones de base de datos.
3. **Estrategia de Indexación**: Planificación e implementación cuidadosa de índices de base de datos para acelerar las consultas.
4. **Optimización de Consultas**: Análisis y optimización regular de las consultas de base de datos.
5. **Particionado**: Implementación de particionado de tablas para grandes conjuntos de datos cuando sea apropiado.

## Consideraciones de Seguridad

1. **Declaraciones Preparadas**: Uso de declaraciones preparadas para todas las consultas de base de datos para prevenir la inyección SQL.
2. **Principio de Mínimo Privilegio**: A los usuarios de la base de datos se les dan solo los permisos que necesitan.
3. **Encriptación**: Los datos sensibles se encriptan en la base de datos.
4. **Registro de Auditoría**: Implementación de registro de auditoría para operaciones sensibles de base de datos.
5. **Copias de Seguridad Regulares**: Copias de seguridad automatizadas y regulares de la base de datos con almacenamiento seguro.

## Migraciones y Versionado

1. **Sistema de Migración**: Implementación de un sistema de migración de base de datos para gestionar cambios de esquema.
2. **Control de Versiones**: Todos los cambios en el esquema de la base de datos están bajo control de versiones.
3. **Capacidad de Reversión**: Cada migración incluye un método de reversión correspondiente.
4. **Pruebas Automatizadas**: Las migraciones se prueban automáticamente en un entorno de pruebas antes de aplicarse a producción.

## Extensibilidad

1. **Extensiones Basadas en Paquetes**: Los paquetes pueden definir sus propias tablas de base de datos y relaciones.
2. **Sistema de Hooks**: Proporciona hooks para que los paquetes modifiquen o extiendan las operaciones de base de datos principales.
3. **Tipos de Campo Personalizados**: Soporte para tipos de campo personalizados que los paquetes pueden definir y usar.

## Desarrollos Futuros

1. **Soporte Multi-base de datos**: Soporte planificado para usar múltiples sistemas de bases de datos simultáneamente.
2. **Sharding**: Implementación de sharding de base de datos para escalado horizontal.
3. **Integración NoSQL**: Integración planificada con bases de datos NoSQL para casos de uso específicos.
4. **Sincronización en Tiempo Real**: Desarrollo de sincronización de base de datos en tiempo real para configuraciones en clúster.
5. **Optimizaciones Impulsadas por IA**: Integración de IA para optimización predictiva de consultas e indexación.

Este diseño de base de datos proporciona una base flexible, segura y de alto rendimiento para el CMS Fract2, con caminos claros para la expansión y optimización futuras.