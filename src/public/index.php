<?php
$dbh = new PDO('mysql:host=myapp;dbname=todo_app', 'root', 'root');
$dbh->query('SET NAMES utf8;');

$sth = $dbh->query('SELECT * FROM todos');
$sth->execute();
$data = $sth->fetch();
var_dump($data);
unset($dbh);
?>

<!-- <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
</head>

<body>
    <h1>Todo一覧ページ</h1>
</body>

</html> -->