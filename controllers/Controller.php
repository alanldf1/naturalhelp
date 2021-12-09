<?php

/**
*
* Controller que pode ser extendido por outros
* controllers para fornecer funcionalidades comuns.
*
* @author Emprezaz.com
*
**/
abstract class Controller
{

	private $layout;
	protected $helpers;

	public function __construct(array $helpers = array())
	{

		$this->helpers = $helpers;

	}

	protected function setLayout($filename, $title = null, $styles = null, $scripts = null)
	{

		$this->helpers['URLHelper']->setTitle($title);
		$this->helpers['URLHelper']->setStyles($styles);
		$this->helpers['URLHelper']->setScripts($scripts);
		$this->layout = $filename;

	}

	protected function view($filename, array $data = array())
	{

		$path = ROOT . '/views/';
		$file = $path . $filename;

		extract($data);

		if(!is_null($this->layout)){
			return require $path . $this->layout;
		}

		require $file;

	}

	protected function getId(array $params)
	{

		$this->helpers['URLControl']->checkId($params, $this->helpers['URLHelper']->getURL('404'));
		$id = (int) $params[0];

		return $id;

	}

}