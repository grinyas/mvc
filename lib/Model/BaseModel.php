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

    abstract public function tableName();

    abstract public function getPrimaryKey();

    public function findByPk($id)
    {
        $pk = (array) static::getPrimaryKey();
        $tableName = static::tableName();
        $query = "SELECT * FROM {$tableName} WHERE id = {$id};";

        $statement = App::$i->getComponent('db')->prepare($query);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
}