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
    <title>Категории</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="admin-menu container" style="width:80%;">
            <div class="">
                <div class="d-flex justify-content-center gap-5 pt-5 mb-5">
                        <a  href="../index.php" class="btn btn-danger" style="width:200px;">На главну <i class="bi bi-arrow-bar-left"></i></a>
                        <a href="cat.php" class="btn btn-outline-dark disabled" style="width:200px;">Категории товаров</a>
                        <a href="products.php" class="btn btn-outline-danger" style="width:200px;">Продукты</a>
                        <a href="orders.php" class="btn btn-outline-danger" style="width:200px;">Заказы</a>
                </div>




                <div class="contr d-flex flex-column">

                <?php
                    error_reporting(E_ALL);
                    header('Content-Type: text/html; charset=utf8');
                    $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                    if ($conn->connect_error) die("Fatal Error");

                    if (isset($_POST['upd_cat']) && isset($_POST['id_cat']))
                    {

                        $name_cate = $_POST['upd_cat'];
                        $idCat = $_POST['id_cat'];

                        $query = sprintf("UPDATE `cats` SET `cat_name` = '%s' WHERE `cats`.`id_cat` = '%s'", mysqli_real_escape_string($conn, $name_cate), mysqli_real_escape_string($conn, $idCat));


                        // echo '<p style="color: red; font-size: 16px;">'.$query.'</p><br><br>';
                        $result  = $conn->query($query);
                        echo <<<ALERTCAT
                        <div class="alert"><p class="text-success">Категория была успешно обновлена!</p></div>
ALERTCAT;

                    }
                    else {
                        $name_cate = '';
                        $idCat = '';
                    }

                    if (isset($_POST['add_cat']))
                    {

                        $name_cat = $_POST['add_cat'];
                        $file_name = $_FILES['file']['name'];

                        mysqli_query($conn,"INSERT INTO `cats` (`id_cat`, `cat_name`, `cat_img`) VALUES (NULL, '$name_cat', '$file_name')");
                        echo <<<ALERTCAT
                        <div class="alert"><p class="text-success">Добавлена новая категория товаров!</p></div>
ALERTCAT;

                    }
                    else {
                        $name_cat = '';
                    }


                    if (isset($_GET['del'])) {
                        $idCat = $_GET['del'];

                        $query = sprintf("DELETE FROM `cats` WHERE `cats`.`id_cat` = '%s'", mysqli_real_escape_string($conn, $idCat));

                        // echo '<p style="color: red; font-size: 16px;">'.$query.'</p><br><br>';
                        $result = $conn->query($query);
                        echo <<<ALERTCAT
                            <div class="alert text-danger"><p>Категория удалена!</p></div>
                ALERTCAT;
                    }
                ?>

                    <div style="background-color: #ddd; padding: 25px;  border-radius: 15px; margin: 0 0 50px;">
                        <table>

                            <div class="row mb-4" style="border-bottom: 1px solid $ddd;">
                                <div class="col-5">ID</div>
                                <div class="col-5">Категория</div>
                                <div class="col-2"></div>
                            </div>
                            <?php




                                $query = "SELECT * FROM cats";

                                $result = $conn->query($query);

                                $rows = $result->num_rows;

                                for ($j = 0; $j < $rows; ++$j) {
                                    $row = $result->fetch_array(MYSQLI_NUM);

                                    $r0 = htmlspecialchars($row[0]);
                                    $r1 = htmlspecialchars($row[1]);
                                    echo <<<CATS
                                        <div class="row mb-3">
                                            <div class="col-5">$r0</div>
                                            <div class="col-5">$r1</div>
                                            <div class="col-2"><a class="btn text-danger" style="color: black;" href="cat.php?del=$r0"><i class="bi bi-trash-fill"></i><a></div>
                                        </div>
                            CATS;
                                }

                                mysqli_free_result($result);
                                mysqli_close($conn);
                            ?>

                        </table>
                    </div>


                    <div class="d-flex gap-5 form-control p-5 mb-5">
                        <form action="cat.php" class="frm-cat" style="width: 500px;" method="post">

                            <div class="path">
                            <?php
                                echo <<< _OUT
                                <label for="id_cat">ID категории:
                                    <input style="width: 100%;" class="id_c" value="$idCat" name="id_cat" required title="Смотрите в таблице (выше)" type="text" min="0" max="1000000" oninput="validity.valid||(value='');">
                                </label>

    _OUT;
                            ?>

                            </div>

                            <div class="path">

                            <?php
                                echo <<< _OUT
                                <label for="upd_cat" class="mb-3">Новое название:
                                    <input style="width: 100%;" value="$name_cate" class="nm_cat" type="text" name="upd_cat" required maxlength= "23">
                                </label>
    _OUT;
                            ?>


                            </div>

                            <input class="btn btn-outline-danger" type="submit" value="Изменить">

                        </form>

                        <form action="cat.php" class="frm-cat" style="width: 500px;" method="post" enctype='multipart/form-data'>
                            <div class="path">
                            <?php
                                echo <<< _OUT
                                <label for="add_cat" class="mb-3">Название:

                                    <input value="$name_cat" class="nm_cat" style="width: 100%;" type="text" name="add_cat" required maxlength= "23">

                                </label>

                                <label class="mb-3 btn btn-outline-success" style="width: 265px;">
                                    <i class="bi bi-cloud-plus"></i>
                                    <input type='file' class="btn btn-outline-success" style="display:none;" required name='file' size='15'>
                                </label>
    _OUT;
                            ?>


                            </div>


                            <input class="btn btn-outline-danger" type="submit" value="Добавить">

                        </form>
                    </div>


                    <?php



                    $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                    if ($conn->connect_error) die("Fatal Error");

                    $items = mysqli_query($conn, "SELECT * FROM `brands`");
                    $items = mysqli_fetch_all($items);
                    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    ?>
                    <div class="container" style="background-color: #ddd; padding: 25px;  border-radius: 15px; margin: 0 0 50px;" >
                    <?php
                    foreach($items as $item) {
                    ?>

                    <div class="d-flex justify-content-between container mb-3">
                            <div class="">
                                <?=$item[0]?>
                            </div>
                            <div class="">
                                <?=$item[2]?>
                            </div>
                            <form action="../brand.php" method="post">
                                <input type="hidden" name="url" value="<?=$url?>">
                                <input type="hidden" name="del" value="<?=$item[0]?>">
                                <button type="submit" class="btn text-danger">Удалить</button>
                            </form>
                    </div>
                    <?php
                    }
                    ?>
                     </div>
                    <div class="form-control p-4 d-flex justify-content-between">
                        <form action="../brand.php" method="post" class="d-flex flex-column" style="width: 40%;" enctype='multipart/form-data'>
                            <label for="">
                                ID бренда:
                                <input type="text" name="brand" class="form-control" >
                                Новое название:
                                <input type="text" name="name" class="form-control mb-3">
                                <input type="hidden" name="url" value="<?=$url?>">
                                Новое описание:
                                <textarea class="form-control mb-3" style="resize: none;" name="desbr" id="" cols="30" rows="10"></textarea>
                            </label>

                            <label for="" class="btn btn-success mb-3" style="font-size: 22px;">
                                <i class="bi bi-cloud-plus"></i>
                                <input type="file" name="filebr" style="opacity: 0;">
                            </label>

                            <button type="submit" class="btn btn-outline-danger">Изменить</button>
                        </form>

                        <form action="../brand.php" method="post" class="d-flex flex-column" style="width: 40%;" enctype='multipart/form-data'>
                            <label for="">
                                Название:
                                <input type="text" name="namecr" class="form-control mb-3">
                                <input type="hidden" name="url" value="<?=$url?>">
                                Описание:
                                <textarea class="form-control mb-3" style="resize: none;" name="descr" id="" cols="30" rows="10"></textarea>
                            </label>

                            <label for="" class="btn btn-success mb-3" style="font-size: 22px;">
                                <i class="bi bi-cloud-plus"></i>
                                <input type="file" name="filecr" style="opacity: 0;">
                            </label>

                            <button type="submit" class="btn btn-outline-danger">Создать</button>
                        </form>

                </div>



            </div>
        </div>
    </div>


</body>

</html>