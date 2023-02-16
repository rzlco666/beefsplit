<?php

use common\components\Breadcrumb;
use denkorolkov\ajaxcrud\BulkButtonWidget;
use denkorolkov\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DatasetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dataset';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
    <div class="page-header">
        <?= Breadcrumb::levelDua($this->title, 'Dashboard', Url::home()) ?>
    </div>
    <div class="card">
        <div class="card-header">
            <?= Html::a('<i class="uil uil-upload-alt"></i> Upload Dataset', ['create'],
                ['role' => 'modal-remote', 'title' => 'Upload Dataset', 'class' => 'btn btn-primary']) ?>
        </div>
        <div id="ajaxCrudDatatable">
            <?= GridView::widget([
                'id' => 'crud-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax' => true,
                'columns' => require(__DIR__ . '/_columns.php'),
                'toolbar' => [
                    ['content' =>
                        Html::a('<i class="uil uil-refresh"></i>', [''],
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
                    'heading' => '<h4 class="card-header-title">' . $this->title . '</h4>',
                    'before' => '<em>' . '* Resize table columns just like a spreadsheet by dragging the column edges.' . '</em>',
                    'after' => BulkButtonWidget::widget([
                        'buttonText' => '<span class="uil uil-arrow-right"></span>&nbsp;&nbsp;' . 'With selected' . '&nbsp;&nbsp;',
                        'buttons' => Html::a('<i class="uil uil-trash-alt"></i>&nbsp;' . 'Delete All',
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
    'size' => Modal::SIZE_EXTRA_LARGE,
    "options" => [
        "tabindex" => -1, // important for Select2 to work properly,
        "class" => "modal fade",
    ],
    "centerVertical" => true,
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>