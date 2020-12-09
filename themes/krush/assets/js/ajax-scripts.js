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
		var term_color = $('#ajax-archive').data('color');
		var term_material = $('#ajax-archive').data('material');
		var term_width = $('#ajax-archive').data('width');
		var keyword = $('#ajax-archive').data('keyword');
		var archive = $('#page_count');
		var page3 = archive.data('page3');
		var newPage3 = page3 + 1;
		var ajaxurl = archive.data('url');
		$.ajax({
		    url: ajaxurl,
		    type: 'post',
		    data: {
		        page: page3,
		        pa_color: term_color,
		        pa_material: term_material,
		        pa_width: term_width,
		        keyword: keyword,
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
		        	$('#archive-products').append('<div class="clearfix"></div><div class="text-center"><p>No more products to load.</p></div>');
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
		var term_color_1 = $('#ajax-cat').data('color');
		var term_material_1 = $('#ajax-cat').data('material');
		var term_width_1 = $('#ajax-cat').data('width');
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
		        pa_color: term_color_1,
		        pa_material: term_material_1,
		        pa_width: term_width_1,
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
		        	$('#cat-products').append('<div class="clearfix"></div><div class="text-center"><p>No more products to load.</p></div>');
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

if($('#allproducts_page_count').length){
	var allProCanBeLoaded = true; // this param allows to initiate the AJAX call only if necessary
	var allProBottomOffset = 800; // the distance (in px) from the page bottom when you want to load more posts

	$(window).scroll(function(){
	if( $(document).scrollTop() > ( $(document).height() - allProBottomOffset ) && allProCanBeLoaded == true ){
		//init
		var allpro_color = $('#ajax-all_product').data('color');
		var allpro_material = $('#ajax-all_product').data('material');
		var allpro_width = $('#ajax-all_product').data('width');

		var products = $('#allproducts_page_count');
		var page5 = products.data('page5');
		var newPage5 = page5 + 1;
		var ajaxurl = products.data('url');
		var countPro = parseInt(products.text());
		products.text(countPro+9);
		$.ajax({
		    url: ajaxurl,
		    type: 'post',
		    data: {
		        page: page5,
		        countPro: countPro,
			    pa_color: allpro_color,
		        pa_material: allpro_material,
		        pa_width: allpro_width,
		        action: 'ajax_load_more_all_product'
		
		    },
		    beforeSend: function ( xhr ) {
		      $('#ajxaloader5').show();
		      allProCanBeLoaded = false; 
		    },
		    error: function(response) {
		        console.log(response);
		    },
			success:function(response){
		        if (response == 0) {
		        	$('#all_product').append('<div class="clearfix"></div><div class="text-center"><p>No more products to load.</p></div>');
		            $('#ajxaloader5').hide();
		        } else {
		            $('#ajxaloader5').hide();
		            products.data('page5', newPage5);
		            $('#all_product').append(response.substr(response.length-1, 1) === '0'? response.substr(0, response.length-1) : response);
		        	allProCanBeLoaded = true;
		        }
			}
		});
	}
	});
}
})(jQuery);