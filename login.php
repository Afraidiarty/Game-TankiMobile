<?php
include 'system/core.php';
session_start();
$login = isset($_POST['login']) ? $_POST['login'] : "";
$password = isset($_POST['password']) ? md5(md5($_POST['password'])) : "";

if (!empty($login) && !empty($password)) {
    $sql = "SELECT * FROM users WHERE nick = ? AND pass = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['nickname'] = $login;
            
            // Устанавливаем куки для долгосрочной авторизации
            setcookie('login', $login, time() + 86400 * 365, '/');
            setcookie('password', md5(md5($password)), time() + 86400 * 365, '/');
            
            header("Location: angar");
            exit();
        }
    } else {
        $_SESSION['msg'] = '<div class="buy-place-block">
        <div class="feedbackPanelERROR">
        <div class="line1">
        <span class="feedbackPanelERROR">Неверный логин или пароль</span>
        </div>
        </div>
        </div>';
        header("Location: index");
    }
} else {
    $_SESSION['msg'] = '<div class="buy-place-block">
    <div class="feedbackPanelERROR">
    <div class="line1">
    <span class="feedbackPanelERROR">Ошибка входа: заполните все поля</span>
    </div>
    </div>
    </div>';
    header("Location: index");
}
?>
