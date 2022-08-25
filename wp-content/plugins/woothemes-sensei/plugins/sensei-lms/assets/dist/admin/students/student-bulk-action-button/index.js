/******/(()=>{// webpackBootstrap
/******/var e={
/***/9854:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var r=n(9307),s=n(444);
/* harmony import */
/**
 * WordPress dependencies
 */
const o=(0,r.createElement)(s.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,r.createElement)(s.Path,{d:"M13.5 6C10.5 6 8 8.5 8 11.5c0 1.1.3 2.1.9 3l-3.4 3 1 1.1 3.4-2.9c1 .9 2.2 1.4 3.6 1.4 3 0 5.5-2.5 5.5-5.5C19 8.5 16.5 6 13.5 6zm0 9.5c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"}));
/* harmony default export */}
//# sourceMappingURL=search.js.map
/***/,
/***/42:
/***/(e,t)=>{var n;
/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */!function(){"use strict";var r={}.hasOwnProperty;function s(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var o=typeof n;if("string"===o||"number"===o)e.push(n);else if(Array.isArray(n)){if(n.length){var i=s.apply(null,n);i&&e.push(i)}}else if("object"===o)if(n.toString===Object.prototype.toString)for(var a in n)r.call(n,a)&&n[a]&&e.push(a);else e.push(n.toString())}}return e.join(" ")}e.exports?(s.default=s,e.exports=s):void 0===(n=function(){return s}.apply(t,[]))||(e.exports=n)}()}
/***/,
/***/483:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */});
/* harmony import */var r=n(9307);
/* harmony import */
/**
 * WordPress dependencies
 */
