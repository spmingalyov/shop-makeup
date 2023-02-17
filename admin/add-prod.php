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
    <title>Добавить товар</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>


    <div class="admin-menu container" style="width:80%; margin:">
            <div class="container">
                <div class="d-flex justify-content-center gap-5 pt-5 mb-5">
                        <a  href="../index.php" class="btn btn-danger" style="width:200px;">На главну <i class="bi bi-arrow-bar-left"></i></a>
                        <a href="cat.php" class="btn btn-outline-danger" style="width:200px;">Категории товаров</a>
                        <a href="products.php" class="btn btn-outline-dark disabled" style="width:200px;">Продукты</a>
                        <a href="orders.php" class="btn btn-outline-danger" style="width:200px;">Заказы</a>

                </div>



                <?php
                    require_once 'functions.php';
                    error_reporting(E_ALL);
                    header('Content-Type: text/html; charset=utf8');

                    // if(isset($_POST['avail'])) {
                    //     $avai = $_POST['avail'];
                    //     setcookie("avai", $avai);
                    // }
                    // if(isset($_COOKIE['avai'])){
                    //     $avai = $_COOKIE['avai'];
                    // };




                    $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                    if ($conn->connect_error) die("Fatal Error");




                ?>

                <form class="frm-add-prd text-center p-5 d-flex flex-column justify-content-center align-items-center" method="post" action="products.php" enctype='multipart/form-data'>

                    <div class="lvls" style="width:700px;"> Загрузить фото:
                        <label style="font-size: 22px;" class="btn btn-outline-success px-5 m-4">
                            <i class="bi bi-cloud-plus"></i>
                            <input type='file' required name='filename1' size='15' style="display: none;">
                        </label>
                    </div>
<!--
                    <div class="lvls">
                        <label style="font-size: 22px;">Выберите изображение №2: </label>
                        <input type='file' required name='filename2' size='15'>
                    </div>

                    <div class="lvls">
                        <label style="font-size: 22px;">Выберите изображение №3: </label>
                        <input type='file' required name='filename3' size='15'>
                    </div> -->

                    <div class="lvls">
                        <label style="vertical-align: top; font-size: 22px; width:700px" class="mb-4">
                            <textarea required maxlength= "150" name="name_prod" placeholder="Введите название" style="resize: none; height: 50px; width:700px; font-size: 22px;" class="form-control mb-3"></textarea>
                        </label>

                    </div>

                    <div class="lvls">
                        <label style="vertical-align: top; font-size: 22px;">
                            <textarea required maxlength= "500" name="des" style="font-size: 22px; width:700px; height:200px; resize: none;" class="form-control mb-3" placeholder="Описание товара"></textarea>
                        </label>
                    </div>

                    <!-- <div class="lvls">
                        <label style="font-size: 22px;">Старая цена (руб.):</label>
                        <input required name="oldPrice" maxlength="10" style="font-size: 20px;" type="number" size="10" min="0" max="100000" oninput="validity.valid||(value='');">
                    </div> -->

                    <div class="lvls">
                        <label style="font-size: 22px;">
                            <input required name="newPrice" maxlength="10" style="font-size: 22px; width:700px;" type="text" size="10" min="0" max="100000" oninput="validity.valid||(value='');" placeholder="Цена" class="form-control mb-3">
                        </label>
                    </div>


                    <!-- <div style="text-align: center; width: 40%; display: inline-block;" class="lvls">
                        <label style="display: inline-block; font-size: 22px;">Участвует в распродаже?</label>
                        <p style="display: inline-block; font-size: 22px;"><input style = "margin-right: 10px;" type="checkbox" name="sale" value="true"/>Да</p>
                    </div> -->


                    <div style="display: inline-block;" class="lvls">
                        <label style="font-size: 22px;  width:700px;"</label>

                        <select class = "selects form-select mb-3" name="cats" style="font-size: 22px;">
                            <?php
                                $query = "SELECT * FROM cats";

                                $result = $conn->query($query);

                                $rows = $result->num_rows;

                                for ($j = 0; $j < $rows; ++$j) {
                                    $row = $result->fetch_array(MYSQLI_NUM);

                                    $r0 = htmlspecialchars($row[0]);
                                    $r1 = htmlspecialchars($row[1]);

                                    echo <<<_CAT
                                        <option value="$r0">$r1</option>
_CAT;
                                }

                            ?>

                        </select>
                    </div>

                    <!-- <div style="display: inline-block;" class="lvls">
                        <label style="font-size: 22px; margin-right:20px;">Наличие:</label>

                        <select class = "selects" name="avail">
                            <option value="shop">в магазинах</option>
                            <option value="sklad">в наличии на складе</option>
                            <option value="msk">со склада МСК, срок 3-7 дней</option>
                            <option value="far">на удаленном складе</option>
                        </select>
                    </div> -->

                    <div style="display: inline-block;" class="lvls">
                        <label style="font-size: 22px;  width:700px">
                                <input type="text" name="country" placeholder="Производитель" class="form-control" style="font-size: 22px;">
                        </label>
                    </div>


                    <div style="width: 40%; text-align: center; display: inline-block;" class="lvls">
                        <label style="display: inline-block; font-size: 22px;">Новинка:</label>
                        <p style="display: inline-block; font-size: 22px;"><input style = "margin-right: 10px;" type="checkbox" name="best" value="true"/></p>
                    </div>

                    <input name="do" style ="border-radius: 8px; display: block; margin: 40px auto;
                    text-align: center; font-size: 20px; width:700px;" type="submit" value="Добавить" class="btn btn-outline-danger">

                </form>

            </div>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>

</html>