var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};



$(document).ready(function(){

	
	
var groupId = 16;

	$(document).on('click','#gravatar',function(){
     $.ajax({
     	async:false,
     	url:"./server/controller.php",
        method:"POST",
        datatype:"text",
        data:{"gravatar":"gravatar"},
        success:function(data){
        	console.log(data);
        	ShowAll(groupId);
        }
     });
	});

	$(document).on('click','.searchUsers',function(){
		if($('.searchDiv').hasClass('col-sm-3'))
		{
		$('.searchDiv').removeClass('col-sm-3');
        $('.content').removeClass('col-sm-7');
        $('.content').addClass('col-sm-10');
		}else{
        $('.searchDiv').addClass('col-sm-3');
        $('.content').removeClass('col-sm-10');
        $('.content').addClass('col-sm-7');
    }

	});

	$("#profile_image").change(function () {
	//console.log("Hello");
    filePreview(this);
    });
	    $("#upload_file").change(function () {
	    	var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
         if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) != -1) {
	    //console.log("Hello");
        ImagePreview(this);
    }
        });
    
function ImagePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            //$('#uploadForm + img').remove();
            $('#preview_image').html('<img src="'+e.target.result+'" width="450" height="300"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            //$('#uploadForm + img').remove();
            $('#preview_profile').html('<img src="'+e.target.result+'" width="450" height="300"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
	
	$(document).on('click','#helpPage',function(e){
        window.location.href="./help.html";
	});





 function load_data(query)
 {
 	var searchResults = "";
  $.ajax({
   url:"./server/controller.php",
   method:"POST",
   datatype:"text",
   data:{"query":query},
   success:function(data)
   {
   	var obj = JSON.parse(data);

   	obj['results'].forEach(function(e){
   		searchResults+="<a class='userProfileDetails' id='"+e['user_id']+"'>"+e['displayName']+"</a><br>";

   	});
    
    $('#result').html(searchResults);
   }
  });
 }
 $('#search').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   $('#result').html("");
   load_data();
  }
 });

var group_name = $('#'+groupId).html();
		var archive_clicked = '<i id = archive_'+groupId+' class="material-icons archive green" style="cursor:pointer;margin-top: 15px;font-size: 30px;">archive</i>';
        $('#title').html(archive_clicked);
  ShowAll(groupId);

$(document).on('click','#usersModal',function(e){
	$.ajax({
  	        async:false,
    		url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"usertype":"value"},
		    success:function(data){
		    	
		    	if (data==0){
		    		console.log(data);
		    		$('.deleteUsers').hide();
		    	}
		    }
    
});
});


