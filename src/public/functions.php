<?php

try {
    //code...
    $dbh = new PDO('mysql:host=myapp;dbname=todo_app', 'root', 'root');
    echo 'db接続に成功しました';
    // $dbh->query('SET NAMES utf8;');


    // $sth = $dbh->query('SELECT * FROM todos');
    // $sth->execute();
    // $tasks = $sth->fetchAll();
    unset($dbh);
} catch (\Throwable $th) {
    //throw $th;
    echo '捕捉した例外: ',  $th->getMessage(), "\n";
    echo 'db接続に失敗しました';
    exit();
}
