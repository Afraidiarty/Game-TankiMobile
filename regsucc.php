<?php
session_start();
require_once 'system/core.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $timeRegister = time();

    $q = "SELECT side FROM users";
    $resultSide = mysqli_query($connect, $q);
    $countEmp = 0;
    $countFed = 0;
    $statusSide;

    while ($rowSide = mysqli_fetch_assoc($resultSide)) {
        if ($rowSide['side'] == 'empire') {
            $countEmp++;
        } else {
            $countFed++;
        }
    }

    if ($countEmp > $countFed) {
        $statusSide = 'federation';
    } else {
        $statusSide = 'empire';
    }

    $nickname = isset($_POST["nickname"]) ? htmlspecialchars($_POST["nickname"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $tankImage = isset($_POST["myImage"]) ? $_POST["myImage"] : "";

    // Подготовка и выполнение запроса для проверки наличия имени в базе данных
    $checkQuery = "SELECT * FROM `users` WHERE `nick` = ?";
    $checkStmt = mysqli_prepare($connect, $checkQuery);

    if ($checkStmt) {
        mysqli_stmt_bind_param($checkStmt, "s", $nickname);
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($result) > 0) {
            $errorMessage = "Это имя занято, попробуйте выбрать другое.";
            $_SESSION['errormessage'] = $errorMessage;
            header('Location: reg');
            exit();
        }
        mysqli_stmt_close($checkStmt);
    } else {
        $errorMessage = "Произошла ошибка при подготовке запроса для проверки.";
        $_SESSION['errormessage'] = $errorMessage;
        header('Location: reg');
        exit();
    }

    // Подготовка и выполнение запроса для вставки новой записи
    $query = "INSERT INTO `users` (`id`, `nick`, `pass`, `side`, `access`, `img`, `registered`,`lastOnline`,`fuel_change`) VALUES (NULL, ?, ?, ?, '0', ?, '$timeRegister','$timeRegister','0')";
    $stmt = mysqli_prepare($connect, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $nickname, md5(md5($password)), $statusSide, $tankImage);

        if (mysqli_stmt_execute($stmt)) {
            $successMessage = "Ура! Ваши данные сохранены!";
            $_SESSION['authenticated'] = true;
            $_SESSION['successMessage'] = $successMessage;
            $_SESSION['nickname'] = $nickname;
            $_SESSION['password'] = $password;

            setcookie('login', $nickname, time() + 86400 * 365, '/');
            setcookie('password', md5(md5($password)), time() + 86400 * 365, '/');

            header("Location: see");
            exit();
        } else {
            $errorMessage = "Произошла ошибка при сохранении данных: " . mysqli_error($connect);
        }

        mysqli_stmt_close($stmt);
    } else {
        $errorMessage = "Произошла ошибка при подготовке запроса.".mysqli_error($connect);
    }
    mysqli_close($connect);
    $_SESSION['errormessage'] = $errorMessage;
    header('Location: reg');
}
?>
