<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //   'bootstrap/css/bootstrap.css',
        'css/reset.css',
        'css/style.css',
        'sliders/slick/slick.css',
        'sliders/slick/slick-theme.css',
        'arcticmodal/jquery.arcticmodal-0.3.css',
        'arcticmodal/themes/simple.css'
    ];
       public $js = [
        // 'js/jquery.js',
        'sliders/slick/slick.min.js',
        // 'js/bootstrap.js',
        'js/common.js',
        'arcticmodal/jquery.arcticmodal-0.3.min.js',
               'js/jquery.accordion.js',
        'js/jquery.cookie.js',
        'js/jquery.scrollTo.js'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
