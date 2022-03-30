<?php

try {
    //code...
    $dbh = new PDO('mysql:host=myapp;dbname=todo_app', 'root', 'root');
    $dbh->query('SET NAMES utf8;');

    // タスク追加処理
    $delete_id = htmlspecialchars($_POST["id"]);

    if ($delete_id !== "") {
        $sth = $dbh->prepare("SELECT name FROM todos WHERE id=:id");
        $sth->bindParam(':id', $delete_id, PDO::PARAM_STR);
        $sth->execute();
        $delete_name = $sth->fetch();
        var_dump($delete_name);
        $sth = $dbh->prepare("DELETE FROM todos WHERE id=:id");
        $sth->bindParam(':id', $delete_id, PDO::PARAM_STR);
        $sth->execute();
    }
    if ($delete_name) {
        echo "タスク名：.$delete_name.を削除しました";
    } else {
        echo "削除失敗";
    }
    unset($dbh);
} catch (\Throwable $th) {
    //throw $th;
    echo '捕捉した例外: ',  $th->getMessage(), "\n";
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除しました</title>
</head>

<body>
    <!-- <h1>削除完了</h1> -->
    <a href="/">トップに戻る</a>
</body>

</html>