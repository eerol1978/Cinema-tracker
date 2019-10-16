<?
include 'connection.php';
include 'corrections.php';
include 'delete_old_entries.php';

$newmovie = 0;
$to = "";
$subject = "Kinos.ee schedule update";
$headers = "From: \"Kinos.ee\" <no-reply@kinos.ee>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$message = "";

$datetime = new DateTime('today');
$today = $datetime->format('d.m.Y');
$days = 7;
$urls = array(
	array('https://www.apollokino.ee/xml/Schedule/?area=1004&nrOfDays='.$days.'&dt='.$today, 'Tallinn'),
	array('http://www.forumcinemas.ee/xml/Schedule/?area=1008&nrOfDays='.$days.'&dt='.$today, 'Tallinn'),
	array('http://www.kino.ee/xml/Schedule/?nrOfDays='.$days.'&dt='.$today, 'Tallinn'),
	array('https://www.viimsikino.ee/xml/Schedule/?nrOfDays='.$days.'&dt='.$today, 'Tallinn'),
  array('https://www.apollokino.ee/xml/Schedule/?area=1011&nrOfDays='.$days.'&dt='.$today, 'Tartu'),
	array('http://www.forumcinemas.ee/xml/Schedule/?area=1005&nrOfDays='.$days.'&dt='.$today, 'Tartu'),
  array('https://www.apollokino.ee/xml/Schedule/?area=1002&nrOfDays='.$days.'&dt='.$today, 'Pärnu'),
  array('https://www.apollokino.ee/xml/Schedule/?area=1008&nrOfDays='.$days.'&dt='.$today, 'Narva'),
  array('http://www.forumcinemas.ee/xml/Schedule/?area=1011&nrOfDays='.$days.'&dt='.$today, 'Viljandi'),
  array('https://www.apollokino.ee/xml/Schedule/?area=1012&nrOfDays='.$days.'&dt='.$today, 'Saaremaa'),
	array('https://api.cinamonkino.com/xml/Schedule/?id=9994', 'Tartu'), //masku
	array('https://api.cinamonkino.com/xml/Schedule/?id=9989', 'Tallinn'), // T1
	array('https://api.cinamonkino.com/xml/Schedule/?id=9999', 'Tallinn') // Kosmos
);


foreach ($urls as $feedUrl) {
  $sql = combineData($feedUrl[0], $feedUrl[1]);
}


// Functions

function combineData($feed, $city) {
	echo "Combining data<br>";
	global $conn, $message;
	$xml = simplexml_load_file($feed);
	foreach($xml->Shows->Show as $element){

      $title = fixOriginalTitle(fixTitle($element->OriginalTitle));
      $theatre = fixTheatre($element->Theatre);
  		$showtime = str_replace('T', ' ', $element->dttmShowStart);
      $movie_id = fixID($title);
			$auditorium = fixAuditorium($element->TheatreAuditorium);

			if (!exist($city,$theatre,$auditorium,$showtime)) {
      $query = "INSERT INTO schedule (id, movie_id, location, theatre, auditorium, showtime, methodlanguage, url)
      VALUES (
      NULL,
      '".$movie_id."',
      '".$city."',
      '".$theatre."',
      '".$auditorium."',
      '".$showtime."',
      '".$element->PresentationMethodAndLanguage."',
      '".$element->ShowURL."'
      )
      ";
      if ($conn->query($query) === TRUE) {
    	  print $message .= "Added id: <b>$movie_id</b> in $theatre at $showtime<br>";
    	} else {
    	  print $message .= "Unable to add id: <b>$movie_id</b> in $theatre at $showtime<br>".$conn->error."<br>";
    	}
		} else {
			$query = "UPDATE schedule SET movie_id = '".$movie_id."', methodlanguage = '".$element->PresentationMethodAndLanguage."', url = '".$element->ShowURL."' WHERE location = '".$city."' && theatre = '".$theatre."' && auditorium = '".$auditorium."' && showtime = '".$showtime."' LIMIT 1";
      if ($conn->query($query) === TRUE) {
    	  print $message .= "Added id: <b>$movie_id</b> in $theatre at $showtime<br>";
    	} else {
    	  print $message .= "Unable to add id: <b>$movie_id</b> in $theatre at $showtime<br>".$conn->error."<br>";
    	}
		}
  }
	//return $sql;
}

function exist($city,$theatre,$auditorium,$showtime) {
	global $conn;
	$query = "SELECT * FROM schedule WHERE location = '".$city."' && theatre = '".$theatre."' && auditorium = '".$auditorium."' && showtime = '".$showtime."' LIMIT 1";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {return true;}
}

// --------------------------------------update-top-start--------------------------------------
$sql = "SELECT movie_id, COUNT(movie_id) AS movieCount FROM schedule WHERE DATE(showtime) = CURDATE() AND methodlanguage NOT LIKE '%5D%' GROUP BY movie_id ORDER BY COUNT(movie_id) DESC LIMIT 3";
$result = $conn->query($sql);
$rank = 0;
while($show = $result->fetch_assoc()) {
  $rank++;
  $conn->query("UPDATE top SET movie_id='".$show['movie_id']."',count='".$show['movieCount']."' WHERE id='".$rank."'");
}
$result->close();
// --------------------------------------update-top-end--------------------------------------

$conn->close();
print $message .= "Update finished.";
//mail($to, $subject, $message, $headers);
?>
