var startWindowScroll = 0;
var $ = jQuery;

$(window).on('load', function(){
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
		$('body').addClass('ios');
	} else{
		$('body').addClass('web');
	}
	$('body').removeClass('loaded');
	// setTimeout(() => {
	// 	$('body').removeClass('loaded');
	// }, 1500);
});
/* viewport width */
function viewport(){
	var e = window, 
		a = 'inner';
	if ( !( 'innerWidth' in window ) )
	{
		a = 'client';
		e = document.documentElement || document.body;
	}
	return { width : e[ a+'Width' ] , height : e[ a+'Height' ] }
}
/* viewport width */
$(document).ready(function(){
	/* placeholder*/	   
	$('input, textarea').each(function(){
 		var placeholder = $(this).attr('placeholder');
 		$(this).focus(function(){ $(this).attr('placeholder', '');});
 		$(this).focusout(function(){			 
 			$(this).attr('placeholder', placeholder);  			
 		});
 	});
	/* placeholder*/
	
	/* components */
	
	if($('.js-post__likes').length) {
		var button = $('.js-post__likes').find('.like'),
			field  = $('.js-post__likes').find('span');

		button.click(function() {
			let val = parseInt(field.text());
			
			if($(this).hasClass('active')) {
				field.text(val - 1);
			} else {
				field.text(val + 1);
			}
		});
	}
	
	/* components */
	
	

});

$(window).on('resize', handler);

function initMagnificInline() {
	if($('.js-popup').length){
		$('.js-popup').magnificPopup({
			fixedBgPos: true,
			fixedContentPos: true,
			showCloseBtn: true,
			removalDelay: 0,
			preloader: true,
			type:"inline",
			mainClass: 'mfp-fade mfp-s-loading',
			galery: {enabled: true},
			callbacks: {
				beforeOpen: function() {
					startWindowScroll = $(window).scrollTop();
				},
				open: function(){
					//initSliders
	
					if ( $('.mfp-content').height() < $(window).height() ){
						$('body').on('touchmove', function (e) {
							e.preventDefault();
						  });
					}
				},
				close: function() {
					//destroySliders
	
					$(window).scrollTop(startWindowScroll);
					$('body').off('touchmove');
				}
			}
		});
	}
}

function initMagnificGallery() {
	if($('.js-popup-gallery').length) {
		for(let i = 0; i < $('.js-popup-gallery').length; i++) {
			$('.js-popup-gallery').eq(i).magnificPopup({
				delegate: 'a.img-wrapper',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile mfp-with-zoom',
				fixedBgPos: true,
				fixedContentPos: true,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1],
					tCounter: '<span class="mfp-counter">%curr% из %total%</span>'
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title') + `<p>${item.el.attr('data-text')}</p>`;
					}
				},
				zoom: {
					enabled: true,
					duration: 300
				},
				overflowY: 'auto',
				callbacks: {
					// Utils.magnificPopupConfiguration()
					beforeOpen: function() {
						startWindowScroll = $(window).scrollTop();
					},
					open: function(){
						if ( $('.mfp-content').height() < $(window).height() ){
							$('body').on('touchmove', function (e) {
								e.preventDefault();
							  });
						}
					},
					close: function() {
						$(window).scrollTop(startWindowScroll);
						$('body').off('touchmove');
					}
				}
			});
		}
	}
}

function initMagnificIframe() {
	if($('.js-popup-iframe').length) {
		$('.js-popup-iframe').magnificPopup({
			fixedBgPos: true,
			fixedContentPos: true,
			showCloseBtn: true,
			removalDelay: 300,
			preloader: true,
			type:"iframe",
			mainClass: 'mfp-fade mfp-s-loading',
			galery: {enabled: true},
			callbacks: {
				beforeOpen: function() {
					startWindowScroll = $(window).scrollTop();
				},
				open: function(){
					//initSliders

					if ( $('.mfp-content').height() < $(window).height() ){
						$('body').on('touchmove', function (e) {
							e.preventDefault();
						});
					}
				},
				close: function() {
					//destroySliders

					$(window).scrollTop(startWindowScroll);
					$('body').off('touchmove');
				}
			}
		});
	}
}

function initSLick (slickItem, slickVars) {
	slickItem.slick(slickVars).resize();
}

function mobileNavToggle(dropDownBtn, navItem) {
	dropDownBtn.toggleClass('active');
	removeToggle(navItem);
}

function dropDown(dropDownBtn) {
	dropDownBtn.toggleClass('active');
	var toggleBlock = dropDownBtn.parent().find('.js-dropdown');
	removeToggle(toggleBlock);
}

function removeToggle(toggleBlock) {
	toggleBlock.slideToggle(300, function() {
		if ($(this).css('display') === 'none') {
			$(this).removeAttr('style');
		}
	});
}

$(document).mouseup(function (e){
	// if($('.js-dropdown').hasClass('opened')){
	// 	var div = $('.js-dropdown');
	// 	if (!div.is(e.target) && div.has(e.target).length === 0) {
	// 		div.find('.js-dropdown__content').slideUp();
	// 		div.removeClass('opened');
	// 	}
	// }
});

var handler = function(){
	
	var height_footer = $('footer').height();	
	var height_header = $('header').height();		
	//$('.content').css({'padding-bottom':height_footer+40, 'padding-top':height_header+40});
	
	
	var viewport_wid = viewport().width;
	var viewport_height = viewport().height;
	
	if (viewport_wid <= 991) {
		
	}
	
}