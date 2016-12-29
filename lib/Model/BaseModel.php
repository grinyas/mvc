<?php
/**
 * Created by PhpStorm.
 * User: grinyas
 * Date: 27.12.2016
 * Time: 22:10
 */

namespace Academy\Model;

use Academy\App;

abstract class BaseModel
{

    protected $attributes = [];

    abstract public function tableName();

    abstract public function getPrimaryKey();

    public function findByPk($id)
    {
        $pk = (array) static::getPrimaryKey();
        $tableName = static::tableName();
        $query = "SELECT * FROM {$tableName} WHERE id = {$id}";

        $statement = App::$i->getComponent('db')->prepare($query);
        $statement->execute();

//        $result = $statement->fetch(\PDO::FETCH_ASSOC);
//        $result = $statement->fetchObject(static::class);
        return $statement->rowCount()
                ? $statement->fetchObject(static::class)
                : null;
    }

    /**
     * Magic getter
     *
     * @param string $name attribute name
     * @return mixed|null
     */
    public function __get($name)
    {
        return isset($this->attributes[$name])
                ? $this->attributes[$name]
                : null;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}