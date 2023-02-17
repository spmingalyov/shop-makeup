<?php

error_reporting(-1);
session_start();
require_once('funcs.php');

if (isset($_GET['cart'])) {
    switch ($_GET['cart']) {
        case 'add':
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $price = isset($_GET['price']) ? $_GET['price'] : 0;
            $count = isset($_GET['countt']) ? (int)$_GET['countt'] : 0;
            
            add_to_cart($id, $price, $count);
            
            echo json_encode(['code' => 'ok', 'answer' => $_SESSION['cart.qty']]);
        
            break;
        
        case 'plus':
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $price = isset($_GET['price']) ? $_GET['price'] : 0;
            $count = isset($_GET['countt']) ? (int)$_GET['countt'] : 0;
            
            add_to_cart($id, $price, $count);
            $dd = (int)$_SESSION['cart'][$id]['qty'] * (int)$_SESSION['cart'][$id]['price'];
            echo json_encode(['code' => 'ok', 'answer3' => $dd,'answer1' => $_SESSION['cart.sum'], 'answer2' => $_SESSION['cart'][$id]['qty']]);
        
            break;
        case 'minus':
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $price = isset($_GET['price']) ? $_GET['price'] : 0;
            $count = isset($_GET['countt']) ? (int)$_GET['countt']*(-1) : 0;
            
            add_to_cart($id, $price, $count);
            $dd = (int)$_SESSION['cart'][$id]['qty'] * (int)$_SESSION['cart'][$id]['price'];
            echo json_encode(['code' => 'ok', 'answer3' => $dd,'answer1' => $_SESSION['cart.sum'], 'answer2' => $_SESSION['cart'][$id]['qty']]);
        
            break;
        case 'likeplus':
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            add_to_like($id);
            if (isset($_SESSION['like'][$id]) && !empty($_SESSION['like'][$id])){
                echo json_encode(['code' => 'ok', 'answer' => 'green']);
            }
            else {
                echo json_encode(['code' => 'ok', 'answer' => 'red']);
            }
            
            break;
    }
}