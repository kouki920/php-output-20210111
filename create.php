<?php
require_once __DIR__ . '/lib/reviews_mysqli.php';

function createReviews($link,$review){
$createReviewsSql = <<<EOT
INSERT INTO reviews  (
    title,
    author,
    status,
    score,
    summary
    ) VALUES (
        "{$review['title']}",
        "{$review['author']}",
        "{$review['status']}",
        "{$review['score']}",
        "{$review['summary']}"
    )
EOT;

$result = mysqli_query($link,$createReviewsSql);
if(!$result){
    echo 'Error fail to create review';
    echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
    exit;
}
}

function validate($review){

    $errors = [];
    if(!strlen($review['title'])){
        $errors['title'] = '書籍名を入力して下さい';
    } elseif(strlen($review['title']) > 255){
        $errors['title'] = '書籍名は255文字以内で入力して下さい';
    }
    if(!strlen($review['author'])){
        $errors['author'] = '著者名を入力して下さい';
    } elseif(strlen($review['author']) > 100){
        $errors['author'] = '著者名は100文字以内で入力して下さい';
    }
    if (!in_array($review['status'], ['未読', '読んでる', '読了'])) {
        $errors['status'] = '読書状況は「未読」「読んでる」「読了」のいずれかを入力してください';
    }
    if($review['score'] < 1 || $review['score'] > 5){
        $errors['score'] = '評価は1〜5の整数を入力してください';
    }
    if(!strlen($review['summary'])){
        $errors['summary'] = '感想を入力して下さい';
    }elseif(strlen($review['summary']) > 2000){
        $errors['summary'] = '感想は2000文字以内で入力して下さい';
    }
    return $errors;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (array_key_exists('status', $_POST)) {
        $status = $_POST['status'];
    }
    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $status,
        'score' => $_POST['score'],
        'summary' => $_POST['summary']
    ];
    $errors = validate($review);
    if(!count($errors)){
        $link = dbConnect();
        createReviews($link,$review);
        mysqli_close($link);
        header('Location: index.php');
    }


}

$title = '読書ログ登録';

$content = __DIR__ . '/views/new.php';

include __DIR__ . '/views/layout.php';
