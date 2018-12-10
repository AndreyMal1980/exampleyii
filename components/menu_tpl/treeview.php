<li style="padding-left: 20px;list-style-type: none">
    <a parent_id = "<?= $category['parent_id'] ?>" category_id = "<?= $category['id'] ?>" class="main" href="">
        <?= $category['title']; ?>
        <?php if ($category['childs']) : ?>
            <span class="badge pull-right">
                <i class="fa fa-plus"></i>
            </span>
        <?php endif; ?>

    </a>
    <?php if (isset($category['childs'])) { ?>
        <ul>
                <?= $this->getMenuHtml($category['childs']); ?>
        </ul>
    <?php } ?>
</li>
