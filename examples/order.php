<?php  
   $id = $_GET['id'];
 $connect = mysqli_connect("localhost", "root", "", "pfe");  
 $query = "SELECT * FROM post WHERE id_p='$id' ";  
 $result = mysqli_query($connect, $query);

 $query1=  "SELECT * FROM `post`,test WHERE post.id_p='$id' AND test.id_p='$id'   ORDER BY `post`.`likes`  DESC limit 3";
 $result1 = mysqli_query($connect, $query1);
 $query2=  "SELECT likes + haha+sahres+love +wow +sad+ anger+ comments as r,post ,Type,nom , picture,date, round(((likes + haha+sahres+love +wow +sad+ anger+ comments) / fan_count)*100) as b  FROM post,test WHERE post.id_p='$id' AND test.id_p='$id'  ORDER BY r   DESC limit 3";
 $result2 = mysqli_query($connect, $query2);
 ///////////////
 $mon=  "SELECT count(*) as mon  FROM `post` WHERE id_p='$id' AND DATE_FORMAT(date , '%W')='Monday'";
 $Mo = mysqli_query($connect, $mon);
 $M=mysqli_fetch_array($Mo);
 
 $Monday=$M['mon'];

 ///////////////
 $tue=  "SELECT count(*) as tue  FROM `post` WHERE id_p='$id' AND DATE_FORMAT(date , '%W')='Tuesday'";
 $tu = mysqli_query($connect, $tue);
 $t=mysqli_fetch_array($tu);
 $Tuesday=$t['tue'];

 ///////////////
 $wed=  "SELECT count(*) as wed  FROM `post` WHERE id_p='$id' AND DATE_FORMAT(date , '%W')='WEDNESDAY'";
 $we= mysqli_query($connect, $wed);
 $w=mysqli_fetch_array($we);
 $Wednesday=$w['wed'];

 //////////////
 $thu=  "SELECT count(*) as thu FROM `post` WHERE id_p='$id' AND DATE_FORMAT(date , '%W')='Thursday'";
 $th= mysqli_query($connect, $thu);
 $t=mysqli_fetch_array($th);
 $Thursday=$t['thu'];

 //////////////
 $fri=  "SELECT count(*) as fri FROM `post` WHERE id_p='$id' AND DATE_FORMAT(date , '%W')='Friday'";
 $fr= mysqli_query($connect, $fri);
 $f=mysqli_fetch_array($fr);
 $Friday=$f['fri'];

 ///////////
 $sat=  "SELECT count(*) as sat FROM `post` WHERE id_p='$id' AND DATE_FORMAT(date , '%W')='Saturday'";
 $sa= mysqli_query($connect, $sat);
 $s=mysqli_fetch_array($sa);
 $Saturday=$s['sat'];

 ///////////
 $sun=  "SELECT count(*) as sun FROM `post` WHERE id_p='$id' AND DATE_FORMAT(date , '%W')='Sunday'";
 $su= mysqli_query($connect, $sun);
 $sn=mysqli_fetch_array($su);
 $Sunday=$sn['sun'];

 ?>  
 
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Ajax PHP MySQL Date Range Search using jQuery DatePicker</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
          
           <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
           <style type="text/css">
           .body {
	opacity: 0.5;
  filter: alpha(opacity=50);
	color: #333;
	font-weight: normal;
	font-size: 1em;
	font-family: 'Roboto', Arial, sans-serif;
}
           th {
  text-align: left;

}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}
</style>
           <style type="text/css">
#warp{
    width: 1200px;
   
}
.left{

    width: 550px;
   
    height:400px;
    float:left;
   
}
.right{

width: 400px;

height:400px;
float:right;

}
table#miyazaki { 
  margin: 0 auto;
  border-collapse: collapse;
  font-family: Agenda-Light, sans-serif;
  font-weight: 100; 
  background: #333; color: #fff;
  text-rendering: optimizeLegibility;
  border-radius: 5px; 
}
table#miyazaki caption { 
  font-size: 2rem; color: #444;
  margin: 1rem;
  background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/miyazaki.png), url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/miyazaki2.png);
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center left, center right; 
}
table#miyazaki thead th { font-weight: 600; }
table#miyazaki thead th, table#miyazaki tbody td { 
   font-size: 0.9rem;
}
table#miyazaki tbody td { 
  padding: .8rem; font-size: 1rem;
  color: #444; background: #eee; 
}
table#miyazaki tbody tr:not(:last-child) { 
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;  
}

