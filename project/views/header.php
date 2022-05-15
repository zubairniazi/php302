
<div class="row" id="user-name">
    <div class="col-xs-12">
        <p class="float-right"> Welcome <strong><?php echo($objUser->fullName); ?></strong></p> 
    </div>
</div>
<div id="header" class="row">
    <div id="logo" class="col-md-offset-1 col-md-3 col-sm-3 col-sm-offset-1 col-xs-6 col-xs-offset-3">
        <a href="<?php echo(BASE_URL); ?>index.php">
            <img src="<?php echo(BASE_URL); ?>images/logo.png" alt="EShop Logo" class="img-responsive" />
        </a>
    </div>
    <div id="curr" class="col-md-offset-2 col-md-2 hidden-sm hidden-xs border">
        <form action="#" method=""> <span class="bold">Currency:</span>
            <br />
            <select id="currency" name="Currency">
                <option value="us-dollar">US Dollar</option>
            </select>
        </form>
    </div>
    <!--
        <div id="lang" class="col-md-2 col-sm-2 hidden-xs border">
            <div>
                <p class="bold">Language:</p>
                <ul id="header-lang-nav" class="float">
                    <li>
                        <a href=""><img src="images/flags/flag_01.png" alt="flag1"></a>
                    </li>
                    <li>
                        <a href=""><img src="images/flags/flag_02.png" alt="flag2"></a>
                    </li>
                    <li>
                        <a href=""><img src="images/flags/flag_03.png" alt="flag3"></a>
                    </li>
                    <li>
                        <a href=""><img src="images/flags/flag_04.png" alt="flag4"></a>
                    </li>
                    <li>
                        <a href=""><img src="images/flags/flag_05.png" alt="flag5"></a>
                    </li>
                    <li>
                        <a href=""><img src="images/flags/flag_06.png" alt="flag6"></a>
                    </li>
                </ul>
            </div>
        </div>
    -->
    <div id="lang" class="col-md-2 hidden-xs hidden-sm border">
        <div>
            <p class="bold">Language:</p>
            <select id="lang" name="language">
                <option value="eng">English</option>
            </select>
        </div>
    </div>
    <div id="head-login" class="col-sm-2 col-sm-offset-3 hidden-md hidden-lg hidden-xs border">
        <div>
            <a href="<?php echo(BASE_URL); ?>login.php">Login</a> | <a href="<?php echo(BASE_URL); ?>signup.php">Signup</a>
        </div>
    </div>
    <div id="header-cart" class="col-md-2 col-sm-3 hidden-xs border">
        <div class="float"> 
            <img src="<?php echo(BASE_URL); ?>images/shopingCart.png" class="img-responsive" alt="shoping-cart" />
            <p class="bold">Shoping Cart
                <br>
                <span class="blue"><?php echo($objCart->count); ?></span> 
                <a href="<?php echo (BASE_URL); ?>products/shoppingCart.php">
                    <span class="normal">items</span> 
                </a>
            </p>
        </div>
    </div>
</div>


<nav id="header-nav" class="navbar navbar-default navbar-static-top">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo(BASE_URL); ?>index.php">Home</a></li>
                <li><a href="<?php echo(BASE_URL); ?>products/products.php">Products</a></li>
                <!--<li><a href="<?php //echo(BASE_URL);    ?>products/products.php">Special Offers</a></li>-->
                <li><a href="<?php echo (BASE_URL); ?>products/shoppingCart.php">Shopping Cart</a></li>
                <li><a href="<?php echo (BASE_URL); ?>products/checkOut.php">Checkout</a></li>

                <?php if ($objUser->login): ?>
                    <li><a href="<?php echo(BASE_URL); ?>users/myAccount.php">My Account</a></li>
                    <li><a href="<?php echo (BASE_URL); ?>products/myOrders.php">My Orders</a></li>
                    
                <?php elseif (!$objUser->login): ?>
                    <li><a href="<?php echo (BASE_URL); ?>login.php">Login</a></li>
                    <li><a href="<?php echo (BASE_URL); ?>signup.php">Signup</a></li>
                    
                <?php endif; ?>
                <li><a href="<?php echo(BASE_URL); ?>admin/index.php">Admin</a></li>
                <!--<li><a href="<?php //echo(BASE_URL);    ?>locations.php">Locations</a></li>-->
                <!--<li><a href="<?php //echo(BASE_URL);    ?>about.php">About</a></li>-->
                <li><a href="<?php echo(BASE_URL); ?>contact.php">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>