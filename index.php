<?php
  session_start();
  require_once('funcs.php');

  if(isset($_GET['delete']))

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Магазин для визажистов MakeUp-SPB.ru</title>
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


  <div >
    <div class = "container">
      <div class = "">
      <?php
        error_reporting(E_ALL);
        header('Content-Type: text/html; charset=utf8');
        $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
        if ($conn->connect_error) die("Fatal Error");

        $query = "SELECT * FROM cats";

        $result = $conn->query($query);

        $rows = $result->num_rows;

        ?>
      <div class="d-flex gap-5 flex-wrap py-3 justify-content-center">
        <?php
        for ($j = 0; $j < $rows; ++$j) {
          $row = $result->fetch_array(MYSQLI_NUM);

          $r0 = htmlspecialchars($row[0]);
          $r1 = htmlspecialchars($row[1]);
          $r2 = htmlspecialchars($row[2]);

          echo <<<CATS

          <a href="univ-cat.php?cat=$r0" class="item">
          <img src="images/grid-catalog/$r2" >
          <p>$r1</p></a>
CATS;
        }
      ?>

      </div>


      </div>
    </div>
  </div>


  </div>

  <div style="position: relative;" class="bestsellers">
    <div class = "container">
      <div>
        <h2 class=""><p class="txt_bestsel_sale">Новинки</p></h2>
          <div class="slider2">
            <div class="slider-line2">
              <?php
              $query = "SELECT * FROM `products` WHERE `products`.`best_sel` = '1'";

              $result = $conn->query($query);

              $rows = $result->num_rows;

              $mx = ($rows)  * 310;

              echo <<<KD
              <input value="$mx" id="mx" type="hidden">
KD;
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

                $r8 = htmlspecialchars($row[8]);
                $r9 = htmlspecialchars($row[9]);

                $r10 = htmlspecialchars($row[10]);
                $r11 = htmlspecialchars($row[11]);

                echo <<<BST
                <div class="index-card-product text-center px-5">
                  <div class="prdct-content d-flex flex-column justify-content-center">
                    <a href="univ-prdct.php?product=$r0&cat=$r11"><img class="indx_img" src="$r1" style="max-width: 300px;"></a>

                    <div>$r4</div>

                    <div class="prices">
                      <div class="new_price py-3"><p>$r7 ₽</p></div>
                    </div>


                    <a href="?cart=add&id=$r0" class="ato-bask btn btn-outline-danger" data-id="$r0" data-price="$r7">В корзину</a>

                    <div class="prices">
                      <div style="font-size: 16px; height:43px; width:179px; position:relative;overflow:hidden;">
                        <div id="block$r0" style="width:179px;display:inline;position:absolute;left:0;">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

BST;
              }
            ?>
            </div>
          </div>



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
    <button class="slider-p" style="color:black; background-color: transparent;"><i class="bi bi-chevron-left"></i></button>
    <button class="slider-n" style="color:black; background-color: transparent;"><i class="bi bi-chevron-right"></i></button>

  </div>

  <div style="position: relative;" class="sale">
    <div class = "container">
      <div class = "row">
        <h2 class=""><p class="txt_bestsel_sale">Бренды</p></h2>
        <div class="slider">
          <div class="slider-line gap-5">
        <?php
          $query = "SELECT * FROM `brands`";

          $result = $conn->query($query);

          $rows = $result->num_rows;
          $mxx = ($rows - 2 )  * 309;

          echo <<<KD
          <input value="$mxx" id="mxxx" type="hidden">
