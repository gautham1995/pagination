<?php

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
isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;

// check for page 1
if($page > 1){
  $start = ($page * $rpp) - $rpp;
}else{
  $start = 0;
}

//query results
$sql = "SELECT * FROM user_details WHERE first_name='bell' ORDER BY id LIMIT $start, $rpp ";
$resultSet = $conn->query($sql);



//

$last;
$sql1 = "SELECT * FROM user_details WHERE first_name='bell' ORDER BY id LIMIT $start, $rpp";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row1 = mysqli_fetch_assoc($result1)) {
// echo $row1['id'];
        $last = $row1['id'];
    }  
} else {
    echo "0 results";
}

//

$sl = 0;
// json starts
echo '{';

while($rows = $resultSet->fetch_assoc()) {
  echo  '"'.$sl.'":{';
  echo '"id":'.$rows['id'].','; 

  echo '"un":"'.$rows['username'].'",';
  echo '"fn":"'.$rows['first_name'].'",';
  echo '"ln":"'.$rows['last_name'].'",';
  echo '"ge":"'.$rows['gender'].'",';
  echo '"pw":"'.$rows['password'].'"';

if($rows['id']== $last){
  echo '}';
}else{
   echo '},';
}

  



  $sl++;
}
//echo '"lastID":'.$page.'';

echo '}';
// json ends
$conn->close();
?>