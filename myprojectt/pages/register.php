<?php if($_POST['register_submit']){

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$address = $_POST['address'];
		$countryid = $_POST['country_id'];
		
		$errors = array();

        


		//Check passwords match
		if($password != $password2){
			$errors[] = "Your passwords do not match";
		} 
		//Check first name
		if(empty($firstname)){
			$errors[] = "First Name is Required";
		} 
		//Check email
		if(empty($email)){
			$errors[] = "Email is Required";
		} 
		//Check username
		if(empty($username)){
			$errors[] = "Username is Required";
		} 
		//Match passwords
		if(empty($password)){
			$errors[] = "Password is Required";
		} 


		//Instantiate Database object
		$database = new Database;

		/* Check to see if username has been used */

		//Query
		$database->query('SELECT username FROM users WHERE username = :username');
		$database->bind(':username', $username);  
		//Execute
		$database->execute();
		if($database->rowCount() > 0){
			$errors[] = "Sorry, that username is taken";
		}

		/* Check to see if email has been used */

		//Query
		$database->query('SELECT email FROM users WHERE email = :email');
		$database->bind(':email', $email);  
		//Execute
		$database->execute();
		if($database->rowCount() > 0){
			$errors[] = "Sorry, that email is taken";
		}
//var_dump($errors);
//die();
		//If there are no errors, proceed with registration
		
		if(empty($errors))
		{
			//Encrypt Password
			$enc_password = md5($password);

			//Query
			
		/*echo $firstname;
		echo $lastname ;
		echo $email;
		echo $username ;
		echo $password ;
		echo $password2 ;
		echo $address ;
		echo $countryid ;*/
						 
			$database->query('INSERT INTO users (firstname,lastname,email,username,password,address,country_id)
			              VALUES(:firstname,:lastname,:email,:username,:password,:address,:country_id)');			 
						 
			//Bind Values
			$database->bind(':firstname', $firstname);  
			$database->bind(':lastname', $lastname);   
			$database->bind(':email', $email);  
			$database->bind(':username', $username);  
			$database->bind(':password', $enc_password);  
		    $database->bind(':address', $address);  
			$database->bind(':country_id', $countryid);  
			//Execute
			$database->execute();
            //$database->debugDumpParams();
			//If row was inserted
			if($database->lastInsertId()){
				echo '<p class="msg">You are now registered! Please Log In</p>';
			} else {
				echo '<p class="error">Sorry, something went wrong. Contact the site admin</p>';
			}
		}
		
		
}
?>

<h3>Register</h3>
<p>Please use the form below to register at our site</p>
<?php
if(!empty($errors)){
	echo "<ul>";
 	foreach($errors as $error){
		echo "<li class=\"error\">".$error."</li>";
	}
	echo "</ul>";
}
?>
 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
 				<label>First Name: </label>
                <input type="text" name="firstname" value="<?php if($_POST['firstname'])echo $_POST['firstname'] ?>" /><br />
                <label>Last Name: </label>
                <input type="text" name="lastname" value="<?php if($_POST['lastname'])echo $_POST['lastname'] ?>" /><br />
 
                <label>Email: </label>
                <input type="text" name="email" value="<?php if($_POST['email'])echo $_POST['email'] ?>" /><br />
                <label>Username: </label>
                <input type="text" name="username" value="<?php if($_POST['username'])echo $_POST['username'] ?>" /><br />
                <label>Password: </label>
                <input type="password" name="password" value="<?php if($_POST['password'])echo $_POST['password'] ?>"/><br />
                 <label>Confirm Password: </label>
                <input type="password2" name="password2" value="<?php if($_POST['password2'])echo $_POST['password2'] ?>" /><br />
				
				  <label>address: </label>
                <input type="text" name="address" value="<?php if($_POST['address'])echo $_POST['address'] ?>" /><br />
                <label>countryid: </label>
                <input type="text" name="country_id" value="<?php if($_POST['country_id'])echo $_POST['country_id'] ?>" /><br />
                <br />
                <input type="submit" value="Register" name="register_submit" />
             
          </form>
		  
		  
		  
		  
		  