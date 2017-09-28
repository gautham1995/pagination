<?php
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
// start coding

// how many records per page
$rpp = 500;
// check for set page
isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;

// check for page 1
if($page > 1){
  $start = ($page * $rpp) - $rpp;
}else{
  $start = 0;
}
// query db for total records
$sql = "SELECT id FROM user_details WHERE gender='female'";
$resultSet = $conn->query($sql);

//get total records
$numRows = $resultSet->num_rows;
//get total no. of pages
$totalPages = ($numRows / $rpp);
echo "Total pages = ".$totalPages;
echo "<br>Each page = ".$rpp;
echo "<br><br>";

//query results
$sqlm = "SELECT * FROM user_details WHERE gender='female' ORDER BY id LIMIT $start, $rpp ";
$resultSet = $conn->query($sqlm);

echo "<table border='1'>";
echo "<tr>
    <th>Id</th>
    <th>USername</th> 
    <th>First Name</th>
    <th>Last Name</th> 
    <th>Gender</th>
    <th>Status</th>
    </tr>";

while($rows = $resultSet->fetch_assoc()) {
  $id = $rows['id'];
  $un = $rows['username'];
  $fn = $rows['first_name'];
  $ln = $rows['last_name'];
  $ge = $rows['gender'];
  $st = $rows['status'];

  echo "<tr>
  <td>".$id."</td>
  <td>".$un."</td>
  <td>".$fn."</td>
  <td>".$ln."</td>
  <td>".$ge."</td>
  <td>".$st."</td>
  </tr>";
}

echo "</table>";

for ($x=1; $x <= $totalPages+1 ; $x++) { 
  echo "<a href=?page=".$x.">".$x."</a>";
}




$conn->close();
?>