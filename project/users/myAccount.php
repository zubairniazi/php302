<?php
require_once '../models/WebInterface.php';
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Category.php';
require_once '../models/Cart.php';
//require_once './models/Product.php';
require_once '../views/top.php';
?>

</head>

<body>
    <div id="page" class="container">
        <header>
            <?php
            require_once '../views/header.php';
            ?>
        </header>
        <div id="content" class="container">
            <aside id="left" class="col-md-2 col-sm-3 hidden-xs">
                <?php
                require_once '../views/middleLeft.php';
                ?>
            </aside>
            <section id="article-area" class="col-md-7 col-sm-9 col-xs-12">

                <!-- ************************************************ -->

                <div id="form-container">

                    <div id="heading-row">My Account - Details
                        <?php
                        $objUser->getProfileData();

                        if (isset($_SESSION['msg'])) {
                            $msg = $_SESSION['msg'];
                            echo("<br>$msg");
                            unset($_SESSION['msg']);
                        }

                        if (isset($_SESSION['errors'])) {
                            $errors = $_SESSION['errors'];
                            unset($_SESSION['errors']);
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered">
                                <div>
                                    <?php echo " <img src='" . BASE_URL . "/users/$objUser->userName/$objUser->profileImage' alt='$objUser->userName' class='img-responsive img-circle' style='margin-bottom: 10px;' width='200px' height='auto' >"; ?>
                                </div>
                                <?php
                                echo "
                                <tr>
                                    <th>First Name: </th>
                                    <td>$objUser->firstName</td>
                                </tr>
                                <tr>
                                    <th>Middle Name: </th>
                                    <td>$objUser->middleName</td>
                                </tr>
                                <tr>
                                    <th>Last Name: </th>
                                    <td>$objUser->lastName</td>
                                </tr>
                                <tr>
                                    <th>Email: </th>
                                    <td>$objUser->email</td>
                                </tr>
                                <tr>
                                    <th>Username: </th>
                                    <td>$objUser->username</td>
                                </tr>
                                <tr>
                                    <th>Contact Number: </th>
                                    <td>$objUser->contactNumber</td>
                                </tr>
                                <tr>
                                    <th>Gender: </th>
                                    <td>$objUser->gender</td>
                                </tr>
                                <tr>
                                    <th>Interest: </th>
                                    <td>";
                                foreach ($objUser->interests as $in) {
                                    echo "$in - ";
                                }
                                echo "</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth: </th>
                                    <td>$objUser->dateOfBirth</td>
                                </tr>
                                <tr>
                                    <th>Street Address: </th>
                                    <td>$objUser->streetAddress</td>
                                </tr>
                                <tr>
                                    <th>City: </th>
                                    <td>$objUser->city</td>
                                </tr>
                                <tr>
                                    <th>State: </th>
                                    <td>$objUser->state</td>
                                </tr>
                                <tr>
                                    <th>Country: </th>
                                    <td>$objUser->country</td>
                                </tr>
                                <tr>";
                                ?>

                            </table>
                            <?php echo "<a href='editAccount.php' class='pull-right'>Edit Profile</a>"; ?>
                        </div>
                    </div>

                </div>


                <!-- ************************************************ -->

            </section>

            <aside id="right" class="col-md-3 col-md-offset-0 hidden-sm col-xs-8 col-xs-offset-2">
                <?php
                require_once '../views/middleRight.php';
                ?>
            </aside>

        </div>

        <footer>
            <?php
            require_once '../views/footer.php';
            ?>
        </footer>

    </div>
</body>

</html>