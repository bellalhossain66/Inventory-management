<?php
  $host="localhost"; 
  $username="root"; 
  $password=""; 
  $db_name="raihan_vai"; 

  mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
  mysql_select_db("$db_name")or die("cannot select DB");
?>