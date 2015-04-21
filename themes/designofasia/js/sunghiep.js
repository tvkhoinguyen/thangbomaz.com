// JavaScript Document
$(document).ready(function(){ 
	
	$("ul.sf-menu").superfish({ 
		autoArrows: false,
		pathClass:  'current' 
	}); 
	$(".ft-menu li").last().css('border', 'none');
	$(".sf-menu li").last().css('background', 'none');
	function formatText(index, panel) {
    		  return index + "";
    };
	$(".anythingSlider").anythingSlider({
                easing: "easeInOutExpo",        // Anything other than "linear" or "swing" requires the easing plugin
                autoPlay: true,                 // This turns off the entire FUNCTIONALY, not just if it starts running or not.
                delay: 3000,                    // How long between slide transitions in AutoPlay mode
                startStopped: false,            // If autoPlay is on, this can force it to start stopped
                animationTime: 600,             // How long the slide transition takes
                hashTags: true,                 // Should links change the hashtag in the URL?
                buildNavigation: true,          // If true, builds and list of anchor links to link to each slide
            		pauseOnHover: true,             // If true, and autoPlay is enabled, the show will pause on hover
            		startText: "Go",                // Start text
    		        stopText: "Stop",               // Stop text
    		        navigationFormatter: formatText // Details at the top of the file on this use (advanced use)
      });
            
	$("#slide-jump").click(function(){
		$(".anythingSlider").anythingSlider(6);
	});
	$('.vertical_scroller').SetScroller({velocity: 20, direction: "vertical"  });
}); 