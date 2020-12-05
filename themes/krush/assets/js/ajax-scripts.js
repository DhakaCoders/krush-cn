(function($) {
var num_1 = $("#ajax-post #ajax-content").find("div.ks-blog-grid-item").length;
if ( num_1 <= 0 ) {
  $("#cbv-ajax-btn-1").hide();
  $("#ajax-post div.ks-blog-grid-item-wrp").html('<div class="no-results"><p>No Results.</p></div>');
}else if(  num_1 < 4 ){
	$("#cbv-ajax-btn-1").hide();	
}

// for video
var num_2 = $("#video-post #ajax-content2").find("li").length;
if ( num_2 <= 0 ) {
  $("#cbv-ajax-btn-2").hide();
  $("#video-post #video-post-wrapp").html('<div class="no-results"><p>No Results.</p></div>');
}else if(  num_2 < 4 ){
	$("#cbv-ajax-btn-2").hide();	
}

//onclick
$("#loadMore").on('click', function(e) {
	e.preventDefault();
	//init
	var that = $(this);
	var page = $(this).data('page');
	var newPage = page + 1;
	var ajaxurl = that.data('url');
	
	//ajax call
	$.ajax({
	    url: ajaxurl,
	    type: 'post',
	    data: {
	        page: page,
	        action: 'ajax_script_load_more'
	
	    },
	    beforeSend: function ( xhr ) {
	      $('#ajxaloader1').show();
	    },
	    error: function(response) {
	        console.log(response);
	    },
	    success: function(response) {
	        //check
	        if (response == 0) {
	            $('#ajxaloader1').hide();
	            $('#loadMore').hide();
	        } else {
	            
	            $('#ajxaloader1').hide();
	            that.data('page', newPage);
	            $('#ajax-content').append(response.substr(response.length-1, 1) === '0'? response.substr(0, response.length-1) : response);
	        }
	    }
	});
});



//onclick
$("#videoLoadMore").on('click', function(e) {
	e.preventDefault();
	//init
	var that = $(this);
	var page2 = $(this).data('page2');
	var newPage2 = page2 + 1;
	var ajaxurl = that.data('url');

	//ajax call
	$.ajax({
	    url: ajaxurl,
	    type: 'post',
	    data: {
	        page: page2,
	        action: 'ajax_script_load_more_video'
	
	    },
	    beforeSend: function ( xhr ) {
	      $('#ajxaloader2').show();
	    },
	    error: function(response) {
	        console.log(response);
	    },
	    success: function(response) {
	        //check
	        if (response == 0) {
	            $('#videoLoadMore').hide();
	            $('#ajxaloader2').hide();
	        } else {
	            $('#ajxaloader2').hide();
	            that.data('page2', newPage2);
	            $('#ajax-content2').append(response.substr(response.length-1, 1) === '0'? response.substr(0, response.length-1) : response);
	        }
	    }
	});
});
})(jQuery);