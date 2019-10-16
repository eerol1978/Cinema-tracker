<?
$getDay = !empty($_GET['day']) ? $_GET['day'] : null;

$getLocation = !empty($_GET['location']) ? strtolower($_GET['location']) : null;

if($getLocation == "tartu"){
  $location = "Tartu";
  $logolocation = "Tartu";
  $location_selected[1] = "";
  $location_selected[2] = " class=\"current\"";
  $location_selected[3] = "";
  $location_selected[4] = "";
  $location_selected[5] = "";
  $location_selected[6] = "";
} elseif ($getLocation == "parnu"){
  $location = "Pärnu";
  $logolocation = "Pärnu";
  $location_selected[1] = "";
  $location_selected[2] = "";
  $location_selected[3] = " class=\"current\"";
  $location_selected[4] = "";
  $location_selected[5] = "";
  $location_selected[6] = "";
} elseif ($getLocation == "viljandi"){
  $location = "Viljandi";
  $logolocation = "Viljandi";
  $location_selected[1] = "";
  $location_selected[2] = "";
  $location_selected[3] = "";
  $location_selected[4] = "";
  $location_selected[5] = " class=\"current\"";
  $location_selected[6] = "";
} elseif ($getLocation == "saaremaa"){
  $location = "Saaremaa";
  $logolocation = "Saaremaa";
  $location_selected[1] = "";
  $location_selected[2] = "";
  $location_selected[3] = "";
  $location_selected[4] = "";
  $location_selected[5] = "";
  $location_selected[6] = " class=\"current\"";
} elseif ($getLocation == "narva"){
  $location = "Narva";
  $logolocation = "Narva";
  $location_selected[1] = "";
  $location_selected[2] = "";
  $location_selected[3] = "";
  $location_selected[4] = " class=\"current\"";
  $location_selected[5] = "";
  $location_selected[6] = "";
} else {
	$getLocation = "";
  $location = "Tallinn";
  $logolocation = "Tallinna";
  $location_selected[1] = " class=\"current\"";
  $location_selected[2] = "";
  $location_selected[3] = "";
  $location_selected[4] = "";
  $location_selected[5] = "";
  $location_selected[6] = "";
}

if ($getLocation!="") {
  $city = $getLocation."/";
} else {
  $city = "";
}

$logo = "<a class=\"logo ".$getLocation."\" href=\"https://".$_SERVER["HTTP_HOST"]."/".$city."\"><span>Kinos.ee</span>".$logolocation." kinokavad</a>";
$uriTallinn = "tallinn/";
$uriTartu = "tartu/";
$uriParnu = "parnu/";
$uriNarva = "narva/";
$uriViljandi = "viljandi/";
$uriSaaremaa = "saaremaa/";

if($getDay == 2){     $modifier = " +1day"; $selected[1] = ""; $selected[2] = " class='current'"; $selected[3] = ""; $selected[4] = ""; $selected[5] = ""; $selected[6] = ""; $selected[7] = "";}
elseif($getDay == 3){ $modifier = " +2day"; $selected[3] = " class='current'"; $selected[1] = ""; $selected[2] = ""; $selected[4] = ""; $selected[5] = ""; $selected[6] = ""; $selected[7] = "";}
elseif($getDay == 4){ $modifier = " +3day"; $selected[4] = " class='current'"; $selected[1] = ""; $selected[2] = ""; $selected[3] = ""; $selected[5] = ""; $selected[6] = ""; $selected[7] = "";}
elseif($getDay == 5){ $modifier = " +4day"; $selected[5] = " class='current'"; $selected[1] = ""; $selected[2] = ""; $selected[3] = ""; $selected[4] = ""; $selected[6] = ""; $selected[7] = "";}
elseif($getDay == 6){ $modifier = " +5day"; $selected[6] = " class='current'"; $selected[1] = ""; $selected[2] = ""; $selected[3] = ""; $selected[4] = ""; $selected[5] = ""; $selected[7] = "";}
elseif($getDay == 7){ $modifier = " +6day"; $selected[7] = " class='current'"; $selected[1] = ""; $selected[2] = ""; $selected[3] = ""; $selected[4] = ""; $selected[5] = ""; $selected[6] = "";}
else {
	$selected[1] = " class='current'"; $selected[2] = ""; $selected[3] = ""; $selected[4] = ""; $selected[5] = ""; $selected[6] = ""; $selected[7] = "";
	$getDay = "";
  $modifier = "";
}

$datetime = new DateTime('today'.$modifier);
$start_date = $datetime->format('Y-m-d');
$days = array('Pühapäev','Esmaspäev','Teisipäev','Kolmapäev','Neljapäev','Reede','Laupäev'); $day = $days[$datetime->format('w')];
$months = array('jaan','veeb','märts','aprill','mai','juuni','juuli','aug','sept','okt','nov','dets'); $month = $months[$datetime->format('n')-1];
$show_date = $days[$datetime->format('w')].", ".$datetime->format('d').". ".$months[$datetime->format('n')-1]." ".$datetime->format('Y');
$datetime->modify('+1 day');
$end_date = $datetime->format('Y-m-d');
$datetime->modify('-1 day');
$tooLate = 1;

