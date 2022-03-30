<?php

try {
    //code...
    $dbh = new PDO('mysql:host=myapp;dbname=todo_app', 'root', 'root');
    $dbh->query('SET NAMES utf8;');

    // タスク追加処理
    $post_name = htmlspecialchars($_POST["name"]);
    $post_content = htmlspecialchars($_POST["content"]);

    // echo $post_name, $post_content;

    if ($post_name !== "") {
        $sth = $dbh->prepare("INSERT INTO todos (
	    name, content
        ) VALUES (
            :name, :content
        )");
        $sth->bindParam(':name', $post_name, PDO::PARAM_STR);
        $sth->bindParam(':content', $post_content, PDO::PARAM_STR);
        $sth->execute();
    }
    $sth = $dbh->prepare('SELECT * FROM todos');
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

        .task__add {
            text-align: right;
            padding-bottom: 10px;
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

        a,
        form {
            margin-right: 20px;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>
    <h1>タスク一覧</h1>
    <div class="container">
        <div class="task__add">
            <a href="/tasks/add.php">＋タスクを追加する</a>
        </div>
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
                            <a href="/show.php?task=<?= $task['id'] ?>">詳細</a>
                            <a href="">編集</a>
                            <form action="./tasks/delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                <input type="submit" value="削除">
                            </form>
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