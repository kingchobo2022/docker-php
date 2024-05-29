<?php

require 'inc/connect.php';
require 'inc/function.php';

$title = getPost('title');
$name = getPost('name');
$email = getPost('email');
$password = getPost('password');
$content = getPost('content');

if ($title == '') {
    // step1 ~ step4
    // exit('제목이 비어 있습니다. <a href="list.php">목록으로 이동</a>');
    // step5 ~ step6
    // echo '<script>alert("제목이 비어 있습니다");self.location.href="list.php";</script>';
    // step7 
    $arr = ['result' => 'empty_title'];
    $json = json_encode($arr); //  {"result" : "empty_title"} 
    exit($json);
}