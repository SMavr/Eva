<?php
 include_once ('evform.php');
 
 //select all the category for the category div
 $category_query= "SELECT * FROM category";
 $category_fetch=mysqli_query($con,$category_query);
 

 

 
 if (isset($_GET['category_id'])){
      $question_query= "SELECT * FROM question,category WHERE cid=".$_GET['category_id'];
      $question_fetch=mysqli_query($con,$question_query);
    //boolean  for questions or instructions
       $is_question=true;
 }
 else{
     $instruction_query="SELECT * FROM instructions";
     $instruction_fetch=mysqli_query($con,$instruction_query);
      $is_question=false;
 }
?>

<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="css/bootstrap-responsive.css" rel="stylesheet">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/bootstrap-modal.js'></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/jquery.js'></script>

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
            if ($is_question==true){
          echo  '<tr><th>No</th><th>Text</th><th>Question Weight</th></th><th>Edit</th><th>Delete</th></tr>';
       
   $no=1;
 while($result = mysqli_fetch_array($question_fetch)) {
echo "<tr><td>".$no."</td><td>" .$result["qtext"]."</td>
    <td>" .$result["qweight"]."</td> <td>
         <a href='#editQuestion' role='button' class='btn' data-toggle='modal'>Edit</a> </td>
         <td><button class='btn'>Delete</button> </td></tr>";
$no++;
}
            }
   else{
        $no=1;
 echo  '<tr><th>No</th><th>Text</th></th><th>Edit</th><th>Delete</th></tr>';
 while($result = mysqli_fetch_array($instruction_fetch)) {
echo "<tr><td>".$no."</td><td>" .$result["instructions"]."</td> <td>
         <a href='#editQuestion' role='button' class='btn' data-toggle='modal'>Edit</a> </td>
         <td><button class='btn'>Delete</button> </td></tr>";
$no++;
 }}
?>
        
        </table>       </div>
        
   <div id="editQuestion" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                 <h3 id="myModalLabel">Edit Question</h3>
                 Question Text<input type="text"><br>
                 Question Weight<input type="text"><br>
                  Set Category  
                 
  <select>
  <option >Category 1</option>
  <option >Category 2</option>
  <option >Category 3</option>
  </select><br>
  
  
  
  
     
  <h4>Edit Answers</h4><br>
  <p>Text         Value        Delete</p>
  <div>
  <?php
  $query1= "SELECT * FROM qvalues WHERE question_id=1";
  $fetch1=mysqli_query($con,$query1);
  while($result1 = mysqli_fetch_array($fetch1)) {
      echo " <input type='text' value='".$result1["qv_text"]."'> <input type='text'
    value='".$result1["qv_value"]."'>
    <button class='btn'>Delete</button>";}
  ?>
      <br>
     <button class='btn'>add</button> 
     <br>
         <button class='btn btn-primary'>OK</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
          </div>
  </div>     
            
       
    </body>
    
</html>