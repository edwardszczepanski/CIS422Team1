<?php

//if($_POST)
//{
  
	include('connectionData.txt');
   
	$mysqli = new mysqli($server, $user, $pass, $dbname, $port)
	or die('Error connecting');
?>

<html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" href="./assets/favicon.jpg">
     <title>PeelPages</title>
         <link href="./css/bootstrap.min.css" rel="stylesheet">
         <link rel="stylesheet" href="css/styles.css"> 
         <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
         <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
         <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 </head>

 <body>
 <?php
	$username=$_POST['username'];
    $password=$_POST['password'];
	
	if(isset($username) && isset($password) && !empty($username) && !empty($password))
	{
		
		echo "SELECT * FROM peelPages.auth WHERE username ='".$username."' AND password='".$password."';</br>";
		echo "SELECT COUNT(*) FROM peelPages.auth WHERE username ='".$username."' AND password='".$password."';</br>";
		//$stmt = $mysqli -> prepare("SELECT COUNT(*) FROM peelPages.auth WHERE username ='".$username."' AND password=".$password."';");
		//$stmt = $mysqli -> prepare("SELECT COUNT(*) FROM peelPages.auth WHERE username ='"."han"."' AND password="."han"."';");
		echo "nidaye</br>";
		$stmt = $mysqli -> prepare("SELECT * FROM auth WHERE username ='$username' AND password = '$password';");

		$stmt->execute();
		echo "1nidaye</br>";

		$userID=null;
		//$username1=null;
		//$password1=null;
		$stmt->bind_result($userID,$username1,$password1);
		echo "caonima</br>";
		//$stmt->bind_result($userID);
		$stmt->store_result();

		printf("Number of rows: %d.\n", $stmt->num_rows);

		while($stmt->fetch())printf('%s,%s,%s',$userID,$username1,$password1);	
		//while($stmt->fetch())
			//		printf('<h1>%s</h1>',$userID);	
		if($stmt->num_rows==1)
		{
			session_start();
			$_SESSION['auth']='true';
			header('location:index.php');
		}
		else{
			echo "Wrong username or password...";
		}
	}
	
/*	if($stmt->rowCount()==1)
    {
        session_start();
        $_SESSION['auth']='true';
        header('location:index.php');
    }
	*/
	/*
	echo $conn."<br>";
	$username=$_POST['username'];
    $password=$_POST['password'];
    $sUser=mysqli_real_escape_string($conn,$username);
    $sPass=mysqli_real_escape_string($conn,$password);
    // For Security 
    $query="SELECT * From peelPages.auth where username='$sUser' and password='$sPass'";
        echo $query;

	$result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1)
    {
        session_start();
        $_SESSION['auth']='true';
        header('location:index.php');
    }*/
//}

?>

<form method="POST">
Username:<br>
    <input type="text" name="username"><br>
    Password:<br>
    <input type="password" name="password"><br>
    <input type="submit">

</form>

 </body>
</html>