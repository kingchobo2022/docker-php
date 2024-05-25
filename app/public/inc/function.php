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

function checkEmptygoBack($a, $b) {
    if ($a == '') {
        exit('<script>alert("'.$b.'이(가) 비어 있습니다.");
            history.go(-1);
        </script>');
    }    
}

function myAlert($msg, $where) {
    echo "<script>alert('".$msg."');
    self.location.href='".$where."';
    </script>";
    exit;
}

function getBoardView($idx, $conn) {
    $sql = "SELECT * FROM step6 WHERE idx=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':idx' => $idx]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateBoardHit($idx, $conn) {
    $sql = "UPDATE step6 SET hit=hit+1 WHERE idx=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':idx' => $idx]);
}


function uploadFile($f) {
    $filename = '';
    if ( isset($_FILES[$f]['tmp_name']) && $_FILES['file']['tmp_name'] != '' && is_uploaded_file($_FILES[$f]['tmp_name']) ) 
    {
        $newfilename = makeFileName($_FILES[$f]['name']);
        move_uploaded_file($_FILES[$f]['tmp_name'], 'data/'. $newfilename);

        $filename = $newfilename .'|'. $_FILES[$f]['name'] .'|0';
    }
    return $filename;
}