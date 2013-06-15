<?php
 include_once ('evform.php');
 
 //select all the category for the category div
 $category_query= "SELECT * FROM category";
 $category_fetch=mysqli_query($con,$category_query);
 

 

 
 if (isset($_GET['category_id'])){
      $question_query= "SELECT * FROM question WHERE cid=".$_GET['category_id'];
      $question_fetch=mysqli_query($con,$question_query);
    //boolean  for questions or instructions
       $is_question=true;
 }
 else{
     $instruction_query="SELECT * FROM instructions";
     $instruction_fetch=mysqli_query($con,$instruction_query);
      $is_question=false;
      
      //  $query1= "SELECT * FROM qvalues WHERE question_id=1";
//  $fetch1=mysqli_query($con,$query1);
//  while($result1 = mysqli_fetch_array($fetch1)) {
//      echo " <input type='text' value='".$result1["qv_text"]."'> <input type='text'
//    value='".$result1["qv_value"]."'>
//    <button class='btn'>Delete</button>";}
 }
?>
<style>
  .table th {text-align:center; vertical-align:middle;}
</style>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="css/bootstrap-responsive.css" rel="stylesheet">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/bootstrap-modal.js'></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/jquery.js'></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/bootstrap-transition.js'></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/bootstrap-collapse.js'></script>

    </head>
    <body>
       <div id='showme'>The result here</div>
          <!--select category div-->
        <div style=" width:200px;float:left;">
            
        
            <ul class="nav nav-pills nav-stacked">
              <li class="nav-header">Κατηγοριες</li>
              <li> <a href=03questions.php>Οδηγίες</a></li>
                <?php
                $_GET['category_id']=null; // setting category_id=null so the instruction can be reloaded
                while($category_result = mysqli_fetch_array($category_fetch)){
                    echo "<li> <a href=03questions.php?category_id=$category_result[category_id]>$category_result[ctitle]</a></li>";
                }
                ?>
                <li> <button class='btn btn-primary'>+</button></li>
            </ul> </div>
          
          <!-- manage questions div-->
        <div style="float:left; border-left: 1px solid;  width:1000px">
        <table class="table table-hover">
            <?php 
            if ($is_question==true){
          echo  '<tr><th>No</th><th>Text</th><th>Question Weight</th><th>Connection</th></th><th>Delete</th></tr>';
       
   $no=1;
 while($result = mysqli_fetch_array($question_fetch)) {
    echo "<tr><td>".$no."</td><td><div class='accordion-heading'>";
    echo "<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapse".$result['question_id']."'>";
    echo $result["qtext"]."</a></div></td><td>" .$result["qweight"]."</td> 
        <td>coming soon </td> <td><button class='btn'>Delete</button> </td></div></tr>";
     echo "<tr><td colspan='5' style='  border-top-width: 0px; padding-top:0px; padding-bottom: 0px;'>
         <div id='collapse".$result['question_id']."' class='accordion-body collapse'>";
     
                    //creating the edit questions table
                echo    "<div class='accordion-inner'><h5 class='nav-header'> edit Question </h5>";
              echo "<table style='text-align:center;'><tr><th rowspan='2' class='text-justify'>No</th><th rowspan='2' class='text-justify'>Question Text</th><th rowspan='2'>Question Weight</th><th colspan='3'>Attribute Weights</th></tr>
                  <tr><th>Manager</th><th>Programmer</th><th>Accountant</th></tr>
                    <tr> <td><input type='text' class='input-small'></td><td><input type='text'></td> <td><input type='text'class='input-small'></td><td><input type='text' class='input-small'></td><td><input type='text' class='input-small'></td>
                    <td><input type='text' class='input-small'></td></tr></table><br>";
                     echo '<p>no Connection</p>';
                  // creating the edit possible answers table 
                  echo "<h5 class='nav-header'> edit answers for this question </h5><br>
                      <table><tr><th>Text</th><th>Value</th></tr>";
                   for( $i=1; $i<11; $i++){  
                      echo "<tr><td><input type='text'></td><td><input type='text' class='input-small' value='$i'></td></tr>"; 
                   }
                 echo '</table>';  
                 
               echo    "<a href='#editConnection' role='button' class='btn' data-toggle='modal'>Manage Connections</a><button class='btn'>Save</button><button class='btn'>Cancel</button>";

echo '</div></div></td></tr>';
$no++;
}
            }
   else{   // creating instructions table
        $no=1;
 echo  '<tr><th>No</th><th>Text</th></th><th>Save</th><th>Delete</th></tr>';
 while($result = mysqli_fetch_array($instruction_fetch)) {
     echo '<form name="instruction_form"';
echo "<tr><td>".$no."</td><td><div id='instruction_id".$result["instructions_id"]."'>fsdgdgdf".
        $result["instructions_id"]."</div>
    <textarea rows='6' id='instarea".$result["instructions_id"].
        "'style='width:600px' >".$result["instructions"]."</textarea></td> <td>
         <input type='button' class='btn'
         onclick='ajaxFunction(\"instarea".$result["instructions_id"]."\",\"instruction_id".$result["instructions_id"]."\")' value='Save'/>
         <td><button class='btn'>Delete</button> </td></tr></form>";
$no++;
 }}
