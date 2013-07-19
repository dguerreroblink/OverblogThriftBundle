<?php

namespace Overblog\ThriftBundle\Event;

use Symfony\Component\EventDispatcher\Event;

final class ThriftResponseEvent extends Event
{
	protected $response;
	protected $service;
	protected $method;
	
	public function __construct($service, $method, Array $response)
	{
		$this->service = $service;
		$this->method = $method;
		$this->response = $response;
	}
	
	public function getResponse()
	{
		return $this->response;
	}

	public function getService() {
		return $this->service;
	}
	
	public function getMethod() {
		return $this->method;
	}
	
}

