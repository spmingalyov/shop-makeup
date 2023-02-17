<?php
    session_start();
    require_once('funcs.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин для визажистов MakeUp-SPB.ru</title>
    <link rel="stylesheet" href="reset.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class=" container-fluid">
    <div class = "container py-4 " style="border-buttom: 1px solid #000;">
      <div class="d-flex align-items-center justify-content-between">
        <a class = "href_ind" href="index.php"><img class="logo" src="images/logo_ny.png" style="width: 230px;" ></a>

        <div class=" d-flex gap-3">
        <a href="tel:86001016791">8 (600) 101-67-91</a>
        <a href="tel:85129883845">8 (512) 988-38-45</a>
        </div>


        <button  class="position-relative" style="background: transparent; padding: 0px; border: none;">
          <a href="basket.php" class="h" style="text-decoration: none;"><i class="bi bi-bag-fill" style="font-size: 32px; color: #4e4f4e; text-decoration: none; position: relative; border: 0;"></i><span id="count" style="position: absolute;"><?= $_SESSION['cart.qty'] ?? 0 ?></span>
        </button>


        <div class="whoami">
          <form method="post" action="login.php">
          <?php
            if (isset($_SESSION['current_user']) || $_SESSION['current_user'] != null){
              echo <<<_ADM
              <div class="d-flex gap-3 align-items-center">
                <input type="hidden" name="quit" value="yes"></input>
                <div class="txt_logo" id="qu-bt" style="padding-left: 5px;"><a href="admin/ap.php" style="text-decoration: none;"><p style="color: #000;" class="h-login"> Админка</p></a></div>
                <button type="submit" id="en-bt" class="txt_logo btn btn-danger" style="border: none; height: 40px;"><a  style="text-decoration: none;"><p class="h-login"> Выйти <i class="bi bi-box-arrow-right"></i></p></a></button>
              </div>
_ADM;
            }
            else {
              echo <<<_ADM

              <button class="btn btn-danger mt-4" style="height: 40px;" id="qu-bt"><a href="login.php" style="text-decoration: none; color: #fff;"><p>Войти <i class="bi bi-person-square"></i></p></a></button>
_ADM;
            }
          ?>
          </form>
        </div>


      </div>
    </div>
  </div>


    <div class="categories">
        <div class="container">
            <div class="row">
            <?php
                error_reporting(E_ALL);
                header('Content-Type: text/html; charset=utf8');

                if ($_POST){

                    if(isset($_POST['msk'])) {
                        $cook4 = $_POST['msk'];
                    }
                    else {
                        $cook4 = 'no';
                    }


                    if(isset($_POST['ordBy'])) {
                        $cook1 = $_POST['ordBy'];
                    }
                    else {
                        $cook1 = 'name_prod ASC';
                    }

                    if(isset($_POST['shop'])) {
                        $cook2 = $_POST['shop'];

                    }
                    else {
                        $cook2 = 'no';

                    }

                    if(isset($_POST['sklad'])) {
                        $cook3 = $_POST['sklad'];

                    }
                    else {
                        $cook3 = 'no';

                    }


                    if(isset($_POST['far'])) {
                        $cook5 = $_POST['far'];

                    }
                    else {
                        $cook5 = 'no';

                    }


                    if(isset($_POST['B'])) {
                        $cook8 = $_POST['B'];

                    }
                    else {
                        $cook8 = 'no';

                    }


                    if(isset($_POST['V'])) {
                        $cook9 = $_POST['V'];

                    }
                    else {
                        $cook9 = 'no';



                    }


                    if(isset($_POST['G'])) {
                        $cook10 = $_POST['G'];

                    }
                    else {
                        $cook10 = 'no';



                    }


                    if(isset($_POST['D'])) {
                        $cook11 = $_POST['D'];

                    }
                    else {
                        $cook11 = 'no';


                    }



                    if(isset($_POST['S'])) {
                        $cook12 = $_POST['S'];

                    }
                    else {
                        $cook12 = 'no';


                    }


                    if(isset($_POST['I'])) {
                        $cook13 = $_POST['I'];

                    }
                    else {
                        $cook13 = 'no';


                    }


                    if(isset($_POST['R'])) {
                        $cook14 = $_POST['R'];

                    }
                    else {
                        $cook14 = 'no';



                    }

                    if(isset($_POST['J'])) {
                        $cook15 = $_POST['J'];

                    }
                    else {
                        $cook15 = 'no';


                    }


                    if(isset($_POST['C'])) {
                        $cook16 = $_POST['C'];

                    }
                    else {
                        $cook16 = 'no';

                    }

                }
                else {

                    $cook1 = 'name_prod ASC';

                    $cook2 = 'no';

                    $cook3 = 'no';

                    $cook4 = 'no';

                    $cook5 = 'no';

                    $cook8 = 'no';

                    $cook9 = 'no';

                    $cook10 = 'no';

                    $cook11 = 'no';

                    $cook12 = 'no';

                    $cook13 = 'no';

                    $cook14 = 'no';

                    $cook15 = 'no';

                    $cook16 = 'no';

                }


                $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                if ($conn->connect_error) die("Fatal Error");

                $query = "SELECT * FROM cats";

                $result = $conn->query($query);

                $rows = $result->num_rows;

                $press_cat = $_REQUEST['cat'];

                for ($j = 0; $j < $rows; ++$j) {
                    $row = $result->fetch_array(MYSQLI_NUM);

                    $r0 = htmlspecialchars($row[0]);
                    $r1 = htmlspecialchars($row[1]);

                    if ($r0 == $press_cat){
                        $press_name = $r1;
                    }

                }


      ?>


            </div>
        </div>
    </div>



    <div class="content">
        <div class="container">
            <div class="row">
                <form method="post" action="univ-cat.php" class="d-flex justify-content-between">
                    <div class="cont-left" style="width: 25%">

                        <p>Цена</p>

                        <div class="category-filter-range">
                            <?php
                                $query = "SELECT MAX(new_price) FROM `products`
                                WHERE `products`.`id_cat` = $press_cat";

                                $result = $conn->query($query);
                                $row = $result->fetch_array(MYSQLI_NUM);

                                $max_pr = htmlspecialchars($row[0]);

                                $query = "SELECT MIN(new_price) FROM `products`
                                WHERE `products`.`id_cat` = $press_cat";

                                $result = $conn->query($query);
                                $row = $result->fetch_array(MYSQLI_NUM);

                                $min_pr = htmlspecialchars($row[0]);
                                if ($_POST) {
                                    if(isset($_POST['MAX'])) {
                                        $cook6 = $_POST['MAX'];

                                    }
                                    else {
                                        $cook6 = $max_pr;

                                    }

                                    if(isset($_POST['MIN'])) {
                                        $cook7 = $_POST['MIN'];

                                    }
                                    else {
                                        $cook7 = $min_pr;

                                    }


                                }
                                else{
                                    $cook6 = $max_pr;

                                    $cook7 = $min_pr;

                                }


                                echo <<<pric
                                <div class="d-flex gap-1 align-items-center mb-3">
                                    <input name="MIN" class="form-control" requared maxlength="10" style="font-size: 16px; max-width: 80px;"  size="10" value="$cook7" min="0" max="100000" oninput="validity.valid||(value='');">
                                    <span>—</span>
                                    <input name="MAX" class="form-control" requared maxlength="10" style="font-size: 16px; max-width: 80px;" value="$cook6" size="10" min="0" max="100000" oninput="validity.valid||(value='');">
                                    <span>₽</span>
                                </div>
pric;
                            ?>
                        </div>

                        <select name="ordBy" class="form-select mb-3" style="max-width: 200px;">
                            <option <?php if($cook1 == "name_prod ASC") {echo 'selected';}?> value="name_prod ASC">По имени</option>
                            <option <?php if($cook1 == "new_price ASC") {echo 'selected';}?> value="new_price ASC">Сначала подешевле</option>
                            <option <?php if($cook1 == "new_price DESC") {echo 'selected';}?> value="new_price DESC">Сначала подороже</option>

                        </select>

                        <input type="hidden" value="<?php echo $press_cat;?>" name="cat">
                        <button name="show-btn" value="filtr" type="submit" class="to-bask btn btn-outline-secondary" style="height: 40px; width:200px;"><p class="txt_ind_prod">Показать</p></button>


                    </div>

                    <div class="cont-right" style="width: 85%">
                        <div class="cont-title">

                            <?php

                                if (($cook2 == "yes") || ($cook3 == "yes") || ($cook4 == "yes") || ($cook5 == "yes"))
                                {
                                    $av = "AND (";
                                    $kolvo = 0;
                                    if ($cook2 == "yes") {
                                        $kolvo += 1;
                                        $av= $av."`products`.`avail` = 'shop'";
                                    }
                                    else{

                                    }


                                    if ($cook3 == "yes") {
                                        if($kolvo > 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = "";
                                        }
                                        $kolvo += 1;
                                        $av= $av.$orr."`products`.`avail` = 'sklad'";
                                    }
                                    else{

                                    }


                                    if ($cook4 == "yes") {
                                        if($kolvo > 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kolvo += 1;
                                        $av= $av.$orr."`products`.`avail` = 'msk'";
                                    }
                                    else{

                                    }


                                    if ($cook5 == "yes") {
                                        if($kolvo > 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kolvo += 1;
                                        $av= $av.$orr."`products`.`avail` = 'far'";
                                    }
                                    else{

                                    }
                                    $av = $av.")";

                                }
                                else {
                                    $av = "";
                                }



                                if (($cook8 == "yes") || ($cook9 == "yes") || ($cook10  == "yes") || ($cook11 == "yes") || ($cook12 == "yes")
                                    || ($cook13 == "yes") || ($cook14 == "yes") || ($cook15 == "yes") || ($cook16 == "yes") )
                                {
                                    $c= "AND (";
                                    $kol = 0;

                                    if ($cook8 == "yes") {
                                        $kol+= 1;
                                        $c = $c."`products`.`country` = 'Болгария'";
                                    } else {

                                    }


                                    if ($cook9 == "yes") {
                                        if($kol> 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kol++;
                                        $c = $c.$orr."`products`.`country` = 'Венгрия'";
                                    } else {

                                    }

                                    if ($cook10 == "yes") {
                                        if($kol> 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kol++;
                                        $c = $c.$orr."`products`.`country` = 'Германия'";
                                    } else {

                                    }

                                    if ($cook11 == "yes") {
                                        if($kol> 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kol++;
                                        $c = $c.$orr."`products`.`country` = 'Дания'";
                                    } else {

                                    }

                                    if ($cook12 == "yes") {
                                        if($kol> 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kol++;
                                        $c = $c.$orr."`products`.`country` = 'Испания'";
                                    } else {

                                    }

                                    if ($cook13 == "yes") {
                                        if($kol> 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kol++;
                                        $c = $c.$orr."`products`.`country` = 'Италия'";
                                    } else {

                                    }

                                    if ($cook14 == "yes") {
                                        if($kol> 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kol++;
                                        $c = $c.$orr."`products`.`country` = 'Россия'";
                                    } else {

                                    }

                                    if ($cook15 == "yes") {
                                        if($kol> 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kol++;
                                        $c = $c.$orr."`products`.`country` = 'Япония'";
                                    } else {

                                    }

                                    if ($cook16 == "yes") {
                                        if($kol> 0){
                                            $orr = ' OR ';
                                        }
                                        else{
                                            $orr = '';
                                        }
                                        $kol++;
                                        $c = $c.$orr."`products`.`country` = 'Китай'";
                                    } else {

                                    }
                                    $c = $c.")";
                                }
                                else {
                                    $c = "";
                                }


                                $maxp = $cook6;
                                $minp = $cook7;

                                if($maxp < $minp){
                                    $maxp = $minp;
                                }
                                $prs= "(new_price BETWEEN ".$minp." AND ".$maxp.")";



                                $query = "SELECT * FROM `products`
                                JOIN `cats` ON `cats`.`id_cat` = `products`.`id_cat`
                                WHERE `products`.`id_cat` = $press_cat $av $c AND $prs
                                ORDER BY $cook1";

                                if(isset($_POST['clean'])){
                                       $cl = $_POST['clean'];
                                }

                                //echo '<button name="show-btn" value="filtr" type="submit" class="to-bask"><p class="txt_ind_prod">'.$cl.'</p></button>';

                                $result = $conn->query($query);

                                $rows = $result->num_rows;

                            echo <<<RW
                            <div class="d-flex gap-2">
                                <h2 class="txt_bestsel_sale">$press_name</h2>
                                <span class="count_of_products">$rows</span>
                            </div>
RW;
                            ?>

                        </div>
                        <script>
                            function increaseCount(a, b) {
                                var input = b.previousElementSibling;
                                var value = parseInt(input.value, 10);
                                value = isNaN(value) ? 0 : value;
                                value++;
                                input.value = value;
                            }

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


                </form>
                        <div class="cat-card-product d-flex gap-5">
                            <?php


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
                                        $avi='на складе';
                                        break;
                                    case 'msk':
                                        $avi='со склада МСК, срок 3-7 дней';
                                        break;
                                    case 'far':
                                        $avi='на удаленном складе';
                                        break;
                                }

                                    echo <<<PR
                                    <div class="cat-prdct-content">
                                        <a href="univ-prdct.php?product=$r0&cat=$press_cat" class=""><img class="cat-img" style="max-width: 300px;" src="$r1"></a>


                                            <div class="new_price mb-2">
                                                <strong style="font-size: 25px;">$r7 ₽</strong>
                                            </div>
                                        <div class="prices mb-5">
                                            <div style="font-size: 16px; height:51px; width:179px; position:relative; text-align: center;">
                                                <div id="bloc$r0" style="width:179px;display:inline;position:absolute;left:0;">
                                                    <p Mouseover="move('bloc$r0',-5)" onMouseout="move('bloc$r0',5)">
                                                        <a style="line-height: 19px; line-height: 18px; color: black; text-decoration: none;" href="univ-prdct.php?product=$r0&cat=$press_cat">$r4</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="margin-left: 16px;" class="product-item-kg-counter">


                                            <input type="hidden" id="$r0" value="1" style="opacity=0;"></input>

                                            <a href="?cart=add&id=$r0" class="cat-to-bask1 btn btn-outline-danger mt-2" style="width:250px; backgraund: none;" data-id="$r0" data-price="$r7">В корзину</a>

                                        </div>


                                    </div>
PR;
                                }
                            ?>

                        <script type="text/javascript">
                            function move(id,spd) {
                                var obj=document.getElementById(id);
                                var max=-obj.offsetHeight+obj.parentNode.offsetHeight;
                                var left=parseInt(obj.style.top);

                                if ((spd>0&&top<=0)||(spd<0&&top>=max)){
                                    obj.style.top=top+spd+"px";
                                    move.to=setTimeout(function(){ move(id,spd); },20);
                                }
                                else obj.style.top=(spd>0?0:max)+"px";
                            }
                        </script>



                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="footer container-fluid" style="margin-top: 500px;">
    <div class = " p-3" >
      <div>
        <div class="footer-left d-flex gap-5 align-items-center justify-content-between">
          <div><a class = "href_ind" href=""><p style="text-decoration: underline; color: #000;" class="txt_footer">Адреса и контакты</p></a></div>

            <div><a class = "href_ind" href="AboutUs.php"><p style="text-decoration: underline; color: #000;" class="txt_footer">О компании</p></a></div>


            <div class=" d-flex gap-3">
              <a href="tel:86001016791" style="color: #000;">8 (600) 101-67-91</a>
              <a href="tel:85129883845" style="color: #000;">8 (512) 988-38-45</a>
            </div>
            <a class = "href_ind" href="index.php"><img class="logo" src="images/logo_ny.png" style="width: 230px;" ></a>
        </div>
      </div>
    </div>

  </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="main.js"></script>

    <?php $conn->close(); ?>

</body>

</html>