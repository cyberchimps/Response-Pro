




/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {

	 /*
      Progressive enhancement.  If javascript is enabled we change the body class.  Which in turn hides the checkboxes with css.
    */
    $('body').addClass("js");
    
    /*
      Add toggle switch after each checkbox.  If checked, then toggle the switch.
    */
     $('.checkbox').after(function(){
       if ($(this).is(":checked")) {
         return "<a href='#' class='toggle checked' ref='"+$(this).attr("id")+"'></a>";
       }else{
         return "<a href='#' class='toggle' ref='"+$(this).attr("id")+"'></a>";
       }
       
       
     });
     
     /*
      When the toggle switch is clicked, check off / de-select the associated checkbox
     */
    $('.toggle').click(function(e) {
       var checkboxID = $(this).attr("ref");
       var checkbox = $('#'+checkboxID);

       if (checkbox.is(":checked")) {
         checkbox.removeAttr("checked").change();
       }else{
         checkbox.attr("checked","checked").change();
       }
       $(this).toggleClass("checked");

       e.preventDefault();

    });

    /*
      For demo purposes only....shows/hides checkboxes.
    */
    $('#showCheckboxes').click(function(e) {
     $('.checkbox').toggle()
     e.preventDefault();
    });

	
	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);
	
	// Color Picker
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');
		$(this).ColorPicker({
		color: initialColor,
		onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
		},
		onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
		},
		onChange: function (hsb, hex, rgb) {
		$(Othis).children('div').css('backgroundColor', '#' + hex);
		$(Othis).next('input').attr('value','#' + hex);
	}
	});
	}); //end color picker
		
	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');		
	});
		
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
		 		
	$('.subsection-items').hide();
	$('.subsection > h3').click(function() {
		$('span.minus').removeClass('minus');
		if($(this).siblings('div').is(':visible')) {
			$(this).siblings('div').fadeOut();
		} else {
			$(this).siblings('div').fadeIn();
			$(this).find("span").addClass('minus');
		}
	});
	
	$('.group-items').hide();
	$('.group > h2').click(function() {
		$('span.minus').removeClass('minus');
		if($(this).siblings('div').is(':visible')) {
			$(this).siblings('div').fadeOut();
		} else {
			$(this).siblings('div').fadeIn();
			$(this).find("span").addClass('minus');
		}
	});
    
    
	/* jQuery UI slider */
	
	    var slidevalue = $( "#slider_value" ).val();
		$( "#slider" ).slider({ min: 10 },{ max:40 },{ step: 1 }, { value: slidevalue });
		$( "#slider_value" ).val($( "#slider" ).slider( "option", "value" ));
		$("p.typopreview").css("font-size", $( "#slider" ).slider( "option", "value" )); 
			
		$( "#slider" ).bind( "slidechange", function(event, ui) {
			event.change($("p.typopreview").css("font-size", ui.value));
			event.change($( "#slider_value" ).val(ui.value));
		}); 
		
		$( "#slider" ).bind( "slide", function(event, ui) {
			$( "#slider_value" ).val($( "#slider" ).slider( "option", "value" ));
		});
		
		$( "#slider_value" ).blur(function() {
			$( "#slider" ).slider( "option", "value", $( "#slider_value" ).val() );
		});
		
	/* for the font face preview */	
	   
		  
	$('#re_font').change(function(){
       var font = $(this).val();
       if (font !== "null")
          $("p.typopreview").google_fonts({fontname: font});          
    });	

 });	
