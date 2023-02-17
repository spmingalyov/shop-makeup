<?php
    session_start();
    if (!isset($_SESSION['current_user']) || $_SESSION['current_user'] == null) {
        header("Location: ../index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель - товары</title>
    <link rel="stylesheet" href="../reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css"
    <link rel="stylesheet" href="functions.php">

</head>

<body>


    <div class="admin-menu">
    <div class="container">
        <div class="d-flex justify-content-center gap-5 pt-5 mb-5">
                <a  href="../index.php" class="btn btn-danger" style="width:200px;">На главну <i class="bi bi-arrow-bar-left"></i></a>
                <a href="cat.php" class="btn btn-outline-danger" style="width:200px;">Категории товаров</a>
                <a href="products.php" class="btn btn-outline-danger" style="width:200px;">Продукты</a>
                <a href="orders.php" class="btn btn-outline-danger" style="width:200px;">Заказы</a>
        </div>
    </div>

    <div class="table">
        <?php

            error_reporting(E_ALL);
            header('Content-Type: text/html; charset=utf8');
            $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
            if ($conn->connect_error) die("Fatal Error");

        ?>
        <table class="container">



            <?php

                require_once 'functions.php';

                $id = $_GET['ord'];
                $query = "SELECT * FROM `products`
                    JOIN `cats` ON `cats`.`id_cat` = `products`.`id_cat`
                    JOIN `products_orders` ON `products_orders`.`id_pr` =  `products`.`id_pr`
                    WHERE `products_orders`.`id_ord` = $id";

                $result = $conn->query($query);
                $rows = $result->num_rows;


            for ($j = 0; $j < $rows; ++$j) {
                $row = $result->fetch_array();

                $r0 = htmlspecialchars($row[0]);
                $r1 = htmlspecialchars($row[1]);

                $r2 = htmlspecialchars($row[2]);
                $r3 = htmlspecialchars($row[3]);

                $r4 = htmlspecialchars($row[4]);
                $r5 = htmlspecialchars($row[5]);

                $r6 = htmlspecialchars($row[6]);
                $r7 = htmlspecialchars($row[7]);

                $r9 = boolval(htmlspecialchars($row[9]))? 'Да' : 'Нет';
                $r11 = boolval(htmlspecialchars($row[10]))? 'Да' : 'Нет';
                $r12 = htmlspecialchars($row[12]);
                $r13 = htmlspecialchars($row[13]);
                $r14 = htmlspecialchars($row[14]);
                $r15 = htmlspecialchars($row[15]);
                $r16 = htmlspecialchars($row['count']);

                $avi='';

                switch ($r12) {
                    case 'shop':
                        $avi='в магазине';
                        break;
                    case 'sklad':
                        $avi='в наличии на складе';
                        break;
                    case 'msk':
                        $avi='со склада МСК, срок 3-7 дней';
                        break;
                    case 'far':
                        $avi='на удаленном складе';
                        break;
                }

                echo <<<PR

                        <tr class="container form-control d-flex align-items-center justify-content-between px-5 mb-3">
                            <td>$r0</td>
                            <td style="border-right: none;" class="text-center">
                                <img src="../$r1" style="width: 300px;">
                            </td>
                            <td  style="text-align: center; width: 200px;"> $r4</td>


                            <td>$r7</td>

                            <td>$r13</td>
                            <td>$r15</td>
                            <td>
                                $r16
                                шт
                            </td>
                        </tr>

PR;
            }
            ?>
        </table>

    </div>




    <?php $conn->close(); ?>
</body>

</html>