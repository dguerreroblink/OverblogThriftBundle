<?php

namespace Overblog\ThriftBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Thrift\Exception\TException;

final class ThriftExceptionEvent extends Event
{
	protected $exception;
	protected $service;
	protected $method;
	
	public function __construct($service, $method, TException $exception)
	{
		$this->service = $service;
		$this->method = $method;
		$this->exception = $exception;
	}
	
	public function getException()
	{
		return $this->exception;
	}

	public function getService() {
		return $this->service;
	}
	
	public function getMethod() {
		return $this->method;
	}
	
}

