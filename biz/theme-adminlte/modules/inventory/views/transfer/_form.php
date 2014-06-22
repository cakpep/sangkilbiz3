<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use biz\tools\Helper;
use biz\inventory\assets\TransferAsset;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var biz\purchase\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="purchase-hdr-form">
    <?php
    $form = ActiveForm::begin([
                'id' => 'transfer-form',
    ]);
    ?>    
    <div class="col-lg-12">
        <?php
        $models = $details;
        array_unshift($models, $model);
        echo $form->errorSummary($models)
        ?>
    </div>
    <div class="col-lg-3" style="padding-right: 0px;">
        <div class="box box-danger">
            <div class="box-body">
                <?= $form->field($model, 'transfer_num')->textInput(['maxlength' => 16, 'readonly' => true]); ?>
                <?= $form->field($model, 'id_warehouse_source')->dropDownList(Helper::getWarehouseList()); ?>
                <?= $form->field($model, 'id_warehouse_dest')->dropDownList(Helper::getWarehouseList()); ?>
                <?php
                echo $form->field($model, 'transferDate')
                        ->widget('yii\jui\DatePicker', [
                            'options' => ['class' => 'form-control', 'style' => 'width:50%'],
                            'clientOptions' => [
                                'dateFormat' => 'dd-mm-yy'
                            ],
                ]);
                ?>
            </div>
            <div class="box-footer">
                <?php
                echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
                ?>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <?= $this->render('_detail', ['model' => $model, 'details' => $details]) ?>
    </div>     
    <?php ActiveForm::end(); ?>

</div>
<?php
TransferAsset::register($this);
$j_master = json_encode($masters);
$js_begin = <<<BEGIN
    var master = $j_master;
BEGIN;
$js_ready = '$("#product").data("ui-autocomplete")._renderItem = yii.global.renderItem';
$this->registerJs($js_begin, View::POS_BEGIN);
$this->registerJs($js_ready);