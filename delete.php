<?php
require_once __DIR__ . '/lib/reviews_mysqli.php';



function deleteReviewsData($link){
    if(isset($_POST['id'])){

        $id = $_POST['id'];
        if($sql = mysqli_prepare($link,'DELETE FROM reviews WHERE id = ?')){
            mysqli_stmt_bind_param($sql, "i", $id);
            mysqli_stmt_execute($sql);
            mysqli_stmt_close($sql);
            header('Location:/index.php');
        }
    }
}
$link = dbConnect();
deleteReviewsData($link);
mysqli_close($link);
