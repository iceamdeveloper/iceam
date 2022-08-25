/******/(()=>{// webpackBootstrap
/******/"use strict";
/******/var e,t,n,s,r,o,i,l,a,c,u,d={
/***/69973:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Vw:()=>/* binding */l
/* harmony export */,H4:()=>/* binding */a
/* harmony export */});
/* unused harmony exports blockNames, blockTypes, syncStructureToBlocks, getCourseInnerBlocks */
/* harmony import */var s=n(50189),r=(n(4981),n(9818),n(92819)),o={module:"sensei-lms/course-outline-module",lesson:"sensei-lms/course-outline-lesson"},i=(0,r.invert)(o),l=((0,r.curry)((function(e,t){var n=t.name,s=t.attributes;return!!Object.keys(i).includes(n)&&[!!s.id&&e.id===s.id,s.title===e.title,s.title===e.lastTitle].includes(!0)})),function e(t){var n={module:function(t){return{description:t.attributes.description,lessons:e(t.innerBlocks),teacher:t.attributes.teacher,teacherId:t.attributes.teacherId,lastTitle:t.attributes.lastTitle,slug:t.attributes.slug}},lesson:function(e){return{draft:e.attributes.draft,preview:e.attributes.preview}}};return t.map((function(e){var t=i[e.name];return(0,s/* ["default"] */.Z)({type:t,id:e.attributes.id,title:e.attributes.title},n[t](e))})).filter((function(e){return"module"===e.type||!!e.title}))}),a=function e(t,n){for(var s=0;s<n.length;s++){var r=n[s];if(t===r.name)return r;if(r.innerBlocks&&r.innerBlocks.length>0){var o=e(t,r.innerBlocks);if(o)return o}}return!1};
/* harmony import */}
/***/,
/***/25852:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */F:()=>/* binding */m
/* harmony export */});
/* harmony import */var s=n(66886),r=n(9818),o=n(65736),i=n(41650),__=o.__,l={course:{outline:"sensei-lms/course-outline",takeCourse:"sensei-lms/button-take-course",contactTeacher:"sensei-lms/button-contact-teacher",courseProgress:"sensei-lms/course-progress",viewResults:"sensei-lms/button-view-results"},lesson:{lessonActions:"sensei-lms/lesson-actions",lessonProperties:"sensei-lms/lesson-properties",contactTeacher:"sensei-lms/button-contact-teacher"}},a={course:{"meta-box-course-lessons":[l.course.outline],"meta-box-module_course_mb":[l.course.outline],"meta-box-course-video":Object.values(l.course)},lesson:{"meta-box-lesson-info":[l.lesson.lessonProperties]}},c=(0,r.select)("core/block-editor"),u=(0,r.select)("core/edit-post"),d=(0,r.dispatch)("core/edit-post"),m=function(e){if(c){var t,n=(0,r.dispatch)("core/notices"),o=n.createWarningNotice,m=n.removeNotice;(0,i/* ["default"] */.Z)({subscribeListener:function(){var e=c.getBlocks();// Check if blocks were changed.
e!==t&&(t=e,p(),f())}});
/**
   * Check whether it has Sensei blocks.
   */
var p=function(){Object.entries(a[e]).forEach((function(e){var t=(0,s/* ["default"] */.Z)(e,2),n=t[0],r=t[1];!v(r)!==u.isEditorPanelEnabled(n)&&d.toggleEditorPanelEnabled(n)})),// Prevent submit course modules.
document.querySelectorAll("#module_course_mb input").forEach((function(e){e.disabled=!u.isEditorPanelEnabled("meta-box-module_course_mb")})),// Don't submit lesson length and complexity values in metaboxes.
document.querySelectorAll("#lesson-info input, #lesson-info select").forEach((function(e){e.disabled=!u.isEditorPanelEnabled("meta-box-lesson-info")}))},f=function(){var t,n,s=v(Object.values(l[e])),r=null===(t=window)||void 0===t||null===(n=t.sensei)||void 0===n?void 0:n.courseThemeEnabled;s||r?m("sensei-using-template"):o(__("It looks like this course page doesn't have any Sensei blocks. This means that content will be handled by custom templates.","sensei-lms"),{id:"sensei-using-template",isDismissible:!0,actions:[{label:__("Learn more","sensei-lms"),url:"https://senseilms.com/documentation/course-page-blocks/"}]})},v=function(e){return e.some((function(e){return c.getGlobalBlockCount(e)>0}))};
/**
   * Toggle metaboxes if a replacement block is present or not.
   */}};
