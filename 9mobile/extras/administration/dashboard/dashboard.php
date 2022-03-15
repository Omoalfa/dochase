<?php
  session_start();
  
  if(isset($_SESSION['authenticated']) == false){
      header("location: sign-in.html");
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <meta name="HandheldFriendly" content="true" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css"/>
    <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png"/>
    
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    
    <script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><img src="../assets/img/9mobile.png" width="50" height="50" alt=""></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">-->
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <form action="auth.php" method="post">
        <!-- <a class="nav-link text-dark" href="./sign-in.html" id ="logOut" ><span data-feather="user"></span> Sign out</a> -->
        <input type="submit" class="nav-link text-dark"  name="logout" value="Sign out" style="background: none; border: none;">
      </form> 
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse mt-3">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="calendar"></span>
              This week
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="calendar"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="calendar"></span>
              Last month
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

      <?php
        if (isset($_SESSION["user"])) {
          # code...
      ?>
        <br>
        <br>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Welcome, </strong><?php echo "Admin"?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
      <?php
        } unset($_SESSION["user"]);
        include('../../includes/dbconfig.php');
        $ref = "contact";
        $total = 0;

        $getdata = $database->getReference($ref)->getValue();
        if($getdata > 0){
          foreach($getdata as $key => $row){
            $total += $row['amount'];
          }
        }
      ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <h6>Amount Spent:NGN <?= $total?></h6>
      </div>

      <div id="myChart"></div>
      
      <h2>Reward System Leads</h2>

      <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
              <th>Date</th>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Email Address</th>
              <th>Amount</th>
              <th>Time</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            // include('../../includes/dbconfig.php');
            $satDataList = [];
            $sunDataList = [];
            $monDataList = [];
            $tueDataList = [];
            $wedDataList = [];
            $thurDataList = [];
            $friDataList = [];
            $values = [];

            // $ref = "contact";
            // $getdata = $database->getReference($ref)->getValue();
            if($getdata > 0){
              foreach($getdata as $key => $row){
                ?>
                <tr>
                  <td><?php echo $row['date']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['amount']; ?></td>
                  <td><?php echo $row['time']; ?></td>
                </tr>
                <?php
                  $date = date_create($row['date']);
                  $formatDate = date_format($date, 'D');
                  
                  if ($formatDate === "Sun") {
                    array_push($sunDataList, $formatDate);
                  } else if ($formatDate === "Sat") {
                    array_push($satDataList, $formatDate);
                  } else if ($formatDate === "Mon") {
                    array_push($monDataList, $formatDate);
                  } else if ($formatDate === "Tue") {
                    array_push($tueDataList, $formatDate);
                  } else if ($formatDate === "Wed") {
                    array_push($wedDataList, $formatDate);
                  } else if ($formatDate === "Thu") {
                    array_push($thurDataList, $formatDate);
                  } else {
                    array_push($friDataList, $formatDate);
                  }
              }
              array_push($values, count($sunDataList), count($monDataList), count($tueDataList), count($wedDataList), count($thurDataList), count($friDataList), count($satDataList));
            ?>
          
          <script type="text/javascript">

            var values = [];
            <?php
                for ($i=0; $i < count($values) ; $i++) { 
             ?>
            values.push(<?= $values[$i]?>); 
            <?php
              }            
            ?>
            
            console.log(values);
            
          </script>
          <?php
            } else {
          ?>
            <tr class="text-center">
                <td colspan="5">DATA NOT AVAILABLE IN DATABASE</td>
            </tr>
          <?php
            }
          ?>
        </tbody>
        <tfoot>
            <tr>
              <th>Date</th>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Email Address</th>
              <th>Amount</th>
              <th>Time</th>
            </tr>
        </tfoot>
    </table>
    <p class="mt-3 mb-3 text-muted text-center">&copy; 2020</p>
    <br>
    </main>
    
  </div>
</div>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>
<!-- <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-database.js"></script> -->

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>

<script src="dashboard.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>

<script>
  $(document).ready(function() {
    // $('#example').DataTable();
    var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
  } );
</script>

<!-- <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script> -->
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