$.ajax({
    		async: false,
    		url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"archived_status":groupId},
		    success:function(data){
		    	var obj = JSON.parse(data);
		    	console.log(obj);
		    	var usertype = obj['usertype'];
		    	/*if(obj['userType']==0){
		    		$('#title').hide();
		    	}*/
		    	obj['archive'].forEach(function(e){
		    		console.log(e['archived_status']+usertype);
		    		if (e['archived_status']=="1" && obj['usertype']=="0"){
		    			console.log("hello");
		    			$('#messageinput_div').hide();
		    			$('.plus').addClass('disableClick');
		    			$('.minus').addClass('disableClick');
		    			$('.comment').addClass('disableClick');
		    		}else{
		    			$('#messageinput_div').show();
		    		}
		    		if(obj['usertype']=="1" && e['archived_status']=="1"){
		    			$(".archive").removeClass("green");
		    			$(".archive").addClass("red");
		    		}else{
		    			$(".archive").removeClass("red");
		    			$(".archive").addClass("green");
		    		}

		    	});
		    }
    	});
  /* $('.single_message').hide();
   var archive = '<i id = "archive_16" class="material-icons archive green" style="cursor:pointer;margin-top: 15px; font-size: 30px">archive</i>';
   $('#title').append(archive);


  $.ajax({
  	        async:false,
    		url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"archived_status":"16"},
		    success:function(data){
		    	var obj = JSON.parse(data);
		    	console.log(obj);
		    	var usertype = obj['usertype'];
		    	
		    	obj['archive'].forEach(function(e){
		    		console.log(e['archived_status']+usertype);
		    		if (e['archived_status']=="1" && obj['usertype']=="0"){
		    			console.log("hello");
		    			$('#messageinput_div').hide();
		    		}else{
		    			$('#messageinput_div').show();
		    		}
		    		if(obj['usertype']=="1" && e['archived_status']=="1"){
		    			$(".archive").removeClass("green");
		    			$(".archive").addClass("red");
		    			console.log("red");
		    		}else{
		    			$(".archive").removeClass("red");
		    			$(".archive").addClass("green");
		    			console.log("green");
		    		}

		    	});
		    }
    	});
*/

 var groupId = "16";
 NumberofUsers(groupId);
 function NumberofUsers(groupId)
 {
 $.ajax({
        	url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"numberOfUsers":groupId},
		    success:function(data){
		    	console.log(data);
		    	var count_users = JSON.parse(data);
		    	var i =0;
		    	var usersEdit = "";
		    	count_users['usersCount'].forEach(function(e){
		    		i++;
		    		usersEdit += "<div><p style='display:inline; font-size: 20px;'>"+ e['displayName'] +"</p><button style='float:right; padding: 1px;' type='button' class='btn btn-danger deleteUsers' id='"+e['user_id']+"'>Remove</button></div>";
		    	});
		    	$('#members').html(usersEdit);
		    	$('#usersinfo').html("<i data-toggle='modal' data-target='#groupMemberShip' class='fa fa-user-circle-o' style='    margin-top: 13px; font-size:25px;color:black;padding: 5px;'></i><p style='display:inline; padding: 5px;'>"+i+"</p>");

		    }
        });
}

        $(document).on('click','.deleteUsers',function(e){
 	    var delete_id = e.currentTarget.id;
 	        $.ajax({
 		        url:"./server/controller.php",
		        dataType:"text",
		        type:"post",
		        data:{"deleteUsers":delete_id},
		        success:function(data){
                    console.log(data);
                    NumberofUsers(groupId);
		        }
 	        });
 	        ratings();
        });


 //$('#'+groupId).addClass('active');

   /*$.ajax({
   	async:false, 
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"groupMessages":groupId},
		    success: function(data){
		    	var obj = JSON.parse(data);
		    	var messages = "";
		    	var messages_count =0;
		    	console.log(obj);
		    	if(obj['groupMessages']!="No Messages"){
		    		var userType = obj['userType'];
		    	    obj['groupMessages'].forEach(function(e){
		    	    	if(!(e['messages'].includes("urlImages"))){
		    	    	//console.log(e['messages'].includes("new_image.jpg"));
		    	    	messages_count++;
		    		    messages+="<div class = 'single_message'><div class ='mainMessageDiv'><img src='"+e['userimg']+"' class = 'userImage' width='40' height='40' style='display: inline-block; float:left'><p class='username'><b>"+e['displayName']+"</b><font style='";
		    		    messages+="float:right;' size = '5'>"+e['timestamp']+"</font></p><p class='message'";
		    		    messages+=">"+e['messages']+"</p></div><div class = 'reactions' id='"+e['message_id']+"''> ";
		    	    	messages+="<i id='like"+e['message_id']+"' class='fa fa-thumbs-o-up reaction plus'";
		    		    messages+=" style='font-size:24px; float:left; '></i><sub class = 'showLikes' id='likesCount_"+e['message_id']+"'>"+e['likeCount']+"</sub><i class='fa fa-thumbs-o-down reaction minus' id='dislike"+e['message_id']+"' style='font-size:24px ;margin-left:30px; float:left;'></i><sub class = 'showdisLikes' id='dislikesCount_"+e['message_id']+"'>"+e['dislikeCount']+"</sub>";
		    	        messages+="<i class='fa fa-comment-o comment' id='comment"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i><i class='fa fa-trash delete' id='"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i></div></div>";   
		    	        }
		    	        else{
		    	        	messages_count++;
		    		    messages+="<div class = 'single_message'><div class ='mainMessageDiv'><img src='"+e['userimg']+"' class = 'userImage' width='40' height='40' style='display: inline-block; float:left'><p class='username'><b>"+e['displayName']+"</b><font style='";
		    		    messages+="float:right;' size = '5'>"+e['timestamp']+"</font></p><img class='message' src='";
		    		    messages+=e['messages']+"'></p></div><div class = 'reactions' id='"+e['message_id']+"''> ";
		    	    	messages+="<i id='like"+e['message_id']+"' class='fa fa-thumbs-o-up reaction plus'";
		    		    messages+=" style='font-size:24px; float:left; '></i><sub class = 'showLikes' id='likesCount_"+e['message_id']+"'>"+e['likeCount']+"</sub><i class='fa fa-thumbs-o-down reaction minus' id='dislike"+e['message_id']+"' style='font-size:24px ;margin-left:30px; float:left;'></i><sub class = 'showdisLikes' id='dislikesCount_"+e['message_id']+"'>"+e['dislikeCount']+"</sub>";
		    	        messages+="<i class='fa fa-comment-o comment' id='comment"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i><i class='fa fa-trash delete' id='"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i></div></div>";   
		    	        }	       
		    	    });
		    	    messages+="<div class = 'container' style='text-align:center'><a id='loadMore' >Load More</a></div>";
		    	    $('#messages').append(messages);  
                    
                }else{
                	$('#messages').append("");                    
                    
                }
                $('#messagessinfo').html("<i class='fa fa-envelope' style='margin-top:13px;font-size:25px;color:black; padding: 5px;'></i><p style='display:inline'>"+messages_count+"</p>");
                
                if(messages_count <10){
                	$('#loadMore').remove();
                }
                if (userType==0){
                	$('.delete').hide();
                }
		    }
		});*/

    /*$.ajax({
    	    async:false,
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"group_id":"16"},
		    success: function(data){
		    	var obj =JSON.parse(data);
		    	if(obj['reactions']!="No reactions")
		    	obj['reactions'].forEach(function(element){	    		
				    if(element['reaction']==1){
				    	console.log(element['reaction']);
				    	$('#dislike'+element['message_id']).removeClass('fa-thumbs-down');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-o-down');
				    	$('#like'+element['message_id']).removeClass('fa-thumbs-o-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-up');
				    }else if(element['reaction']==2){
				    	console.log(element['reaction']);
				    	$('#like'+element['message_id']).removeClass('fa-thumbs-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-o-up');
				    	$('#dislike'+element['message_id']).removeClass('fa-thumbs-o-down');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-down');
				    }else if(element['reaction']==-1){
				    	console.log(element['reaction']);
				    	$('#like'+element['message_id']).removeClass('fa-thumbs-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-o-up');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-o-down');
				    	$('#dislike'+element['message_id']).removeClass('fa-thumbs-down');
				    }else if(element['reaction']==-2){
				    	console.log(element['reaction']);
				    	$('#like'+element['message_id']).removeClass('fa-thumbs-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-o-up');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-o-down');
				    	$('#dislike'+element['message_id']).removeClass('fa-thumbs-down');
				    }
			    });

		    }
		});*/


		/*$.ajax({
			async:false,
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"groupid_comments":"16"},
		    success: function(data){
		    	var obj =JSON.parse(data);
		    	var comments = "";
		    	console.log(obj);
		    	obj['comments'].forEach(function(e){
		    		comments+="<div class='comment_div'><div class='vl'></div><img src='"+e['userimg']+"' class = 'userImage' width='30' height='30' style='display: inline-block; margin-left:30px; float:left'><p class='comment_username'><b>"+e['displayName']+"</b><font style='margin-right:700px;";
		    		comments+="float:right;' size = '3'>"+e['comment_timestamp']+"</font></p><p class='comment_message'";
		    		comments+=">"+e['comment_message']+"</p></div></div>";

                    console.log(e['message_id']);
		    		$("#"+e['message_id']).append(comments);
		    		comments = "";
		    	});	

		    }

		});*/
