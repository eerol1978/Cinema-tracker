<?
// Delete old entries
$query = "DELETE FROM schedule WHERE showtime < DATE(NOW())";
$message = "";
if ($conn->query($query) === TRUE) {
  print $message .= "Old entries deleted.<br>";
} else {
  print $message .= "Error:<br>".$conn->error."<br><br>Query:<br>".$query;
}
?>
