/******/(()=>{// webpackBootstrap
/******/"use strict";
/******/var e,t,n,r,a,i,o,s,l={
/***/7253:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */o:()=>/* binding */a
/* harmony export */});
/* harmony import */var r=n(9307),a=function(e){var t=e.id,n=e.label,a=e.detailsLabel,i="sensei-exit-reason__".concat(t),o="".concat(i,"-details");return(0,r.createElement)("div",{className:"sensei-exit-survey__item"},(0,r.createElement)("input",{id:i,type:"radio",name:"reason",value:t,className:"sensei-exit-survey__radio"}),(0,r.createElement)("label",{htmlFor:i}," ",n),a&&(0,r.createElement)("div",{className:"sensei-exit-survey__details"},(0,r.createElement)("input",{id:o,name:"details-".concat(t),defaultValue:"",type:"text",placeholder:a})))};
/* harmony import */}
/***/,
/***/9246:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */C:()=>/* binding */u
/* harmony export */});
/* harmony import */var r=n(5773),a=n(6886),i=n(9307),o=n(5736),s=n(7253),l=n(3306),__=o.__,u=function(e){var t=e.submit,n=e.skip,o=(0,i.useRef)(null),u=(0,i.useState)(null),c=(0,a/* ["default"] */.Z)(u,2)[1],d=(0,i.useCallback)((function(e){e.preventDefault();var n=new window.FormData(o.current),r=n.get("reason");t({reason:r,details:r&&n.get("details-".concat(r))})}),[t]),m=!1;if(o.current){var f,p=new window.FormData(o.current),v="details-".concat(p.get("reason")),y=(null===(f=o.current)||void 0===f?void 0:f.elements[v])||!1;m=!(!p.get("reason")||y&&""===p.get(v).trim())}return(0,i.createElement)("form",{onChange:function(){var e=new window.FormData(o.current);c(e.values())},className:"sensei-modal sensei-exit-survey",ref:o,onSubmit:d},(0,i.createElement)("div",{className:"sensei-exit-survey__content"},(0,i.createElement)("h2",null,__("Quick Feedback","sensei-lms")),(0,i.createElement)("p",null,__("If you have a moment, please let us know why you are deactivating so that we can work to improve our product.","sensei-lms")),l/* .reasons.map */.l.map((function(e){return(0,i.createElement)(s/* .ExitSurveyFormItem */.o,(0,r/* ["default"] */.Z)({key:e.id},e))}))),(0,i.createElement)("div",{className:"sensei-exit-survey__buttons"},(0,i.createElement)("button",{className:"button button-primary",type:"submit",disabled:!m},__("Submit Feedback","sensei-lms")),(0,i.createElement)("button",{className:"button button-secondary",onClick:n,type:"button"},__("Skip Feedback","sensei-lms"))))};
/* harmony import */}
/***/,
/***/3306:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */l:()=>/* binding */a
/* harmony export */});
/* harmony import */var r=n(5736),__=r.__,a=[{id:"no-longer-need",label:__("I no longer need the plugin","sensei-lms")},{id:"not-working",label:__("The plugin isn't working","sensei-lms"),detailsLabel:__("What isn't working properly?","sensei-lms")},{id:"different-functionality",label:__("I'm looking for different functionality","sensei-lms"),detailsLabel:__("What functionality is missing?","sensei-lms")},{id:"found-better-plugin",label:__("I found a better plugin","sensei-lms"),detailsLabel:__("What's the name of the plugin?","sensei-lms")},{id:"temporary",label:__("It's a temporary deactivation","sensei-lms")},{id:"other",label:"Other",detailsLabel:__("Why are you deactivating?","sensei-lms")}];
/* harmony import */}
/***/,
/***/9307:
/***/e=>{e.exports=window.wp.element;
/***/},
/***/5736:
/***/e=>{e.exports=window.wp.i18n;
/***/},
/***/1793:
/***/(e,t,n)=>{function r(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/6470:
/***/(e,t,n)=>{function r(e){if(Array.isArray(e))return e}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/7791:
/***/(e,t,n)=>{function r(e,t,n,r,a,i,o){try{var s=e[i](o),l=s.value}catch(e){return void n(e)}s.done?t(l):Promise.resolve(l).then(r,a)}function a(e){return function(){var t=this,n=arguments;return new Promise((function(a,i){var o=e.apply(t,n);function s(e){r(o,a,i,s,l,"next",e)}function l(e){r(o,a,i,s,l,"throw",e)}s(void 0)}))}}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */a
/* harmony export */})},
/***/2951:
/***/(e,t,n)=>{function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/1976:
/***/(e,t,n)=>{function r(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function a(e,t,n){return t&&r(e.prototype,t),n&&r(e,n),Object.defineProperty(e,"prototype",{writable:!1}),e}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */a
/* harmony export */})},
/***/4649:
/***/(e,t,n)=>{function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/5773:
/***/(e,t,n)=>{function r(){return r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},r.apply(this,arguments)}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/2446:
/***/(e,t,n)=>{function r(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var r,a,i=[],_n=!0,o=!1;try{for(n=n.call(e);!(_n=(r=n.next()).done)&&(i.push(r.value),!t||i.length!==t);_n=!0);}catch(e){o=!0,a=e}finally{try{_n||null==n.return||n.return()}finally{if(o)throw a}}return i}}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/3764:
/***/(e,t,n)=>{function r(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}
/***/
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/6886:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */});
/* harmony import */var r=n(6470),a=n(2446),i=n(4013),o=n(3764);
/* harmony import */function s(e,t){return(0,r/* ["default"] */.Z)(e)||(0,a/* ["default"] */.Z)(e,t)||(0,i/* ["default"] */.Z)(e,t)||(0,o/* ["default"] */.Z)()}
/***/},
/***/4013:
/***/(e,t,n)=>{
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */a
/* harmony export */});
/* harmony import */var r=n(1793);function a(e,t){if(e){if("string"==typeof e)return(0,r/* ["default"] */.Z)(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?(0,r/* ["default"] */.Z)(e,t):void 0}}
/***/
/******/}},u={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function c(e){
/******/ // Check if module is in cache
/******/var t=u[e];
/******/if(void 0!==t)
/******/return t.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var n=u[e]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return l[e](n,n.exports,c),n.exports;
/******/}
/******/
/************************************************************************/
/******/ /* webpack/runtime/compat get default export */
/******/
/******/ // getDefaultExport function for compatibility with non-harmony modules
/******/c.n=e=>{
/******/var t=e&&e.__esModule?
/******/()=>e.default
/******/:()=>e
/******/;
/******/return c.d(t,{a:t}),t;
/******/},
/******/ // define getter functions for harmony exports
/******/c.d=(e,t)=>{
/******/for(var n in t)
/******/c.o(t,n)&&!c.o(e,n)&&
/******/Object.defineProperty(e,n,{enumerable:!0,get:t[n]})
/******/;
/******/},
/******/c.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)
/******/,
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
n=c(7791),r=c(1976),a=c(2951),i=c(4649),o=c(9307),s=c(9246),
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
t=(0,r/* ["default"] */.Z)((
/**
   * Exit survey constructor.
   *
   * @param {string} href Link to deactivate plugin.
   */
function e(t){var r=this,l=t.href;(0,a/* ["default"] */.Z)(this,e),(0,i/* ["default"] */.Z)(this,"href",void 0),(0,i/* ["default"] */.Z)(this,"container",void 0),(0,i/* ["default"] */.Z)(this,"open",(function(){var e=document.querySelector("#sensei-exit-survey");e||((e=document.createElement("div")).setAttribute("id","sensei-exit-survey-modal"),document.body.appendChild(e)),r.container=e,(0,o.render)((0,o.createElement)(s/* .ExitSurveyForm */.C,{submit:r.submitExitSurvey,skip:r.closeAndDeactivate}),e)})),(0,i/* ["default"] */.Z)(this,"submitExitSurvey",function(){var e=(0,n/* ["default"] */.Z)(regeneratorRuntime.mark((function e(t){var n,a;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return(a=new window.FormData).append("action","exit_survey"),a.append("_wpnonce",null===(n=window.sensei_exit_survey)||void 0===n?void 0:n.nonce),a.append("reason",t.reason),a.append("details",t.details),e.next=7,window.fetch(window.ajaxurl,{method:"POST",body:a});case 7:r.closeAndDeactivate();case 8:case"end":return e.stop()}}),e)})));return function(_x){return e.apply(this,arguments)}}()),(0,i/* ["default"] */.Z)(this,"closeAndDeactivate",(function(){r.container.remove(),window.location=r.href})),this.href=l}
/**
   * Create and open a modal with an exit survey form.
   *
   */)),[(e=function(e){return document.querySelector('#the-list [data-slug="'.concat(e,'"] span.deactivate a'))})("sensei-lms"),e("sensei-with-woocommerce-paid-courses"),e("woocommerce-com-woocommerce-paid-courses")].filter((function(e){return!!e})).forEach((function(e){e.addEventListener("click",(function(e){e.preventDefault(),new t({href:e.target.href}).open()}))}))})
/******/();