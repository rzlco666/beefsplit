<?php

namespace frontend\controllers;

use common\components\SessionFlash;
use common\models\Dataset;
use common\models\Prediksi;
use common\models\Profile;
use common\models\User;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\db\Query;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'landing';
            return $this->render('landing');
        } else {
            $count_user = User::find()->count();
            $count_predict = Prediksi::find()->count();
            $count_dataset = Dataset::find()->count();

            $prediksi = Yii::$app->db->createCommand("SELECT IFNULL(COUNT(id), 0) jumlah_prediksi, DATE_FORMAT(date_created,'%M %Y') as bulan FROM prediksi GROUP BY DATE_FORMAT(date_created,'%M %Y') ORDER BY DATE_FORMAT(date_created,'%M %Y')")->queryAll();

            return $this->render('index', [
                'count_user' => $count_user,
                'count_predict' => $count_predict,
                'count_dataset' => $count_dataset,
                'grafik_prediksi' => $prediksi,
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'auth';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()){
                $getProfile = Profile::find()->where(['id_user' => Yii::$app->user->id])->one();
                SessionFlash::sessionSuccessCustom('Welcome back, ' . $getProfile->nama);
            }else{
                SessionFlash::sessionErrorCustom('Login failed, please check your username and password');
            }
            return $this->redirect(['/site/login']);
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                SessionFlash::sessionSuccessCustom('Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                SessionFlash::sessionErrorCustom('There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'auth';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            SessionFlash::sessionSuccessCustom('Thank you for registration. Please check your inbox for verification email.');
            return $this->redirect(['site/success']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionSuccess()
    {
        $this->layout = 'auth';

        return $this->render('success', [
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                SessionFlash::sessionSuccessCustom('Check your email for further instructions.');
                return $this->goHome();
            }

            SessionFlash::sessionErrorCustom('Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            SessionFlash::sessionSuccessCustom('New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            SessionFlash::sessionSuccessCustom('Your email has been confirmed!');
            return $this->goHome();
        }

        SessionFlash::sessionErrorCustom('Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                SessionFlash::sessionSuccessCustom('Check your email for further instructions.');
                return $this->goHome();
            }
            SessionFlash::sessionErrorCustom('Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