// Solution borrowed from https://gist.github.com/kentcdodds/b36572b6e9227207e6c71fd80e63f3b4.
function s(){var e=(0,r.useRef)(),t=(0,r.useCallback)((function(){return e.current||(e.current=new AbortController),e.current}),[]);return(0,r.useEffect)((function(){return function(){return t().abort()}}),[t]),{getSignal:(0,r.useCallback)((function(){return t().signal}),[t])}}
/***/},
/***/5031:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>p
/* harmony export */});
/* unused harmony export CourseList */
/* harmony import */var r=n(228),s=n(6886),o=n(9307),i=n(5609),a=n(2629),u=n(5736),l=n(7798),c=n(6938),__=u.__,d=function(){return(0,o.createElement)("li",{className:"sensei-student-modal__course-list--loading"},(0,o.createElement)(i.Spinner,null))},m=function(){return(0,o.createElement)("li",{className:"sensei-student-modal__course-list--empty"},__("No courses found.","sensei-lms"))},f=function(e){var t,n=e.course,r=e.checked,u=void 0!==r&&r,l=e.onChange,c=null==n?void 0:n.id,d=(0,a.decodeEntities)(null==n||null===(t=n.title)||void 0===t?void 0:t.rendered),m=(0,o.useState)(u),f=(0,s/* ["default"] */.Z)(m,2),p=f[0],v=f[1],g=(0,o.useCallback)((function(e){v(e),l({isSelected:e,course:n})}),[n,l]);return(0,o.createElement)("li",{className:"sensei-student-modal__course-list__item",key:c},(0,o.createElement)(i.CheckboxControl,{id:"course-".concat(c),title:d,checked:p,onChange:g}),(0,o.createElement)("label",{htmlFor:"course-".concat(c),title:d},d))};
/* harmony import */
/* harmony default export */const p=function(e){var t=e.searchQuery,n=e.onChange,s=(0,o.useRef)([]),i=(0,o.useCallback)((function(e){var t=e.isSelected,o=e.course;s.current=t?[].concat((0,r/* ["default"] */.Z)(s.current),[o]):s.current.filter((function(e){return e.id!==o.id})),n(s.current)}),[n]),a=(0,c/* ["default"] */.Z)((function(e){var n=e(l.store),r={per_page:100,search:t};return{courses:n.getEntityRecords("postType","course",r)||[],isFetching:!n.hasFinishedResolution("getEntityRecords",["postType","course",r])}}),[t],500),u=a.courses,p=a.isFetching;return(0,o.createElement)(o.Fragment,null,(0,o.createElement)("span",{className:"sensei-student-modal__course-list__header"},__("Your Courses","sensei-lms")),(0,o.createElement)("ul",{className:"sensei-student-modal__course-list"},p&&(0,o.createElement)(d,null),!p&&0===u.length&&(0,o.createElement)(m,null),!p&&0<u.length&&u.map((function(e){return(0,o.createElement)(f,{key:e.id,course:e,onChange:i,checked:s.current.length>0&&s.current.find((function(t){return t.id===e.id}))})}))))};
/***/},
/***/9240:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>v
/* harmony export */});
/* unused harmony export StudentModal */
/* harmony import */var r=n(7791),s=n(6886),o=n(9307),i=n(5609),a=n(9854),u=n(5736),l=n(1975),c=n(6989),d=n.n(c),m=n(5031),f=n(1442),p=n(483),__=u.__,_n=u._n;
/* harmony import */
/* harmony default export */const v=function(e){var t=e.action,n=e.onClose,c=e.students,v=e.studentDisplayName,g=function(e,t,n){var r=(0,l.escapeHTML)(n);return{add:{description:t>1?(0,u.sprintf)(// Translators: placeholder is the number of selected students.
__("Select the course(s) you would like to add <strong>%d students</strong> to:","sensei-lms"),t):(0,u.sprintf)(// Translators: placeholder is the student's name.
__("Select the course(s) you would like to add <strong>%s</strong> to:","sensei-lms"),r),buttonLabel:__("Add to Course","sensei-lms"),errorMessage:function(e){return _n("Unable to add student. Please try again.","Unable to add students. Please try again.",e.length,"sensei-lms")},sendAction:function(e,t,n){var r=n.signal;return d()({path:"/sensei-internal/v1/course-students/batch",method:"POST",data:{student_ids:e,course_ids:t},signal:r})},isDestructive:!1},remove:{description:t>1?(0,u.sprintf)(// Translators: placeholder is the number of selected students.
__("Select the course(s) you would like to remove <strong>%d students</strong> from:","sensei-lms"),t):(0,u.sprintf)(// Translators: placeholder is the student's name.
__("Select the course(s) you would like to remove <strong>%s</strong> from:","sensei-lms"),r),buttonLabel:__("Remove from Course","sensei-lms"),errorMessage:function(e){return _n("Unable to remove student. Please try again.","Unable to remove students. Please try again.",e.length,"sensei-lms")},sendAction:function(e,t,n){var r=n.signal;return d()({path:"/sensei-internal/v1/course-students/batch",method:"DELETE",data:{student_ids:e,course_ids:t},signal:r})},isDestructive:!0},"reset-progress":{
// Translators: placeholder is the number of selected students for plural, student's name for singular.
description:t>1?(0,u.sprintf)(// Translators: placeholder is the number of selected students.
__("Select the course(s) you would like to reset or remove progress from for <strong>%d students</strong>:","sensei-lms"),t):(0,u.sprintf)(// Translators: placeholder is the student's name.
__("Select the course(s) you would like to reset or remove progress from for <strong>%s</strong>:","sensei-lms"),r),buttonLabel:__("Reset or Remove Progress","sensei-lms"),errorMessage:function(e){return _n("Unable to reset or remove progress for this student. Please try again.","Unable to reset or remove progress for these students. Please try again.",e.length,"sensei-lms")},sendAction:function(e,t,n){var r=n.signal;return d()({path:"/sensei-internal/v1/course-progress/batch",method:"DELETE",data:{student_ids:e,course_ids:t},signal:r})},isDestructive:!0}}[e]}(t,c.length,v),h=g.description,b=g.buttonLabel,y=g.errorMessage,w=g.isDestructive,E=g.sendAction,Z=(0,o.useState)([]),_=(0,s/* ["default"] */.Z)(Z,2),S=_[0],C=_[1],k=(0,o.useState)(""),x=(0,s/* ["default"] */.Z)(k,2),A=x[0],N=x[1],O=(0,o.useState)(!1),P=(0,s/* ["default"] */.Z)(O,2),j=P[0],R=P[1],D=(0,o.useState)(!1),T=(0,s/* ["default"] */.Z)(D,2),L=T[0],M=T[1],I=(0,p/* ["default"] */.Z)().getSignal,F=(0,o.useCallback)((0,r/* ["default"] */.Z)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return R(!0),e.prev=1,e.next=4,E(c,S.map((function(e){return e.id})),{signal:I()});case 4:n(!0),e.next=10;break;case 7:e.prev=7,e.t0=e.catch(1),I().aborted||(M(!0),R(!1));case 10:case"end":return e.stop()}}),e,null,[[1,7]])}))),[E,c,S,n,I]);return(0,o.createElement)(i.Modal,{className:"sensei-student-modal",title:__("Choose Course","sensei-lms"),onRequestClose:function(){return n()}},(0,o.createElement)(o.RawHTML,null,h),(0,o.createElement)(f/* ["default"] */.Z,{iconRight:a/* ["default"] */.Z,onChange:function(e){return N(e)},placeholder:__("Search courses","sensei-lms"),value:A}),(0,o.createElement)(m/* ["default"] */.Z,{searchQuery:A,onChange:function(e){C(e)}}),L&&(0,o.createElement)(i.Notice,{status:"error",isDismissible:!1,className:"sensei-student-modal__notice"},y(c)),(0,o.createElement)("div",{className:"sensei-student-modal__action"},(0,o.createElement)(i.Button,{className:"sensei-student-modal__action",variant:w?"":"primary",onClick:function(){return F()},disabled:j||0===S.length,isDestructive:w},j&&(0,o.createElement)(i.Spinner,null),b)))};
/***/},
/***/1442:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>c
/* harmony export */});
/* harmony import */var r=n(5773),s=n(3782),o=n(9307),i=n(42),a=n.n(i),u=n(5609),l=["className","id","label","value","help","iconRight","onChange"];
/* harmony import */
/* harmony default export */const c=function(e){var t=e.className,n=e.id,i=e.label,c=e.value,d=e.help,m=e.iconRight,f=e.onChange,p=(0,s/* ["default"] */.Z)(e,l);return(0,o.createElement)(u.BaseControl,{id:n,label:i,help:d},(0,o.createElement)("div",{className:"sensei-input-control"},(0,o.createElement)("input",(0,r/* ["default"] */.Z)({className:a()("sensei-input-control__input",{"sensei-input-control__input--with-icon-right":m},t),type:"text",id:n,value:null===c?"":c,onChange:function(e){return f(e.target.value)}},p)),m&&(0,o.createElement)("span",{className:"sensei-input-control__icon"},(0,o.createElement)(u.Icon,{icon:m}))))};
/***/},
/***/6938:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>a
/* harmony export */});
/* harmony import */var r=n(6886),s=n(2819),o=n(9818),i=n(9307);
/* harmony import */
/* harmony default export */const a=function(e,t,n){var a=(0,i.useState)(t),u=(0,r/* ["default"] */.Z)(a,2),l=u[0],c=u[1],d=(0,i.useCallback)((0,s.debounce)(c,n),[c,n]);// eslint-disable-next-line react-hooks/exhaustive-deps -- Using debounce as callback.
return(0,i.useEffect)((function(){d(t);// eslint-disable-next-line react-hooks/exhaustive-deps -- Dependencies coming from args.
}),t),(0,o.useSelect)(e,l)};
/***/},
/***/2819:
/***/e=>{"use strict";e.exports=window.lodash}
/***/,
/***/6989:
/***/e=>{"use strict";e.exports=window.wp.apiFetch}
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
/***/9307:
/***/e=>{"use strict";e.exports=window.wp.element}
/***/,
/***/1975:
/***/e=>{"use strict";e.exports=window.wp.escapeHtml}
/***/,
/***/2629:
/***/e=>{"use strict";e.exports=window.wp.htmlEntities}
/***/,
/***/5736:
/***/e=>{"use strict";e.exports=window.wp.i18n}
/***/,
/***/444:
/***/e=>{"use strict";e.exports=window.wp.primitives}
/***/,
/***/1793:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/6470:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e){if(Array.isArray(e))return e}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/8138:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */});
/* harmony import */var r=n(1793);function s(e){if(Array.isArray(e))return(0,r/* ["default"] */.Z)(e)}
/***/},
/***/7791:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e,t,n,r,s,o,i){try{var a=e[o](i),u=a.value}catch(e){return void n(e)}a.done?t(u):Promise.resolve(u).then(r,s)}function s(e){return function(){var t=this,n=arguments;return new Promise((function(s,o){var i=e.apply(t,n);function a(e){r(i,s,o,a,u,"next",e)}function u(e){r(i,s,o,a,u,"throw",e)}a(void 0)}))}}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/5773:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(){return r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},r.apply(this,arguments)}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/5181:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/2446:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var r,s,o=[],_n=!0,i=!1;try{for(n=n.call(e);!(_n=(r=n.next()).done)&&(o.push(r.value),!t||o.length!==t);_n=!0);}catch(e){i=!0,s=e}finally{try{_n||null==n.return||n.return()}finally{if(i)throw s}}return o}}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/3764:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/3314:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/3782:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */});
/* harmony import */var r=n(808);function s(e,t){if(null==e)return{};var n,s,o=(0,r/* ["default"] */.Z)(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(s=0;s<i.length;s++)n=i[s],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(o[n]=e[n])}return o}
/***/},
/***/808:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e,t){if(null==e)return{};var n,r,s={},o=Object.keys(e);for(r=0;r<o.length;r++)n=o[r],t.indexOf(n)>=0||(s[n]=e[n]);return s}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/6886:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */a
/* harmony export */});
/* harmony import */var r=n(6470),s=n(2446),o=n(4013),i=n(3764);
/* harmony import */function a(e,t){return(0,r/* ["default"] */.Z)(e)||(0,s/* ["default"] */.Z)(e,t)||(0,o/* ["default"] */.Z)(e,t)||(0,i/* ["default"] */.Z)()}
/***/},
/***/228:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */a
/* harmony export */});
/* harmony import */var r=n(8138),s=n(5181),o=n(4013),i=n(3314);
/* harmony import */function a(e){return(0,r/* ["default"] */.Z)(e)||(0,s/* ["default"] */.Z)(e)||(0,o/* ["default"] */.Z)(e)||(0,i/* ["default"] */.Z)()}
/***/},
/***/4013:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */});
/* harmony import */var r=n(1793);function s(e,t){if(e){if("string"==typeof e)return(0,r/* ["default"] */.Z)(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?(0,r/* ["default"] */.Z)(e,t):void 0}}
/***/
/******/}},t={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function n(r){
/******/ // Check if module is in cache
/******/var s=t[r];
/******/if(void 0!==s)
/******/return s.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var o=t[r]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return e[r](o,o.exports,n),o.exports;
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
/******/for(var r in t)
/******/n.o(t,r)&&!n.o(e,r)&&
/******/Object.defineProperty(e,r,{enumerable:!0,get:t[r]})
/******/;
/******/},
/******/n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)
/******/,
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(()=>{"use strict";
/* unused harmony export StudentBulkActionButton */
/* harmony import */var e=n(6886),t=n(9307),r=n(5609),s=n(5736),o=n(9240),__=s.__,i=function(n){var s=n.isDisabled,i=void 0===s||s,a=(0,t.useState)("add"),u=(0,e/* ["default"] */.Z)(a,2),l=u[0],c=u[1],d=(0,t.useState)(!1),m=(0,e/* ["default"] */.Z)(d,2),f=m[0],p=m[1],v=(0,t.useState)([]),g=(0,e/* ["default"] */.Z)(v,2),h=g[0],b=g[1],y=(0,t.useState)(""),w=(0,e/* ["default"] */.Z)(y,2),E=w[0],Z=w[1],_=(0,t.useState)(i),S=(0,e/* ["default"] */.Z)(_,2),C=S[0],k=S[1],x=function(e){k(!(e.detail&&e.detail.enable))};(0,t.useEffect)((function(){return window.addEventListener("enableDisableCourseSelectionToggle",x),function(){window.removeEventListener("enableDisableCourseSelectionToggle",x)}}),[]);return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(r.Button,{className:"button button-primary sensei-student-bulk-actions__button",disabled:C,id:"sensei-bulk-learner-actions-modal-toggle",onClick:function(){var e=document.getElementById("bulk-action-selector-top"),t=document.getElementById("bulk-action-user-ids");if(e&&function(e){switch(e){case"enrol_restore_enrolment":c("add");break;case"remove_enrolment":c("remove");break;case"remove_progress":c("reset-progress")}}(e.value),t)try{var n=JSON.parse(t.value);b(n),1===n.length&&Z(document.querySelector("input.sensei_user_select_id:checked").closest("tr").querySelector(".student-action-menu").getAttribute("data-user-display-name"))}catch(e){}p(!0)}},__("Select Action","sensei-lms")),(0,t.createElement)("input",{type:"hidden",id:"bulk-action-user-ids"}),f&&(0,t.createElement)(o/* ["default"] */.Z,{action:l,onClose:function(e){e&&window.location.reload(),p(!1)},students:h,studentDisplayName:E}))};
/* harmony import */Array.from(document.querySelectorAll("div.sensei-student-bulk-actions__button")).forEach((function(e){(0,t.render)((0,t.createElement)(i,null),e)}))})()})
/******/();