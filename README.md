## Enhances:
bulk-del brach.
1. add support more fieldtypes ,such as select2,file upload,checkbox,checkboxList,dropdowlist and so.
2. bulk delete on index page

![image](https://raw.githubusercontent.com/zhangyc310/yii2-kartikgii/bulk-del/images/gii-types.png)

![image](https://raw.githubusercontent.com/zhangyc310/yii2-kartikgii/bulk-del/images/bulk-del.png)
=============

I would like to apologize for not following up with this plugin because i has been migrate over to Laravel. However i would like to thanks everyone for using this plugin. Please do let me know is there any nice fork of this project, i will share to link for everyone here. 

yii2-kartikgii
==============

Gii CRUD Generator base on kartik-v extension. Save repeatitive works on every new CRUD generated. Below are some of the features:

- Data grid view are generated using kartik-v/yii2-grid, pjax are use for the grid.
- Detail View are generated using kartik-v/yii2-detail-view, controllers are generated to support edit mode saving and delete in Detail View.
- _form are generated using kartik-v/yii2-builder, Date/Time/DateTime/TimeStamp column are automatically generated to use DateTimePicker Widget.
- Using kartik-v/yii2-datecontrol to globalize date format, so date will automatically convert for the display and also for save according to the format you set, for all CRUD generated using this extension.

By using this extension, you no longer have to change your CRUD to using kartik-v extension, everything will be auto generated for you, and you could customize it later if you need.

Thanks for the great kartik-v extension. 

For more information about kartik-v extension, please visit [kartik-v at Github](https://www.github.com/kartik-v).

> NOTE: This is the first extension i created, please kindly comment or suggest for better or correct me if im doing anything wrong. Thanks.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).


Either run

```
$ php composer.phar require zhangyc310/yii2-kartikgii "dev-master" "dev-bulk-del"
```
修改了安装命令，可以直接安装了。

or add

```
"zhangyc310/yii2-kartikgii": ""dev-bulk-del""
```


to the ```require``` section of your `composer.json` file.

## Usage

```php
//if your gii modules configuration looks like below:
$config['modules']['gii'] = 'yii\gii\Module';

//change it to
$config['modules']['gii']['class'] = 'yii\gii\Module';
```

```php
//Add this into backend/config/main-local.php
$config['modules']['gii']['generators'] = [
        'kartikgii-crud' => ['class' => 'zhangyc310\kartikgii\crud\Generator'],
    ];
```
注意，这里是 `zhangyc310\kartikgii\crud\Generator`

```php
//Add 'gridview' into your 'modules' section in backend/config/main.php
'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],

    ],
```

```php
//add modules 'datecontrol' into your 'modules' section in common/config/main 
'modules' => [
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute
            'displaySettings' => [
                'date' => 'd-m-Y',
                'time' => 'H:i:s A',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            // format settings for saving each date attribute
            'saveSettings' => [
                'date' => 'Y-m-d', 
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],



            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

        ]
    ],
```

## 关于批量删除功能的说明
### 生成的 view/index.php 文件中的按钮路径，某些情况下需要修改一下
```
line75： $del_url = Url::to(['parse-log-rules/delete-all']);
```
默认类名为`ParseLogRules`，需要改为 `parse-log-rules`，非必要步骤。


## License

**yii2-kartikgii** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.



下面的不在需要了
```
##  注意，通过这种方式，下载 `yii2-kartikgii` 需要的相关包。
##  然后下载我的修改版 `git clone https://github.com/zhangyc310/yii2-kartikgii`，并放到`vendor/zhangyc310`目录下。
```
