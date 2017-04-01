<?php
 

    $mlab = new MongoClient("mongodb://eproseso:eproseso@ds059682.mlab.com:59682/eproseso");
   $db = $mlab->eproseso;
   $applications = $db->applications;
 

   $report_title = "Report";
    $items=  array();
    $rows = $applications->find();

    print_r($rows);

   /* foreach ($rows as $row) {
         $new_row = array($row['hc_lastname'].", ".$row['hc_firstname'],$row['hc_firstname'],$row['hc_position'],$row['hc_job_category'],$row['hc_business_employment']);
        array_push($items,$new_row);  
     }*/

?>