<?php
include 'simple_html_dom.php'
function cm() {
    echo '<ul class="collapsible popout">';
    foreach ($html->find('div.item') as $datas) {
        echo '<li>';
        $item['title'] = $datas->find('span.tt', 0)->plaintext;
        $item['link'] = $datas->find('a', 0)->href;
        $dl = file_get_html($item['link']);
        $title = $item['title'];
        $link = $item['link'];
        echo '<div class="collapsible-header">';
        echo('🎬 '.$title);
        echo('</br>');
        echo('📌 '.$link);
        echo '</div>';
        echo '<div class="collapsible-body ">';
        if (strpos($link, "tvshows") !== false) {
            foreach ($dl->find('div[itemprop=description] a[!class][!title]') as $dllinks) {
                echo '<a href="'.($dllinks)->href.'" target="_blank">'.($dllinks)->href.'</a></br>';
            }
            foreach ($dl->find('div[itemprop=description] a') as $dllinks) {}
        } else {
            foreach ($dl->find('li.elemento') as $dllinks) {
                $item['dllink'] = $dllinks->find('a', 0);
                echo($item['dllink'].'</br>');
            }
        }
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
}

?>