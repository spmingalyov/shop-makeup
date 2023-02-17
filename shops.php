<?php
    session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адреса и контакты</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css-aboutUs.css">
    <link rel="stylesheet" href="shops.css">
</head>

<body>

    <div class="header">
        <div class="container">
            <div style="position: relative;" class="row">
                <a class="href_ind" href="index.php"><img class="logo" src="images/logo_index.png"></a>

                <div class="txt_logo">
                    <p>Компетентная сантехника</p>
                </div>

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

    <div class="burg-menu">
        <input type="checkbox" id="burger">
        <label for="burger">☰</label>
        <nav>
            <ul>
                <li><a href="AboutUs.php">О компании</a></li>
                <li>
                    <div style="margin: 0px;" class="green-line"></div>
                </li>
                <li><a href="shops.php">Адреса и контакты</a></li>
            </ul>

        </nav>
    </div>

    <div class="categories">
        <div class="container">
            <div class="row">

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

    <div class="navigation">
        <div class="container">
            <div class="row">
                <div class="nav_paths">
                    <p><a style="font-weight: bold;" href="index.php">Главная </a> > Адреса и контакты</p>
                </div>
            </div>
        </div>
    </div>
    <div class="about-content">
        <div class = "container">
            <div class = "row">
                <h2>Магазин - Санкт-Петербург</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2828.3620052835668!2d30.340947961115763!3d59.91631153918229!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1673264109497!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <h2 style="border: 0;">Магазин Кран.ник — Санкт-Петербург (пн-сб: 9ºº-20ºº; вс: 10ºº-19ºº)</h2>
                <h2 style="border: 0;">Телефон: <a href="tel:8 812 666-66-111">8 812 666-66-111<br><br></a></h2>


                <h2>Склад, пункт выдачи заказов — Санкт-Петербург</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2833.24198563073!2d30.190933794160415!3d59.85902736285893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1673264600042!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <h2 style="border: 0;">Склад, пункт выдачи заказов — Санкт-Петербург (пн-пт: 10ºº-17ºº)</h2>
                <h2 style="border: 0;">Режим работы интернет-магазина (пн-пт: 8ºº-21ºº; сб-вс: 10ºº-21ºº)</h2>
                <h2 style="border: 0;">Доставка ежедневно (10ºº-15ºº; 15ºº-18ºº; 18ºº-21ºº)<br><br></h2>
                <div style="width: 100%; background-color: #EFEFEF; height: 1px;"></div>
                <p style="margin-left: 20px;" class="txt_hello">
                    <b>ООО «Кран.ник»</b><br>
                    ИНН:7811111111; КПП:7812121211 <br>
                    ОГРН:122722222222221; ОКПО:111111171<br><br>
                    Email: <a href="mailto:info@vodopad.ru">info@crannik.ru</a><br><br>
                </p>


            </div>
        </div>
        <div class="to-Top"><a href="#"><img src="images/up1.png"></a></div>
    </div>


    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-left">
                    <h3>
                        <p class="">Компания «Кран.ник»</p>
                    </h3>
                    <div><a class="href_ind" href="AboutUs.php">
                            <p style="text-decoration: underline;" class="txt_footer">О компании</p>
                        </a></div>
                    <div><a class="href_ind" href="">
                            <p style="text-decoration: underline;" class="txt_footer">Адреса и контакты</p>
                        </a></div>
                </div>

                <div class="footer-right">
                    <h3 class="">
                        <p class="txt_footer">8 812 666-66-111</p>
                    </h3>
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
                        <a href=""><img class="footer_img" src="images/vk.png"></a><a href=""><img class="footer_img"
                                src="images/yout.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>

</html>