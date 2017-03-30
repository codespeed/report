<?php
  header('X-Frame-Options: EPROSESO');

  require('fpdf/fpdf.php');


   $mlab = new MongoClient("mongodb://eproseso:eproseso@ds059682.mlab.com:59682/eproseso");
   $db = $mlab->eproseso;
   $applications = $db->applications;

   $rows = $applications->find();

   foreach ($rows as $row) {
      echo $row["lastname"] . "\n";
   }

   $d = "";
   $m= "";
   $y = "";

   if(isset($_GET['d']) && isset($_GET['m']) && isset($_GET['y'])){
   	$d = $_GET['m'] ."-".$_GET['d']."-".$_GET['y'];
   }

   if(isset($_GET['m']) && isset($_GET['y'])){
   	$m = $_GET['m'] ."-".$_GET['d']."-".$_GET['y'];
   }

   if(isset($_GET['y'])){
   	$y = $_GET['y'];
   }

  



?>