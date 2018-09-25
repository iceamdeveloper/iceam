$(document).ready(function(){
	
	// call by default
	$('.alert-message').alert();
	$('.dropdown-toggle').dropdown();
	
	// kill the functionality that closes the shelf on stage click
	// because the shelf is also on the stage
	// so that it can double aa regular nav at md and lg sizes like normal bootstrap
	
	$(".stage").on("opened.bs.stage", function(){
		// when the stage-shelf opens, it creates a listener on the stage for this click event
		$(".stage").off("click.bs.stage");
		
		// instead click on page wrapper (or other content area div) to close
		$("#page-wrapper").on("click", function(){
			$("#page-wrapper").off("click");
			$(".stage").stage('toggle')
		})
	})
})