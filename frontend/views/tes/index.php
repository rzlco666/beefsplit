<?php

use common\components\Breadcrumb;
use denkorolkov\ajaxcrud\BulkButtonWidget;
use denkorolkov\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tes';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
    <div class="page-header">
        <div class="row align-items-end">
            <?= Breadcrumb::levelDua($this->title, 'Dashboard', Url::home()) ?>
            <div class="col-sm-auto">
                <?= Html::a('<i class="bi-plus me-1"></i> Create Tes', ['create'],
                    ['role' => 'modal-remote', 'title' => 'Create new Tes', 'class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div id="ajaxCrudDatatable">
            <?= GridView::widget([
                'id' => 'crud-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax' => true,
                'columns' => require(__DIR__ . '/_columns.php'),
                'toolbar' => [
                    ['content' =>
                        Html::a('<i class="bi-arrow-clockwise"></i>', [''],
                            ['data-pjax' => 1, 'class' => 'btn btn-secondary', 'title' => 'Reset Grid']) .
                        '{toggleData}' .
                        '{export}'
                    ],
                ],
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panel' => [
                    'type' => 'light',
                    'heading' => '<h4 class="card-header-title">'.$this->title.'</h4>',
                    'before' => '<em>' . '* Resize table columns just like a spreadsheet by dragging the column edges.' . '</em>',
                    'after' => BulkButtonWidget::widget([
                        'buttonText' => '<span class="fas fa-arrow-right"></span>&nbsp;&nbsp;' . 'With selected' . '&nbsp;&nbsp;',
                        'buttons' => Html::a('<i class="fas fa-trash"></i>&nbsp;' . 'Delete All',
                            ["bulkdelete"],
                            [
                                "class" => "btn btn-danger btn-xs",
                                'role' => 'modal-remote-bulk',
                                'data-confirm' => false, 'data-method' => false,// for overide yii data api
                                'data-request-method' => 'post',
                                'data-confirm-title' => 'Are you sure?',
                                'data-confirm-message' => 'Are you sure want to delete this item']),
                    ]),
                ]
            ]) ?>
        </div>
    </div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "title" => '<h4 class="modal-title">Modal title</h4>',
    "options" => [
        "tabindex" => -1, // important for Select2 to work properly,
        "class" => "modal fade",
    ],
    "centerVertical" => true,
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>