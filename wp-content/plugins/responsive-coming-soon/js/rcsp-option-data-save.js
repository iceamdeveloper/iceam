/*Admin options panel data value*/

function fn_formValidation(email_address) {
	var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	return pattern.test(email_address);
}
  
function wpsm_rcs_option_data_save(name,security) { 	
	
	//validating email
	if(name	=='newsletter'){
		
		var $subscribeEmail = jQuery('#email_add_of_admin');
		var subscribeEmailVal = $subscribeEmail.val();	
		if (!fn_formValidation(subscribeEmailVal)) {
			alert('Invalid Email , Please enter valid Email');
			return false;
			
		}
	}
	
	var wpsm_rcs_plugin_options = "#wpsm_rcs_plugin_options_"+name;
	
	jQuery("#wpsm_loding_general_image").show();
	jQuery.ajax({
		type: "POST",
		url: location.href,
		data : 'action_rcs=action_rcs_page_setting_save_post' + '&hook=' + name + '&security=' + security +'&' + jQuery(wpsm_rcs_plugin_options).serialize(),
		success : function(data){
			jQuery("#wpsm_loding_general_image").fadeOut();
		   jQuery(".dialog-button").click();
		   
		   if(name=="dashboard"){
				 location.href='?page=wpsm_responsive_coming_soon';
				
			}
	   }			
	});
}
/*Admin options panel data value*/
function wpsm_rcs_option_data_reset(name,security) 
{ 	
	if (confirm('Are you sure you want to reste this setting?')) {
    
} else {
   return;
}
	
	
	var wpsm_rcs_plugin_options = "#wpsm_rcs_plugin_options_"+name;
	jQuery("#wpsm_loding_general_image").show();
	jQuery.ajax({
		type: "POST",
		url: location.href,
		data : 'action_rcs_reset=action_rcs_page_setting_reset_post' + '&security=' + security  +'&hook=' + name ,
		success : function(data){
			jQuery("#wpsm_loding_general_image").fadeOut();
		   jQuery(".dialog-button").click();
		location.href='?page=wpsm_responsive_coming_soon';
		 
		
	
	   }			
	});
	

}

	
	
	