?>
        
            <tr><td><button class='btn btn-primary'>New question</button></td></tr>  </table>       </div>
        
   <div id="editConnection" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                 <h5 class='nav-header'>Manage Connections</h5>
                 <table class="table table-hover"><tr><th>Connected Question</th><th>Rule</th></th><th>Message</th><th>Delete</tr>
                     <tr><td>3</td><td>if v<2 and cqv>6 </td><td>You are a cool Evaluator!</td><td><button class='btn'>x</button></td></tr>
                 </table>
    Connect with              
  <select  class='input-small'>
  <option >1</option>
  <option >2</option>
  <option >3</option>
  </select> question<br>
  if Evaluator has selected value
  <select class='input-small'>
  <option >=</option>
  <option ><</option>
  <option >></option>
  <option >between</option>
  </select>
  <select class='input-small'>
  <option >1</option>
  <option >2</option>
  <option >3</option>
  <option >4</option>
  <option >5</option>
  <option >6</option>
  <option >7</option>
  <option >8</option>
  <option >9</option>
   <option >10</option>
  </select>
  and 
 <select class='input-small'>
  <option >1</option>
  <option >2</option>
  <option >3</option>
  <option >4</option>
  <option >5</option>
  <option >6</option>
  <option >7</option>
  <option >8</option>
  <option >9</option>
   <option >10</option> 
 </select>
  and the selected value in the connected question is
  <select class='input-small'>
  <option >=</option>
  <option ><</option>
  <option >></option>
  <option >between</option>
  </select>
  <select class='input-small'>
  <option >1</option>
  <option >2</option>
  <option >3</option>
  <option >4</option>
  <option >5</option>
  <option >6</option>
  <option >7</option>
  <option >8</option>
  <option >9</option>
   <option >10</option>
  </select> and 
    <select class='input-small'>
  <option >1</option>
  <option >2</option>
  <option >3</option>
  <option >4</option>
  <option >5</option>
  <option >6</option>
  <option >7</option>
  <option >8</option>
  <option >9</option>
   <option >10</option>
  </select> <br>
  Write the text you want the Evaluator to see in the selected question
     <textarea rows="4" cols="50"></textarea>
 
      <br>
     <button class='btn'>add Connection</button> 
     <br>
         <button class='btn btn-primary'>Save</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
          </div>
  </div>    
 
     <script language="javascript" type="text/javascript">
//using AJAX for instructions
//Browser Support Code for AJAX
function ajaxFunction(instarea,instid){
 var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 // Create a function that will receive data 
 // sent from the server and will update
 // div section in the same page.
 ajaxRequest.onreadystatechange = function(){
   if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('showme');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
   }
 }
 // Now get the value from user and pass it to
 // server script.
 var insturction_text = document.getElementById(instarea).value;
var ajax_instruction_id = document.getElementById(instid).value;
 var queryString = "?insturction_text=" + insturction_text ;
 queryString +=  "&inst_id=" + ajax_instruction_id;
 ajaxRequest.open("GET", "031instsql.php" + 
                              queryString, true);
 ajaxRequest.send(null); 
}
</script>  
    </body>
    
</html>