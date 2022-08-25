/******/(()=>{var e,i;e=jQuery,i=window.inlineEditPost.edit,// and then we overwrite the function with our own code
window.inlineEditPost.edit=function(t){
// "call" the original WP edit function
// we don't want to leave WordPress hanging
i.apply(this,arguments);// now we take care of our business
// get the post ID
var n=0;if(t instanceof Element&&(n=parseInt(this.getId(t))),n>0){
// define the edit row
var s=e("#edit-"+n),a=window["sensei_quick_edit_"+n];//load the relod function on the save button click
s.find("a.save").on("click",(function(){location.reload()})),// populate the data
//data is localized in sensei_quick_edit object
e(':input[name="lesson_course"] option[value="'+a.lesson_course+'"] ',s).attr("selected",!0),e(':input[name="lesson_complexity"] option[value="'+a.lesson_complexity+'"] ',s).attr("selected",!0),"on"==a.pass_required||"1"==a.pass_required?a.pass_required=1:a.pass_required=0,e(':input[name="pass_required"] option[value="'+a.pass_required+'"] ',s).attr("selected",!0),e(':input[name="quiz_passmark"]',s).val(a.quiz_passmark),"on"==a.enable_quiz_reset||"1"==a.enable_quiz_reset?a.enable_quiz_reset=1:a.enable_quiz_reset=0,e(':input[name="enable_quiz_reset"] option[value="'+a.enable_quiz_reset+'"] ',s).attr("selected",!0)}}})
/******/();