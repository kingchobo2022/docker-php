<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>
<body>
    <form method="post" action="write_ok.php">
        이름 : <input type="text" name="name"> <br>
        암호 : <input type="password" name="password"> <br>
        제목 : <input type="text" name="subject"> <br>
        내용 : <textarea name="content"></textarea> <br>
        <button>등록하기</button>
    </form>
</body>
</html>