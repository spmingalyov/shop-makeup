<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Магазин для визажистов MakeUp-SPB.ru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css"
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
        <div class = "container">
            <div class = "row">

            <?php
                error_reporting(E_ALL);
                header('Content-Type: text/html; charset=utf8');
                $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                if ($conn->connect_error) die("Fatal Error");

                $query = "SELECT * FROM cats";

                $result = $conn->query($query);

                $rows = $result->num_rows;

                for ($j = 0; $j < $rows; ++$j) {
                    $row = $result->fetch_array(MYSQLI_NUM);

                    $r0 = htmlspecialchars($row[0]);
                    $r1 = htmlspecialchars($row[1]);


                }

            ?>

            </div>
        </div>
    </div>

    <div class="about-content">
        <div class = "container">
          <h2 class=""><p class="txt_hello_title">Makeup-spb</p></h2>
          <p class="txt_hello">

          это место, где присутствуют только товары высокого качества, потому что выбирают их профессиональные визажисты.

          Покупая у нас Вы можете быть уверены, что получите профессиональную консультацию, вежливое обслуживание и качественный товар!

          Наша история началась в 2013 году. Тогда появился наш интернет магазин с очень узким, но тщательно подобранным ассортиментом товаров.

          Сейчас MakeUp-SPB это:
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

        <div class="d-flex flex-wrap mt-5 container">
          <img style="width: 50%" src="images/about/inet.jpg" alt="">
          <img style="width: 50%" src="images/about/shop1.jpg" alt="">
          <img style="width: 50%" src="images/about/studio1.jpg" alt="">
          <img style="width: 50%" src="images/about/studio2.jpg" alt="">
        </div>
    </div>



    <div class="footer container-fluid mt-5" style="background-color: #943354; position: absolut; bottom: 0">
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


    <?php $conn->close(); ?>
</body>
</html>

