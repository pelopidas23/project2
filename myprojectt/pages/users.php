 <?php

 include '../config.php';
 include '../classes/databases.php';
  //try 
  //{
	  $database = new PDO('mysql:host=localhost;dbname=warehouse;charset=utf8','root','');
	  //$database = new Database;
	  //$database = $dbh;
   //}
  //catch(PDOException $e){echo $e->getMessage(); }


//Instantiate Database object
 $sth = $database->query('SELECT * FROM users');
 //$sth->bind(':id',$user_id);
 //$sth = $database->resultset();
 //$sth->execute();
 $sth->setFetchMode(PDO::FETCH_OBJ);
 
?>

 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<h1>Users</h1>
<table width="500" cellpadding=5 cellspacing=5 border =1 >
<tr>
<th>ID#</th>
<th>First name</th>
<th>Last Name</th>
<th>email</th>
<th>Username</th>
<th>Address</th>
<th>country_id</th>
<th>Password</th>
<th>Registration Date</th>
<th>Delete</th>
<th>Update</th>

</tr>




<?php while($row=$sth->fetch()): ?>
<tr>

<th> <input style="text-align:center" type="text" name="idd"               value = "<?php $iddd       = $row->id;                 echo $iddd;                                        ?>"            size="1">                </th>
<th> <input style="text-align:center" type="text" name="ffirstname"        value = "<?php $ffirstname = $row->firstname;          echo $ffirstname;                                  ?>"            size="9">                </th>
<th> <input style="text-align:center" type="text" name="llastname"         value = "<?php $llastname  = $row->lastname;           echo $llastname; $length    = strlen($llastname);  ?>"            size="<?phpecho $length;?>">   </th>
<th> <input style="text-align:center" type="text" name="email"             value = "<?php $email      = $row->email;              echo $email;     $emlength  = strlen($email);      ?>"            size="<?phpecho $emlength;?>"> </th>
<th> <input style="text-align:center" type="text" name="uusername"         value = "<?php $uusername  = $row->username;           echo $uusername;                                   ?>"            size="9">                </th>
<th> <input style="text-align:center" type="text" name="aaddress"          value = "<?php $aaddress   = $row->address;            echo $aaddress;                                    ?>"            size="9">                </th>
<th> <input style="text-align:center" type="text" name="country_id"        value = "<?php $country_id = $row->country_id;         echo $country_id;                                  ?>"            size="1">                </th>
<th> <input style="text-align:center" type="text" name="ppassword"         value = "<?php $pass       = $row->password;           echo $pass;      $passlength = strlen($pass);      ?>"            size="<?php echo 6; ?>"> </th>
<th> <input style="text-align:center" type="text" name="registration_date" value = "<?php $date       = $row->registration_date;  echo $date;      $dlength    = strlen($date);      ?>"            size="<?phpecho $dlength;?>">  </th>
 
<th> 
<br /><a href= "<?php echo $_SERVER['PHP_SELF']; ?>?deleteid=<?php echo $iddd; ?>" >Delete</a>
</th>
<th> 
<br /><a href= "<?php echo $_SERVER['PHP_SELF']; ?>?updateid=<?php echo $iddd;?>&fname=<?php echo $ffirstname;?>&lname=<?php echo $llastname;?>&user=<?php echo $uusername;?>&address=<?php echo $aaddress;?>" name = "update_submit">Update</a>
</th>
</tr>
<?php endwhile;?>



</table>
<br/>
</form>

 

<?php
if(isset($_GET['deleteid']))
{
	$deleteid = (int)$_GET['deleteid'];
	
	echo '<div> Delete id: ' . $deleteid .'</div>';
	$sth = $database->prepare("delete from users where id = :id");
	$sth->bindParam(':id',$deleteid);
	$sth->execute();
	
    if($sth)
	{
		echo  '<div> user  ' . $deleteid .' deleted'.'</div>';
	}
}
?>

<?php
/*(isset($_GET['updateid']))*/if($_POST['update_submit']){


	
        $updateid  = (int)$_GET['updateid'];
        $firstname = $_POST['fname'];
		$lastname = $_POST['lname'];
		//$email = $_POST['email'];
		$username = $_POST['user'];
		$$address = $_POST['address'];
		$countryid = $_POST['country_id'];
		$password  = $_POST['ppassword'];
		$date  = $_POST['registration_date'];
		
		
	//$firstname = $_GET['fname']; 
	//$lastname = $_GET['lname']; 
	//$email          = (string)$_GET['email'];
	//$username  = $_GET['user'];
	//$address = $_GET['address']; 
	/*$countryid = (int)$_GET['countryid']; 
	$password          = (int)$_GET['pass'];*/
	
	
	/*$lastname          = "cdsfcds";
	
	//$updateid          = $iddd;//me ayth th dhlwsh oi allages pragmatopoioyntai mono sthn teleutaia eggrafh
	$username          = 
	$password          = $pass;

	$address           = $aaddress; 
	$country_id        = $country_id; 
	$registration_date = $date;*/

	
	echo '<div> updateid id: ' . $updateid .'</div>';
	$sth = $database->prepare("update users set  id=:id,
	                                             firstname=:firstname, 
												 lastname =:lastname,
												 email =:email,
	                                             username =:username,
												 address=:address,
												 country_id=:country_id,
												 password=:password,
												 registration_date=:registration_date 
                                                 where id = :id");
	$sth->bindParam(':id',$updateid);
	$sth->bindParam(':firstname',$firstname);
	$sth->bindParam(':lastname',$lastname);
	$sth->bindParam(':email',$email);
	$sth->bindParam(':username',$username);
	$sth->bindParam(':address',$address);
	$sth->bindParam(':country_id',$country_id);
	$sth->bindParam(':password',$password);
	$sth->bindParam(':registration_date',$registration_date);
	$sth->execute();
	
    if($sth)
	{
		echo  '<div> user  ' . $updateid .' updated'.'</div>';
	}
}
?>




