//On document ready
$(document).ready(function() {
  $('.StripImage').click(function() {
    var $sideBarDIV = $('#sideBarDIV');
    var $contentDIV = $('#contentDIV');

    if (parseInt($sideBarDIV.css('left'),10) == 0)
    {  
      $contentDIV.css('width',  $contentDIV.outerWidth() + $sideBarDIV.outerWidth());
      $sideBarDIV.animate({ left: -$sideBarDIV.outerWidth() });
      $contentDIV.animate({ left: -$sideBarDIV.outerWidth() });
    } else if (parseInt($sideBarDIV.css('left'),10) == -$sideBarDIV.outerWidth())
    {
      $sideBarDIV.animate({ left: 0 });
      $contentDIV.animate({ left: 0 });
      $contentDIV.css('width',  $contentDIV.outerWidth() - $sideBarDIV.outerWidth());
    }

$('.hiddenContent').css("width",$('#scroller').outerWidth() + "px");
  $(".contentScroll").mCustomScrollbar("update");
  });
});

//After window has loaded
$(window).load(function(){
  $('.hiddenContent').css("width",$('#scroller').outerWidth() + $('#sideBarDIV').outerWidth() + "px");
    
  $(".contentScroll").mCustomScrollbar({ 
    horizontalScroll:true,
    autoDraggerLength:false,
    theme:"dark-thick",
    callbacks:{
      onScrollStart:function(){ OnScrollStart(); },
      onScroll:function(){ OnScroll(); },
      onTotalScroll:function(){ OnTotalScroll(); },
      onTotalScrollBack:function(){ OnTotalScrollBack(); },
      onTotalScrollOffset:40,
      onTotalScrollBackOffset:20,
      whileScrolling:function(){ WhileScrolling(); } 
    }
  });

  //Calculate the correct height for the SIDEBAR and CONTENT panel based on the screen height and HEADER/FOOTER height.
  var height = $(window).height() - ($('#headerTopDIV').height() + $('#headerBottomDIV').height() + $('#headerGradientDIV').height() + $('#footerDIV').height());    
  //Set the heights of the SIDEBAR and CONTENT panel     
  $('#sideBarDIV').height(height - 20);
  $('#contentDIV').height(height);



  // $(".contentScroll").mCustomScrollbar("update");
});
    
//On window resize
window.onresize = function(event) {
  //Calculate the correct height for the SIDEBAR and CONTENT panel based on the screen height and HEADER/FOOTER height.
  var height = $(window).height() - ($('#headerTopDIV').height() + $('#headerBottomDIV').height() + $('#headerGradientDIV').height() + $('#footerDIV').height());  
  //Set the heights of the SIDEBAR and CONTENT panel  
  $('#sideBarDIV').height(height - 20);
  $('#contentDIV').height(height);
};


//While scrolling the custom scroll bar with its hidden content
function WhileScrolling(){
  //Scroll the visible content section based on the position of the hidden content section
  $('.scroller').css('left', $('.mCSB_container').css('left'));
  // $('.contentScrollt').Left($('.mCSB_container').Left());
  /*$(".output .whileScrolling").stop(true,true).css("display","inline-block").fadeOut(500);
  $(".info .content-position").text(mcs.top);
  $(".info .dragger-position").text(mcs.draggerTop);
  $(".info .scroll-pct").text(mcs.topPct+"%");*/
}








/*

		(function($){
			$(window).load(function(){
				$("#content_1").mCustomScrollbar({
					scrollButtons:{
						enable:true
					},
					callbacks:{
						onScrollStart:function(){ OnScrollStart(); },
						onScroll:function(){ OnScroll(); },
						onTotalScroll:function(){ OnTotalScroll(); },
						onTotalScrollBack:function(){ OnTotalScrollBack(); },
						onTotalScrollOffset:40,
						onTotalScrollBackOffset:20,
						whileScrolling:function(){ WhileScrolling(); } 
					}
				});
				function OnScrollStart(){
					$(".output .onScrollStart").stop(true,true).css("display","inline-block").delay(500).fadeOut(500);
				}
				function OnScroll(){
					$(".output .onScroll").stop(true,true).css("display","inline-block").delay(500).fadeOut(500);
				}
				function OnTotalScroll(){
					$(".output .onTotalScroll").stop(true,true).css("display","inline-block").delay(500).fadeOut(500);
				}
				function OnTotalScrollBack(){
					$(".output .onTotalScrollBack").stop(true,true).css("display","inline-block").delay(500).fadeOut(500);
				}

				$(".total-scroll-offset").text($("#content_1").data("onTotalScroll_Offset"));
				$(".total-scroll-back-offset").text($("#content_1").data("onTotalScrollBack_Offset"));
				$(".output a").click(function(e){
					e.preventDefault();
					var $this=$(this),
						rel=$this.attr("rel"),
						target=$this.parent().find("."+rel);
					target.add($this).toggleClass("hidden");
				});
			});
		})(jQuery);
	
*/
