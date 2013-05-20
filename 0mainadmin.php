<?php

include_once ('evform.php');
$idea= mysql_real_escape_string($_POST['idea']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div id="kati">
        <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <ul class="nav">  
  <li class="active">  
    <a class="brand" href="http://www.scify.gr/site/en/" target="_blank">Scify</a>  
  </li>  
  <li><a href="01users.php" target="mainframe">Χρήστες</a></li>  
  <li><a href="02ideas.php" target="mainframe">Ιδέες</a></li>  
  <li><a href="3usability.php" target="mainframe">Ερωτήσεις/Οδηγίες</a></li>  
  <li><a href="04ranking.php" target="mainframe">Ranking</a></li>  
</ul>  
          </div><!--/.nav-collapse -->
        </div>
           
      </div>
             <div class="well" style="float: left; text-align: center; width: 100%; margin-top: 2%">
                 <h3>Αξιολόγηση Ιδέας</h3></div>
      
        <div class="well" style="width: inherit;" >        
        <iframe src="01users.php" name="mainframe"  height="550" width="1300"></frame></div></div>
         <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>  
<script src="twitter-bootstrap-v2/docs/assets/js/bootstrap-dropdown.js"></script>  
    </body>
   
</html>
