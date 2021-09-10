<?php


namespace app\models;


use yii\base\Model;

/**
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $newPasswordConfirmed;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'newPasswordConfirmed'], 'required', 'message' => 'Поле должно быть обязательно заполнено'],
            ['oldPassword', 'validatePassword', 'message' => 'Пароль указан неверно'],
            [['newPassword', 'newPasswordConfirmed'], 'validateConfirmedPassword', 'message' => 'Пароли не совпадают'],
        ];
    }

    public function changePassword()
    {
        if($this->validate()){
            \Yii::$app->user->identity->setPassword($this->newPassword);
            return true;
        }

        return false;
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = \Yii::$app->user->identity;

            if (!$user || !$user->validatePassword($this->oldPassword)) {
                $this->addError($attribute, 'Неверный пароль');
            }
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateConfirmedPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if($this->newPassword != $this->newPasswordConfirmed){
                $this->addError($attribute, 'Passwords non equal');
            }
        }
    }
}