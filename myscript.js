$("button#submit").click(function() {
    if($("#username").val() == "" || $("#password").val() == "")
         $("div.display").html ("Please enter username and passoword");
    else
        $.post( $("#loginForm").attr("action"),
        $("#loginForm : input").serializeArray(),
        function(data){
         $("div#display").html(data);   
         });
       
   $("#loginForm").submit (function(){
       return false;
   });
   
});