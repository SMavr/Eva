<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>

<?php
    include_once ('evform.php');
    $query= "select * from instructions";
    $fetch=mysqli_query($con,$query) or die ('could no connect with instructions');
    echo "<ul>";
 while($result = mysqli_fetch_array($fetch)) {
echo "<li>".$result["instructions"] . "</li><br>";
}
echo "</ul>";
 
?>
    </body>
</html>