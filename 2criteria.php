<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
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
    //select question towards category
    $query1= "SELECT * FROM question WHERE cid='1' ";
    //select posible values from all the questions that they belong at the specific category
    $query2="SELECT * FROM qvalues, question WHERE qvalues.question_id=question.question_id AND question.cid='1'";
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
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
       <!-- <div>The page of criteria</div><br>
        <form name="myForm" action="answers.php" method="post">
            <table><ol>
                    <tr> <td><li>Συμφωνεί με τους σκοπούς μας και έχει συνάφεια με την αποστολή μας.</li>
<td><select name="dropdown1" onchange="showAnswer(this.value)">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select></tr>
<tr><td><li>Δεν εμποδίζεται η ανάπτυξη από υπάρχουσες πατέντες.</li>
<td><select name="dropdown2">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select></tr>
<tr><td>Δεν έχει μεγάλο κύκλο ανάπτυξης -
Κάτω από 6 μήνες.
<td><select name="dropdown3">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select></tr>
<tr><td>Δεν ανακύπτουν έντονα ηθικά προβλήματα.
<td><select name="dropdown4">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select></tr>
<tr><td>Η χρήση της εφαρμογής δεν έρχεται σε αντίθεση με διατάξεις και 
        κανονισμούς και δύσκολα μπορεί να μας δημιουργήσει νομικά προβλήματα.

<td><select name="dropdown5">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select></tr>
<tr><td>Δεν υπάρχει σοβαρή πιθανότητα να προκαλέσει 
    βίαιες αντιδράσεις από ισχυρές ομάδες ενδιαφερομένων,
    συμφερόντων, ανταγωνιστών κλπ.
<td><select name="dropdown6">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select></tr>
<tr><td>Δεν ανταγωνίζεται ευθέως φιλικά πρόσωπα ή σχήματα
<td><select name="dropdown7">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select></tr>
                </ol></table>
<br>

<input type="submit" value="Save" >
        </form>
    </body>
</html>
