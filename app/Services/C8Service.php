<?php

namespace App\Services;

class C8Service
{

    public function c84b($NPKMM, $NPKMD)
    {
        $b = 0.25;
        if($NPKMD > 0) {
            $PPKMDM = ($NPKMM / $NPKMD) * 1;
        } else {
            $PPKMDM = 0;
        }

        if($PPKMDM >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $PPKMDM);
        }
        return $skor;
    }
}
