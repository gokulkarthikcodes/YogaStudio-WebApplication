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

			$nameErr = $emailErr = $phoneErr = $addressErr = $passwordErr = "";
			$name = $email = $phone = $address = $password =  "";
			$showTimings = false;

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["name"])) {
				  $nameErr = "Name is required";
				} else {
					$nameValidity = test_input($_POST["name"]);
					if(preg_match("/^[a-zA-Z]/", $nameValidity)) {
						// $phone is valid
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
				if (empty($_POST["password"])) {
					$passwordErr = "Password is required";
				  } else {
					$passwordValidity = test_input($_POST["password"]);
					if(preg_match("/(?=.{8,})/", $passwordValidity)) {
					$password = $passwordValidity;
					}
					else{
						$passwordErr = "Not a Valid Password";
					}
				}	
				if (empty($_POST["phone"])) {
				  $phoneErr = "Phone is required";
				} else {
				  $phoneValidity = test_input($_POST["phone"]);
				  if(preg_match("/^[1-9]{1}[0-9]{9}$/", $phoneValidity)) {
					// $phone is valid
					$phone = $phoneValidity;
				  }
				  else{
					$phoneErr = "Incorrect phone number";
				  }
				}
			  
				if (empty($_POST["address"])) {
				  $addressErr = "Address is required";
				} else {
				  $address = test_input($_POST["address"]);
				}

				//validate the schedule class, day and time
				if($_POST["classInput"] && $_POST["daysInput"] && $_POST["timeInput"]){
					$classId = 	$_POST["classInput"];
					$daysId = $_POST["daysInput"];
					$timeId =  $_POST["timeInput"];
					$sql = 'SELECT * FROM schedule where classId in( '. $classId. ') AND daysId in ( '.$daysId.' ) AND timeId in ( '.$timeId.')';
					$statement = $connection->prepare($sql);
					$statement->execute();
					$result = $statement->fetchAll();

					if($result && $statement->rowCount() > 0) {
						$showTimings = false;
						if($nameErr == "" && $emailErr == "" && $phoneErr == "" && $addressErr == "" && $passwordErr == ""){
							// $sql = "INSERT INTO client (name, address, phone, email, password) VALUES ( $name, $address, $phone, $email, '')";
							// $sth = $connection->query($sql);
							// echo "Registered successfully";
		
							// set the PDO error mode to exception
							$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
							// prepare sql and bind parameters
							$stmt = $connection->prepare("INSERT INTO client (name, address, phone, email, password)
							VALUES (:stu_name, :stu_address, :stu_phone, :stu_email, :stu_password)");
							$stmt->bindParam(':stu_name', $name);
							$stmt->bindParam(':stu_email', $email);
							$stmt->bindParam(':stu_phone', $phone);
							$stmt->bindParam(':stu_address', $address);
							$stmt->bindParam(':stu_password', $password);
							$stmt->execute();
							$lastClientId = $connection->lastInsertId(); 
		
							$stmt = $connection->prepare("INSERT INTO client_schedule (clientid, timeid, classid, daysid)
							VALUES (:stu_clientId, :stu_timeid, :stu_classid, :stu_daysid)");
							$stmt->bindParam(':stu_clientId', $lastClientId);
							$stmt->bindParam(':stu_timeid', $timeId);
							$stmt->bindParam(':stu_classid', $classId);
							$stmt->bindParam(':stu_daysid', $daysId);
							$stmt->execute();
		
							echo "Registered successfully";
							header("Location: successRegister.php");
						}
					}
					else{
						$showTimings = true;
					}
				}
			  }

			  function isValidEmail($email){ 
				return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
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
			<div id = "div4">
				<?php
					if($GLOBALS['showTimings'] == true){
				?>		
				<h2>Note: </h2>
				<h3>Monday - Friday</h3>
						<ul>
							<?php
								$sql = 'SELECT * FROM schedule S,time T, class C, days D WHERE T.timeid = S.timeid AND C.classid = S.classid AND D.daysid = S.daysid AND D.daysname in ("Monday") ORDER BY T.time';
								$statement = $connection->prepare($sql);
								$statement->execute();
								$result = $statement->fetchAll();
								
								foreach ($result as $row) {
							?>	
								<li><?php echo date('h:i a', strtotime( $row['time']));?> <?php echo $row['classname'];?> </li>
							<?php
								}
							?>	
						</ul>
						<h3>Saturday & Sunday</h3>
						<ul>
							<?php
								$sql = 'SELECT * FROM schedule S,time T, class C, days D WHERE T.timeid = S.timeid AND C.classid = S.classid AND D.daysid = S.daysid AND D.daysname in ("Sunday") ORDER BY T.time';
								$statement = $connection->prepare($sql);
								$statement->execute();
								$result = $statement->fetchAll();
								
								foreach ($result as $row) {
							?>
								<li><?php echo date('h:i a', strtotime( $row['time']));?> <?php echo $row['classname'];?> </li>
							<?php
								}
							?>	
						</ul>
				<?php
					}
				?>
				<h2>Register Path of Light Yoga Studio</h2>
				<P> Required information is marked with an asterisk (*).</P><br><br>
				<form name="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
							<input type="text" name="email">
							<span class="error"> <?php echo $emailErr;?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label">
							* Password:
						</div>
						<div class="form-input">
							<input type="password" name="password"> (Minimum 8 Characters)
							<span class="error"> <?php echo $passwordErr;?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label">
							* Phone:
						</div>
						<div class="form-input">
							<input type="number" name="phone" > (No special Characters)
							<span class="error"> <?php echo $phoneErr;?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label">
							* Address:
						</div>
						<div class="form-input">
							<textarea name="address"></textarea>
							<span class="error"> <?php echo $addressErr;?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label">
							* Type Of Class: 
						</div>
						<div class="form-input">
								<select name="classInput">
									<?php
										$sql = "SELECT * from class";
										$statement = $connection->prepare($sql);
										$statement->execute();
										$result = $statement->fetchAll();
										
										foreach ($result as $row) {
									?>
										<option value="<?php echo $row['classid'];?>"><?php echo $row['classname'];?></option>
									<?php
										}
									?>
								</select>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label">
							* Schedule Day:
						</div>
						<div class="form-input">
							<select name="daysInput">
							<?php
							$sql = "SELECT * from days";
							$statement = $connection->prepare($sql);
							$statement->execute();
							$result = $statement->fetchAll();
							
							foreach ($result as $row) {
						?>
							<option value="<?php echo $row['daysid'];?>"><?php echo $row['daysname'];?></option>
						<?php
							}
						?>
							</select>
						</div>
					</div>	
					<div class="form-group">
						<div class="form-label">
							* Schedule Time:
						</div>
						<div class="form-input">
							<select name="timeInput">
							<?php
							$sql = "SELECT * from time order by time";
							$statement = $connection->prepare($sql);
							$statement->execute();
							$result = $statement->fetchAll();
							
							foreach ($result as $row) {
						?>
							<option value="<?php echo $row['timeid'];?>"><?php echo date('h:i a', strtotime( $row['time']));?></option>
						<?php
							}
						?>
							</select>
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
	  	
    </div>
	<footer>
		Copyright &copy; 2016 Path of Light Yoga Studio<br>
		<a href='mailto:gokulkarthik@rajan.com'>gokulkarthik@rajan.com</a>
	</footer>
  	</body>
</html>
