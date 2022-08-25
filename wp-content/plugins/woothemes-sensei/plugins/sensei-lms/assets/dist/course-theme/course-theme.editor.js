/******/(()=>{// webpackBootstrap
/******/"use strict";
/******/var e={
/***/96483:
/***/e=>{e.exports=window.wp.url;
/***/
/******/}},t={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function n(o){
/******/ // Check if module is in cache
/******/var r=t[o];
/******/if(void 0!==r)
/******/return r.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var a=t[o]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return e[o](a,a.exports,n),a.exports;
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
/******/for(var o in t)
/******/n.o(t,o)&&!n.o(e,o)&&
/******/Object.defineProperty(e,o,{enumerable:!0,get:t[o]})
/******/;
/******/},
/******/n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)
/******/,
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(()=>{
/* harmony import */var e=n(96483);
/* harmony import */
/**
 * Reload the page when opening or closing a course theme template, to ensure the active theme styles are not loaded.
 */
function t(){var t=(0,e.getQueryArgs)(document.location),n=t.postId&&t.postId.match(/sensei-course-theme/),o=t.learn;if(t.learn=n?"1":void 0,!!t.learn!=!!o){var r=(0,e.addQueryArgs)(document.location.path,t);document.body.style.display="none",document.location.replace(r)}}
/**
 * Monkey-patch history.pushState and replaceState to provide events for location change.
 */
/* eslint-disable @wordpress/no-global-event-listener */
/**
 * WordPress dependencies
 */
window.addEventListener("locationchange",t),window.addEventListener("popstate",t);var o=window.history,r=o.replaceState,a=o.pushState;window.history.replaceState=function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];r.apply(window.history,t),window.dispatchEvent(new window.Event("locationchange",t))},window.history.pushState=function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];a.apply(window.history,t),window.dispatchEvent(new window.Event("locationchange",t))}})()})
/******/();