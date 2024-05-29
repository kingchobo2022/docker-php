<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 글 작성</title>
    <link rel="stylesheet" href="css/write.css">
</head>
<body>
    <div class="form-container">
        <h2>게시판 글 작성</h2>
        <form name="write_form" method="post">
            <div class="form-group">
                <label for="title">글제목</label>
                <input type="text" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="name">이름</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">이메일</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">비밀번호</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="content">본문</label>
                <textarea id="content" name="content"></textarea>
            </div>
            <div class="form-group">
                <button type="button" id="btn_submit">작성</button>
            </div>
        </form>
    </div>
    <script src="js/write.js"></script>
</body>
</html>
