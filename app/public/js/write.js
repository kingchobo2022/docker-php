const btn_submit = document.getElementById('btn_submit')

btn_submit.addEventListener("click", function(){
    const f = document.write_form;
    if (f.title.value == '') {
        alert('제목이 비어 있습니다.')
        f.title.focus()
        return false
    }
    if (f.name.value == '') {
        alert('이름이 비어 있습니다.')
        f.name.focus()
        return false
    }
    if (f.email.value == '') {
        alert('이메일이 비어 있습니다.')
        f.email.focus()
        return false
    }
    if (f.password.value == '') {
        alert('비밀번호가 비어 있습니다.')
        f.password.focus()
        return false
    }
    if (f.content.value == '') {
        alert('본문이 비어 있습니다.')
        f.content.focus()
        return false
    }

    const f1 = new FormData()

    f1.append('title', f.title.value)
    f1.append('name', f.name.value)
    f1.append('email', f.email.value)
    f1.append('password', f.password.value)
    f1.append('content', f.content.value)

    const xhr = new XMLHttpRequest()
    xhr.open("POST", "./write_ok.php", "true")
    xhr.send(f1)

    xhr.onload = () => {
        if (xhr.status == 200) {
            
        } else {
            alert('통신에 실패했습니다.')
        }
    }



})