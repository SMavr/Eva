<?php
 include_once ('evform.php');
 
 //select all the category for the category div
 $category_query= "SELECT * FROM category";
 $category_fetch=mysqli_query($con,$category_query);
 

 

 
 if (isset($_GET['category_id'])){
      $question_query= "SELECT * FROM question WHERE cid=".$_GET['category_id']." GROUP BY number";
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
 
 // Select all the names of the attritubes
 $attr_names='SELECT * FROM attribute';
 $attr_names_fetch=mysqli_query($con,$attr_names);
 
 // Finding the number of the current attributes (important for the attribute weights columns)
 $attr_names_no='SELECT COUNT(*) FROM attribute';
 $attr_names_no_fetch=mysqli_query($con,$attr_names_no);
 $attr_names_no_result=mysqli_fetch_array( $attr_names_no_fetch);

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
            //if it is a categoty with questions
            if ($is_question==true){
          echo  '<tr><th>No</th><th>Text</th><th>Question Weight</th><th>Connection</th></th><th>Delete</th></tr>';
       
  
 while($result = mysqli_fetch_array($question_fetch)) {
    echo "<tr><td>".$result["number"]."</td><td><div class='accordion-heading'>";
    echo "<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapse".$result['question_id']."'>";
    echo $result["qtext"]."</a></div></td><td>" .$result["qweight"]."</td> 
        <td>coming soon </td> <td><button class='btn'>Delete</button> </td></div></tr>";
     echo "<tr><td colspan='5' style='  border-top-width: 0px; padding-top:0px; padding-bottom: 0px;'>
         <div id='collapse".$result['question_id']."' class='accordion-body collapse'>";
     
                    //creating the edit questions accordion (edit weights, edit question, edit answers, edit connection)
     
            //edit weights
                echo    "<div class='accordion-inner'><h5 class='nav-header'> edit Weights </h5>";
              echo "<table style='text-align:center;'><tr><th rowspan='2'>Question Weight</th>
                  <th colspan='".$attr_names_no_result['COUNT(*)']."'>Relative Attribute Weights</th><th>Save</th></tr>";
    echo  '<tr>';          
while($attr_names_result = mysqli_fetch_array( $attr_names_fetch)){
 echo '<th>'.$attr_names_result["attr_title"].'</th>';
 }
 $attr_names_fetch=mysqli_query($con,$attr_names); //retrieving again the attributes 
   echo "</tr><tr><td><input type='text'class='input-small' value=".$result["qweight"]."></td>";
   while($attr_names_result = mysqli_fetch_array( $attr_names_fetch)){
       // select weight according to attribute and question
       $attr_question_weight="SELECT ev_value FROM evweight WHERE attr_id ='".$attr_names_result["attr_id"].
               "' AND question_id ='".$result['question_id']."'";
       $attr_question_weight_fetch=mysqli_query($con,$attr_question_weight);
        $attr_question_weight_result= mysqli_fetch_array($attr_question_weight_fetch);
   echo   "<td><input type='text'class='input-small' value=".$attr_question_weight_result['ev_value']."></td>"; 
   }
   echo "<td><button class='btn'>Save</button></td></tr></table>";
            $attr_names_fetch=mysqli_query($con,$attr_names); //retrieving again the attributes         
                     
                     //edit question text and number - questions are more sensitie data
                     echo    "<h5 class='nav-header'> edit Questions </h5>";
              echo "<table style='text-align:center;'><tr><th class='text-justify'>No</th>
                  <th rclass='text-justify'>Question Text</th><th>Hide</th><th>Invalid</th><th>Save</th><tr>
                  <tr> <td><input type='text' class='input-small'></td>
                  <td><input type='text' style='width:600px'></td>
                  <td><input type='checkbox' ></td><td><input type='checkbox' ></td>
                  <td><button class='btn'>Save</button></td></tr></table>";
              
                  // creating the edit possible answers table 
                  echo "<h5 class='nav-header'> edit answers for this question </h5>
                      <table><tr><th>Text</th><th>Value</th></tr>";
                   for( $i=1; $i<11; $i++){  
                      echo "<tr><td><input type='text' style='width:600px'></td>
                          <td><input type='text' class='input-small' value='$i'></td></tr>"; 
                   }
                 echo '</table>';  
                 
                 // buttons for saving Answers and edit Connections
               echo    "<a href='#editConnection' role='button' class='btn' data-toggle='modal'>Manage Connections</a><button class='btn'>Save</button><button class='btn'>Cancel</button>";

echo '</div></div>';

}
            } //end of questions table
            
            
   else{   // creating instructions table
        $no=1;
 echo  '<tr><th>No</th><th>Text</th></th><th>Save</th><th>Delete</th></tr>';
 while($result = mysqli_fetch_array($instruction_fetch)) {
     echo '<form name="instruction_form"';
echo "<tr><td>".$no."</td><td><div id='instruction_id".$result["instructions_id"]."' style='display:none;'>".
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
  <div id='showme' style='position:fixed; bottom:0px; color:#3333CC;'></div>
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
var ajax_instruction_id = document.getElementById(instid).innerHTML;

 var queryString = "?insturction_text=" + insturction_text ;
 queryString +=  "&inst_id=" + ajax_instruction_id;
 ajaxRequest.open("GET", "031instsql.php" + 
                              queryString, true);
 ajaxRequest.send(null); 
 
 //fading in fade out showme informing the admin for the saving progress
 $("#showme").fadeIn(3000);
 $("#showme").fadeOut(3000);
 
}

//using Ajax to save weights
function ajaxWeight(question_id,question_weight,attr_weights){
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
var ajax_instruction_id = document.getElementById(instid).innerHTML;

 var queryString = "?insturction_text=" + insturction_text ;
 queryString +=  "&inst_id=" + ajax_instruction_id;
 ajaxRequest.open("GET", "031instsql.php" + 
                              queryString, true);
 ajaxRequest.send(null); 
 
 //fading in fade out showme informing the admin for the saving progress
 $("#showme").fadeIn(3000);
 $("#showme").fadeOut(3000);
 
}

</script> 
<?php
// always closing connection
mysqli_close($con);
?>
    </body>
    
</html>