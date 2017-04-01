<?php
 

    $mlab = new MongoClient("mongodb://eproseso:eproseso@ds059682.mlab.com:59682/eproseso");
   $db = $mlab->eproseso;
   $healthcards = $db->healthcards;
 

   $report_title = "Report";
   echo $_GET["y"];
   echo "<br>-------------------------<br>";
    $items=  array();
    $rows = $healthcards->find(array("y"=>(int)$_GET["y"]));
    $rows2 = iterator_to_array($rows);

   // echo "-=-------------------";
    //print_r($rows2);
    foreach ($rows2 as $key => $val) {
         //$new_row = array($row['hc_lastname'].", ".$row['hc_firstname'],$row['hc_firstname'],$row['hc_position'],$row['hc_job_category'],$row['hc_business_employment']);
        //array_push($items,$new_row);  
       print_r($val);
     }

?>