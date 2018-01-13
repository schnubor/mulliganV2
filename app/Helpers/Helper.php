<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function replaceManaIcons($text = "", $big = false, $shadow = false ) {
        $pattern = array();
        $pattern[0] = '/{T}/';
        $pattern[1] = '/{R}/';
        $pattern[2] = '/{U}/';
        $pattern[3] = '/{G}/';
        $pattern[4] = '/{W}/';
        $pattern[5] = '/{B}/';
        $pattern[6] = '/{C}/';
        $pattern[7] = '/{S}/';
        $pattern[8] = '/{B\/P}/';
        $pattern[9] = '/{E}/';
        $pattern[10] = '/{(\d)}/';
        $pattern[11] = '/{X}/';
        $pattern[12] = '/{W\/U}/';
        $pattern[13] = '/{U\/B}/';
        $pattern[14] = '/{B\/R}/';
        $pattern[15] = '/{R\/G}/';
        $pattern[16] = '/{G\/W}/';
        $pattern[17] = '/{W\/B}/';
        $pattern[18] = '/{U\/R}/';
        $pattern[19] = '/{B\/G}/';
        $pattern[20] = '/{R\/W}/';
        $pattern[21] = '/{G\/U}/';
        $pattern[22] = '/{2\/W}/';
        $pattern[23] = '/{2\/U}/';
        $pattern[24] = '/{2\/B}/';
        $pattern[25] = '/{2\/R}/';
        $pattern[26] = '/{2\/G}/';

        $replacement = array();
        $replacement[0] = '<i class="ms ms-tap ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[1] = '<i class="ms ms-r ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[2] = '<i class="ms ms-u ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[3] = '<i class="ms ms-g ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[4] = '<i class="ms ms-w ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[5] = '<i class="ms ms-b ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[6] = '<i class="ms ms-c ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[7] = '<i class="ms ms-s ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[8] = '<i class="ms ms-p ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[9] = '<i class="ms ms-e ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[10] = '<i class="ms ms-\1 ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[11] = '<i class="ms ms-x ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[12] = '<i class="ms ms-split ms-wu ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[13] = '<i class="ms ms-split ms-ub ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[14] = '<i class="ms ms-split ms-br ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[15] = '<i class="ms ms-split ms-rg ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[16] = '<i class="ms ms-split ms-gw ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[17] = '<i class="ms ms-split ms-wb ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[18] = '<i class="ms ms-split ms-ur ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[19] = '<i class="ms ms-split ms-bg ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[20] = '<i class="ms ms-split ms-rw ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[21] = '<i class="ms ms-split ms-gu ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[22] = '<i class="ms ms-split ms-2w ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[23] = '<i class="ms ms-split ms-2u ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[24] = '<i class="ms ms-split ms-2b ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[25] = '<i class="ms ms-split ms-2r ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[26] = '<i class="ms ms-split ms-2g ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';

        $newText = preg_replace( $pattern, $replacement, $text );

        return $newText;
    }
}