<div class="panel panel-default">
    <div class="panel-heading">
        Product Details
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-products">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $products = Product::getProducts();
                    foreach ($products as $p) {
                        echo "<tr class='odd gradeX text-center'>
                                <td>$p->productID</td>
                                <td><a href='../../products/productDetails.php?productID=$p->productID'>$p->productName</a></td>
                                <td>";
                        try {
                            $objB = new Brand();
                            $objB->brandID = $p->brandID;
                            $objB->getBrand();
                            echo "<a href='brands.php'>$objB->brandName</a>";
                        } catch (Exception $ex) {
                            echo $ex->getMessage();
                        }

                        echo "</td>
                              <td>";

                        try {
                            $objC = new Category();
                            $objC->categoryID = $p->categoryID;
                            $objC->getCategory();
                            echo "<a href = 'categories.php'>$objC->categoryName</a>";
                        } catch (Exception $ex) {
                            echo $ex->getMessage();
                        }

                        echo "</td>
                                <td>$p->unitPrice</td>
                                <td>$p->description</td>
                                <td><img src='../../products/catalog/$p->productName/$p->productImage' alt='$p->productName' width='120px' height='auto'></td>
                                <td><a href='./products.php?source=edit&pID=$p->productID'>edit</a></td>
                                <td><a href='process/processProduct.php?delete=$p->productID'>delete</a></td>
                            </tr>";
                    }
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                ?>

            </tbody>
        </table>
        <!--/.table-responsive -->

    </div>
    <!--/.panel-body -->
</div>
<!--/.panel -->