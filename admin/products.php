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
    <title>Продукты</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>


<div class="admin-menu">
    <div class="container">
        <div class="d-flex justify-content-center gap-5 pt-5">
                <a  href="../index.php" class="btn btn-danger" style="width:200px;">На главну <i class="bi bi-arrow-bar-left"></i></a>
                <a href="cat.php" class="btn btn-outline-danger" style="width:200px;">Категории товаров</a>
                <a href="products.php" class="btn btn-outline-dark disabled" style="width:200px;">Продукты</a>
                <a href="orders.php" class="btn btn-outline-danger" style="width:200px;">Заказы</a>
                <div style="text-align: center;">
                    <div class="but">
                        <a class="btn btn-success px-5" href="add-prod.php"><i class="bi bi-cloud-plus"></i></a>
                    </div>
                </div>
        </div>
    </div>
</div>
    <div class="table">
        <?php

            error_reporting(E_ALL);
            header('Content-Type: text/html; charset=utf8');
            $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
            if ($conn->connect_error) die("Fatal Error");

        ?>
        <table class="m-5" style="border:none;">


            <?php
                $B = "";
                $show = "all";
                $dsp_all = "display: none;";
                require_once 'functions.php';

                if ((isset($_POST['exe'])) && (isset($_POST['id_product']))) {

                    echo "<script>alert('Товар успешно изменен!')</script>";

                    $id_product = $_POST['id_product'];
                    $query = sprintf("SELECT photo1 FROM products WHERE `products`.`id_pr` = '%s'", mysqli_real_escape_string($conn, $id_product));
                    $result = $conn->query($query);

                    $row = $result->fetch_array(MYSQLI_NUM);
                    $ph1 = htmlspecialchars($row[0]);
                    // $ph2 = htmlspecialchars($row[1]);
                    // $ph3 = htmlspecialchars($row[2]);

                    if ($_FILES['filename1']['name'] == '') {

                    }
                    else{

                        $file_name = $_FILES['filename1']['name'];
                        if(isImage($file_name)){
                            deleteFile('../'.$ph1);
                            $newExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                            $newName = time();
                            $dir='images/prdcts';
                            $dir1='../images/prdcts';
                            move_uploaded_file($_FILES['filename1']['tmp_name'],sprintf('%s/%s.%s',$dir1, $newName, $newExtension));
                            $ph1  = sprintf('%s/%s.%s',$dir, $newName, $newExtension);
                        }
                        else{

                        }

                    }
                    // if ($_FILES['filename2']['name'] == '') {

                    // }
                    // else{
                    //     $file_name = $_FILES['filename2']['name'];
                    //     if(isImage($file_name)){
                    //         deleteFile('../'.$ph2);
                    //         $newExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                    //         $newName = time()+5;
                    //         $dir='images/prdcts';
                    //         $dir1='../images/prdcts';
                    //         move_uploaded_file($_FILES['filename2']['tmp_name'],sprintf('%s/%s.%s',$dir1, $newName, $newExtension));
                    //         $ph2  = sprintf('%s/%s.%s',$dir, $newName, $newExtension);
                    //     }
                    //     else{

                    //     }

                    // }
                    // if ($_FILES['filename3']['name'] == '') {

                    // }
                    // else{
                    //     $file_name = $_FILES['filename3']['name'];
                    //     if(isImage($file_name)){
                    //         deleteFile('../'.$ph3);
                    //         $newExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                    //         $newName = time()+10;
                    //         $dir='images/prdcts';
                    //         $dir1='../images/prdcts';
                    //         move_uploaded_file($_FILES['filename3']['tmp_name'],sprintf('%s/%s.%s',$dir1, $newName, $newExtension));
                    //         $ph3  = sprintf('%s/%s.%s',$dir, $newName, $newExtension);
                    //     }
                    //     else{

                    //     }

                    // }


                    $name_prod=$_POST['name_prod'];
                    $des=$_POST['des'];
                    // $prof = $old - $new;


                    if(!isset($_POST['best'])){
                        $bestS= 0;
                    }
                    else{
                        $bestS= 1;
                    }

                    if(!isset($_POST['sale'])){
                        $sal = 0;
                    }
                    else{
                        $sal = 1;
                    }

                    $cat = $_POST['cats'];

                    $avail = "6";

                    $country = $_POST['country'];
                    $new = $_POST['newPrice'];

                    $query = sprintf("UPDATE `products` SET `photo1`='%s',`photo2`='0',`photo3`='0',`name_prod`='%s',`about`='%s',`old_price`='0',`new_price`='%s',`profit`='5',
                        `best_sel`='%s',`sale`='0',`id_cat`='%s',`avail`='34',`country`='%s'
                        WHERE `products`.`id_pr` = '%s'",
                            mysqli_real_escape_string($conn, $ph1),
                            // mysqli_real_escape_string($conn, $ph2),
                            // mysqli_real_escape_string($conn, $ph3),
                            mysqli_real_escape_string($conn, $name_prod),
                            mysqli_real_escape_string($conn, $des),
                            // mysqli_real_escape_string($conn, $old),
                            mysqli_real_escape_string($conn, $new),
                            // mysqli_real_escape_string($conn, $prof),
                            mysqli_real_escape_string($conn, $bestS),
                            // mysqli_real_escape_string($conn, $sal),
                            mysqli_real_escape_string($conn, $cat),
                            // mysqli_real_escape_string($conn, $avail),
                            mysqli_real_escape_string($conn, $country),
                            mysqli_real_escape_string($conn, $id_product));


                    $result  = $conn->query($query);
                    $show = "justEDIT";

                }

                if ((isset($_POST['des']))  && (isset($_POST['newPrice'])) && (isset($_POST['name_prod'])) && (isset($_POST['do'])))
                {
                    echo "<script>alert('Товар успешно добавлен!')</script>";
                    if ($_FILES['filename1']['name'] == '') {

                    }
                    else{

                        $file_name = $_FILES['filename1']['name']; //название 1-го файла с расширением!
                        if(isImage($file_name)){

                            $newExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                            $newName = time();
                            $dir='images/prdcts';
                            $dir1='../images/prdcts';
                            move_uploaded_file($_FILES['filename1']['tmp_name'],sprintf('%s/%s.%s',$dir1, $newName, $newExtension));
                            $ph1  = sprintf('%s/%s.%s',$dir, $newName, $newExtension);
                        }
                        else{

                        }

                    }
                    // if ($_FILES['filename2']['name'] == '') {

                    // }
                    // else{
                    //     $file_name = $_FILES['filename2']['name'];
                    //     if(isImage($file_name)){

                    //         $newExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                    //         $newName = time()+5;
                    //         $dir='images/prdcts';
                    //         $dir1='../images/prdcts';
                    //         move_uploaded_file($_FILES['filename2']['tmp_name'],sprintf('%s/%s.%s',$dir1, $newName, $newExtension));
                    //         $ph2  = sprintf('%s/%s.%s',$dir, $newName, $newExtension);
                    //     }
                    //     else{

                    //     }

                    // }
                    // if ($_FILES['filename3']['name'] == '') {

                    // }
                    // else{
                    //     $file_name = $_FILES['filename3']['name'];
                    //     if(isImage($file_name)){
                    //         $newExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                    //         $newName = time()+10;
                    //         $dir='images/prdcts';
                    //         $dir1='../images/prdcts';
                    //         move_uploaded_file($_FILES['filename3']['tmp_name'],sprintf('%s/%s.%s',$dir1, $newName, $newExtension));
                    //         $ph3  = sprintf('%s/%s.%s',$dir, $newName, $newExtension);
                    //     }
                    //     else{

                    //     }

                    // }

                    $name_prod=$_POST['name_prod'];
                    $des=$_POST['des'];
                    $new=$_POST['newPrice'];



                    if(!isset($_POST['best'])){
                        $bestS= 0;
                    }
                    else{
                        $bestS= 1;
                    }

                    if(!isset($_POST['sale'])){
                        $sal = 0;
                    }
                    else{
                        $sal = 1;
                    }

                    $cat = $_POST['cats'];

                    $avail = '1111';

                    $country = $_POST['country'];


                    $query = sprintf("INSERT INTO `products`(`photo1`,`photo2`,`photo3`,`name_prod`,`about`,`old_price`,`new_price`,`profit`,`best_sel`,`sale`,`id_cat`,`avail`,`country`)
                        VALUES('%s', '1','2','%s','%s','3','%s','4','%s','%s','%s','%s','%s')",
                            mysqli_real_escape_string($conn, $ph1),
                            // mysqli_real_escape_string($conn, $ph2),
                            // mysqli_real_escape_string($conn, $ph3),
                            mysqli_real_escape_string($conn, $name_prod),
                            mysqli_real_escape_string($conn, $des),
                            // mysqli_real_escape_string($conn, $old),
                            mysqli_real_escape_string($conn, $new),
                            // mysqli_real_escape_string($conn, $prof),
                            mysqli_real_escape_string($conn, $bestS),
                            mysqli_real_escape_string($conn, $sal),
                            mysqli_real_escape_string($conn, $cat),
                            mysqli_real_escape_string($conn, $avail),
                            mysqli_real_escape_string($conn, $country));

                    $result  = $conn->query($query);
                    $show = "justADD";

                }






                if (isset($_POST['btn-del']))
                {
                    $id = $_POST['btn-del'];

                    $query = sprintf("SELECT photo1, photo2, photo3 FROM products WHERE `products`.`id_pr` = '%s'", mysqli_real_escape_string($conn, $id));
                    $result = $conn->query($query);

                    $row = $result->fetch_array(MYSQLI_NUM);
                    $r0 = '../'.htmlspecialchars($row[0]);
                    $r1 = '../'.htmlspecialchars($row[1]);
                    $r2 = '../'.htmlspecialchars($row[2]);


                    $query = sprintf("DELETE FROM `products` WHERE `products`.`id_pr` = '%s'", mysqli_real_escape_string($conn, $id));

                    $result = $conn->query($query);
                    if (!$result){
                        echo <<<ALERTCAT
                        <div style="right: 300px; top: 200px;" class="alert"><p>Произошла ошибка!</p></div>;
ALERTCAT;
                    }
                    else{
                        deleteFile($r0);
                        deleteFile($r1);
                        deleteFile($r2);
                        echo <<<ALERTCAT
                        <div style="right: 300px; top: 200px;" class="alert"><p>Успешно удалено!</p></div>
ALERTCAT;
                    }

                }

                if($show == 'all')
                {

                    $query = "SELECT * FROM products
                        JOIN cats ON cats.id_cat = products.id_cat";


                }
                if($show == 'justEDIT') {
                    $query = "SELECT * FROM `products`
                        JOIN `cats` ON `cats`.`id_cat` = `products`.`id_cat`
                        WHERE `products`.`id_pr` = $id_product";

                    $dsp_all = "display: block;";

                }
                if($show == 'justADD') {
                    $query = "SELECT * FROM `products`
                        JOIN `cats` ON `cats`.`id_cat` = `products`.`id_cat`
                        WHERE `products`.`id_pr` = (SELECT MAX(`id_pr`) FROM `products`)";


                    $dsp_all = "display: block;";


                }

                $result = $conn->query($query);


                if($show == 'all')
                {
                    $rows = $result->num_rows;

                }
                if($show == 'justEDIT') {
                    $rows = 1;
                }
                if($show == 'justADD') {
                    $rows = 1;
                }


            for ($j = 0; $j < $rows; ++$j) {
                $row = $result->fetch_array(MYSQLI_NUM);

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

                        <tr class="card d-flex justify-content-between align-items-center gap-5 mb-5 flex-row"
                        style=" padding: 30px 40px; border-radius: 20px;">
                            <td>$r0</td>
                            <td>
                                <img style="width: 200px;" src="../$r1">

                            </td>
                            <td>$r4</td>
                            <td style="text-align: left;">$r5</td>
                            <td>$r7</td>

                            <td>$r15</td>
                            <td class="d-flex gap-2">
                                <form action="products.php" method="post">
                                    <label class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i>
                                        <input name="btn-del" class="del-prod" style="display: none;" type="submit" value="$r0">
                                    </label>

                                </form>

                                <form action="edit-prod.php" method="post">
                                <label class="btn btn-success">
                                    <i class="bi bi-pencil-square"></i>
                                    <input style="display: none;" name="edit" class="del-prod" value="$r0" type="submit">
                                </label>
                                </form>
                            </td>
                        </tr>

PR;
            }
            echo <<<SHOW
                <div class="showAllprod container">
                        <a style="$dsp_all" class="btn btn-dark mt-5" href="products.php">ПОКАЗАТЬ ВСЕ ТОВАРЫ</a>
                </div>
SHOW;
            ?>
        </table>

    </div>




    <?php $conn->close(); ?>
</body>

</html>