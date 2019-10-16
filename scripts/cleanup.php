<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?
include 'connection.php';
$folder = 'kinos.ee/posters/';
$oldfolder = $folder.'old/';

$sql = "DELETE FROM schedule WHERE showtime < NOW()";
$conn->query($sql);

$sql = "SELECT * FROM movies";
$result = $conn->query($sql);
while($show = $result->fetch_assoc()){

  $sql2 = "SELECT * FROM schedule WHERE movie_id = '".$show['movie_id']."' LIMIT 1";
  $result2 = $conn->query($sql2);
  $schedule = $result2->fetch_assoc();
  $title = str_replace("%27", "'", $show['title']);
  if($schedule) {
    $i++;
    echo "$i. <b>$title</b> (".$show['title_et'].") exists (".$schedule['showtime'].")<br>";
  } else {
    echo "<div style=\"color: #9f9f9f;\"><b>$title</b> (".$show['title_et'].") does not exist, entry deleted.</div>";
    $erase = "DELETE FROM movies WHERE movie_id = '".$show['movie_id']."'";
    $conn->query($erase);
    rename($folder.$show['movie_id'].".jpg", $oldfolder.$show['movie_id'].".jpg");
    //unlink($folder.$show['movie_id'].".jpg");
  }
}

/*
$images = glob($folder."*.jpg");
foreach($images as $image) {
    $id = basename($image,'.jpg');
    $old = $oldfolder.basename($image);
    $sql = "SELECT * FROM movies WHERE movie_id = '$id'";
    $result = $conn->query($sql);
    $show = $result->fetch_assoc();
    if($show) {echo $id.' (show exists)<br />';} else {echo "<div style=\"color: #9f9f9f;\">".$id." does not exist, moved to /old</div>";rename($image, $old);}
}
*/
?>
</body>
</html>
