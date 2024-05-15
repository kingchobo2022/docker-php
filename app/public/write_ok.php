<?php
require 'inc/config.php';
require 'inc/connect.php';
require 'inc/function.php';
$code = getPost('code');
include 'inc/session.php';

$subject = getPost('subject');
$content = getPost('content');

// echo "<pre>";
// print_r($_SESSION);
// print_r($_POST);
// print_r($_FILES);
// echo "</pre>";

if ($code == '') {
    exit('게시판 코드가 비어 있습니다. <a href="index.php">처음으로</a>');
}
if ($subject == '') {
    exit('제목이 비어 있습니다. <a href="write.php?code={$code}">글쓰기로 이동</a>');
}
if ($content == '') {
    exit('글 내용이 비어 있습니다. <a href="write.php?code={$code}">글쓰기로 이동</a>');
}

$filename = '';
if ( isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != '' && is_uploaded_file($_FILES['file']['tmp_name']) ) {
    $newfilename = makeFileName($_FILES['file']['name']);
    
    move_uploaded_file($_FILES['file']['tmp_name'], 'data/'. $newfilename);
    $filename = $newfilename .'|'. $_FILES['file']['name'] .'|0';
    echo $filename;
}
