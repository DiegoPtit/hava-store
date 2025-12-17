<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'only' => ['logout'],
                'rules' => [
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
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Obtener productos destacados basados en rating
        $productosData = Yii::$app->db->createCommand('
            SELECT p.*, m.score, c.titulo as categoria_titulo
            FROM store_product_metrics m
            JOIN productos p ON m.product_id = p.id
            LEFT JOIN categorias c ON p.id_categoria = c.id
            ORDER BY m.score DESC
        ')->queryAll();

        // Si no hay métricas, mostrar los últimos productos agregados
        if (empty($productosData)) {
            $productosData = Yii::$app->db->createCommand('
                SELECT p.*, 0 as score, c.titulo as categoria_titulo
                FROM productos p
                LEFT JOIN categorias c ON p.id_categoria = c.id
                ORDER BY p.id DESC
            ')->queryAll();
        }

        // Convertir array a objetos para mantener compatibilidad con la vista
        $productos = [];
        foreach ($productosData as $data) {
            $obj = (object)$data;
            // Simular relación categoria
            if (isset($data['categoria_titulo'])) {
                $obj->categoria = (object)['titulo' => $data['categoria_titulo']];
            } else {
                $obj->categoria = null;
            }
            $productos[] = $obj;
        }

        // Obtener tasas de cambio
        $precioOficialData = Yii::$app->db->createCommand('
            SELECT * FROM historico_precios_dolar 
            WHERE tipo = "OFICIAL" 
            ORDER BY created_at DESC 
            LIMIT 1
        ')->queryOne();
        
        $precioParaleloData = Yii::$app->db->createCommand('
            SELECT * FROM historico_precios_dolar 
            WHERE tipo = "PARALELO" 
            ORDER BY created_at DESC 
            LIMIT 1
        ')->queryOne();

        $precioOficial = $precioOficialData ? (object)$precioOficialData : null;
        $precioParalelo = $precioParaleloData ? (object)$precioParaleloData : null;

        // Obtener categorías con imágenes de muestra
        $categoriasDb = Yii::$app->db->createCommand('SELECT * FROM categorias ORDER BY titulo')->queryAll();
        $categoriasData = [];

        foreach ($categoriasDb as $cat) {
            // Buscar productos de esta categoría para extraer imágenes
            // Priorizar productos que tengan fotos
            $productosImg = Yii::$app->db->createCommand('
                SELECT fotos FROM productos 
                WHERE id_categoria = :id 
                ORDER BY (CASE WHEN fotos IS NOT NULL AND fotos != "[]" THEN 1 ELSE 0 END) DESC, id DESC
                LIMIT 10
            ')->bindValue(':id', $cat['id'])->queryAll();
            
            $imagenes = [];
            foreach ($productosImg as $prod) {
                if (!empty($prod['fotos'])) {
                    $decoded = json_decode($prod['fotos'], true);
                    if (is_array($decoded)) {
                        foreach ($decoded as $foto) {
                            $imagenes[] = $foto;
                            if (count($imagenes) >= 3) break 2;
                        }
                    }
                }
            }
            
            // Se mostrará la categoría aunque no tenga imágenes (con placeholder en vista)
            $categoriasData[] = (object)[
                'id' => $cat['id'],
                'titulo' => $cat['titulo'],
                'imagenes' => $imagenes
            ];
        }

        return $this->render('index', [
            'productos' => $productos,
            'categorias' => $categoriasData,
            'precioOficial' => $precioOficial,
            'precioParalelo' => $precioParalelo,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
