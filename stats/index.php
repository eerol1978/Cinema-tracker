<?
include '../scripts/connection.php';
include '../scripts/fn.php';
include '../scripts/corrections.php';
$cssversion = time();
if ($_COOKIE['theme'] == 'night') {$theme = 'night';$theme_selected[1] = ""; $theme_selected[2] = " current";} else {$theme = 'day';$theme_selected[1] = " current"; $theme_selected[2] = "";}
?>
<!DOCTYPE html>
<html lang="et">
<head>
<script async src='https://www.googletagmanager.com/gtag/js?id=UA-110175776-1'></script>
<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-110175776-1');</script>
<meta charset="utf-8">
<title>Kinos.ee - Täna kinodes - Statistika</title>
<link rel="shortcut icon" type="image/png" href="https://kinos.ee/images/favicon.png"/>
<link rel="stylesheet" type="text/css" href="https://kinos.ee/kinos.css?v=<? print $cssversion;?>" />
<link id="css" rel="stylesheet" type="text/css" href="https://kinos.ee/kinos-<? print $theme;?>.css?v=<? print $cssversion;?>" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<link rel="apple-touch-icon" href="images/app-icon.png" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="width=device-width">
<meta name="apple-mobile-web-app-title" content="Kinos.ee">
<meta name="application-name" content="Kinos.ee">
<meta name="Description" content="Kinos.ee on kinokavu koondav ning neis hõlpsat orjenteerumist lubav veebirakendus.">
<meta name="keywords" content="kino täna kinos homme kinokava">
<meta name="Author" content="Tanel Drui, info@kinos.ee">
<meta name="theme-color" content="#bb2e38">
<script src="https://kinos.ee/scripts/jquery.js"></script>
<script src="https://kinos.ee/scripts/jquery.cookie.js"></script>
<style>
.content.stats {
  color: #ccc; padding: 20px; min-height: calc(100vh - 45px); padding-bottom: 150px; line-height: 20px;
}
.col {
  float: left;
  margin: 0 20px 20px;
  min-width: 170px;
}
.content.stats .col:nth-child(-n+4) {
  max-width: 170px;
  width: 33vw;
}
h1 {font-size: 24px; margin: 20px 20px 0; font-weight: normal; line-height: 34px;}
h2 {font-size: 16px; padding: 30px 0 10px; line-height: 22px;}
.clear {clear: both;}
.copy {
  font-size: 12px;
  padding: 20px;
  color: #888;
  position: absolute;
  left: 0;
  bottom: 0;
  background-color: #22252b;
  width: 100vw;
}
.copy a {font-size: 12px; color: #888; text-decoration: none;}
.copy a:hover {color: #fff;}
ol.stats li {list-style-position: inside;}
ul.stats li {list-style-type: none;}
ul.stats li::before {
    content: '';
    width: 10px;
    height: 10px;
    background-color: #d7404a;
    display: inline-block;
    margin-right: 8px;
    border-radius: 5px;
}
ul.stats li:nth-child(2)::before {
    background-color: #66bcbc;
}
ul.stats li:nth-child(3)::before {
    background-color: #377676;
}
ul.stats li:nth-child(4)::before {
    background-color: #3c4866;
}
ul.stats li:nth-child(5)::before {
    background-color: #30384b;
}
ul.stats li:nth-child(6)::before {
    background-color: #8e3537;
}
@media (max-width:669px) {
  .col {
    float: initial;
    min-width: 170px;
    margin: 0 20px 10px;
  }
  .copy {
    margin: 40px -20px 0;
    position: unset;
    left: unset;
    bottom: unset;
  }
  .content.stats {
    padding-bottom: 0;
  }
  .content.stats .col h2 {
    padding: 20px 0 10px;
  }
}
</style>
</head>
<body>

<div class="header">
<a class="logo stats" href="https://kinos.ee" title="Kinos.ee"><span>Kinos.ee</span>Täna kinodes - Statistika</a>
</div>

<div class="content stats">
  <h1>Täna kinodes</h1>
  <div class="col">
  <?
  $start = $start_date." 00:00:00";
  $sql = "SELECT * FROM schedule WHERE showtime >='".$start."' AND showtime <'".$end_date." 00:00:00' AND methodlanguage NOT LIKE '%5D%'";
  $result = $conn->query($sql);
  $events_all = $result->num_rows;
  $listEesti = array();
  $listTln = array();
  $listTrt = array();
  while($show = $result->fetch_assoc()) {
    $listEesti[$show['movie_id']]++;
    if (strpos($show['methodlanguage'], '3D') !== false) {$events_all_3d++;}
    if ($show['location']=="Tallinn") {$events_tln++; $listTln[$show['movie_id']]++; if (strpos($show['methodlanguage'], '3D') !== false) {$events_tln_3d++;}}
    if ($show['location']=="Tartu") {$events_trt++; $listTrt[$show['movie_id']]++; if (strpos($show['methodlanguage'], '3D') !== false) {$events_trt_3d++;}}
    if ($show['location']=="Pärnu") {$events_prn++; if (strpos($show['methodlanguage'], '3D') !== false) {$events_prn_3d++;}}
    if ($show['location']=="Narva") {$events_nrv++; if (strpos($show['methodlanguage'], '3D') !== false) {$events_nrv_3d++;}}
    if ($show['location']=="Viljandi") {$events_vld++; if (strpos($show['methodlanguage'], '3D') !== false) {$events_vld_3d++;}}
    if ($show['location']=="Saaremaa") {$events_srm++; if (strpos($show['methodlanguage'], '3D') !== false) {$events_srm_3d++;}}
  }
  $result->close();
  print "<h2>Seansse kokku: $events_all</h2>";
  print "<ul class=\"stats\">";
  print " <li>Tallinnas: <b>$events_tln</b></li>";
  print " <li>Tartus: <b>".$events_trt."</b></li>";
  print " <li>Pärnus: <b>".$events_prn."</b></li>";
  print " <li>Narvas: <b>".$events_nrv."</b></li>";
  print " <li>Saaremaal: <b>".$events_srm."</b></li>";
  print " <li>Viljandis: <b>".$events_vld."</b></li>";
  print "</ul>";
  ?>
  </div>
  <?
  if ($events_all_3d != "") {
    print "<div class=\"col\">";
    print " <h2>3D seansse: $events_all_3d</h2>";
    print " <ul class=\"stats\">";
    if ($events_tln_3d != "") {print "  <li>Tallinnas: <b>$events_tln_3d</b></li>";}
    if ($events_trt_3d != "") {print "  <li>Tartus: <b>".$events_trt_3d."</b></li>";}
    if ($events_prn_3d != "") {print "  <li>Pärnus: <b>".$events_prn_3d."</b></li>";}
    if ($events_nrv_3d != "") {print "  <li>Narvas: <b>".$events_nrv_3d."</b></li>";}
    if ($events_srm_3d != "") {print "  <li>Saaremaal: <b>".$events_srm_3d."</b></li>";}
    if ($events_vld_3d != "") {print "  <li>Viljandis: <b>".$events_vld_3d."</b></li>";}
    print " </ul>";
    print "</div>";
  }
  ?>

  <div class="col">
  <?

  $sql = "SELECT * FROM schedule WHERE methodlanguage NOT LIKE '%5D%' AND showtime >='".$start."' AND showtime <'".$end_date." 00:00:00' GROUP BY movie_id";
  $result = $conn->query($sql);
  $cnt_events = $result->num_rows;
  print "<h2>Erinevaid filme: ".$cnt_events."</h2>";
  $sql = "SELECT * FROM schedule WHERE methodlanguage NOT LIKE '%5D%' AND showtime >='".$start."' AND showtime <'".$end_date." 00:00:00' GROUP BY movie_id, location";
  $result = $conn->query($sql);
  while($show = $result->fetch_assoc()) {
    if ($show['location']=="Tallinn") {$cnt_tln++;}
    if ($show['location']=="Tartu") {$cnt_trt++;}
    if ($show['location']=="Pärnu") {$cnt_prn++;}
    if ($show['location']=="Narva") {$cnt_nrv++;}
    if ($show['location']=="Saaremaa") {$cnt_srm++;}
    if ($show['location']=="Viljandi") {$cnt_vld++;}
  }
  $result->close();
  print "<ul class=\"stats\">";
  print " <li>Tallinnas: <b>".$cnt_tln."</b></li>";
  print " <li>Tartus: <b>".$cnt_trt."</b></li>";
  print " <li>Pärnus: <b>".$cnt_prn."</b></li>";
  print " <li>Narvas: <b>".$cnt_nrv."</b></li>";
  print " <li>Saaremaal: <b>".$cnt_srm."</b></li>";
  print " <li>Viljandis: <b>".$cnt_vld."</b></li>";
  print "</ul>";
  ?>
  </div>
  <div class="clear"></div>
  <div class="col">
    <h2>Enim näidatud filmid Eestis:</h2>
    <ol class="stats">
    <?
    arsort($listEesti);
    foreach ($listEesti as $key => $val) {
      if ($a <= 9) {
        $a++;
        $sql = "SELECT * FROM movies WHERE movie_id ='".$key."' LIMIT 1";
        $result = $conn->query($sql);
        $show = $result->fetch_assoc();
        print "<li><b>".correctTitle($show['title'])."</b> ($val seanssi)</li>";
      }

    }
    ?>
    </ol>
  </div>
  <div class="col">
    <h2>Enim näidatud filmid Tallinnas:</h2>
    <ol class="stats">
    <?
    $key = "";
    $val = "";
    $a = "";
    arsort($listTln);
    foreach ($listTln as $key => $val) {
      if ($a <= 9) {
        $a++;
        $sql = "SELECT * FROM movies WHERE movie_id ='".$key."' LIMIT 1";
        $result = $conn->query($sql);
        $show = $result->fetch_assoc();
        print "<li><b>".correctTitle($show['title'])."</b> ($val seanssi)</li>";
      }

    }
    ?>
    </ol>
  </div>
  <div class="col">
    <h2>Enim näidatud filmid Tartus:</h2>
    <ol class="stats">
    <?
    $key = "";
    $val = "";
    $a = "";
    arsort($listTrt);
    foreach ($listTrt as $key => $val) {
      if ($a <= 9) {
        $a++;
        $sql = "SELECT * FROM movies WHERE movie_id ='".$key."' LIMIT 1";
        $result = $conn->query($sql);
        $show = $result->fetch_assoc();
        print "<li><b>".correctTitle($show['title'])."</b> ($val seanssi)</li>";
      }

    }
    ?>
    </ol>
  </div>
<div class="clear"></div>
<div class="copy">Kinos.ee on veebirakendus, mis koondab mugavalt ühe katuse alla kõik kinokavad ning lubab neis hõlpsasti orienteeruda. Lehel vahendatud filmide info, kinoaegade ja muu meedia õigsuse eest vastutavad mainitud infot jagavate kinode operaatorid. <br>&copy; <? echo date(Y); ?> Kinos.ee</div>
</div>
<? // include '../scripts/js.php'; ?>
</body>
</html>
