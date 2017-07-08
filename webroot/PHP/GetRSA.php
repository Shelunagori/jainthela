<?php
$url = "https://secure.ccavenue.com/transaction/getRSAKey";
$oi=  $_POST['order_id'];
$fields = array(
        'access_code'=>"AVRZ70ED00AA49ZRAA",
        'order_id'=>$oi,
);
$postvars='';
$sep='';
foreach($fields as $key=>$value)
{
       $postvars.= $sep.urlencode($key).'='.urlencode($value);
        $sep='&';
}

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch, CURLOPT_CAINFO, '/PHP/cacert.pem');
curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);

echo $result;
?>

