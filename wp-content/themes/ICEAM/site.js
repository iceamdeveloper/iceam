jQuery(document).ready(function(){
	var $ = jQuery;
	
	setTimeout(function(){
		$('a[href*="/product"]').each(function() {
			console.log($(this).html());
			$(this).replaceWith($(this).html());
		});
	}, 10); // even a delay of 0 works, but doesn't work with NO delay.
	
	
	// build a "screen" that blocks yt video from being right-clicked
	$(".video iframe").attr("id","ytvideo");
	
	var isiOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	var isVideoStarted = false;
	
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    
	
    window.onYouTubeIframeAPIReady = function() {
        var player = new YT.Player('ytvideo', {
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }
	
	function onPlayerReady(event) {
		$(".video").prepend("<div class='yt-screen'></div>");
		setVideoScreenSize();
		
		if ($(".video").width() > 700) {
			event.target.setPlaybackQuality("hd720");
		}
		
		$(".yt-screen").on("click", function(){
			if (isiOS && !isVideoStarted) {
				return;
			}
			
			if (event.target.getPlayerState() == YT.PlayerState.PAUSED || event.target.getPlayerState() == YT.PlayerState.CUED) {
				event.target.playVideo();
			} else if(event.target.getPlayerState() == YT.PlayerState.PLAYING){
				event.target.pauseVideo();
			}
			$(".yt-screen").css("height", $(".video").height() - 45 + "px");
		})
    }
	
	$(window).on("resize", setVideoScreenSize);
	
	function setVideoScreenSize(){
		$(".yt-screen").css("height", $(".video").height() + "px");
		$(".yt-screen").css("width", $(".video").width() + "px");
		
		if (isiOS && !isVideoStarted) {
			$(".yt-screen").css({"height": "25%", "backgroundColor":"rgba(100,150,200,0.4)", "bottom": "0px", "top": "auto"});
		}
	}

	function onPlayerStateChange(event) {
		
		if (event.data == YT.PlayerState.BUFFERING) {
			console.log("Buffering");
			isVideoStarted = true;
			setVideoScreenSize();
	    }
		
	    if (event.data == YT.PlayerState.PAUSED) {
			console.log("Paused");
	    }
	
	    if (event.data == YT.PlayerState.PLAYING) {
			console.log("Playing");
	    }
	
	    if (event.data == YT.PlayerState.ENDED) {
			console.log("Ended");
	    }
	}
    
    
	$(".iceam-user-type-select").on("change",function(){
		var value = $(".iceam-user-type-select option:selected").val();
		
		if (value == "Student") {
			$("#iceam-student").addClass("visible").removeClass("hidden");
			$("#iceam-practitioner").addClass("hidden").removeClass("visible");
			//$("#iceam-practitioner input").val("");
		} else if (value == "Practitioner") {
			$("#iceam-practitioner").addClass("visible").removeClass("hidden");
			$("#iceam-student").addClass("hidden").removeClass("visible");
			//$("#iceam-student input").val("");
		}
	})
	
	$("td.woocommerce div.quantity input.qty").attr("value", 1);
	$("td.woocommerce div.quantity input.qty").attr("min", 1);
	
	
	$(".single-course article.course.post.lesson").each(function(){
		$(this).addClass("callout");
		
		var label, btnClass;
		if ($(this).hasClass("lesson-completed")) {
			label = "Review Lesson";
			btnClass = "btn-default";
		} else {
			label = "Begin Lesson";
			btnClass = "btn-primary";
		}
		
		var href = $(this).find("a").attr("href");
		var html = '<p><a href="' + href + '" class="btn ' + btnClass + '">' + label + '</a></p>';
		$(this).append(html);
	});
	
	$("body.course-results h3:contains('Other Lessons')").hide();
	$("body.course-results h2 span.lesson-grade").each(function(){
		$(this).text("Grade: " + ($(this).text() ? $(this).text() : "0%"));
	});
	$("body.course-results article.type-course h2").each(function(){
		var html = $(this).html();
		if (html.indexOf('Total Grade') == -1) {
			var _h3 = "<h3>" + html + "</h3>";
			$(this).replaceWith(_h3);
		}
	});

	console.log('here');
	$(".video iframe, .course-video iframe").each(function(){
		//$(document).on("contextmenu", function(){return false;});
		var yturi = "https://www.youtube.com/embed/" + ytv($("#ytv").data("yturi")) + "?autohide=1&modestbranding=1&rel=0&showinfo=0&enablejsapi=1";
		console.log("yturi: " + yturi);
		
		console.log(ytv($("#ytv").data("yturi")));
		$(this).attr("src",yturi);
		
		$("body").fitVids();
	});
	

/* *
	var checkStatus;
	var element = new Image();
	var elementWithHiddenContent = document.querySelector(".course-video");
	if (elementWithHiddenContent) {
		var innerHtml = elementWithHiddenContent.innerHTML;
		
		Object.defineProperty(element, 'id', { get:function() {
			checkStatus='on';
		}});
		
		setInterval(function() {
		    checkStatus = 'off';
		    console.log(element);
		    //console.clear();
		    
		    if (checkStatus=="on") {
				elementWithHiddenContent.innerHTML = "";
		    } else if (checkStatus == "off" && elementWithHiddenContent.innerHTML == ""){
				elementWithHiddenContent.innerHTML = innerHtml;
		    }
		}, 1000)
	}

/* */


	// REMOVE THE REGISTER FORM ON THE MY COURSES PAGE
	if ($("#my-courses .col-2").length) {
		$("#my-courses .col-2").remove();
	}

	
});