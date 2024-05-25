document.addEventListener("DOMContentLoaded", function(){
    const btn_list = document.getElementById('btn_list')
    const btn_edit = document.getElementById('btn_edit')
    const btn_delete = document.getElementById('btn_delete')
    const sp = new URLSearchParams(window.location.search)

    btn_list.addEventListener("click", function(){
        self.location.href = 'list.php'
    })

    btn_edit.addEventListener("click", function(){
        self.location.href = 'edit.php?idx=' + sp.get("idx");
    })

    btn_delete.addEventListener("click", function(){
        if (confirm('이 게시물을 삭제하시겠습니까?')) {
            self.location.href = 'delete.php?idx='+ sp.get("idx");
        }
    })
})