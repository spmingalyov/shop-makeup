$(function() {

    // function showCart(cart) {
    //     $('#cart-modal .modal-cart-content').html(cart);
    //     $('#cart-modal').modal();

    //     let cartQty = $_SESSION['cart.qty'];
    //     $('#countpr').text(cartQty);
    // }

    $('.ato-bask').on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let price = $(this).data('price');
        let count = 1;
        $.ajax({
            url: 'cart.php',
            type: 'GET',
            data: {cart: 'add', id: id, price: price, countt: count},
            dataType: 'json',
            success: function (res) {
                if (res.code == 'ok') {
                    $('#countpr').text(res.answer);
                } else {
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error');
            }
        });
        
    });

    $('.cat-to-bask1').on('click', function (e) {
        e.preventDefault();
        
        let id = $(this).data('id');
        let price = $(this).data('price');
        var val = document.getElementById(id).value;
        

        $.ajax({
            url: 'cart.php',
            type: 'GET',
            data: {cart: 'add', id: id, price: price, countt: val},
            dataType: 'json',
            success: function (res) {
                if (res.code == 'ok') {
                    $('#count').text(res.answer);
                } else {
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error');
            }
        });
    });

    $('.subm-ord').on('click', function (e) {
        e.preventDefault();
        
        let id = $(this).data('id');
        let price = $(this).data('price');
        let t = 'k'+id;
        var val = document.getElementById(t).value;
        

        $.ajax({
            url: 'cart.php',
            type: 'GET',
            data: {cart: 'add', id: id, price: price, countt: val},
            dataType: 'json',
            success: function (res) {
                if (res.code == 'ok') {
                    $('#countpr').text(res.answer);
                } else {
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error');
            }
        });
    });

    $('.up1').on('click', function (e) {
        
        let id = $(this).data('id');
        let price = $(this).data('price');
        let count = 1;
        let d = '#inp'+id;
        let c = '#c'+id;
        // console.log(id, price, d, c);
        $.ajax({
            url: 'cart.php',
            type: 'GET',
            data: {cart: 'plus', id: id, price: price, countt: count},
            dataType: 'json',
            success: function (res) {
                if (res.code == 'ok') {
                    $(d).text(res.answer3+' ₽');
                    $(c).val(res.answer2);
                    $('.aft').text(res.answer1+' ₽');
                } else {
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error');
            }
        });     
            
    });

    $('.down1').on('click', function (e) {
        
        let id = $(this).data('id');
        let price = $(this).data('price');
        let count = 1;
        let d = '#inp'+id;
        let c = '#c'+id;
        let min = $(c).val();
        if(min <= 1){
            alert("Минимальное количество товара - 1")
        }
        else{
            $.ajax({
                url: 'cart.php',
                type: 'GET',
                data: {cart: 'minus', id: id, price: price, countt: count},
                dataType: 'json',
                success: function (res) {
                    if (res.code == 'ok') {
                        $(d).text(res.answer3+' ₽');
                        $(c).val(res.answer2);
                        $('.aft').text(res.answer1+' ₽');
                    } else {
                        alert(res.answer);
                    }
                },
                error: function () {
                    alert('Error');
                }
            });  
        }
           
            
    });

    $('.likee').on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let i = '#i'+id;
        
        $.ajax({
            url: 'cart.php',
            type: 'GET',
            data: {cart: 'likeplus', id: id},
            dataType: 'json',
            success: function (res) {
                if (res.code == 'ok') {
                    $(i).css('background-color', res.answer);
                } else {
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error');
            }
        });  
        
           
            
    });
    $('#li-cart').on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let price = $(this).data('price');
        let count = 1;
        $.ajax({
            url: 'cart.php',
            type: 'GET',
            data: {cart: 'add', id: id, price: price, countt: count},
            dataType: 'json',
            success: function (res) {
                if (res.code == 'ok') {
                    $('#countpr').text(res.answer);
                    $('#li-cart').css('color', 'black');
                    $('#li-cart').css('pointer-events', 'none');
                    $('#li-cart').text('В корзине');
                } else {
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error');
            }
        });
        
    });
   

});