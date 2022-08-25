/******/(()=>{// webpackBootstrap
/******/"use strict";
/******/var e,t={
/***/7701:
/***/e=>{e.exports=window.wp.domReady;
/***/
/******/}},s={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function o(e){
/******/ // Check if module is in cache
/******/var i=s[e];
/******/if(void 0!==i)
/******/return i.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var n=s[e]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return t[e](n,n.exports,o),n.exports;
/******/}
/******/
/************************************************************************/
/******/ /* webpack/runtime/compat get default export */
/******/
/******/ // getDefaultExport function for compatibility with non-harmony modules
/******/o.n=e=>{
/******/var t=e&&e.__esModule?
/******/()=>e.default
/******/:()=>e
/******/;
/******/return o.d(t,{a:t}),t;
/******/},
/******/ // define getter functions for harmony exports
/******/o.d=(e,t)=>{
/******/for(var s in t)
/******/o.o(t,s)&&!o.o(e,s)&&
/******/Object.defineProperty(e,s,{enumerable:!0,get:t[s]})
/******/;
/******/},
/******/o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)
/******/,
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
e=o(7701),
/**
 * WordPress dependencies
 */
o.n(e)()((function(){document.querySelectorAll(".sensei-notice").forEach((function(e){e.addEventListener("click",(function(t){if(e.dataset.dismissNonce&&e.dataset.dismissAction&&t.target.classList.contains("notice-dismiss")){var s=new FormData;e.dataset.dismissNotice&&s.append("notice",e.dataset.dismissNotice),s.append("action",e.dataset.dismissAction),s.append("nonce",e.dataset.dismissNonce),fetch(ajaxurl,{method:"POST",body:s})}}))}))}))})
/******/();