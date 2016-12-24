<?php

namespace Academy;
/**
 * 
 */
class App
{
	public static $i;
	/**
	 * Database connection.
	 */
	public $db;

	protected $config = [];

	/**
	 * Create instance of app.
	 */
	public function __construct()
	{
		$this->loadConfigFiles();
		$this->init();
		self::$i = $this;
	}

	/**
	 *  Load configuration files.
	 */
	protected function loadConfigFiles()
	{
		$this->config = require_once ROOT_PATH . '/config/config.php';
	}

	protected function init()
	{
		extract($this->config['database']);
		$dsn = "mysql:host={$host};dbname={$dbname}";
		$this->db = new \PDO($dsn, $user, $password);
		// var_dump($this->db);
	}

	public function run()
	{

	}
}