<?php

namespace app\components;

use yii\base\Widget;
use app\models\Category;

class CategoryDivacesWidget extends Widget {

    public $tpl;
    public $data;
    public $dataTree;
    public $nid;
    public $model;
    public $tree;
    public $menuHtml;

    public function init() {
        parent::init();
        if(\Yii::$app->request->get('category_id')){
              $this->nid = \Yii::$app->request->get('category_id');
        } else {
        $this->nid = 0;
        }
        if ($this->tpl === null) {
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run() {
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        // pr($this->tree);
        return $this->menuHtml;
    }

    protected function getTree() {

        /*   echo '<pre>';
          print_r($this->data);
          echo '</pre>'; */

        //  $id = //\Yii::$app->request->post('category_id');
        /* echo '<pre>';
          print_r($this->data);
          echo '</pre>'; */
        //echo $id;

        $tree = [];
        /*  echo '<pre>';
          print_r($this->data);
          echo '</pre>'; */
        //$nid = 0;

        foreach ($this->data as $id => &$node) {
//echo $this->nid;
            if (!$node['parent_id'] && $this->nid == 0) {
                $tree[$id] = &$node;
            } else {
                 $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }

             /* echo '<pre>';
              print_r($node['id']);
              echo '</pre>'; */
            if ($this->nid > 0) {
                if ($node['id'] == $this->nid) {
                    $tree[$id] = &$node;
                    /* echo '<pre>';
                      print_r($node);
                      echo '</pre>'; */
                      $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
                }
                  
            }
        

            /* echo $id;
              echo '<pre>';
              print_r($node);
              echo '</pre>'; */


            /* echo '<pre>';
              print_r($node);
              echo '</pre>'; */
        }








        //if (isset($this->data[$parent_id])) {

        /* foreach ($this->data as $id => &$node) {
          if (!$node['parent_id']) {

          $tree[$id] = &$node;
          echo '<pre>';
          // print_r($tree[$id]);
          echo '</pre>';
          } else {
          // echo '<pre>';
          //  print_r($this->data[$node['parent_id']]['childs'][$node['id']]);
          // echo '</pre>';
          $this->data[$node[$parent_id]]['childs'][$node['id']] = &$node;
          }
          // }
          } */

       /*   echo '<pre>';
          print_r($tree);
          echo '</pre>'; */
          //echo   \Yii::$app->request->get('category_id');
        return $tree;
    }

    protected function getMenuHtml($tree,$tab = '') {

        /* echo '<pre>';
          print_r($tree);
          echo '</pre>'; */

       
        $str = '';
      
        foreach ($tree as $category)  {
          
            $str .= $this->catToTemplate($category,$tab);
  
        }

        return $str;
    }

    protected function catToTemplate($category,$tab) {
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }

}