/*
		var messages_size = $('.single_message').length;
		if (messages_size>10){
        var x=10;
        $('#messages .single_message:lt('+x+')').show();
        
        $(document).on('click','#loadMore',function(){
        x= (x+10 <= messages_size) ? x+10 : messages_size;

        $('#messages .single_message:lt('+x+')').show();
        if(x == messages_size){
        	$('#loadMore').hide();
        }
        });
        }else{
        	$('.single_message').show();
        	$('#loadMore').hide();
        }

*/





	
	/*var getparam = getUrlParameter('user_id');
	console.log(getparam);*/
	ratings();
	function ratings (){
$(document).on('click','.userProfileDetails',function(e){
	var userProfileId = e.currentTarget.id;
	var c =0;
    //var arr[] = "";
		$.ajax({
			async:false,
		    url:"./server/controller.php",
		    dataType:"text",
		    type:"get",
		    data:{"user_id":userProfileId},
		    success: function(data){
		    	console.log(data);
		    	if(data!=""){
		    	var obj =JSON.parse(data);
			
			var displayName = obj['displayName'];
			var likescount = 0, dislikescount = 0;
			var groups = "", img ="", username = "";
		    var str = "<div class = 'userProfiles container'><h2 style='text-align:center'>User Profile Details</h2><div class='card'>";
		    obj['userDetails'].forEach(function(element){
			   var groupreactionId = element['group_id'];
			   console.log(groupreactionId);
		       img = element['userimg'];
		       username = element['displayName'];
		       groups+="<p>"+element['group_name']+"</p><div class='stars-outer'><div class='stars-inner' id='stars_"+element['group_id']+"'></div>";

		    });
		    str+='<img style=" display: block; margin: auto;"src="'+img+'" alt="John" width="100" height="100" ><h3 id ="userName">'+username+'</h3>';
             str+='<div style="margin: 24px 0;">Public Groups';            
             str+='</div></div>';
             var final = str+groups+"</div>";
			$('.UserDetails').html(final);
			$('#search').val("");
			$('#result').html("");
			var messagesCountGraph = [];
			var groupNameGraph = [];
			obj['userDetails'].forEach(function(element){
			   var groupreactionId = element['group_id'];
			   var groupName = element['group_name'];
			   console.log(groupreactionId);
		       /*img = element['userimg'];
		       username = element['displayName'];
		       groups+="<p>"+element['group_name']+"</p><div class='stars-outer'><div class='stars-inner' id='stars_"+element['group_id']+"'></div>";*/
             
            $.ajax({
			async: false,
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"group_id":groupreactionId},
		    success: function(data){
		    	console.log(data);
		    	var obj =JSON.parse(data);
		    	if(obj['reactions']!="No reactions")
		    	{
		    	obj['reactions'].forEach(function(element){	    		
				    if(element['reaction']==1){
				    	likescount++;
				    	/*$('#dislike'+element['message_id']).removeClass('fa-thumbs-down');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-o-down');
				    	$('#like'+element['message_id']).removeClass('fa-thumbs-o-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-up');*/
				    }else if(element['reaction']==2){
				    	dislikescount++;
				    	/*$('#like'+element['message_id']).removeClass('fa-thumbs-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-o-up');
				    	$('#dislike'+element['message_id']).removeClass('fa-thumbs-o-down');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-down');*/
				    }
				//console.log(likescount);
			    //console.log(dislikescount);
			    
			    });

			    

		    }else{
		    	//console.log(likescount);
			    //console.log(dislikescount);
		    }

		}

	});
            if(likescount <11){
				    var finallikescount = (likescount*100)/10;
			    }else{
			    	var finallikescount = 100;
			    }

			    if(dislikescount <11){
				    var finaldislikescount = (dislikescount*100)/10;
			    }else{
			    	var finaldislikescount = 100;
			    }
			
               
			
       
       $.ajax({
			async: false,
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"numberOfUsersFormetrics":groupreactionId,"user_id":userProfileId},
		    success:function(data){
		    	var obj = JSON.parse(data);

			    obj['numberOfUsersFormetrics'].forEach(function(e){
				/*var groupIdCount = e['group_id'];
				console.log(groupIdCount);*/
                c++;
				/*if(e['count'] <11){
				    var count_group = (e['count']*100)/10;
			    }else{
			    	var count_group = 100;
			    }
                console.log(e['count']);
				$('#stars_'+groupIdCount).width(count_group+'%');*/
		    });
		}
		});
       messagesCountGraph.push(c);
       groupNameGraph.push(groupName);
       console.log(c);



// Load google charts
/*google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'GroupId');
            data.addColumn('number', 'messagePercentage');
            data.addRows([
               ['Firefox', c],
            ]);
               
            // Set chart options
            var options = {
               'title':'Browser market shares at a specific website, 2014',
               'width':550,
               'height':400,
               is3D:true
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('container'));
            chart.draw(data, options);
         }
*/






              if(c <11){
				    var count_group = (c*100)/10;
			    }else{
			    	var count_group = 100;
			    }
			    var finals = count_group*0.5+finallikescount*0.3+finaldislikescount*0.2;
			    //arr[]='#stars_'+groupreactionId;
            $('#stars_'+groupreactionId).width(finals+'%');
            likescount=0;
			dislikescount=0;
			c=0;

        });
console.log(messagesCountGraph);

 google.charts.load('current', {packages: ['corechart']}); 
function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Browser');
            data.addColumn('number', 'Percentage');
            var a= [2,3,45,2];
            for(var i =0;i<messagesCountGraph.length ; i++){

            //var x = (i/5)*100;
            data.addRow([groupNameGraph[i], messagesCountGraph[i]]);
         }
               
            // Set chart options
            var options = {
               'title':'Groups vs Messages',
               'width':400,
               'height':400,
               is3D:true
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('graphs'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawChart);

			 
    }
}


 });
		
	});
}

	var profile = "";
	$(document).on('click','#userprofile',function(e){
		$.ajax({
			async:false,
		    url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"getuserslist":"users"},
		    success: function(data){

		    	var obj =JSON.parse(data);
		    	
			    var str = '<div class="container"><h2>User Profiles</h2><div class="dropdown">';
			    str+='<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Select the User';
                str+='<span class="caret"></span></button><ul class="dropdown-menu">';
			    obj['users'].forEach(function(element){
				    str+='<li><a class="users" href="?user_id='+element['user_id']+'">'+element['displayName']+'</a></li>';
			    });
			    str+="</ul></div></div>";
			    $('#messageinput_div').empty();
			    $('.content').html(str);
		    }

		});
	});

	$('#upload').click(function(){

    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);

    // AJAX request
    $.ajax({
      url: 'ajaxupload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
      
      }
    });
  });

	/*$('#upload').click(function(){

    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);

    // AJAX request
    $.ajax({
      url: 'ajaxupload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
      
      }
    });
  });*/

