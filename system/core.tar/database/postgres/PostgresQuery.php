<?php
namespace Fract2\Core\Database\Postgres;

/**
 * This file is part of Fract2 CMS.
 *
 * (c) Vivian Burkhard Voss
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

class PostgresQuery
{
	private $connection;
	private $tablePrefix;

	public function __construct(PostgresConnection $connection, string $tablePrefix)
	{
		$this->connection = $connection->getConnection();
		$this->tablePrefix = $tablePrefix;
	}

	public function select(string $table, array $columns = ['*'], array $where = [], array $orderBy = [], int $limit = null, int $offset = null)
	{
		$table = $this->tablePrefix . $table;
		$columns = implode(', ', $columns);
		$sql = "SELECT $columns FROM $table";

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

	public function insert(string $table, array $data)
	{
		$table = $this->tablePrefix . $table;
		$columns = implode(', ', array_keys($data));
		$values = ':' . implode(', :', array_keys($data));

		$sql = "INSERT INTO $table ($columns) VALUES ($values)";
		
		$stmt = $this->connection->prepare($sql);
		$stmt->execute($data);
		return $this->connection->lastInsertId();
	}

	public function update(string $table, array $data, array $where)
	{
		$table = $this->tablePrefix . $table;
		$set = [];
		foreach ($data as $column => $value) {
			$set[] = "$column = :$column";
		}
		$set = implode(', ', $set);

		$sql = "UPDATE $table SET $set WHERE " . $this->buildWhereClause($where);

		$stmt = $this->connection->prepare($sql);
		$stmt->execute(array_merge($data, $where));
		return $stmt->rowCount();
	}

	public function delete(string $table, array $where)
	{
		$table = $this->tablePrefix . $table;
		$sql = "DELETE FROM $table WHERE " . $this->buildWhereClause($where);

		$stmt = $this->connection->prepare($sql);
		$stmt->execute($where);
		return $stmt->rowCount();
	}

	private function buildWhereClause(array $where)
	{
		$conditions = [];
		foreach ($where as $column => $value) {
			$conditions[] = "$column = :$column";
		}
		return implode(' AND ', $conditions);
	}
}