<?php
include 'inc/config.php';
include 'inc/function.php';
include 'inc/connect.php';

$code = getPost('code');
$id = getPost('id');
$passwd = getPost('passwd');

if ($id == '' || $passwd == '') {
    exit('아이디 또는 비밀번호가 빠져있습니다. <a href="login.php?code='.$code.'">로그인으로 이동</a>');
}

$sql = "SELECT COUNT(*) cnt FROM step4_member WHERE id=:id AND passwd=:passwd";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id, ':passwd' => $passwd]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row['cnt'] == 0) {
    exit('일치하는 로그인 정보가 없습니다. <a href="login.php?code='.$code.'">로그인으로 이동</a>');
}

session_start();

$_SESSION['ses_id'] = $id;

if ($code != '') {
    exit('로그인 성공했습니다. <a href="list.php?code='.$code.'">게시판으로 이동</a>');
} else {
    exit('로그인 성공했습니다. <a href="index.php">처음으로 이동</a>');
}

