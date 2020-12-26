
<?php

    function services( $s1, $s2, $s3, $days ){
        $services = ( $s1 + $s2 + $s3 ) * $days;
        return $services;
    }

    function discount( $inapam, $unam, $hab ){
        $disc = 0;
        if( !empty( $inapam ) ){
            $disc += $hab * 0.2;
        }
        if( !empty( $unam ) ){
            $disc += $hab * 0.5;
        }
        return $disc;
    }

    function cost( $hab, $days, $serv, $disc ){
        $costo = ($hab * $days) + $serv - $disc;
        return $costo;
    }

?>
