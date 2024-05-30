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

function checkPost($var) {
    $var2 = getPost($var);
    if ($var2 == '') {
        $arr = ['result' => 'empty_'.$var];
        $json = json_encode($arr); 
        exit($json);
    }
    return $var2;    
}

function checkMultiPost($arr) { 
    $rs = [];
    foreach($arr AS $row) {
        $rs[$row] = checkPost($row);
    }
    return $rs;
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

function paginate($totalPages, $currentPage, $baseUrl, $code = '') {
    global $sn, $sf;

    $pagination = '<nav aria-label="Page navigation">
    <ul class="pagination">';
    
    $optstr = '';
    if ($sn != '' && $sf != '') {
        $optstr = '&sn='.$sn.'&sf='.$sf;
    }

    // 이전 페이지 링크
    if ($currentPage > 1) {
        $prevPage = $currentPage - 1;
        $pagination .= ' <li><a href="'.$baseUrl.'?code='.$code.'&page=' . $prevPage . $optstr.'" tabindex="-1">Previous</a></li>';
    } else {
        $pagination .= '<li class="disabled"><a href="#" tabindex="-1">Previous</a></li>';
    }

    // 페이지 숫자 링크
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $pagination .= '<li class="disabled"><a href="#">' . $i . '</a></li>';
        } else {
            $pagination .= '<li><a href="' . $baseUrl . '?code='.$code.'&page=' . $i . $optstr.'">' . $i . '</a></li>';
        }
    }

    // 다음 페이지 링크
    if ($currentPage < $totalPages) {
        $nextPage = $currentPage + 1;
        $pagination .= '<li><a href="' . $baseUrl . '?code='.$code.'&page=' . $nextPage . $optstr.'">Next</a></li>';
    } else {
        $pagination .= '<li><a href="#" class="disabled">Next</a></li>';
    }

    $pagination .= '</ul>
    </nav>';

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

function getBoardCnt($sql, $conn) {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['cnt'];
}