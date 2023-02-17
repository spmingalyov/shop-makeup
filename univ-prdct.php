<?php
    session_start();
    require_once('funcs.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ВМагазин для визажистов MakeUp-SPB.ru</title>
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
          <a href="basket.php" class="h" style="text-decoration: none;"><i class="bi bi-bag-fill" style="font-size: 32px; color: #4e4f4e; text-decoration: none; position: relative; border: 0;"></i><span id="countpr" style="position: absolute;"><?= $_SESSION['cart.qty'] ?? 0 ?></span>
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
        <div class="container d-flex">
            <div class="">

            <?php
                error_reporting(E_ALL);
                header('Content-Type: text/html; charset=utf8');
                $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                if ($conn->connect_error) die("Fatal Error");

                $query = "SELECT * FROM cats";

                $result = $conn->query($query);

                $rows = $result->num_rows;

                $press_cat = $_GET['cat'];

                $press_prd = $_GET['product'];

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

    <div class="card-prdct">
        <div class="container">
            <div class="row">
                <div class="card-title">
                    <?php
                        $query = "SELECT * FROM `products`
                        JOIN `cats` ON `cats`.`id_cat` = `products`.`id_cat`
                        WHERE `products`.`id_pr` = $press_prd";

                        $result = $conn->query($query);

                        $rows = $result->num_rows;

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

                            $r9 = boolval(htmlspecialchars($row[9])) ? 'Да' : 'Нет';
                            $r11 = boolval(htmlspecialchars($row[10])) ? 'Да' : 'Нет';
                            $r12 = htmlspecialchars($row[12]);
                            $r13 = htmlspecialchars($row[13]);
                            $r14 = htmlspecialchars($row[14]);
                            $r15 = htmlspecialchars($row[15]);

                            $avi = '';

                            switch ($r12) {
                                case 'shop':
                                    $avi = 'в наличии в магазине';
                                    break;
                                case 'sklad':
                                    $avi = 'в наличии на складе';
                                    break;
                                case 'msk':
                                    $avi = 'со склада МСК, срок 3-7 дней';
                                    break;
                                case 'far':
                                    $avi = 'в наличии на удаленном складе';
                                    break;
                            }
                        }
                    if (isset($_SESSION['like'][$r0]) && !empty($_SESSION['like'][$r0])){
                        $st = "green";
                    }
                    else {
                        $st = "red";
                    }
                    echo <<<t

                 <div class="d-flex">


                    <div class="card-content">


                        <div class="main-picture"  style="width: 30%;">
                            <img name="imgg" class="main-p mx-5" style="width:400px;" src="$r1">

                        </div>



                    </div>

                <div class="card-about">
                    <div class="left mt-5 mb-1" style="font-weight: bold; font-size: 32px"><b>$r4</b></div>

                    <div class="card-price">
                    <p class="adv-card"><b>Производитель: $r13</b></p>




                <div style="margin-bottom: 20px;"class="new_price">
                    <p style="font-weight: bold; font-size: 32px">$r7 ₽</p>
                </div>





                <div class="product-item-kg-counter my-3">
                    <span class="down btn btn-outline-danger" onclick="deacreaseCount(event, this)">-</span>
                    <input type="text" id="k$r0" value="1" style="width: 20px; height:30px; background-color: transparent; border: none;"></input>
                    <span class="up btn btn-outline-success" onclick="increaseCount(event, this)">+</span>
                </div>

                <a href="?cart=add&id=$r0" class="subm-ord btn btn-outline-danger my-5" style="text-decoration: none; padding: 10px 70px; width: 500px; margin-right: 19px;" data-id="$r0" data-price="$r7">В корзину</a>
            </div>
                    <p><strong>О товаре:</strong></p>
                    <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                         Описание
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            $r5

                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Состав
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        AQUA (WATER) * DIMETHICONE * ISODODECANE * TALC * PEG-10 DIMETHICONE * DIMETHICONE/VINYL DIMETHICONE CROSSPOLYMER * BUTYLENE GLYCOL * HDI/TRIMETHYLOL HEXYLLACTONE CROSSPOLYMER * GLYCERIN * DISTEARDIMONIUM HECTORITE * SILICA * EPILOBIUM FLEISCHERI FLOWER/LEAF/STEM EXTRACT * SODIUM HYALURONATE * TOCOPHERYL ACETATE * ASCORBYL PALMITATE * LECITHIN * TOCOPHEROL * HYDROGEN DIMETHICONE * ALUMINUM HYDROXIDE * SODIUM CHLORIDE * LAURETH- 4 * DISODIUM EDTA * CITRIC ACID * SODIUM DEHYDROACETATE * PHENOXYETHANOL * TROPOLONE * PARFUM (FRAGRANCE) (+/-) CI 77891 (TITANIUM DIOXIDE) * CI 77491 (IRON OXIDES) * CI 77492 (IRON OXIDES) * CI 77499 (IRON OXIDES) * CI 77742 (MANGANESE VIOLET) * CI 77007 (ULTRAMARINES) * CI 77510 (FERRIC AMMONIUM FERROCYANIDE) * CI 42090 (BLUE 1 LAKE) * CI 19140 (YELLOW 5 LAKE) * CI 15850 (RED 7 LAKE) * CI 15850 (RED 6)
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
             </div>
t;
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


    <script src="script2.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="main.js"></script>
    <?php $conn->close();?>
</body>

</html>