<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/fontawesome.css',
        'css/solid.css',
        'css/main.css',
        'css/bootstrap-table.min.css'

    ];
    public $js = [
        'js/script.js',
        'js/bootstrap-table.min.js',
        'js/extensions/toolbar/bootstrap-table-toolbar.js',
        'js/locale/bootstrap-table-ru-RU.js',
        //'js/all.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
