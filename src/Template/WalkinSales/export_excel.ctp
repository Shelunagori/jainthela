<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Invoice_report";

	 header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>	
				<table border="1">
					<thead>
						<tr>
							<th>df</th>
							<th>sd</th>
							<th>er</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>2</td>
							<td>3</td>
						</tr>
					</tbody>
				</table>