@media screen and (max-width: 600px) {
  table#miyazaki caption { background-image: none; }
  table#miyazaki thead { display: none; }
  table#miyazaki tbody td { 
    display: block; padding: .6rem; 
  }
  table#miyazaki tbody tr td:first-child { 
    background: #666; color: #fff; 
  }
	table#miyazaki tbody td:before { 
    content: attr(data-th); 
    font-weight: bold;
    display: inline-block;
    width: 6rem;  
  }
}
</style>
           <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#999;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:#999;color:#444;background-color:#F7FDFA;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:#999;color:#fff;background-color:#26ADE4;}
.tg .tg-4fps{background-color:#efefef;color:#000000;border-color:#000000;text-align:left;vertical-align:top}
.tg .tg-ak13{text-decoration:underline;font-size:16px;background-color:#efefef;color:#000000;border-color:#000000;text-align:right;vertical-align:top}
.tg .tg-6bya{font-size:20px;background-color:#efefef;color:#000000;border-color:#000000;text-align:left}
</style>
<style type="text/css">
.tg1  {border-collapse:collapse;border-spacing:0;}
.tg1 td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg1 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg1 .tg-4fps{background-color:#efefef;color:#000000;border-color:#000000;text-align:left;vertical-align:top}
.tg1 .tg-ak13{text-decoration:underline;font-size:16px;background-color:#efefef;color:#000000;border-color:#000000;text-align:right;vertical-align:top}
.tg1 .tg-6bya{font-size:20px;background-color:#efefef;color:#000000;border-color:#000000;text-align:left}
</style>
<script >
(function ( $ ) {

"use strict";

var sb = {};

sb.o = function() {
    this.o = null;
    this.$ = null;

    this.run = function() {
        this.o = $.extend(
            {
                width: this.$.data('width') || 80,
                height: this.$.data('height') || 30,
                textColor: this.$.data('text-color') || '#151514',
                background: this.$.data('background') || '#337ab7'
            }, this.o
        );

        this.class(this.$);
        this.intv(this.$);
      
        return this;
    };
};

sb.cb = function() {
    sb.o.call(this);

    this.class = function(i) {
        i.addClass("sb_progress");
        i.html("<div class='sb_bar'><div class='sb_label'>"+i.text()+"</div></div>");
        i.css({
            position: 'relative',
            width: '100%',
            backgroundColor: '#dddddd',
            height: this.o.height+'px'
        });
        i.find('.sb_bar').css({
            position: 'absolute',
            width: '1%',
            height: '100%',
            backgroundColor: this.o.background
        });
        i.find('.sb_label').css({
            paddingLeft: '5px',
            lineHeight: this.o.height+'px',
            color: this.o.textColor
        });
    };

    this.intv = function(i) {
        var s = this;
        var e = i.find('.sb_bar');
        var w = 1;
        var t = setInterval( function() { itv(); }, 10 );            

        var itv = function() {
            if ( w >= s.o.width ) {
                clearInterval(t);
            } else {
                w++;
                e.css('width', w+'%');
            }
        };
    };
};

$.fn.simpleSkillbar = function(o) {

    return this.each(function() {
        var d = new sb.cb();
        d.o = o;
        d.$ = $(this);
        d.run();
    });
};

}( jQuery ));
</script>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
       
      </head>  
      <body >  
           <br /><br />  
           <div class="container" style="width:900px;" >  
          
                <h3 align="center">ANALYSE POSTS</h3><br />  
                <table  style=" border: none;">
                  <th style=" border: none;"> <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  </th>
                  <th  style=" border: none;"> <input type="hidden" id="id_p" name="id_p" value="<?php echo $id; ?>" />
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />   </th>
                <th  style=" border: none;"> <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />   </form>  </th>
                </table>
                
                
               

                
                <div style="clear:both" ></div>   
                <div id="testing">              
                <br />  
                <div id="order_table" >
                <table id="miyazaki">

<thead>
<th>Order Date</th>
                      
                      <th  >Image</th>
                    
                      <th>Publication</th>
                      
                      <th>jaime</th>
                      <th>commntaire</th>
                      <th>partage</th>
                      <th> LOVE</th>
                      <th>HAHA </th>
                      <th>Wow</th>
                      <th> SAD</th>
                      <th> angry</th>
                      <th>Reach</th>
                      
                      <th>Lost Fan</th>
                      <th> Clic</th>
<tbody>
<?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                          <td><?php echo $row["date"] ?></td>
                          
                               <td> <img Align="left" class="fb_img_profil" src="<?=$row['picture']?>" alt="Profil image/"></h1> </td> 
                               <td> <?=substr($row['post'],0,10); echo('....');?> </td> 
                               <td> <?=$row['likes']?> </td>
    <td> <?=$row['comments']?> </td>
    <td> <?=$row['sahres']?> </td>
    <td> <?=$row['love']?> </td>
    <td> <?=$row['haha']?> </td>
    <td> <?=$row['wow']?> </td>
    <td> <?=$row['sad']?> </td>
    <td> <?=$row['anger']?> </td>
    <td> <?=$row['reach']?> </td>
    <td> <?=$row['lostfan']?> </td>
    <td> <?=$row['clicks']?> </td>
    
                          </tr>  
                     <?php  
                     }  
                     ?>  
                     </table>  
                    
                           <H3>TOP 3 POSTS BY LIKES </H3>
                         
        <table class="tg"  >

<?php
   while(($rows=mysqli_fetch_array($result1))  )
   {
     ?>
 
<tr>
    <th class="tg-ak13"><img Align="left" class="fb_img_profil" src="<?=$rows['picture']?>" alt="Profil image/"></h1></th>

    <th class="tg-4fps"><?=$rows['date']?><br> <h3><?=$rows['nom']?></h3> <?=substr($rows['post'],0,80); echo('....');?>   </th>
    
   
    <th class="tg-4fps"> <br><img src="likes.PNG" alt="Italian Trulli" width="20" height="20"   >  </th>

    <th class="tg-4fps"> <h5 Align="center"><?=$rows['likes']?></h5> </th>

  </tr>
 
    

   <?php
 }
 
 ?>  
  </tr>
</table>


<br><br>
<H3>TOP  POSTS BY INTERACTION </H3>
<table class="tg1" >
<?php
   while($r=mysqli_fetch_array($result2))
   {
     ?>
<tr>
<th class="tg-ak13"><br><br><?=substr($r['date'],0,10)?><br><h3><?=substr($r['date'],10)?></h3> </th>
    <th class="tg-ak13"><img Align="left" class="fb_img_profil" src="<?=$r['picture']?>" alt="Profil image/" width="80" height="100"></h1></th>
    <th class="tg-4fps"><h3><?=$r['nom']?></h3><br><br>   <?=substr($r['post'],0,100)?>   </th>
    <?php
    if ($r['Type']=="pohto" ) {
    echo'  <th class="tg-4fps"> <br><br><img src="pictures.PNG" alt="Italian Trulli" width="50" height="50"  Align="center" >  </th>';
    } else {
      echo'  <th class="tg-4fps"> <br><br><img src="V.PNG" alt="Italian Trulli" width="50" height="50"  Align="center" >  </th>';
    }
    
   ?>
  
    <th class="tg-4fps"> 

      <h5 Align="center">Interaction </h5> <div id="skill1" class="demo" data-width="<?=$r['r']?>" data-background="#FFC107"> <?=$r['r']?></div>
    <th class="tg-4fps">
    
       <h5 Align="center">Engaement</h5> <div id="skill1" class="demo" data-width="<?=$r['b']?>" data-background="#FFC107"> <?=$r['b']?>%</div>
</th>

  </tr>
 
    
    <?php
   }
   ?>
  </tr>
</table>

</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      
       <div id="top_x_div" style="width: 800px; height: 600px;" Align="center"></div>
   
</div>
<div Align="center">
   
    <input type="hidden" name="hidden_html" id="hidden_html" />
    <button type="button" name="create_pdf" id="create_pdf" class="btn btn-danger btn-xs" onclick="printContent('testing')">Make PDF</button>
 
  </div>

<script>
$('.demo').simpleSkillbar({});
</script>

        
      </body>  
 </html>  
 <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker(); 
          
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                var id_p=$('#id_p').val();  
                if(from_date != '' && to_date != '' && id_p != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date , id_p:id_p},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                         
                                 
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>
<script>
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Move', 'posts'],
          ["lundi", <?php echo  $Monday; ?>],
          ["mardi", <?php echo   $Tuesday; ?>],
          ["mecrudi", <?php echo   $Wednesday; ?>],
          ["jeudi", <?php echo   $Thursday; ?>],
          ["vandredi", <?php echo   $Friday; ?>],
          ["sam", <?php echo   $Saturday; ?>],
          ["Dimanche", <?php echo   $Sunday; ?>],
        ]);

        var options = {
          width: 400,
          legend: { position: 'none' },
         
          axes: {
            x: {
              0: { side: 'top', label: 'POST PER DAY'} // Top x-axis.
            }
          },
          bar: { groupWidth: "70%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
</script>