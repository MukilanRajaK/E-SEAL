<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year']) && isset($_GET['hour']) && isset($_GET['min']) && isset($_GET['sec']) && isset($_GET['tamperedstatus']) && isset($_GET['longitude']) && isset($_GET['latitude'])) {
 
    $day = $_GET['day'];
    $month = $_GET['month'];
	$year= $_GET['year'];
	$hour = $_GET['hour'];
	$min = $_GET['min'];
	$sec = $_GET['sec'];
	$tamperedstatus = $_GET['tamperedstatus'];
    $longitude = $_GET['longitude'];
	$latitude = $_GET['latitude'];
	
    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/DBCONNECT.php");
 
    // Connecting to database 
    $db = new DB_CONNECT();
 
    // Fire SQL query to insert data in weather
    $result = mysql_query("INSERT INTO tampstatus(day,month,year,hour,min,sec,tamperedstatus,longitude,latitude) VALUES('$day','$month','$year','$hour','$min','$sec','$tamperedstatus','$longitude','$latitude')");
 
    // Check for succesfull execution of query
    if ($result) {
        // successfully inserted 
        $response["success"] = 1;
        $response["message"] = "Tamper Details successfully created.";
 
        // Show JSON response
        echo json_encode($response);
    } else {
        // Failed to insert data in database
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";
 
        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    // Show JSON response
    echo json_encode($response);
}
?>
