<?php
   // connect to mongodb
   $m = new MongoClient("mongodb://eproseso:eproseso@ds059682.mlab.com:59682/eproseso");
  
   echo "Connection to database successfully";
   // select a database
   $db = $m->eproseso;
  
   echo "Database mydb selected";
?>