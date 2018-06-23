<?php
$order_id;
$jain_thela_admin_id;
 
$curl = curl_init();

curl_setopt_array($curl, array(
  //CURLOPT_URL => "localhost/jainthela/api/orders/delivered_order.json?jain_thela_admin_id=".$jain_thela_admin_id."&order_id=".$order_id."&is_login=warehouse&driver_warehouse_id=1",
  CURLOPT_URL => "http://app.jainthela.in/api/orders/delivered_order.json?jain_thela_admin_id=".$jain_thela_admin_id."&order_id=".$order_id."&is_login=warehouse&driver_warehouse_id=1",
   CURLOPT_RETURNTRANSFER => true,

  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
   CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW", 
  ),
));

$response = curl_exec($curl);
pr($response);
exit;
 ?>