<?php

namespace App\Services\LamTeknik\V1;

class C7Service
{

    public function c74b($NPM, $NPD, $strata)
    {
        if ($strata == "D4") {
            $b = 0.25;
        } else if ($strata == "S2") {
            $b = 0.50;
        } else if ($strata == "S3") {
            $b = 0.75;
        } else {
            // S1 dsb
            $b = 0.25;
        }

        if ($NPD > 0) {
            $PPDM = ($NPM / $NPD) * 1;
        } else {
            $PPDM = 0;
        }

        if ($PPDM >= $b) {
            $skor = 4;
        } else {
            if ($strata == "D4") {
                $skor = 2 + (8 * $PPDM);
            } else if ($strata == "S2") {
                $skor = 2 + (4 * $PPDM);
            } else if ($strata == "S3") {
                $skor = 2 + ((8 * $PPDM) / 3);
            } else {
                // S1 dsb
                $skor = 2 + (8 * $PPDM);
            }
        }
        return $skor;
    }

    public function c74cm($NTM, $NPD, $strata)
    {
        if ($strata == "S2") {
            $b = 0.25;
        } else if ($strata == "S3") {
            $b = 0.50;
        } else {
            $b = 0;
        }
        if ($NPD > 0) {
            $PPTM = ($NTM / $NPD);
        } else {
            $PPTM = 0;
        }

        if ($PPTM >= $b) {
            $skor = 4;
        } else {
            if ($strata == "S2") {
                $skor = 1 + (12 * $PPTM);
            } else if ($strata == "S3") {
                $skor = 1 + (6 * $PPTM);
            } else {
                $skor = 0;
            }
        }
        return $skor;
    }
}
