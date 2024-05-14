<?php
require 'inc/config.php';
require 'inc/connect.php';
require 'inc/function.php';

$code = getGet('code');
$idx = getGet('idx');

$board_title = getBoardName($code);

if($board_title == '') {
    exit('올바르지 않은 게시판 코드입니다. <a href="index.php">처음으로</a>');
}

if ($idx == '') {
    exit('게시물 번호가 누락되었습니다. <a href="list.php?code='.$code.'">처음으로</a>');
}

$sql = "SELECT * FROM step3 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    exit('해당 게시물이 존재하지 않습니다. <a href="list.php?code='.$code.'">'.$board_title.' 목록으로 이동</a>');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $board_title ?></title>
</head>
<body>

<?php include 'inc/menu.php'; ?>

    <h1><?= $board_title ?></h1>
    
    <form method="post" enctype="multipart/form-data" action="edit_ok.php" autocomplete="off">
        <input type="hidden" name="code" value="<?= $code ?>">
        <input type="hidden" name="idx" value="<?= $idx ?>">
        이름 : <input type="text" name="name" maxlength="30" value="<?= $row['name'] ?>"> <br>
        비밀번호 : <input type="password" name="passwd" maxlength="50" value="<?= $row['passwd'] ?>"> <br>
        제목 : <input type="text" name="subject" size="100" value="<?= $row['subject'] ?>"> <br>
        본문 : <br>
        <textarea cols="100" rows="15" name="content"><?= $row['content'] ?></textarea> <br>

<?php if ($row['file']) {
    list($file_src, $file_name, $file_hit) = explode('|', $row['file']);
    echo '<input type="checkbox" name="filedel" value="1"> '.$file_name .' 삭제<br>';
}
?>
        <button>확인</button>
    </form>
</body>
</html>