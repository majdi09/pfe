<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UI Profile Card with CSS</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/app.css" />
</head>
<body>

<?php
    require "main.php";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pfe";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);
    mysqli_query($conn,"SET CHARACTER SET 'utf8'");
    mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
	error_reporting(E_PARSE | E_ERROR);
	if (isset($_SESSION['token'])) {
	  try {
          
          $res = $fb->get('/me/accounts?fields=fan_count,name,id,access_token,about,category,picture,rating_count', $_SESSION['token']);
          $res = $res->getDecodedBody();
        ;
          $response = $fb->get("/me?fields=id, first_name, last_name, email, picture",  $_SESSION['token']);
          $userData = $response->getGraphNode()->asArray();

   $userid=$userData['id'];
   $userfirst=$userData['first_name'];
   $userlastname=$userData['last_name'];
   $useremail=$userData['email'];
   $userpicture=$userData['picture']['url'];


   $sql10="insert into `webmaster` (`id_m`, `email`, `nom`, `prenom`, `image`)  values ('{$userid}','{$useremail}','{$userfirst}','{$userlastname}','{$userpicture}') ON DUPLICATE KEY UPDATE  email = '$useremail'  , nom = '$userfirst' , prenom = '$userlastname' , image = '$userpicture'" ;
   if ($conn->query($sql10) === TRUE) {
       
   }else {
       echo "Error: " . $sql10 . "<br>" . $conn->error;
       
   }

       
       foreach($res['data'] as $page){
						$im=$page['picture']['data']['url'];

					
		

        ?>
    

    <div class="card">
        <div class="card-header">
            <img src="<?= $im?>" alt="Profile Image" class="profile-img">
        </div>
        <div class="card-body">
            <p class="full-name"> <a href ="page.php?id=<?php echo $page['id'];?>" > <?php echo $page['name'];?></a></p>
            <p class="username"><?php echo $page['category'] ;?></p>

            <p class="desc"><?php echo $page['about'] ;?></p>
            <p>
                <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
            
            </p>
        </div>
        <div class="card-footer">
            <div class="col vr">
                <p><span class="count"> <?php echo $page['fan_count'] ;?> </span> Abonnés</p>
            </div>
            <div class="col">
								<p><span class="count"><?php
								if($page['rating_count']==null){
									echo'0';
								}
								else
								{
								echo $page['rating_count'];}?></span> Rating </p>
					
					</div>
        </div>
    </div>

			 
			 
			 
			 
			  <?php
          
					}
	  } catch( Facebook\Exceptions\FacebookSDKException $e ) {
	    echo $e->getMessage();
	    exit;
	  }
	}
	else{
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email', 'user_posts', 'manage_pages'];
		$callback    = 'http://localhost/site/examples/app.php';
		$loginUrl    = $helper->getLoginUrl($callback, $permissions);
		echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
	}
?>
</body>
</html>