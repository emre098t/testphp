<?php
$host = "localhost";
  include ('config.php');

function fix($veri)
{
$veri =str_replace("`","",$veri);
$veri =str_replace("=","",$veri);
$veri =str_replace("&","",$veri);
$veri =str_replace("%","",$veri);
$veri =str_replace("!","",$veri);
$veri =str_replace("#","",$veri);
$veri =str_replace("<","",$veri);
$veri =str_replace(">","",$veri);
$veri =str_replace("*","",$veri);
$veri =str_replace("And","",$veri);
$veri =str_replace("'","",$veri);
$veri =str_replace("chr(34)","",$veri);
$veri =str_replace("chr(39)","",$veri);
return $veri;
}


$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);
if(isset($_POST['submit'])&&!empty($_POST['submit'])&&!empty($_POST['name'])&&!empty($_POST['pwd'])){
    
	$sqlc = "select from hops.users where user_name='".fix($_POST['name'])."' ";
	$srg = pg_query($dbconn, $sqlc);

$check = pg_num_rows($srg);
    if($check > 0){ 
		

	echo "Böyle bir oyuncumuz zaten var ! ";
	
	
	}else{
		
		     $has = hash('SHA256',fix($_POST['pwd']));
			 $hash = mb_strtoupper($has,"UTF-8");
			
		      $sql = "insert into hops.users(user_name,mail,password,user_type)values('". fix($_POST['name']) ."','". fix($_POST['email']) ."','". fix($hash) ."','1')";
    $ret = pg_query($dbconn, $sql);
    if($ret){
        
            echo "Başarıyla Kayıt oldun.";
    }else{
        
            echo "Hata oluştu :(";
    }
		
	
	}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> kayıt </title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2> Kayıt </h2>
  <form method="post">
  
    <div class="form-group">
      <label for="name">ID:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter ID" name="name" requuired>
    </div>
    
	<div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
	
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    
    

     
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>

</body>
</html>