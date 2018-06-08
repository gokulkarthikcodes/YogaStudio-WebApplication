<html>
	<head>
	  	<title>Path Of Light Yoga Studio</title>
	  	<link rel = "stylesheet" href = "yoga.css" />
	 </head>
	 <body id = "wrapper">
	  	<div id = "div_main">
			<header><h1>Path Of Light Yoga Studio</h1></header>
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
					<div id = "div4_top">
						<img src = "yogamat.jpg" id = "image2">
					</div>
					<div id = "div4_bottom">
					<h2>Yoga Classes</h2>
					<p>
					<font size="-1">
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$connection = new PDO("mysql:host=$servername;dbname=light_yoga", $username, $password);

						$sql = "SELECT * FROM class ";
						$statement = $connection->prepare($sql);
						$statement->execute();
						$result = $statement->fetchAll();
						if ($result && $statement->rowCount() <= 0) {
							echo "No data found";
						}
						foreach ($result as $row) {
					?>	
							<B><?php echo $row['classname']; ?></B>
								<span style="padding-left: 30px; display:block"><?php echo $row['description']; ?></span>
					<?php
						}
					?>
					</p>
					</font>
					</div>
				</div>  
			</div>          
        	<footer>
             	<small><I>Copyright &copy; 2016 Path of Light Yoga Studio</I><br>
	  	     	<a href='mailto:gokulkarthik@rajan.com'>gokulkarthik@rajan.com</a></small>
	  		</footer>
	  	</div>	 	
	</body>
</html>
