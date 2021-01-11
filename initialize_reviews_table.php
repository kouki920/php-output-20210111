<?php
require_once __DIR__ . '/lib/mysqli.php';

function dropTable($link)
{
    $dropTableSql = 'DROP TABLE IF EXISTS reviews';
    $result = mysqli_query($link,$dropTableSql);
    if($result){
        echo 'テーブルを削除しました' . PHP_EOL . PHP_EOL;
    } else {
        echo 'Error: テーブルの削除に失敗しました' . PHP_EOL;
        echo 'Debugging error;' . mysqli_error($link). PHP_EOL;
    }
}

    function createTable($link){
        $createTableSql = <<<EOT
        CREATE TABLE reviews (
            id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
            title VARCHAR(255),
            author VARCHAR(100),
            status VARCHAR(10),
            score INTEGER,
            summary VARCHAR(2000),
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) DEFAULT CHARACTER SET=utf8mb4;
EOT;

        $result = mysqli_query($link,$createTableSql);
        if(!$result){
            echo 'テーブルの作成に失敗しました' . PHP_EOL;
            echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
        }else {
            echo 'テーブルの作成に成功しました';
        }
    }

    $link = dbConnect();

    dropTable($link);
    createTable($link);
    mysqli_close($link);

?>
