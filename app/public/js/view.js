document.addEventListener("DOMContentLoaded", function(){
    const btn_delete = document.getElementById('btn_delete')
    if (btn_delete) {

        btn_delete.addEventListener("click", function() {

            if (!confirm('본 게시물을 삭제하시겠습니까?')) {
                return false;
            }   

            const f1 = new FormData()
            f1.append("idx", this.dataset.idx)
            const xhr = new XMLHttpRequest()
            xhr.open("POST", "./delete.php", "true")
            xhr.send(f1)
            xhr.onload = () => {
            if (xhr.status == 200) {
                const data = JSON.parse(xhr.responseText)
                if(data.result == 'success') {
                    alert('삭제되었습니다.')
                    self.location.href='list.php'
                } else {
                    alert('삭제시 오류가 발생했습니다. 관리자에게 확인바랍니다.')
                }
            } else {
                alert('통신 오류가 발생했습니다.')
            }
        
        }



        })
    } else {
        alert('btn_delete 요소를 찾지 못했습니다.')
    }
})