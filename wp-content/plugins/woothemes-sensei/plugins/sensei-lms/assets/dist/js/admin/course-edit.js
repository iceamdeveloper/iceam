/******/(()=>{// webpackBootstrap
/******/var e={
/***/42:
/***/(e,t)=>{var n;
/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */!function(){"use strict";var s={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var o=typeof n;if("string"===o||"number"===o)e.push(n);else if(Array.isArray(n)){if(n.length){var i=r.apply(null,n);i&&e.push(i)}}else if("object"===o)if(n.toString===Object.prototype.toString)for(var a in n)s.call(n,a)&&n[a]&&e.push(a);else e.push(n.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(n=function(){return r}.apply(t,[]))||(e.exports=n)}()}
/***/,
/***/9973:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */H4:()=>/* binding */o
/* harmony export */});
/* unused harmony exports blockNames, blockTypes, syncStructureToBlocks, extractStructure, getCourseInnerBlocks */
/* harmony import */n(4981),n(9818)
/* harmony import */;var s=n(2819),r={module:"sensei-lms/course-outline-module",lesson:"sensei-lms/course-outline-lesson"},o=((0,s.invert)(r),function e(t,n){for(var s=0;s<n.length;s++){var r=n[s];if(t===r.name)return r;if(r.innerBlocks&&r.innerBlocks.length>0){var o=e(t,r.innerBlocks);if(o)return o}}return!1})}
/***/,
/***/5852:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */F:()=>/* binding */g
/* harmony export */});
/* harmony import */var s=n(189),r=n(6886),o=n(9818),i=n(5736),a=n(1650),__=i.__,c={course:{outline:"sensei-lms/course-outline",takeCourse:"sensei-lms/button-take-course",contactTeacher:"sensei-lms/button-contact-teacher",courseProgress:"sensei-lms/course-progress",viewResults:"sensei-lms/button-view-results"},lesson:{lessonActions:"sensei-lms/lesson-actions",lessonProperties:"sensei-lms/lesson-properties",contactTeacher:"sensei-lms/button-contact-teacher"}},l={course:{"meta-box-course-lessons":[c.course.outline],"meta-box-module_course_mb":[c.course.outline],"meta-box-course-video":Object.values(c.course)},lesson:{"meta-box-lesson-info":[c.lesson.lessonProperties]}},u=(0,o.select)("core/block-editor"),m=(0,o.select)("core/editor"),d=(0,o.select)("core/edit-post"),p=(0,o.dispatch)("core/edit-post"),g=function(e){if(u){var t,n,i,g=(0,o.dispatch)("core/notices"),f=g.createWarningNotice,v=g.removeNotice;(0,a/* ["default"] */.Z)({subscribeListener:function(){var e=u.getBlocks();// Check if blocks were changed.
e!==i&&(i=e,h(),n=b(),void 0!==t&&_())},onSetDirty:function(){var e;
// If it will fill the template (needs_template is true),
// we consider that it has Sensei blocks initially.
// Set initial blocks state.
m.isEditedPostDirty()&&void 0===t&&(t=(null===(e=m.getCurrentPostAttribute("meta"))||void 0===e?void 0:e._needs_template)||n)},onSave:function(){
// Update initial blocks state on save.
t=b(),_()}});
/**
   * Check whether it has Sensei blocks.
   */
var b=function(){return w(Object.values(c[e]))},h=function(){Object.entries(l[e]).forEach((function(e){var t=(0,r/* ["default"] */.Z)(e,2),n=t[0],s=t[1];!w(s)!==d.isEditorPanelEnabled(n)&&p.toggleEditorPanelEnabled(n)})),// Prevent submit course modules.
document.querySelectorAll("#module_course_mb input").forEach((function(e){e.disabled=!d.isEditorPanelEnabled("meta-box-module_course_mb")})),// Don't submit lesson length and complexity values in metaboxes.
document.querySelectorAll("#lesson-info input, #lesson-info select").forEach((function(e){e.disabled=!d.isEditorPanelEnabled("meta-box-lesson-info")}))},_=function(){var e=b(),n={isDismissible:!0,actions:[{label:__("Learn more","sensei-lms"),url:"https://senseilms.com/documentation/course-page-blocks/"}]};if(e)if(v("sensei-using-template"),t)v("sensei-using-blocks");else{var r=__("You've just added your first Sensei block. This will change how your course page appears. Be sure to preview your page before saving changes.","sensei-lms");f(r,(0,s/* ["default"] */.Z)({id:"sensei-using-blocks"},n))}else if(v("sensei-using-blocks"),t){var o=__("Are you sure you want to remove all Sensei blocks? This will change how your course page appears. Be sure to preview your page before saving changes.","sensei-lms");f(o,(0,s/* ["default"] */.Z)({id:"sensei-using-template"},n))}else v("sensei-using-template")},w=function(e){return e.some((function(e){return u.getGlobalBlockCount(e)>0}))};
/**
   * Toggle metaboxes if a replacement block is present or not.
   */}};
