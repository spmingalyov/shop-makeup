<?php
function debug(array $data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function add_to_cart($id, $price, int $count)
{
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $count;
    } else {
        
        $_SESSION['cart'][$id] = [
            'price' => $price,
            'qty' => $count,
        ];
    }
    $a = $price * $count;
    if(isset($_SESSION['cart.qty']) && !empty($_SESSION['cart.qty'])){
        $_SESSION['cart.qty'] = $_SESSION['cart.qty'] + $count;    
    }
    else{
        $_SESSION['cart.qty'] = $count;
    }
    if(isset($_SESSION['cart.sum']) && !empty($_SESSION['cart.sum'])){
        $_SESSION['cart.sum'] = $_SESSION['cart.sum'] + $a;
    }
    else{
        $_SESSION['cart.sum'] = $a;
    }
    
}
function add_to_like($id)
{
    if (isset($_SESSION['like'][$id]) && !empty($_SESSION['like'][$id])) {
        unset($_SESSION['like'][$id]);
    } else {
        
        $_SESSION['like'][$id] = [
            'good' => 'day',
        ];
    }
}
