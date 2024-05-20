<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
<form name="write_form" method="post" action="write_ok.php">
    이름 : <input type="text" name="name"> <br>
    비밀번호 : <input type="password" name="passwd"><br>
    제목 : <input type="text" name="subject" size="50"><br>
    내용 : <br>
    <textarea name="content" cols="40" rows="10"></textarea>
    <br>
    <button id="btn_submit" type="button">확인</button>
</form>


<script>
    const btn_submit = document.getElementById('btn_submit')
    btn_submit.addEventListener("click", function(){
        alert(1);
    })
</script> 

</body>
</html>