<?php

namespace Overblog\ThriftBundle\Event;

use Symfony\Component\EventDispatcher\Event;

final class ThriftRequestEvent extends Event
{
	protected $request;
	protected $service;
	protected $method;
	
	public function __construct($service, $method, Array $request)
	{
		$this->service = $service;
		$this->method = $method;
		$this->request = $request;
	}
	
	public function getRequest()
	{
		return $this->request;
	}

	public function getService() {
		return $this->service;
	}
	
	public function getMethod() {
		return $this->method;
	}
	
}

