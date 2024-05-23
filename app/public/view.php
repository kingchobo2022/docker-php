<?php
require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');

if($idx == '') {
    myAlert('게시물 번호가 비어 있습니다.', 'list.php');
}

// $sql = "SELECT * FROM step5 WHERE idx=:idx";
// $stmt = $conn->prepare($sql);
// $stmt->execute([':idx' => $idx]);
// $row = $stmt->fetch(PDO::FETCH_ASSOC);

$row = getBoardView($idx, $conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 상세보기</title>
</head>
<body>
<a href="list.php">글목록</a>

<h1><?= $row['subject'] ?></h1>
<span>글쓴이 : <?= $row['name'] ?> 등록일시 : <?= $row['rdatetime'] ?></span>
<br>
<div>
    <?= nl2br($row['content']) ?>
</div>
<br>
<button type="button" id="btn_delete">삭제</button>
<a href="edit.php?idx=<?= $idx ?>">수정</a>

<script>
const btn_delete = document.getElementById('btn_delete')  
btn_delete.addEventListener("click", function(){
    if (confirm('이 게시물을 삭제하시겠습니까?')) {
        self.location.href='delete.php?idx=<?= $row['idx'] ?>';
    }
}); 
</script>
</body>
</html>