/* harmony import */}
/***/,
/***/10328:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>l
/* harmony export */});
/* harmony import */var s=n(69307),r=n(72067),o=n(55609),i=n(65736),__=i.__;
/* harmony import */
/* harmony default export */const l=function(){return(0,s.createElement)(r.PluginDocumentSettingPanel,{name:"sensei-course-access-period-promo",title:__("Access Period","sensei-lms")},(0,s.createElement)("div",{className:"sensei-course-access-period-promo"},(0,s.createElement)("p",null,(0,s.createElement)(o.ExternalLink,{href:"https://senseilms.com/sensei-pro/?utm_source=plugin_sensei&utm_medium=upsell&utm_campaign=course_access_period"},__("Upgrade to Sensei Pro","sensei-lms"))),(0,s.createElement)("div",{className:"sensei-course-access-period-promo__holder"},(0,s.createElement)("p",null,__("Set how long learners will have access to this course.","sensei-lms")),(0,s.createElement)(o.SelectControl,{label:__("Expiration","sensei-lms"),options:[{label:__("No expiration","sensei-lms")},{label:__("Expires after","sensei-lms")}]}))))};
/***/},
/***/17323:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>c
/* harmony export */});
/* harmony import */var s=n(69307),r=n(65736),o=n(92694),i=n(72067),l=n(81975),a=n(55609),__=r.__;
/* harmony import */
/* harmony default export */const c=function(){
/**
   * Filters to get description for pricing component.
   *
   * @since 4.1.0
   *
   * @hook  senseiCoursePricingDescription This hook allows to pass a string value for the course pricing promo description.
   * @return {string} 					 Description text for course pricing promo sidebar.
   */
var e=(0,o.applyFilters)("senseiCoursePricingDescription",__("Sell this course using WooCommerce - integrates with subscriptions, memberships, affiliates, and more.","sensei-lms"));return(0,s.createElement)(i.PluginDocumentSettingPanel,{name:"sensei-course-pricing-promo",title:__("Pricing ","sensei-lms")},(0,s.createElement)("p",null," ",(0,l.escapeHTML)(e)," "),(0,s.createElement)("p",null,(0,s.createElement)(a.ExternalLink,{href:"https://senseilms.com/sensei-pro/?utm_source=plugin_sensei&utm_medium=upsell&utm_campaign=course_pricing"},__("Upgrade to Sensei Pro","sensei-lms"))),(0,s.createElement)("p",{className:"sensei-pricing-promo__upgrade-new-course-text"},__("To access this course, learners will need to purchase one of the assigned products.","sensei-lms")),(0,s.createElement)("div",{className:"sensei-pricing-promo__upgrade-new-course"},(0,s.createElement)("p",{className:"sensei-pricing-promo__upgrade-new-course-text"},__("You don't have any products yet. Get started by creating a new WooCommerce product.","sensei-lms")),(0,s.createElement)(a.Button,{className:"sensei-pricing-promo__upgrade_new_course_mock_button",disabled:!0},__("Create a product","sensei-lms"))))};
/***/},
/***/45485:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */q6:()=>/* binding */s
/* harmony export */,kU:()=>/* binding */r
/* harmony export */,bm:()=>/* binding */o
/* harmony export */});var s="sensei-theme",r="wordpress-theme",o="sensei_theme_preview"}
/***/,
/***/33735:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>_
/* harmony export */});
/* harmony import */var s=n(66886),r=n(60726),o=n(69307),i=n(72067),l=n(65736),a=n(55609),c=n(9818),u=n(88698),d=n(45485),m=n(9200),p=n(86057),f=n(37231),v=n(69973),__=l.__,g=m.name,b=p.name,h=f.name,w=function(e){return e.name===h&&e.attributes.id};
/* harmony import */
/* harmony default export */const _=function(){var e,t,n=(null===(e=window.sensei)||void 0===e||null===(t=e.senseiSettings)||void 0===t?void 0:t.sensei_learning_mode_all)||!1,l=(0,u/* ["default"] */.Z)("_course_theme"),m=(0,s/* ["default"] */.Z)(l,2),p=m[0],f=m[1],h=function(){var e,t,n=(0,c.useSelect)((function(e){return e("core/editor").getCurrentPost()})),s=(null===(e=window.sensei)||void 0===e||null===(t=e.senseiSettings)||void 0===t?void 0:t.sensei_learning_mode_all)||!1,o=(0,c.useSelect)((function(e){var t=e("core/block-editor"),n=t.getBlocks,s=t.getBlockAttributes,o=n(),i=(0,v/* .getFirstBlockByName */.H4)(g,o);if(!i)return{};var l,a=(0,r/* ["default"] */.Z)(n(i.clientId));try{for(a.s();!(l=a.n()).done;){var c=l.value;if(w(c))return s(c.clientId);if(c.name===b){var u,d=(0,r/* ["default"] */.Z)(n(c.clientId));try{for(d.s();!(u=d.n()).done;){var m=u.value;if(w(m))return s(m.clientId)}}catch(e){d.e(e)}finally{d.f()}}}}catch(e){a.e(e)}finally{a.f()}return{}})),i="";null!=o&&o.id&&null!=n&&n.id&&(i=o.draft||!s&&n.meta._course_theme!==d/* .SENSEI_THEME */.q6?"/?p=".concat(o.id,"&").concat(d/* .SENSEI_PREVIEW_QUERY */.bm,"=").concat(n.id):"/?p=".concat(o.id),o.draft&&(i="".concat(i,"&post_type=lesson")));var l="";return i&&(l="/wp-admin/customize.php?autofocus[section]=sensei-course-theme&url=".concat(encodeURIComponent(i))),{previewUrl:i,customizerUrl:l}}(),_=h.previewUrl,y=h.customizerUrl;return(0,o.createElement)(i.PluginDocumentSettingPanel,{name:"sensei-course-theme",title:__("Learning Mode","sensei-lms")},n?(0,o.createElement)("p",null,(0,o.createElement)("a",{href:"/wp-admin/admin.php?page=sensei-settings#course-settings"},__("Learning Mode is enabled globally.","sensei-lms"))):(0,o.createElement)(a.ToggleControl,{label:__("Enable Learning Mode","sensei-lms"),help:__("Show an immersive and distraction-free view for lessons and quizzes.","sensei-lms"),checked:p===d/* .SENSEI_THEME */.q6,onChange:function(e){return f(e?d/* .SENSEI_THEME */.q6:d/* .WORDPRESS_THEME */.kU)}}),_&&(0,o.createElement)("p",null,(0,o.createElement)("a",{href:_,target:"_blank",rel:"noopener noreferrer"},__("Preview","sensei-lms"))),y&&(0,o.createElement)("p",null,(0,o.createElement)("a",{href:y},__("Customize","sensei-lms"))))};
/***/},
/***/18793:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var s=n(69307),r=n(33735);
/* harmony import */
/* harmony default export */const o=function(){return(0,s.createElement)(r/* ["default"] */.Z,null)};
/***/},
/***/5965:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>c
/* harmony export */});
/* harmony import */var s=n(66886),r=n(69307),o=n(72067),i=n(65736),l=n(55609),a=n(88698),__=i.__;
/* harmony import */
/* harmony default export */const c=function(){var e=(0,a/* ["default"] */.Z)("sensei_course_video_autocomplete"),t=(0,s/* ["default"] */.Z)(e,2),n=t[0],i=t[1],c=(0,a/* ["default"] */.Z)("sensei_course_video_autopause"),u=(0,s/* ["default"] */.Z)(c,2),d=u[0],m=u[1],p=(0,a/* ["default"] */.Z)("sensei_course_video_required"),f=(0,s/* ["default"] */.Z)(p,2),v=f[0],g=f[1];return(0,r.createElement)(o.PluginDocumentSettingPanel,{name:"sensei-course-video",title:__("Video","sensei-lms")},(0,r.createElement)(l.ToggleControl,{label:__("Autocomplete Lesson","sensei-lms"),checked:n,onChange:i,help:__("Complete lesson when video ends.","sensei-lms")}),(0,r.createElement)(l.ToggleControl,{label:__("Autopause","sensei-lms"),checked:d,onChange:m,help:__("Pause video when student navigates away.","sensei-lms")}),(0,r.createElement)(l.ToggleControl,{label:__("Required","sensei-lms"),checked:v,onChange:g,help:__("Video must be viewed before completing the lesson.","sensei-lms")}))};
/***/},
/***/88698:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>i
/* harmony export */});
/* harmony import */var s=n(64649),r=n(66886),o=n(37798);
/* harmony import */
/* harmony default export */const i=function(e){var t=(0,o.useEntityProp)("postType","course","meta"),n=(0,r/* ["default"] */.Z)(t,2),i=n[0],l=n[1];return[i[e],function(t){return l((0,s/* ["default"] */.Z)({},e,t))}]};
/***/},
/***/41650:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>r
/* harmony export */});
/* harmony import */var s=n(9818);
/* harmony import */
/* harmony default export */const r=function(e){var t=e.subscribeListener,n=void 0===t?function(){}:t,r=e.onSetDirty,o=void 0===r?function(){}:r,i=e.onSaveStart,l=void 0===i?function(){}:i,a=e.onSave,c=void 0===a?function(){}:a,u=(0,s.select)("core/editor"),d=!1,m=!1;return(0,s.subscribe)((function(){n();var e=u.isEditedPostDirty(),t=u.isSavingPost()&&!u.isAutosavingPost();!m&&e?(
// If editor becomes dirty.
m=!0,o()):m=e,d&&!t?(
// If it completed a saving.
d=t,c()):!d&&t?(
// If it started saving.
d=t,l()):d=t}))};
/***/},
/***/92819:
/***/e=>{e.exports=window.lodash;
/***/},
/***/4981:
/***/e=>{e.exports=window.wp.blocks;
/***/},
/***/55609:
/***/e=>{e.exports=window.wp.components;
/***/},
/***/37798:
/***/e=>{e.exports=window.wp.coreData;
/***/},
/***/9818:
/***/e=>{e.exports=window.wp.data;
/***/},
/***/47701:
/***/e=>{e.exports=window.wp.domReady;
/***/},
/***/72067:
/***/e=>{e.exports=window.wp.editPost;
/***/},
/***/69307:
/***/e=>{e.exports=window.wp.element;
/***/},
/***/81975:
/***/e=>{e.exports=window.wp.escapeHtml;
/***/},
/***/92694:
/***/e=>{e.exports=window.wp.hooks;
/***/},
/***/65736:
/***/e=>{e.exports=window.wp.i18n;
/***/},
/***/98817:
/***/e=>{e.exports=window.wp.plugins;
/***/},
/***/1793:
/***/(e,t,n)=>{function s(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,s=new Array(t);n<t;n++)s[n]=e[n];return s}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/66470:
/***/(e,t,n)=>{function s(e){if(Array.isArray(e))return e}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/60726:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */});
/* harmony import */var s=n(64013);function r(e,t){var n="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!n){if(Array.isArray(e)||(n=(0,s/* ["default"] */.Z)(e))||t&&e&&"number"==typeof e.length){n&&(e=n);var r=0,o=function(){};return{s:o,n:function(){return r>=e.length?{done:!0}:{done:!1,value:e[r++]}},e:function(e){throw e},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var i,l=!0,a=!1;return{s:function(){n=n.call(e)},n:function(){var e=n.next();return l=e.done,e},e:function(e){a=!0,i=e},f:function(){try{l||null==n.return||n.return()}finally{if(a)throw i}}}}
/***/},
/***/64649:
/***/(e,t,n)=>{function s(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/22446:
/***/(e,t,n)=>{function s(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var s,r,o=[],_n=!0,i=!1;try{for(n=n.call(e);!(_n=(s=n.next()).done)&&(o.push(s.value),!t||o.length!==t);_n=!0);}catch(e){i=!0,r=e}finally{try{_n||null==n.return||n.return()}finally{if(i)throw r}}return o}}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/53764:
/***/(e,t,n)=>{function s(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/50189:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */o
/* harmony export */});
/* harmony import */var s=n(64649);function r(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,s)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach((function(t){(0,s/* ["default"] */.Z)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}
/***/},
/***/66886:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */l
/* harmony export */});
/* harmony import */var s=n(66470),r=n(22446),o=n(64013),i=n(53764);
/* harmony import */function l(e,t){return(0,s/* ["default"] */.Z)(e)||(0,r/* ["default"] */.Z)(e,t)||(0,o/* ["default"] */.Z)(e,t)||(0,i/* ["default"] */.Z)()}
/***/},
/***/64013:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */});
/* harmony import */var s=n(1793);function r(e,t){if(e){if("string"==typeof e)return(0,s/* ["default"] */.Z)(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?(0,s/* ["default"] */.Z)(e,t):void 0}}
/***/},
/***/37231:
/***/e=>{e.exports=JSON.parse('{"name":"sensei-lms/course-outline-lesson"}');
/***/},
/***/86057:
/***/e=>{e.exports=JSON.parse('{"name":"sensei-lms/course-outline-module"}');
/***/},
/***/9200:
/***/e=>{e.exports=JSON.parse('{"name":"sensei-lms/course-outline"}');
/***/
/******/}},m={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function p(e){
/******/ // Check if module is in cache
/******/var t=m[e];
/******/if(void 0!==t)
/******/return t.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var n=m[e]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return d[e](n,n.exports,p),n.exports;
/******/}
/******/
/************************************************************************/
/******/ /* webpack/runtime/compat get default export */
/******/
/******/ // getDefaultExport function for compatibility with non-harmony modules
/******/p.n=e=>{
/******/var t=e&&e.__esModule?
/******/()=>e.default
/******/:()=>e
/******/;
/******/return p.d(t,{a:t}),t;
/******/},
/******/ // define getter functions for harmony exports
/******/p.d=(e,t)=>{
/******/for(var n in t)
/******/p.o(t,n)&&!p.o(e,n)&&
/******/Object.defineProperty(e,n,{enumerable:!0,get:t[n]})
/******/;
/******/},
/******/p.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)
/******/,
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
e=p(9818),t=p(92694),n=p(47701),s=p.n(n),r=p(98817),o=p(25852),i=p(18793),l=p(5965),a=p(17323),c=p(10328),u=p(69973),
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
function(){var t=(0,e.select)("core/edit-post"),n=(0,e.select)("core/editor"),s=document.getElementsByName("sensei-course-teacher-author"),r=document.getElementsByName("course_module_custom_slugs");if(t&&s.length){var o=!1;(0,e.subscribe)((function(){if(n.isSavingPost()&&!n.isAutosavingPost()&&!t.isSavingMetaBoxes()&&r){var i=(0,u/* .getFirstBlockByName */.H4)("sensei-lms/course-outline",(0,e.select)("core/block-editor").getBlocks()),l=i&&(0,u/* .extractStructure */.Vw)(i.innerBlocks).filter((function(e){return e.slug})).map((function(e){return e.slug}));r[0].value=JSON.stringify(l)}if(t.isSavingMetaBoxes()!==o&&!(o=t.isSavingMetaBoxes())){var a=s[0].value;a&&(document.getElementsByName("post_author_override")[0].value=a)}}))}}(),s()((function(){var e,t;(0,o/* .startBlocksTogglingControl */.F)("course"),jQuery("#course-prerequisite-options").select2({width:"100%"});var n=function(e){return function(t){var n={course_status:t.target.dataset.courseStatus};// Get course status from post state if it's available.
wp.data&&wp.data.select("core/editor")&&(n.course_status=wp.data.select("core/editor").getCurrentPostAttribute("status")),sensei_log_event(e,n)}};// Log when the "Add Lesson" link is clicked.
null===(e=document.querySelector("a.add-course-lesson"))||void 0===e||e.addEventListener("click",n("course_add_lesson_click")),// Log when the "Edit Lesson" link is clicked.
null===(t=document.querySelector("a.edit-lesson-action"))||void 0===t||t.addEventListener("click",n("course_edit_lesson_click"))})),
/**
 * Plugins
 */
