<?php

namespace Overblog\ThriftBundle\WrapHandler;

use Overblog\ThriftBundle\Event\ThriftExceptionEvent;
use Overblog\ThriftBundle\Event\ThriftResponseEvent;
use Overblog\ThriftBundle\Event\ThriftRequestEvent;
use Overblog\ThriftBundle\Event\ThriftEvents;
use Thrift\Exception\TException;

class WrapHandler {
	
	protected $_handler;
	protected $_dispacher;
	
	public function __construct($handler,$dispacher){
		$this->_handler = $handler;
		$this->_dispacher = $dispacher;
	}
	
	
	public function __call($method, $args) {
		
		$service = get_class($this->_handler);
		
		$this->_dispacher->dispatch(ThriftEvents::THRIFT_REQUEST,
				new ThriftRequestEvent($service, $method, $args));

		try{
			$return = call_user_func_array(array($this->_handler, $method), $args);
		}catch (TException $e){
			$this->_dispacher->dispatch(ThriftEvents::THRIFT_EXCEPTION,
					new ThriftExceptionEvent($service, $method, $e));
			
			throw $e;
		}
		
		
		$this->_dispacher->dispatch(ThriftEvents::THRIFT_RESPONSE,
				new ThriftResponseEvent($service, $method, array($return)));
		
		return $return;
	}
}









