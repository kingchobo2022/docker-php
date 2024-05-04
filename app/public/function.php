<?php


function makeFileName($file) {
    $tmpArr = explode('.', $file);    // aaaa.bbb.jpg ---> ['aaa','bbb','jpg']  
    $ext = strtolower(end($tmpArr));

    // 년월일시분초 .'_'. rand(1000, 9999) .'.'. $ext;
    // 240503111111
    return date('ymdHis') .'_'. rand(1000, 9999) .'.'. $ext;
}

// $name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name'] : '';

function getPost($var) {
    return (isset($_POST[$var]) && $_POST[$var] != '') ? $_POST[$var] : '';
}
function getGet($var) {
    return (isset($_GET[$var]) && $_GET[$var] != '') ? $_GET[$var] : '';
}

function paginate($totalPages, $currentPage, $baseUrl) {
    $pagination = '';

    // 이전 페이지 링크
    if ($currentPage > 1) {
        $prevPage = $currentPage - 1;
        $pagination .= '<a href="' . $baseUrl . '?page=' . $prevPage . '">이전</a> ';
    }

    // 페이지 숫자 링크
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $pagination .= ' <span>' . $i . '</span> ';
        } else {
            $pagination .= ' <a href="' . $baseUrl . '?page=' . $i . '">' . $i . '</a> ';
        }
    }

    // 다음 페이지 링크
    if ($currentPage < $totalPages) {
        $nextPage = $currentPage + 1;
        $pagination .= ' <a href="' . $baseUrl . '?page=' . $nextPage . '">다음</a>';
    }

    return $pagination;
}
