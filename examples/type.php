<?php 


$id = $_GET['id'];
$connect = mysqli_connect("localhost", "root", "", "pfe");  
$query = "SELECT count(Type) AS 'photo' FROM post WHERE  Type='photo' AND id_p='$id' ";  
$result = mysqli_query($connect, $query);
$vu=mysqli_fetch_array($result);

$vu1=$vu['photo'];

$query1 = "SELECT count(Type) AS 'video' FROM post WHERE Type='video' AND id_p='$id' ";  
$result1 = mysqli_query($connect, $query1);
$vi=mysqli_fetch_array($result1);

$vi1=$vi['video'];

$query2 = "SELECT count(Type) AS 'link' FROM post WHERE Type='link' AND id_p='$id' ";  
$result2 = mysqli_query($connect, $query2);
$li=mysqli_fetch_array($result2);
$l=$li['link'];

$query3 = "SELECT count(Type) AS 'event' FROM post WHERE Type='event' AND id_p='$id' ";  
$result3 = mysqli_query($connect, $query3);
$ev=mysqli_fetch_array($result3);
$e=$ev['event'];

$query4= "SELECT count(Type) AS 'status' FROM post WHERE Type='status' AND id_p='$id' ";  
$result4= mysqli_query($connect, $query4);
$st=mysqli_fetch_array($result4);
$s=$st['status'];
$tot=$vi1+$vu1+$l+$e+$s;

$photo=($vu1/$tot)*100;

$video=($vi1/$tot)*100;
$link=($l/$tot)*100;
$event=($e/$tot)*100;
$status=($s/$tot)*100;
$query2 = "SELECT count(*) AS 'pub' , sum(clicks) AS 'click' , sum(reach) AS 'rea' ,sum(sahres) as sh,sum(comments) as com  FROM post WHERE   id_p='$id' ";  
$result2 = mysqli_query($connect, $query2);
$pub=mysqli_fetch_array($result2);

$publication=$pub['pub'];
$click=$pub['click'];
$reach=$pub['rea'];
$sahres=$pub['sh'];
$comments =$pub['com'];

$sql11 = mysqli_query($connect, "SELECT *FROM gender WHERE id_p='$id' ORDER BY id_g DESC LIMIT 1")
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
   
$rect= mysqli_query($connect, "SELECT *FROM totale_reaction WHERE id_p='$id' ")
            or die ("falied to query date base". mysqli_error());
            
            $rection=mysqli_fetch_array($rect);
            $likes=$rection['aime'];
            $love=$rection['love'];
            $haha=$rection['Haha'];
            $wow=$rection['wow'];
            $sad=$rection['Sorry'];
            $anger=$rection['Anger'];

            $totinter=$likes+$love+$haha+$wow+$sad+$anger;

            $totale=$totinter+$comments+$sahres;
            
           
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            
          ['gender', 'number'],
         <?php 
         echo"['PHOTO', ".$photo."],";
         echo"['Video', ".$video."],";
         echo"['link', ".$link."],";
         echo"['event', ".$event."],";
         echo"['status', ".$status."],";
         ?>
   
        ]);

        var options = {
          title: 'Post Type',
          pieHole: 0.9,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
        chart.draw(data, options);
      }
    </script>
    <style>
    .div {
	width: 100px;
	height: 100px;

	
	position: absolute;
	top:0;
	bottom: 0;
	left: 0;
	right: 0;
  	
	margin: auto;
}
</style>
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
 <h1 Align="center"> Type OF POSTS</h1>



<div id="donutchart1" style="width: 600px; height: 500px;  margin: auto;"  ></div>



            

        </div>
    </div>
    <div style=" background-color: lightblue; height: 180px; ">
    <h3 style="text-align: center;">Nomber des publucation: <?php echo $publication; ?></h3>
    <h3 style="text-align: center;  color: green ">Nomber Total des clicks: <?php echo $click; ?></h3>
    <h3 style="text-align: center; color: red;">Nomber Totale de vue: <?php echo $reach; ?></h3>
  </div>
    <div id="donutchart" style="width: 900px; height: 500px; margin: auto;" ></div>
  
    <div id="top_x_div" style="width: 900px; height: 500px; margin: auto;" ></div>
    <div id="rect" style="width: 900px; height:500px; margin: auto;" Align="center"></div>
    
    

    
    <div class="row" style=" background-color: lightblue; height: 180px; " >
  <div class="column" style="background-color: lightblue; height: 180px;">
    <h3> Interactions</h3>
    <p><h5 style=" color: red;">totale interaction : <?php echo $totale;?> </h5> </p>
  </div>
  <div class="column" style="background-color: lightblue;  height: 180px;">
  <table style="table-layout: fixed;
  width: 100%;" >
  <th style="  text-align: center;" >
  <h2 ><?php echo $totinter;?></h2>
    <h3 style=";color: red;">JAIME</h3>
  </th>
  <th style="  text-align: center;">
  <h2 ><?php echo $comments;?></h2>
    <h3 style=" color: red;">comment</h3>
  </th>
  <th style=" text-align: center ;">
  <h2 ><?php echo $sahres;?></h2>
    <h3 style="  color: red;">partage</h3>
  </th>

  </table>
  
  </div>
</div>
  


</body>

<script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js?hcode=be5162d915534272a57d0bb781d27f2b"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js?hcode=be5162d915534272a57d0bb781d27f2b"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js?hcode=be5162d915534272a57d0bb781d27f2b"></script>

  <link href="https://cdn.anychart.com/playground-css/general-features/no-data-label-feature/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css?hcode=be5162d915534272a57d0bb781d27f2b" type="text/css" rel="stylesheet">
  <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css?hcode=be5162d915534272a57d0bb781d27f2b" type="text/css" rel="stylesheet">
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
          title: 'Gender',
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
        echo"['like', ".$likes." ],";
        echo"['love ', ".$love." ],";
        echo"['	wow ', ".$haha." ],";
        echo"['Sorry ', ".$wow." ],";
        echo"['Haha', ".$sad." ],";
        echo"['Anger ', ".$anger." ],";
     
     
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
    chart.container('rect');

    // initiate chart drawing
    chart.draw();

});
</script>


