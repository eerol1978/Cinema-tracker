<?
date_default_timezone_set("Europe/Tallinn");

$server = "";
$sql_db = "";
$sql_user = "";
$sql_pw = "";

// Open a connection
$conn = new mysqli($server, $sql_user, $sql_pw, $sql_db);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
  die("Error:\n".$conn->connect_error);
}

function db($table, $columns, $query) {
  if ($query) {
    $query = "SELECT $columns FROM $table WHERE $query";
  } else {
    $query = "SELECT $columns FROM $table";
  }

  global $conn;
  $result = $conn->query($query);
  while($row = $result->fetch_assoc()){
        $result_array[] = $row;
    }
  if (!empty($result_array)) {return $result_array;}
  $result->close();
}
?>
