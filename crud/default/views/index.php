<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

$urlParams     = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";

?>

use yii\helpers\Html;
use yii\helpers\Url;
use <?=$generator->indexWidgetType === 'grid' ? "kartik\\grid\\GridView" : "yii\\widgets\\ListView";?>;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
<?=!empty($generator->searchModelClass) ? " * @var " . ltrim($generator->searchModelClass, '\\') . " \$searchModel\n" : '';?>
 */

$this->title = <?=$generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass))));?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?=Inflector::camel2id(StringHelper::basename($generator->modelClass));?>-index">
    <div class="page-header">
        <h1><?="<?= ";?>Html::encode($this->title) ?></h1>
    </div>
<?php if (!empty($generator->searchModelClass)): ?>
<?="    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "");?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif;?>

    <p>
        <?="<?php /* echo ";?>Html::a(<?=$generator->generateString('Create {modelClass}', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]);?>, ['create'], ['class' => 'btn btn-success'])<?="*/ ";?> ?>
    </p>

<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?="<?php Pjax::begin(); echo ";?>GridView::widget([
        'dataProvider' => $dataProvider,
        'options'      => ['id' => 'vpn358-grid', 'class' => 'grid-view table-scrollable'],
        <?=!empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n";?>
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name'  => 'id',
            ],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            '" . $name . "',\n";
        } else {
            echo "            // '" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if ($column->type === 'date') {
            $columnDisplay = "            ['attribute' => '$column->name','format' => ['date',(isset(Yii::\$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::\$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']],";

        } elseif ($column->type === 'time') {
            $columnDisplay = "            ['attribute' => '$column->name','format' => ['time',(isset(Yii::\$app->modules['datecontrol']['displaySettings']['time'])) ? Yii::\$app->modules['datecontrol']['displaySettings']['time'] : 'H:i:s A']],";
        } elseif ($column->type === 'datetime' || $column->type === 'timestamp') {
            $columnDisplay = "            ['attribute' => '$column->name','format' => ['datetime',(isset(Yii::\$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::\$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']],";
        } else {
            $columnDisplay = "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',";
        }
        if (++$count < 6) {
            echo $columnDisplay . "\n";
        } else {
            echo "//" . $columnDisplay . " \n";
        }
    }
}
?>

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl(['<?=(empty($generator->moduleID) ? '' : $generator->moduleID . '/') . $generator->controllerID;?>/update', <?=$urlParams;?>, 'edit' => 't']),
                            ['title' => Yii::t('yii', 'Edit'),]
                        );
                    }
                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> 新增', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> ', ['index'], ['class' => 'btn btn-info']). Html::a('<i class="fa fa-close"></i> 批量删除', "javascript:void(0);", ['class' => 'btn btn-sm btn-warning gridview']),
            'showFooter' => false
        ],
    ]); 
    Pjax::end();
    // <?=strtolower(StringHelper::basename($generator->modelClass));?> 可能需要修改一下类的名称名称
$del_url = Url::to(['<?=strtolower(StringHelper::basename($generator->modelClass));?>/delete-all']);
$this->registerJs('
　　　　$(".gridview").on("click", function () {
    　　　　var keys = $("#vpn358-grid").yiiGridView("getSelectedRows");
    　　　　if (keys.length>0){
        　　　　$.post("'.$del_url.'&id="+ (keys));
    　　　　}
　　　　});
　　');
    ?>
<?php else: ?>
    <?="<?= ";?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?=$nameAttribute;?>), ['view', <?=$urlParams;?>]);
        },
    ]) ?>
<?php endif;?>

</div>
