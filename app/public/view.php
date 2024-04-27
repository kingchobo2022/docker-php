<?php
require 'connect.php'; 

$idx = isset($_GET['idx']) && is_numeric($_GET['idx']) ? $_GET['idx'] : '';

if ($idx == '') {
    exit('게시물 번호가 비어 있습니다.');
}

$sql = "SELECT * FROM step1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 상세보기</title>
</head>
<body>
    <a href="list.php">글목록</a> <br>
    <h1><?= $row['subject'] ?></h1>
    <span>글쓴이 : <?= $row['name'] ?> 등록일시 : <?= $row['rdatetime'] ?></span>
    <br>
    <div>
        <?= nl2br($row['content']) ?>
    </div>
</body>
</html> 

