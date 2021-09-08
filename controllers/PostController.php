<?php


namespace app\controllers;

use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Post;
use app\models\PostForm;

class PostController extends Controller
{

    public function behaviors()
    {
        return [
            'access' =>[
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['user', 'admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['new', 'edit'],
                        'roles' => ['user', 'admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['remove'],
                        'roles' => ['admin'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Post::find()->with('user');
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4]);
        $posts = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('posts', 'pages'));
    }

    public function actionNew()
    {
        $model = new PostForm();

        if ($model->load(\Yii::$app->request->post())) {
            $params = \Yii::$app->getRequest()->getBodyParams()['PostForm'];

            $post = new Post();
            $post->name = $params['name'];
            $post->description = $params['description'];
            $post->user_id = \Yii::$app->user->id;
            $post->save();

            return $this->actionIndex();
        }

        return $this->render('new', [
            'model' => $model,
        ]);

    }

    public function actionRemove()
    {
        $params = \Yii::$app->getRequest()->getQueryParams();
        $postId = $params['id'];

        $postForRemoving = Post::findOne(['id' => $postId]);

        if(isset($postForRemoving)) {
            $postForRemoving->delete();
        }

        return $this->actionIndex();
    }

    public function actionEdit()
    {
        $params = \Yii::$app->getRequest()->getQueryParams();
        $postId = $params['id'];

        $postForEdit = Post::findOne(['id' => $postId]);

        $model = new PostForm();
        if($model->load(\Yii::$app->request->post())) {
            $params = \Yii::$app->getRequest()->getBodyParams()['PostForm'];

            if($model->validate()) {
                $transaction = Post::getDb()->beginTransaction();
                try {
                    $samePost = Post::findOne(['name' => $params['name']]);
                    $alreadyExistCondition = isset($samePost);

                    if(!$alreadyExistCondition) {
                        $postForEdit->name = $params['name'];
                        $postForEdit->description = $params['description'];
                        $postForEdit->save();
                    }

                } catch(\Exception $e)
                {
                    $transaction->rollback();
                    throw $e;
                }
            }

            return $this->actionIndex();
    }
        return $this->render('edit', [
            'model' => $model, 'post' => $postForEdit,
        ]);

    }

}