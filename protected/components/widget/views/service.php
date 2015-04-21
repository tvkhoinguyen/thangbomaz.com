<h4>SERVICES</h4>
<?php
    $menu = Menuitem::model()->findAll(array('condition' => 'parent_id ="496"'));
?>
<ul class="nav-list">
    <?php
        if (!empty($menu)) {
            $menus = new ShowMenuFE();
            foreach ($menu as $item) {
                if ($menus->getCurrentUrlWithoutParam() == $item->link) {
                    echo '<li class="active"><a href="'.$item->link.'">'.$item->name.'</a></li>';
                } else {
                    echo '<li><a href="'.$item->link.'">'.$item->name.'</a></li>';
                }
            }
        }
    ?>
</ul>