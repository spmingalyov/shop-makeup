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
    <title>Админ панель - изменить товар</title>
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

                <?php
                    require_once 'functions.php';
                    error_reporting(E_ALL);
                    header('Content-Type: text/html; charset=utf8');



                    $av_sh = '';

                    $av_sk = '';

                    $av_ms= '';

                    $av_fa= '';





                    $bolg = '';

                    $veng = '';

                    $ger = '';

                    $den = '';

                    $ispan = '';

                    $ital = '';

                    $rus = '';

                    $japan = '';

                    $china = '';



                    $cat_press = '';

                    // if(isset($_POST['avail'])) {
                    //     $avai = $_POST['avail'];
                    //     setcookie("avai", $avai);
                    // }
                    // if(isset($_COOKIE['avai'])){
                    //     $avai = $_COOKIE['avai'];
                    // };




                    $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                    if ($conn->connect_error) die("Fatal Error");
                    $id_p = '';
                    if (isset($_POST['edit'])){

                        $id_p = $_POST['edit'];

                        $query = sprintf("SELECT * FROM `products`
                        JOIN `cats` ON `cats`.`id_cat` = `products`.`id_cat`
                        WHERE `products`.`id_pr` = '%s'", mysqli_real_escape_string($conn, $id_p));

                        $result = $conn->query($query);


                        $row = $result->fetch_array(MYSQLI_NUM);

                        $r0 = htmlspecialchars($row[0]);
                        $r1 = '../'.htmlspecialchars($row[1]);
                        $r2 = '../'.htmlspecialchars($row[2]);
                        $r3 = '../'.htmlspecialchars($row[3]);
                        $r4 = htmlspecialchars($row[4]);
                        $r5 = htmlspecialchars($row[5]);
                        $r6 = htmlspecialchars($row[6]);
                        $r7 = htmlspecialchars($row[7]);
                        $r8 = htmlspecialchars($row[8]);
                        $r9 = htmlspecialchars($row[9]);
                        $r10 = htmlspecialchars($row[10]);
                        $r11 = htmlspecialchars($row[11]);
                        $r12 = htmlspecialchars($row[12]);
                        $r13 = htmlspecialchars($row[13]);
                        $r14 = htmlspecialchars($row[14]);
                        $r15 = htmlspecialchars($row[15]);

                        if ($r9 == 1)
                        {
                            $bst = 'checked';
                        }
                        else{
                            $bst = '';
                        }

                        if ($r10 == 1)
                        {
                            $sall = 'checked';
                        }
                        else{
                            $sall = '';
                        }


                        if ($r12 == 'shop')
                        {
                            $av_sh = 'selected';
                        }
                        if ($r12 == 'sklad')
                        {
                            $av_sk = 'selected';
                        }

                        if ($r12 == 'msk')
                        {
                            $av_ms = 'selected';
                        }
                        if ($r12 == 'far')
                        {
                            $av_fa = 'selected';
                        }


                        if ($r13 == 'Болгария')
                        {
                            $bolg = 'selected';
                        }

                        if ($r13 == 'Венгрия')
                        {
                            $veng = 'selected';
                        }

                        if ($r13 == 'Германия')
                        {
                            $ger = 'selected';
                        }

                        if ($r13 == 'Дания')
                        {
                            $den = 'selected';
                        }

                        if ($r13 == 'Испания')
                        {
                            $ispan = 'selected';
                        }

                        if ($r13 == 'Италия')
                        {
                            $ital = 'selected';
                        }

                        if ($r13 == 'Россия')
                        {
                            $rus = 'selected';
                        }

                        if ($r13 == 'Япония')
                        {
                            $japan = 'selected';
                        }

                        if ($r13 == 'Китай')
                        {
                            $china = 'selected';
                        }

                        $cat_press = $r11;


                    }





                echo <<<FRM
                <form class="frm-add-prd d-flex flex-column align-items-center" method="post" action="products.php" enctype='multipart/form-data'>

                    <div class="lvls d-flex align-items-center">
                        <label style="vertical-align: top; font-size: 22px;"></label>
                        <img style="display: inline-block; max-width: 150px;" src="$r1">
                        <label style="vertical-align: top; font-size: 22px; width: 300px;" class="btn btn-success">
                            <i class="bi bi-cloud-plus-fill"></i>
                            <input style="vertical-align: top; display: none; " type='file' name='filename1' size='15'>
                        </label>
                    </div>




                    <div class="lvls">
                        <label style="vertical-align: top; font-size: 22px;"></label>
                        <textarea required maxlength= "150" name="name_prod" style="font-size: 20px;width: 60%; height:80px; resize: none; width:700px;" class="form-control mb-3">$r4</textarea>
                    </div>

                    <div class="lvls">
                        <label style="vertical-align: top; font-size: 22px;"></label>
                        <textarea required maxlength= "500" name="des" style="font-size: 20px;width: 60%; height:200px; resize: none; width:700px;" class="form-control mb-3">$r5</textarea>
                    </div>



                    <div class="lvls">
                        <label style="font-size: 22px; width:700px;"></label>
                        <input required name="newPrice" value="$r7" maxlength="10" style="font-size: 20px; width:700px;" type="text" size="10" min="0" max="100000" oninput="validity.valid||(value='');" class="form-control">
                    </div>
FRM;
                    ?>




                    <div style="display: inline-block;" class="lvls">
                        <label style="font-size: 22px; width:700px;"></label>

                        <select class = "selects form-select mb-3" style="font-size: 22px;" name="cats">
                            <?php
                                $query = "SELECT * FROM cats";

                                $result = $conn->query($query);

                                $rows = $result->num_rows;

                                for ($j = 0; $j < $rows; ++$j) {
                                    $row = $result->fetch_array(MYSQLI_NUM);


                                    $r0 = htmlspecialchars($row[0]);
                                    $r1 = htmlspecialchars($row[1]);

                                    if ($cat_press == $r0){
                                        $c = 'selected';
                                    }
                                    else{
                                        $c = '';
                                    }

                                    echo <<<_CAT
                                        <option $c value="$r0">$r1</option>
_CAT;
                                }
                            ?>

                        </select>
                    </div>

                    <div style="display: inline-block;" class="lvls">
                        <label style="font-size: 22px;  width:700px">
                                <input type="text" name="country" placeholder="Производитель" class="form-control" style="font-size: 22px;" value="<?=$r13?>">
                        </label>
                    </div>

                    <div style="width: 40%; text-align: center; display: inline-block;" class="lvls">
                        <label style="display: inline-block; font-size: 22px;">Новинка:</label>
                        <p style="display: inline-block; font-size: 22px;"><input <?php echo "$bst"?> style = "margin-right: 10px;" type="checkbox" name="best" value="true"/></p>
                    </div>

                    <input name="exe" style ="border-radius: 8px; display: block; margin: 40px auto;
                    text-align: center;  font-size: 20px; width: 700px;" type="submit" value="Сохранить" class="btn btn-outline-danger">
                    <input type='hidden' name="id_product" value="<?php echo $id_p;?>">

                </form>


            </div>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>

</html>