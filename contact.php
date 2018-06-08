<html>
  	<head>
	 	<link rel = "stylesheet" href = "yoga.css" />
	  	<title>Path Of Light Yoga Studio</title>
  	</head> 
  	<body id = "wrapper">
	 	<div id = "div_main">
			<header>
				<h1>Path Of Light Yoga Studio</h1>
			</header>
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$connection = new PDO("mysql:host=$servername;dbname=light_yoga", $username, $password);

				$nameErr = $emailErr = $commentErr  = "";
				$name = $email = $comment = "";

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (empty($_POST["name"])) {
					$nameErr = "Name is required";
					} else {
						$nameValidity = test_input($_POST["name"]);
						if(preg_match("/^[a-zA-Z]/", $nameValidity)) {
							$name = $nameValidity;
							}
							else{
							$nameErr = "Incorrect Name";
							}
					}
					
					if (empty($_POST["email"])) {
					$emailErr = "Email is required";
					} else {
						$emailValidity = test_input($_POST["email"]);
						if(preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $emailValidity)) {
					      $email = $emailValidity;
						 }
						 else{
							 $emailErr = "Email not Valid";
						 }
						}	 
					
					if (empty($_POST["comment"])) {
					$commentErr = "Comment is required";
					} else {
					$comment = test_input($_POST["comment"]);
					}


					if($nameErr == "" && $emailErr == "" && $commentErr == "" ){
						// set the PDO error mode to exception
						$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						// prepare sql and bind parameters
						$stmt = $connection->prepare("INSERT INTO contact (name, email, comments)
						VALUES (:stu_name, :stu_email, :stu_comments)");
						$stmt->bindParam(':stu_name', $name);
						$stmt->bindParam(':stu_email', $email);
						$stmt->bindParam(':stu_comments', $comment);
						$stmt->execute();
						header("Location: successContact.php");
					}
				}

				function test_input($data) {
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				  }

				
			?>
			  
			<div id="content">
				<div id = "div1">
					<nav>
						<ul id ="list">	
						<li><a href='index.php'>Home</a></li>
						<li><a href='classes.php'>Classes</a></li>
						<li><a href='schedule.php'>Schedule</a></li>
						<li><a href='register.php'>Register</a></li>
						<li><a href='contact.php'>Contact</a></li>
						</ul>
					</nav>
				</div>
				<div id = "div6">
					<h2>Contact Path of Light Yoga Studio</h2>
					<P> Required information is marked with an asterisk (*).</P><br><br>
					<form name="contact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
						<div class="form-group">
							<div class="form-label">
								* Name:
							</div>
							<div class="form-input">
								<input type="text" name="name">
								<span class="error"> <?php echo $nameErr;?></span>
							</div>
						</div>
						<div class="form-group">
							<div class="form-label">
								* E-mail:
							</div>
							<div class="form-input">
								<input type="email" name="email">
								<span class="error"> <?php echo $emailErr;?></span>
							</div>
						</div>
						<div class="form-group">
							<div class="form-label">
								* Comments:
							</div>
							<div class="form-input">
								<textarea name="comment"></textarea>
								<span class="error"> <?php echo $commentErr;?></span>
							</div>
						</div>
						<div class="form-group">
							<div class="form-label">
									&nbsp;
							</div>
							<div class="form-input">
								<button type="submit">Send Now</button> 
							</div>
						</div>	
					</form> 
				</div>
			</div>
	  	  	 
         	<footer>
	  	 			Copyright &copy; 2016 Path of Light Yoga Studio<br>
	  	 			<a href='mailto:gokulkarthik@rajan.com'>gokulkarthik@rajan.com</a>
	  	 	</footer>
  	</body>
</html>
