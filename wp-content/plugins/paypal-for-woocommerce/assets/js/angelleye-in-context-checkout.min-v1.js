jQuery(function(e){if("undefined"==typeof angelleye_in_content_param)return!1;function t(){var t=angelleye_in_content_param.disallowed_funding_methods;return null===t&&(t=[]),!(e.inArray("card",t)>-1)}function n(){e(".angelleye_button_single").length>0&&(e(".angelleye_button_single").empty(),window.paypalCheckoutReady=function(){allowed_funding_methods_single_array=e.parseJSON(angelleye_in_content_param.allowed_funding_methods),disallowed_funding_methods_single_array=e.parseJSON(angelleye_in_content_param.disallowed_funding_methods),"no"==angelleye_in_content_param.is_paypal_credit_enable&&disallowed_funding_methods_single_array.push("credit"),angelleye_cart_style_object={size:angelleye_in_content_param.button_size,color:angelleye_in_content_param.button_color,shape:angelleye_in_content_param.button_shape,label:angelleye_in_content_param.button_label,layout:angelleye_in_content_param.button_layout,tagline:"true"===angelleye_in_content_param.button_tagline},"horizontal"===angelleye_in_content_param.button_layout&&!0===t()&&"credit"!==angelleye_in_content_param.button_label&&"true"===angelleye_in_content_param.button_fundingicons&&(angelleye_cart_style_object.fundingicons="true"===angelleye_in_content_param.button_fundingicons),void 0!==angelleye_in_content_param.button_height&&""!==angelleye_in_content_param.button_height&&(angelleye_cart_style_object.height=parseInt(angelleye_in_content_param.button_height)),e(".angelleye_button_single").empty(),paypal.Button.render({env:angelleye_in_content_param.environment,style:angelleye_cart_style_object,locale:angelleye_in_content_param.locale,commit:"false"!==angelleye_in_content_param.zcommit,funding:{allowed:allowed_funding_methods_single_array,disallowed:disallowed_funding_methods_single_array},payment:function(t,n){var o,a,r=e("[name='add-to-cart']").val();return e("<input>",{type:"hidden",name:"angelleye_ppcp-add-to-cart",value:r}).appendTo("form.cart"),o=e("form.cart").serialize(),a=angelleye_in_content_param.add_to_cart_ajaxurl,e("#wc-paypal_express-new-payment-method").is(":checked")&&(a+="&ec_save_to_account=true"),e.post(a,o).then(function(e){return paypal.request.post(e.url,{request_from:"JSv4"}).then(function(e){return e.token})})},onAuthorize:function(t,n){e(".woocommerce").block({message:null,overlayCSS:{background:"#fff",opacity:.6}});var o={paymentToken:t.paymentToken,payerID:t.payerID,token:t.paymentToken,request_from:"JSv4"};paypal.request.post(t.returnUrl,o).then(function(e){t.returnUrl=e.url,n.redirect()})},onCancel:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_oncancel"),window.location.href=window.location.href},onClick:function(){e(document.body).trigger("angelleye_paypal_onclick"),"yes"===angelleye_in_content_param.enable_google_analytics_click&&"undefined"!=typeof ga&&e.isFunction(ga)&&ga("send",{hitType:"event",eventCategory:"Checkout",eventAction:"button_click"})},onError:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_onerror"),window.location.href=angelleye_in_content_param.cancel_page}},".angelleye_button_single")})}function o(){window.paypalCheckoutReady=function(){var n=[],o=[],a=[];"yes"==angelleye_in_content_param.is_checkout&&"yes"==angelleye_in_content_param.is_display_on_checkout&&n.push(".angelleye_smart_button_checkout_top"),"yes"==angelleye_in_content_param.is_cart&&("both"==angelleye_in_content_param.cart_button_possition?n.push(".angelleye_smart_button_top",".angelleye_smart_button_bottom"):"bottom"==angelleye_in_content_param.cart_button_possition?n.push(".angelleye_smart_button_bottom"):"top"==angelleye_in_content_param.cart_button_possition&&n.push(".angelleye_smart_button_top")),a=e.parseJSON(angelleye_in_content_param.disallowed_funding_methods),o=e.parseJSON(angelleye_in_content_param.allowed_funding_methods),"no"==angelleye_in_content_param.is_paypal_credit_enable&&a.push("credit"),angelleye_cart_style_object={size:angelleye_in_content_param.button_size,color:angelleye_in_content_param.button_color,shape:angelleye_in_content_param.button_shape,label:angelleye_in_content_param.button_label,layout:angelleye_in_content_param.button_layout,tagline:"true"===angelleye_in_content_param.button_tagline},void 0!==angelleye_in_content_param.button_height&&""!==angelleye_in_content_param.button_height&&(angelleye_cart_style_object.height=parseInt(angelleye_in_content_param.button_height)),n.forEach(function(n){if(e(n).html(""),a=e.grep(a,function(e){return"venmo"!==e}),n.length>0&&e(n).length>0&&("horizontal"===angelleye_in_content_param.button_layout&&!0===t()&&"credit"!==angelleye_in_content_param.button_label&&"true"===angelleye_in_content_param.button_fundingicons&&(angelleye_cart_style_object.fundingicons="true"===angelleye_in_content_param.button_fundingicons),paypal.Button.render({env:angelleye_in_content_param.environment,style:angelleye_cart_style_object,locale:angelleye_in_content_param.locale,commit:"false"!==angelleye_in_content_param.zcommit,funding:{allowed:o,disallowed:a},payment:function(){var t;return t=angelleye_in_content_param.set_express_checkout,e("#wc-paypal_express-new-payment-method").is(":checked")?t+="&ec_save_to_account=true":e("#wc-paypal_express-new-payment-method_bottom").is(":checked")&&(t+="&ec_save_to_account=true"),paypal.request.post(t,{request_from:"JSv4"}).then(function(e){return e.token})},onAuthorize:function(t,n){e(".woocommerce").block({message:null,overlayCSS:{background:"#fff",opacity:.6}});var o={paymentToken:t.paymentToken,payerID:t.payerID,token:t.paymentToken,request_from:"JSv4"};paypal.request.post(t.returnUrl,o).then(function(e){t.returnUrl=e.url,n.redirect()})},onCancel:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_oncancel"),window.location.href=window.location.href},onClick:function(){e(document.body).trigger("angelleye_paypal_onclick"),"yes"===angelleye_in_content_param.enable_google_analytics_click&&"undefined"!=typeof ga&&e.isFunction(ga)&&ga("send",{hitType:"event",eventCategory:"Checkout",eventAction:"paypal_button_click"})},onError:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_onerror"),window.location.href=angelleye_in_content_param.cancel_page}},n)),"angelleye_smart_button_checkout_top"===n)return!1})}}function a(){window.paypalCheckoutReady=function(){var n=[],o=[],a=[];n.push(".angelleye_smart_button_mini"),a=e.parseJSON(angelleye_in_content_param.mini_cart_disallowed_funding_methods),o=e.parseJSON(angelleye_in_content_param.mini_cart_allowed_funding_methods),"no"==angelleye_in_content_param.is_paypal_credit_enable&&a.push("credit"),angelleye_cart_style_object={size:angelleye_in_content_param.mini_cart_button_size,color:angelleye_in_content_param.button_color,shape:angelleye_in_content_param.button_shape,label:angelleye_in_content_param.mini_cart_button_label,layout:angelleye_in_content_param.mini_cart_button_layout,tagline:"true"===angelleye_in_content_param.button_tagline},void 0!==angelleye_in_content_param.mini_cart_button_height&&""!==angelleye_in_content_param.mini_cart_button_height&&(angelleye_cart_style_object.height=parseInt(angelleye_in_content_param.mini_cart_button_height)),n.forEach(function(n){e(n).html(""),a=e.grep(a,function(e){return"venmo"!==e}),n.length>0&&e(n).length>0&&(angelleye_cart_style_object.size="responsive","horizontal"===angelleye_in_content_param.button_layout&&!0===t()&&"credit"!==angelleye_in_content_param.button_label&&"true"===angelleye_in_content_param.button_fundingicons&&(angelleye_cart_style_object.fundingicons="true"===angelleye_in_content_param.button_fundingicons),paypal.Button.render({env:angelleye_in_content_param.environment,style:angelleye_cart_style_object,locale:angelleye_in_content_param.locale,commit:"false"!==angelleye_in_content_param.zcommit,funding:{allowed:o,disallowed:a},payment:function(){var t;return t=angelleye_in_content_param.set_express_checkout,e("#wc-paypal_express-new-payment-method").is(":checked")&&(t+="&ec_save_to_account=true"),paypal.request.post(t,{request_from:"JSv4"}).then(function(e){return e.token})},onAuthorize:function(t,n){e(".woocommerce").block({message:null,overlayCSS:{background:"#fff",opacity:.6}});var o={paymentToken:t.paymentToken,payerID:t.payerID,token:t.paymentToken,request_from:"JSv4"};paypal.request.post(t.returnUrl,o).then(function(e){t.returnUrl=e.url,n.redirect()})},onCancel:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_oncancel"),window.location.href=window.location.href},onClick:function(){e(document.body).trigger("angelleye_paypal_onclick"),"yes"===angelleye_in_content_param.enable_google_analytics_click&&"undefined"!=typeof ga&&e.isFunction(ga)&&ga("send",{hitType:"event",eventCategory:"Checkout",eventAction:"paypal_button_click"})},onError:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_onerror"),window.location.href=angelleye_in_content_param.cancel_page}},n))})}}function r(){window.paypalCheckoutReady=function(){var n=[],o=[],a=[];n.push(".angelleye_smart_button_wsc"),a=e.parseJSON(angelleye_in_content_param.wsc_cart_disallowed_funding_methods),o=e.parseJSON(angelleye_in_content_param.wsc_cart_allowed_funding_methods),"no"==angelleye_in_content_param.is_paypal_credit_enable&&a.push("credit"),angelleye_cart_style_object={size:angelleye_in_content_param.wsc_cart_button_size,color:angelleye_in_content_param.button_color,shape:angelleye_in_content_param.button_shape,label:angelleye_in_content_param.wsc_cart_button_label,layout:angelleye_in_content_param.wsc_cart_button_layout,tagline:"true"===angelleye_in_content_param.button_tagline},void 0!==angelleye_in_content_param.wsc_cart_button_height&&""!==angelleye_in_content_param.wsc_cart_button_height&&(angelleye_cart_style_object.height=parseInt(angelleye_in_content_param.wsc_cart_button_height)),n.forEach(function(n){e(n).html(""),a=e.grep(a,function(e){return"venmo"!==e}),n.length>0&&e(n).length>0&&(angelleye_cart_style_object.size="responsive","horizontal"===angelleye_in_content_param.button_layout&&!0===t()&&"credit"!==angelleye_in_content_param.button_label&&"true"===angelleye_in_content_param.button_fundingicons&&(angelleye_cart_style_object.fundingicons="true"===angelleye_in_content_param.button_fundingicons),paypal.Button.render({env:angelleye_in_content_param.environment,style:angelleye_cart_style_object,locale:angelleye_in_content_param.locale,commit:"false"!==angelleye_in_content_param.zcommit,funding:{allowed:o,disallowed:a},payment:function(){var t;return t=angelleye_in_content_param.set_express_checkout,e("#wc-paypal_express-new-payment-method").is(":checked")&&(t+="&ec_save_to_account=true"),paypal.request.post(t,{request_from:"JSv4"}).then(function(e){return e.token})},onAuthorize:function(t,n){e(".woocommerce").block({message:null,overlayCSS:{background:"#fff",opacity:.6}});var o={paymentToken:t.paymentToken,payerID:t.payerID,token:t.paymentToken,request_from:"JSv4"};paypal.request.post(t.returnUrl,o).then(function(e){t.returnUrl=e.url,n.redirect()})},onCancel:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_oncancel"),window.location.href=window.location.href},onClick:function(){e(document.body).trigger("angelleye_paypal_onclick"),"yes"===angelleye_in_content_param.enable_google_analytics_click&&"undefined"!=typeof ga&&e.isFunction(ga)&&ga("send",{hitType:"event",eventCategory:"Checkout",eventAction:"paypal_button_click"})},onError:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_onerror"),window.location.href=angelleye_in_content_param.cancel_page}},n))})}}if(o(),a(),n(),r(),e(document.body).on("cart_totals_refreshed updated_shipping_method wc_fragments_refreshed updated_checkout updated_wc_div updated_cart_totals wc_fragments_loaded",function(e){o()}),"no"===angelleye_in_content_param.checkout_page_disable_smart_button&&e(document.body).on("updated_shipping_method wc_fragments_refreshed updated_checkout",function(n){window.paypalCheckoutReady=function(){var n=[],o=[],a=[];n.push(".angelleye_smart_button_checkout_bottom"),a=e.parseJSON(angelleye_in_content_param.disallowed_funding_methods),o=e.parseJSON(angelleye_in_content_param.allowed_funding_methods),"no"==angelleye_in_content_param.is_paypal_credit_enable&&a.push("credit"),angelleye_cart_style_object={size:angelleye_in_content_param.button_size,color:angelleye_in_content_param.button_color,shape:angelleye_in_content_param.button_shape,label:angelleye_in_content_param.button_label,layout:angelleye_in_content_param.button_layout,tagline:"true"===angelleye_in_content_param.button_tagline},void 0!==angelleye_in_content_param.button_height&&""!==angelleye_in_content_param.button_height&&(angelleye_cart_style_object.height=parseInt(angelleye_in_content_param.button_height)),n.forEach(function(n){if(e(n).html(""),a=e.grep(a,function(e){return"venmo"!==e}),n.length>0&&e(n).length>0&&("horizontal"===angelleye_in_content_param.button_layout&&!0===t()&&"credit"!==angelleye_in_content_param.button_label&&"true"===angelleye_in_content_param.button_fundingicons&&(angelleye_cart_style_object.fundingicons="true"===angelleye_in_content_param.button_fundingicons),paypal.Button.render({env:angelleye_in_content_param.environment,style:angelleye_cart_style_object,locale:angelleye_in_content_param.locale,commit:"false"!==angelleye_in_content_param.zcommit,funding:{allowed:o,disallowed:a},payment:function(){var t=e(n).closest("form").add(e('<input type="hidden" name="request_from" /> ').attr("value","JSv4")).add(e('<input type="hidden" name="from_checkout" /> ').attr("value","yes")).serialize();return paypal.request({method:"post",url:angelleye_in_content_param.set_express_checkout,body:t}).then(function(e){return e.token})},onAuthorize:function(t,n){e(".woocommerce").block({message:null,overlayCSS:{background:"#fff",opacity:.6}});var o={paymentToken:t.paymentToken,payerID:t.payerID,token:t.paymentToken,request_from:"JSv4"};paypal.request.post(t.returnUrl,o).then(function(o){"no"===angelleye_in_content_param.is_pre_checkout_offer?(t.returnUrl=o.url,n.redirect()):(e(".woocommerce").unblock(),e("form.checkout").triggerHandler("checkout_place_order"))})},onCancel:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_oncancel"),window.location.href=window.location.href},onClick:function(){e(document.body).trigger("angelleye_paypal_onclick"),"yes"===angelleye_in_content_param.enable_google_analytics_click&&"undefined"!=typeof ga&&e.isFunction(ga)&&ga("send",{hitType:"event",eventCategory:"Checkout",eventAction:"paypal_button_click"})},onError:function(t,n){e(".woocommerce").unblock(),e(document.body).trigger("angelleye_paypal_onerror"),window.location.href=window.location.href}},n)),"angelleye_smart_button_checkout_bottom"===n)return!1})}}),e(document.body).on("wc_fragments_loaded wc_fragments_refreshed",function(){var t=e(".angelleye_smart_button_mini");t.length&&(t.empty(),a());var o=e(".angelleye_button_single");o.length&&(o.empty(),n());var c=e(".angelleye_smart_button_wsc");c.length&&(c.empty(),r())}),"no"===angelleye_in_content_param.checkout_page_disable_smart_button){function c(){var t=e("#payment_method_paypal_express").is(":checked");e('input[name="wc-paypal_express-payment-token"]:checked').length>0?t&&e('input[name="wc-paypal_express-payment-token"]').length&&"new"===e('input[name="wc-paypal_express-payment-token"]:checked').val()?(e("#place_order").hide(),e(".angelleye_smart_button_checkout_bottom").show()):t&&e('input[name="wc-paypal_express-payment-token"]').length&&"new"!==e('input[name="wc-paypal_express-payment-token"]:checked').val()?(e("#place_order").show(),e(".angelleye_smart_button_checkout_bottom").hide()):t?(e(".angelleye_smart_button_checkout_bottom").show(),e("#place_order").hide()):(e(".angelleye_smart_button_checkout_bottom").hide(),e("#place_order").show()):t?(e(".angelleye_smart_button_checkout_bottom").show(),e("#place_order").hide()):(e(".angelleye_smart_button_checkout_bottom").hide(),e("#place_order").show())}e(document.body).on("updated_checkout wc-credit-card-form-init update_checkout",function(e){c()}),e("form.checkout").on("click",'input[name="payment_method"]',function(){c()}),e("form.checkout").on("click",'input[name="wc-paypal_express-payment-token"]',function(){"new"===e(this).val()?(e("#place_order").hide(),e(".angelleye_smart_button_checkout_bottom").show()):"new"!==e(this).val()&&(e("#place_order").show(),e(".angelleye_smart_button_checkout_bottom").hide())})}});