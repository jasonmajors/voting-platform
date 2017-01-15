<?php

namespace Controllers;

use \Jaywrap\Jaywrap;

abstract class JmController
{
	protected $db = '';
	protected $table = '';
	
	public function __construct() 
	{
		$this->db = new Jaywrap();
		// Get the controller name as a string without the namespace
		$controller = str_replace("Controllers\\", "", get_class($this));
		// Strip 'Controller' off the end
		$table = strstr($controller, "Controller", true);
		// Lowercase
		$this->table = strtolower($table);
	}
}