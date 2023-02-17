<?php
  session_start();
  require_once('funcs.php');

  $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
  if ($conn->connect_error) die("Fatal Error");

  if(isset($_POST['del'])){
  $del = $_POST['del'];
  $url = $_POST['url'];
  mysqli_query($conn, "DELETE FROM `brands` WHERE `brands`.`id` = '$del'");

  header('location: '.$url);
  }

  if(isset($_POST['brand']) && isset($_FILES['filebr'])) {
    $brand_id = $_POST['brand'];
    $brand = $_POST['name'];
    $descr = $_POST['desbr'];
    $url = $_POST['url'];
    $img = $_FILES['filebr']['name'];
     mysqli_query($conn, "UPDATE `brands` SET `img` = '$img', `brand` = '$brand', `description` = '$descr' WHERE `brands`.`id` = '$brand_id'");

  header('location: '.$url);

  }

  if(isset($_POST['namecr'])) {
    $brand = $_POST['namecr'];
    $descr = $_POST['descr'];
    $url = $_POST['url'];
    $img = $_FILES['filecr']['name'];

    mysqli_query($conn,"INSERT INTO `brands` (`id`, `img`, `brand`, `description`) VALUES (NULL, '$img', '$brand', '$descr')");

    header('location: '.$url);
  }


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

  <?php

        if(isset($_GET['id'])) {
          $id = $_GET['id'];
        } else {
          $id="0";
        }


        $item = mysqli_query($conn, "SELECT * FROM `brands` WHERE `id` = '$id'");
        $item = mysqli_fetch_assoc($item);
        if(isset($item['brand'])){
          $title = $item['brand'];
        }
      ?>

<div class="container">
  <div class="row container">
      <div class="col-3 ">
            <img src="images/brand/<?=$item['img']?>" alt="">
            <p><?=$item['description']?></p>
      </div>
      <div class="col-9 d-flex flex-wrap mt-5">
        <?php
          $query = "SELECT * FROM `products` WHERE `products`. `country`='$title'";
          $products = mysqli_query($conn, $query);
          $products = mysqli_fetch_all($products);

        foreach($products as $product) { ?>
        <div class="cat-prdct-content mb-5" style="width:33%;">
            <a href="univ-prdct.php?product=<?=$product[0]?>&cat=$press_cat" class=""><img class="cat-img" style="max-width: 300px;" src="<?=$product[1]?>"></a>


                <div class="new_price mb-2">
                    <strong style="font-size: 25px;"><?=$product[7]?> ₽</strong>
                </div>
            <div class="prices mb-5">
                <div style="font-size: 16px; height:51px; width:179px; position:relative; text-align: center;">
                    <div id="bloc<?=$product[0]?>" style="width:179px;display:inline;position:absolute;left:0;">
                        <p Mouseover="move('bloc$r0',-5)" onMouseout="move('bloc$r0',5)">
                            <a style="line-height: 19px; line-height: 18px; color: black; text-decoration: none;" href="univ-prdct.php?product=<?=$product[0]?>&cat=$press_cat"><?=$product[4]?></a>
                        </p>
                    </div>
                </div>
            </div>

            <div style="margin-left: 16px;" class="product-item-kg-counter">


                <input type="hidden" id="<?=$product[0]?>" value="1" style="opacity=0;"></input>

                <a href="?cart=add&id=<?=$product[0]?>" class="cat-to-bask1 btn btn-outline-danger mt-2" style="width:250px;" data-id="<?=$product[0]?>" data-price="<?=$product[7]?>">В корзину</a>

            </div>


        </div>

        <?php } ?>
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
