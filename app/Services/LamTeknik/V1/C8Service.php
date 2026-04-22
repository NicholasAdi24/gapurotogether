<?php

namespace App\Services\LamTeknik\V1;

class C8Service
{
    // S1 D4
    public function c84b($NPKMM, $NPKMD)
    {
        $b = 0.25;
        if ($NPKMD > 0) {
            $PPKMDM = (float) ($NPKMM / $NPKMD);
        } else {
            $PPKMDM = 0.00;
        }

        if ($PPKMDM >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (8 * $PPKMDM);
        }
        return $skor;
    }
}
