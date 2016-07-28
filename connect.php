<?php 

class Database{ 
 
    // specify your own database credentials 
    $DB_host = "localhost"; 
    $DB_name = "RBPortalDB"; 
    $DB_name = "root"; 
    $DB_password = "Lillie2012"; 
   
 
try
{
 $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 echo $e->getMessage();
}

include_once 'ClassCrud.php';

$crud = new crud($DB_con);

?>