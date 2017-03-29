<?php
   $mlab = new MongoClient("mongodb://eproseso:eproseso@ds059682.mlab.com:59682/eproseso");
   $db = $mlab->eproseso;
   $applications = $db->applications;

   $rows = $applications->find();

   foreach ($rows as $row) {
      echo $row["lastname"] . "\n";
   }

  


?>