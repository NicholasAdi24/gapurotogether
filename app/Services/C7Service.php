<?php

namespace App\Services;

class C7Service
{

    public function c74b($NPM, $NPD, $strata)
    {
        $b = 0.25;
        if($strata == "D4") {
            $b = 0.25;
        } else if($strata == "S2") {
            $b = 0.50;
        } else if($strata == "S3") {
            $b = 0.75;
        }else {
            // S1 dsb
            $b = 0.25;
        }
        if($NPD > 0) {
            $PPDM = ($NPM / $NPD) * 1;
        } else {
            $PPDM = 0;
        }

        if($PPDM >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $PPDM);
        }
        return $skor;
    }
    public function c74cm($NPM, $NPD, $strata)
    {
        if($strata == "S2") {
            $b = 0.25;
        } else if($strata == "S3") {
            $b = 0.50;
        } else {
            $b = 0;
        }
        if($NPD > 0) {
            $PPDM = ($NPM / $NPD) * 1;
        } else {
            $PPDM = 0;
        }

        if($PPDM >= $b) {
            $skor = 4;
        } else {
            $skor = 1 + (3 / $b * $PPDM);
        }
        return $skor;
    }
}
