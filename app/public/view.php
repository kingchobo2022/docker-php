<?php
require 'connect.php';
require 'function.php';

$idx = getGet('idx');
if ($idx == '') {
    exit('게시물 번호가 누락되었습니다. <a href="list.php">목록으로 이동 </a>');
}

$sql = "SELECT * FROM step2 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    exit('해당 게시물이 존재하지 않습니다. <a href="list.php">목록으로 이동 </a>');
}

$sql = "UPDATE step2 SET hit=hit+1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['subject']; ?></title>
</head>
<body>
    <h1><?= $row['subject']; ?></h1>
    <span>작성자 : <?= $row['name']; ?></span>
    <span>등록일시 : <?= $row['rdatetime']; ?></span>
    <span>조회 수 : <?= $row['hit']; ?></span>
    <div>
        <?= $row['content']; ?>
    </div>
</body>
</html>