<?php
include 'gd.php';
include 'simple_html_dom.php';
if (isset($_POST["search"])) {
  $mov = $_POST["mov"];
  cm();
} else {
  $mov = "";
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
  <title>GIE</title>
  <meta name="description" content="😎 Get It Easy">
  <link rel="manifest" href="/manifest.json">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link rel="apple-touch-icon" href="msteams/msteams-192-192.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#2A0944" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="GetItEZ">
  <meta name="msapplication-TileImage" content="msteams/msteams-192-192.png">
  <meta name="msapplication-TileColor" content="#FFFFFF">
  <!-- Search Engine -->
  <meta name="description" content="😎 Get It Easy">
  <meta name="image" content="https://getitez.000webhostapp.com/images/pv.jpeg">
  <!-- Schema.org for Google -->
  <meta itemprop="name" content="😎 Get It Easy">
  <meta itemprop="description" content="Get It Easy">
  <meta itemprop="image" content="https://getitez.000webhostapp.com/images/pv.jpeg">
  <!-- Open Graph general (Facebook, Pinterest & Google+) -->
  <meta name="og:title" content="😎 Get It Easy">
  <meta name="og:description" content="GIE">
  <meta name="og:image" content="https://getitez.000webhostapp.com/images/pv.jpeg">
  <meta name="og:type" content="website">
</head>
<body class="fullscreen">
  <nav>
    <div class="nav-wrapper colorpm">
      <a href="#!" class="brand-logo">GetItEZ</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">About</a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="#">About</a></li>
  </ul>
  <div class="">

    <div class="row scale-transition center">
      <form class="col s12" method="POST" action="index.php">
        <div class="row">
          <div class="input-field col s2">
            <!-- Dropdown Trigger -->
            <a class='dropdown-trigger btn-floating waves-effect waves-light colorsec' href='#' data-target='dropdown'>
              <i class="material-icons">
                movie_filter
              </i>
            </a>

            <!-- Dropdown Structure -->
            <ul id='dropdown' class='dropdown-content'>
              <li><a href="#!">CM</a></li>
              <li><a href="#!">Topmovie</a></li>
              <li><a href="#!">CinemaMsub</a></li>
              <li><a href="#!">BurmeseSub</a></li>
              <li><a href="#">MMdrama</a></li>
            </ul>
          </div>
          <div class="input-field col s8">
            <!--i class="material-icons prefix">movie</i-->
            <input id="icon_prefix" type="text" class="validate" name="mov">
            <label for="icon_prefix">ဇာတ်ကားနာမည်ဖြင့်ရှာမည်..</label>
          </div>
          <div class="input-field col s2">
            <button class="btn-floating waves-effect waves-light colorsec" type="submit" name="search">
              <i class="material-icons search">search</i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="container">
      <?php
      phpinfo();
      $arrContextOptions = array(
        "ssl" => array(
          "verify_peer" => false,
          "verify_peer_name" => false,
        ),
      );
      $html = file_get_html('https://channelmyanmar.org?s='.$mov);

      if (!empty($mov)) {
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
      } else {
        echo '
                <div class="center">
                    <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_3vbOcw.json" mode="bounce" background="transparent" speed="1" style="width: 100; height: 300px;" loop autoplay></lottie-player>
                </div>
                ';
      }
      ?>

    </div>
  </div>
  <script src="js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="js/scripts.js"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();
      $('.collapsible').collapsible();
      $('.modal').modal();
      $('.dropdown-trigger').dropdown();
    });
  </script>
</body>
</html>