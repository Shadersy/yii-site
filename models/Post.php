<?php


namespace app\models;


use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
   public static function tableName()
   {
       return 'post';
   }

   public function getUser()
   {
       return $this->hasOne(User::class, ['id' => 'user_id']);
   }
}