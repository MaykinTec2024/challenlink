<?php

function noIterate($strArr) {
    $n = $strArr[0];
    $k = $strArr[1];

    $need = array_count_values(str_split($k));
    $have = [];
    $missing = count($need);
    $minLen = PHP_INT_MAX;
    $start = $left = 0;

    for ($right = 0; $right < strlen($n); $right++) {
        $char = $n[$right];
        if (isset($need[$char])) {
            $have[$char] = ($have[$char] ?? 0) + 1;
            if ($have[$char] === $need[$char]) {
                $missing--;
            }
        }

        while ($missing === 0) {
            if ($right - $left + 1 < $minLen) {
                $minLen = $right - $left + 1;
                $start = $left;
            }

            $leftChar = $n[$left++];
            if (isset($need[$leftChar])) {
                if ($have[$leftChar] === $need[$leftChar]) {
                    $missing++;
                }
                $have[$leftChar]--;
            }
        }
    }
    $strArrFinal = $minLen === PHP_INT_MAX ? '' : substr($n, $start, $minLen);
    return $strArrFinal;
}

echo noIterate(["ahffaksfajeeubsne", "jefaa"]);  
