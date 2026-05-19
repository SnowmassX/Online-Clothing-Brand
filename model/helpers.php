<?php
function e($data){
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

function createToken(){
    if(empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function checkToken($token){
    if(isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)){
        return true;
    }

    return false;
}

function sizeText($value){
    $decoded = json_decode($value, true);

    if(is_string($decoded)){
        return $decoded;
    }

    return $value;
}
?>