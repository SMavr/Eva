<html>
    <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
     <!-- showAnswer function -->
          <script>
function showAnswer(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","answers.php?q="+str,true);
xmlhttp.send();
}
</script> 
    </head>
    <body>
         <div class="form-actions">
  <form name="usabform" method="post" action="answers.php">   
      
<?php
    include_once ('evform.php');
    $query1= "select * from question where cid='6'";
   $query2="SELECT * FROM qvalues, question WHERE qvalues.question_id=question.question_id AND question.cid='6'";
    $fetch2=mysqli_query($con,$query2) or die ('could not connect with qvalues');
    $fetch1=mysqli_query($con,$query1) or die ('could no connect with question');
   // $result2=mysql_fetch_array($fetch2);
    echo "<ol>";
 while($result1 = mysqli_fetch_array($fetch1)) {
    mysqli_data_seek( $fetch2, 0 ); // set inner pointer to 0
echo "<li>".$result1["qtext"] . "<select name=\"dropdown1\" class='span1' onchange='showAnswer(this.value)'>";
while($result2 = mysqli_fetch_array($fetch2)){
     echo "<td><option value=\"".$result2["qv_value"]."\">".$result2["qv_text"]."</option>";
    
 }
 echo "</li></select><br>";
}
echo "</ol>";
 
?>
            
     <button type="submit" class="btn btn-primary"> Save </button>
<button type="button" class="btn"> Reset</button>
   
  </form></div>
      <script src="twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>  
<script src="twitter-bootstrap-v2/docs/assets/js/bootstrap-dropdown.js"></script>  
    </body>
</html>