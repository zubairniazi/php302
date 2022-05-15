<?php
require_once './models/User.php';
require_once './models/Brand.php';
require_once './models/Cart.php';
require_once './models/Category.php';
//require_once './models/Product.php';
require_once './views/top.php';
?>
<style>
    #map {
        width: 100%;
        height: 400px;
        background-color: grey;
    }
</style>

</head>

<body>
    <div id="page" class="container">
        <header>
            <?php
            require_once './views/header.php';
            ?>
        </header>
        <div id="content" class="container">
            <aside id="left" class="col-md-2 col-sm-3 hidden-xs">
                <?php
                require_once './views/middleLeft.php';
                ?>
            </aside>
            <section id="article-area" class="col-md-7 col-sm-9 col-xs-12">

                <!-- ************************************************ -->

                <div class="row" id="full-path">
                    <div class="col-xs-12">
                        <a href="<?php echo BASE_URL; ?>index.php">Home</a> > Locations
                        <hr />
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h3 style="margin-top:0px;">Locations</h3>
                        <div id="map"></div>
                        <script>
                            function initMap() {
                                var uluru = {lat: 31.5291497, lng: 74.3002861};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 12,
                                    center: uluru
                                });
                                var marker = new google.maps.Marker({
                                    position: uluru,
                                    map: map
                                });
                            }
                        </script>
                        <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6cYZelsdkDQHe9fq4O7uosn5Wi-Bv_fs&callback=initMap">
                        </script>
                    </div>
                    <!-- /.col-xs-12 -->
                </div>
                <!-- /.row -->
                <div class="row" style="margin-top:10px;">
                    <div class="col-xs-12">
                        <p class="text-center">ante ut enim pretium ultrices vel id <strong>velit Donec</strong> blandit lectus id</p>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-xs-12">
                        <p> Curabitur orci nibh, accumsan a dui sed, rhoncus dignissim neque. 
                            Praesent at aliquet dui. In lacinia ante non lacus pellentesque, eleifend vehicula turpis rhoncus. 
                            Maecenas eget congue quam, at finibus enim. Etiam lacinia quam in leo condimentum, ac ornare velit tempus. 
                            Etiam sagittis et sapien a pellentesque. Nam euismod ornare libero, quis dictum risus porta in. 
                            Duis sed enim nec lectus ullamcorper consectetur.s enim. Etiam lacinia quam in leo condimentum, ac ornare velit tempus. 
                            Etiam sagittis et sapien a pellentesque. Nam euismod ornare libero, quis dictum risus porta in. 
                            Duis sed enim nec lectus ullamcorper consectetur.s enim. Etiam lacinia quam in leo condimentum, ac ornare velit tempus. 
                            Etiam sagittis et sapien a pellentesque. Nam euismod ornare libero, quis dictum risus porta in. 
                            Duis sed enim nec lectus ullamcorper consectetur. </p>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" style="margin-top:10px;">
                    <div class="col-xs-6">
                        <a href="<?php echo BASE_URL; ?>contact.php" class="btn btn-primary">Contact Us</a>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ************************************************ -->

            </section>

            <aside id="right" class="col-md-3 col-md-offset-0 hidden-sm hidden-xs">
                <?php
                require_once './views/middleRight.php';
                ?>
            </aside>

        </div>

        <footer>
            <?php
            require_once './views/footer.php';
            ?>
        </footer>

    </div>
</body>

</html>