var data = "0";
	$.ajax({
		async:false,
		url:"./server/controller.php",
		dataType:"text",
		type:"post",
		data:{"groupslist":data},
		success: function (data) {
			console.log(data);
			var obj =JSON.parse(data);
			console.log(obj['displayName']);
			var displayName = obj['displayName'];
            if(obj['userType']=="0"){
		    		$('.archive').hide();
		    }
			var str = "";
			var i =0;
			if (obj['groups'] !="No Groups"){
			obj['groups'].forEach(function(element){
				if(element['group_id']=="16"){
                  i++;
				}
				str += "<a class ='link' id="+element['group_id']+">#"+element['group_name']+"</a>";
			});

		    }else{
		    	/*$('#messages').hide();
		    	$('#messageinput_div').hide();
		    }*/
		    $('#grouptitle').html("No groups found");
		    $('#title').hide();
		    $('#usersinfo').hide();
		    $('#messagessinfo').hide();
		    $('#messageinput_div').hide();
		    $('#messages').hide();
			$('#groups').html(str);
			$('#name').html(displayName);
		}
		console.log(i);
		if(i ==0){
			 $('#grouptitle').html("No global group found");
		    $('#title').hide();
		    $('#usersinfo').hide();
		    $('#messagessinfo').hide();
		    $('#messageinput_div').hide();
		    $('#messages').hide();
		}
		$('#groups').html(str);
		$('#name').html(displayName);
		},
		
		error: function () { alert("groups list Error"); }
	});


		//kiran

	var data = "0";
	$.ajax({
		async:false,
		url:"./server/controller.php",
		dataType:"text",
		type:"post",
		data:{"getuserslistd":data},
		success: function (data) {
			console.log(data);
			var obj =JSON.parse(data);
			var str = "";
			obj['users'].forEach(function(element){
				//str+="<a class='link' href="?user_id='+element['user_id']+'">'+element['displayName']+'</a>";
				str+="<a class ='linkm' id="+element['user_id']+">#"+element['displayName']+"</a>";
			});

			$('#directmessages').html(str);

		}
		
		//error: function () { alert("groups list Error"); }
	});



	$(document).on('click', '.link',function(e){


        var group_id = e.currentTarget.id;
        //console.log(messages_size);
        

		$(document).on('click','.deleteUsers',function(e){
 	    var delete_id = e.currentTarget.id;
 	        $.ajax({
 		        url:"./server/controller.php",
		        dataType:"text",
		        type:"post",
		        data:{"deleteUsers":delete_id},
		        success:function(data){
                    console.log(data);
                    NumberofUsers(group_id);
                    ratings();
		        }
 	        });
        });

		var group_name = $('#'+group_id).html();
		var archive_clicked = '<i id = archive_'+group_id+' class="material-icons archive green" style="cursor:pointer;margin-top: 15px;font-size: 30px;">archive</i>';
        $('#title').html(archive_clicked);
		$(document).on('click','.archive',function(){
    		console.log(group_id);
    	});

    	

		$('#grouptitle').html(group_name);
        $('#title').show();
		    $('#usersinfo').show();
		    $('#messagessinfo').show();
		    $('#messageinput_div').show();
		    $('#messages').show();
		ShowAll(group_id);
		$.ajax({
    		async: false,
    		url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"archived_status":group_id},
		    success:function(data){
		    	var obj = JSON.parse(data);
		    	console.log(obj);
		    	var usertype = obj['usertype'];
		    	
		    	obj['archive'].forEach(function(e){
		    		console.log(e['archived_status']+usertype);
		    		if (e['archived_status']=="1" && obj['usertype']=="0"){
		    			console.log("hello");
		    			$('#messageinput_div').hide();
		    			$('.plus').addClass('disableClick');
		    			$('.minus').addClass('disableClick');
		    			$('.comment').addClass('disableClick');
		    		}else{
		    			$('#messageinput_div').show();
		    		}
		    		if(obj['usertype']=="1" && e['archived_status']=="1"){
		    			$(".archive").removeClass("green");
		    			$(".archive").addClass("red");
		    		}else{
		    			$(".archive").removeClass("red");
		    			$(".archive").addClass("green");
		    		}

		    	});
		    }
    	});
      
		
	});


//kiran//

	$(document).on('click', '.linkm',function(e){

       $('.archive').hide();
        var chatuserid = e.currentTarget.id;
        var person_name = $('#'+chatuserid).html();
        //$('#grouptitle').html(group_name);
        //console.log(messages_size);

    	

		$('#grouptitle').html(person_name);
        $('#title').show();
		    $('#usersinfo').show();
		    $('#messagessinfo').show();
		    $('#messageinput_div').show();
		    $('#messages').show();
		//$('#post_message').html("post_messaged");
		$('#post_message').attr('id', 'post_messaged');
		$('#usersinfo').html("");
		$('#messagessinfo').html("");
		//$('#messageinput_div').hide();
		//$('#addbutton').hide();
		//$('#addbutton').html("");
		//$("p").hide();
		$('.dropdown-menu').hide();
		$('#dropdownMenu2').hide();		
		ShowMessages(chatuserid);
		console.log(chatuserid);

      
		
	});

