<?php
//Start Session
session_start();
//Config File
require 'config.php';
//Database Class
require 'classes/databases.php';

$database = new Database;

//Set Timezone
date_default_timezone_set('America/New_York');
?>



<?php
  //LOG IN
  if($_POST['login_submit']){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $enc_password = md5($password);
    //Query
    $database->query("SELECT * FROM users WHERE username = :username AND password = :password");
    $database->bind(':username',$username);
    $database->bind(':password',$enc_password);
    $rows = $database->resultset();
    $count = count($rows);
    if($count > 0){
      session_start();
      //Assign session variables
      $_SESSION['username']   = $username;
      $_SESSION['password']   = $password;
      $_SESSION['logged_in']  = 1;
	  }


	else {
      $login_msg[] = 'Sorry, that login does not work';
    }
  }


  //LOG OUT
  if($_POST['logout_submit']){
    if(isset($_SESSION['username']))
        unset($_SESSION['username']);
    if(isset($_SESSION['password']))
        unset($_SESSION['password']);
    if(isset($_SESSION['logged_in']))
        unset($_SESSION['logged_in']);
    session_destroy();
  }
?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="index.php"><title>Warehouse</title></a>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<script src="js/site.js"></script>

 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#">Warehouse</a>
          <div class="nav-collapse collapse">
		  
            <p class="navbar-text pull-right">
			
              <?php if($_SESSION['logged_in']) : ?>
                Hello, <?php echo $_SESSION['username']; ?>
            <?php endif; ?>
			
			
			
            </p>
			
            <ul class="nav">
              <?php if(!$_SESSION['logged_in']) : ?>
                  <li><a href="index.php?page=register">Register</a></li>
              <?php else : ?>
                  <li><a href="index.php?page=welcome">Welcome</a></li>
                
              <?php endif; ?>    
            </ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
          <div style="margin:0 0 10px 10px;">

          <h3>Login Form</h3>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
              <?php if(!$_SESSION['logged_in']) : ?>
                <?php foreach($login_msg as $msg) : ?>
                    <?php echo $msg.'<br />'; ?>
                <?php endforeach; ?>
                <label>Username: </label><br />
                <input type="text" name="username" /><br />
                <label>Password: </label><br />
                <input type="password" name="password" /><br />
                <br />
                <input type="submit" value="Login" name="login_submit" />
              <?php else : ?>
                <input type="submit" value="Logout" name="logout_submit" />
              <?php endif; ?>
          </form>
          </div>
          </div><!--/.well -->
        </div><!--/span-->

        <div class="span9">
    <?php
    if($_GET['msg'] == 'listdeleted'){
      echo '<p class="msg">Your list has been deleted</p>';
    }
	if(isset($_GET['page'])) {
		
		$page = $_GET['page'];
		var_dump($page);
		include 'pages/'.$page.'.php';
	}
    ?>
			
        </div><!--/span-->
		</div><!--/row-->
      <hr>

      <footer>
        <p>&copy; warehouse 2019</p>
      </footer>
    </div><!--/.fluid-container-->
</body>
</html>

