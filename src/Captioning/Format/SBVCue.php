<?php

namespace Captioning\Format;

use Captioning\Cue;

class SBVCue extends Cue
{
    public static function tc2ms($tc)
    {
        $tab = explode(':', $tc);
        $durMS = $tab[0] * 60 * 60 * 1000 + $tab[1] * 60 * 1000 + floatval($tab[2]) * 1000;

        return $durMS;
    }
    
    public static function ms2tc($ms, $_separator = '.')
    {
        $tc_ms = round((($ms / 1000) - intval($ms / 1000)) * 1000);
        $x = $ms / 1000;
        $tc_s = intval($x % 60);
        $x /= 60;
        $tc_m = intval($x % 60);
        $x /= 60;
        $tc_h = intval($x % 24);

        $timecode = str_pad($tc_h, 2, '0', STR_PAD_LEFT).':'
            .str_pad($tc_m, 2, '0', STR_PAD_LEFT).':'
            .str_pad($tc_s, 2, '0', STR_PAD_LEFT).$_separator
            .str_pad($tc_ms, 3, '0', STR_PAD_LEFT);

        return $timecode;
    }

    /**
     * Get the full timecode of the entry
     *
     * @return string
     */
    public function getTimeCodeString()
    {
        return $this->start.','.$this->stop;
    }
}
