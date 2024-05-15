<?php
include 'inc/config.php';
include 'inc/function.php';

$code = getGet('code');

include 'inc/session.php';

$board_title = getBoardName($code);



echo  '['.$ses_id.'] 님이 로그인 하셨습니다. <a href="logout.php">로그아웃</a> ';
?>
<hr>
    <?php include 'inc/menu.php'; ?>
<hr>

<h1><?= $board_title ?></h1>

| <a href="write.php?code=<?= $code ?>">글쓰기</a>