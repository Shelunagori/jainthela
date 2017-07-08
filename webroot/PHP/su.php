<?php 

include('Crypto.php');
include("database.php");

	error_reporting(0);
	
	$workingKey='0138CFCDE02CFF53882E19CF60A53C5A';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	
                $order_status=$information[1];
	}

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		$o_id=$information['order_id'];
	}
      
      
      
      
	$update_s=mysql_query("update `add_to_carts` SET `order_status`='$order_status' where `order_no`='$o_id' " );

	if(!empty($order_status))
	{
	  echo "<script> processHTML(); </script>";
	}

?>

	<input type="hidden" name="order_status" id="order_status" value="<?php echo $order_status; ?>" />

	<script>
	function processHTML() {
	 var order_status = document.getElementById("order_status").value;
 	 window.HTMLOUT.processHTMLResponse(order_status);
  	}
	</script>



