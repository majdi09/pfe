
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js?hcode=be5162d915534272a57d0bb781d27f2b"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js?hcode=be5162d915534272a57d0bb781d27f2b"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js?hcode=be5162d915534272a57d0bb781d27f2b"></script>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link href="https://cdn.anychart.com/playground-css/general-features/no-data-label-feature/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css?hcode=be5162d915534272a57d0bb781d27f2b" type="text/css" rel="stylesheet">
  <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css?hcode=be5162d915534272a57d0bb781d27f2b" type="text/css" rel="stylesheet">
  <style type="text/css">
html, body, #container {
    width: 80%;
    height: 80%;
    margin: 0;
    padding: 0;
}
</style>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="sb-admin.css" rel="stylesheet"/>
    

    <title>Document</title>
    <style>
.loader {
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    display: flexa;
    justify-content: center;
    align-items: center;
}

.loader > img {
    width: 100px;
}

.loader.hidden {
    animation: fadeOut 1s;
    animation-fill-mode: forwards;
}

@keyframes fadeOut {
    100% {
        opacity: 0;
        visibility: hidden;
    }
}

.thumb {
    height: 100px;
    border: 1px solid black;
    margin: 10px;
}
#loader {
  margin: 100px auto;
  width: 120px;
  height: 120px;
  border: 16px solid #f3f3f3;
  border-top: 16px solid #3498db;
  border-radius: 50%;
  animation: spin 2s linear infinite, heart-beat 2s linear infinite;
  background-color: #fff;
  text-align: center;
  line-height: 120px;
}


