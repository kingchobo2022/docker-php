<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/write.js"></script>
</head>
<body>
    <h1>글쓰기</h1>
    <form method="post" name="write_form" enctype="multipart/form-data" action="write_ok.php">
        이름 : <input type="text" name="name"> <br>
        비밀번호 : <input type="password" name="passwd"><br>
        제목 : <input type="text" name="subject"><br>
        글 본문 : <br>
        <textarea name="content" cols="32" rows="10"></textarea><br>
        파일첨부 : <input type="file" name="file"><br>
        <button type="button" id="btn_submit">글 등록</button>
    </form>
    
</body>
</html>