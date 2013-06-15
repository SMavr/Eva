<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="css/bootstrap-responsive.css" rel="stylesheet">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script type='text/javascript' src='https://raw.github.com/Mottie/tablesorter/master/js/jquery.tablesorter.min.js'></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/jquery.js'></script>
<!--instead of raw.github must written rawgithub towards chrome bug! in other browsers functions normally -->
<script type='text/javascript' src='https://rawgithub.com/Mottie/tablesorter/master/js/jquery.tablesorter.js'></script>


<!--<style>
   .box_rotate div {position: absolute;}
   
    .box_rotate {
      display:block;  
     -moz-transform: rotate(50deg);  /* FF3.5+ */
       -o-transform: rotate(50deg);  /* Opera 10.5 */
     
       -webkit-transform: rotate(305deg);
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
      text-indent: -3em;
    padding: 0px 0px 0px 0px;
    margin: 0px;
    text-align: left;
    vertical-align: top;
}
</style>-->
<style>
    .css-vertical-text {
    writing-mode:tb-rl;
    -webkit-transform:rotate(80deg);
    -webkit-transform-origin:100% 0%;
    -moz-transform:rotate(75deg);
    -origin:100% 0%;
    -o-transform: rotate(75deg);
    font-weight:normal;
    height:50px;
    display:block;
    white-space:nowrap;
    width:20px;
}
</style>
    </head>
    <body>
        <br> <br> <br> <br> <br>
        <table class="table table-hover tablesorter" id="rankingTable">
            <thead> <tr><th>Idea</th><th>Score</th><th style="width:20px;" ><p class="css-vertical-text" style="margin:0cm 0cm cm 0cm;">Manager</p><input type="checkbox" ></th>
                <th style="width:20px;" ><p class="css-vertical-text">Programmer</p><input type="checkbox" ></th>
                <th style="width:20px;" ><p class="css-vertical-text">Accountant</p><input type="checkbox" ></th>
                 <th style="width:20px;" ><p class="css-vertical-text">Mathematician</p><input type="checkbox" ></th>
                </tr></thead>
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
 echo"<tr><td>".$result2['title']."</td><td>".$resultsum['SUM(avalue)']."</td>
     <td><input type='checkbox' ></td><td><input type='checkbox' ></td>
     <td><input type='checkbox' ></td> <td><input type='checkbox' ></td></tr>";
//  $fetch1=mysqli_query($con,$query1) or die ('could no connect with answers');
//  while($result1=mysqli_fetch_array($fetch1)){
//    
//  }
}
    
 
?>
           </tbody>
        </table>
<button class='btn btn-primary'>Reload</button>

    <script>
  $(document).ready(function() 
    { 
        $("#rankingTable").tablesorter(); 
    } 
);  
    
//    $(document).ready(function() 
//    { 
//        $("#rankingTable").tablesorter( {sortList: [[0,0], [1,0]]} ); 
//    } 
//); 
    </script>
    </body> 
</html>