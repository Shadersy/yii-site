<?php


namespace app\controllers;
use yii\web\Application;
use yii\web\Controller;
use yii\web\Response;
use app\models\SignupForm;
use app\models\LoginForm;


class UserController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $user = $model->login()) {
            return \Yii::$app->runAction('post/index');
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if($model->load(\Yii::$app->request->post())){
            if($user = $model->signup()){
                \Yii::$app->getSession()->setFlash('success', 'Вы успешно зарегистрировались!');

                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $user->getId());

                return \Yii::$app->runAction('post/index');
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}