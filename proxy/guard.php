<?php

namespace Proxy\Guard;

interface IRequest
{
	function create($url, $params);
	function send();
	function getResult();
}

class RequestProxy implements IRequest
{
	/**
	 * Класс, который проксируется
	 * @var Request
	 */
	private $requestService;
	
	/** Запрос */
	private $request;
	
	/** Результат выполненного запроса */
	private $result;
	
	function __construct()
	{
		/**
		 * Откладываем создание объекта Request до тех пор,
		 * пока он нам действительно не понадобится.
		 */
		$this->requestService = null;
	}
	/*
	 * Но на данном этапе мы обеспечиваем безопасность данных.
	 */
	function create($url, $params)
	{
		/* Какие-то действия для безопасности */
		$params = http_build_query(urlencode($params));
		
		/* И теперь уже создаем объект Request */
		$this->requestService= new Request();
		$this->requestService->create($url, $params);
		
		/* For fluent API */
		return $this;
	}
	
	function send()
	{
		/**
		 * Если объект Request еще не был создан, то создаем.
		 */
		if (empty($this->requestService)) {
			$this->requestService = new Request($this->request);
		}
		
		/**
		 * Проксируем вызываемый метод в объект Request
		 */
		$this->requestService->send();
	}
	
	function getResult()
	{
		if (empty($this->requestService)) {
			throw new \Exception('You can not get result of empty request');
		}
		
		$this->result = $this->requestService->getResult();
		
		return $this->result;
	}
}

class Request implements IRequest
{
	private $request;
	private $result;
	
	function create($url, $params)
	{
		$this->request = $url . $params;
	}
	
	function send()
	{
		$this->result = http_get($this->request);
	}
	
	function getResult()
	{
		return $this->result;
	}
}

$request = (new RequestProxy())->create(
	'http://fabrikant.ru/auth',
	['user' => 1, 'firm' => 1]
)->getResult();