@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes heart-beat {
    55% { background-color: #fff; }
    60% { background-color: #3498db; }
    65% { background-color: #fff; }
    70% { background-color: #3498db; }
    100% { background-color: #fff; }
}

</style>
<script>
window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
</script>
</head>
<body>

<div class="loader">
<div id="loader"></div>
</div>
<?php
require "main.php";


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pfe";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$fb->setDefaultAccessToken($_SESSION['token']);




       
try {
    
   /* $id_p= $_POST['page'];*/
    $id_p = $_GET['id'];
  
echo $id_p;



    // Returns a `Facebook\FacebookResponse` object
    $responseUser = $fb->get($id_p .'/?fields=name,fan_count,link,new_like_count,about,category,displayed_message_response_time,overall_star_rating,access_token');
    $responseacc = $fb->get($id_p .'/?fields=access_token');
    $responseImage = $fb->get($id_p .'/picture?redirect=false&width=250&height=250');
   //$responsePost = $fb->get('/1216927311661994?fields=posts{message,created_time,link,likes.summary(total_count) ,comments.summary(total_count),shares}', $_SESSION['token']);
   // $responseMessage = $fb->get('/1216927311661994?fields=conversations{message_count},fan_count',$_SESSION['token']) ;


} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$user = $responseUser->getGraphUser();
$image = $responseImage->getGraphPage() ;
$access = $responseacc->getGraphPage() ;
$acc=$access['access_token'] ;


//$post= $responsePost->getGraphNode()->asArray();
//$like=$reponseLike->getGraphPage()->asArray();
$u=$user['name'] ;
$l=$user['link'];
$f=$user['fan_count'];
$FN=$user['new_like_count'] ;
$a=$user['about'] ;
$c=$user['category'] ;
$dis=$user['displayed_message_response_time'] ;
$ov=$user['overall_star_rating'] ;
$pic=$image['url'];


try {
    // le nombre des nouveau fans
$fanN = $fb->get($id_p.'/insights/page_fan_adds_unique',$acc);
$fan_New_N = $fanN->getGraphEdge()->asArray();
$FNM= $fan_New_N[2]['values'][0]['value'];
$FNW= $fan_New_N[1]['values'][0]['value'] ;
$FND= $fan_New_N[0]['values'][0]['value'] ;




$sql40 = "INSERT INTO test(id_p,nom,image,link,fan_count,new_like_count,about,category,displayed_message_response_time,overall_star_rating,Nb_N_Fan_Day,NB_N_Fan_Week,NB_N_Fan_Month)VALUES ('{$id_p}','{$u}', '{$pic}','{$l}' ,'{$f}','{$FN}','{$a}','{$c}','{$dis}','{$ov}','{$FND}', '{$FNW}','{$FNM}') ON DUPLICATE KEY UPDATE nom = '$u',fan_count='$f',new_like_count='$FN',about='$a',category='$c',displayed_message_response_time='$dis',overall_star_rating='$ov',Nb_N_Fan_Day='$FND',NB_N_Fan_Week='$FNW',NB_N_Fan_Month='$FNM'";
if ($conn->query($sql40) === TRUE) {
echo "New record created successfully";
} else {
echo "Error: " . $sql40 . "<br>" . $conn->error;
}
}catch(Facebook\Exceptions\FacebookResponseException $e) {
echo 'Graph returned an error: ' . $e->getMessage();
exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
echo 'Facebook SDK returned an error: ' . $e->getMessage();
exit;
}
/*if($user['overall_star_rating'] == '')
{
    echo"majdi";
}
*/
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


echo "<pre>" ;
//print_r($user);
//print_r($post) ;
//print_r($like);

function  callback($key, $value, $niveau) {
    // Même affichage qu'avec print_recursive()
    // echo str_repeat("&nbsp;", $niveau * 4).$key." => ".$value."<br/>";

    // Variante d'affichage
    if($niveau == 1) {
        echo "<tr style='background:#bbb'>";
        echo "<td>".$key."</td>";
        echo "<td>".$value."</td>";
        echo "</tr>";
    } else if($niveau == 2) {
        echo "<tr style='background:#ddd'>";
        echo "<td>".$key."</td>";
        echo "<td>".$value."</td>";
        echo "</tr>";
    } else if($niveau ==3 ) {
        echo "<tr style='background:#fff'>";
        echo "<td>".$key."</td>";
        echo "<td>".$value."</td>";
        echo "</tr>";
        }else {
        echo "<tr>";
        echo "<td>".$key."</td>";
        echo "<td>".$value."</td>";
        echo "</tr>";
    }
}

function print_recursive_callback($post = array(), $callback, $withKey = true, $niveau = 0) {
	// Supprime les clés private et protected s'il s'agit d'un objet
	if(is_object($post)) {
		$post = get_object_vars($post);
	}

	foreach($post as $key => $value) {
		if((is_array($value) || is_object($value))) {
			// Appel récursif de la fonction pour lire un autre niveau de profondeur
			if($withKey === true) {
				call_user_func($callback, $key, "", $niveau);
			}
			print_recursive_callback($value, $callback, $withKey, $niveau + 1);
			continue;
		}

		// Appel à la fonction de rappel avec quatre paramètres oblibatoires !!!
		if($withKey === true) {
			call_user_func($callback, $key, $value, $niveau);
		} else {
			call_user_func($callback, $key, $value, $niveau);
		}
	}
}

/*echo "<table style='background:#999'>";
print_recursive_callback($post, "callback");
echo "</table>";*/


?>




        <div>
            <center><h1> les postes de page</h1></center>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0%">
                            <thead>
                            <tr>
                                <th>Date de créaction </th>
                                <th>Image</th>
                                <th>Publication</th>
                                <th>Lien</th>
                                <th>jaime</th>
                                <th>commntaire</th>
                                <th>partage</th>
                                <th> LOVE</th>
                                <th>HAHA </th>
                                <th>Wow</th>
                                <th> SAD</th>
                                <th> angry</th>
                                <th>Reach</th>
                                <th> Clic</th>
                                <th>Lost Fan</th>
                            </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                            <?=print "<table";
                            

            $response = $fb->get($id_p .'/posts?fields=created_time,message,shares,link,picture,likes.summary(true)&limit=5,comments.summary(total_count),reactions.type(LOVE).summary(total_count)&limit=5,reactions.type(HAHA).summary(total_count)&limit=5,reactions.type(SAD).summary(total_count)&limit=5,reactions.type(ANGRY).summary(total_count)&limit=5,reactions.type(WOW).summary(total_count)&limit=5', $_SESSION['token']);
            $getPostID = $response->getGraphEdge()->asArray();
            foreach($getPostID as $IDKey){
                if(isset($IDKey['id'])){
                    $currentPostID = $IDKey['id'];
                    $currentPostMG = $IDKey['message'];
                    $currentPostLK = $IDKey['link'];
                    $photo= $IDKey['picture'];
                    $currentPostTime = $IDKey['created_time'];
                    $currentPostSh = $IDKey['shares'];

                    $date = $currentPostTime ;

                    $likesResponse = $fb->get('/'.$currentPostID.'/likes?limit=0&summary=true', $_SESSION['token']);
                    $CommResponse = $fb->get('/'.$currentPostID.'/comments?limit=0&summary=true', $_SESSION['token']);
                    //$SharesResponse = $fb->get('/'.$currentPostID.'/shares', $_SESSION['token']);
                    $LoveResponse = $fb->get('/'.$currentPostID.'/reactions?type(LOVE)?limit=0&summary=true', $_SESSION['token']);
                    $WowResponse = $fb->get('/'.$currentPostID.'/reactions?type(WOW)?limit=0&summary=true', $_SESSION['token']);
                    $HahAResponse = $fb->get('/'.$currentPostID.'/reactions?type(HAHA)?limit=0&summary=true', $_SESSION['token']);
                    $SADResponse = $fb->get('/'.$currentPostID.'/reactions?type(SAD)?limit=0&summary=true', $_SESSION['token']);
                    $angResponse = $fb->get('/'.$currentPostID.'/reactions?type(ANGRY)?limit=0&summary=true', $_SESSION['token']);
                    $InsResponse = $fb->get('/'.$currentPostID.'/insights/post_impressions',$acc);
                    $Click = $fb->get('/'.$currentPostID.'/insights/post_clicks',$acc);
                    $FeedBack = $fb->get('/'.$currentPostID.'/insights/post_negative_feedback',$acc);
                    $Love = $fb->get('/'.$currentPostID.'/insights/post_reactions_love_total',$acc);
                    $wow = $fb->get('/'.$currentPostID.'/insights/post_reactions_wow_total',$acc);
                    $HAHA = $fb->get('/'.$currentPostID.'/insights/post_reactions_haha_total',$acc);
                    $sorry = $fb->get('/'.$currentPostID.'/insights/post_reactions_sorry_total',$acc);
                    $anger = $fb->get('/'.$currentPostID.'/insights/post_reactions_anger_total',$acc);
                    $type = $fb->get('/'.$currentPostID.'/?fields=type', $_SESSION['token']);

                    $getLikeCount = $likesResponse->getGraphEdge();
                    $currentLikeCount = $getLikeCount->getTotalCount();

                    $getCOMMCount = $CommResponse->getGraphEdge();
                    $currentCOMMCount = $getCOMMCount->getTotalCount();

                  /*  $getSharesCount = $SharesResponse->getGraphEdge();
                    $currentSharesCount = $getSharesCount->getTotalCount();*/

                    $getLOVECount = $LoveResponse->getGraphEdge();
                    $currentLOVECount = $getLOVECount->getTotalCount();



                    $getWOWCount = $WowResponse->getGraphEdge();
                    $currentWOWCount = $getWOWCount->getTotalCount();


                    $getHAHACount = $HahAResponse->getGraphEdge();
                    $currentHAHACount = $getHAHACount->getTotalCount();


                    $getSADCount = $SADResponse->getGraphEdge();
                    $currentSADCount = $getSADCount->getTotalCount();

                    $getANGCount = $angResponse->getGraphEdge();
                    $currentANGCount = $getANGCount->getTotalCount();

                    $getINSCount=$InsResponse->getGraphEdge()->asArray();
                    $getClicCount=$Click->getGraphEdge()->asArray();
                    $getFeedCount=$FeedBack->getGraphEdge()->asArray();
                    $getLove=$Love->getGraphEdge()->asArray();
                    $getWow=$wow->getGraphEdge()->asArray();
                    $getHaHa=$HAHA->getGraphEdge()->asArray();
                    $getSoryy=$sorry->getGraphEdge()->asArray();
                    $getAngry=$anger->getGraphEdge()->asArray();

                    $getType = $type->getGraphPage();



                   // $getthisContents = file_get_contents($getINSCount);
                   // $jsonTopFBCount = json_decode($getthisContents,true);
                   // $jsonTopShares = $jsonTopFBCount[0]['value'];


/*
                    print '<b>'.('Le message ') .'<br>'.'<br>';
                    $currentPostMG . '<br>'; //optional

                    print('Le lien  ')  .'<br>';
                    echo  $currentPostLK . '<br>' ;
                    print('Limage ') .'<br>';
                    echo $photo . '<br>' ;
                    print('La date de créaction ') .'<br>';
                    echo $date->format('Y-m-d') . '<br>' ;


                    print (' le nombre de jaime') .'<br>';
                    echo   $currentLikeCount . '<br>';

                    print (' le nombre de COMMNTAIRE') .'<br>';
                    echo   $currentCOMMCount . '<br>'.'<br>';



                    print (' le nombre de love') .'<br>';
                    echo   $currentLOVECount . '<br>' ;

                    print (' le nombre de WOW') .'<br>';
                    echo   $currentWOWCount . '<br>' ;

                    print (' le nombre de HAHA') .'<br>';
                    echo   $currentHAHACount . '<br>' ;

                    print (' le nombre de SAD') .'<br>';
                    echo   $currentSADCount . '<br>' ;

                    print (' le nombre de ANG') .'<br>';
                    echo   $currentANGCount . '<br>' ;*/

                }
                $i=$currentPostID;
                $d=$date->format('Y-m-d') ;
                $p=$photo ;
                $m=$currentPostMG ;
                $l=$currentLikeCount ;
                $c=$currentCOMMCount ;
                $s=$currentPostSh['count'] ;
                $lo=$getLove[0]['values'][0]['value'] ;
                $h=$getHaHa[0]['values'][0]['value'] ;
                $w=$getWow[0]['values'][0]['value'] ;
                $so= $getSoryy[0]['values'][0]['value'] ;
                $An=$getAngry[0]['values'][0]['value'] ;
                $r= $getINSCount[0]['values'][0]['value'] ;
                $lost=$getFeedCount[0]['values'][0]['value'];
                $cli=$getClicCount[0]['values'][0]['value'] ;
                $ty=$getType['type'] ;


                $sql2 = ("INSERT INTO post(id_post, id_p, date, picture, post, likes, comments, sahres, love, haha, wow, sad, anger, reach, lostfan  ,clicks, type)VALUES ('{$currentPostID}','{$id_p}', '{$d}', '{$p}', '{$m}','{$l}','{$c}','{$s}','{$lo}','{$h}','{$w}','{$so}','{$An}','{$r}','{$lost}','{$cli}','{$ty}') ON DUPLICATE KEY UPDATE  `likes` = ".$l.", `love` = ".$lo.", `haha` = ".$h.", `wow` = ".$w.", `sad` = ".$so.", `anger` = ".$An.", `reach` = ".$r.", `lostfan` = ".$lost.", `clicks` = ".$cli."");
                if ($conn->query($sql2) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql2 . "<br>" . $conn->error;
                }

            }



            ?>



                            <tr>
                                <td><?=$date->format('Y-m-d')?></td>
                                <td> <img align="left" class="fb_img_profil" src="<?=$photo?>" alt="Profil image/"></h1> </td>
                                <td> <?=$currentPostMG?></td>
                                <td><a href="<?=$currentPostLK?>">Lien de Votre Publication</a></td>
                                <td> <?=$currentLikeCount?></td>
                                <td><?= $currentCOMMCount?></td>
                                <td><?=$currentPostSh['count']?></td>
                                <td><?= $getLove[0]['values'][0]['value']?></td>
                                <td><?= $getHaHa[0]['values'][0]['value']?></td>
                                <td><?= $getWow[0]['values'][0]['value']?></td>
                                <td> <?=$getSoryy[0]['values'][0]['value']?></td>
                                <td> <?=$getAngry[0]['values'][0]['value']?></td>
                                <td> <?=$getINSCount[0]['values'][0]['value']?></td>
                                <td><?=$getClicCount[0]['values'][0]['value'] ?></td>
                                <td><?=$getFeedCount[0]['values'][0]['value'] ?></td>


                            </tr>
                            </tbody>
                        </table>






                    </div>
                </div>
            </div>
            <?php
            
                                                  // calcul d'engagement

                       $con=mysqli_connect("localhost" , "root","","pfe") ;

                       $result= mysqli_query($con,"SELECT avg(likes) + avg(comments)+ avg(love) + avg(haha) + avg(sad) +avg(wow) + avg(anger) as engagement from post WHERE date = DATE(now()) ")

                       or die ("falied to query date base". mysqli_error());
                       $row = mysqli_fetch_array($result) ;
                       if ($row['engagement']=== null) {
                           echo " le taux d'engagement est NT" ;
                           echo'</br>';
                       }else {


                           $sql3 = mysqli_query($con, "select fan_count as fan_count from test");
                           $row1 = mysqli_fetch_array($sql3);

                           $engagement = $row['engagement'] / $row1['fan_count'];

                           echo " la date est " . $engagement;
                           echo'</br>';
                           
                       }
                       echo (" Croissance hebdomadaire de nombre de j'aime en % est " .$FNM/28 .  "%") ; echo"<br>" ;
                       echo (" le nombre de nouveaux fans par semaine ".$FNW) ; echo"<br>" ;
                       echo $FND ; echo "<br>"  ;
                       echo'</br>';
                       // le nombre des meesages récus à la page

            //1- Le nombre de Conversation
            $MSG = $fb->get($id_p .'/conversations?fields=message_count', $acc);
            $M = $MSG->getGraphEdge()->asArray();
            $parsed_json=$M ;
            $del="DELETE FROM Message ";
            if($conn->query($del)=== TRUE){
                echo "new record created successfly"; echo "<br>" ;
            }

            foreach ($parsed_json as $v => $value) {
                $sql5 = "INSERT INTO Message(id_p,NB_CONV)VALUES ('{$id_p}','{$value['message_count']}')";
                $conn->query($sql5) ;

            }
            //2- calcul niveau de service
            $sql6 = mysqli_query($con, "SELECT count(*) as NB_Message FROM message WHERE NB_CONV>=2")
            or die ("falied to query date base". mysqli_error());
            $sql7 = mysqli_query($con, "select count(*) as NB_Message_Totale from Message")
            or die ("falied to query date base". mysqli_error());
            $nb_message= mysqli_fetch_array($sql6) ;
            $nb_messageTotale=mysqli_fetch_array($sql7);
            $N1=$nb_message['NB_Message'];
            $N2=$nb_messageTotale['NB_Message_Totale'] ;
            $N_Service= round((($N1/$N2)* 100)) ;
            echo (" le niveau de service est :" .$N_Service) ;
            echo'</br>';
          

            // le nombre des fans ayant vu la pub sur facebook par Heureur



            $datetime = date("Y-m-d");
            echo $datetime;
            $date2= date('d-m-Y', strtotime($datetime.' - 28 DAY'));

            echo $date2 ;

            $Fan = $fb->get($id_p .'/insights?pretty=0&metric=page_fans_online&since='.$date2.'&until='.$datetime.' ', $acc);
            $F = $Fan->getGraphEdge()->asArray();
         /*   $F = json_decode($F, true);

            $F = array_chunk($json, 28);*/
           
         
            $Fan1=$F[0]['values'][0]['value'][0] ;
            $Fan2=$F[0]['values'][0]['value'][1];
            echo'<br>';
           echo($Fan1.'<br>')   ;
            echo($Fan2.'<br>')  ;
           
        
                
           
/*
            foreach ($F as $key => $val) {
                foreach ($val as $key1 => $val2) {
                    foreach ($val2 as $key2 => $val3) {

                        echo $val3;


                    }
                }

            }
            */

          /*  $json_array = (array)(json_decode($F));
            echo $json_array;*/

		foreach ($F[0]['values'] as $k ) {
           
    
        /*  print_r ($val11);*/
      
           
           print_r($k['end_time']->format('Y-m-d')) ;
   
           //echo $k['value'][1];
           $p1=$k['value'][0];
           $p2=$k['value'][1];
           $p3=$k['value'][2];
           $p4=$k['value'][3];
           $p5=$k['value'][4];
           $p6=$k['value'][5];
           $p7=$k['value'][6];
           $p8=$k['value'][7];
           $p9=$k['value'][8];
           $p10=$k['value'][9];
           $p11=$k['value'][10];
           $p12=$k['value'][11];
           $p13=$k['value'][12];
           $p14=$k['value'][13];
           $p15=$k['value'][14];
           $p16=$k['value'][15];
           $p17=$k['value'][16];
           $p18=$k['value'][17];
           $p19=$k['value'][18];
           $p20=$k['value'][19];
           $p21=$k['value'][20];
           $p22=$k['value'][21];
           $p23=$k['value'][22];
           $p24=$k['value'][23];
           $time=$k['end_time']->format('Y-m-d');
           $sql9="insert into nomber_vue (`id_p`, `date`, `00h`, `01h`, `02h`, `03h`, `04h`, `05h`, `06h`, `07h`, `08h`, `09h`, `10h`, `11h`, `12h`, `13h`, `14h`, `15h`, `16h`, `17h`, `18h`, `19h`, `20h`, `21h`, `22h`, `23h`) values ('{$id_p}' ,'{$time}','{$p1}','{$p2}','{$p3}','{$p4}','{$p5}','{$p6}','{$p7}','{$p8}','{$p9}','{$p10}','{$p11}','{$p12}','{$p13}','{$p14}','{$p15}','{$p16}','{$p17}','{$p18}','{$p19}','{$p20}','{$p21}','{$p22}','{$p23}','{$p24}')" ;
                if ($conn->query($sql9) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql9 . "<br>" . $conn->error;
                }
           
                  }
                  
               
                

                
                   
               
		
	
                   
            // les totales des réaction dans la page //



            // nombre des fans ayant vu n'importe quel publication sur facebook

            $date4= date('Y-m-d', strtotime($datetime.' - 30 DAY'));
            $date5=$date4 ;
            echo $date4  ;
            echo $datetime ;

            $Nb_Fan_T = $fb->get($id_p .'/insights?pretty=0&metric=page_fans_online_per_day&until='.$datetime.'&since='.$date5.'', $acc);
            $NFT = $Nb_Fan_T->getGraphEdge()->asArray();
            print_r($NFT) ;
            foreach ($NFT as $v => $value) {

                echo $value ;


            }
            $reac = $fb->get($id_p .'/posts?fields=reactions.type(LOVE).limit(0).summary(total_count).as(reactions_love),reactions.type(WOW).limit(0).summary(total_count).as(reactions_wow),reactions.type(HAHA).limit(0).summary(total_count).as(reactions_haha),reactions.type(LIKE).limit(0).summary(total_count).as(reactions_like)', $_SESSION['token']);
            $re = $reac->getGraphEdge()->asArray();
         
            
         /*   $gender = $fb->get('/1506980839532308/insights/page_fans_gender_age','EAAFkTUS4iskBANub7Aq2T2jw5jSK2WuIrTriMiXrzPjZCJoxWlv8rSXN4AUHmSnCoQ9e06XHovkAIuiAYa7JZAclYR66gMoVOHttcHkDksvkpRlJGdQVNVsM2jvZAtX7pm2jsLjUzwRVspvXC7aQyKyuqXHZCb2aot3xHJZAqSED0jQWWRdwjj48PGIZBwI6JTDpvKuU7sYgZDZD');
            $gen = $gender->getGraphEdge()->asArray();*/
            $date6= date('Y-m-d', strtotime($datetime.' - 30 DAY'));
            $date7=$date6 ;
            echo $date6  ;
            echo $datetime ;
            $gender = $fb->get($id_p .'/insights?pretty=0&since='.$date7.'&until='.$datetime.'&metric=page_fans_gender_age',$acc);
            $gen = $gender->getGraphEdge()->asArray();
         print_r($gen);
            $date_from = $date7;   
$date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
  
// Specify the end date. This date can be any English textual format  
$date_to = $datetime;  
$date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
  
// Loop from the start date to end date and output all dates inbetween  
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $d=date("Y-m-d", $i);
    echo $d.'<br />'; 
    

}  
foreach($gen[0]['values'] as $g =>$key){
   
           
    
    $f1=$key['value']["F.13-17"] ;
    $f2=$key['value']["F.18-24"];
    $f3=$key['value']["F.25-34"];
    $f4=$key['value']["F.35-44"];
    $f5=$key['value']["F.45-54"];
    $f6=$key['value']["F.55-64"];
    $f7=$key['value']["F.65+"];
    $m0=$key['value']["M.13-17"];
    $m1=$key['value']["M.18-24"];
    $m2=$key['value']["M.25-34"];
    $m3=$key['value']["M.35-44"];
    $m4=$key['value']["M.45-54"];
    $m5=$key['value']["M.55-64"];
    $m6=$key['value']["M.65+"];
   /* $sql10="insert into gender(`date`, `F-13-17`, `F-18-24`, `F-25-34`, `F-35-44`, `M-18-24`, `M-25-34`, `M-35-44`, `M-65+`) values ('{$d}','{$f1}','{$f2}','{$f3}','{$f4}','{$m1}','{$m2}','{$m3}','{$m4}')" ;
    if ($conn->query($sql10) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql10 . "<br>" . $conn->error;
    }*/

    if (( $f1!=0)&&($f2!=0)&&($f3!=0)&&($f4!=0)&&($f5!=0)&&($f6!=0)&&($f7!=0)&&($m0!=0)&&($m1!=0)&&($m2!=0)&&($m3!=0)&&($m4!=0)&&($m5!=0)&&($m6!=0)) {
      
        

        $sql10="insert into gender( `id_p`,`date`, `F-13-17`, `F-18-24`, `F-25-34`, `F-35-44`, `F.45-54`, `F.55-64`, `F.65+`, `M-13-17`, `M-18-24`, `M-25-34`, `M-35-44`, `M.45-54`, `M.55-64`, `M-65+`) values ('{$id_p}','{$d}','{$f1}','{$f2}','{$f3}','{$f4}','{$f5}','{$f6}','{$f7}','{$m0}','{$m1}','{$m2}','{$m3}','{$m4}','{$m5}','{$m6}')" ;
        if ($conn->query($sql10) === TRUE) {
            echo "succ1 " ;
        }else {
            echo "Error: " . $sql10 . "<br>" . $conn->error;
            
        }
    }
    if (( $f1!=0)&&($f2!=0)&&($f3!=0)&&($f4!=0)&&($f5===null)&&($f6===null)&&($f7==null)&&($m0===null)&&($m1==null)&&($m2==null)&&($m3==null)&&($m4===null)&&($m5===null)&&($m6==null)) {
        $f5=0;
        $f6=0;
        $f7=0;
        $m0=0;
        $m1=0;
        $m2=0;
        $m3=0;
        $m4=0;
        $m5=0;
        $m6=0;
        $sql10="insert into gender( `id_p`,`date`, `F-13-17`, `F-18-24`, `F-25-34`, `F-35-44`, `F.45-54`, `F.55-64`, `F.65+`, `M-13-17`, `M-18-24`, `M-25-34`, `M-35-44`, `M.45-54`, `M.55-64`, `M-65+`) values ('{$id_p}','{$d}','{$f1}','{$f2}','{$f3}','{$f4}','{$f5}','{$f6}','{$f7}','{$m0}','{$m1}','{$m2}','{$m3}','{$m4}','{$m5}','{$m6}')" ;
        if ($conn->query($sql10) === TRUE) {
            echo "succ1 " ;
        }else {
            echo "Error: " . $sql10 . "<br>" . $conn->error;
            
        }
    }
    if (( $f1!=0)&&($f2==null)&&($f3==null)&&($f4==null)&&($f5===null)&&($f6===null)&&($f7==null)&&($m0===null)&&($m1==null)&&($m2==null)&&($m3==null)&&($m4===null)&&($m5===null)&&($m6==null)) {
        $f2=0;
        $f3=0;
        $f4=0;
        $f5=0;
        $f6=0;
        $f7=0;
        $m0=0;
        $m1=0;
        $m2=0;
        $m3=0;
        $m4=0;
        $m5=0;
        $m6=0;
        $sql10="insert into gender( `id_p`,`date`, `F-13-17`, `F-18-24`, `F-25-34`, `F-35-44`, `F.45-54`, `F.55-64`, `F.65+`, `M-13-17`, `M-18-24`, `M-25-34`, `M-35-44`, `M.45-54`, `M.55-64`, `M-65+`) values ('{$id_p}','{$d}','{$f1}','{$f2}','{$f3}','{$f4}','{$f5}','{$f6}','{$f7}','{$m0}','{$m1}','{$m2}','{$m3}','{$m4}','{$m5}','{$m6}')" ;
        if ($conn->query($sql10) === TRUE) {
            echo "succ1 " ;
        }else {
            echo "Error: " . $sql10 . "<br>" . $conn->error;
            
        }
    }
    if (( $f1!=0)&&($f2!=0)&&($f3!=0)&&($f4!=0)&&($f5===null)&&($f6===null)&&($f7==null)&&($m0===null)&&($m1!=0)&&($m2!=0)&&($m3!=0)&&($m4===null)&&($m5===null)&&($m6!=0)) {
        
        $f5=0;
        $f6=0;
        $f7=0;
        
        $m4=0;
        $m5=0;
    $m0=0;
        $sql10="insert into gender( `id_p`,`date`, `F-13-17`, `F-18-24`, `F-25-34`, `F-35-44`, `F.45-54`, `F.55-64`, `F.65+`, `M-13-17`, `M-18-24`, `M-25-34`, `M-35-44`, `M.45-54`, `M.55-64`, `M-65+`) values ('{$id_p}','{$d}','{$f1}','{$f2}','{$f3}','{$f4}','{$f5}','{$f6}','{$f7}','{$m0}','{$m1}','{$m2}','{$m3}','{$m4}','{$m5}','{$m6}')" ;
        if ($conn->query($sql10) === TRUE) {
            echo "succ1 " ;
        }else {
            echo "Error: " . $sql10 . "<br>" . $conn->error;
            
        }
    }
    if (( $f1!=0)&&($f2!=0)&&($f3!=0)&&($f4!=0)&&($f5!=0)&&($f6!=0)&&($f7==null)&&($m0!=0)&&($m1!=0)&&($m2!=0)&&($m3!=0)&&($m4!=0)&&($m5!=0)&&($m6!=0)) {
        
        
        $f7=0;
        
       
        $sql10="insert into gender( `id_p`,`date`, `F-13-17`, `F-18-24`, `F-25-34`, `F-35-44`, `F.45-54`, `F.55-64`, `F.65+`, `M-13-17`, `M-18-24`, `M-25-34`, `M-35-44`, `M.45-54`, `M.55-64`, `M-65+`) values ('{$id_p}','{$d}','{$f1}','{$f2}','{$f3}','{$f4}','{$f5}','{$f6}','{$f7}','{$m0}','{$m1}','{$m2}','{$m3}','{$m4}','{$m5}','{$m6}')" ;
        if ($conn->query($sql10) === TRUE) {
            echo "succ1 " ;
        }else {
            echo "Error: " . $sql10 . "<br>" . $conn->error;
            
        }
    }
   
    if (( $f1!=0)&&($f2!=0)&&($f3!=0)&&($f4!=0)&&($f5!=0)&&($f6!=0)&&($f7!=0)&&($m0!=0)&&($m1!=0)&&($m2!=0)&&($m3!=0)&&($m4==null)&&($m5!=0)&&($m6!=0)) {
      
        $m4=0;

        $sql10="insert into gender(`id_p`,`date`, `F-13-17`, `F-18-24`, `F-25-34`, `F-35-44`, `F.45-54`, `F.55-64`, `F.65+`, `M-13-17`, `M-18-24`, `M-25-34`, `M-35-44`, `M.45-54`, `M.55-64`, `M-65+`) values ('{$id_p}','{$d}','{$f1}','{$f2}','{$f3}','{$f4}','{$f5}','{$f6}','{$f7}','{$m0}','{$m1}','{$m2}','{$m3}','{$m4}','{$m5}','{$m6}')" ;
        if ($conn->query($sql10) === TRUE) {
            echo "succ1 " ;
        }else {
            echo "Error: " . $sql10 . "<br>" . $conn->error;
            
        }
    }
    }

  
          /*  foreach($gen as $g =>$vall){
                foreach($vall as $k =>$m){
                    foreach($m as $j =>$key){
            print_r($key) ;
           
    
            $f1=$key['value']["F.13-17"] ;
            $f2=$key['value']["F.18-24"];
            $f3=$key['value']["F.25-34"];
            $f4=$key['value']["F.35-44"];
            $m1=$key['value']["M.18-24"];
            $m2=$key['value']["M.25-34"];
            $m3=$key['value']["M.35-44"];
            $m4=$key['value']["M.65+"];
            $sql10="insert into gender(`date`, `F-13-17`, `F-18-24`, `F-25-34`, `F-35-44`, `M-18-24`, `M-25-34`, `M-35-44`, `M-65+`) values ('{$d}','{$f1}','{$f2}','{$f3}','{$f4}','{$m1}','{$m2}','{$m3}','{$m4}')" ;
            if ($conn->query($sql10) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql10 . "<br>" . $conn->error;
            }
       
        }
              
            }
            }*/
            $e = $fb->get($id_p .'/insights?pretty=0&metric=page_posts_impressions_organic_unique&since='.$date7.'&until='.$datetime.'&period=day',$acc);
            $ee = $e->getGraphEdge()->asArray();



          
        foreach($ee[0]['values'] as $aud   ){
       
            print_r($aud['end_time']->format('l') );
            echo'<br>';
         print_r($aud['value'] );
         echo'<br>';
          
      
         
          
          }
             
$c = $fb->get($id_p .'/insights?pretty=0&since='.$date7.'&until='.$datetime.'&metric=page_views_total',$acc);
            
            $country = $c->getGraphEdge()->asArray();

        
        foreach($country[0]['values'] as $pays ){
          echo '//////////////';
        
        print_r($pays);
       
        
        }
        $sql60 = mysqli_query($con, "SELECT sum(likes) as likes , sum(love) as love , sum(haha) as haha, sum(wow) as wow, sum(sad) as sad, sum(anger) as anger FROM post WHERE id_p='$id_p' ")
            or die ("falied to query date base". mysqli_error());
            
            $rect=mysqli_fetch_array($sql60);
            echo "<br>";
            echo "<br>";
            $likes=$rect['likes'];
            $love=$rect['love'];
            $haha=$rect['haha'];
            $wow=$rect['wow'];
            $sad=$rect['sad'];
            $anger=$rect['anger'];
            
            $rect="insert into `totale_reaction` (`id_rec`,`id_p`, `date`,  `aime`, `love`, `wow`, `Sorry`, `Haha`, `Anger`) values ('{$id_p}','{$id_p}','{$datetime}','{$likes}','{$love}','{$wow}','{$sad}','{$haha}','{$anger}') ON DUPLICATE KEY UPDATE date = $datetime, aime = $likes ,love = $love,wow = $wow,Sorry= $sad,haha = $haha, Anger = $anger " ;
            if ($conn->query($rect) === TRUE) {
                echo "succ1 " ;
            }else {
                echo "Error: " . $rect . "<br>" . $conn->error;
                
            }
          
            $sql11 = mysqli_query($con, "SELECT *FROM gender WHERE id_p='$id_p' ORDER BY id_g DESC LIMIT 1")
            or die ("falied to query date base". mysqli_error());
            
            $vu=mysqli_fetch_array($sql11);
            echo "<br>";
            echo "<br>";

            $N11=$vu['F-13-17'];
            $N12=$vu['F-18-24'];
            $N13=$vu['F-25-34'];
            $N14=$vu['F-35-44'];
            $N15=$vu['F.45-54'];
            $N16=$vu['F.55-64'];
            $N17=$vu['F.65+'];
            $N18=$vu['M-13-17'];
            $N19=$vu['M-18-24'];
            $N20=$vu['M-25-34'];
            $N21=$vu['M-35-44']; 
            $N22=$vu['M.45-54'];
            $N23=$vu['M.55-64'];
            $N24=$vu['M-65+'];
     
           
    $sum=$N11+$N12+$N13+$N14+$N15+$N16+$N17+$N18+$N19+$N20+$N21+$N22+$N23+$N24;
    $F=$N11+$N12+$N13+$N14+$N15+$N16+$N17;
    $M=$N18+$N19+$N20+$N21+$N22+$N23+$N24;
    $MS=round(($M / $sum)*100);
    $FS=round(($F / $sum)*100);
    $s1=round((($N11+$N18) / $sum)*100);
    $s2=round((($N12+$N19)/ $sum)*100);
    $s3=round((($N13+$N20)/ $sum)*100);
    $s4=round((($N14+$N21)/ $sum)*100);
    $s5=round((($N15+$N22)/ $sum)*100);
    $s6=round((($N16+$N23)/ $sum)*100);
    $s7=round((($N17+$N24)/ $sum)*100);
    echo"13-17 ".$s1."%";
    echo "<br>";
    echo"18-24 ".$s2."%";
    echo "<br>";
    echo"25-34 ".$s3."%";
    echo "<br>";
    echo"35-44 ".$s4."%";
    echo "<br>";
    echo"45-54 ".$s5."%";
    echo "<br>";
    echo"55-64 ".$s6."%";
    echo "<br>";
    echo"65+ ".$s7."%";
    echo "<br>";
    echo "porcentage des femmes: ".$FS."%";
    echo "<br>";
    echo "pourcentage des hommes: ".$MS."%";
    echo "<br>";
    echo(" nomber total des fans: ".$sum);
    echo "<br>";
    echo(" nomber total des femmes: ".$F);
    echo "<br>";
    echo(" nomber total des hommes: ".$M);
echo '<br>';

    $connect = mysqli_connect("localhost", "root", "", "pfe");  
    $query = "SELECT sum(reach) as R  FROM post WHERE id_p='$id_p' AND Type='video'  ";  
    $result = mysqli_query($connect, $query);

    while($rowr = mysqli_fetch_array($result))  
    {  
       if(empty($rowr['R']) ) {
           $reach=0;
           echo $reach;
       }
       else{
           $reach= $rowr['R'];
           echo $reach; 
       }
   }
                     
                     
                
                        echo '////////////////////////';

                     

   
    ///////////////////////////
    $video = $fb->get('/'.$id_p.'/insights/page_video_views/day',$acc);
    $vid=$video->getGraphEdge()->asArray();

    
    foreach($vid[0]['values'] as $v){

        print_r($v['value']);
                 }

             $vue=$v['value'];
             echo $vue;
                 $video = "INSERT INTO `videos` (`id_vid`, `reached`, `vue`) VALUES ('{$id_p}','{$reach}', '{$vue}')  ON DUPLICATE KEY UPDATE reached = $reach,vue = $vue ";
                 if ($conn->query($video) === TRUE) {
                 echo "New record created successfully";
                 } else {
                 echo "Error: " . $video . "<br>" . $conn->error;
                 }
          ?>


<form id="form1" action="dashboard.php" method="post">
<input type="hidden" id="hidden_username" name="id" value="<?php echo $id_p; ?>" />
</form>

<script>
document.getElementById("form1").submit();
</script>



        </div>
    </div>
 
    

</body>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            
          ['gender', 'number'],
         <?php 
         echo"['HOMME', ".$MS."],";
         echo"['FEMME', ".$FS."],";
         ?>
        
        ]);

        var options = {
          title: 'My Daily Activities',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['gender', 'Percentage'],
          <?php 
        echo"['13-17 ', ".$s1." ],";
        echo"['18-24 ', ".$s2." ],";
        echo"['25-34 ', ".$s3." ],";
        echo"['35-44 ', ".$s4." ],";
        echo"['45-54', ".$s5." ],";
        echo"['55-64 ', ".$s6." ],";
        echo"['65+ ', ".$s7." ],";
        
         ?>
        ]);

        var options = {
          title: 'gender ',
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'gender',
                   subtitle: 'gender by percentage' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Percentage'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
    <script>
anychart.onDocumentReady(function () {
    // create column chart
    var chart = anychart.column();

    var data = [
      <?php 
        echo"['like', ".$rec1." ],";
        echo"['love ', ".$rec2." ],";
        echo"['	wow ', ".$rec3." ],";
        echo"['Sorry ', ".$rec4." ],";
        echo"['Haha', ".$rec5." ],";
        echo"['Anger ', ".$rec6." ],";
     
        
         ?>
    ];

    // set chart padding
    chart.padding().top(10);

    // set chart title text settings
    chart.title()
            .enabled(true)
            .text('dominatr reaction');

    // enable no data label
    chart.noData().label(true);

    // create area series with passed data
    var series = chart.column(data);

    // set series tooltip settings
    series.tooltip().titleFormat('{%X}');

    series.tooltip()
            .position('center-top')
            .anchor('center-bottom')
            .offsetX(0)
            .offsetY(5)
            .format('{%Value}{groupsSeparator: }');

    // set scale minimum
    chart.yScale().minimum(0);

    // set yAxis labels formatter
    chart.yAxis().labels().format('{%Value}{groupsSeparator: }');

    // tooltips position and interactivity settings
    chart.tooltip().positionMode('point');
    chart.interactivity().hoverMode('by-x');

    // axes titles
    chart.xAxis().title('reaction');
 

    // set container id for the chart
    chart.container('container');

    // initiate chart drawing
    chart.draw();

});
</script>
  
</html>
