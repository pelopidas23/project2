<?php 
$userid = $_GET['id'];

$database = new Database();
$database->query('select * from users where id =:id');
$database->bind(':id',$userid);
$row = $database->single();

echo '<p>'.$row['id'],' | ', $row['username'],' | ', $row['password'],' | ', $row['firstname'],' | ', $row['lastname'],' | ', $row['address'],' | ', $row['country_id'],' | ', $row['email'],' | ', $row['registration_date'],' | ', $row['status'],' | ', $row['is_admin'].'</p>';
echo '<a href="?page=edit_users&id='.$row['id'].'">Edit User</a> | ';
echo '<a href="?page=delete_users&id='.$row['id'].'">Delete User</a><br/>';
//echo '<a href="?page=delete_users&id" name="deleete">Delete User</a><br/>';






?>
