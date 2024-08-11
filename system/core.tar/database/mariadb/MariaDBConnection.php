<?php
namespace Fract2\Core\Database\MariaDB;

/**
 * This file is part of Fract2 CMS.
 *
 * (c) Vivian Burkhard Voss
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

class MariaDBConnection
{
	private $connection;
	private $config;

	public function __construct(array $config)
	{
		$this->config = $config;
	}

	public function connect()
	{
		$dsn = "mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['database']};charset=utf8mb4";
		$options = [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
			\PDO::ATTR_EMULATE_PREPARES => false,
			\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
		];

		try {
			$this->connection = new \PDO($dsn, $this->config['user'], $this->config['password'], $options);
			
			// Setze Performance-Optimierungen
			$this->setPerformanceConfigs();

			return $this->connection;
		} catch (\PDOException $e) {
			throw new \Exception("Verbindung zur Datenbank fehlgeschlagen: " . $e->getMessage());
		}
	}

	private function setPerformanceConfigs()
	{
		if (isset($this->config['config'])) {
			foreach ($this->config['config'] as $key => $value) {
				$this->connection->exec("SET GLOBAL $key = $value");
			}
		}
	}

	public function getConnection()
	{
		if (!$this->connection) {
			$this->connect();
		}
		return $this->connection;
	}

	public function close()
	{
		$this->connection = null;
	}
}