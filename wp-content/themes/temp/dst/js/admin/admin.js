/**
* 2016.01.28
* auther:mrt
* 管理画面で使用するJS
**/

(function($) {
	$(document).ready(function(){


		var Window 			= $(window);
		var winWidth 		= Window.innerWidth();
		var winHeight 		= Window.innerHeight();
		var adbody 			= $("#wpcontent");
		var adheight 		= adbody.outerHeight();
		var adftr 			= $('#wpfooter');
		var adftrHeight 	= adftr.outerHeight();
		var slditemheight 	= $('slditem-1 img').outerHeight();


        console.log('winHeight:' + winHeight);
        console.log("adheight:" + adheight);

		Window.on('load',function(){
			var resize = setTimeout(function() {

                adheight 		= adbody.outerHeight();
                console.log("pepep:"+adheight);
                if(adheight >= winHeight){
                    adftr.removeClass("posabs").addClass("posstc");
                }else{
                    adftr.removeClass("posstc").addClass("posabs");
                }

	        }, 10000);

		});

		/**********************
		ACF JavaScript API
		https://www.advancedcustomfields.com/resources/adding-custom-javascript-fields/
		*********************		*/
		

		acf.add_action('load', function( $el ){
			console.log('イベント：load');	
		});

		acf.add_action('append', function( $el ){
			console.log('イベント：append');
			$('.examplelist').on("click",function(){
				if($(this).hasClass("menuon")){
					$(this).removeClass("menuon");
				}else{
					$(this).addClass("menuon");
				}
			});

			$('.examplelist2').on("click",function(){
				if($(this).hasClass("menuon")){
					$(this).removeClass("menuon");
				}else{
					$(this).addClass("menuon");
				}
			});

		});

		acf.addAction('new_field', function( field ){
			console.log('イベント：new_field');
		});


/*
		acf.add_action('select2_init', function( $input, args, settings, $field ){
			console.log('イベント：select2_init');
		});

		acf.add_filter('select2_args', function( args, $select, settings, $field ){
			console.log('イベント：select2_args');
			return args;
		});

		acf.add_filter('select2_ajax_data', function( data, args, $input, $field ){
			console.log('イベント：select2_ajax_data');
			return data;			
		});

		acf.add_action('show_field', function( $field, context ){
			var $field = $el.find('#my-wrapper-id');
			console.log('イベント：show_field');	
		});

*/
	});
})(jQuery);

