<?
include 'scripts/connection.php';
include 'scripts/fn.php';
include 'scripts/modal.php';
include 'scripts/corrections.php';

$cssversion = time();
if (!empty($_COOKIE['theme'])) {
  if ($_COOKIE['theme'] == 'night') {
      $theme = 'night';
      $theme_selected[1] = "";
      $theme_selected[2] = " current";
  } else {
      $theme = 'day';
      $theme_selected[1] = " current";
      $theme_selected[2] = "";
  }
} else {
    $theme = 'day';
    $theme_selected[1] = " current";
    $theme_selected[2] = "";
}
?>
<!DOCTYPE html>
<html lang="et">
<? include 'scripts/head.php'; ?>
<body>
<div id="fb-root"></div>
<script src="scripts/fb-sdk.js"></script>
<?
if(isset($_GET['modal'])) {
  if ($_GET['modal'] == "ok") {
    echo "\n<div class=\"modal\" style=\"display: block\">".$modalcontent."</div>\n<div class=\"fog visible\"></div></div>\n";
  }
}

$movies = "";
$f = 0;
$time = new DateTime();
$folder = "posters/";
if (!empty($_GET['day'])){
  if ($_GET['day']>1 and $_GET['day']<8) {
      $start = "'$start_date 00:00:00'";
  } else {
      $start = "NOW()";
  }
} else {
    $start = "NOW()";
}
$result = db("schedule", "movie_id", "showtime >= $start AND showtime < '$end_date 00:00:00' AND methodlanguage NOT LIKE '%5D%' AND location = '$location' GROUP BY movie_id ORDER BY movie_id ASC");
if (is_array($result)) {
  foreach($result as $show) {
    $query = db("movies", "*", "movie_id = '".$show['movie_id']."' LIMIT 1");
    foreach($query as $title) {
      $title = correctTitle($title['title']);
    }
    $image = $show['movie_id'].".jpg";
    if (strpos($image, 'royalopera') !== false){$image = 'posters/_opera.jpg';} else {if (!file_exists($folder.$image)) {$image = "images/poster.jpg";} else {$image = "posters/".$image;}}
    $movies .= "<div class='movie' data-id='".$show['movie_id']."'><img src='$image' alt='$title' title=\"$title\">$title</div>\n";
  }
}
?>

<div class="header">
<?=$logo?>
<div class="theatres">
<?
$result = db("schedule", "theatre", "showtime >= $start AND showtime < '$end_date 00:00:00' AND location = '$location' GROUP BY theatre ORDER BY theatre ASC");
if (is_array($result)) {
  foreach($result as $show) {
      $f++;
      if ($f>1) {
          echo " /\n";
      }
      echo "  <span class=\"link current\">".$show['theatre']."</span>";
  }
}
?>

</div>
  <button class="more" title="Menüü"><span class="txt">Seaded</span></button>
  <button class="posters" title="Filmid">Filmid</button>
  <input class="search" type="text" placeholder="Otsi tänaste filmide seast">
<div class="mh"></div>
</div>
<? include 'scripts/sidemenu.php'; ?>
<div class="movieinfo"></div>
<div class="fog"></div>
<div class="content">
<div class="arrow left disabled hiddeninmobile"></div>
<div class="arrow right hiddeninmobile"></div>
<div class="movies">Täna kinos
<?=$movies?>
</div>
<div class="shows">
  <div class="showfilter display_none">Eemalda filter</div>
<? $time = new DateTime();
$result = db("schedule", "movie_id, location, theatre, auditorium, showtime, methodlanguage, url", "showtime >='$start_date 00:00:00' AND showtime <'$end_date 00:00:00' AND location = '$location' ORDER BY showtime ASC");
if (is_array($result)) {
  $result = array_unique($result, SORT_REGULAR);
  /*echo "<script>";
  print_r($result);
  echo "</script>";
  */
  foreach($result as $show) {
      if ($time <= new DateTime($show['showtime'])) {
          printEvent($show);
      }
  }
}
if ($tooLate == 1) {
    echo "<div class=\"tooLate\"><a class=\"button rounded-corners\" title=\"Homme kinos\" href=\"".$currenturl.$getLocation."/?day=2"."\">Homne kava</a></div>";
}
$conn->close();
?>
</div>
</div>
<? include 'scripts/js.php'; ?>
</body>
</html>
