<?php
// Start the session
session_start();

// Handle desired action
switch ($_POST['action']) {
    // Unable to fully implement...
    case 'updateQuantiy':
        updateQuantity();    
        break;

    case 'addItem':
        addToCart();
        break;

    case 'deleteItem':
        deleteFromCart();
        break;
    
    default:
        header("location:catalog.php");
        die();
        break;
}

function updateQuantity(){
    # code...
}

function deleteFromCart(){
    unset($_SESSION['cart'][$_POST['id']]);
    header("location:viewcart.php");
    die();
}

function addToCart(){
    // Set session variables
    $itemToAdd = $_POST['id'];
    if(isset($_SESSION['cart'][$itemToAdd])) {
        $_SESSION['cart'][$itemToAdd] += 1;
    } else {
        $_SESSION['cart'][$itemToAdd] = 1;
    }
    header("location:catalog.php");
    die();
}
?>