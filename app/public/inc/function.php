<?php

function makeFileName($file) {
    $tmpArr = explode('.', $file); // aaa.bbb.jpg --> ['aaa','bbb','jpg']
    $ext = strtolower(end($tmpArr));
    // 연월일시분초_랜덤숫자4자리.확장자
    return date('YmdHis') .'_'. rand(1000, 9999) .'.'. $ext;
}

function getPost($var) {
    return (isset($_POST[$var]) && $_POST[$var] != '') ? $_POST[$var] : '';
}

function getGet($var) {
    return (isset($_GET[$var]) && $_GET[$var] != '') ? $_GET[$var] : '';
}

function getBoardName($code) {
    global $boardNameArr;

    foreach($boardNameArr AS $key => $value) {
        if ($code == $key) {
            return $value;
        }           
    }

    return '';
}

function paginate($totalPages, $currentPage, $baseUrl, $code) {
    $pagination = '';

    // 이전 페이지 링크
    if ($currentPage > 1) {
        $prevPage = $currentPage - 1;
        $pagination .= ' <a href="' . $baseUrl . '?code='.$code.'&page=' . $prevPage . '">이전</a> ';
    }

    // 페이지 숫자 링크
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $pagination .= '<span>' . $i . '</span>';
        } else {
            $pagination .= ' <a href="' . $baseUrl . '?code='.$code.'&page=' . $i . '">' . $i . '</a> ';
        }
    }

    // 다음 페이지 링크
    if ($currentPage < $totalPages) {
        $nextPage = $currentPage + 1;
        $pagination .= ' <a href="' . $baseUrl . '?code='.$code.'&page=' . $nextPage . '">다음</a> ';
    }

    return $pagination;
}