<?php
yii\helpers\Html;
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var yii\gii\generators\crud\Generator $generator
 */

echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'searchModelClass');
echo $form->field($generator, 'controllerClass');
echo $form->field($generator, 'baseControllerClass');
echo $form->field($generator, 'moduleID');
echo $form->field($generator, 'indexWidgetType')->dropDownList([
    'grid' => 'GridView',
    'list' => 'ListView',
]);
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'messageCategory');

if (Yii::$app->request->isPost) {
    $table_s = $generator->getTableSchema();

    if (empty($table_s)) {
        return;
    }

    $columns = $table_s->columns;
    $cols    = [];
    foreach ($columns as $key => $val) {
        $cols[$key] = $val->name;

    }
    // var_dump($cols);
    echo $form->field($generator, 'listFields')->checkboxList($cols);
    if (empty($generator->inputType)) {
        foreach ($columns as $name => $val) {
            $generator->inputType[$name] = 1;
        }
    }
    // var_dump($generator->inputType);
    echo "<div form-group'>";
    echo '<label control-label help" data-original-title title>Form Fields</label>';
    echo "<div  class='row'>";
    foreach ($columns as $name => $val) {
        $checked = '';
        if (!empty($generator->formFields) && in_array($name, array_values($generator->formFields))) {
            $checked = 'checked="checked"';
            echo "cccc::::" . $name . ":" . "," . $checked . ";;;;";
        }

        // var_dump($val);
        echo '<div class="col-lg-9"><input type="checkbox" name="Generator[formFields][]" value="' . $name . '" ' . $checked . '> <label control-label">' . $name . '</label></div>';
        echo '<div class="col-lg-3">' . Html::dropDownList("Generator[inputType][$name]", $generator->inputType[$name],
            $generator->fieldTypes(), ['class' => 'form-control']) . '</div>';
    }
    echo "</div></div>";
}
