<?php
require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');
if ($idx == '') {
    myAlert('게시물 번호가 비어 있습니다.', 'list.php');
}

$row = getBoardView($idx, $conn);

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
<form method="post" name="edit_form" action="edit_ok.php">
    <input type="hidden" name="idx" value="<?= $row['idx'] ?>">
    이름 : <input type="text" name="name" value="<?= $row['name'] ?>"><br>
    암호 : <input type="password" name="passwd" value="<?= $row['passwd'] ?>"><br>
    제목 : <input type="text" name="subject" value="<?= $row['subject'] ?>"><br>
    내용 : <textarea name="content"><?= $row['content'] ?></textarea><br>
    <button type="button" id="btn_editsubmit">수정확인</button>
</form>

<script>
const btn_editsubmit = document.getElementById('btn_editsubmit')

btn_editsubmit.addEventListener("click", function(){
    const f = document.edit_form    
    if (f.name.value == '') {
        alert('이름이 비어 있습니다.')
        f.name.focus()
        return        
    }
    if (f.passwd.value == '') {
        alert('비밀번호가 비어 있습니다.')
        f.passwd.focus()
        return        
    }
    if (f.subject.value == '') {
        alert('제목이 비어 있습니다.')
        f.subject.focus()
        return        
    }
    if (f.content.value == '') {
        alert('내용이 비어 있습니다.')
        f.content.focus()
        return        
    }

    f.submit()

})
</script>
</body>
</html>