KD;

              for ($j = 0; $j < $rows; ++$j) {
                $row = $result->fetch_array(MYSQLI_NUM);

                $r0 = htmlspecialchars($row[0]);
                $r1 = htmlspecialchars($row[1]);

                $r2 = htmlspecialchars($row[2]);


                echo <<<B

                <div class="index-card-product mr-2 align-items-center container">

                  <div class="prdct-content gap-3  align-items-center " style="position: relative; height:200px;">
                    <a href="brand.php?id=$r0"><img class="indx_img" style="width: 300px;" src="images/brand/$r1"></a>

                    <div style="position: absolute; bottom:0; left: 50%;" style="margin-left: 50px;"> $r2</div>
                  </div>

                </div>

B;
              }
            ?>
          </div>
            <a href="all-brands.php" class="btn btn-outline-dark mt-5 ms-4" style="width:300px;">Все бренды</a>
        </div>


      </div>
    </div>
    <button class="slider-prv" style="color:black; background-color: transparent;"><i class="bi bi-chevron-left"></i></button>
    <button class="slider-nt" style="color:black; background-color: transparent;"><i class="bi bi-chevron-right"></i></button>

  </div>

  <div class="txt_block">
    <div class = "container mb-5">
      <div class = "row">
      <h2 class=""><p class="txt_hello_title">Makeup-spb</p></h2>
        <p class="txt_hello">

        это место, где присутствуют только товары высокого качества, потому что выбирают их профессиональные визажисты.

        Покупая у нас Вы можете быть уверены, что получите профессиональную консультацию, вежливое обслуживание и качественный товар!

        Наша история началась в 2013 году. Тогда появился наш интернет магазин с очень узким, но тщательно подобранным ассортиментом товаров.

        Сейчас MakeUp-SPB это:
        </p>

        <div class="bottom" id="gradient"></div>
        <script>
          function Spoiler() {
            var ele_grad = document.getElementById("gradient");
            var ele = document.getElementById("contentSpoiler");
            var text = document.getElementById("linkSpoiler");
            if(ele.style.display == "block") {
              ele.style.display = "none";
              text.innerHTML = "Читать далее...";
              ele_grad.style.opacity = 1;
              }
            else {
              ele.style.display = "block";
              text.innerHTML = "Скрыть";
              ele_grad.style.opacity = 0;
            }
          }
        </script>
        <div id="contentSpoiler" style="display: none;">
          <h2 class=""><p class="txt_hello_title">Интернет-магазин</p></h2>
          <p class="txt_hello">
          - Несколько тысяч товаров в наличии
          </p>
          <p class="txt_hello">
          - Бесплатная и быстрая доставка Ваших заказов по всей РФ
          </p>
          <p class="txt_hello">
          - Наши консультанты - профессинальные визажисты
          </p>
          <p class="txt_hello">
          - Оперативная обработка и доставка заказов
          </p>
          <p class="txt_hello">
          - Удобные способы оплаты
          </p>
          <p class="txt_hello">
          - Акции и скидки мастерам
          </p>
          <h2 class=""><p class="txt_hello_title">Оффлайн-магазин</p></h2>
          <p class="txt_hello">
          - Работаем ежедневно
          </p>
          <p class="txt_hello">
          - Тестеры на всю продукцию
          </p>
          <p class="txt_hello">
          - Профессиональные консультанты
          </p>
          <p class="txt_hello">
          - Рядом с метро
          </p>


          <h2 class=""><p class="txt_hello_title">Школа макияжа и причесок</p></h2>
          <p class="txt_hello">
          - Лучшие программы обучения
          </p>
          <p class="txt_hello">
          - Опытные преподаватели
          </p>
          <p class="txt_hello">
          - Предоставляем всю косметику, расходные, одноразовые материалы
          </p>
          <p class="txt_hello">
          - Собственный магазин косметики
          </p>
        </div>
        <a href="javascript:Spoiler();" class="link_spoiler" id="linkSpoiler">Читать далее...</a>
      </div>
    </div>
  </div>

  <div class="footer container-fluid" style="background-color: #943354;">
    <div class = "container p-3" >
      <div>
        <div class="footer-left d-flex gap-5 align-items-center justify-content-between">
          <div><a class = "href_ind" href=""><p style="text-decoration: underline; color: #fff;" class="txt_footer">Адреса и контакты</p></a></div>

            <div><a class = "href_ind" href="AboutUs.php"><p style="text-decoration: underline; color: #fff;" class="txt_footer">О компании</p></a></div>


            <div class=" d-flex gap-3">
              <a href="tel:86001016791" style="color: #fff;">8 (600) 101-67-91</a>
              <a href="tel:85129883845" style="color: #fff;">8 (512) 988-38-45</a>
            </div>
            <a class = "href_ind" href="index.php"><img class="logo" src="images/logo_ny.png" style="width: 230px;" ></a>
        </div>
      </div>
    </div>
  </div>



  <script src="script1.js"></script>
  <script src="script.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script src="main.js"></script>
  <?php $conn->close();?>
</body>
</html>

