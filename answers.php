<?php

include_once ('evform.php');
$q=$_GET["q"];
$query = "INSERT INTO answer (avalue,uid,iid,question_id) VALUES ('".$q."','1','1')";
echo $query;
mysqli_query($con,$query)or die(mysqli_error($con)." Q=".$query);
//if (!mysqli_query($con, "SET @a:='this will not work'")) {
//        printf ("Error: %s\n", mysqli_error($con));
//    }
mysqli_close($con);
?>