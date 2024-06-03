<?php

function adaptDate($date01, $delimiter) {


    $dateArr = explode($delimiter, $date01);

    $tmp = trim($dateArr[2]) . "-" . trim($dateArr[1]) . "-" . trim($dateArr[0]);

    return $tmp;

} // end function

?>