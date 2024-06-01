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
    <title>게시판 글 상세보기</title>
    <link rel="stylesheet" href="css/view.css">
    <script src="js/view.js"></script>
</head>
<body>
    <div class="container">
        <div class="post-title"><?= $row['subject'] ?></div>
        <div class="post-meta">작성자: <?= $row['name'] ?> | 작성일: <?= $row['rdatetime'] ?></div>
        <div class="post-content">
            <?= nl2br($row['content']) ?>
        </div>
        <div class="btn-group">
            <a href="/edit.php?idx=<?= $row['idx'] ?>" class="btn">수정</a>
            <a href="#" class="btn" id="btn_delete" data-idx="<?= $row['idx'] ?>">삭제</a>
            <a href="list.php" class="btn">목록으로</a>
        </div>
    </div>
    
</body>
</html>