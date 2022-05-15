<div class="row">
    <div class="col-lg-8">
        <h3>Update Product
            <?php
            if (isset($_SESSION['msg'])) {
                $msg = $_SESSION['msg'];
                echo $msg;
                unset($_SESSION['msg']);
            }
            if (isset($_SESSION['msgErr'])) {
                $msgErr = $_SESSION['msgErr'];
                echo $msgErr;
                unset($_SESSION['msgErr']);
            }

            if (isset($_SESSION['errors'])) {
                $errors = $_SESSION['errors'];
                unset($_SESSION['errors']);
            }
            ?>
        </h3>
        <form class="form-horizontal" action="<?php echo BASE_URL; ?>pages/process/processProduct.php" method="post" enctype="multipart/form-data">
            <?php
            try {
                $pID = isset($_GET['pID']) ? $_GET['pID'] : 0;
                $objP = new Product();
                $objP->productID = $pID;
                $objP->getProduct();
                ?>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="productName" value="<?php echo $objP->productName; ?>" class="form-control" id="name" placeholder="Product Name">
                        <span>
                            <?php
                            if (isset($errors['productName'])) {
                                echo $errors['productName'];
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="brand" class="col-sm-2 control-label">Brand</label>
                    <div class="col-sm-4">
                        <select name="brandID" class="form-control" id="brand">

                            <?php
                            $objB = new Brand();
                            $objB->brandID = $objP->brandID;
                            $objB->getBrand();
                            echo "<option value='$objB->brandID'>$objB->brandName</option>";

                            $brands = Brand::getBrands();
                            foreach ($brands as $b) {
                                echo "<option value='$b->brandID'>$b->brandName</option>";
                            }
                            ?>
                        </select>
                        <span>
                            <?php
                            if (isset($errors['brandID'])) {
                                echo $errors['brandID'];
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-4">
                        <select name="categoryID" class="form-control" id="category">
                            <?php
                            $objC = new Category();
                            $objC->categoryID = $objP->categoryID;
                            $objC->getCategory();
                            echo "<option value='$objC->categoryID'>$objC->categoryName</option>";

                            $cats = Category::getCategories();
                            foreach ($cats as $c) {
                                echo "<option value='$c->categoryID'>$c->categoryName</option>";
                            }
                            ?>
                        </select>
                        <spna>
                            <?php
                            if (isset($errors['categoryID'])) {
                                echo $errors['categoryID'];
                            }
                            ?>
                        </spna>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-2 control-label">Price ($) </label>
                    <div class="col-sm-10">
                        <input type="text" name="unitPrice" value="<?php echo $objP->unitPrice; ?>" class="form-control" id="price" placeholder="Product Price">
                        <spna>
                            <?php
                            if (isset($errors['unitPrice'])) {
                                echo $errors['unitPrice'];
                            }
                            ?>
                        </spna>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="col-sm-2 control-label">Quantity </label>
                    <div class="col-sm-10">
                        <input type="text" name="quantity" value="<?php echo $objP->quantity; ?>" class="form-control" id="quantity" placeholder="">
                        <span>
                            <?php
                            if (isset($errors['quantity'])) {
                                echo $errors['quantity'];
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="featured" class="col-sm-2 control-label">Featured </label>
                    <div class="col-sm-10">
                        <?php
                        if ($objP->featured == 1) {
                            echo "<label class = 'radio-inline'>
                                    <input type = 'radio' name = 'featured' id = 'inlineRadio1' value = '1' checked> Yes
                                  </label>
                                  <label class = 'radio-inline'>
                                    <input type = 'radio' name = 'featured' id = 'inlineRadio2' value = '0'> No
                                  </label>";
                        } else {
                            echo "<label class = 'radio-inline'>
                                    <input type = 'radio' name = 'featured' id = 'inlineRadio1' value = '1' > Yes
                                  </label>
                                  <label class = 'radio-inline'>
                                    <input type = 'radio' name = 'featured' id = 'inlineRadio2' value = '0' checked> No
                                  </label>";
                        }
                        ?>
                        <span>
                            <?php
                            if (isset($errors['featured'])) {
                                echo "<br>" . $errors['featured'];
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="features" class="col-sm-2 control-label">Features</label>
                    <div class=" col-sm-10 checkbox">
                        <?php
//                        $check = "";
//
//                        foreach ($objP->productFeatures as $key => $value) {
//                            if (in_array($value, $objP->productFeatures)) {
//                                $check = "checked";
//                                echo "<label>
//                                        <input type='checkbox' id='features' name='productFeatures[$key]' value='$value' $check> $key
//                                    </label> ";
//                            }
//                        }
                        ?>
                        <label>
                            <input type="checkbox" id="features" name="productFeatures[3G]"  value="Yes"> 3G 
                        </label>
                        <label>
                            <input type="checkbox" id="features" name="productFeatures[4G]" value="Yes"> 4G 
                        </label>
                        <spna>
                            <?php
                            if (isset($errors['productFeatures'])) {
                                echo $errors['productFeatures'];
                            }
                            ?>
                        </spna>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" rows="3"><?php echo $objP->description; ?></textarea>
                        <spna>
                            <?php
                            if (isset($errors['description'])) {
                                echo $errors['description'];
                            }
                            ?>
                        </spna>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                        <img src="../../products/catalog/<?php echo $objP->productName . "/" . $objP->productImage; ?>" alt="<?php echo $objP->productImage; ?>" width="200px">
                        <input type="file" name="productImage" id="image">
                        <spna>
                            <?php
                            if (isset($errors['productImage'])) {
                                echo $errors['productImage'];
                            }
                            ?>
                        </spna>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name="productID" value="<?php echo $objP->productID; ?>" />
                        <button type="submit" name="updateProduct" class="btn btn-default">Update Product</button>
                        <button type="reset" name="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
                <?php
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            ?>
        </form>

    </div>
</div>
<!-- /.row 