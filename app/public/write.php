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
    const f = document.write_form
    btn_submit.addEventListener("click", function(){
        
        if (f.name.value == '') {
           alert('이름을 입력해 주세요.')
           f.name.focus()
           return
        }
        if (f.passwd.value == '') {
           alert('암호를 입력해 주세요.')
           f.passwd.focus()
           return
        }
        if (f.subject.value == '') {
            alert('제목을 입력해 주세요.')
            f.subject.focus()
            return
        }
        if (f.content.value == '') {
            alert('내용을 입력해 주세요.')
            f.content.focus()
            return
        }

        f.submit()        
    })
</script> 

</body>
</html>