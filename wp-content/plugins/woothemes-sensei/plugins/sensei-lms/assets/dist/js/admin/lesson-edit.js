/******/(()=>{// webpackBootstrap
/******/"use strict";
/******/var e,t,o,r={
/***/5852:
/***/(e,t,o)=>{
/* harmony export */o.d(t,{
/* harmony export */F:()=>/* binding */b
/* harmony export */});
/* harmony import */var r=o(189),n=o(6886),s=o(9818),i=o(5736),l=o(1650),__=i.__,u={course:{outline:"sensei-lms/course-outline",takeCourse:"sensei-lms/button-take-course",contactTeacher:"sensei-lms/button-contact-teacher",courseProgress:"sensei-lms/course-progress",viewResults:"sensei-lms/button-view-results"},lesson:{lessonActions:"sensei-lms/lesson-actions",lessonProperties:"sensei-lms/lesson-properties",contactTeacher:"sensei-lms/button-contact-teacher"}},c={course:{"meta-box-course-lessons":[u.course.outline],"meta-box-module_course_mb":[u.course.outline],"meta-box-course-video":Object.values(u.course)},lesson:{"meta-box-lesson-info":[u.lesson.lessonProperties]}},a=(0,s.select)("core/block-editor"),d=(0,s.select)("core/editor"),p=(0,s.select)("core/edit-post"),f=(0,s.dispatch)("core/edit-post"),b=function(e){if(a){var t,o,i,b=(0,s.dispatch)("core/notices"),v=b.createWarningNotice,m=b.removeNotice;(0,l/* ["default"] */.Z)({subscribeListener:function(){var e=a.getBlocks();// Check if blocks were changed.
e!==i&&(i=e,g(),o=y(),void 0!==t&&h())},onSetDirty:function(){var e;
// If it will fill the template (needs_template is true),
// we consider that it has Sensei blocks initially.
// Set initial blocks state.
d.isEditedPostDirty()&&void 0===t&&(t=(null===(e=d.getCurrentPostAttribute("meta"))||void 0===e?void 0:e._needs_template)||o)},onSave:function(){
// Update initial blocks state on save.
t=y(),h()}});
/**
   * Check whether it has Sensei blocks.
   */
var y=function(){return w(Object.values(u[e]))},g=function(){Object.entries(c[e]).forEach((function(e){var t=(0,n/* ["default"] */.Z)(e,2),o=t[0],r=t[1];!w(r)!==p.isEditorPanelEnabled(o)&&f.toggleEditorPanelEnabled(o)})),// Prevent submit course modules.
document.querySelectorAll("#module_course_mb input").forEach((function(e){e.disabled=!p.isEditorPanelEnabled("meta-box-module_course_mb")})),// Don't submit lesson length and complexity values in metaboxes.
document.querySelectorAll("#lesson-info input, #lesson-info select").forEach((function(e){e.disabled=!p.isEditorPanelEnabled("meta-box-lesson-info")}))},h=function(){var e=y(),o={isDismissible:!0,actions:[{label:__("Learn more","sensei-lms"),url:"https://senseilms.com/documentation/course-page-blocks/"}]};if(e)if(m("sensei-using-template"),t)m("sensei-using-blocks");else{var n=__("You've just added your first Sensei block. This will change how your course page appears. Be sure to preview your page before saving changes.","sensei-lms");v(n,(0,r/* ["default"] */.Z)({id:"sensei-using-blocks"},o))}else if(m("sensei-using-blocks"),t){var s=__("Are you sure you want to remove all Sensei blocks? This will change how your course page appears. Be sure to preview your page before saving changes.","sensei-lms");v(s,(0,r/* ["default"] */.Z)({id:"sensei-using-template"},o))}else m("sensei-using-template")},w=function(e){return e.some((function(e){return a.getGlobalBlockCount(e)>0}))};
/**
   * Toggle metaboxes if a replacement block is present or not.
   */}};
/* harmony import */}
/***/,
/***/1650:
/***/(e,t,o)=>{
/* harmony export */o.d(t,{
/* harmony export */Z:()=>n
/* harmony export */});
/* harmony import */var r=o(9818);
/* harmony import */
/* harmony default export */const n=function(e){var t=e.subscribeListener,o=void 0===t?function(){}:t,n=e.onSetDirty,s=void 0===n?function(){}:n,i=e.onSaveStart,l=void 0===i?function(){}:i,u=e.onSave,c=void 0===u?function(){}:u,a=(0,r.select)("core/editor"),d=!1,p=!1;return(0,r.subscribe)((function(){o();var e=a.isEditedPostDirty(),t=a.isSavingPost()&&!a.isAutosavingPost();!p&&e?(
// If editor becomes dirty.
p=!0,s()):p=e,d&&!t?(
// If it completed a saving.
d=t,c()):!d&&t?(
// If it started saving.
d=t,l()):d=t}))};
/***/},
/***/9818:
/***/e=>{e.exports=window.wp.data;
/***/},
/***/7701:
/***/e=>{e.exports=window.wp.domReady;
/***/},
/***/5736:
/***/e=>{e.exports=window.wp.i18n;
/***/},
/***/1793:
/***/(e,t,o)=>{function r(e,t){(null==t||t>e.length)&&(t=e.length);for(var o=0,r=new Array(t);o<t;o++)r[o]=e[o];return r}
/***/
/* harmony export */o.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/6470:
/***/(e,t,o)=>{function r(e){if(Array.isArray(e))return e}
/***/
/* harmony export */o.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/4649:
/***/(e,t,o)=>{function r(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}
/***/
/* harmony export */o.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/2446:
/***/(e,t,o)=>{function r(e,t){var o=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=o){var r,n,s=[],_n=!0,i=!1;try{for(o=o.call(e);!(_n=(r=o.next()).done)&&(s.push(r.value),!t||s.length!==t);_n=!0);}catch(e){i=!0,n=e}finally{try{_n||null==o.return||o.return()}finally{if(i)throw n}}return s}}
/***/
/* harmony export */o.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/3764:
/***/(e,t,o)=>{function r(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}
/***/
/* harmony export */o.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/189:
/***/(e,t,o)=>{
/* harmony export */o.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */});
/* harmony import */var r=o(4649);function n(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,r)}return o}function s(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};t%2?n(Object(o),!0).forEach((function(t){(0,r/* ["default"] */.Z)(e,t,o[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(o)):n(Object(o)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))}))}return e}
/***/},
/***/6886:
/***/(e,t,o)=>{
/* harmony export */o.d(t,{
/* harmony export */Z:()=>/* binding */l
/* harmony export */});
/* harmony import */var r=o(6470),n=o(2446),s=o(4013),i=o(3764);
/* harmony import */function l(e,t){return(0,r/* ["default"] */.Z)(e)||(0,n/* ["default"] */.Z)(e,t)||(0,s/* ["default"] */.Z)(e,t)||(0,i/* ["default"] */.Z)()}
/***/},
/***/4013:
/***/(e,t,o)=>{
/* harmony export */o.d(t,{
/* harmony export */Z:()=>/* binding */n
/* harmony export */});
/* harmony import */var r=o(1793);function n(e,t){if(e){if("string"==typeof e)return(0,r/* ["default"] */.Z)(e,t);var o=Object.prototype.toString.call(e).slice(8,-1);return"Object"===o&&e.constructor&&(o=e.constructor.name),"Map"===o||"Set"===o?Array.from(e):"Arguments"===o||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o)?(0,r/* ["default"] */.Z)(e,t):void 0}}
/***/
/******/}},n={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function s(e){
/******/ // Check if module is in cache
/******/var t=n[e];
/******/if(void 0!==t)
/******/return t.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var o=n[e]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return r[e](o,o.exports,s),o.exports;
/******/}
/******/
/************************************************************************/
/******/ /* webpack/runtime/compat get default export */
/******/
/******/ // getDefaultExport function for compatibility with non-harmony modules
/******/s.n=e=>{
/******/var t=e&&e.__esModule?
/******/()=>e.default
/******/:()=>e
/******/;
/******/return s.d(t,{a:t}),t;
/******/},
/******/ // define getter functions for harmony exports
/******/s.d=(e,t)=>{
/******/for(var o in t)
/******/s.o(t,o)&&!s.o(e,o)&&
/******/Object.defineProperty(e,o,{enumerable:!0,get:t[o]})
/******/;
/******/},
/******/s.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)
/******/,
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
e=s(7701),t=s.n(e),o=s(5852),
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
t()((function(){(0,o/* .startBlocksTogglingControl */.F)("lesson");// Lessons Write Panel.
var e=jQuery("#lesson-complexity-options");e.length>0&&e.select2({width:"resolve"});var t=jQuery("#lesson-prerequisite-options");t.length>0&&t.select2({width:"resolve"});var r=jQuery("#lesson-course-options");r.length>0&&r.select2({width:"resolve"});var n=jQuery("#lesson-module-options");n.length>0&&n.select2({width:"resolve"}),// Refresh the prerequisite meta box when the course changes in order to get the relevant prerequisites.
jQuery("#lesson-course-options").on("change",(function(){var e,t=(null===(e=wp.data.select("core/editor"))||void 0===e?void 0:e.getCurrentPostId())||jQuery("#post_ID").val(),o=jQuery(this).val();
// Try to get the lesson ID from the wp data store. If not present, fallback to getting it from the DOM.
jQuery.get(ajaxurl,{action:"get_prerequisite_meta_box_content",lesson_id:t,course_id:o,security:window.sensei_lesson_metadata.get_prerequisite_meta_box_content_nonce},(function(e){""!==e&&(
// Replace the meta box and re-initialize select2.
jQuery("> .inside","#lesson-prerequisite").html(e),jQuery("#lesson-prerequisite-options").select2({width:"resolve"}))}))}))}))})
/******/();