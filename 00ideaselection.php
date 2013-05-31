<?php

session_start();


  echo "Welcome, ".$_SESSION['user']."<br>";
   
?>

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
   echo "<select name='dropdown1' id='dropdown1' class='span4' >";
   
 while($result1 = mysqli_fetch_array($fetch1)) {
     echo "<option  name='idea' id='idea'>".$result1["title"]."</option>";
 }
 echo "</select><br>";
 

 
 
?>
            
     <button type="submit" class="btn btn-primary"> OK </button>

   <select name="number" id="number">
            <option >one</option>
            <option>two</option>
            <option >three</option>
        </select>
            <?php
            $_SESSION['number']="hello";
   if(isset($_POST['number'])){
        $_SESSION['number'] = $_POST['number'];
    }
    else 
        {echo "what the fuck?"; }
    echo  $_SESSION['number'];
?>
  </form></div>
          
    </body>
</html>
