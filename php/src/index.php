<?php
    //These are the defined authentication environment in the db service

    // The MySQL service named in the docker-compose.yml.
    $host = 'db';

    $user = 'MYSQL_USER'; //Database username
    $pass = 'MYSQL_PASSWORD'; //Database user password
    $mydatabase = 'MYSQL_DATABASE'; // Database name
    
    // check the mysql connection status
    $conn = new mysqli($host, $user, $pass, $mydatabase);

    // select query
    $sql = 'SELECT * FROM users';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $myusername = mysqli_real_escape_string($conn,$_POST['name']);
        $mypassword = mysqli_real_escape_string($conn,$_POST['pass']); 

        $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($result);

        if($count == 1) {
            header("Location: welcome.php", false);
        }else {
            $error = "Your Login Name or Password is invalid";
            echo $error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login Form</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<div class="wrapper">
			<div class="form">
				<div class="title">
					Login
				</div>
				<form method="post" action="">
					<div class="input_wrap">
						<label for="input_text">Username</label>
						<div class="input_field">
							<input type="text" name="name" class="input" id="input_text">
						</div>
					</div>
					<div class="input_wrap">
						<label for="input_password">Password</label>
						<div class="input_field">
							<input type="password" name="pass" class="input" id="input_password">
						</div>
					</div>
					<div class="input_wrap">
                        <input type="submit" class="login" name="login" value="Login">
						<span class="error_msg">Incorrect username or password. Please try again</span>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