/* harmony import */}
/***/,
/***/328:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>a
/* harmony export */});
/* harmony import */var s=n(9307),r=n(2067),o=n(5609),i=n(5736),__=i.__;
/* harmony import */
/* harmony default export */const a=function(){return(0,s.createElement)(r.PluginDocumentSettingPanel,{name:"sensei-course-access-period-promo",title:__("Access Period","sensei-lms")},(0,s.createElement)("div",{className:"sensei-course-access-period-promo"},(0,s.createElement)("p",null,(0,s.createElement)(o.ExternalLink,{href:"https://senseilms.com/pricing/?utm_source=plugin_sensei&utm_medium=upsell&utm_campaign=course_access_period"},__("Upgrade to Sensei Pro","sensei-lms"))),(0,s.createElement)("div",{className:"sensei-course-access-period-promo__holder"},(0,s.createElement)("p",null,__("Set how long learners will have access to this course.","sensei-lms")),(0,s.createElement)(o.SelectControl,{label:__("Expiration","sensei-lms"),options:[{label:__("No expiration","sensei-lms")},{label:__("Expires after","sensei-lms")}]}))))};
/***/},
/***/7323:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>l
/* harmony export */});
/* harmony import */var s=n(9307),r=n(5736),o=n(2694),i=n(2067),a=n(1975),c=n(5609),__=r.__;
/* harmony import */
/* harmony default export */const l=function(){
/**
   * Filters to get description for pricing component.
   *
   * @since 4.1.0
   *
   * @hook  senseiCoursePricingDescription This hook allows to pass a string value for the course pricing promo description.
   * @return {string} 					 Description text for course pricing promo sidebar.
   */
var e=(0,o.applyFilters)("senseiCoursePricingDescription",__("Sell this course using WooCommerce - integrates with subscriptions, memberships, affiliates, and more.","sensei-lms"));return(0,s.createElement)(i.PluginDocumentSettingPanel,{name:"sensei-course-pricing-promo",title:__("Pricing ","sensei-lms")},(0,s.createElement)("p",null," ",(0,a.escapeHTML)(e)," "),(0,s.createElement)("p",null,(0,s.createElement)(c.ExternalLink,{href:"https://senseilms.com/pricing/?utm_source=plugin_sensei&utm_medium=upsell&utm_campaign=course_pricing"},__("Upgrade to Sensei Pro","sensei-lms"))),(0,s.createElement)("p",{className:"sensei-pricing-promo__upgrade-new-course-text"},__("To access this course, learners will need to purchase one of the assigned products.","sensei-lms")),(0,s.createElement)("div",{className:"sensei-pricing-promo__upgrade-new-course"},(0,s.createElement)("p",{className:"sensei-pricing-promo__upgrade-new-course-text"},__("You don't have any products yet. Get started by creating a new WooCommerce product.","sensei-lms")),(0,s.createElement)(c.Button,{className:"sensei-pricing-promo__upgrade_new_course_mock_button",disabled:!0},__("Create a product","sensei-lms"))))};
/***/},
/***/5485:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */q6:()=>/* binding */s
/* harmony export */,kU:()=>/* binding */r
/* harmony export */,bm:()=>/* binding */o
/* harmony export */});var s="sensei-theme",r="wordpress-theme",o="sensei_theme_preview"}
/***/,
/***/1013:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>f
/* harmony export */});
/* harmony import */var s=n(6886),r=n(9307),o=n(9818),i=n(5736),a=n(5609),c=n(5660),l=n(8698),u=n(5485),__=i.__,m="".concat(window.sensei.pluginUrl,"assets/dist/images"),d="senseiCourseThemeOnboardingCompleted",p="sensei-course-theme-plugin/sensei-course-theme",g=function(){var e=(0,o.useSelect)((function(e){return{onboardingCompleted:e("core/edit-post").isFeatureActive(d)}})).onboardingCompleted,t=function(e){var t=(0,r.useState)(),n=(0,s/* ["default"] */.Z)(t,2),o=n[0],i=n[1];return(0,r.useEffect)((function(){if(e){// Initialize state after modals are open or not.
setTimeout((function(){i(document.body.classList.contains("modal-open"))}),1);var t=new window.MutationObserver((function(){i(document.body.classList.contains("modal-open"))}));return t.observe(document.body,{attributes:!0,attributeFilter:["class"]}),function(){t.disconnect()}}}),[e]),o}(!e),n=(0,r.useState)(!1),i=(0,s/* ["default"] */.Z)(n,2),a=i[0],c=i[1];return(0,r.useLayoutEffect)((function(){e?c(!1):!1===t&&
// If no modal is open, it's time to open.
c(!0)}),[e,t]),a};
/* harmony import */
/* harmony default export */const f=function(){var e=(0,o.useDispatch)("core/edit-post"),t=e.toggleFeature,n=e.toggleEditorPanelOpened,i=(0,o.useDispatch)("core/editor").savePost,f=(0,o.useSelect)((function(e){return{isCourseThemePanelOpen:e("core/edit-post").isEditorPanelOpened(p)}})).isCourseThemePanelOpen,v=g(),b=(0,l/* ["default"] */.Z)("_course_theme"),h=(0,s/* ["default"] */.Z)(b,2)[1];return v?(0,r.createElement)(c/* ["default"] */.Z,{className:"sensei-course-theme-onboarding",contentLabel:__("New learning experience!","sensei-lms"),onFinish:function(){t(d)},pages:[{image:(0,r.createElement)("div",{className:"sensei-course-theme-onboarding__image-container"},(0,r.createElement)("img",{src:"".concat(m,"/onboarding-learning-mode.jpg"),alt:__("Learning mode sample.","sensei-lms")})),content:(0,r.createElement)(r.Fragment,null,(0,r.createElement)("h1",{className:"sensei-course-theme-onboarding__heading"},__("New! Distraction-free learning experience","sensei-lms")),(0,r.createElement)("p",{className:"sensei-course-theme-onboarding__text"},__("Enable Sensei’s ‘learning mode’ to show an immersive and dedicated view for courses, lessons, and quizzes.","sensei-lms"))),footer:function(e){var t=e.goForward;return(0,r.createElement)(r.Fragment,null,(0,r.createElement)("a",{className:"sensei-course-theme-onboarding__learn-more components-button components-guide__back-button",href:"https://senseilms.com/wordpress-course-theme",rel:"noreferrer external",target:"_blank"},__("Learn more","sensei-lms")),(0,r.createElement)(a.Button,{className:"components-guide__forward-button",onClick:function(){
// Open sidebar panel
f||n(p),h(u/* .SENSEI_THEME */.q6),i(),t()}},__("Enable learning mode","sensei-lms")))}},{image:(0,r.createElement)("div",{className:"sensei-course-theme-onboarding__image-container"},(0,r.createElement)("img",{src:"".concat(m,"/onboarding-learning-mode-check.jpg"),alt:__("Learning mode sample with check icon.","sensei-lms")})),content:(0,r.createElement)(r.Fragment,null,(0,r.createElement)("h1",{className:"sensei-course-theme-onboarding__heading"},__("We’ve enabled learning mode for this course!","sensei-lms")),(0,r.createElement)("p",{className:"sensei-course-theme-onboarding__text"},__("For more options you can access the ‘course styles’ setting in the course sidebar.","sensei-lms"))),footer:function(e){var t=e.onFinish;return(0,r.createElement)(a.Button,{className:"components-guide__forward-button",onClick:t},__("Sounds good","sensei-lms"))}}]}):null};
/***/},
/***/3735:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>w
/* harmony export */});
/* harmony import */var s=n(6886),r=n(726),o=n(9307),i=n(2067),a=n(5736),c=n(5609),l=n(9818),u=n(8698),m=n(5485),d=n(9200),p=n(6057),g=n(7231),f=n(9973),__=a.__,v=d.name,b=p.name,h=g.name,_=function(e){return e.name===h&&e.attributes.id};
/* harmony import */
/* harmony default export */const w=function(){var e,t,n=(null===(e=window.sensei)||void 0===e||null===(t=e.senseiSettings)||void 0===t?void 0:t.sensei_learning_mode_all)||!1,a=(0,u/* ["default"] */.Z)("_course_theme"),d=(0,s/* ["default"] */.Z)(a,2),p=d[0],g=d[1],h=function(){var e,t,n=(0,l.useSelect)((function(e){return e("core/editor").getCurrentPost()})),s=(null===(e=window.sensei)||void 0===e||null===(t=e.senseiSettings)||void 0===t?void 0:t.sensei_learning_mode_all)||!1,o=(0,l.useSelect)((function(e){var t=e("core/block-editor"),n=t.getBlocks,s=t.getBlockAttributes,o=n(),i=(0,f/* .getFirstBlockByName */.H4)(v,o);if(!i)return{};var a,c=(0,r/* ["default"] */.Z)(n(i.clientId));try{for(c.s();!(a=c.n()).done;){var l=a.value;if(_(l))return s(l.clientId);if(l.name===b){var u,m=(0,r/* ["default"] */.Z)(n(l.clientId));try{for(m.s();!(u=m.n()).done;){var d=u.value;if(_(d))return s(d.clientId)}}catch(e){m.e(e)}finally{m.f()}}}}catch(e){c.e(e)}finally{c.f()}return{}})),i="";null!=o&&o.id&&null!=n&&n.id&&(i=o.draft||!s&&n.meta._course_theme!==m/* .SENSEI_THEME */.q6?"/?p=".concat(o.id,"&").concat(m/* .SENSEI_PREVIEW_QUERY */.bm,"=").concat(n.id):"/?p=".concat(o.id),o.draft&&(i="".concat(i,"&post_type=lesson")));var a="";return i&&(a="/wp-admin/customize.php?autofocus[section]=sensei-course-theme&url=".concat(encodeURIComponent(i))),{previewUrl:i,customizerUrl:a}}(),w=h.previewUrl,y=h.customizerUrl;return(0,o.createElement)(i.PluginDocumentSettingPanel,{name:"sensei-course-theme",title:(0,o.createElement)(o.Fragment,null,__("Learning Mode","sensei-lms"),(0,o.createElement)("span",{className:"sensei-badge sensei-badge--success sensei-badge--after-text"},__("New!","sensei-lms")))},n?(0,o.createElement)("p",null,(0,o.createElement)("a",{href:"/wp-admin/admin.php?page=sensei-settings#course-settings"},__("Learning Mode is enabled globally.","sensei-lms"))):(0,o.createElement)(c.ToggleControl,{label:__("Enable Learning Mode","sensei-lms"),help:__("Show an immersive and distraction-free view for lessons and quizzes.","sensei-lms"),checked:p===m/* .SENSEI_THEME */.q6,onChange:function(e){return g(e?m/* .SENSEI_THEME */.q6:m/* .WORDPRESS_THEME */.kU)}}),w&&(0,o.createElement)("p",null,(0,o.createElement)("a",{href:w,target:"_blank",rel:"noopener noreferrer"},__("Preview","sensei-lms"))),y&&(0,o.createElement)("p",null,(0,o.createElement)("a",{href:y},__("Customize","sensei-lms"))))};
/***/},
/***/5660:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */l
/* harmony export */});
/* harmony import */var s=n(6886),r=n(9307),o=n(42),i=n.n(o),a=n(5736),c=n(5609);
/* harmony import */a.__;
/**
 * This component is an adaptation of Guide component from Gutenberg.
 * It was adapted mainly to allow an action when closing the onboarding,
 * and different ones when clicking on the buttons.
 *
 * @link https://github.com/WordPress/gutenberg/tree/trunk/packages/components/src/guide
 */
