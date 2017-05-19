<?php

namespace Main\WithoutAdapter;

interface DbInterface
{
	function select();
	function update();
	function delete();
	function create();
}

/**
 * Текущий клиент к БД, который реализует уже существующий интерфейс.
 * Напрямую из клиента вызываются методы удаленной библиотеки.
 * Менять интерфейс мы не можем.
 */
class DbClient implements DbInterface
{
	private $client;

	function __construct()
	{
		$this->client = new OldMysqlDb();
	}

	function select()
	{
		$this->client->select();
	}

	function update()
	{
		$this->client->update();
	}

	function delete()
	{
		$this->client->delete();
	}

	function create()
	{
		$this->client->create();
	}
}

/**
 * Удаленная библиотека.
 */
class OldMysqlDb
{
	function select()
	{
		// do some complicated things
	}

	function update()
	{
		// do some complicated things
	}

	function create()
	{
		// do some complicated things
	}

	function delete()
	{
		// do some complicated things
	}
}
