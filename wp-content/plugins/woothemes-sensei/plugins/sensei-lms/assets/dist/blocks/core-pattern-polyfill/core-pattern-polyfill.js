/******/(()=>{// webpackBootstrap
/******/"use strict";
/******/var e,t,r={
/***/8930:
/***/(e,t,r)=>{
/* harmony export */r.d(t,{
/* harmony export */Z:()=>a
/* harmony export */});
/* harmony import */var n,o=r(99196);
/* harmony import */function c(){return c=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)Object.prototype.hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},c.apply(this,arguments)}
/* harmony default export */const a=function(e){
return o.createElement("svg",c({viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},e),n||(n=o.createElement("path",{d:"M12 24a12 12 0 1 0 0-24 12 12 0 0 0 0 24Zm-.1-4.723c-2.849 0-4.517-1.072-4.575-3.011 0-.203 0-.405.029-.608 1.208 1.013 2.733 1.65 4.603 1.65 1.64 0 2.733-.695 2.733-1.708 0-.608-.978-.897-2.244-1.274-2.33-.752-5.553-1.736-5.553-5.181 0-2.721 1.957-4.458 5.323-4.458 2.905 0 4.66 1.042 4.689 3.242v.376c-1.496-1.187-3.107-1.794-4.862-1.794-1.64 0-2.848.636-2.848 1.592 0 .55.978.868 2.244 1.273 2.33.753 5.667 1.824 5.667 5.24 0 2.808-2.186 4.66-5.207 4.66Z",fill:"currentColor"})))};
/***/},
/***/95778:
/***/(e,t,r)=>{
/* harmony export */r.d(t,{
/* harmony export */Z:()=>a
/* harmony export */});
/* harmony import */var n=r(69307),o=r(9818),c=r(52175);
/* harmony import */
/* harmony default export */const a=function(e){var t=e.attributes,r=e.clientId,a=(0,o.useSelect)((function(e){return e(c.store).__experimentalGetParsedPattern(t.slug)}),[t.slug]),s=(0,o.useDispatch)(c.store),i=s.replaceBlocks,l=s.__unstableMarkNextChangeAsNotPersistent;// Run this effect when the component loads.
// This adds the Pattern's contents to the post.
// This change won't be saved.
// It will continue to pull from the pattern file unless changes are made to its respective template part.
(0,n.useEffect)((function(){null!=a&&a.blocks&&(l(),i(r,a.blocks))}),[null==a?void 0:a.blocks]);// eslint-disable-line react-hooks/exhaustive-deps -- Code from Gutenberg.
var p=(0,c.useBlockProps)();return(0,n.createElement)("div",p)};
/***/},
/***/43949:
/***/(e,t,r)=>{
/* harmony export */r.d(t,{
/* harmony export */Z:()=>a
/* harmony export */});
/* harmony import */var n=r(50189),o=r(41153),c=r(95778);
/* harmony import */
/**
 * Internal dependencies
 */
/* harmony default export */const a=(0,n/* ["default"] */.Z)((0,n/* ["default"] */.Z)({},o),{},{edit:c/* ["default"] */.Z});
/***/},
/***/53227:
/***/(e,t,r)=>{
/* harmony export */r.d(t,{
/* harmony export */Z:()=>i
/* harmony export */});
/* harmony import */var n=r(53782),o=r(69307),c=r(4981),a=r(8930),s=["name"];
/* harmony import */
/* harmony default export */const i=function(e){(0,c.updateCategory)("sensei-lms",{icon:(0,o.createElement)(a/* ["default"] */.Z,{width:"20",height:"20"})}),e.forEach((function(e){var t=e.name,r=(0,n/* ["default"] */.Z)(e,s);(0,c.registerBlockType)(t,r)}))};
/***/},
/***/99196:
/***/e=>{e.exports=window.React;
/***/},
/***/52175:
/***/e=>{e.exports=window.wp.blockEditor;
/***/},
/***/4981:
/***/e=>{e.exports=window.wp.blocks;
/***/},
/***/9818:
/***/e=>{e.exports=window.wp.data;
/***/},
/***/69307:
/***/e=>{e.exports=window.wp.element;
/***/},
/***/64649:
/***/(e,t,r)=>{function n(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}
/***/
/* harmony export */r.d(t,{
/* harmony export */Z:()=>/* binding */n
/* harmony export */})},
/***/50189:
/***/(e,t,r)=>{
/* harmony export */r.d(t,{
/* harmony export */Z:()=>/* binding */c
/* harmony export */});
/* harmony import */var n=r(64649);function o(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function c(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?o(Object(r),!0).forEach((function(t){(0,n/* ["default"] */.Z)(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):o(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}
/***/},
/***/53782:
/***/(e,t,r)=>{
/* harmony export */r.d(t,{
/* harmony export */Z:()=>/* binding */o
/* harmony export */});
/* harmony import */var n=r(30808);function o(e,t){if(null==e)return{};var r,o,c=(0,n/* ["default"] */.Z)(e,t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);for(o=0;o<a.length;o++)r=a[o],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(c[r]=e[r])}return c}
/***/},
/***/30808:
/***/(e,t,r)=>{function n(e,t){if(null==e)return{};var r,n,o={},c=Object.keys(e);for(n=0;n<c.length;n++)r=c[n],t.indexOf(r)>=0||(o[r]=e[r]);return o}
/***/
/* harmony export */r.d(t,{
/* harmony export */Z:()=>/* binding */n
/* harmony export */})},
/***/41153:
/***/e=>{e.exports=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"core/pattern","title":"Pattern","category":"theme","description":"Show a block pattern.","supports":{"html":false,"inserter":false},"textdomain":"default","attributes":{"slug":{"type":"string"}}}');
/***/
/******/}},n={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function o(e){
/******/ // Check if module is in cache
/******/var t=n[e];
/******/if(void 0!==t)
/******/return t.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var c=n[e]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return r[e](c,c.exports,o),c.exports;
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
/******/for(var r in t)
/******/o.o(t,r)&&!o.o(e,r)&&
/******/Object.defineProperty(e,r,{enumerable:!0,get:t[r]})
/******/;
/******/},
/******/o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)
/******/,
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
e=o(53227),t=o(43949),
/**
 * Internal dependencies
 */
(0,e/* ["default"] */.Z)([t/* ["default"] */.Z])})
/******/();