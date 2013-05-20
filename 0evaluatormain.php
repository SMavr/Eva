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
  <li><a href="1instructions.php" target="mainframe">Οδηγίες</a></li>  
  <li><a href="2criteria.php" target="mainframe">Κριτήρια αποκλεισμού</a></li>  
  <li><a href="3usability.php" target="mainframe">Χρησιμότητα για Χρήστες</a></li>  
  <li><a href="4invest.php" target="mainframe">Ύψος Επένδυσης</a></li>  
  <li><a href="5possibility.php" target="mainframe">Υλοποίηση Δυνατότητας</a></li>  
  <li><a href="6scifyuse.php" target="mainframe">Χρησιμότητα για τη SciFY</a></li>
  <li><a href="7subjective.php" target="mainframe">Υποκειμενικά κριτήρια</a></li>
</ul>  
          </div><!--/.nav-collapse -->
        </div>
           
      </div>
             <div class="well" style="float: left; text-align: center; width: 100%; margin-top: 2%">
                 <h3>Αξιολόγηση Ιδέας</h3></div>
      
        <div class="well" style="width: inherit;" >        
        <iframe src="1instructions.php" name="mainframe"  height="550" width="1300"></frame></div></div>
         <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>  
<script src="twitter-bootstrap-v2/docs/assets/js/bootstrap-dropdown.js"></script>  
    </body>
   
</html>
