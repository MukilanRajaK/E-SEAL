<?php 
 // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/DBCONNECT.php");
 
    // Connecting to database 
    $db = new DB_CONNECT();
    $status = $_POST['text'];
    //echo $status;exit;
    if($status == 'lock'){
        $sql = mysql_query("UPDATE lockunlock SET status='lock' WHERE id=1");
        echo 1 ;
    }else{
         $sql = mysql_query("UPDATE lockunlock SET status='unlock' WHERE id=1");
          echo 2;
    }
    //$query = mysql_query("select * from tampstatus ORDER BY no DESC LIMIT 0, 1");
    //echo "select * from tampstatus";exit;
    
   //  exit;

?>