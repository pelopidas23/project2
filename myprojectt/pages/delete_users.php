<?php
$userid = $_GET['id'];
//Instantiate Database object
$database = new Database;
$database->query('select * from users where id =:id');
$database->bind(':id',$userid);
$row = $database->single();



echo "are you ok with that I mean are you ok to delete number ". $row['id']."?<br/>";



echo '<a href="?page=delete_users_final&id='.$row['id'].'">Yes</a><br/>';






//Query
//$database->query('delete from users where id = :id');
//$database->bind(':id',$user_id);
//$row = $database->single();

//$database->query('select * from users where id =:idd');
//$database->bind(':idd',$user_id);
//$roww = $database->single();
//echo '<p>user'. $roww['id'].'is deleted</p>';

?>