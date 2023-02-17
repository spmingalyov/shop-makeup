<?php
    session_start();
    error_reporting(-1);
    header('Content-Type: text/html; charset=utf8');
    if(isset($_POST['del-cart'])){
        unset($_SESSION['cart']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.qty']);
    }
    if(isset($_POST['del-one'])){
        unset($_SESSION['cart'][$_POST['del-one']]);
        $_SESSION['cart.sum']-= $_POST['sum'];
        $_SESSION['cart.qty']-= $_POST['cnt'];
    }
    $name = '';
    $phone = '';

    if(isset($_POST['order']) && isset($_SESSION['cart'])){
        $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
        if ($conn->connect_error) die("Fatal Error");
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $total = $_SESSION['cart.sum'];
        $query = sprintf("INSERT INTO `orders`(`customer`, `phone_number`, `total_price`, `status`) VALUES('%s','%s','%s','Обрабатывается')",
            mysqli_real_escape_string($conn, $name),mysqli_real_escape_string($conn, $phone),
            mysqli_real_escape_string($conn, $total));

            $result  = $conn->query($query);
            $idlast = $conn->insert_id;
        foreach ($_SESSION['cart'] as $id => $item){
            $c = $item['qty'];
            $query = sprintf("INSERT INTO `products_orders`(`id_ord`, `id_pr`, `count`) VALUES('%s','%s','%s')",
            mysqli_real_escape_string($conn, $idlast),
            mysqli_real_escape_string($conn, $id),
            mysqli_real_escape_string($conn, $c));
            $result  = $conn->query($query);
        }
        echo <<<ALERTCAT
        <div class="alert text-success" style="position: absolute; left: 25%; width: 400px;"><p>Успешно!</p></div>
ALERTCAT;

    }
    require_once('funcs.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина товаров</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="univ-cat.css">
    <link rel="stylesheet" href="basket.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div>
        <div class="container my-4">
            <div style="position: relative;" class="row">
                <a class="href_ind" href="index.php"><img class="logo" src="images/logo_ny.png"></a>


            </div>
        </div>
    </div>


    <div class="ordr">
        <div class="container">
            <div class="row">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <div class="ordr-left p-5" style="background-color: transparent; width: 60%;">

                        <strong>Ваш заказ</strong>
                        <?php
                            $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                            if ($conn->connect_error) die("Fatal Error");
                        ?>
                        <form method="post" action="basket.php" style="position: absolute; top: 65px;  left: 200px;">
                            <input type="submit" name="del-cart" value="очистить корзину"  class="ashka" style="color: #dc3545; font-syle: normal; text-decoration: none;">
                        </form>

                        <?php foreach ($_SESSION['cart'] as $id => $item):


                            $query = "SELECT * FROM products WHERE id_pr = $id";

                            $result = $conn->query($query);

                            $row = $result->fetch_array(MYSQLI_NUM);


                        ?>
                            <div class="ordr-info">
                                <div class="ordr-prdct" style="border-radius: 5px;">
                                    <img src="<?= $row[1] ?>">
                                    <div class="prdct-dscrp" >
                                        <a href="univ-prdct.php?product=<?= $row[0] ?>&cat=<?= $row[12] ?>"><?= $row[4] ?></a>
                                        <form method="post" action="basket.php">
                                            <div style="align-items: right; justify-content: right;" class="product-item-kg-counter">
                                                <span data-id="<?= $id?>" data-price="<?= $row[7]?>" class="down1 btn btn-outline-danger">-</span>
                                                <input style="background-color: white;" id="c<?= $id?>" type="text" name="cnt" value="<?= $item['qty'] ?>"></input>
                                                <span data-id="<?= $id?>" data-price="<?= $row[7]?>" class="up1 btn btn-outline-success">+</span>
                                                <span style="">шт.</span>
                                                <span style="margin-right: 10px;">               </span>
                                                <strong id="inp<?= $id?>" style="position: absolute; right: 20px;"><?= $row[7]*$item['qty'] ?> ₽</strong>
                                            </div>

                                            <input type="hidden" value="<?= $id ?>" name="del-one" >
                                            <input type="hidden" value="<?= $row[7]*$item['qty']?>" name="sum" >

                                            <input type="submit" value="Удалить" style="background-color: transparent; border: none; position: absolute; top: 10%; right: 5%;" class="">

                                        </form>

                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                        <div style="text-align: right;" class="result">
                            <strong class="bef">Итого: </strong>
                            <strong class="aft"><?= $_SESSION['cart.sum'] ?> ₽</strong>
                        </div>

                    </div>
                    <div class="ordr-right" style="width: 40%;">

                        <form style="margin: 110px 0px" class="form-control p-3" method="post" action="basket.php">

                            <div class="frm-itm">
                                <label for="name">Имя<span class="red-txt"> *</span></label>
                                <input required id="name" value="<?= $name?>" type="text" name="name" pattern="^[А-Яа-яЁёA-Za-z\s-]+$" title="Разрешено использовать только буквы, пробелы и дефис" value="" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                            </div>

                            <div class="frm-itm">
                                <label for="phone">Телефон <span class="red-txt"> *</span></label>
                                <input required class="" value="<?= $phone?>" id="phone" type="tel" name="phone" value="">
                            </div>

                            <input type="submit" name="order" class="subm-ord1 btn btn-outline-danger" value="Оформить заказ">
                        </form>
                    </div>
                <?php else: ?>
                    <div style="width: 100%; text-align: center; background-color: transparent;" class="ordr-left" >
                        <strong>Нет товаров в корзине</strong>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="main.js"></script>
    <script>
        // function increaseCount(a, b) {
        //     var input = b.previousElementSibling;
        //     // var value = parseInt(input.value, 10);
        //     // value = isNaN(value) ? 0 : value;
        //     // value++;
        //     // input.value = value;


        // }

        function deacreaseCount(a, b) {
            var input = b.nextElementSibling;
            var value = parseInt(input.value, 10);
            if (value > 1) {
                value = isNaN(value) ? 0 : value;
                value--;
                input.value = value;
            }

        }
    </script>

</body>

</html>