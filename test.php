<?php
 

    $mlab = new MongoClient("mongodb://eproseso:eproseso@ds059682.mlab.com:59682/eproseso");
   $db = $mlab->eproseso;
   $healthcards = $db->healthcards;
 

   $report_title = "Report";
    $items=  array();
    $rows = $healthcards->find();
    $rows2 = iterator_to_array($rows);
    
    print_r($rows2);
   // echo "-=-------------------";

    /*foreach ($rows as $row) {
         //$new_row = array($row['hc_lastname'].", ".$row['hc_firstname'],$row['hc_firstname'],$row['hc_position'],$row['hc_job_category'],$row['hc_business_employment']);
        //array_push($items,$new_row);  
      echo $row['hc_lastname'];
     }*/

?>