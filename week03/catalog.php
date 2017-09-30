<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Catalog Page">
    <meta name="author" content="Jared Pinargote">
    <title>Catalog | JP VR Shop</title>
    <!-- Bootstrap core CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <!-- Custom styles -->
    <link href="css/catalog.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="catalog.php">JP VR Shop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="viewcart.php">Cart(<?php
                                // Display number of items in cart
                                session_start();
                                $totalItems = 0;
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    if($key < 1 || $key > 9){
                                        continue;
                                    }
                                    $totalItems += $value;
                                }
                                echo $totalItems;
                            ?>) <img src="icon/cart.svg" id="icon" onerror="this.src='your.png'">
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content -->
    <div class="container">
        <div class="row" id="content">
            <h2>Browse Products</h2>
            <div class="container-fluid" id="headsets">
                <h4>Headsets</h4>
                <hr>
                <div class="row">
                    <?php
                        // Catalog information, could be replaced with a DB
                        $catalog = array(
                            1 => array(
                                'name'  => 'Oculus Rift',
                                'price' => 299.99 
                                ) ,
                            2 => array(
                                'name'  => 'HTC Vive',
                                'price' => 399.99 
                                ) ,
                            3 => array(
                                'name'  => 'Oculus Touch Controllers',
                                'price' => 99.99 
                                ) ,
                            4 => array(
                                'name'  => 'Tracking Camera Joint',
                                'price' => 49.99 
                                ) ,
                            5 => array(
                                'name'  => 'Vive Tracker',
                                'price' => 49.99 
                                ) ,
                            6 => array(
                                'name'  => 'Vive Controller',
                                'price' => 99.99 
                                ) ,
                            7 => array(
                                'name'  => 'Lucky\'s Tale',
                                'price' => 49.99 
                                ) ,
                            8 => array(
                                'name'  => 'Carnival Games VR',
                                'price' => 39.99 
                                ) ,
                            9 => array(
                                'name'  => 'Google Tilt Brush',
                                'price' => 1.99 
                                ) ,
                        );
                        // Display Headsets
                        for ($id=1; $id<=2 ; $id++) { 
                            echo "<div class='card' style='width:200px;margin-left:30px;'>
                                    <img class='card-img-top catalog-img' src='img/$id.jpg' alt='Card image cap'>
                                    <div class='card-body'>
                                        <h4 class='card-title'>".$catalog[$id]['name']."</h4>
                                        <p class='card-text'>".$catalog[$id]['price']."</p>
                                        <form action='cart.php' method='post' id='item$id'>
                                            <input type='hidden' name='id' value='$id'>
                                            <input type='hidden' name='action' value='addItem'>
                                            <a href='#' class='btn btn-primary' onclick='document.getElementById(\"item$id\").submit()'>Add to Cart</a>
                                        </form>
                                    </div>
                                </div>";
                        }
                    ?>
                </div>
            </div>
            <div class="container-fluid" id="accessories">
                <h4>Accessories</h4>
                <hr>
                <div class="row">
                    <?php
                        // Display Accessesories
                        for ($id=3; $id<=6; $id++) { 
                            echo "<div class='card' style='width:200px;margin-left:30px;'>
                                    <img class='card-img-top catalog-img' src='img/$id.jpg' alt='Card image cap'>
                                    <div class='card-body'>
                                        <h4 class='card-title'>".$catalog[$id]['name']."</h4>
                                        <p class='card-text'>".$catalog[$id]['price']."</p>
                                        <form action='cart.php' method='post' id='item$id'>
                                            <input type='hidden' name='id' value='$id'>
                                            <input type='hidden' name='action' value='addItem'>
                                            <a href='#' class='btn btn-primary' onclick='document.getElementById(\"item$id\").submit()'>Add to Cart</a>
                                        </form>
                                    </div>
                                </div>";
                        }
                    ?>
                </div>
            </div>
            <div class="container-fluid" id="games">
                <h4>Games</h4>
                <hr>
                <div class="row">
                    <?php
                        // Display Games
                        for ($id=7; $id<=9; $id++) { 
                            echo "<div class='card' style='width:200px;margin-left:30px;'>
                                    <img class='card-img-top catalog-img' src='img/$id.jpg' alt='Card image cap'>
                                    <div class='card-body'>
                                        <h4 class='card-title'>".$catalog[$id]['name']."</h4>
                                        <p class='card-text'>".$catalog[$id]['price']."</p>
                                        <form action='cart.php' method='post' id='item$id'>
                                            <input type='hidden' name='id' value='$id'>
                                            <input type='hidden' name='action' value='addItem'>
                                            <a href='#' class='btn btn-primary' onclick='document.getElementById(\"item$id\").submit()'>Add to Cart</a>
                                        </form>
                                    </div>
                                </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; 
            <a href='../index.html'>
                Jared Pinargote 2017
            </a>
        </p>
      </div>
    </footer>

  </body>

</html>