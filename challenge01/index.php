<?php
function findPoint($strArr) {
    $a = explode(',', str_replace(' ', '', $strArr[0]));
    $b = explode(',', str_replace(' ', '', $strArr[1]));
    $common = array_intersect($a, $b);
    $strArrFinal = $common ? implode(',', $common) : 'false';
    return $strArrFinal;
}

echo findPoint(['1, 3, 4, 7, 13', '1, 2, 4, 13, 15']);