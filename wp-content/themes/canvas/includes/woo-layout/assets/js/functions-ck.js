/*-----------------------------------------------------------------------------------

FILE INFORMATION

Description: JavaScript in the admin for the Woo_Layout extension.
Date Created: 2011-04-11.
Author: Matty.
Since: 4.0.0


TABLE OF CONTENTS

- Setup Layout Selector.
- Layout Selector Selection Event.
- Layout Toggle and Show Active Layout.
- Setup Layout Managers.
- Select Box Logic.
- Image Selector Logic.

- function update_dimensions() - Update dimensions.

-----------------------------------------------------------------------------------*/jQuery(function(e){function a(e){var t=e.parents(".layout-ui"),n=parseInt(t.width()),r=t.find("span.ui-draggable").width(),i=Math.ceil(r/n*100),s=parseInt(jQuery(".layout-width-value").text());t.children("div").each(function(){var e=jQuery(this).attr("id"),t=e.replace("-column",""),r=parseInt(jQuery(this).width()),i=r/n*100;i=Math.ceil(i);var o=parseInt(s)/100;o=Math.ceil(o);var u=o*i;jQuery(this).find(".pixel-width").text(i);jQuery("input#"+t).val(i)})}function f(){var e=parseInt(jQuery(".layout-ui").width()),t=parseInt(jQuery(".layout-width-value").text());jQuery(".layout-ui").each(function(){jQuery(this).children("div").each(function(){var n=t,r=e;jQuery(this).parent("div").find("span").each(function(e){n-=jQuery(this).width();r-=jQuery(this).width()});var i=jQuery(this).attr("id"),s=i.replace("-column",""),o=parseInt(jQuery(this).width()),u=o/e*100;u=Math.ceil(u);var a=parseInt(n)/100;a=Math.ceil(a);var f=a*u;jQuery(this).find(".pixel-width").text(u)})})}var t="",n="",r=jQuery(".layout-width-value").text(),i=jQuery("#layout-type").attr("class"),s=jQuery('input[name="woo-framework-image-dir"]').val();jQuery('input[name="woo-framework-image-dir"]').remove();var o=parseInt(jQuery('input[name="woo-gutter"]').val());jQuery('input[name="woo-gutter"]').remove();if(jQuery(".section").length){n+='<h3>Select Layout</h3><div class="layout-selector">';jQuery(".layout.section").each(function(){var e=jQuery(this).attr("id"),t="",r="1c";e==i&&(t=" active");switch(e){case"two-col-left":r="2cl";break;case"two-col-right":r="2cr";break;case"three-col-left":r="3cl";break;case"three-col-middle":r="3cm";break;case"three-col-right":r="3cr"}n+='<span class="'+e+'"><a href="#" id="'+e+'" class="layout-option '+e+t+'">'+'<img src="'+s+r+'.png" alt="'+jQuery(this).find(".heading").text()+'" />'+"</a></span>"});n+='<div class="clear"></div></div>';jQuery("#layout-width-notice").before(n)}jQuery(".layout-selector a.layout-option").length&&jQuery(".layout-selector a.layout-option").click(function(){jQuery(".layout-selector a.layout-option.active").removeClass("active");jQuery(this).addClass("active");var e=jQuery(this).attr("id");jQuery(".layout.section:not(#"+e+")").hide();jQuery(".layout.section#"+e).show();return!1});if(jQuery(".layout-selector a.layout-option.active").length&&jQuery(".layout.section").length){var u=jQuery(".layout-selector a.layout-option.active").attr("id");jQuery(".layout.section:not(#"+u+")").hide();jQuery(".layout.section#"+u).show()}jQuery(".layout.section").length&&jQuery(".layout.section").each(function(e,t){var n=jQuery("<div />").addClass("layout-ui").css("height","300").css("width","596"),i="";jQuery(this).find("input.woo-input").each(function(e,t){var n=jQuery(this).attr("id");n+="-column";var r="",s=jQuery(this).prev("label").text();switch(e){case 0:r+=" ui-layout-west";break;case 1:r+=" ui-layout-center";break;case 2:r+=" ui-layout-east"}i+='<div id="'+n+'" class="'+r+'"><span class="content">'+s+'<small>(approx. <span class="pixel-width">'+""+"</span>%)</small></span></div>"});n.html(i);if(jQuery(n).find("div").length>=1){var s=jQuery(this).find(".controls input.woo-input:eq(0)").val(),o=jQuery(this).find(".controls input.woo-input:eq(1)").val(),u=jQuery(this).find(".controls input.woo-input:eq(2)").val(),l=parseInt(n.width())/100,c=Math.ceil(l*s),h=Math.ceil(l*u),p=parseInt(r)-s-u;p=Math.ceil(p);var d=n.layout({closable:!1,resizable:!0,slidable:!1,resizeWhileDragging:!0,west__resizable:!0,east__resizable:!0,east__resizerClass:"woo-resizer-east",west__resizerClass:"woo-resizer-west",east__size:h,west__size:c,east__minSize:10,west__minSize:10,onresize:function(e,t,n,r,i){a(t)}});f()}jQuery(this).find(".heading").after(n);jQuery(this).find(".controls, .description").hide();jQuery(this).find("div:eq(0) .pixel-width").text(s);jQuery(this).find("div:eq(1) .pixel-width").text(o);jQuery(this).find("div:eq(2) .pixel-width").text(u)});if(jQuery("select.woo-input").length){jQuery("select.woo-input").each(function(){var e=jQuery("<span></span>"),t=jQuery(this).find("option:selected");t||(t=jQuery(this).find("option:eq(0)"));e.text(t.text());jQuery(this).before(e)});jQuery("select.woo-input").change(function(){var e=jQuery(this).find("option:selected").text();e&&jQuery(this).prev("span").text(e)})}jQuery(".woo-radio-img-img").click(function(){jQuery(this).parent().parent().find(".woo-radio-img-selected").removeClass("woo-radio-img-selected");jQuery(this).addClass("woo-radio-img-selected")});jQuery(".woo-radio-img-label").hide();jQuery(".woo-radio-img-img").show();jQuery(".woo-radio-img-radio").hide()});