//kiran//
        

	$(document).on('click','#post_message',function(e){

        //$('.single_message').show();
        $('.single_message').hide();
	    var message = $('#send_message').val();
	       
        $.ajax({
        	async:false,
        	url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"post_message":message},
		    success: function(data){
		    var obj = JSON.parse(data);
		    	var messages = "";
		    	var messages_count=0;
		    	console.log(obj);
		    	var groupId = obj['groupId'];
		    	ShowAll(groupId);

		    	/*if(obj['groupMessages']!="No Messages"){
		    		var userType = obj['userType'];
		    	    obj['groupMessages'].forEach(function(e){

		    	    	messages_count++;
		    		    messages+="<div class = 'single_message'><div class ='mainMessageDiv'><img src='"+e['userimg']+"' class = 'userImage' width='40' height='40' style='display: inline-block; float:left'><p class='username'><b>"+e['displayName']+"</b><font style='";
		    		    messages+="float:right;' size = '5'>"+e['timestamp']+"</font></p><p class='message'";
		    		    messages+=">"+e['messages']+"</p></div><div class = 'reactions' id='"+e['message_id']+"''> ";
		    	    	messages+="<i id='like"+e['message_id']+"' class='fa fa-thumbs-o-up reaction plus'";
		    		    messages+=" style='font-size:24px'></i><i class='fa fa-thumbs-o-down reaction minus' id='dislike"+e['message_id']+"' style='font-size:24px ;margin-left:30px'></i>";
		    	        messages+="<i class='fa fa-comment-o comment' id='comment"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i><i class='fa fa-trash delete' id='"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i></div></div>";
		    	        
		    	    });
		    	    messages+="<div class = 'container' style='text-align:center'><a id='loadMore' >Load More</a></div>";
		    	    $('#messages').html(messages);
                  
                }else{
                	$('#messages').html("");
                 
                console.log(userType);
                if (userType==0){
                	$('.delete').hide();
                	$('.archive').hide();
                }*/
		    }
        });

        var messages_size = $('.single_message').length;
		if (messages_size>10){
        var x=10;
        $('#messages .single_message:lt('+x+')').show();
        
        $(document).on('click','#loadMore',function(){
        x= (x+10 <= messages_size) ? x+10 : messages_size;

        $('#messages .single_message:lt('+x+')').show();
        if(x == messages_size){
        	$('#loadMore').hide();
        }
        });
        }else{
        	$('.single_message').show();
        	$('#loadMore').hide();
        }
        $('#send_message').val("")
        ratings();

	});


	//kiran


	$(document).on('click','#post_messaged',function(e){

        //$('.single_message').show();
        $('.single_message').hide();
	    var message = $('#send_message').val();
	       
        $.ajax({
        	async:false,
        	url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"post_messaged":message},
		    success: function(data){
		    var obj = JSON.parse(data);
		    	var messages = "";
		    	var messages_count=0;
		    	console.log(obj);
		    	var chatId = obj['chatId'];
		    	ShowMessages(chatId);
		    }
        });

        var messages_size = $('.single_message').length;
		if (messages_size>10){
        var x=10;
        $('#messages .single_message:lt('+x+')').show();
        
        $(document).on('click','#loadMore',function(){
        x= (x+10 <= messages_size) ? x+10 : messages_size;

        $('#messages .single_message:lt('+x+')').show();
        if(x == messages_size){
        	$('#loadMore').hide();
        }
        });
        }else{
        	$('.single_message').show();
        	$('#loadMore').hide();
        }
        $('#send_message').val("")
        ratings();

	});


