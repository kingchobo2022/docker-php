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