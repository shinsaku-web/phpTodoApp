<?php
// function connect_db()
// {
//     try {
//         //code...
//         $dbh = new PDO('mysql:host=myapp;dbname=todo_app', 'root', 'root');
//         $dbh->query('SET NAMES utf8;');

//         $sth = $dbh->query('SELECT * FROM todos');
//         $sth->execute();
//         $tasks = $sth->fetchAll();
//         unset($dbh);
//     } catch (\Throwable $th) {
//         //throw $th;
//         echo '捕捉した例外: ',  $th->getMessage(), "\n";
//         exit();
//     }
// }

// connect_db();

try {
    //code...
    $dbh = new PDO('mysql:host=myapp;dbname=todo_app', 'root', 'root');
    $dbh->query('SET NAMES utf8;');

    $sth = $dbh->query('SELECT * FROM todos');
    $sth->execute();
    $tasks = $sth->fetchAll();
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
    <title>Todo App</title>
    <style>
        h1 {
            text-align: center;
            padding: 30px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
            border-bottom: 1px solid #aaa;
            color: #555;
            width: 100%;
        }

        th {
            border-top: 1px solid #aaa;
            background-color: #f5f5f5;
            padding: 10px 0 10px 6px;
            text-align: center;
        }

        td {
            border-top: 1px solid #aaa;
            padding: 10px 0 10px 6px;
            text-align: center;
        }

        a {
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <h1>タスク一覧</h1>
    <div class="container">
        <?php if ($tasks) : ?>
            <table>
                <tr>
                    <th>タスク</th>
                    <th>アクション</th>
                </tr>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task['name']) ?></td>
                        <td>
                            <a href="/show.php?data=<?= $task['id'] ?>">詳細</a>
                            <a href="">編集</a>
                            <a href="">削除</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php else : ?>
            <p>No task</p>
        <?php endif ?>
    </div>
</body>

</html>