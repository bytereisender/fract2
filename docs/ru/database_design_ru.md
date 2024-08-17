# Дизайн базы данных CMS Fract2

## Содержание
1. [Обзор](#обзор)
2. [Поддерживаемые системы баз данных](#поддерживаемые-системы-баз-данных)
3. [Классы подключения к базе данных](#классы-подключения-к-базе-данных)
4. [Классы запросов](#классы-запросов)
5. [Схема базы данных](#схема-базы-данных)
6. [Конфигурация](#конфигурация)
7. [Оптимизация производительности](#оптимизация-производительности)
8. [Вопросы безопасности](#вопросы-безопасности)
9. [Миграции и версионирование](#миграции-и-версионирование)
10. [Расширяемость](#расширяемость)
11. [Будущие разработки](#будущие-разработки)

## Обзор

Дизайн базы данных CMS Fract2 разработан для обеспечения гибкости, производительности и безопасности. Он поддерживает несколько систем баз данных и использует абстрактный интерфейс для упрощения разработки и обслуживания.

## Поддерживаемые системы баз данных

CMS Fract2 в настоящее время поддерживает две основные системы баз данных:

1. **PostgreSQL**: Мощная объектно-реляционная система управления базами данных с открытым исходным кодом.
2. **MariaDB**: Форк MySQL, разработанный сообществом, с расширенными возможностями.

Поддержка обеих систем позволяет пользователям выбрать наиболее подходящую для их потребностей.

## Классы подключения к базе данных

### PostgresConnection

Файл: `system/core/database/postgres/PostgresConnection.php`

Функциональность:
- Создает PDO-подключение к базе данных PostgreSQL
- Реализует пулинг соединений для улучшения производительности
- Устанавливает специфические для базы данных конфигурации

Пример кода:
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

Файл: `system/core/database/mariadb/MariaDBConnection.php`

Функциональность:
- Аналогично PostgresConnection, но оптимизировано для MariaDB
- Реализует специфические для MariaDB опции подключения

Пример кода:
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

## Классы запросов

### PostgresQuery и MariaDBQuery

Файлы: 
- `system/core/database/postgres/PostgresQuery.php`
- `system/core/database/mariadb/MariaDBQuery.php`

Функциональность:
- CRUD операции (Create, Read, Update, Delete)
- Подготовка и выполнение SQL-запросов
- Обработка префиксов таблиц

Пример кода (PostgresQuery):
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

## Схема базы данных

Схема базы данных CMS Fract2 модульна и поддерживает расширение через пакеты. Основные компоненты включают:

1. **Пользователи и разрешения**
   - users
   - roles
   - permissions
   - user_roles

2. **Контент**
   - content_types
   - content_items
   - content_revisions

3. **Медиа**
   - media_items
   - media_folders

4. **Таксономия**
   - taxonomies
   - terms

5. **Конфигурация**
   - config_items

6. **Логирование**
   - system_logs

Каждый пакет может добавлять свои собственные таблицы по мере необходимости.

## Конфигурация

Конфигурация базы данных хранится в `config/database.yaml`:

```yaml
postgresql:
  host: localhost
  port: 5432
  database: fract2_db
  user: fract2_user
  password: secure_password
  
  # Оптимизации производительности
  config:
    shared_buffers: 256MB
    work_mem: 16MB
    maintenance_work_mem: 128MB
    effective_cache_size: 1GB
    max_connections: 100
    
  # Пулинг соединений с PgBouncer
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
  
  # Оптимизации производительности
  config:
    innodb_buffer_pool_size: 256M
    innodb_log_file_size: 64M
    innodb_flush_log_at_trx_commit: 2
    query_cache_size: 64M
    max_connections: 100
    
  # Пулинг соединений с ProxySQL
  proxysql:
    enabled: true
    max_connections: 1000
    default_pool_size: 20

cms:
  default_db: postgresql
  table_prefix: f2_
```

## Оптимизация производительности

1. **Кэширование запросов**: Реализация кэша запросов для уменьшения нагрузки на базу данных.
2. **Пулинг соединений**: Использование PgBouncer для PostgreSQL и ProxySQL для MariaDB для эффективного управления соединениями с базой данных.
3. **Стратегия индексирования**: Тщательное планирование и реализация индексов базы данных для ускорения запросов.
4. **Оптимизация запросов**: Регулярный анализ и оптимизация запросов к базе данных.
5. **Партиционирование**: Реализация партиционирования таблиц для больших наборов данных, где это уместно.

## Вопросы безопасности

1. **Подготовленные запросы**: Использование подготовленных запросов для всех операций с базой данных для предотвращения SQL-инъекций.
2. **Принцип наименьших привилегий**: Пользователям базы данных предоставляются только необходимые разрешения.
3. **Шифрование**: Чувствительные данные шифруются в базе данных.
4. **Аудит**: Реализация аудита для чувствительных операций с базой данных.
5. **Регулярные резервные копии**: Автоматизированные, регулярные резервные копии базы данных с безопасным хранением.

## Миграции и версионирование

1. **Система миграций**: Реализация системы миграций базы данных для управления изменениями схемы.
2. **Контроль версий**: Все изменения схемы базы данных контролируются версиями.
3. **Возможность отката**: Каждая миграция включает соответствующий метод отката.
4. **Автоматизированное тестирование**: Миграции автоматически тестируются в промежуточной среде перед применением в продакшене.

## Расширяемость

1. **Расширения на основе пакетов**: Пакеты могут определять свои собственные таблицы базы данных и отношения.
2. **Система хуков**: Предоставляет хуки для пакетов, чтобы модифицировать или расширять основные операции с базой данных.
3. **Пользовательские типы полей**: Поддержка пользовательских типов полей, которые пакеты могут определять и использовать.

## Будущие разработки

1. **Поддержка нескольких баз данных**: Планируемая поддержка использования нескольких систем баз данных одновременно.
2. **Шардинг**: Реализация шардинга базы данных для горизонтального масштабирования.
3. **Интеграция NoSQL**: Планируемая интеграция с базами данных NoSQL для специфических случаев использования.
4. **Синхронизация в реальном времени**: Разработка синхронизации базы данных в реальном времени для кластерных конфигураций.
5. **Оптимизации на основе ИИ**: Интеграция ИИ для прогнозирующей оптимизации запросов и индексирования.

Этот дизайн базы данных обеспечивает гибкую, безопасную и производительную основу для CMS Fract2, с ясными путями для будущего расширения и оптимизации.