//kiran


	$(document).on('click','.reaction',function(e){
		var reaction_id = e.currentTarget.id;
		var reactionId = reaction_id.split("_");
		var reaction =0;
		var messageId = $('#'+reaction_id).closest("div").prop("id");
		var likes = 0,dislikes = 0;
		console.log(messageId);
		$.ajax({
			async:false,
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{'reactionCount':messageId},
		    success: function(data){
		    	console.log(data);
		    	var count = JSON.parse(data);
		    	count['reactionCount'].forEach(function(e){
		    		 likes = parseInt(e['likeCount']);
		    		 dislikes = parseInt(e['dislikeCount']);
		    	});
		    	//console.log(typeof(likes));
		    }

		});

		    if ( $(this).hasClass( "fa-thumbs-o-up" ) ) 
		    {
		    	    reaction = 1;
		    	    likes = likes + 1;
		    	    if($('#dislike'+messageId).hasClass("fa-thumbs-down")){
		    	     	dislikes = dislikes - 1;
		    	    }
		    	}else if($(this).hasClass( "fa-thumbs-up" )){
                    reaction = -1;
                    likes = likes - 1;
		    	}
		    if( $( this ).hasClass( "fa-thumbs-o-down" ) ) {
		    	reaction = 2;
		    	dislikes = dislikes+1;
		    	if($('#like'+messageId).hasClass("fa-thumbs-up")){
		    	     	likes = likes -1;
		    	     }
		    }else if($(this).hasClass( "fa-thumbs-down" )){
		    	reaction = -2;
		    	dislikes = dislikes -1;
		    }
		    console.log(likes);
		    console.log(dislikes);


		$.ajax({
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"message_id":messageId,"reactions":reaction,"likes":likes,"dislikes":dislikes},
		    success: function(data){
		    	if (reaction ==1){
		    		$('#dislike'+messageId).removeClass('fa-thumbs-down');
				    $('#dislike'+messageId).addClass('fa-thumbs-o-down');
				    $('#like'+messageId).removeClass('fa-thumbs-o-up');
				    $('#like'+messageId).addClass('fa-thumbs-up');
				    console.log("#likesCount_"+messageId);
				    
		    	}else if(reaction ==-1){
		    		$('#dislike'+messageId).removeClass('fa-thumbs-down');
				    $('#dislike'+messageId).addClass('fa-thumbs-o-down');
				    $('#like'+messageId).removeClass('fa-thumbs-up');
				    $('#like'+messageId).addClass('fa-thumbs-o-up');
				    //$("#likesCount_"+messageId).html(likes-1);
		    	} 
		    	if(reaction ==2){
		    		$('#like'+messageId).removeClass('fa-thumbs-up');
				    $('#like'+messageId).addClass('fa-thumbs-o-up');
				    $('#dislike'+messageId).removeClass('fa-thumbs-o-down');
				    $('#dislike'+messageId).addClass('fa-thumbs-down');
				    //$("#dislikesCount_"+messageId).html(dislikes+1);
		    	}else if(reaction ==-2){
		    		$('#like'+messageId).removeClass('fa-thumbs-up');
				    $('#like'+messageId).addClass('fa-thumbs-o-up');
				    $('#dislike'+messageId).removeClass('fa-thumbs-down');
				    $('#dislike'+messageId).addClass('fa-thumbs-o-down');
				    //$("#dislikesCount_"+messageId).html(dislikes-1);
		    	}
		    	$("#likesCount_"+messageId).html(likes);
				$("#dislikesCount_"+messageId).html(dislikes);
			    console.log(data);			 
		    }
		});
		ratings();
	});


	$(document).on('click','.comment',function(e){
		var comment_id = e.currentTarget.id;
		var reaction =0;
		var messageId = $('#'+comment_id).closest("div").prop("id");
		var comment = "";
		comment+="<div id='comment_input"+messageId+"'><input type='text' placeholder='Comment here'  name='comment' id='comment_"+messageId+"'/><button type='button' class='submit_comment' id='"+messageId+"'>comment</button></div>";
		$("#"+messageId).append(comment);


	});

    $(document).on('click','.submit_comment',function(e){
    	var messageId = e.currentTarget.id;
    	var comment = $('#comment_'+messageId).val();
    	console.log(comment);
    	console.log(messageId);
    	$.ajax({
    		async:false,
    		url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"messageId":messageId,"comment":comment},
		    success: function(data){
		        var obj =JSON.parse(data);
		    	var comments = "";
		    	console.log(data);
		    	var groupId = obj['groupId'];
		    	obj['comments'].forEach(function(e){
		    		comments+="<div class = 'list_comments'><p class='comment_username'><b>"+e['displayName']+"</b><font style='margin-right:800px;";
		    		comments+="float:right;' size = '3'>"+e['comment_timestamp']+"</font></p><p class='comment_message'";
		    		comments+=">"+e['comment_message']+"</p></div>";

                    console.log(e['message_id']);
                    $('.list_comments').empty();
                    $('#comment_input'+e['message_id']).empty();
		    		$("#"+e['message_id']).append(comments);
		    		comments = "";
		    	});	
		    	ShowAll(groupId);

		    }
    	});

    	

    });


    $(document).on('click','.delete',function(e){
    	var messageId_delete = e.currentTarget.id;
    	console.log(messageId_delete);
    	$.ajax({
    		url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"deleteMessage":messageId_delete},
		    success:function(data){
		    	//console.log(data);
		    }
    	})

    });



    //create group modal

   /*$(document).on('click','#newUsers',function(){*/
    	$.ajax({
    		url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"newGroupUsers":"users"},
		    success:function(data){
		    	var obj =JSON.parse(data);
		    	console.log(data);
		    	var newUsers = "";
		    	obj['newUsers'].forEach(function(e){
		    		newUsers+="<input type='checkbox' name='multipleinvitees1[]' value= "+e['user_id']+">"+e['displayName']+"<br>";
		    	});
		    	$('#usersCheckBox').append(newUsers);
		    }

    	});


    	$(document).on('click','.archive',function(e){
    		var archive_id = e.currentTarget.id;
    		console.log($('#'+archive_id).attr('class'));
    		var res = archive_id.split("_");
    		var archive_value = "";
    		if($('#'+archive_id).hasClass("green")){
    			$(".archive").removeClass("green");
		        $(".archive").addClass("red");
		        archive_value=1;


    		}else{
    			$(".archive").removeClass("red");
		    	$(".archive").addClass("green");
		    	archive_value=0;

    		}
    		console.log(res[1]);
    		$.ajax({
    			url:"./server/controller.php",
		        dataType:"text",
		        type:"post",
		        data:{"archive_id":res[1],"archive_value":archive_value},
		        success:function(data){
		        	console.log(data);
		        }
    		});
    	});

    	$(document).on('click','image_submit',function(e){

              $.ajax({
        	    url:"./server/controller.php",
		        dataType:"text",
		        type:"post",
		        datatype:{"imageupload":"image"},
		        success:function(data){
		        	console.log(data);
		        }
    	});
          });



$(document).on('click','#codeInsert',function(e){
   var code = $('#codesnippet').val();
        $.ajax({
        	async:false,
        	url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"code":code,"codetext":"1"},
		    success: function(data){
		    	console.log(data);
		    var obj = JSON.parse(data);
		    	var messages = "";
		    	var messages_count=0;
		    	console.log(obj);
		    	var group_id = obj['groupId'];
		    	ShowAll(group_id);
		    }
        });
    });

//kiran


