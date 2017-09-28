<?php

//reddit json format 


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root";
$password = "gautham";
$dbname = "angular_demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
#####################################################

// how many records per page
$rpp = 10;
// check for set page
isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;

// check for page 1
if($page > 1){
  $start = ($page * $rpp) - $rpp;
}else{
  $start = 0;
}

//query results
$sql = "SELECT * FROM user_details WHERE first_name='bell' ORDER BY id LIMIT $start, $rpp ";
$resultSet = $conn->query($sql);

//$sl = 0;
$n = mysqli_num_rows($resultSet);
$counter = 0;
// json starts
echo '{
    "data":{
    "children":[
    ';


while($rows = $resultSet->fetch_assoc()) {

if (++$counter == $n) {
  // last row
echo '{
"data": {
"id":"'.$rows['id'].'",
"un":"'.$rows['username'].'",
"fn":"'.$rows['first_name'].'",
"ln":"'.$rows['last_name'].'",
"gn":"'.$rows['gender'].'",
"pw":"'.$rows['password'].'"
}
}';

}else{
echo '{
"data": {
"id":"'.$rows['id'].'",
"un":"'.$rows['username'].'",
"fn":"'.$rows['first_name'].'",
"ln":"'.$rows['last_name'].'",
"gn":"'.$rows['gender'].'",
"pw":"'.$rows['password'].'"
}
},';

}

}


echo '],
      "page":'.$page.'';
echo '}}';
// json ends
$conn->close();
?>