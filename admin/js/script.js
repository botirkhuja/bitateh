




$("#logout").click(function(){
  $.ajax({url:"../api/data/logout.php",success:function(result){
     
     if(result){
     	 window.location='../index.php';
     }
  
  }});
});

$(".action").addClass("text-center");
