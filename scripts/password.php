<html>
<meta charset="utf-8">
<?php
#Изменение пароля сотрудника

$login = htmlspecialchars(trim($_POST['login']));
$user = htmlspecialchars(trim($_POST['user']));
$passw = htmlspecialchars(trim($_POST['passw']));
$passw2 = htmlspecialchars(trim($_POST['passw2']));

if($passw == $passw2) {

    include_once('../library/UnionDB.php');

    UnionDB::connectDb();

    $query = mysql_query("SELECT id FROM staff_login WHERE login = '$login' and staff_name = '$user'");
    $result = mysql_fetch_assoc($query);

    $id = $result['id'];

    if($id != null) {

        $token = md5(md5($passw));

        mysql_query("UPDATE staff_login SET token = '$token' WHERE id = '$id'");
    }
    echo "Сотрудник не найден !";
}
echo "Пароли не совпадают !";
?>
</html>
