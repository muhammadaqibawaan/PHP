tinymce.init({selector:'textarea'});


function selectAll(){
				var items=document.querySelectorAll('.checkBoxArray');
				for(var i=0; i<items.length; i++){
					if(items[i].type=='checkbox')
						items[i].checked=true;
				}
	}

  function unselectAll(){
          var items=document.querySelectorAll('.checkBoxArray');
          for(var i=0; i<items.length; i++){
            if(items[i].type=='checkbox')
              items[i].checked=false;
          }
    }

// $(document).ready(function(){
// 	// alert('Yes');
// 	var div_box = "<div id='load-screen'> <div id='loading'>  </div></div>";
// 	$("body").prepend(div_box);
// 	$('#load-screen').delay(7000).fadeOut(600, function(){
// 		$(this).remove();
// 	})
//


// function getUserOnline(){
// 	$.get('../functions.php?onlineusers=result', function(data){
// 		$(".useronline").text(data);
// 	});
// }
//
// setInterval(function(){
//
// 	getUserOnline();
//
// },500)
//
// });
