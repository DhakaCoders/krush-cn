(function($) {
var num_1 = $("#ajax-post #ajax-content").find("div.ks-blog-grid-item").length;
if(  num_1 < 4 ){
	$("#cbv-ajax-btn-1").hide();	
}

// for video
var num_2 = $("#video-post #ajax-content2").find("li").length;
if(  num_2 < 4 ){
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
	console.log(newPage);
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


if($('#page_count').length){
	var canBeLoaded = true; // this param allows to initiate the AJAX call only if necessary
	var bottomOffset = 800; // the distance (in px) from the page bottom when you want to load more posts

	$(window).scroll(function(){
	if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ){
		//init

		var archive = $('#page_count');
		var page3 = archive.data('page3');
		var newPage3 = page3 + 1;
		var ajaxurl = archive.data('url');
		$.ajax({
		    url: ajaxurl,
		    type: 'post',
		    data: {
		        page: page3,
		        action: 'ajax_load_more_archive_product'
		
		    },
		    beforeSend: function ( xhr ) {
		      $('#ajxaloader3').show();
		      canBeLoaded = false; 
		    },
		    error: function(response) {
		        console.log(response);
		    },
			success:function(response){
		        if (response == 0) {
		            $('#ajxaloader3').hide();
		        } else {
		            $('#ajxaloader3').hide();
		            archive.data('page3', newPage3);
		            $('#archive-products').append(response.substr(response.length-1, 1) === '0'? response.substr(0, response.length-1) : response);
		        	canBeLoaded = true;
		        }
			}
		});
	}
	});
}

if($('#cat_page_count').length){
	var catCanBeLoaded = true; // this param allows to initiate the AJAX call only if necessary
	var catBottomOffset = 800; // the distance (in px) from the page bottom when you want to load more posts

	$(window).scroll(function(){
	if( $(document).scrollTop() > ( $(document).height() - catBottomOffset ) && catCanBeLoaded == true ){
		//init
		var term_id = $('#ajax-cat').data('cat_id');
		var cat = $('#cat_page_count');
		var page4 = cat.data('page4');
		var newPage4 = page4 + 1;
		var ajaxurl = cat.data('url');
		$.ajax({
		    url: ajaxurl,
		    type: 'post',
		    data: {
		        page: page4,
		        term_id: term_id,
		        action: 'ajax_load_more_cat_product'
		
		    },
		    beforeSend: function ( xhr ) {
		      $('#ajxaloader4').show();
		      catCanBeLoaded = false; 
		    },
		    error: function(response) {
		        console.log(response);
		    },
			success:function(response){
		        if (response == 0) {
		            $('#ajxaloader4').hide();
		        } else {
		            $('#ajxaloader4').hide();
		            cat.data('page4', newPage4);
		            $('#cat-products').append(response.substr(response.length-1, 1) === '0'? response.substr(0, response.length-1) : response);
		        	catCanBeLoaded = true;
		        }
			}
		});
	}
	});
}
})(jQuery);