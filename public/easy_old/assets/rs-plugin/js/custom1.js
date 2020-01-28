// JavaScript Document


var tpj=jQuery;
var revapi68;
tpj(document).ready(function() {
	if(tpj("#rev_slider_70_1").revolution == undefined){
		revslider_showDoubleJqueryError("#rev_slider_70_1");
	}else{
		revapi68 = tpj("#rev_slider_70_1").show().revolution({
			sliderType:"hero",
			jsFileLocation:"rs-plugin/js/",
			sliderLayout:"fullscreen",
			dottedOverlay:"none",
			delay:9000,
			navigation: {
				keyboardNavigation:"off",
				keyboard_direction: "horizontal",
				mouseScrollNavigation:"off",
				 mouseScrollReverse:"default",
				onHoverStop:"off",
				arrows: {
					style:"uranus",
					enable:true,
					hide_onmobile:false,
					hide_onleave:false,
					tmp:'',
					left: {
						h_align:"left",
						v_align:"center",
						h_offset:20,
						v_offset:0
					},
					right: {
						h_align:"right",
						v_align:"center",
						h_offset:20,
						v_offset:0
					}
				}
			},
			responsiveLevels:[1240,1024,778,480],
			gridwidth:[1400,1240,778,480],
			gridheight:[768,768,960,720], 
			lazyType:"none",
			shadow:0,
			spinner:"off",
			autoHeight:"off",
			disableProgressBar:"on",
			hideThumbsOnMobile:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				disableFocusListener:false,
			}
		});

		revapi68.bind("revolution.slide.onloaded",function (e) {
			setTimeout( function(){ SEMICOLON.slider.sliderParallaxDimensions(); }, 200 );
		});
	}
});	/*ready*/
		
		
		
		
