<div class="row">
    <div class="col-lg-8">
        <h3>Add Product</h3>
        <p>
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
        </p>
        <form class="form-horizontal" action="<?php echo(BASE_URL); ?>pages/process/processProduct.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="productName" class="form-control" id="name" placeholder="">
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
                        <option>select..</option>
                        <?php
                        require_once '../../models/Brand.php';
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
                        <option>select</option>
                        <?php
                        require_once '../../models/Category.php';
                        $cats = Category::getCategories();
                        foreach ($cats as $c) {
                            echo "<option value='$c->categoryID'>$c->categoryName</option>";
                        }
                        ?>
                    </select>
                    <span>
                        <?php
                        if (isset($errors['categoryID'])) {
                            echo $errors['categoryID'];
                        }
                        ?>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">Price ($) </label>
                <div class="col-sm-10">
                    <input type="text" name="unitPrice" class="form-control" id="price" placeholder="">
                    <span>
                        <?php
                        if (isset($errors['unitPrice'])) {
                            echo $errors['unitPrice'];
                        }
                        ?>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="quantity" class="col-sm-2 control-label">Quantity </label>
                <div class="col-sm-10">
                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="">
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
                    <label class="radio-inline">
                        <input type="radio" name="featured" id="inlineRadio1" value="1"> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="featured" id="inlineRadio2" value="0"> No
                    </label>
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
                    <label>
                        <input type="checkbox" id="features" name="productFeatures[3G]"  value="Yes"> 3G 
                    </label>
                    <label>
                        <input type="checkbox" id="features" name="productFeatures[4G]" value="Yes"> 4G 
                    </label>
                    <span>
                        <?php
                        if (isset($errors['productFeatures'])) {
                            echo $errors['productFeatures'];
                        }
                        ?>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" rows="3"></textarea>
                    <span>
                        <?php
                        if (isset($errors['description'])) {
                            echo $errors['description'];
                        }
                        ?>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="productImage" id="image">
                    <span>
                        <?php
                        if (isset($errors['productImage'])) {
                            echo $errors['productImage'];
                        }
                        ?>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="addProduct" class="btn btn-default">Add Product</button>
                    <button type="reset" name="reset" class="btn btn-default">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.row 