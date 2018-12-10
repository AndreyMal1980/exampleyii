<?php

namespace app\components;

use yii\base\Widget;
use app\models\Category;

class CallbackMasterWidget extends Widget {

    public function init() {
        parent::init();
    }

    public function run() {
        return $this->render('modal');
    }

}
