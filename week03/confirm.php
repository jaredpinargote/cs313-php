<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Catalog Page">
    <meta name="author" content="Jared Pinargote">
    <title>Confirmation | JP VR Shop</title>
    <!-- Bootstrap core CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/catalog.css" rel="stylesheet">
    <style>
        .checkout-img{
          height: 50px;
        }

    </style>
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
                        <a class="nav-link" href="viewcart.php">Cart(0) <img src="icon/cart.svg" id="icon" onerror="this.src='your.png'">
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content -->
    <div class="container" id="content">
        <div class="alert alert-success" role="alert">
            <strong>Congrats!</strong> Your order has been submitted and is being processed
        </div>
        <h1>Confirmation Page</h1>
        <h3>Billing Information</h3>
        <?php
            // Sanitize text
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            foreach ($_POST as $key => $value) {
                echo "$value<br>";
            }
        ?>
        <?php
            // error checking:
            // ini_set('display_errors',1); 
            // error_reporting(E_ALL); 
        ?>
        <br>
        <h3>Review</h3>
        <?php
            session_start();

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
            $totalPrice = 0;
            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                foreach ($_SESSION['cart'] as $key => $value) {
                    if($key < 1 || $key > 9){
                        continue;
                    }
                    $name = $catalog[$key]['name'];
                    // $price = $catalog[$key]['price'];
                    $price = $catalog[$key]['price'] * $value;
                    $totalPrice += $price;
                    // echo "<div class='container'>";
                    echo "<div class='row'>";
                    echo "<div class='col-sm-1'><img class='checkout-img' src='img/$key.jpg'></div>";
                    echo "<div class='col-sm-3'>";
                    echo "<br><h4>$name</h4><br>";
                    echo "</div>";
                    echo "<div class='col-sm-3'>";
                    echo "<br><h4>Quantity: $value</h4><br>";
                    echo "</div>";
                    echo "<div class='col-sm-3'>";
                    echo "<br><h4>Price: $price</h4>";
                    echo "</div>";
                    echo "</div>";
                    // echo "</div>";
                    echo "<hr>";
                }
            } else {
                echo "No products!";
            }
            if(isset($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
        ?>
        <h2>Total: <?php echo $totalPrice ?></h2>
        <a href='catalog.php' class='btn btn-default'>Return to Catalog</a>
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