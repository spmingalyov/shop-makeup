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

  <div class="container d-flex flex-wrap">
  <form action="" class="container d-flex justify-content-end gap-3 align-items-center mb-5" id="formSelect" method="get">
    Искать по алфавиту:
    <select name="alphabet" class="form-select" id="" style="max-width: 150px" id="select">
      <option value="all">Все бренды</option>
      <option value="7">7</option>
      <option value="a">a</option>
      <option value="b">b</option>
      <option value="с">с</option>
      <option value="d">d</option>
      <option value="e">e</option>
      <option value="f">f</option>
      <option value="g">g</option>
      <option value="h">h</option>
      <option value="i">i</option>
      <option value="j">j</option>
      <option value="k">k</option>
      <option value="l">l</option>
      <option value="m">m</option>
      <option value="n">n</option>
      <option value="o">o</option>
      <option value="p">p</option>
      <option value="q">q</option>
      <option value="r">r</option>
      <option value="s">s</option>
      <option value="t">t</option>
      <option value="u">u</option>
      <option value="v">v</option>
      <option value="w">w</option>
      <option value="x">x</option>
      <option value="y">y</option>
      <option value="z">z</option>
    </select>
    <button type="submit" class="btn btn-outline-secondary">Показать</button>
  </form>
  <?php

   $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
   if (!$conn) {
     die('Connection error: ' . mysqli_connect_error());
   }
          $query = "SELECT * FROM `brands`";

          if(isset($_GET['alphabet'])){
            $category = $_GET['alphabet'];
          } else $category = NULL;

          function get_selected($string, $category){
            if($string == $category) {
              echo 'selected';
            } else {
              echo "class='null'";
            }
          }

          if(isset($_GET['alphabet']))
          $letter = $_GET['alphabet'];

          if(isset($_GET['alphabet'])) {
            if($letter == "all"){
              $query = "SELECT * FROM `brands`";
            } else {
              $query = "SELECT * FROM `brands` WHERE brand LIKE '$letter%'";
            }
          }

          $brands = mysqli_query($conn, $query);
          $brands = mysqli_fetch_all($brands);
          ?>
          <div class="d-flex flex-wrap gap-5">
          <?php

          foreach($brands as $brand) {
?>
        <div style="width: 30%;">
          <a href="brand.php?id=<?=$brand[0]?>"><img src="images/brand/<?=$brand[1]?>" style="width:250px;" alt=""></a>
        </div>
<?php
          }
?>
</div>
