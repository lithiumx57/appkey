<?php
require 'BPM_PGW.php';
$phpVer = phpversion();
echo "PHP version: $phpVer <br>";

$p= new bpPayRequest();

$p->terminalId=2768649;//long
$p->userName="be27";//string
$p->userPassword="61661619";//string
$p->orderId=140;//long // Attention: Increase it per call
$p->amount=1500;//long
$p->localDate="20170718";//string
$p->localTime="110351";//string
$p->additionalData="";//string
$p->callBackUrl="http://172.20.120.160:80/pgw/callback.php";//string // Attention:Replace it with your URL
$p->payerId=0;//long

$c =new BPM();

$bpPayRequestResponse= $c->bpPayRequest($p);

var_dump($bpPayRequestResponse);
?>