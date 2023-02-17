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
    <title>Админ панель - учетные записи</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../univ-cat.css">
    <link rel="stylesheet" href="../basket.css">
    <link rel="stylesheet" href="ap.css">
    <link rel="stylesheet" href="cat.css">

</head>

<body>

    <div class="nav">
        <div class="container">
            <div class="row">
                <div style = "padding: 5px; display: inline-block; border: solid 1px green;" class="nav_paths">
                    <p><a style="font-weight: bold;" href="../index.php">< Вернуться на главную</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-menu">
        <div class="container">
            <div class="row">
                <div class="ap-title">
                    <p>ПАНЕЛЬ УПРАВЛЕНИЯ</p>
                </div>


                <div style="text-align: center;">

                    <div class="but">
                        <a style="font-weight: bold;" href="cat.php">Категории товаров</a>
                    </div>

                    <div class="but">
                        <a style="font-weight: bold;" href="products.php">Товары</a>
                    </div>

                    <div class="but">
                        <a style="font-weight: bold;" href="orders.php">Заказы</a>
                    </div>

                    <div class="buts">
                        <a style="color: black; font-weight: bold;">Учетные записи</a>
                    </div>

                    <div class="but">
                        <a style="font-weight: bold;" href="advertising.php">Рекламный баннер</a>
                    </div>
                </div>



                <div class="contr">

                <?php
                    error_reporting(E_ALL);
                    header('Content-Type: text/html; charset=utf8');
                    $conn = mysqli_connect('localhost', 'root', 'root', 'online_store');
                    if ($conn->connect_error) die("Fatal Error");

                    if (isset($_POST['lg']) && isset($_POST['pas']) && isset($_POST['pas']))
                    {
                        $idAccc= $_POST['id_acc'];
                        $logg = $_POST['lg'];
                        $passw = $_POST['pas'];

                        $query = sprintf("UPDATE `accs` SET `login` = '%s', `pass` = '%s' WHERE `accs`.`id_acc` = '%s'", mysqli_real_escape_string($conn, $logg), mysqli_real_escape_string($conn, $passw),
                            mysqli_real_escape_string($conn, $idAccc));



                        $result  = $conn->query($query);
                        echo <<<ALERTCAT
                        <div class="alert"><p>Учетная запись была успешно обновлена!</p></div>;
ALERTCAT;

                    }
                    else {
                        $name_cate = '';
                        $idCat = '';
                    }

                    if (isset($_POST['pass']) && isset($_POST['log']))
                    {

                        $log = $_POST['log'];

                        $pass = $_POST['pass'];

                        $query = sprintf("INSERT INTO `accs`(`login`,`pass`) VALUES('%s','%s')", mysqli_real_escape_string($conn, $log), mysqli_real_escape_string($conn, $pass));


                        $result  = $conn->query($query);
                        echo <<<ALERTCAT
                        <div class="alert"><p>Администратор успешно добавлен!</p></div>
ALERTCAT;

                    }
                    else {
                        $log = '';
                        $pass = '';
                    }

                ?>

                    <table>
                        <tr>
                            <td><b>ID</b></td>
                            <td><b>Логин</b></td>
                            <td><b>Пароль</b></td>
                            <td><b>Действие</b></td>
                        </tr>
                        <?php


                            if (isset($_GET['del'])) {
                                $idAcc = $_GET['del'];

                                $query = sprintf("DELETE FROM `accs` WHERE `accs`.`id_acc` = '%s'", mysqli_real_escape_string($conn, $idAcc));

                                $result = $conn->query($query);
                                echo <<<ALERTCAC
                                    <div class="alert"><p>Учетная запись была успешно удалена!</p></div>;
ALERTCAC;
                            }


                            $query = "SELECT * FROM accs";

                            $result = $conn->query($query);

                            $rows = $result->num_rows;

                            for ($j = 0; $j < $rows; ++$j) {
                                $row = $result->fetch_array(MYSQLI_NUM);

                                $r0 = htmlspecialchars($row[0]);
                                $r1 = htmlspecialchars($row[1]);
                                $r2 = htmlspecialchars($row[2]);
                                echo <<<CATS
                                    <tr>
                                        <td>$r0</td>
                                        <td>$r1</td>
                                        <td>$r2</td>
                                        <td><a style="color: black;" href="accounts.php?del=$r0">Удалить<a></td>
                                    </tr>
CATS;
                            }

                            mysqli_free_result($result);
                            mysqli_close($conn);
                        ?>

                    </table>


                    <form action="accounts.php" class="frm-cat" method="post">
                        <h1>Изменить учетную запись</h1>
                        <?php
                        echo <<< _OUT
                            <div class="path">

                                <label for="id_cat">ID учетной записи: </label>
                                <input class="id_c" value="$idAccc" name="id_acc" required title="Смотрите в таблице (выше)" type="number" min="0" max="1000000" oninput="validity.valid||(value='');">
                            </div>

                            <div class="path">

                                <label for="upd_cat">Логин: </label>
                                <input value="$logg" class="nm_cat" type="text" name="lg" required minlength="6" maxlength="23">
                            </div>

                            <div class="path">
                                <label for="upd_cat">Пароль: </label>
                                <input value="$passw" class="nm_cat" type="text" name="pas" required minlength="8" maxlength="23">
                            </div>

_OUT;
                        ?>


                        <input class="buttons" type="submit" value="Изменить">

                    </form>

                    <form action="accounts.php" class="frm-cat" method="post">
                        <h1 style="margin-bottom: 94px;">Добавить администратора</h1>
                        <?php
                            echo <<< _OUT
                            <div style="" class="path">


                                <label for="log">Логин: </label>

                                <input value="$log" class="nm_cat" type="text" name="log" title="Логин должен содержать минимум 6 символов" required maxlength="23" >


                            </div>
                            <div style="" class="path">

                                <label for="pass">Пароль: </label>

                                <input value="$pass" name="pass" title="Пароль должен содержать минимум 8 символов" required maxlength="23" type="password" class="nm_cat" minlength="8"">

                            </div>
_OUT;
                        ?>


                        <input class="buttons" type="submit" value="Добавить">

                    </form>



                </div>

            </div>
        </div>
    </div>


</body>

</html>