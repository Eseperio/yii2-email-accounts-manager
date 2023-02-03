<?php

namespace eseperio\emailManager\controllers;

use app\modules\brand\models\Brand;
use eseperio\emailManager\models\EmailAccount;
use eseperio\emailManager\models\EmailAccountSearch;
use eseperio\emailManager\traits\ModuleAwareTrait;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RemoveController implements the CRUD actions for EmailAccount model.
 */
class AccountController extends Controller
{
    use ModuleAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->view->params['module'] = self::getModule();
        return parent::beforeAction($action);
    }

    /**
     * Lists all EmailAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmailAccount model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EmailAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EmailAccount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EmailAccount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EmailAccount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EmailAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmailAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmailAccount::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('email-manager', 'The requested page does not exist.'));
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionTestSmtp()
    {
        $response = [
            'success' => true,
            'errors' => []
        ];
        $account = Yii::createObject(EmailAccount::class);
        $account->load(Yii::$app->request->post());
        $mailer = Yii::$app->get($this->module->mailer);

        try {
            $smtpTransport = $account->getSmtpTransport();
            $mailer->setTransport($smtpTransport);
            $mailer->transport->start();
        } catch (\Throwable $e) {
            $response['errors'][] = YII_DEBUG ? (string)$e : $e->getMessage();
            $response['success'] = false;
        }

        $mailer->transport->stop();
        return $this->asJson($response);
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionTestImap()
    {
        $response = ['success' => true, 'errors' => []
        ];
        $account = Yii::createObject(EmailAccount::class);
        $account->load(Yii::$app->request->post());
        try {
            $host = $account->incoming_server;
            if (!empty($account->imap_port)) {
                $host .= ":{$account->imap_port}";
            }

            if (!empty($account->imap_encryption)) {
                $host .= "/" . $account->imap_encryption;
            }
            $qualifiedServer = "{" . $host . "}";
            imap_timeout(IMAP_OPENTIMEOUT, 5);
            $stream = \imap_open($qualifiedServer, $account->user, $account->password, OP_HALFOPEN);
            if ($stream === false) {
                $response['errors'] = \imap_errors();
                $response['success'] = false;
                Yii::debug(['IMAP_ERRORS', $response['errors']]);
            }
        } catch (\Throwable $e) {
            $response['errors'] = [$e->getMessage()];
            $response['success'] = false;
        }
        if ($stream !== false) {

//        If no error, configuration is ok. Retrieve mailboxes
            $mailboxes = \imap_getmailboxes($stream, $qualifiedServer, "*");
            $parsedMbNames = [];
            foreach ($mailboxes as $mailbox) {
                $parsedMbNames[] = str_replace($qualifiedServer, '', $mailbox->name);
            }
            $response['mailboxes'] = $parsedMbNames;

        }

        return $this->asJson($response);
    }


}
