<?php

$userid = $_GET['id'];
echo "<br/>Number ".$userid." is deleted<br/>";
//Instantiate Database object
$database = new Database;
//$database->query('select * from users where id =:id');
$database->query('delete from users where id = :id');
$database->bind(':id',$userid);
$row = $database->single();












//Query
//$database->query('delete from users where id = :id');
//$database->bind(':id',$userid);
//$row = $database->single();



//$database->query('select * from users where id =:idd');
//$database->bind(':idd',$user_id);
//$roww = $database->single();
//echo '<p>user'. $roww['id'].'is deleted</p>';

?>