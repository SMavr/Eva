<html>
    <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
         <div class="form-actions">
  <form name="usabform" method="post" action="0evaluatormain.php">   
<?php
    include_once ('evform.php');
    $query1= "SELECT * FROM idea ";
    $fetch1=mysqli_query($con,$query1) or die ('could no connect with idea');
   echo "<select name=\"dropdown1\" class='span4' >";
 while($result1 = mysqli_fetch_array($fetch1)) {
     echo "<td><option value=\"".$result1["idea_id"]."\" name='idea' id='idea'>".$result1["title"]."</option>";
 }
 echo "</select><br>";


 
?>
            
     <button type="submit" class="btn btn-primary"> OK </button>

   
  </form></div>
      <script src="twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>  
<script src="twitter-bootstrap-v2/docs/assets/js/bootstrap-dropdown.js"></script>  
    </body>
</html>