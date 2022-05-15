<div id="menu" class="row"> <span class="heading">Brands</span>
    <ul class="list-style">
        <?php
        try {
            $brands = Brand::getBrands();

            foreach ($brands as $b) {
                echo "<li><a href='" . BASE_URL . "products/products.php?brandID=$b->brandID'>$b->brandName</a></li>";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        ?>
    </ul>
</div>

<div id="menu" class="row"> <span class="heading">Categories</span>
    <ul class="list-style">
        <?php
        try {
            $cats = Category::getCategories();

            foreach ($cats as $c) {
                echo "<li><a href='" . BASE_URL . "products/products.php?catID=$c->categoryID'>$c->categoryName</a></li>";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        ?>
    </ul>
</div>
<div id="support" class="row">
    <a href="<?php echo(BASE_URL); ?>contact.php"><img src="<?php echo(BASE_URL); ?>images/support.png" alt="life-support" /></a>
</div>
