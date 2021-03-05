<?php $username='root';
   $password='';
   $dsn='mysqli:host=localhost; dbname=mydb';
   try{
       $connn=new PDO($dsn,$username,$password);
       $connn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e){
       echo "Fail to connect to the database".$e->getMessage();
   } 
   ?>