function l(e){var t=e.className,n=e.contentLabel,o=e.onFinish,a=e.pages,l=void 0===a?[]:a,u=(0,r.useState)(0),m=(0,s/* ["default"] */.Z)(u,2),d=m[0],p=m[1],g=d>0,f=d<l.length-1;return 0===l.length?null:(0,r.createElement)(c.Modal,{className:i()("components-guide",t),contentLabel:n,onRequestClose:o},(0,r.createElement)("div",{className:"components-guide__container"},(0,r.createElement)("div",{className:"components-guide__page"},l[d].image,l[d].content),(0,r.createElement)("div",{className:"components-guide__footer"},l[d].footer({canGoBack:g,canGoForward:f,goBack:function(){g&&p(d-1)},goForward:function(){f&&p(d+1)},onFinish:o}))))}
/***/},
/***/8793:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>i
/* harmony export */});
/* harmony import */var s=n(9307),r=n(3735),o=n(1013);
/* harmony import */
/* harmony default export */const i=function(){return(0,s.createElement)(s.Fragment,null,(0,s.createElement)(r/* ["default"] */.Z,null),(0,s.createElement)(o/* ["default"] */.Z,null))};
/***/},
/***/5965:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>l
/* harmony export */});
/* harmony import */var s=n(6886),r=n(9307),o=n(2067),i=n(5736),a=n(5609),c=n(8698),__=i.__;
/* harmony import */
/* harmony default export */const l=function(){var e=(0,c/* ["default"] */.Z)("sensei_course_video_autocomplete"),t=(0,s/* ["default"] */.Z)(e,2),n=t[0],i=t[1],l=(0,c/* ["default"] */.Z)("sensei_course_video_autopause"),u=(0,s/* ["default"] */.Z)(l,2),m=u[0],d=u[1],p=(0,c/* ["default"] */.Z)("sensei_course_video_required"),g=(0,s/* ["default"] */.Z)(p,2),f=g[0],v=g[1];return(0,r.createElement)(o.PluginDocumentSettingPanel,{name:"sensei-course-video",title:__("Video","sensei-lms")},(0,r.createElement)(a.ToggleControl,{label:__("Autocomplete Lesson","sensei-lms"),checked:n,onChange:i,help:__("Complete lesson when video ends.","sensei-lms")}),(0,r.createElement)(a.ToggleControl,{label:__("Autopause","sensei-lms"),checked:m,onChange:d,help:__("Pause video when student navigates away.","sensei-lms")}),(0,r.createElement)(a.ToggleControl,{label:__("Required","sensei-lms"),checked:f,onChange:v,help:__("Video must be viewed before completing the lesson.","sensei-lms")}))};
/***/},
/***/8698:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>i
/* harmony export */});
/* harmony import */var s=n(4649),r=n(6886),o=n(7798);
/* harmony import */
/* harmony default export */const i=function(e){var t=(0,o.useEntityProp)("postType","course","meta"),n=(0,r/* ["default"] */.Z)(t,2),i=n[0],a=n[1];return[i[e],function(t){return a((0,s/* ["default"] */.Z)({},e,t))}]};
/***/},
/***/1650:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>r
/* harmony export */});
/* harmony import */var s=n(9818);
/* harmony import */
/* harmony default export */const r=function(e){var t=e.subscribeListener,n=void 0===t?function(){}:t,r=e.onSetDirty,o=void 0===r?function(){}:r,i=e.onSaveStart,a=void 0===i?function(){}:i,c=e.onSave,l=void 0===c?function(){}:c,u=(0,s.select)("core/editor"),m=!1,d=!1;return(0,s.subscribe)((function(){n();var e=u.isEditedPostDirty(),t=u.isSavingPost()&&!u.isAutosavingPost();!d&&e?(
// If editor becomes dirty.
d=!0,o()):d=e,m&&!t?(
// If it completed a saving.
m=t,l()):!m&&t?(
// If it started saving.
m=t,a()):m=t}))};
/***/},
/***/2819:
/***/e=>{"use strict";e.exports=window.lodash}
/***/,
/***/4981:
/***/e=>{"use strict";e.exports=window.wp.blocks}
/***/,
/***/5609:
/***/e=>{"use strict";e.exports=window.wp.components}
/***/,
/***/7798:
/***/e=>{"use strict";e.exports=window.wp.coreData}
/***/,
/***/9818:
/***/e=>{"use strict";e.exports=window.wp.data}
/***/,
/***/7701:
/***/e=>{"use strict";e.exports=window.wp.domReady}
/***/,
/***/2067:
/***/e=>{"use strict";e.exports=window.wp.editPost}
/***/,
/***/9307:
/***/e=>{"use strict";e.exports=window.wp.element}
/***/,
/***/1975:
/***/e=>{"use strict";e.exports=window.wp.escapeHtml}
/***/,
/***/2694:
/***/e=>{"use strict";e.exports=window.wp.hooks}
/***/,
/***/5736:
/***/e=>{"use strict";e.exports=window.wp.i18n}
/***/,
/***/8817:
/***/e=>{"use strict";e.exports=window.wp.plugins}
/***/,
/***/1793:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,s=new Array(t);n<t;n++)s[n]=e[n];return s}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/6470:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(e){if(Array.isArray(e))return e}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/726:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */});
/* harmony import */var s=n(4013);function r(e,t){var n="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!n){if(Array.isArray(e)||(n=(0,s/* ["default"] */.Z)(e))||t&&e&&"number"==typeof e.length){n&&(e=n);var r=0,o=function(){};return{s:o,n:function(){return r>=e.length?{done:!0}:{done:!1,value:e[r++]}},e:function(e){throw e},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var i,a=!0,c=!1;return{s:function(){n=n.call(e)},n:function(){var e=n.next();return a=e.done,e},e:function(e){c=!0,i=e},f:function(){try{a||null==n.return||n.return()}finally{if(c)throw i}}}}
/***/},
/***/4649:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/2446:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var s,r,o=[],_n=!0,i=!1;try{for(n=n.call(e);!(_n=(s=n.next()).done)&&(o.push(s.value),!t||o.length!==t);_n=!0);}catch(e){i=!0,r=e}finally{try{_n||null==n.return||n.return()}finally{if(i)throw r}}return o}}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/3764:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/189:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */o
/* harmony export */});
/* harmony import */var s=n(4649);function r(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,s)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach((function(t){(0,s/* ["default"] */.Z)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}
/***/},
/***/6886:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */a
/* harmony export */});
/* harmony import */var s=n(6470),r=n(2446),o=n(4013),i=n(3764);
/* harmony import */function a(e,t){return(0,s/* ["default"] */.Z)(e)||(0,r/* ["default"] */.Z)(e,t)||(0,o/* ["default"] */.Z)(e,t)||(0,i/* ["default"] */.Z)()}
/***/},
/***/4013:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */});
/* harmony import */var s=n(1793);function r(e,t){if(e){if("string"==typeof e)return(0,s/* ["default"] */.Z)(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?(0,s/* ["default"] */.Z)(e,t):void 0}}
/***/},
/***/7231:
/***/e=>{"use strict";e.exports=JSON.parse('{"name":"sensei-lms/course-outline-lesson"}')}
/***/,
/***/6057:
/***/e=>{"use strict";e.exports=JSON.parse('{"name":"sensei-lms/course-outline-module"}')}
/***/,
/***/9200:
/***/e=>{"use strict";e.exports=JSON.parse('{"name":"sensei-lms/course-outline"}')}
/***/
/******/},t={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function n(s){
/******/ // Check if module is in cache
/******/var r=t[s];
/******/if(void 0!==r)
/******/return r.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var o=t[s]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return e[s](o,o.exports,n),o.exports;
/******/}
/******/
/************************************************************************/
/******/ /* webpack/runtime/compat get default export */
/******/
/******/ // getDefaultExport function for compatibility with non-harmony modules
/******/n.n=e=>{
/******/var t=e&&e.__esModule?
/******/()=>e.default
/******/:()=>e
/******/;
/******/return n.d(t,{a:t}),t;
/******/},
/******/ // define getter functions for harmony exports
/******/n.d=(e,t)=>{
/******/for(var s in t)
/******/n.o(t,s)&&!n.o(e,s)&&
/******/Object.defineProperty(e,s,{enumerable:!0,get:t[s]})
/******/;
/******/},
/******/n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)
/******/,
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(()=>{"use strict";
/* harmony import */var e=n(9818),t=n(2694),s=n(7701),r=n.n(s),o=n(8817),i=n(5852),a=n(8793),c=n(5965),l=n(7323),u=n(328);
/* harmony import */
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
!function(){var t=(0,e.select)("core/edit-post"),n=document.getElementsByName("sensei-course-teacher-author");if(t&&n.length){var s=!1;(0,e.subscribe)((function(){if(t.isSavingMetaBoxes()!==s&&!(s=t.isSavingMetaBoxes())){var e=n[0].value;e&&(document.getElementsByName("post_author_override")[0].value=e)}}))}}(),r()((function(){var e,t;(0,i/* .startBlocksTogglingControl */.F)("course"),jQuery("#course-prerequisite-options").select2({width:"100%"});var n=function(e){return function(t){var n={course_status:t.target.dataset.courseStatus};// Get course status from post state if it's available.
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
(0,t.applyFilters)("senseiCoursePricingHide",!1)||(0,o.registerPlugin)("sensei-course-pricing-promo-sidebar",{render:l/* ["default"] */.Z,icon:null})
/**
 * Filters the course access period display.
 *
 * @since 4.1.0
 *
 * @param {boolean} hideCourseAccessPeriod Whether to hide the access period.
 * @return {boolean} Whether to hide the access period.
 */,(0,t.applyFilters)("senseiCourseAccessPeriodHide",!1)||(0,o.registerPlugin)("sensei-course-access-period-promo-plugin",{render:u/* ["default"] */.Z,icon:null}),(0,o.registerPlugin)("sensei-course-theme-plugin",{render:a/* ["default"] */.Z,icon:null}),(0,o.registerPlugin)("sensei-course-video-progression-plugin",{render:c/* ["default"] */.Z,icon:null})})()})
/******/();