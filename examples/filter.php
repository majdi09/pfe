<?php  
 //filter.php 

 $id=$_POST["id_p"];

 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "pfe");  
      $output = '';  
      $query = "  
           SELECT * FROM post  
           WHERE  id_p='$id' AND date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                <th width="12%">Order Date</th>
                      
                <th width="12%">Image</th>
              
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
               

                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                     <td>'. $row["date"] .'</td>
                         
                          <td> <img Align="left" class="fb_img_profil" src="'.$row['picture'].'" alt="Profil image/"></h1> </td>  
                          <td>' .substr($row['post'],0,100).'</td> 
                          <td> '.$row['likes'].' </td>
    <td> '.$row['comments'].' </td>
    <td> '.$row['sahres'].'</td>
    <td> '.$row['love'].' </td>
    <td> '.$row['haha'].' </td>
    <td> '.$row['wow'].' </td>
    <td> '.$row['sad'].' </td>
    <td> '.$row['anger'].' </td>
    <td> '.$row['reach'].' </td>
    <td> '.$row['lostfan'].' </td>
    <td> '.$row['clicks'].' </td> 
    
    
                            
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  

      
     
 }  
 ?>

<?php  
//filter.php  
if(isset($_POST["from_date"], $_POST["to_date"]))  
{  
     $connect = mysqli_connect("localhost", "root", "", "pfe");  
    

     
     $output1 = '';  
     $query1 = "  
          SELECT * FROM post,test Where post.id_p='$id' AND test.id_p='$id' AND   post.date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'ORDER BY post.likes DESC limit 3 ";  
     $result1 = mysqli_query($connect, $query1);  
     $output1 .= '  
     <H3>TOP 3 POSTS BY LIKES </H3>
     <table class="tg" >
              

               
     ';  
     if(mysqli_num_rows($result1) > 0)  
     {  
          while($rows = mysqli_fetch_array($result1))  
          {  
               $output1 .= '  
                    <tr>  
                    <th class="tg-ak13"><img Align="left" class="fb_img_profil" src="'.$rows['picture'].'" alt="Profil image/"></h1></th>
                    <th class="tg-4fps">'.$rows['date'].'<br> <h3>'.$rows['nom'].' </h3>'.substr($rows['post'],0,80).'   </th>
                    <th class="tg-4fps"> <br><img src="likes.PNG" alt="Italian Trulli" width="20" height="20"   >  </th>
                    <th class="tg-4fps"> <h5 Align="center">'.$rows['likes'].'</h5> </th>
                           
                    </tr>  
               ';  
          }  
     }  
     else  
     {  
          $output1 .= '  
               <tr>  
                    <td colspan="5">No Order Found</td>  
               </tr>  
          ';  
     }  
     $output1 .= '</table>';  
     
     echo $output1;  
  
}  


?>
<?php  
//filter.php  
if(isset($_POST["from_date"], $_POST["to_date"]))  
{  
     $connect = mysqli_connect("localhost", "root", "", "pfe");  
    

     
     $output2 = '';  
     $query2 = "  
          SELECT likes + haha+sahres+love +wow +sad+ anger+ comments as r,post,nom ,type , picture,date, round(((likes + haha+sahres+love +wow +sad+ anger+ comments) / fan_count)*100) as b FROM post,test 
          WHERE post.id_p='$id' AND test.id_p='$id' AND date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'ORDER BY r DESC limit 3 
     ";  
     $result2 = mysqli_query($connect, $query2);  
     $output2 .= '  
     <H3>TOP  POSTS BY INTERACTION </H3>
     <table class="tg1" 
              

               
     ';  
     if(mysqli_num_rows($result2) > 0)  
     {  
          while($r = mysqli_fetch_array($result2))  
          {  
               $output2 .= '  
               <tr>
               <th class="tg-ak13"><br><br>'.substr($r['date'],0,10).'<br><h3>'.substr($r['date'],10).'</h3> </th>
                   <th class="tg-ak13"><img Align="left" class="fb_img_profil" src="'.$r['picture'].'" alt="Profil image/" width="80" height="100"></h1></th>
                   <th class="tg-4fps"><h5>'.$r['nom'].' </h5> '.substr($r['post'],0,100).'   </th>
                
                
                  
                 
                 
                   <th class="tg-4fps"> 
               
                     <h5 Align="center">Interaction </h5> <div id="skill1" class="demo" data-width="'.$r['r'].'" data-background="#FFC107">'.$r['r'].'</div>
                   <th class="tg-4fps">
                   
                      <h5 Align="center">Engaement</h5> <div id="skill1" class="demo" data-width="'.$r['b'].'" data-background="#FFC107"> '.$r['b'].'%</div>
               </th>
               
                 </tr>
                
               ';  
          }  
     }  
     else  
     {  
          $output2 .= '  
               <tr>  
                    <td colspan="5">No Order Found</td>  
               </tr>  
          ';  
     }  
     $output2 .= '</table> ';  
     
     echo $output2;  
  
}  


?>
<script>
$('.demo').simpleSkillbar({});
</script>
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