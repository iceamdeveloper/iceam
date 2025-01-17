jQuery(document).ready(function(){
	var $ = jQuery;
	
	setTimeout(function(){
		$('a[href*="/product"]').each(function() {
			$(this).replaceWith($(this).html());
		});
	}, 10); // even a delay of 0 works, but doesn't work with NO delay.
	
	
	// build a "screen" that blocks yt video from being right-clicked
	$(".video iframe").attr("id","ytvideo");
	
	var isiOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	var player;
    
	
    window.onYouTubeIframeAPIReady = function() {
        player = new YT.Player('ytvideo', {
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    };

	$(".video").prepend("<div class='yt-screen'></div>");
	$(".video").prepend("<div class='block-watch-on-yt-button'></div>");
	
	function onPlayerReady(event) {
		setVideoScreenSize();
		
		if ($(".video").width() > 700) {
			event.target.setPlaybackQuality("hd720");
		}
		
		$(".yt-screen").on("click", function(){
			$(".yt-screen").css("height", $(".video").height() - 45 + "px");
			if (event.target.getPlayerState() == YT.PlayerState.PAUSED || event.target.getPlayerState() == YT.PlayerState.CUED) {
				event.target.playVideo();
			} else if(event.target.getPlayerState() == YT.PlayerState.PLAYING){
				event.target.pauseVideo();
			}
		});
    }
	
	$(window).on("resize", setVideoScreenSize);
	
	function setVideoScreenSize(){
		$(".yt-screen").css("height", $(".video").height() + "px");
		$(".yt-screen").css("width", $(".video").width() + "px");
	}
	
	function onPlayerStateChange(event) {
		
		if (event.data == YT.PlayerState.BUFFERING) {
			console.log("Buffering");
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

	    if (event.data == -1) {
			console.log("UNSTARTED");
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

	$(".video iframe, .course-video iframe").each(function(){
		// add youtube embed to document
		var yturi = "https://www.youtube-nocookie.com/embed/" + ytv($("#ytv").data("yturi")) + "?autoplay=0&rel=0&controls=1&enablejsapi=1";
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

	if($(".editfield").length){
		$(".editfield input[type=text], .editfield textarea").on("focus",function(){
			$(this).parents(".editfield").addClass("active");
		});
		$(".editfield input[type=text], .editfield textarea").on("blur",function(){
			if($(this).val()===""){
				$(this).parents(".editfield").removeClass("active");
			}
		});
		$(".editfield input[type=text], .editfield textarea").each(function(){
			if($(this).val()!==""){
				$(this).parents(".editfield").addClass("active");
			}
		});
	}
    
    
    // show / hide appropriate practitioner / student fields on the register page
    
    if($("body.registration.register.buddypress")){
        $(".field-visibility-settings, .field-visibility-settings-toggle").remove();
        
        var $status_selector = $(".field_current-status select");
        
        var thingsy = function(){
            var val = $status_selector.val();
            if(val == "Practitioner"){
                console.log(val);
                $(".field_practitioner-license-number").show();
                $(".field_licensing-state").show();
                
                $(".field_student-id-number").hide();
                $(".field_school-name").hide();
            } else if(val == "Student"){
                $(".field_practitioner-license-number").hide();
                $(".field_licensing-state").hide();
                
                $(".field_student-id-number").show();
                $(".field_school-name").show();
            }
        };
        
        thingsy();
        $status_selector.on("change", thingsy);
    }

    //block russian emails
    if(jQuery('#buddypress #signup_form').length){
    	const submitButton = jQuery('#signup_submit');
    	let email;
    	jQuery('#signup_email').blur(function(){
    		email = jQuery('#signup_email').val();
    		if( email.substring(email.length-3,email.length) === '.ru' ){
	    		submitButton.attr('disabled',true);
    		}
    	})
    }

	
});











