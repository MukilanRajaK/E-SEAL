<?php 
 // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/DBCONNECT.php");
 
    // Connecting to database 
    $db = new DB_CONNECT();
    $query = mysql_query("select * from tampstatus ORDER BY no DESC LIMIT 0, 4");
     $query1 = mysql_query("select status from lockunlock WHERE id=1");
     
    //echo "select * from tampstatus";exit;
    
   //  exit;

?>
<html lang="en">
<head>
	<title>Seal Status</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
<style>
img {

}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: auto;
}
</style>
</head>
<body>
	<img src="Indian_Railways.png" alt="HTML5 Icon" width="190" height="300" class="center">
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
							    <th class="column1">Train No</th>
								<th class="column1">Seal Id</th>
								<th class="column2">Day</th>
								<th class="column3">Month</th>
								<th class="column4">Year</th>
								<th class="column5">Hour</th>
								<th class="column6">Minutes</th>
								<th class="column7">Seconds</th>
								<th class="column8">Tampered Status</th>
								<th class="column9">Longitude</th>
								<th class="column10">Latitude</th>
								<th class="column11">Action</th>
								<th class="column12">status</th>
								<th class="column13">Maps</th>
							</tr>
						</thead>
						<tbody>
						    <?php 
						    $i=1;
						    $train='06032016';
						     while ($row = mysql_fetch_array($query)) {?>
             <tr>
                                     <td class="column1">123216</td>
									<td class="column1"><?php echo $train?></td>
									<td class="column2"><?php echo $row["day"];?></td>
									<td class="column3"><?php echo $row["month"];?></td>
									<td class="column4"><?php echo $row["year"];?></td>
									<td class="column5"><?php echo $row["hour"];?></td>
									<td class="column6"><?php echo $row["min"];?></td>
									<td class="column7"><?php echo $row["sec"];?></td>
									<td class="column8"><?php echo $row["tamperedstatus"];?></td>
									<td class="column9"><?php echo $row["longitude"];?></td>
									<td class="column10"><?php echo $row["latitude"];?></td>
										 <?php if($i==1){while ($rows = mysql_fetch_array($query1)) {?>
										<td class="column11">
										   <?php
										    if($rows['status'] == 'lock'){
										        $sta = 'unlock';
										        
										        $s='locked';
										    }else{
										        $sta = 'lock';
										        
										        $s='unlocked';
										    }
										    ?>
										    <button type="button" class="btn btn-primary" id="btnTest" onclick="lock_status()"><?php echo $sta;?></button>
										   
										    </td>
										    <td class="column12"><?php echo $s;?></td> <?php }}else{?>
										    <td class="column12"><button type="button" class="btn btn-primary"><?php echo 'lock';?></button></td>
										    <td class="column13"><?php echo 'unlocked';?></td>
										    <?php } ?>
										    <td class="column13"><button type="button" class="btn btn-primary" id="btnTest" onclick="maps_view('<?php echo $row["latitude"];?>','<?php echo $row["longitude"];?>')"><?php echo 'View';?></button></td>
										    
			   </tr>
        <?php $i++;$train++; }
						    ?>
								
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	

<!--===============================================================================================-->	
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>
<script>
    function lock_status(){
        var text = $("#btnTest").text();
        if(text != ""){
            $.ajax({
                url: "status.php",
                type: "post",
                data: {text:text},
                success: function(d) {
                    // console.log(d);
                    // return false;
                    if(d == 1){
                       
                        $("#btnTest").text('unlock');
                         alert('Locked Successfully!')
                         location.reload(true);
                         
                    }else{
                        
                        $("#btnTest").text('lock');
                        alert('Unlocked Successfully!')
                        location.reload(true);
                    }
                    //alert(d);
                }
            });
        }
        
    }
    function maps_view(lat,lon){
        window.open('https://www.google.com/maps/search/?api=1&query='+lat+','+lon, '_blank');
    }
</script>
</body>
</html>