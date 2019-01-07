$(document).ready(function () {

  
/*$(document).ready(function(){
    $("input").keypress(function(){
        $("#error").text("");
        $("#error1").text("");
    });
});*/


$(document).on('click','#submit',function(e){
   e.preventDefault();

    var email = $('#email').val();
    var password = $('#password').val();
    if(email == "" && password == ""){
      var error = "Please Enter your Email and Password"
      $('#error').text(error); 
      $("#error1").text("");
      return false;
    }else if (email ==""){
      var error = " Please Enter your Email";
       $('#error').text(error);
       $("#error1").text("");  
       return false;   
    }
    else if(password ==""){
      var error = "Please Enter your Password";
       $('#error').text(error);
       $("#error1").text(""); 
       return false;
    } 

   var logindata = $('#loginForm').serializeArray();
         var data = {};
         $(logindata).each(function(index,object){
         	data[object.name] = object.value;
         });


        $.ajax({
        async:false,
        url: './server/controller.php',
        type: 'post',
        data: {'login':data},
        dataType: 'text',
        success: function (data) {
           console.log(data);
            var obj = JSON.parse(data);
        	   
                if (obj['data']=="nodata"){
                    $("#error").html('Invalid email or password!');
                }
                else
                {
                    
                    console.log(data);
                    window.location.href = './index1.php'                       
                }
        }
    });
});

});