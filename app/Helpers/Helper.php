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
        $replacement[9] = '<i class="ms ms-e ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';
        $replacement[10] = '<i class="ms ms-\1 ms-cost ' . ($big ? 'ms-2x ' : '') . ($shadow ? 'ms-shadow ' : '') . '"></i> ';

        $newText = preg_replace( $pattern, $replacement, $text );

        return $newText;
    }
}