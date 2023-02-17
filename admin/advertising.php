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
    <title>Админ панель - реклама</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../univ-cat.css">
    <link rel="stylesheet" href="../basket.css">
    <link rel="stylesheet" href="ap.css">
    <link rel="stylesheet" href="cat.css">
    <link rel="stylesheet" href="advertising.css">

</head>

<body>

    <div class="nav">
        <div class="container">
            <div class="row">
                <div style = "padding: 5px; display: inline-block; border: solid 1px green;" class="nav_paths">
                    <p><a style="font-weight: bold;" href="../index.php">< Вернуться на главную</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-menu">
        <div class="container">
            <div class="row">
                <div class="ap-title">
                    <p>ПАНЕЛЬ УПРАВЛЕНИЯ</p>
                </div>


                <div style="text-align: center;">

                    <div class="but">
                        <a style="font-weight: bold;" href="cat.php">Категории товаров</a>
                    </div>

                    <div class="but">
                        <a style="font-weight: bold;" href="products.php">Товары</a>
                    </div>

                    <div class="but">
                        <a style="font-weight: bold;" href="orders.php">Заказы</a>
                    </div>

                    <div class="but">
                        <a style="font-weight: bold;" href="accounts.php">Учетные записи</a>
                    </div>

                    <div class="buts">
                        <a style="color: black; font-weight: bold;">Рекламный баннер</a>
                    </div>
                </div>
                <?php
                    require_once 'functions.php';
                    $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                    if ($conn->connect_error) die("Fatal Error");

                    $query = "SELECT * FROM adv";

                    $result = $conn->query($query);
                    $row = $result->fetch_array(MYSQLI_NUM);

                    $r0 = htmlspecialchars($row[1]);

                    $rdel = '../'.htmlspecialchars($row[1]);



                    if ($_FILES['filename']['name'] == '') {
                        $sn_ph = $r0;
                    }
                    else{
                        $file_name = $_FILES['filename']['name'];
                        if(isImage($file_name)){
                            deleteFile($rdel);

                            $newExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                            $newName = time();
                            $dir='images/advertising';
                            $dir1='../images/advertising';
                            move_uploaded_file($_FILES['filename']['tmp_name'],sprintf('%s/%s.%s',$dir1, $newName, $newExtension));
                            $sn_ph  = sprintf('%s/%s.%s',$dir, $newName, $newExtension);

                            $query = sprintf("UPDATE `adv` SET `picture` = '%s'", mysqli_real_escape_string($conn, $sn_ph));

                            $result  = $conn->query($query);
                            echo <<<ALERTTT
                                <div style="top: 700px;"class="alert"><p>Успешно изменен!</p></div>
ALERTTT;
                        }
                        else{
                            $sn_ph = $r0;
                            echo <<<ALERTT
                                <div style="top: 700px;"class="alert"><p>Выбранный файл не является изображением!</p></div>
ALERTT;
                        }


                    }

                    echo <<<ADV
                    <div class="old_adv">
                        <p class="txt_hello">Текущий рекламный баннер:</p>
                        <img src="../$sn_ph">
                    </div>
ADV;
                ?>




                <form action="advertising.php" method="post" class="upd_adver" enctype='multipart/form-data'>

                    <p class="txt_hello">Новый рекламный баннер:</p>
                    <input type='file' name='filename' size='15' required>
                    <input class="buttons" type="submit" value="Заменить">

                </form>







            </div>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>

</html>