function tooLate(){
	global $tooLate;
	if ($tooLate == 1) {
		echo "$('.theatres, .posters, .sidemenuitem.theme, .search').hide();\n$('.content').removeClass('push');\n";
	}
}

function dev($input) {
 if ($_SERVER['PHP_SELF'] == "/dev/index.php"){
   return $input;
 }
}

function rank($movie_id) {
  global $conn;
  $sql = "SELECT * FROM top WHERE movie_id ='".$movie_id."' LIMIT 1";
  $result = $conn->query($sql);
  $rank = $result->fetch_assoc();
  $result->close();
  $count = $rank['count'];
  $rank = $rank['id'];
  if ($rank != ""){
    if ($rank=="1"){$badge = "<div class=\"top\" ";}
    if ($rank=="2"){$badge = "<div class=\"top second\" ";}
    if ($rank=="3"){$badge = "<div class=\"top third\" ";}
    $badge .= "title=\"Enim näidatud filmid Eestis<br/>tänase (".date('d.m').") seisuga:<br/><strong>$count seanssi</strong>\"></div>\n";
    return $badge;
  }
}

$random = rand(7,14);
$countad = 0;

function printEvent($show){
  global $tooLate, $conn, $random, $countad;
  if ($show!="") {
    $kino = "";
    $badge = "";
    $tooLate = 0;
    $movie_id = $show['movie_id'];
    $image = dev('../').'posters/'.$movie_id.'.jpg';
    if (strpos($image, 'royalopera') !== false){$image = 'posters/_opera.jpg';} else {if (!file_exists($image)) {$image = 'images/poster.jpg';} else {$image = 'posters/'.$movie_id.'.jpg';}}
    if (strpos($show['methodlanguage'], '3D') !== false) {$badge = "<div class=\"d3\" title=\"3D\">3D</div>\n";}
    if (strpos($show['methodlanguage'], '5D') !== false) {$badge = "<div class=\"d5\" title=\"5D\">5D</div>\n";}
    $badge .= rank($movie_id);
    $methodlanguage = fixLanguage($show['methodlanguage']);
    $sql = "SELECT * FROM movies WHERE movie_id ='".$movie_id."' LIMIT 1";
    $result = $conn->query($sql);
    $movie = $result->fetch_assoc();
    $result->close();
    $title = fixOriginalTitle($movie['title']);
    $title_et = $movie['title_et'];
    $year = $movie['year'];
    $synopsis = $movie['synopsis'];
    $rating = fixRating($movie['rating']);
    $video = $movie['video'];

    // generate event print
    $event  = "<div class=\"show\" data-id=\"".$movie_id."\" data-time=\"".$show["showtime"]."\" title=\"".correctTitle($title)."\">\n";
    $event .= "<div class=\"info time\">\n";
    //$event .= "<div class=\"startDate\">".date(DATE_ISO8601, strtotime($show["showtime"]))."</div>\n";
    $event .= "<div class=\"time\">".date("H:i", strtotime($show["showtime"]))."</div>\n";
    $event .= "<div class=\"location\">".$show["theatre"]."</div>\n";
    $event .= "<div class=\"auditorium\">".$show["auditorium"]."</div>\n";
    $event .= "</div>\n";
    $event .= "<img itemprop=\"image\" class=\"info poster\" src='https://kinos.ee/".$image."' alt=\"Filmi ".$title." poster\">\n";
    $event .= "<div class='info'>\n";
    $event .= "<div class='title'>".correctTitle($title).$badge."<span class='original'>".correctTitle($title_et)." <span class=\"year\">($year)</span></span></div>\n";
    if ($methodlanguage!="") {$event .= "<div class=\"lang\">".$methodlanguage."</div>\n"; $separator = " / ";} else {$separator = "";}
    if ($movie['genre']!="") {$event .= "<div class=\"genres\">".$separator.ucfirst(strtolower($movie['genre']))."</div>\n";}
    if ($rating!="") {$event .= "<div class=\"rating rounded-corners\" title=\"Vanusepiirang\">".$rating."</div>\n";}
    $event .= "</div>\n";
    $event .= "<div class=\"actions\">\n";
    //$event .= "<div class=\"synopsis\">".$synopsis."</div>\n";
    if ($video!="") {$event .= "<a class=\"button video rounded-corners\" data-video=\"".$video."\" data-theatre=\"".$show['theatre']."\" data-title=\"".correctTitle($title)."\">Treiler</a>\n";}
    if (!empty($show['url'])) {$event .= "<a class=\"button buy rounded-corners\" href=\"".$show['url']."\" data-theatre=\"".$show['theatre']."\" data-title=\"".correctTitle($title)."\" target=\"_blank\">Ostan pileti</a>\n";}
    $event .= "<div class=\"close\" title=\"Close\"></div>\n</div>\n";
    $event .= "</div>\n\n";
    echo $event;
  }
}
?>
