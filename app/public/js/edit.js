const btn_submit = document.getElementById('btn_submit')

btn_submit.addEventListener("click", function(){
    const f = document.edit_form
    if (f.title.value == '') {
        alert('제목을 입력해 주세요')
        f.title.focus()
        return false
    }
    if (f.name.value == '') {
        alert('이름을 입력해 주세요')
        f.name.focus()
        return false
    }
    if (f.email.value == '') {
        alert('이메일을 입력해 주세요')
        f.email.focus()
        return false
    }
    if (f.password.value == '') {
        alert('비밀번호를 입력해 주세요')
        f.password.focus()
        return false
    }
    if (f.content.value == '') {
        alert('본문을 입력해 주세요')
        f.content.focus()
        return false
    }


    const f1 = new FormData()

    f1.append('title', f.title.value)
    f1.append('name', f.name.value)
    f1.append('email', f.email.value)
    f1.append('password', f.password.value)
    f1.append('content', f.content.value)
    f1.append('idx', f.idx.value)

    const xhr = new XMLHttpRequest()
    xhr.open("POST", "./edit_ok.php", "true")
    xhr.send(f1)

    xhr.onload = () => {
        if (xhr.status == 200) {
            // JSON.parse() json 문자열 -> 자바스크립트 객체 
            // JSON.stringfy() 자바스크립트 객체 -> json 문자열

            const data = JSON.parse(xhr.responseText)  ; // { result : "empty_title" }
            if (data.result == 'empty_title') {
                alert('제목이 비어 있습니다')
                f.title.focus()
            } else if (data.result == 'empty_name') {
                alert('이름이 비어 있습니다')
                f.name.focus()
            } else if (data.result == 'empty_email') {
                alert('이메일이 비어 있습니다')
                f.email.focus()
            } else if (data.result == 'empty_password') {
                alert('비밀번호가 비어 있습니다')
                f.password.focus()
            } else if (data.result == 'empty_content') {
                alert('본문이 비어 있습니다')
                f.content.focus()
            } else if (data.result == 'success') {
                alert('글 수정이 성공했습니다.')
                self.location.href='list.php'
            } else {
                alert('알 수 없는 오류가 발생했습니다.')
            } 
            
        } else {
            alert('통신에 실패했습니다.')
        }
    }


})