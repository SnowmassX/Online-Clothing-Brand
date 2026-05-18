<?php
require_once('../model/checkoutModel.php');

function prepareCheckoutData($userId) {
    if (empty($userId)) {
        return false;
    }
    return true;
}
?>