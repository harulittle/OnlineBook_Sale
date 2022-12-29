<?php
session_start();
  $sever_name="localhost";
  $user_name="root";
  $password="";
  $dbname="onlinebook_db";
  $conn=new mysqli($sever_name,$user_name,$password,$dbname);
  if($conn->connect_error)
  {
  	die("Connection Failed".$conn->connect_error);
  }
  else
  {
  	//echo "Successful";
  }
  ?>