<?php
namespace Helpers;

class Router
{
	/**
	* The base URI of the site. Generally this will be an empty string
	*/
	protected $base_url;

	/**
	* The request path
	*/
	protected $uri;

	protected $routes = [];


	public function __construct($base_url='')
	{
		$this->base_url = $base_url;
		$this->uri = $this->parseRequest();
	}


	/**
	* Parses the request path from the request URI
	*
	* @return string 
	*/
	private function parseRequest()
	{
		$uri = $_SERVER['REQUEST_URI'];
		// Remove the base URI if it qeusts
		if ($this->base_url) {
			$uri = str_replace($this->base_url, '', $uri);
		}
		// Remove query string off URI if exists
		$querystring = strpos($uri, '?');
		if ($querystring !== false) {
			$uri = strstr($uri, '?', true); 
		}

		return $uri;
	}


	/**
	* Map URIs to controller methods
	* @todo need to be able to handle different requests on the same URI
	* @param string $uri
	* @param string $controller
	* @param string $method
	* @param string $action
	* @param array  $args
	* @return void
	*/
	public function setRoute($uri, $controller, $method, $action, array $args = null)
	{
		// Wouldn't need to prepend the Controllers namespace in php 5.5+ so we could use MyClass::class to get a full class name string
		$this->routes[$uri] = ['controller' =>  "Controllers\\" . $controller, 'action' => $action, 'method' => $method, 'args' => $args];
	}


	/**
	* Run the specified controller and action for the URI
	* @todo need to be able to handle multiple controllers/actions/args on the same uri
	* @return void
	*/
	public function run()
	{
		$controller = new $this->routes[$this->uri]['controller'];
		$action 	= $this->routes[$this->uri]['action'];
		$args       = $this->routes[$this->uri]['args'];
		$results    = $controller->$action($args);
		
		$view       = array_shift($results);
		// Should only be 1 array of args to pass
		if (count($results) > 1) {
			throw new \Exception("Invalid array returned by controller. Can only have 1 array of variables to pass to the view");
		}
		// Set the variables passed from the controller
		extract($results[0]); 
		// Display the view
		require_once $view;
	}
}