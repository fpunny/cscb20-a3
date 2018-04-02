<?php
$servername = "mathlab.utsc.utoronto.ca";
$username = "yourutorid";
$password = "yourutorid";
$dbName="cscb20w18_yourutorid";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

$authusername=$_GET['user'];
$authpassword=$_GET['password'];

$sql = "SELECT * from users where name=\"".$authusername."\"";
$sqlresult = $conn->query($sql);

header('Content-type: application/json');

if ($sqlresult->num_rows > 0) {
    // output data of each row
    while($row = $sqlresult->fetch_assoc()) {
        $result=array(
            "success"=>True,
            "id"=>$row["id"],
            "user"=>$authusername,
            "auth_success"=>$row["password"]==$authpassword,
            "is_student"=>$row["is_student"]=="YES" ? True : False
        );
    }
} else {
    $result=array(
        "success"=>False
    );
}

echo json_encode($result);
$conn->close();
?>
