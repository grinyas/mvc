<?php
/**
 * Created by PhpStorm.
 * User: grinyas
 * Date: 27.12.2016
 * Time: 22:37
 */

namespace Academy\Model;


class UserModel extends BaseModel
{

    public function tableName()
    {
        return 'user';
    }

    public function getPrimaryKey()
    {
        return 'id';
    }
}