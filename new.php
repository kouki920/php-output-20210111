<?php

require_once __DIR__ . '/lib/escape.php';

$review = [
    'title' => '',
    'author' => '',
    'status' => '未読',
    'score' => '',
    'summary' => ''
];

$errors = [];


$title = '読書ログ登録ページ';
$content = __DIR__ . '/views/new.php';

include __DIR__ . '/views/layout.php';
