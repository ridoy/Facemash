<?php
$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

$con=mysqli_connect($hostname, $username, $password, $database);

$winner=$_GET['photo'];
$id1=$_GET['id1'];
$id2=$_GET['id2'];

$query1="SELECT * from photos where id=".$id1;
$sql1=mysqli_query($con, $query1);
$row1=mysqli_fetch_array($sql1, MYSQLI_ASSOC);

$query2="SELECT * from photos where id=".$id2;
$sql2=mysqli_query($con, $query1);
$row2=mysqli_fetch_array($sql2, MYSQLI_ASSOC);


$rA=$row1['rating'];
$rB=$row2['rating'];

$exA=1/(1+pow(10,(($rB-$rA)/400)));
$exB=1/(1+pow(10,(($rA-$rB)/400)));

$tx_query="INSERT INTO transactions (punk1, punk2, winner, punk1rating, punk2rating) values (".$id1.",".$id2.",".$winner.",".$rA.",".$rB.")";
echo $tx_query;
$tx=mysqli_query($con, $tx_query);
echo $tx->error;

if($winner=="first"){
    $k1=$row1['k'];
    $rA=$rA + $k1*(1-$exA);

    if($rA>=0){
        $sql = "UPDATE photos SET rating=".$rA."WHERE id=".$id1;
    }
    else{
        $sql = "UPDATE photos SET rating=0 WHERE id=".$id1;
    }


    mysqli_query($con,$sql);
    if($rA>225){
        $sql = "UPDATE photos SET k=10 WHERE id=".$id1;
        mysqli_query($con,$sql);
    }
    elseif($rA<=75){
        $sql = "UPDATE photos SET k=25 WHERE id=".$id1;
        mysqli_query($con,$sql);
    }
    else{
        $sql = "UPDATE photos SET k=15 WHERE id=".$id1;
        mysqli_query($con,$sql);
    }



    $k2=$row2['k'];
    $rB=$rB + $k2*(0-$exA);

    if($rA>=0){
        $sql = "UPDATE photos SET rating=".$rB."WHERE id=".$id2;
    }
    else{
        $sql = "UPDATE photos SET rating=0 WHERE id=".$id2;
    }

    mysqli_query($con,$sql);

    if($rB>225){
        $sql = "UPDATE photos SET k=10 WHERE id=".$id2;
        mysqli_query($con,$sql);
    }
    elseif($rB<=75){
        $sql = "UPDATE photos SET k=25 WHERE id=".$id2;
        mysqli_query($con,$sql);
    }
    else{
        $sql = "UPDATE photos SET k=15 WHERE id=".$id2;
        mysqli_query($con,$sql);
    }


}

elseif($winner=="second"){
    $k1=$row1['k'];
    $rA=$rA + $k1*(0-$exA);

    if($rA>=0){
        $sql = "UPDATE photos SET rating=".$rA."WHERE id=".$id1;
    }
    else{
        $sql = "UPDATE photos SET rating=0 WHERE id=".$id1;
    }

    mysqli_query($con,$sql);

    if($rA>225){
        $sql = "UPDATE photos SET k=10 WHERE id=".$id1;
    mysqli_query($con,$sql);
    }
    elseif($rA<=75){
        $sql = "UPDATE photos SET k=25 WHERE id=".$id1;
    mysqli_query($con,$sql);
    }
    else{
        $sql = "UPDATE photos SET k=15 WHERE id=".$id1;
    mysqli_query($con,$sql);
    }


    $k2=$row2['k'];
    $rB=$rB + $k2*(1-$exA);

    if($rA>=0){
        $sql = "UPDATE photos SET rating=".$rB."WHERE id=".$id2;
    }
    else{
        $sql = "UPDATE photos SET rating=0 WHERE id=".$id2;
    }

    mysqli_query($con,$sql);

    if($rB>225){
        $sql = "UPDATE photos SET k=10 WHERE id=".$id2;
    mysqli_query($con,$sql);
    }
    elseif($rB<=75){
        $sql = "UPDATE photos SET k=25 WHERE id=".$id2;
    mysqli_query($con,$sql);
    }
    else{
        $sql = "UPDATE photos SET k=15 WHERE id=".$id2;
    mysqli_query($con,$sql);
    }



}

#header('Location: index.php');



?>
