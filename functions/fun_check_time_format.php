<?php




function checkTimeFormat($time01) {

    if (strlen($time01) < 8) {

        $time01 = "0" . $time01;
    }

    echo $time01;
    echo "<br />";

    return preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/", $time01);

} // end function


echo checkTimeFormat("30:59:22");

?>