<?php
require 'User.php';
require 'Comment.php';

$comments = [];
for ($i = 0; $i < 10; $i++) {
    $user = new User($i, "user{$i}", "user{$i}@mail.ru", "password{$i}");
    $user->createdTime = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', strtotime("-{$i} day")));

    $comment = new Comment($user, "Comment number : {$i}");
    $comments[$i] = $comment;
}

$data_from = $_GET['date_from'];
if ($data_from === NULL) {
   $data_from = "2022-03-09";
}

$filterParamDate = DateTime::createFromFormat('Y-m-d', $data_from);
foreach($comments as $comment) {
    if ($comment-> user-> createdTime >= $filterParamDate) {
        echo $comment->getText(), "\n";
    }
}