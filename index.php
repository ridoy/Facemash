<?php

$url = getenv('JAWSDB_URL');
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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-65102306-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-65102306-1');
    </script>

		<meta charset="utf-8" />
		<title>NFTRANK</title>
		<link rel="stylesheet" href="style.css" />
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
        <meta property="og:title" content="NFTRank" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="Vote on the coolest NFTs, destroy people's livelihoods" />
        <meta property="og:image" content="https://nftrank.herokuapp.com/main.png" />
        <meta property="twitter:title" content="NFTRank - vote on NFTs" />
        <meta property="twitter:description" content="Vote on the coolest NFTs, destroy people's livelihoods" />
        <meta property="twitter:image" content="https://nftrank.herokuapp.com/main.png" />

	</head>

	<body>
		<div class="header">
			<h1>NFTRank</h1>
		</div>

		<div class="main_wrapper">
            <div style="font-size: 20px">
                <a href="index.php">Vote on CryptoPunks</a>&nbsp;-&nbsp; 
                <a href="fidenza.php">Vote on Fidenza</a>
            </div>
            <h4>by <a href="http://twitter.com/mittendapper">@mittendapper</a></h4>
			<p>
				<strong>Obviously not all Punks are created equal. Which of these two is the best?*</strong>
			</p>
			<h3>Click to vote</h3>
			<?php

			do{
			$query1="SELECT * from photos ORDER BY rand() limit 1";
			$sql1=mysqli_query($con, $query1);
			$row1=mysqli_fetch_array($sql1, MYSQLI_ASSOC);

			$query2="SELECT * from photos ORDER BY rand() limit 1";
			$sql2=mysqli_query($con, $query2);
			$row2=mysqli_fetch_array($sql2, MYSQLI_ASSOC);
            }while ($row2['id']==$row1['id']) ;
			
            $txct = "select count(1) as total from transactions where tbl='photos'";
			$txsql=mysqli_query($con, $txct);
			$txrow=mysqli_fetch_array($txsql, MYSQLI_ASSOC);
            echo ($txrow['total'] + 150). " votes have been made so far.<br/><br/>";
			?>
			
				<div id="photoRandom">
					<a class="link1" href="vote.php?table=photos&id1=<?php echo $row1['id'] ?>&amp;id2=<?php echo $row2['id'] ?>&amp;photo=first"><img class="image" src="images/<?php echo $row1['photo'] ?>" /></a>
					<p id="or">OR</p>
					<a class="link2"href="vote.php?table=photos&id2=<?php echo $row2['id'] ?>&amp;id1=<?php echo $row1['id'] ?>&amp;photo=second"><img class="image" src="images/<?php echo $row2['photo'] ?>" /></a>
				</div>
			<h4>* what constitutes "best" is up to you</h4>
		</div>
<br><br>
<center>
        <h1 class="rank" style="text-decoration:none;color:#000;font-size:25px;"><strong>LEADERBOARD: Top 50</strong></h1>
		<a href="ranking.php" class="rank" style="font-size:22px;"><strong>All Ratings</strong></a>
</center>

    <center>
    <?php
	$i=1;
	$query="Select * from photos  order by rating desc limit 50";
	$sql=mysqli_query($con, $query);
    if ($con->connect_error) {
        echo "Error";
    }
	while($row=mysqli_fetch_array($sql, MYSQLI_ASSOC))
	{	
		echo '<div id="photoRandom-small"><img class="image" src="images/'.$row['photo'].'"></br>';
		echo "RANK : <b>".$i."</b><br>";
		echo "Current rating : <b>".$row['rating']."</b><br>";
        echo "<a href='https://www.larvalabs.com/cryptopunks/details/".$row['id']."'>About Punk # ".$row['id']."</a></div>";
		$i++;
	}

?>
</center>
	</body>
    <script>
    </script>

</htmL>
