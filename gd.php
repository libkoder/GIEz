<?php
include 'simple_html_dom.php'
function cm(){
    $html = file_get_html('https://channelmyanmar.org?s='.$mov);
    echo $mov;
}

?>