yii2-kartikgii
==============

Gii CRUD Generator base on kartik-v extension. Save repeatitive works on every new CRUD generated. Below are some of the features:

- Data grid view are generated using kartik-v/yii2-grid, pjax are use for the grid
- Detail View are generated using kartik-v/yii2-detail-view, controllers are generated to support edit mode saving and delete in Detail View.
- _form are generated using kartik-v/yii2-builder, Date/Time/DateTime/TimeStamp column are automatically generated to use DateTimePicker Widget.
- Using kartik-v/yii2-datecontrol to globalize date format, so date will automatically convert for the display and also for save according to the format you set, for all CRUD generated using this extension.

By using this extension, you no longer have to change your CRUD to using kartik-v extension, everything will be auto generated for you, and you could customize it later if you need.

Thanks for the great kartik-v extension. 

For more information about kartik-v extension, please visit [I'm an inline-style link](https://www.github.com/kartik-v).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require warrence/yii2-kartikgii "dev-master"
```

or add

```
"warrence/yii2-kartikgii": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage
```php
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
    ]
```

## License

**yii2-detail-view** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.
