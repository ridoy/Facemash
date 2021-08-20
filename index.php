<?php

$url = getenv('JAWSDB_URL');
echo $url;
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

$con=mysqli_connect($hostname, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Facemash</title>
		<link rel="stylesheet" href="style.css" />
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

	</head>

	<body>
		<div class="header">
			<h1>FACEMASH</h1>
		</div>

		<div class="main_wrapper">
			<p>
				<strong>CryptoPunks Hot or Not</strong>
			</p>
			<h3>Obviously not all punks are created equal. Which of these two punks is the best?*</h3>
			<?php

			do{
			$query1="SELECT * from photos ORDER BY rand() limit 1";
			$sql1=mysqli_query($con, $query1);
			$row1=mysqli_fetch_array($sql1, MYSQLI_ASSOC);

			$query2="SELECT * from photos ORDER BY rand() limit 1";
			$sql2=mysqli_query($con, $query2);
			$row2=mysqli_fetch_array($sql2, MYSQLI_ASSOC);
            }while ($row2['id']==$row1['id']) ;
			
			?>
			
				<div id="photoRandom">
					<a class="link1" href="vote.php?id1=<?php echo $row1['id'] ?>&amp;id2=<?php echo $row2['id'] ?>&amp;photo=first"><img class="image" src="images/<?php echo $row1['photo'] ?>" /></a>
					<p id="or">OR</p>
					<a class="link2"href="vote.php?id2=<?php echo $row2['id'] ?>&amp;id1=<?php echo $row1['id'] ?>&amp;photo=second"><img class="image" src="images/<?php echo $row2['photo'] ?>" /></a>
				</div>
		</div>
<br><br>
<center>
		<a href="ranking.php" class="rank" style="text-decoration:none;color:#000;font-size:25px;"><strong>Rankings</strong></a>
</center>
	</body>
    <script>
    </script>

</htmL>
