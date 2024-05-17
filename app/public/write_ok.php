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

$filename = fileUpload('file');

$sql = "INSERT INTO step4 SET code=:code, member_id=:member_id, 
subject=:subject, content=:content, file=:file, hit=0, rdatetime=NOW()";

$stmt = $conn->prepare($sql);
$arr = [
    ':code' => $code,
    ':subject' => $subject,
    ':content' => $content,
    ':member_id' => $ses_id,
    ':file' => $filename
];

$rs = $stmt->execute($arr);

if ($rs) {
    exit("글 등록이 성공적으로 이뤄졌습니다. <a href=\"list.php?code={$code}\">글 목록</a>");
} else {
    exit("글 등록할 때 오류가 발생했습니다. <a href=\"list.php?code={$code}\">글 목록</a>");
}