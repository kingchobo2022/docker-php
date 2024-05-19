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

function getExtension($file_name) {
    $tmp = explode('.', $file_name);
    return end($tmp);
}

function getFileIcon($var) {
    $img = '';
    if ($var != '') {
        $tmp = explode('|', $var);
        $ext = getExtension($tmp[0]);

        switch($ext) {
            case 'jpg' : $img = '<img src="img/jpg.png" width="20" height="20">'; break;
            case 'png' : $img = '<img src="img/png.png" width="20" height="20">'; break;
            default : $img = '<img src="img/basic.png" width="20" height="20">'; break;
        }
    }
    return $img;
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
    global $sn, $sf;
    $pagination = '';

    $optstr = '';
    if ($sn != '' && $sf != '') {
        $optstr = '&sn='.$sn.'&sf='.$sf;
    }

    // 이전 페이지 링크
    if ($currentPage > 1) {
        $prevPage = $currentPage - 1;
        $pagination .= ' <a href="' . $baseUrl . '?code='.$code.'&page=' . $prevPage . $optstr.'">이전</a> ';
    }

    // 페이지 숫자 링크
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $pagination .= '<span>' . $i . '</span>';
        } else {
            $pagination .= ' <a href="' . $baseUrl . '?code='.$code.'&page=' . $i . $optstr.'">' . $i . '</a> ';
        }
    }

    // 다음 페이지 링크
    if ($currentPage < $totalPages) {
        $nextPage = $currentPage + 1;
        $pagination .= ' <a href="' . $baseUrl . '?code='.$code.'&page=' . $nextPage . $optstr.'">다음</a> ';
    }

    return $pagination;
}

function downloadFile($filePath, $originalFileName) {
    // 파일이 존재하는지 확인
    if (file_exists($filePath)) {
        // HTTP 헤더 설정
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $originalFileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        // 파일을 출력 버퍼에 보냄
        readfile($filePath);
        exit;
    } else {
        // 파일이 존재하지 않을 경우 에러 출력
        echo "파일이 존재하지 않습니다.";
    }
}

function fileUpload($var, $code) {
    if ( isset($_FILES[$var]['tmp_name']) && $_FILES[$var]['tmp_name'] != '' && is_uploaded_file($_FILES[$var]['tmp_name']) ) {
        $newfilename = makeFileName($_FILES[$var]['name']);

        if (!file_exists('data/'. $code)) {
            mkdir('data/'. $code);
        }
        
        move_uploaded_file($_FILES[$var]['tmp_name'], 'data/'.$code .'/'. $newfilename);
        return $newfilename .'|'. $_FILES[$var]['name'] .'|0';
    }
    return '';
}