<h1>Welcome to myTasks!</h1>

<?php
$admin = $_GET['is_admin'];
if($_SESSION['logged_in'])
{
//Instantiate Database object

$database = new Database;
//Get logged in user
$user = $_SESSION['username'];
$database->query("SELECT * FROM users WHERE username = :username");
$database->bind(':username',$user);
$rows = $database->resultset();
$count = count($rows); 

if($rows)
{
echo '<ul class="items">';
foreach($rows as $users)
{
//echo '<li><a href="?page=welcome&id='.$users['id'].'">'.$users['is_admin'].'</a></li>';

echo '</ul>';
		
		
				if($users['is_admin']=="yes")
				 {
				//Query
				$database->query('SELECT * FROM users');
				//$database->bind(':user',$user);
				$rows = $database->resultset();

				echo '<h4>Here are your current users</h4><br />';
				echo 'But if you want you can add one <a href="index.php?page=add_users">add a user</a>';


				if($rows)
				{
				echo '<ul class="items">';
				foreach($rows as $users)
				{
				echo '<li><a href="?page=userss&id='.$users['id'].'">'.$users['username'].'</a></li>';
				}
				echo '</ul>';
				}
				}//end $users['is_admin']=="yes"
				elseif ($users['is_admin']=="no")
				{
					echo "welcome to the warehouse";
				}//end $users['is_admin']=="No"
				
}//end foreach($rows as $users)
}//end if($rows)  
 
 



else 
{
echo 'There are no users  <a href="index.php?page=new_list">Create One Now</a>';
}	 
}//end if($_SESSION['logged_in'])

else 
{
echo "<p>Hello we welcome you to the best e-warehouse of all times.....please register in order to be part of the biggest online market</p>";
}

?>