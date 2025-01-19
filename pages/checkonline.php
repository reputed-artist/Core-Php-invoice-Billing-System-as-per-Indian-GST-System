<?php
function is_connected()
{
    $connected = @fsockopen("www.google.com", 80);
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = 1; //action when connected
        fclose($connected);
    }else{
        $is_conn = 0; //action in connection failure
    }
    return $is_conn;

}

// $int=is_connected();
?>