<?
include 'connection.php';
include 'corrections.php';

$to = "";
$subject = "Kinos.ee movies update";
$headers = "From: \"Kinos.ee\" <no-reply@kinos.ee>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$message = "";

$urls = array (
  'http://www.forumcinemas.ee/xml/Events/',
  'https://www.apollokino.ee/xml/Events/',
  'http://www.kino.ee/xml/Events/',
  'https://www.viimsikino.ee/xml/Events/',
  'https://api.cinamonkino.com/xml/Schedule/?id=9994', // tasku
  'https://api.cinamonkino.com/xml/Schedule/?id=9989', // T1
  'https://api.cinamonkino.com/xml/Schedule/?id=9999' // kosmos
);

foreach ($urls as $feedUrl) {
  combineData($feedUrl);
}

function combineData($feed) {
	global $conn;
	$xml = simplexml_load_file($feed);
  if (isset($xml->Shows->Show)) {
    foreach($xml->Shows->Show as $element){
      manageData($element);
    }
  } else {
  	foreach($xml->Event as $element){
      manageData($element);
    }
  }
}

function manageData($element) {
  global $title, $conn, $title_et, $video;
    $video = "";
    $EventLargeImagePortrait = ""; if (!empty($element->Images->EventLargeImagePortrait)) {$EventLargeImagePortrait = $element->Images->EventLargeImagePortrait; if (strpos($EventLargeImagePortrait, 'http') !== 0) {$EventLargeImagePortrait = "https:".$EventLargeImagePortrait;}}
    $EventSmallImagePortrait = ""; if (!empty($element->Images->EventSmallImagePortrait)) {$EventSmallImagePortrait = $element->Images->EventSmallImagePortrait; if (strpos($EventSmallImagePortrait, 'http') !== 0) {$EventSmallImagePortrait = "https:".$EventSmallImagePortrait;}}

		$title = fixOriginalTitle(fixTitle($element->OriginalTitle));
    setImage(fixID($title), $EventLargeImagePortrait, $EventSmallImagePortrait);

    if (!exist(fixID($title))) {
      $title_et = fixTitle($element->Title);
      $genre = fixGenres($element->Genres);
      $video = $element->Videos->EventVideo->Location;
      $movie_id = fixID($title);
      // Fix wrong years
      if ($element->ProductionYear){$year = $element->ProductionYear;} else {$year = "2017";}
  		if ($title == "Star Wars: The Last Jedi"){$year = 2017;}
  		if ($title == "Murder on the Orient Express"){$year = 2017;}
  		if ($title == "Pettersson und Findus 2 - Das schönste Weihnachten überhaupt"){$year = 2016;}
      if ($title == "Condorito: La Película"){$year = 2017;}
      if ($title == "Женщины против мужчин 2: Крымские каникулы"){$year = 2017;}

  		if (!$conn->query("INSERT INTO movies (id, movie_id, title, title_et, synopsis, year, length, rating, genre, video, saved)
      VALUES (NULL, '".$movie_id."', '".$title."', '".$title_et."', '".fixSynopsis($element->Synopsis)."', '".$year."', '".$element->LengthInMinutes."', '".fixRating($element->Rating)."', '".$genre."', '".$video."', NOW())")) {
        printf("Error: %s\n", $conn->error);
      }
    }
}

function exist($id) {
	global $conn;
	$query = "SELECT movie_id FROM movies WHERE movie_id = '".$id."' LIMIT 1";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {return true;}
}

function setImage($id, $imageLarge, $imageSmall){
	global $title, $updateStatus, $message;
  if ($imageLarge){$image = $imageLarge;}
  else {$image = $imageSmall;}
	$folder = '/home/blurone/kinos.ee/posters/';
	$imageLocal = $id.'.jpg';
  if (!file_exists($folder.$imageLocal)) {
    if(exif_imagetype($image) != IMAGETYPE_JPEG){
      $image = imagecreatefrompng((string)$image);
    } else {
      $image = imagecreatefromjpeg((string)$image);
    }
		imagejpeg($image, $folder.$imageLocal, 75);
		print $message .= "Salvestatud: <a href=\"https://kinos.ee/posters/$id.jpg\" target=\"_blank\">$title</a><br>";
    $updateStatus = 1;
	} else {
    if(@exif_imagetype($image) == IMAGETYPE_JPEG or @exif_imagetype($image) == IMAGETYPE_PNG){
      list($localsize) = getimagesize($folder.$imageLocal);
      list($remotesize) = getimagesize($image);
      if ($localsize < $remotesize) {
        if(exif_imagetype($image) != IMAGETYPE_JPEG){
          $image = imagecreatefrompng((string)$image);
        } else {
          $image = imagecreatefromjpeg((string)$image);
        }
    		imagejpeg($image, $folder.$imageLocal, 75);
    		print $message .= "Uuendatud: <a href=\"https://kinos.ee/posters/$id.jpg\" target=\"_blank\">$title</a><br>";
        $updateStatus = 1;
      }
    }
  }
}
$conn->close();
if ($updateStatus != 1) {print $message .=  "Update finished. No update.";} else {print $message .=  "Update finished.";}
//mail($to, $subject, $message, $headers);
?>
