<?php

namespace App\Core\Database;
use \PDO;

class QueryBuilder
{
	protected $pdo;
	protected $sql;
	protected $bind;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
		$this->select = null;
		$this->table = null;
		$this->where = null;
		$this->orderBy = null;
		$this->bind = [];
	}

	public function table($table)
	{
		$this->table = $table;

		return $this;
	}

	public function select($fields = '*')
	{
		$select = (is_array($fields) ? implode(', ', $fields) : $fields);
		$this->select = $this->select == null ? $select : $this->select . ", " . $select;

		return $this;
	}

	public function where($field, $op, $value)
	{
		$this->where = "{$field} {$op} :{$field}";
		$this->bind[":{$field}"] = $value;
		return $this;
	}

	public function orderBy($field, $order = 'asc')
	{
		$order = strtoupper($order);
		$this->orderBy = "{$field} {$order}";

		return $this;
	}

	public function getAll($bindClass = null)
	{
		$sql = 'SELECT ' . $this->select . ' FROM ' . $this->table;


		if (! is_null($this->where)) {
			$sql .= ' WHERE ' . $this->where;
		}

		if (! is_null($this->orderBy)) {
			$sql .= ' ORDER BY ' . $this->orderBy;
		}


		$statement = $this->pdo->prepare($sql);
		$statement->execute($this->bind);
		if (!is_null($bindClass)) {
			$result = $statement->fetchAll(PDO::FETCH_CLASS, $bindClass);
		} else {
			$result = $statement->fetchAll(PDO::FETCH_OBJ);
		}		
		$this->reset();
		return $result;
	}

	protected function reset()
	{
		$this->select = null;
		$this->table = null;
		$this->where = null;
		$this->orderBy = null;
		$this->bind = [];
	}

	public function insert(array $data)
	{
		$sql = sprintf(
			"INSERT INTO %s (%s) VALUES (%s)",
			$this->table,
			implode(', ', array_keys($data)),
			':' . implode(', :', array_keys($data))
		);
		$this->reset();
		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($data);
			$id = $this->pdo->lastInsertId();
			return $id;
		} catch (PDOException $e) {
			$this->pdo->rollback();
			die('An unexpected error has occurred');
		}
	}
}