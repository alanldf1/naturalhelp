<?php

/**
*
* Helper que serve para adicionar a url em um arquivo ou link.
*
* @author Emprezaz.com
* 
**/
class URLHelper
{

	protected $title;
	protected $styles;
	protected $scripts;

	public function __construct()
	{

		$this->styles  = array();
		$this->scripts = array();

	}

	public function getAllParameters(){
		$link = explode('/', $_SERVER["REQUEST_URI"]);

		return $link;
	}

	public function urlAll()
	{
		# code...
	}

	public function getURL($file = null)
	{

		$url = (ENV === 'dev') ? LOCAL_URL : '/';
		$url = rtrim($url, '/');

		if(is_null($file)){
			return $url;
		}
 
		$file = ltrim($file, '/');
		$file = $url . '/' . $file;

		return $file;

	}

	public function getLocation()
	{
		
		$url = $_SERVER['REQUEST_URI'];

		$path = LOCAL_URL;

		// if(ENV !== 'local' || ENV !== 'prod'){

		// 	$url = str_replace(array($path, "/"), "", $url);


		// }	

		$url = ltrim($url, '/');

		if(strstr($url, '/')){

			$url = explode("/", $url);
			$path = $url[1];
			return $path;

		}	
		return $url;

	}

	public function getLocationAdmin()
	{
		
		$url = $_SERVER['REQUEST_URI'];

		$path = LOCAL_URL;

		if(ENV !== 'local' || ENV !== 'prod'){

			$url = str_replace(array($path, "/"), "", $url);


		}	

		$url = ltrim($url, '/');

		if(strstr($url, '/')){
			
			$url = explode("/", $url);
			$path = $url[0];
			return $path;

		}	
		return $url;

	}

	public function setTitle($title = null)
	{

		$this->title = $title;

	}

	public function getTitle()
	{

		echo $this->title;

	}

	public function setStyles($style)
	{

		foreach($style as $value){
			array_push($this->styles, $value);
		}

	}

	public function getStyles()
	{

		foreach($this->styles as $value)
		{
			echo '<link rel="stylesheet" type="text/css" href="'.$this->getURL().'/'.$value.'">';
		}

	}

	public function setScripts($script)
	{

		foreach($script as $value){
			array_push($this->scripts, $value);
		}

	}

	public function getScripts()
	{

		foreach($this->scripts as $value)
		{	

			if(stripos($value, 'https://') === false && stripos($value, 'http://') === false){
		
				echo '<script defer type="text/javascript" src="'.$this->getURL() . '/' .$value.'"></script>';

			}else{

				echo '<script defer type="text/javascript" src="'.$value.'"></script>';
			
			}
		}



	}

}