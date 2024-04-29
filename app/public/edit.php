<?php
require 'connect.php'; 

$idx = (isset($_GET['idx']) && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

if($idx == '') {
    echo '게시물 번호가 비어 있습니다.'; 
    exit;
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
    <title>Document</title>
</head>
<body>
    <h1>수정하기</h1>
    <form method="post" action="edit_ok.php">
        <input type="hidden" name="idx" value="<?= $row['idx']; ?>">
        이름 : <input type="text" name="name" value="<?= $row['name']; ?>"> <br>
        암호 : <input type="password" name="passwd" value="<?= $row['passwd']; ?>"> <br>
        제목 : <input type="text" name="subject" value="<?= $row['subject']; ?>"> <br>
        내용 : <textarea name="content"><?= $row['content']; ?></textarea> <br>
        <button>수정하기</button>
    </form>
</body>
</html>