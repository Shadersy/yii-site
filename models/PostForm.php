<?php


namespace app\models;


use yii\base\Model;

class PostForm extends Model
{
    public $name;
    public $description;

    public function rules(){

      return  [
                [
                    ['name'], 'required', 'message' => 'Название поста должно быть заполнено'
                ],
                [
                    ['name'], 'string', 'max' => 50,
                ],
                [
                    ['name'], 'unique',
                ]
          ];
    }
}