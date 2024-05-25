document.addEventListener("DOMContentLoaded", function(){
    const btn_submit = document.getElementById('btn_submit')
    const f = document.write_form

    if (btn_submit) {

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
    }
})
