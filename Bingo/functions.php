<?php
function h($s) {
    // htmlspecialcharsで特殊文字を単なる文字列に変換
    return htmlspecialchars($s,ENT_QUOTES,'utf-8');
}

?>