$(document).ready(function(e){
  $(".comment_form").on('submit',(function(e){
		e.preventDefault();
	$.ajax({
		url: "server.php",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
	success: function(response){
		$('#name').val('');
		$('#last_name').val('');
		$('#photo').val('');
        $('#comment').val('');
        $('#display_area').append(response);
	},
		error: function(){} 	        
		});
		}));
		
  // delete from database
  $(document).on('click', '.delete', function(){
  	var id = $(this).data('id');
  	$clicked_btn = $(this);
  	$.ajax({
  	  url: 'server.php',
  	  type: 'GET',
  	  data: {
    	'delete': 1,
    	'id': id,
      },
      success: function(response){
        // remove the deleted comment
        $clicked_btn.parent().remove();
        $('#name').val('');
		$('#last_name').val('');
        $('#comment').val('');
      }
  	});
  });
  var edit_id;
  var $edit_comment;
  $(document).on('click', '.edit', function(){
  	edit_id = $(this).data('id');
  	$edit_comment = $(this).parent();
  	// grab the comment to be editted
  	var name = $(this).siblings('.display_name').text();
	var last_name = $(this).siblings('.display_name1').text();
	var photo = $(this).siblings('.photo').text();
  	var comment = $(this).siblings('.comment_text').text();
  	// place comment in form
  	$('#name').val(name);
	$('#last_name').val(last_name);
	$('#photo').val(photo);
  	$('#comment').val(comment);
  	$('#submit_btn').hide();
  	$('#update_btn').show();
  });
  $(document).on('click', '#update_btn', function(){
  	var id = edit_id;
  	var name = $('#name').val();
	var last_name = $('#last_name').val();
	var photo = $('#photo').val();
  	var comment = $('#comment').val();
  	$.ajax({
      url: 'server.php',
      type: 'POST',
      data: {
      	'update': 1,
      	'id': id,
      	'name': name,
		'last_name':last_name,
      	'comment': comment,
      },
      success: function(response){
      	$('#name').val('');
      	$('#comment').val('');
		$('#last_name').val('');
      	$('#submit_btn').show();
      	$('#update_btn').hide();
      	$edit_comment.replaceWith(response);
      }
  	});		
  });
});