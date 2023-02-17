<?php
  session_start();
  require_once('funcs.php');
  if(isset($_POST['del'])){
    unset($_SESSION['like'][$_POST['id']]);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Избранное</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="univ-cat.css">
    <link rel="stylesheet" href="basket.css">
    <link rel="stylesheet" href="like.css">
</head>

<body>

    <div class="header">
        <div class = "container">
          <div style="position: relative;" class = "row">
            <a class = "href_ind" href="index.php"><img class="logo" src="images/logo_index.png"></a>

            <div class="txt_logo"><p>Компетентная сантехника</p></div>

            <div class="like_basket">
              <a href="like.php"><img class="head_icons" src="images/like.png"></a>
              <a href="basket.php" class="h"><img class="head_icons" src="images/basket.png"><p id="countpr"><?= $_SESSION['cart.qty'] ?? 0 ?></span></p>
            </div>


            <div class="whoami">
              <form method="post" action="login.php">
              <?php
                if (isset($_SESSION['current_user']) || $_SESSION['current_user'] != null){
                  echo <<<_ADM
                  <input type="hidden" name="quit" value="yes"></input>
                  <div class="txt_logo" id="qu-bt" style="transform: rotate(-4deg); border: 1px solid white; border-radius: 5px; background-color: rgb(126, 158, 38); padding-left: 5px;"><a href="/admin/ap.php" style="text-decoration: none;"><p style="color: white;" class="h-login"> АДМИН ПАНЕЛЬ</p></a></div>
                  <div class="txt_logo"><p>Администратор |  </p></div>
                  <button type="submit" id="en-bt" class="txt_logo" style="border: none ; background-color: rgb(126, 158, 38); padding-left: 5px;"><a  style="text-decoration: none;"><p class="h-login"> Выйти</p></a></button>
_ADM;
                }
                else {
                  echo <<<_ADM

                  <div class="txt_logo"><p>Неавторизированный пользователь |  </p></div>
                  <button class="txt_logo" id="qu-bt" style="border: none ; background-color: rgb(126, 158, 38); padding-left: 5px;"><a href="login.php?" style="text-decoration: none;"><p class="h-login"> Войти</p></a></button>
_ADM;
                }
              ?>
              </form>
          </div>


          </div>
        </div>
      </div>

  <div class="burg-menu" style="z-index: 100">
    <input type="checkbox" id="burger">
    <label for="burger">☰</label>
    <nav>
      <ul>
        <li><a href="AboutUs.php">О компании</a></li>
        <li><div style="margin: 0px;" class="green-line"></div></li>
        <li><a href="shops.php">Адреса и контакты</a></li>
      </ul>

    </nav>
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

          echo <<<CATS
          <a class = "categorie" href="univ-cat.php?cat=$r0"><p class="cats">$r1</p></a>
CATS;
        }

      ?>



        <div class="green-line"></div>
      </div>
    </div>
  </div>

  <div class="ordr">
    <div class="container">
        <div class="row">
          <?php if (!empty($_SESSION['like'])): ?>
            <div class="ordr-left">
              <strong>Избранное</strong>
              <?php
                $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                if ($conn->connect_error) die("Fatal Error");

                foreach ($_SESSION['like'] as $id => $item):


                  $query = "SELECT * FROM products WHERE id_pr = $id";

                  $result = $conn->query($query);

                  $row = $result->fetch_array();
              ?>
                <div class="ordr-info">
                    <div class="ordr-prdct">
                        <img src="<?= $row['photo1'] ?>">
                        <div class="prdct-dscrp">
                            <div class="prdct-txt">
                              <a href=""><b><?= $row['name_prod'] ?></b></a>

                              <p><b>Код товара: <?= $row['id_pr'] ?></b></p>

                              <p>
                                <?= $row['about']?>
                              </p>

                            </div>
                            <?php
                              if (isset($_SESSION['cart'][$id]) && !empty($_SESSION['cart'][$id])){
                                $tf= "true";
                                $cl = "black";
                                $txt = "В корзине";
                                $poin = "none";

                              }
                              else {
                                $tf = "false";
                                $cl = "green";
                                $txt = "В корзину";
                                $poin = "auto";
                              }
                            ?>
                            <a id="li-cart" disabled="<?= $tf?>;"  type="submit" style="pointer-events: <?= $poin ?>; display: inline; margin-top: 315px;color: <?= $cl?>; font-size: 22px;" data-id="<?= $row['id_pr'] ?>" data-price="<?= $row['new_price'] ?>"><?= $txt ?></a>

                            <strong style="color:rgb(182, 182, 182); position: absolute; top: 10px; right: 50px;"><s><?= $row['old_price']?> ₽</s></strong>
                            <strong style="position: absolute; top: 50px; right: 50px;"><?= $row['new_price']?> ₽</strong>

                            <form method="post" action="like.php">
                              <input type="hidden" value="<?= $id ?>" name="id"></input>
                              <input type="submit" class="img-del2" name="del" value=""></input>
                            </form>
                        </div>
                        <a href="univ-prdct.php?product=<?= $row['id_pr']?>&cat=<?= $row['id_cat']?>" class="ab-like">Подробнее..</a>
                    </div>
                </div>
              <?php endforeach; ?>
          <?php else: ?>
            <div style="width: 100%; text-align: center;" class="ordr-left">
                <strong>В избранных пусто...</strong>
            </div>
          <?php endif; ?>
          </div>
        </div>
    </div>
</div>

  <div style="margin-top: 150px;" class="footer">
    <div class = "container">
      <div class = "row">
        <div class="footer-left">
          <h3><p class="">Компания «Кран.ник»</p></h3>
          <div><a class = "href_ind" href="AboutUs.php"><p style="text-decoration: underline;" class="txt_footer">О компании</p></a></div>
          <div><a class = "href_ind" href=""><p style="text-decoration: underline;" class="txt_footer">Адреса и контакты</p></a></div>
        </div>

        <div class="footer-right">
          <h3 class=""><p class="txt_footer">8 812 666-66-111</p></h3>
          <p class="txt_footer">
            Интернет-магазин:<br>
            пн-пт: 9ºº-20ºº; вс: 10ºº-19ºº<br><br>
            Магазины Кран.ник:<br>
            пн-сб: 9ºº-20ºº; вс: 10ºº-19ºº<br>
          </p>
        </div>
        <div class="white-line"></div>

        <div style="margin-top: 0px;" class="footer-left">
          <p class="txt_footer">
            © 1999-2022 «Кран.ник». Все права защищены.<br>
            Соглашение о конфиденциальности<br>
          </p>
        </div>

        <div style="margin-top: 0px; margin-left: 660px;" class="footer-right">
          <div class="vk_yout">
            <a href=""><img class="footer_img" src="images/vk.png"></a><a href=""><img class="footer_img" src="images/yout.png"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script src="main.js"></script>
  <?php $conn->close();?>

</body>
</html>

