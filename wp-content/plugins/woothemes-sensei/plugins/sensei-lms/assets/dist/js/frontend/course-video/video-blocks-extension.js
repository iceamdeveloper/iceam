/******/(()=>{// webpackBootstrap
/******/"use strict";
/******/var e,n,o,t,i={
/***/24430:
/***/(e,n,o)=>{
/* harmony export */o.d(n,{
/* harmony export */K:()=>/* binding */c
/* harmony export */});
/* harmony import */var t=o(92694),i=window.sensei.courseVideoSettings,r=i.courseVideoRequired,d=i.courseVideoAutoComplete,s=i.courseVideoAutoPause,u={},c=function(e){var n=e.pauseVideo,o=void 0===n?function(){}:n,i=e.registerVideoEndHandler,s=void 0===i?function(){}:i,c=e.url,f=void 0===c?"":c,m=e.blockElement,E=m.hasAttribute("data-sensei-is-required"),g=m.hasAttribute("data-sensei-is-not-required");// Block level setting overwrites the course level setting.
(E||r&&!g)&&(
/**
     * Called when a required video for the current lesson is registered.
     *
     * @since 4.4.3
     *
     * @hook sensei.videoProgression.registerVideo Hook used to run an arbitrary code when new required
     *                                             video for the current lesson is registered.
     * @param {Object}      video
     * @param {string}      video.url          The source url of the video.
     * @param {HTMLElement} video.blockElement The video block DOM element.
     */
(0,t.doAction)("sensei.videoProgression.registerVideo",{url:f,blockElement:m}),u[f]={pauseVideo:o,completed:!1},l()),s((function(){
// Block level setting overwrites the course level setting.
(E||r&&!g)&&(
/**
       * Called when a required video for the current lesson is finished playing.
       *
       * @since 4.4.3
       *
       * @hook sensei.videoProgression.videoEnded Hook used to run an arbitrary code when a required video
       *                                          for the current lesson is finished playing.
       * @param {Object} video
       * @param {string} video.url The source url of the video.
       */
(0,t.doAction)("sensei.videoProgression.videoEnded",{url:f}),u[f].completed=!0,a()&&v()),d&&a()&&p()}))},a=function(){var e=!0;for(var n in u)u[n].completed||(e=!1);
/**
   * Tells if all the required videos for the current lesson are finished playing or not.
   *
   * @since 4.4.3
   *
   * @hook sensei.videoProgression.allCompleted Hook used to tell if all the required videos for the current lesson have finished playing.
   *
   * @param {boolean} allCompleted Whether all the required videos for the current lesson are completed.
   */return e=(0,t.applyFilters)("sensei.videoProgression.allCompleted",e)},l=function(){(0,t.applyFilters)("sensei.videoProgression.preventLessonCompletion",!0)&&document.querySelectorAll('[data-id="complete-lesson-button"]').forEach((function(e){e.disabled=!0,e.addEventListener("click",f)}))},f=function(e){return e.preventDefault(),!1},v=function(){(0,t.applyFilters)("sensei.videoProgression.allowLessonCompletion",!0)&&document.querySelectorAll('[data-id="complete-lesson-button"]').forEach((function(e){e.removeEventListener("click",f),e.disabled=!1}))},p=function(){var e=document.querySelector('[data-id="complete-lesson-button"]');e&&setTimeout((function(){e.click()}),3e3)};
/* harmony import */
/**
 * If pause video setting is set. Then attach an event listener
 * to detect user navigating away and pause the videos.
 */
s&&void 0!==document.hidden&&
// eslint-disable-next-line @wordpress/no-global-event-listener
document.addEventListener("visibilitychange",(function(){if(document.hidden)for(var e in u){var n=u[e].pauseVideo;"function"==typeof n&&n()}}),!1)
/***/},
/***/59446:
/***/(e,n,o)=>{
/* harmony export */o.d(n,{
/* harmony export */t:()=>/* binding */r
/* harmony export */});
/* harmony import */var t=o(24430),i=function(e){var n=function(){};e.addEventListener("ended",(function(){n()})),(0,t/* .registerVideo */.K)({registerVideoEndHandler:function(e){n=e},pauseVideo:e.pause.bind(e),url:e.src.split("?")[0],blockElement:e.closest("figure")})},r=function(){document.querySelectorAll(".sensei-course-video-container video").forEach(i)};
/**
 * Internal dependencies
 */
/**
 * Initializes the Video block player.
 *
 * @param {HTMLElement} video The video element of the Video block.
 */}
/***/,
/***/21878:
/***/(e,n,o)=>{
/* harmony export */o.d(n,{
/* harmony export */G:()=>/* binding */r
/* harmony export */});
/* harmony import */var t=o(24430),i=function(e){var n,o,i=(n=e.src,(o=n.split("?")[0].split("/"))[o.length-1]),r=function(){};// eslint-disable-next-line @wordpress/no-global-event-listener
window.addEventListener("message",(function(n){n.source===e.contentWindow&&"videopress_ended"===n.data.event&&n.data.id===i&&r()}),!1),(0,t/* .registerVideo */.K)({registerVideoEndHandler:function(e){r=e},pauseVideo:function(){e.contentWindow.postMessage({event:"videopress_action_pause"},"*")},url:e.src.split("?")[0],blockElement:e.closest("figure")})},r=function(){document.querySelectorAll(".sensei-course-video-container.videopress-extension iframe").forEach(i)};
/**
 * Internal dependencies
 */
/**
 * Extracts the video id from the url of the video.
 *
 * @param {string} url The url of the video.
 * @return {string} The id of the video.
 */}
/***/,
/***/68519:
/***/(e,n,o)=>{
/* harmony export */o.d(n,{
/* harmony export */V:()=>/* binding */r
/* harmony export */});
/* harmony import */var t=o(24430),i=function(e){var n=function(){},o=new Vimeo.Player(e);o.on("ended",(function(){n()})),o.getVideoUrl().then((function(i){(0,t/* .registerVideo */.K)({registerVideoEndHandler:function(e){n=e},pauseVideo:o.pause.bind(o),url:i,blockElement:e.closest("figure")})}))},r=function(){document.querySelectorAll(".sensei-course-video-container.vimeo-extension iframe").forEach(i)};
/**
 * Internal dependencies
 */
/**
 * Initializes Vimeo block video player.
 *
 * @param {HTMLElement} iframe The iframe element of the Vimeo video block.
 */}
/***/,
/***/39039:
/***/(e,n,o)=>{
/* harmony export */o.d(n,{
/* harmony export */$:()=>/* binding */u
/* harmony export */});
/* harmony import */var t=o(24430),i=function(e){var n=function(){},o=YT.get(e.id)||new YT.Player(e),i=function(){(0,t/* .registerVideo */.K)({pauseVideo:o.pauseVideo.bind(o),registerVideoEndHandler:function(e){n=e},url:o.getVideoUrl(),blockElement:e.closest("figure")})};o.getDuration?
// Just in case it's called after the player is ready.
i():o.addEventListener("onReady",i),o.addEventListener("onStateChange",(function(e){e.data===YT.PlayerState.ENDED&&n()}))},r=!1,d=!1,s=function(){r&&d&&document.querySelectorAll(".sensei-course-video-container.youtube-extension iframe").forEach(i)},u=function(){r=!0,s()};
/**
 * Internal dependencies
 */
/**
 * Initializes the YouTube video block player.
 *
 * @param {HTMLElement} iframe The iframe element of the YouTube video block.
 */window.senseiYouTubeIframeAPIReady.then((function(){d=!0,s()}))}
/***/,
/***/92694:
/***/e=>{e.exports=window.wp.hooks;
/***/
/******/}},r={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function d(e){
/******/ // Check if module is in cache
/******/var n=r[e];
/******/if(void 0!==n)
/******/return n.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var o=r[e]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return i[e](o,o.exports,d),o.exports;
/******/}
/******/
/************************************************************************/
/******/ /* webpack/runtime/compat get default export */
/******/
/******/ // getDefaultExport function for compatibility with non-harmony modules
/******/d.n=e=>{
/******/var n=e&&e.__esModule?
/******/()=>e.default
/******/:()=>e
/******/;
/******/return d.d(n,{a:n}),n;
/******/},
/******/ // define getter functions for harmony exports
/******/d.d=(e,n)=>{
/******/for(var o in n)
/******/d.o(n,o)&&!d.o(e,o)&&
/******/Object.defineProperty(e,o,{enumerable:!0,get:n[o]})
/******/;
/******/},
/******/d.o=(e,n)=>Object.prototype.hasOwnProperty.call(e,n)
/******/,
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
e=d(39039),n=d(59446),o=d(68519),t=d(21878),
/**
 * Internal dependencies
 */
// Initialize video extensions only after all the resources are loaded.
// This makes sure that Required Blocks feature can hook into the
// Course Video Progression feature before it starts firing it's hooks.
// eslint-disable-next-line @wordpress/no-global-event-listener
window.addEventListener("load",(function(){(0,t/* .initVideoPressExtension */.G)(),(0,n/* .initVideoExtension */.t)(),(0,o/* .initVimeoExtension */.V)(),(0,e/* .initYouTubeExtension */.$)()}))})
/******/();