<?php
require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');
checkEmptygoWhere($idx, '게시물 번호', 'list.php');

$sql = "SELECT * FROM step7 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$row) {
    $msg = '존재하지 않는 게시물입니다.';
    $url = 'list.php';
    msgGowhere($msg, $url);
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 글 수정</title>
    <link rel="stylesheet" href="css/write.css">
</head>
<body>
    <div class="form-container">
        <h2>게시판 글 수정</h2>
        <form name="edit_form" method="post">
            <input type="hidden" name="idx" value="<?= $row['idx'] ?>">
            <div class="form-group">
                <label for="title">글제목</label>
                <input type="text" id="title" name="title" value="<?= $row['subject'] ?>">
            </div>
            <div class="form-group">
                <label for="name">이름</label>
                <input type="text" id="name" name="name" value="<?= $row['name'] ?>">
            </div>
            <div class="form-group">
                <label for="email">이메일</label>
                <input type="email" id="email" name="email" value="<?= $row['email'] ?>">
            </div>
            <div class="form-group">
                <label for="password">비밀번호</label>
                <input type="password" id="password" name="password" value="<?= $row['passwd'] ?>">
            </div>
            <div class="form-group">
                <label for="content">본문</label>
                <textarea id="content" name="content"><?= $row['content'] ?></textarea>
            </div>
            <div class="form-group">
                <button type="button" id="btn_submit">수정 확인</button>
            </div>
        </form>
    </div>
    <script src="js/edit.js?v=<?= date('YmdHis') ?>"></script>
</body>
</html>
