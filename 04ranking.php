<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="css/bootstrap-responsive.css" rel="stylesheet">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/jquery.js'></script>
<script type='text/javascript' src='https://raw.github.com/Mottie/tablesorter/master/js/jquery.tablesorter.js'></script>
    </head>
    <body>
        
        <table class="table table-hover tablesorter" id="rankingTable">
           <thead> <tr><th>Idea</th><th>Score</th></tr></thead>
           <tbody>
        <?php
    include_once ('evform.php');
    $query2="SELECT * FROM idea";
    $fetch2=mysqli_query($con,$query2) or die ('could no connect with idea');
 while($result2 = mysqli_fetch_array($fetch2)) {
 $query1= "SELECT * FROM answer WHERE iid=".$result2["idea_id"];
 $querysum= "SELECT SUM(avalue) FROM answer WHERE iid=".$result2["idea_id"];
 $fetchsum=mysqli_query($con,$querysum);
 $resultsum = mysqli_fetch_array($fetchsum);
 echo"<tr><td>".$result2['title']."</td><td>".$resultsum['SUM(avalue)']."</td></tr>";
  $fetch1=mysqli_query($con,$query1) or die ('could no connect with answers');
  while($result1=mysqli_fetch_array($fetch1)){
    
  }
}
    
 
?>
           </tbody>
        </table>
  

    <script>
  $(document).ready(function() 
    { 
        $("#rankingTable").tablesorter(); 
    } 
);  
    
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} ); 
    } 
); 
    </script>
    </body> 
</html>