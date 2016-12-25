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

    /**
     * @var
     */
	public $config;

    /**
     * @var
     */
    public $request;
	/**
	 * Create instance of app.
	 */
	public function __construct()
	{
		$this->init();
		self::$i = $this;
	}

    /**
     * Inits generic components.
     */
    protected function init()
    {
        foreach (static::coreComponents() as $prop => $component)
        {
            $this->{$prop} = $component;
        }
    }

	protected function coreComponents()
	{
        $configFile =  ROOT_PATH . '/config/config.php';
        $config = new Application\Config($configFile);

        extract($config->get('database'));
        $dsn = "mysql:host={$host};dbname={$dbname}";
        $db = new \PDO($dsn,$user, $password);

        $request = new Application\Web\Request();

		return [
		    'config' => $config,
            'db' => $db,
            'request' => $request,
        ];
	}

	public function run()
	{
        $this->request->handleRequest();
	}
}