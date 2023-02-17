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
    <title>Админ панель - заказы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css"

</head>

<body>


    </div>

    <div class="admin-menu">
    <div class="container">
        <div class="d-flex justify-content-center gap-5 pt-5 mb-5">
                <a  href="../index.php" class="btn btn-danger" style="width:200px;">На главну <i class="bi bi-arrow-bar-left"></i></a>
                <a href="cat.php" class="btn btn-outline-danger" style="width:200px;">Категории товаров</a>
                <a href="products.php" class="btn btn-outline-danger" style="width:200px;">Продукты</a>
                <a href="orders.php" class="btn btn-outline-dark disabled" style="width:200px;">Заказы</a>
        </div>
    </div>

                <table style="width:100%;" class="container">
                    <tr>
                        <th>ID</th>
                        <th>Заказчик</th>
                        <th>Телефон</th>
                        <th>Дата</th>
                        <th>Итого</th>
                        <th>Статус заказа</th>
                    </tr>
                <?php
                    error_reporting(E_ALL);
                    header('Content-Type: text/html; charset=utf8');
                    $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                    if ($conn->connect_error) die("Fatal Error");
                    if (isset($_POST['chng']))
                    {
                        $st = $_POST['status'];
                        $idd= $_POST['id'];
                        $query = sprintf(
                            "UPDATE `orders` SET `status`='%s'
                            WHERE `orders`.`id_ord` = '%s'",
                            mysqli_real_escape_string($conn, $st),
                            mysqli_real_escape_string($conn, $idd));
                        // echo "<p style='font-size: 25px;'>".$query."</p>";
                        $result  = $conn->query($query);
                    }


                    $query = "SELECT * FROM orders";
                    $result = $conn->query($query);
                    $rows = $result->num_rows;
                    for ($j = 0; $j < $rows; ++$j) {
                        $row = $result->fetch_array();


                        $r1 = htmlspecialchars($row['id_ord']);

                        $r2 = htmlspecialchars($row['customer']);

                        $r3 = htmlspecialchars($row['phone_number']);

                        $r4 = htmlspecialchars($row['date']);

                        $r5 = htmlspecialchars($row['status']);

                        $r6 = htmlspecialchars($row['total_price']);
                        $av_sh = '';
                        $av_sk = '';
                        $av_ms = '';
                        $av_fa = '';

                        switch ($r5) {
                            case 'Обрабатывается':
                                $av_sh ='selected';
                                break;
                            case 'В исполнении':
                                $av_sk ='selected';
                                break;
                            case 'Исполнен"':
                                $av_ms ='selected';
                                break;
                            case 'Отклонен':
                                $av_fa ='selected';
                                break;
                        }

                        echo <<<PR

                            <tr >
                                <td>$r1</td>
                                <td>$r2</td>
                                <td>$r3</td>
                                <td>$r4</td>

                                <td>$r6</td>
                                <td>
                                    <form action="orders.php" method="post" class="d-flex gap-2 align-items-center">


                                        <select class="selects form-select" name="status" class="">
                                            <option $av_sh value="Обрабатывается" >Обрабатывается</option>
                                            <option $av_sk value="В исполнении" >В исполнении</option>
                                            <option $av_ms value="Исполнен" >Исполнен</option>
                                            <option $av_fa value="Отклонен" >Отклонен</option>
                                        </select>
                                        <input type="hidden" name="id" value="$r1"></input>
                                        <input style="margin: 10px auto; display: block;" type="submit" name="chng" value="Сохранить" class="btn btn-outline-success"></input>
                                    </form>
                                </td>
                                <td><a href="show-order.php?ord=$r1" class="ms-2 btn btn-outline-secondary">Посмотреть заказ</a></td>

                            </tr>

PR;
                    }


                ?>
                </table>




            </div>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>

</html>