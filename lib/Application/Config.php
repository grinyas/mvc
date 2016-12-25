<?php

namespace Academy\Application;
use Psr\Log\InvalidArgumentException;

/**
 * Application configuration class
 * @package Academy\Application
 */
class Config
{

    /**
     * Initiate configuration array from config.php
     *
     * @var array
     */
    protected $config = [];

    /**
     * Config constructor initiate configuration components.
     *
     * @param string $configFile Configuration filename.
     */
    public function __construct($configFile)
    {

        if(empty($configFile)){
            throw new \BadMethodCallException('Configuration file is empty');
        }

        if(!file_exists($configFile)
        ||  !is_readable($configFile)
        ){
            throw new InvalidArgumentException('Config file don\'t readable');
        }

        $this->config = require_once ($configFile);
    }

    /**
     * Return configuration item
     *
     * @param string $path Config item path
     *
     * @return mixed
     */
    public function get($path)
    {
        return array_key_exists($path, $this->config)
            ? $this->config[$path]
            : null;
    }
}
