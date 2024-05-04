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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>수정하기</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" action="edit_ok.php">
        <input type="hidden" name="idx" value="<?= $row['idx'] ?>">

        이름 : <input type="text" name="name" value="<?= $row['name'] ?>"> <br>
        비밀번호 : <input type="password" name="passwd" value="<?= $row['passwd'] ?>"><br>
        제목 : <input type="text" name="subject" value="<?= $row['subject'] ?>"><br>
        글 본문 : <br>
        <textarea name="content" cols="32" rows="10"><?= $row['content'] ?></textarea><br>
        파일첨부 : <input type="file" name="file"><br>
        
        <?php if($row['file']) {
            list($file_src, $file_name) = explode('|', $row['file']);
            echo '<input type="checkbox" name="filedel" value="1"> '. $file_name .' 삭제<br>';
        }
        ?>
        <button>글 수정</button>
    </form>
</body>
</html>