function ShowMessages(chatuserid){

	$('.single_message').hide();

		

	    $.ajax({
			async: false,
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"directMessages":chatuserid},
		    success: function(data){
		    	var obj = JSON.parse(data);
		    	var messages = "";
		    	var messages_count=0;
		    	console.log(obj);
		    	if(obj['directMessages']!="No Messages"){
		    		var userType = obj['userType'];
		    		console.log(userType);
		    	    obj['directMessages'].forEach(function(e){

		    		    messages+="<div class = 'single_message'><div class ='mainMessageDiv'><img src='"+e['userimg']+"' class = 'userImage' width='40' height='40' style='display: inline-block; float:left'><p class='username'><b>"+e['displayName']+"</b><font style='";
		    		    messages+="float:right;' size = '5'>"+e['timestamp']+"</font></p><p class='message'";
		    		    messages+=">"+e['message']+"</p></div></div>";   
		    	        	       
		    	    });
		    	    messages+="<div class = 'container' style='text-align:center'><a id='loadMore' >Load More</a></div>";
		    	    $('#messages').html(messages);
                    $('.linkm').removeClass('active'); 
                    //$('#'+group_id).addClass('active');
                }else{
                	$('#messages').html("");
                    $('.linkm').removeClass('active'); 
                    //$('#'+group_id).addClass('active');
                }
                //$('#messagessinfo').html("<i class='fa fa-envelope' style='margin-top:13px;font-size:25px;color:black; padding: 5px;'></i><p style='display:inline'>"+messages_count+"</p>");
                /*if(messages_count <10){
                	$('#loadMore').remove();
                }*/

                

		    }

		});

		//$('.single_message:lt(10)').show();



		var messages_size = $('.single_message').length;
		if (messages_size>10){
        var x=10;
        $('#messages .single_message:lt('+x+')').show();
        
        $(document).on('click','#loadMore',function(){
        x= (x+10 <= messages_size) ? x+10 : messages_size;

        $('#messages .single_message:lt('+x+')').show();
        if(x == messages_size){
        	$('#loadMore').hide();
        }
        });
        }else{
        	$('.single_message').show();
        	$('#loadMore').hide();
        }
}





//kiran

