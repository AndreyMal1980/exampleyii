<?php if ($category['parent_id'] == 0) { ?>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
        <div class="row">
            <div class="side">
                <ul class="menu">
                    <li class="main-category">
                        <a href="<?= \yii\helpers\Url::to(['user/application?category_id='.(int)($category['id']).'&parent_id='.(int)($category['parent_id'])]); ?>">
                            <?= $category['title']; ?>
                        </a>
                    </li>
                    <?php if (isset($category['childs'])) { ?>


                        <ul>

                            <li><a  href="<?= \yii\helpers\Url::to(['user/application?category_id='.(int)($category['id']).'&parent_id='.(int)($category['parent_id'])]); ?>"><?= $this->getMenuHtml($category['childs']) ?></a></li>
                        </ul>


                    <?php } ?>

                </ul>
            </div>

        </div>
    </div>
<?php } else { ?>
    <?php if (!($category['childs'])) { ?>
        <li><a href="<?= \yii\helpers\Url::to(['user/application?category_id='.(int)($category['id']).'&parent_id='.(int)($category['parent_id'])]); ?>"><?= $category['title']; ?></a></li>
    <?php } else { ?>

        <?php if (isset($category['childs'])) { ?>
            <li class="menu__list"><a href="<?= \yii\helpers\Url::to(['user/application?category_id='.(int)($category['id']).'&parent_id='.(int)($category['parent_id'])]); ?>"><?= $category['title']; ?></a>

                <ul class="menu-drop">
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['user/application?category_id='.(int)($category['id']).'&parent_id='.(int)($category['parent_id'])]); ?>"><?= $this->getMenuHtml($category['childs']); ?></a>

                    </li>
                </ul>

            </li>
        <?php } ?>
    <?php } ?>
<?php } ?>
    



