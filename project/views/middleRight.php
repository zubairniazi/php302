<div id="surprise" class="row hidden-xs">
    <a href="<?php echo(BASE_URL); ?>products/products.php"><img src="<?php echo(BASE_URL); ?>images/surprise.png" alt="surprise"></a> 
    <span class="heading">Entry</span> 
</div>
<div id="login-form" class="row border">
    <form action="<?php echo(BASE_URL); ?>process/processLogin.php" method="post" enctype="multipart/form-data">
        <?php
        if ($objUser->login) {
            echo "<a href='" . BASE_URL . "process/processLogout.php'>Logout</a> <a href='" . BASE_URL . "users/myAccount.php'>My Account</a>";
        } else {
            ?>
            <div>
                <label class="bold">Login:</label>
                <input type="text" name="userName"> </div>
            <div>
                <label class="bold">Password:</label>
                <input type="password" name="password"> </div>
            <div> 
                <a href="<?php echo(BASE_URL); ?>signup.php">Registration</a> 
                <a href="<?php echo BASE_URL; ?>users/forgotPassword.php">Forget Password</a> 
            </div>
            <div class="text-center">
                <input type="submit" value="Enter" class="btn btn-default"> </div>
        <?php } ?>
    </form>
</div>
<div id="letest-news" class="row border"> <span class="heading">Letest news</span>
    <button type="button" class="btn btn-sm"><?php echo date("d-F"); ?></button>
    <p>Dolor sit amet, consetetur sadipscing elitr, seddiam nonumy eirmod tempor. 
        invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy 
        eirmod tempor invidunt ut labore et dolore magna. Lorem ipsum dolor sit amet, 
        consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut 
        labore et dolore magna aliquyam erat, sed diam voluptua</p> 
    <a href="#">read more</a> 
</div>