function ShowAll(group_id){

	$('.single_message').hide();

		
        



		$.ajax({
        	url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"numberOfUsers":group_id},
		    success:function(data){
		    	console.log(data);
		    	var count_users = JSON.parse(data);
		    	var i =0;
		    	var usersEdit = "";
		    	count_users['usersCount'].forEach(function(e){
		    		i++;
		    		usersEdit += "<div><p style='display:inline; font-size: 20px;'>"+ e['displayName'] +"</p><button style='float:right; padding: 1px;' type='button' class='btn btn-danger deleteUsers' id='"+e['user_id']+"'>Remove</button></div>";
		    	});



		    	console.log(usersEdit);
		    	$('#members').html(usersEdit);
		    	$('#usersinfo').html("<i data-toggle='modal' id='usersModal' data-target='#groupMemberShip' class='fa fa-user-circle-o' style='    margin-top: 13px; font-size:25px;color:black;padding: 5px;'></i><p style='display:inline; padding: 5px;'>"+i+"</p>");

		    }
        });

	    $.ajax({
			async: false,
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"groupMessages":group_id},
		    success: function(data){
		    	console.log(data);
		    	var obj = JSON.parse(data);
		    	var messages = "";
		    	var messages_count=0;
		    	console.log(obj);
		    	if(obj['groupMessages']!="No Messages"){
		    		var userType = obj['userType'];
		    		console.log(userType);
		    	    obj['groupMessages'].forEach(function(e){
		    	    	console.log(e['codeText']);
		    	    	if(e['codeText']=="1"){
		    	        messages_count++;
		    		    messages+="<div class = 'single_message'><div class ='mainMessageDiv'><img src='"+e['userimg']+"' class = 'userImage' width='40' height='40' style='display: inline-block; float:left'><p class='username'><b>"+e['displayName']+"</b><font style='";
		    		    messages+="float:right;' size = '5'>"+e['timestamp']+"</font></p><pre class='message'";
		    		    messages+=">"+e['messages']+"</pre></div><div class = 'reactions' id='"+e['message_id']+"''> ";
		    	    	messages+="<i id='like"+e['message_id']+"' class='fa fa-thumbs-o-up reaction plus'";
		    		    messages+=" style='font-size:24px; float:left; '></i><sub class = 'showLikes' id='likesCount_"+e['message_id']+"'>"+e['likeCount']+"</sub><i class='fa fa-thumbs-o-down reaction minus' id='dislike"+e['message_id']+"' style='font-size:24px ;margin-left:30px; float:left;'></i><sub class = 'showdisLikes' id='dislikesCount_"+e['message_id']+"'>"+e['dislikeCount']+"</sub>";
		    	        messages+="<i class='fa fa-comment-o comment' id='comment"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i><i class='fa fa-trash delete' id='"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i></div></div>";
		    	        }else if((e['messages'].includes("urlImages"))){
		    	    	//console.log(e['messages'].includes("new_image.jpg"));
                        messages_count++;
		    		    messages+="<div class = 'single_message'><div class ='mainMessageDiv'><img src='"+e['userimg']+"' class = 'userImage' width='40' height='40' style='display: inline-block; float:left'><p class='username'><b>"+e['displayName']+"</b><font style='";
		    		    messages+="float:right;' size = '5'>"+e['timestamp']+"</font></p><img class='message' src='";
		    		    messages+=e['messages']+"'></p></div><div class = 'reactions' id='"+e['message_id']+"''> ";
		    	    	messages+="<i id='like"+e['message_id']+"' class='fa fa-thumbs-o-up reaction plus'";
		    		    messages+=" style='font-size:24px; float:left; '></i><sub class = 'showLikes' id='likesCount_"+e['message_id']+"'>"+e['likeCount']+"</sub><i class='fa fa-thumbs-o-down reaction minus' id='dislike"+e['message_id']+"' style='font-size:24px ;margin-left:30px; float:left;'></i><sub class = 'showdisLikes' id='dislikesCount_"+e['message_id']+"'>"+e['dislikeCount']+"</sub>";
		    	        messages+="<i class='fa fa-comment-o comment' id='comment"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i><i class='fa fa-trash delete' id='"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i></div></div>";
		    	    	
		    	        }else if((e['messages'].includes("files"))){
		    	    	//console.log(e['messages'].includes("new_image.jpg"));
                        var myString = e['messages'].substr(e['messages'].indexOf("files/") + 6);
		    	    	messages_count++;
		    		    messages+="<div class = 'single_message'><div class ='mainMessageDiv'><img src='"+e['userimg']+"' class = 'userImage' width='40' height='40' style='display: inline-block; float:left'><p class='username'><b>"+e['displayName']+"</b><font style='";
		    		    messages+="float:right;' size = '5'>"+e['timestamp']+"</font></p><a class='message' href='"+e['messages']+"'";
		    		    messages+="download>"+myString+"</a></div><div class = 'reactions' id='"+e['message_id']+"''> ";
		    	    	messages+="<i id='like"+e['message_id']+"' class='fa fa-thumbs-o-up reaction plus'";
		    		    messages+=" style='font-size:24px; float:left; '></i><sub class = 'showLikes' id='likesCount_"+e['message_id']+"'>"+e['likeCount']+"</sub><i class='fa fa-thumbs-o-down reaction minus' id='dislike"+e['message_id']+"' style='font-size:24px ;margin-left:30px; float:left;'></i><sub class = 'showdisLikes' id='dislikesCount_"+e['message_id']+"'>"+e['dislikeCount']+"</sub>";
		    	        messages+="<i class='fa fa-comment-o comment' id='comment"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i><i class='fa fa-trash delete' id='"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i></div></div>"; 
		    	        }else {
		    	        	messages_count++;
		    		    messages+="<div class = 'single_message'><div class ='mainMessageDiv'><img src='"+e['userimg']+"' class = 'userImage' width='40' height='40' style='display: inline-block; float:left'><p class='username'><b>"+e['displayName']+"</b><font style='";
		    		    messages+="float:right;' size = '5'>"+e['timestamp']+"</font></p><p class='message'";
		    		    messages+=">"+e['messages']+"</p></div><div class = 'reactions' id='"+e['message_id']+"''> ";
		    	    	messages+="<i id='like"+e['message_id']+"' class='fa fa-thumbs-o-up reaction plus'";
		    		    messages+=" style='font-size:24px; float:left; '></i><sub class = 'showLikes' id='likesCount_"+e['message_id']+"'>"+e['likeCount']+"</sub><i class='fa fa-thumbs-o-down reaction minus' id='dislike"+e['message_id']+"' style='font-size:24px ;margin-left:30px; float:left;'></i><sub class = 'showdisLikes' id='dislikesCount_"+e['message_id']+"'>"+e['dislikeCount']+"</sub>";
		    	        messages+="<i class='fa fa-comment-o comment' id='comment"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i><i class='fa fa-trash delete' id='"+e['message_id']+"' style='font-size:24px; margin-left:30px'></i></div></div>";      
		    	        }	       
		    	    });
		    	    messages+="<div class = 'container' style='text-align:center'><a id='loadMore' >Load More</a></div>";
		    	    $('#messages').html(messages);
                    $('.link').removeClass('active'); 
                    $('#'+group_id).addClass('active');
                }else{
                	$('#messages').html("");
                    $('.link').removeClass('active'); 
                    $('#'+group_id).addClass('active');
                }
                $('#messagessinfo').html("<i class='fa fa-envelope' style='margin-top:13px;font-size:25px;color:black; padding: 5px;'></i><p style='display:inline'>"+messages_count+"</p>");
                /*if(messages_count <10){
                	$('#loadMore').remove();
                }*/
                if (userType=="0"){
                	//console.log(userType);
                	$('.delete').hide();
                	$('.archive').hide();
                	//$('#usersModal').removeAttr("data-toggle");
                }
                

		    }

		});

		//$('.single_message:lt(10)').show();



		$.ajax({
			async: false,
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"group_id":group_id},
		    success: function(data){
		    	console.log(data);
		    	var obj =JSON.parse(data);
		    	if(obj['reactions']!="No reactions")
		    	obj['reactions'].forEach(function(element){	    		
				    if(element['reaction']==1){
				    	console.log(element['reaction']);
				    	$('#dislike'+element['message_id']).removeClass('fa-thumbs-down');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-o-down');
				    	$('#like'+element['message_id']).removeClass('fa-thumbs-o-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-up');
				    }else if(element['reaction']==2){
				    	console.log(element['reaction']);
				    	$('#like'+element['message_id']).removeClass('fa-thumbs-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-o-up');
				    	$('#dislike'+element['message_id']).removeClass('fa-thumbs-o-down');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-down');
				    }else if(element['reaction']==-1){
				    	console.log(element['reaction']);
				    	$('#like'+element['message_id']).removeClass('fa-thumbs-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-o-up');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-o-down');
				    	$('#dislike'+element['message_id']).removeClass('fa-thumbs-down');
				    }else if(element['reaction']==-2){
				    	console.log(element['reaction']);
				    	$('#like'+element['message_id']).removeClass('fa-thumbs-up');
				    	$('#like'+element['message_id']).addClass('fa-thumbs-o-up');
				    	$('#dislike'+element['message_id']).addClass('fa-thumbs-o-down');
				    	$('#dislike'+element['message_id']).removeClass('fa-thumbs-down');
				    }
			    });

		    }
		});


		$.ajax({
			async: false,
			url:"./server/controller.php",
		    dataType:"text",
		    type:"post",
		    data:{"groupid_comments":group_id},
		    success: function(data){
		    	var obj =JSON.parse(data);
		    	var comments = "";
		    	console.log(obj);
		    	obj['comments'].forEach(function(e){
		    		comments+="<div class='comment_div'><div class='vl'></div><img src='"+e['userimg']+"' class = 'userImage' width='30' height='30' style='display: inline-block; margin-left:30px; float:left'><p class='comment_username'><b>"+e['displayName'];
		    		comments+="</b></p><p class='comment_message'";
		    		comments+=">"+e['comment_message']+"</p></div></div>";

                    console.log(e['message_id']);
		    		$("#"+e['message_id']).append(comments);
		    		comments = "";
		    	});	

		    }

		});
		var messages_size = $('.single_message').length;
		if (messages_size>10){
        var x=10;
        $('#messages .single_message:lt('+x+')').show();
        
        $(document).on('click','#loadMore',function(){
        x= (x+10 <= messages_size) ? x+10 : messages_size;

        $('#messages .single_message:lt('+x+')').show();
        if(x == messages_size){
        	$('#loadMore').hide();
        }
        });
        }else{
        	$('.single_message').show();
        	$('#loadMore').hide();
        }
}

});
