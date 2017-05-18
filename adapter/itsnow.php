<?php

namespace Main\WithAdapter;

interface DbInterface
{
	function select($condition);
	function update($condition);
	function delete($condition);
	function create($data);
}

/**
 * Удаленная библиотека.
 * Рраз и API изменился! Что делать?!
 */
class NewMysqlDb
{
	public function query(string $query) : array
	{
		// do some complicated things
		return [];
	}
	
	public function selectOne(string $query) : array
	{
		// do some complicated things
		return [];
	}
	
	public function delete(array $condition) : bool
	{
		// do some complicated things
		return true;
	}
}

/**
 * Текущий клиент к БД, который реализует уже существующий интерфейс.
 * Переписывать клиент нам не дадут, он уже используется по всей системе.
 */
class MysqlClient implements DbInterface
{
	private $adapter;
	
	function __construct()
	{
		$this->adapter = new MysqlAdapter();
	}
	
	function select($condition)
	{
		$this->adapter->select($condition);
	}
	
	function update($condition)
	{
		$this->adapter->update($condition);
	}
	
	function delete($condition)
	{
		$this->adapter->delete($condition);
	}
	
	function create($data)
	{
		$this->adapter->create($data);
	}
}

/**
 * Этот адаптер позволяет общаться объектам с разными интерфейсами.
 */
class MysqlAdapter implements DbInterface
{
	private $mysqlDb;
	
	function __construct()
	{
		$this->mysqlDb = new NewMysqlDb();
	}
	
	function select($condition)
	{
		$this->mysqlDb
			->query('SELECT * FROM table WHERE ' . implode(' AND ', $condition));
	}
	
	function update($condition)
	{
		// TODO: Implement update() method.
	}
	
	function delete($condition)
	{
		$this->mysqlDb->delete($condition);
	}
	
	function create($data)
	{
		// TODO: Implement create() method.
	}
}

$db = (new MysqlClient())->select(['id' => 1, 'name' => 'Nick']);