/**
 * Filters the course pricing sidebar toggle.
 *
 * @since 4.1.0
 *
 * @hook  senseiCoursePricingHide     Hook used to hide course pricing promo sidebar.
 *
 * @param {boolean} hideCoursePricing Boolean value that defines if the course pricing promo sidebar should be hidden.
 * @return {boolean}                  Returns a boolean value that defines if the course pricing promo sidebar should be hidden.
 */
(0,t.applyFilters)("senseiCoursePricingHide",!1)||(0,r.registerPlugin)("sensei-course-pricing-promo-sidebar",{render:a/* ["default"] */.Z,icon:null})
/**
 * Filters the course access period display.
 *
 * @since 4.1.0
 *
 * @param {boolean} hideCourseAccessPeriod Whether to hide the access period.
 * @return {boolean} Whether to hide the access period.
 */,(0,t.applyFilters)("senseiCourseAccessPeriodHide",!1)||(0,r.registerPlugin)("sensei-course-access-period-promo-plugin",{render:c/* ["default"] */.Z,icon:null}),(0,r.registerPlugin)("sensei-course-theme-plugin",{render:i/* ["default"] */.Z,icon:null}),(0,r.registerPlugin)("sensei-course-video-progression-plugin",{render:l/* ["default"] */.Z,icon:null})})
/******/();