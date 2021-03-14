<?php
function str2html(string $string) :string {
    return htmlspecialchars($string , ENT_QUOTES , 'UTF-8');
}
//関数作成、XSS対策、特殊文字の無害化