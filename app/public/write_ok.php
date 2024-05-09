<?php
require "inc/connect.php";
require "inc/function.php";

$code = getPost('code');
$name = getPost('name');
$passwd = getPost('passwd');
$subject = getPost('subject');
$content = getPost('content');

if ($code == '') {
    exit('게시판 코드가 비어 있습니다. <a href="index.php">처음으로</a>');
}
if ($name == '') {
    exit('이름이 비어 있습니다. <a href="write.php?code='.$code.'">글쓰기로 이동</a>');
}
if ($subject == '') {
    exit('제목이 비어 있습니다. <a href="write.php?code='.$code.'">글쓰기로 이동</a>');
}
if ($content == '') {
    exit('글 내용이 비어 있습니다. <a href="write.php?code='.$code.'">글쓰기로 이동</a>');
}
if ($passwd == '') {
    exit('비밀번호가 비어 있습니다. <a href="write.php?code='.$code.'">글쓰기로 이동</a>');
}

$filename = '';
if (isset($_FILES['file']['tmp_name'])
    && $_FILES['file']['tmp_name'] != ''
    && is_uploaded_file($_FILES['file']['tmp_name'] )) {

    $newfilename = makeFileName($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], 'data/'. $newfilename);

}
