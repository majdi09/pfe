<?php 
if (isset($_POST['id'])) {
$id=$_POST['id'];

$connect = mysqli_connect("localhost", "root", "", "pfe");  
$query = "SELECT * FROM test WHERE id_p='$id' ";  
$result = mysqli_query($connect, $query);
}
else {
  $id=$_GET['id'];
$connect = mysqli_connect("localhost", "root", "", "pfe");  
$query = "SELECT * FROM test WHERE id_p='$id' ";  
$result = mysqli_query($connect, $query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Now UI Dashboard by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
         
           <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
    <script>
      $(document).ready(function(){
        // Set trigger and container variables
        var trigger = $('#nav ul li a'),
            container = $('#content');
        
        // Fire on click
        trigger.on('click', function(){
          // Set $this for re-use. Set target from data attribute
          var $this = $(this),
            target = $this.data('target');       
          
          // Load target page into container
          container.load(target + '.php?id=<?php echo $id;?>');
          
          // Stop normal link behavior
          return false;
        });
      });
    </script>
  <style>









      input:focus, textarea:focus, keygen:focus, select:focus {
        outline: none;
      }
      ::-moz-placeholder {
        color: #666;
        font-weight: 300;
        opacity: 1;
      }
      
      ::-webkit-input-placeholder {
        color: #666;
        font-weight: 300;
      }
      
      .grid .col2 {
        width: 50%;
        padding: 0 10px 0 0;
      }
      .grid .col2.first {
        float: left;
      }
      .grid .col2.last {
        float: right;
      }
      
      .grid .col3 {
        width: 32%;
        float: left;
        margin-right: 11px;
      }
      .grid .col3.first {
        margin-left: 0;
        float: left;
      }
      .grid .col3.last {
        margin-right: 0;
        float: right;
      }
      
      /* profile page */
      .container {
          padding: 60px 50px 70px;
      }
      
      .innerwrap {
          width: 900px;
          margin: 0 auto;
      }
      
      .section1 {
        background: #fff;
        position: relative;
        border-radius: 2px;
      }
      .section1 div .row:first-child {
        padding: 25px;
      }
      
      
      .section1 .col2.first img {
        border-radius: 50%;
        margin: 0 20px;
        width: 120px;
        border:2px solid #f1f1f1;
        padding: 2px;
        float: left;
      }
      .section1 .col2.first {
        line-height: 25px;
        position: relative;
        border-right:1px solid #a2a2a2;
      }
      .section1 .col2.first h1 {
          font-weight: normal;
          margin-bottom: 10px;
        margin-top: 15px;
        text-transform: capitalize;
      }
      .section1 .col2.first p {
        font-size: 14px;
      }
      .section1 .col2.first span {
        position: absolute;
          right: 15px;
          top: 16px;
          background: #6AAFEA;
          padding: 5px 11px;
          font-size: 12px;
          line-height: 1;
          border-radius: 2px;
          color: #fff;
        cursor:pointer;
      }
      
      .section1 .col2.last {
        padding: 8px 0;
      }
      .section1 .col2.last .col3 span {
          color: #a2a2a2;
          font-size: 14px;
      }
      .section1 .col2.last .col3 h1 {
          color: #FB4C22;
      }
      
      .section1 .col2.last .col3 {
          text-align: center;
          line-height: 30px;
          border-right: 1px solid #ccc;
      }
      .section1 .col2.last .col3.last {
        border-right: 0;
      }
      
      .row2tab li {
          list-style: none;
          float: left;
          width: 25%;
          padding: 15px;
          font-size: 14px;
          text-align: center;
          cursor:pointer;
          background: #f1f1f1;
          color: #555;
          border-bottom: 2px solid #f1f1f1;
      }
      .row2tab li:first-child {
          border-bottom: 2px solid #6AAFEA;
          border-radius: 0 0 2px 2px;
      }
      .row2tab li:first-child {
        color:  #6AAFEA;
      }
      .row2tab li i {
              margin-right: 3px;
          font-size: 14px;
      }
      
      .smalltri {
            border-right: 40px solid #6AAFEA;
          height: 0;
          width: 0;
          border-left: 20px solid transparent;
          border-top: 10px solid #6AAFEA;
          border-bottom: 20px solid transparent;
          padding: 0px;
          top: 0;
          right: 0;
          position: absolute;
      }
      .smalltri i {
          position: absolute;
          top: -5px;
          right: -33px;
          color: #fff;
          border: 0px;
          font-size: 12px;
      }
      
      section.section2 {
          margin: 50px 0;
      }
      
      .section2 .col3 {
        width: 30%;
        margin-right: 60px;
        background: #fff;
        border-radius: 2px;
      }
      
      .section2 .postcont img {
      
        width: 100%;
      }
      .section2 .profileinfo {
          text-align: center;
          padding: 0 10px 30px;
          color: #555;
          font-size: 14px;
          line-height: 25px;
      }
      .section2 .profileinfo img {
          border-radius: 50%;
          width: 80px;
          padding: 2px;
          border: 3px solid #6AAFEA;
          margin-top: -48px;
          margin-bottom: 18px;
      }
      .section2 .col3.center .profileinfo img {
          border: 3px solid #FB4C22;
      
      }
      .section2 .profileinfo p {
        text-align: justify;
      }
      .section2 .profileinfo span {
        margin-top: 15px;
          display: block;
          text-align: left;
          color: #6AAFEA;
          cursor: pointer;
      }
      .section2 .profileinfo span i {
        margin-left: 10px;
      }
      
      @media only screen and (max-width: 1300px) {
        .innerwrap {
          width: 90%;
        }
        .section2 .col3 {
          margin-right: 5%;
        }
        .section1 .grid .col3 {
          margin-right: 2%;
        }
        .section1 .col2.last .col3.last {
          margin-right: 0;
        }
      }
      
      @media only screen and (max-width: 1060px) {
        .section1 .col2 {
          width: 100%;
          border-right:0 !important;
          padding: 0;
        }
      }
      
      @media only screen and (max-width: 660px) {
        .section2 .col3 {
          width: 100%;
          float: none !important;
          margin-bottom: 10px;
        }
        .row2tab li {
          width: 50%;
          text-align: left;
        }
        .section1 .col2.first {
          text-align: center;
        }
        .section1 .col2.first img {
          display: inline-block;
          float: none;
        }
        .section1 .col2.first span {
          position: relative;
          right: 0;
        }
        .section1 .col2.last {
          margin-top:25px;
        }
      }
      @media only screen and (max-width: 450px) {
        .container {
          padding: 60px 5px 70px;
      }
        .row2tab li {
          width: 100%;
          text-align: left;
        }
        .section1 .col2.last .col3 span {
          font-size: 10px;
        }
        .section1 .col2.last .col3 h1 {
          font-size: 18px;
        }
        
      }
      
      </style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          CT
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Creative Tim
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="./dashboard.php?id=<?php echo $id;?>">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./icons.html">
              <i class="now-ui-icons education_atom"></i>
              <p>Icons</p>
            </a>
          </li>
          <li>
            <a href="./map.html">
              <i class="now-ui-icons location_map-big"></i>
              <p>Maps</p>
            </a>
          </li>
          <li>
            <a href="./notifications.html">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Notifications</p>
            </a>
          </li>
          <li>
            <a href="./user.php?id=<?php echo $id;?>">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li>
            <a href="./tables.html">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Table List</p>
            </a>
          </li>
          <li>
            <a href="./typography.html">
              <i class="now-ui-icons text_caps-small"></i>
              <p>Typography</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="./upgrade.html">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>Upgrade to PRO</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
              Analyse
              </div>
              <div class="card-body ">
                  <div class="container">
                      <div class="innerwrap">
                        <section class="section1 clearfix">
                          <div>
                            <div class="row grid clearfix">
                              <div class="col2 first">
                              <?php 
                              
                              while($row = $result->fetch_assoc()) {
                          
                           
                              ?>
                                <img src="<?=$row['image']?>" alt="">
                                <h1><?= $row["nom"] ?></h1>
                                <span><a href="<?= $row["link"] ?>">Follow</a></span>
                                <p><strong>About :</strong> <?= $row["about"] ?></p>
                          
                                <p><strong>Category :</strong><?= $row["category"] ?></p>
                              </div>
                              
                              <div class="col2 last">
                                <div class="grid clearfix">
                                  <div class="col3 first">
                                    <h1><?= $row["fan_count"] ?></h1>
                                    <span>Abonnés</span>
                                  </div>
                                  <div class="col3"><h1><?= $row["Nb_N_Fan_Day"] ?></h1>
                                  <span>Abonnés par jour</span></div>
                                  <div ><h1><?= $row["NB_N_Fan_Month"] ?></h1>
                                  <span>Abonnés par mois</span></div>
                            
                                </div>
                                <hr>
                              </div>
                              
                            </div>
                            <hr>
                      
                      <?php
                              }
                              ?>
                          
                      
                         
                             <nav id="nav">
                              <ul class="row2tab clearfix">
                            
                                <li><i class="fa fa-list-alt"></i><a href="#" data-target="order">My posts</a></li>
                          
                                <li><i class="fa fa-list-alt"></i><a href="#" data-target="type">ANALYSE GLOBALE</a></li>
                              
                                <li><i class="fa fa-check"></i> Following </li>
                                <li><i class="fa fa-thumbs-o-up "></i> Suggestions </li>
                              </ul>
                    
                              </nav>
                           
                          </div>
                               <hr>
                          
                        <div id="content">
                        <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Name
                      </th>
                      <th>
                        Country
                      </th>
                      <th>
                        City
                      </th>
                      <th class="text-right">
                        Salary
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          Dakota Rice
                        </td>
                        <td>
                          Niger
                        </td>
                        <td>
                          Oud-Turnhout
                        </td>
                        <td class="text-right">
                          $36,738
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Minerva Hooper
                        </td>
                        <td>
                          Curaçao
                        </td>
                        <td>
                          Sinaai-Waas
                        </td>
                        <td class="text-right">
                          $23,789
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Sage Rodriguez
                        </td>
                        <td>
                          Netherlands
                        </td>
                        <td>
                          Baileux
                        </td>
                        <td class="text-right">
                          $56,142
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Philip Chaney
                        </td>
                        <td>
                          Korea, South
                        </td>
                        <td>
                          Overland Park
                        </td>
                        <td class="text-right">
                          $38,735
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Doris Greene
                        </td>
                        <td>
                          Malawi
                        </td>
                        <td>
                          Feldkirchen in Kärnten
                        </td>
                        <td class="text-right">
                          $63,542
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Mason Porter
                        </td>
                        <td>
                          Chile
                        </td>
                        <td>
                          Gloucester
                        </td>
                        <td class="text-right">
                          $78,615
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Jon Porter
                        </td>
                        <td>
                          Portugal
                        </td>
                        <td>
                          Gloucester
                        </td>
                        <td class="text-right">
                          $98,615
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                        </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by
            <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
 
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->

  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initGoogleMaps();
    });
  </script>
   
</body>

</html>