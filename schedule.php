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
					<div id = "div5">
						<div id = "div5_top">
							<img id ='image3' src= "yogalounge.jpg"><br>
						</div>
						<div id ="div5_bottom"> 
							<h2>Yoga Schedule</h2>
							<font size = -1>
							<P> Mats, blocks, and blankets provided. Please arrive 10 minutes before your class begins. Relax in our Serenity Lounge before or after your class.</P>
			
							<h3>Monday - Friday</h3>
							<ul>
								<?php
									$servername = "localhost";
									$username = "root";
									$password = "";
									$connection = new PDO("mysql:host=$servername;dbname=light_yoga", $username, $password);

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
							</ul></font>
					</div> 
					
				</div>
			</div>
	  	 	 
      <footer>
	  	 	Copyright &copy; 2016 Path of Light Yoga Studio<br>
	  	 	<a href='mailto:gokulkarthik@rajan.com'>gokulkarthik@rajan.com</a>
	  	</footer>
  </body>
</html>
