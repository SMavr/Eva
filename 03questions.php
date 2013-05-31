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
        
        <table class="table table-hover">
            <tr><th>Text</th><th>Category/Number</th><th>Question Weight</th></th><th>Edit</th><th>Delete</th></tr>
        <?php
    include_once ('evform.php');
    $query= "SELECT * FROM question,category WHERE category_id=cid";
    $fetch=mysqli_query($con,$query) or die ('could no connect with instructions');
   
 while($result = mysqli_fetch_array($fetch)) {
echo "<tr><td>".$result["qtext"]."</td><td>" .$result["ctitle"]."</td>
    <td>" .$result["qweight"]."</td> <td>
         <a href='#editQuestion' role='button' class='btn' data-toggle='modal'>Edit</a> </td>
         <td><button class='btn'>Delete</button> </td></tr>";
}
    
 
?>
        
            
        
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
    value='" .$result1["qv_value"]."'>
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