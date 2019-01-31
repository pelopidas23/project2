<?php
	if($_POST['update_submit']){
		
		$user_id = $_GET['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$countryid = $_POST['country_id'];
		$status = $_POST['status'];
		$isadmin = $_POST['is_admin'];
		

		
		//Instantiate Database object
		$database = new Database;
		$enc_password = md5($password);
		$database->query('UPDATE users SET firstname = :firstname,lastname = :lastname,email = :email,username = :username,password = :password,address = :address,country_id = :country_id,status = :status,is_admin = :is_admin WHERE id = :id');
		
		
		
			$database->bind(':firstname', $firstname);  
			$database->bind(':lastname', $lastname);   
			$database->bind(':email', $email);  
			$database->bind(':username', $username);  
			$database->bind(':password', $enc_password);  
		    $database->bind(':address', $address);  
			$database->bind(':country_id', $countryid);  
			$database->bind(':id',$user_id);
			$database->bind(':status', $status);  
			$database->bind(':is_admin', $isadmin);  
		
		$database->execute();
		if($database->rowCount()){
			echo '<p class="msg">users are updated</p>';
		}
	}
?>

<?php
$user_id = $_GET['id'];

//Instantiate Database object
$database = new Database;
//Query
$database->query('SELECT * FROM users WHERE id = :id');
$database->bind(':id',$user_id);
$row = $database->single();
?>

<h1>Edit users</h1>



<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
 				<label>First Name: </label>
				<input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" /><br />
                <label>Last Name: </label>
                <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" /><br />
                <label>Email: </label>
				<input type="text" name="email" value="<?php echo $row['email']; ?>" /><br />
                <label>Username: </label>
                <input type="text" name="username" value="<?php echo $row['username']; ?>" /><br />
			   <label>Password: </label>
               <input type="password" name="password" value="<?php if($_POST['password'])echo $_POST['password'] ?>" /><br />
           
				  <label>address: </label>
				<input type="text" name="address" value="<?php echo $row['address']; ?>" /><br />
                <label>countryid: </label>
				<input type="text" name="country_id" value="<?php echo $row['country_id']; ?>" /><br />
				 <label>status: </label>
                <input type="text" name="status" value="<?php echo $row['status'] ?>" /><br />
                <label>isadmin: </label>
                <input type="text" name="is_admin" value="<?php echo $row['is_admin'] ?>" /><br />
				
                <br />
                <input type="submit" value="Update user" name="update_submit" />
             
          </form>
		  