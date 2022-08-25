/******/(()=>{// webpackBootstrap
/******/var e={
/***/9046:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var s,r=n(9196);
/* harmony import */function i(){return i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var s in n)Object.prototype.hasOwnProperty.call(n,s)&&(e[s]=n[s])}return e},i.apply(this,arguments)}
/* harmony default export */const o=function(e){
return r.createElement("svg",i({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},e),s||(s=r.createElement("path",{fillRule:"evenodd",clipRule:"evenodd",d:"m7.622 18.42-.634.433.406.598 2.78 4.102 1.268-.866-1.748-2.579c2.978.999 6.425.147 8.636-2.415 2.449-2.836 2.599-6.863.601-9.763l-1.026 1.188c1.4 2.325 1.203 5.408-.697 7.608-1.861 2.157-4.801 2.822-7.278 1.869l2.029-1.385.64-.438-.81-1.197-.641.438-3.526 2.407ZM16.435 5.996l.634-.433-.405-.598-2.78-4.102-1.27.866 1.75 2.58c-2.979-1-6.426-.148-8.637 2.414-2.449 2.837-2.599 6.863-.601 9.763l1.026-1.188c-1.4-2.325-1.203-5.408.697-7.608 1.861-2.157 4.801-2.822 7.278-1.868l-2.029 1.384-.64.438.81 1.197.641-.438 3.526-2.407Z",fill:"currentColor"})))};
/***/},
/***/454:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>i
/* harmony export */});
/* harmony import */var s=n(9307),r=n(444);
/* harmony import */
/**
 * WordPress dependencies
 */
const i=(0,s.createElement)(r.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,s.createElement)(r.Path,{d:"M18.3 5.6L9.9 16.9l-4.6-3.4-.9 1.2 5.8 4.3 9.3-12.6z"}));
/* harmony default export */}
//# sourceMappingURL=check.js.map
/***/,
/***/42:
/***/(e,t)=>{var n;
/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */!function(){"use strict";var s={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n)){if(n.length){var o=r.apply(null,n);o&&e.push(o)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var a in n)s.call(n,a)&&n[a]&&e.push(a);else e.push(n.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(n=function(){return r}.apply(t,[]))||(e.exports=n)}()}
/***/,
/***/4945:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>m
/* harmony export */});
/* harmony import */var s=n(5773),r=n(9307),i=n(42),o=n.n(i),a=n(9818),c=n(6064),u=n(3534),l=n(5647),d=function e(t,n){return t.map((function(t){return(0,r.createElement)(u/* .Col */.J,{key:t.key,as:"section",className:o()("sensei-extensions__section",{"sensei-extensions__section--with-inner-sections":t.innerSections}),cols:t.columns},t.title&&(0,r.createElement)("h2",{className:"sensei-extensions__section__title"},t.title),t.description&&(0,r.createElement)("p",{className:"sensei-extensions__section__description"},t.description),t.innerSections?(0,r.createElement)(u/* .Grid */.r,null,e(t.innerSections,n)):(0,r.createElement)("ul",{className:o()("sensei-extensions__section__content","sensei-extensions__".concat(t.type))},t.items.map((function(e){var t=e.key,i=e.extensionSlug,a=e.itemProps,u=void 0===a?{}:a,l=e.wrapperProps,d=void 0===l?{}:l,m=e.cardProps,p=void 0===m?{}:m;return(!i||n[i])&&(0,r.createElement)("li",(0,s/* ["default"] */.Z)({},u,{key:t,className:o()("sensei-extensions__list-item",null==u?void 0:u.className)}),(0,r.createElement)("div",(0,s/* ["default"] */.Z)({},d,{className:o()("sensei-extensions__card-wrapper",null==d?void 0:d.className)}),(0,r.createElement)(c/* ["default"] */.Z,(0,s/* ["default"] */.Z)({},i?n[i]:{},p))))}))))}))};
/* harmony import */
/* harmony default export */const m=function(e){var t=e.layout,n=(0,a.useSelect)((function(e){return{extensions:e(l/* .EXTENSIONS_STORE */.h).getEntities("extensions")}})).extensions;return d(t,n)};
/***/},
/***/6064:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>u
/* harmony export */});
/* harmony import */var s=n(5773),r=n(9307),i=n(42),o=n.n(i),a=n(5736),c=n(3933),__=a.__;
/* harmony import */
/* harmony default export */const u=function(e){var t=e.title,n=e.excerpt,i=e.badgeLabel,a=e.htmlProps,u=e.customActions,l=e.image,d=(0,c/* .useExtensionActions */.P)(e),m=u||d,p=l&&"url(".concat(l,")");return(0,r.createElement)("article",(0,s/* ["default"] */.Z)({},a,{className:o()("sensei-extensions__card",null==a?void 0:a.className)}),(0,r.createElement)("div",{className:"sensei-extensions__card__image",style:{backgroundImage:p}}),(0,r.createElement)("div",{className:"sensei-extensions__card__content"},(0,r.createElement)("header",{className:"sensei-extensions__card__header"},(0,r.createElement)("h3",{className:"sensei-extensions__card__title"},t),// eslint-disable-next-line dot-notation -- Data coming from API.
(i||(null==e?void 0:e.has_update))&&(0,r.createElement)("small",{className:"sensei-extensions__card__new-badge"},i||__("New version","sensei-lms"))),(0,r.createElement)("div",{className:"sensei-extensions__card__body"},(0,r.createElement)("p",{className:"sensei-extensions__card__description"},n),m&&(0,r.createElement)(c/* ["default"] */.Z,{actions:m}))))};
/***/},
/***/3933:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>x
/* harmony export */,P:()=>/* binding */E
/* harmony export */});
/* harmony import */var s=n(228),r=n(189),i=n(5773),o=n(3782),a=n(9307),c=n(5736),u=n(9818),l=n(5609),d=n(454),m=n(5647),p=n(9046),_=n(7959),f=n(4735),v=["key","children"],__=c.__;
/* harmony import */
/* harmony default export */const x=function(e){var t=e.actions;return(0,a.createElement)("ul",{className:"sensei-extensions__extension-actions"},t.map((function(e){var t=e.key,n=e.children,s=(0,o/* ["default"] */.Z)(e,v);return(0,a.createElement)("li",{key:t,className:"sensei-extensions__extension-actions__item"},(0,a.createElement)(l.Button,(0,i/* ["default"] */.Z)({isPrimary:!s.href,isLink:!!s.href},s),n))})))};
/**
 * Extension actions hook.
 *
 * @param {Object} extension Extension object.
 *
 * @return {Array|null} Array of actions, or null if it's not a valid extension.
 */var E=function(e){var t=(0,u.useSelect)((function(e){return{wccom:e(m/* .EXTENSIONS_STORE */.h).getWccomData()}})).wccom,n=(0,u.useDispatch)(m/* .EXTENSIONS_STORE */.h),i=n.installExtension,o=n.updateExtensions;if(!e.product_slug)return null;var a={key:"main-button"};if((0,m/* .isLoadingStatus */.t)(e.status))a=(0,r/* ["default"] */.Z)({children:__("In progress…","sensei-lms"),className:"sensei-extensions__rotating-icon",icon:p/* ["default"] */.Z,disabled:!0},a);else if(e.has_update)a=(0,r/* ["default"] */.Z)({children:__("Update","sensei-lms"),onClick:function(){return o([e.product_slug])},disabled:!e.can_update},a);else if(e.is_installed)a=(0,r/* ["default"] */.Z)({children:__("Installed","sensei-lms"),icon:d/* ["default"] */.Z,disabled:!0},a);else{var c="0"!==e.price?e.price:__("Free","sensei-lms");a=(0,r/* ["default"] */.Z)({children:"".concat(__("Install","sensei-lms")," - ").concat(c),onClick:function(){if(e.wccom_product_id){var n=(0,f/* .getWoocommerceComPurchaseUrl */.x)([e],t);return(0,_/* .logEvent */.K)("extensions_install",{slug:e.product_slug}),void window.open(n)}i(e.product_slug)}},a)}var l=[a],v=e.is_installed&&e.has_update?e.changelog_url:e.link;return v&&(l=[].concat((0,s/* ["default"] */.Z)(l),[{key:"more-details",href:v,target:"_blank",rel:"noreferrer external",children:__("More details","sensei-lms")}])),l};
/***/},
/***/74:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>c
/* harmony export */});
/* harmony import */var s=n(9307),r=n(9818),i=n(5736),o=n(2159),a=n(5647),__=i.__;
/* harmony import */
/* harmony default export */const c=function(){var e=(0,r.useSelect)((function(e){return{extensions:e(a/* .EXTENSIONS_STORE */.h).getExtensions()}})).extensions.find((function(e){return"sensei-pro"===e.product_slug}));return e&&!0!==e.is_installed?(0,s.createElement)(o/* ["default"] */.Z,{title:e.title,excerpt:e.excerpt,description:__("By upgrading to Sensei Pro, you get all the great features found in Sensei LMS plus:","sensei-lms"),features:[__("WooCommerce integration","sensei-lms"),__("Schedule ‘drip’ content","sensei-lms"),__("Set expiration date of courses","sensei-lms"),__("Advanced quiz features","sensei-lms"),__("Flashcard, image hotspot, and tasklist blocks","sensei-lms"),__("Premium support","sensei-lms")],image:e.image_large,badgeLabel:__("new","sensei-lms"),price:(0,i.sprintf)(// translators: placeholder is the price.
__("%s USD / year (1 site)","sensei-lms"),e.price),buttonLink:"https://senseilms.com/pricing/?utm_source=plugin_sensei&utm_medium=upsell&utm_campaign=extensions_header",buttonTitle:__("Learn More","sensei-lms")}):(0,s.createElement)(s.Fragment,null)};
/***/},
/***/2159:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>c
/* harmony export */});
/* harmony import */var s=n(5773),r=n(9307),i=n(42),o=n.n(i),a=n(5736),__=a.__;
/* harmony import */
/* harmony default export */const c=function(e){var t=e.title,n=e.description,i=e.features,c=e.badgeLabel,u=e.excerpt,l=e.image,d=e.price,m=e.buttonLink,p=e.buttonTitle,_=e.htmlProps,f=l&&"url(".concat(l,")"),v=(0,a.sprintf)(// translators: placeholder is the product title.
__("Get %s","sensei-lms"),t);return(0,r.createElement)("article",(0,s/* ["default"] */.Z)({},_,{className:o()("sensei-extensions__featured-product",null==_?void 0:_.className)}),(0,r.createElement)("section",{className:"sensei-extensions__featured-product__column"},(0,r.createElement)("div",{className:"sensei-extensions__featured-product__content"},(0,r.createElement)("header",{className:"sensei-extensions__featured-product__header"},(0,r.createElement)("h2",{className:"sensei-extensions__featured-product__title"},v),c&&(0,r.createElement)("small",{className:"sensei-extensions__featured-product__badge"},c)),(0,r.createElement)("div",{className:"sensei-extensions__featured-product__description"},(0,r.createElement)("p",null,n),i&&(0,r.createElement)("ul",null,i.map((function(e,t){return(0,r.createElement)("li",{key:t},e)})))))),(0,r.createElement)("section",{className:"sensei-extensions__featured-product__column",style:{backgroundImage:f}},(0,r.createElement)("div",{className:"sensei-extensions__featured-product__card"},(0,r.createElement)("h2",{className:"sensei-extensions__featured-product__card__title"},t),(0,r.createElement)("p",{className:"sensei-extensions__featured-product__card__description"},u),(0,r.createElement)("div",{className:"sensei-extensions__featured-product__card__price"},d),(0,r.createElement)("a",{href:m,target:"_blank",rel:"noreferrer external",className:o()("sensei-extensions__featured-product__card__button","components-button","is-primary","is-large")},p))))};
/***/},
/***/4592:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var s=n(9307),r=n(6064),i=n(3534);
/* harmony import */
/* harmony default export */const o=function(e){var t=e.extensions;return(0,s.createElement)(i/* .Col */.J,{as:"section",className:"sensei-extensions__section",cols:12},(0,s.createElement)("ul",{className:"sensei-extensions__grid-list"},t.map((function(e){return(0,s.createElement)("li",{key:e.product_slug,className:"sensei-extensions__list-item"},(0,s.createElement)("div",{className:"sensei-extensions__card-wrapper"},(0,s.createElement)(r/* ["default"] */.Z,e)))}))))};
/***/},
/***/3534:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */r:()=>/* binding */o
/* harmony export */,J:()=>/* binding */a
/* harmony export */});
/* harmony import */var s=n(9307),r=n(42),i=n.n(r),o=function(e){var t=e.as,n=void 0===t?"div":t,r=e.className,o=e.children;return(0,s.createElement)(n,{className:i()(r,"sensei-extensions__grid")},o)},a=function(e){var t=e.as,n=void 0===t?"div":t,r=e.className,o=e.cols,a=void 0===o?12:o,c=e.children;return(0,s.createElement)(n,{className:i()(r,"sensei-extensions__grid__col","--col-".concat(a))},c)};
/* harmony import */}
/***/,
/***/1676:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>i
/* harmony export */});
/* harmony import */var s=n(9307),r=n(5736),__=r.__;
/* harmony import */
/* harmony default export */const i=function(){return(0,s.createElement)("header",null,(0,s.createElement)("h1",{className:"wp-heading-inline"},__("Sensei LMS Extensions","sensei-lms")))};
/***/},
/***/772:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>h
/* harmony export */});
/* harmony import */var s=n(9307),r=n(5609),i=n(5736),o=n(9818),a=n(2238),c=n(2694),u=n(9373),l=n(74),d=n(1676),m=n(3683),p=n(6721),_=n(1641),f=n(9400),v=n(4945),x=n(4592),E=n(5647),g=n(3534),__=i.__;
/* harmony import */
/* harmony default export */const h=function(){(0,u/* .useSenseiColorTheme */.I)();var e=(0,o.useSelect)((function(e){var t=e(E/* .EXTENSIONS_STORE */.h);return{isExtensionsLoading:!t.hasFinishedResolution("getExtensions"),extensions:t.getExtensions(),connected:t.getConnectionStatus(),layout:t.getLayout(),error:t.getError()}})),t=e.extensions,n=e.connected,i=e.layout,h=e.isExtensionsLoading,y=e.error;if(h)return(0,s.createElement)("div",{className:"sensei-extensions__loader"},(0,s.createElement)(r.Spinner,null));if(0===t.length||0===i.length)return(0,s.createElement)("div",null,__("No extensions found.","sensei-lms"));var b=t.filter((function(e){return"0"===e.price})),w=t.filter((function(e){return e.is_installed})),Z=t.filter((function(e){return e.wccom_product_id})),N=t.filter((function(e){return!e.wccom_product_id})),S=[{id:"all",label:__("All","sensei-lms"),count:t.length,content:(0,s.createElement)(v/* ["default"] */.Z,{layout:i})},{id:"free",label:__("Free","sensei-lms"),count:b.length,content:(0,s.createElement)(x/* ["default"] */.Z,{extensions:b})},{id:"installed",label:__("Installed","sensei-lms"),count:w.length,content:(0,s.createElement)(x/* ["default"] */.Z,{extensions:w})}],O=(0,c.applyFilters)("senseiExtensionsFeaturedProductHide",!1),k=(0,c.applyFilters)("senseiExtensionsFeaturedProduct",l/* ["default"] */.Z);return(0,s.createElement)(s.Fragment,null,(0,s.createElement)(g/* .Grid */.r,{as:"main",className:"sensei-extensions"},(0,s.createElement)(f/* ["default"] */.ZP,{paramName:"tab",defaultRoute:"all"},(0,s.createElement)(g/* .Col */.J,{className:"sensei-extensions__section",cols:12},!O&&(0,s.createElement)(k,null),(0,s.createElement)(d/* ["default"] */.Z,null),(0,s.createElement)(m/* ["default"] */.Z,{tabs:S}),null!==y&&(0,s.createElement)(r.Notice,{status:"error",isDismissible:!1},(0,s.createElement)(s.RawHTML,null,y))),(0,s.createElement)(_/* ["default"] */.Z,{connected:n,extensions:Z}),(0,s.createElement)(p/* ["default"] */.Z,{extensions:n?t:N}),S.map((function(e){return(0,s.createElement)(f/* .Route */.AW,{key:e.id,route:e.id},e.content)})))),(0,s.createElement)(a.EditorNotices,null))};
/***/},
/***/5647:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */h:()=>/* binding */p
/* harmony export */,t:()=>/* binding */_
/* harmony export */});
/* harmony import */var s=n(228),r=n(4649),i=n(189),o=n(2819),a=n(9818),c=n(3418),u=n(5736),l=n(832),d=n(7959),__=(n(6400),u.__),m={IN_PROGRESS:"in-progress",IN_QUEUE:"in-queue"},p="sensei/extensions",_=function(e){return[m.IN_PROGRESS,m.IN_QUEUE].includes(e)},f={
/**
   * Sets the extensions list.
   *
   * @param {Array} extensionSlugs The extensions slugs array.
   */
setExtensions:function(e){return{type:"SET_EXTENSIONS",extensionSlugs:e}},
/**
   * Sets entities.
   *
   * @param {Object} entities Entities to set.
   */
setEntities:function(e){return{type:"SET_ENTITIES",entities:e}},
/**
   * Sets the WC.com connection status.
   *
   * @param {Object} connected Whether the site is connected to WC.com.
   */
setConnectionStatus:function(e){return{type:"SET_CONNECTION_STATUS",connected:e}},
/**
   * Install extensions.
   *
   * @param {string} slug The extension slug to install.
   */
installExtension:regeneratorRuntime.mark((function e(t){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return(0,d/* .logEvent */.K)("extensions_install",{slug:t}),e.next=3,f.runProcess({slugs:[t],actionType:"install"});case 3:case"end":return e.stop()}}),e)})),
/**
   * Updates the provided extensions.
   *
   * @param {string[]} slugs The extension slugs to update.
   */
updateExtensions:regeneratorRuntime.mark((function e(t){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t.map((function(e){return(0,d/* .logEvent */.K)("extensions_update",{slug:e})})),e.next=3,f.runProcess({slugs:t,actionType:"update"});case 3:case"end":return e.stop()}}),e)})),
/**
   * Run extension process (install or update).
   *
   * @param {Object}   process            The process.
   * @param {string[]} process.slugs      Extension slugs.
   * @param {string}   process.actionType Action type (`install` or `update`).
   */
runProcess:regeneratorRuntime.mark((function e(t){var n,s,r,i,l,d,_;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=t.slugs,s=t.actionType,e.next=3,(0,a.select)(p).getExtensionsByStatus(m.IN_PROGRESS);case 3:if(!(e.sent.length>0)){e.next=8;break}return e.next=7,f.addToQueue(t);case 7:return e.abrupt("return");case 8:return e.next=10,f.setExtensionsStatus(n,m.IN_PROGRESS);case 10:return"update"===s?(r={plugins:n},i=__("Update completed successfully!","sensei-lms"),// translators: Placeholder is the underlying error message.
l=__("There was an error while updating the plugin: %1$s","sensei-lms")):(r={plugin:n[0]},i=__("Installation completed successfully!","sensei-lms"),// translators: Placeholder is the underlying error message.
l=__("There was an error while installing the plugin: %1$s","sensei-lms")),e.prev=11,e.next=14,(0,c.apiFetch)({path:"/sensei-internal/v1/sensei-extensions/".concat(s),method:"POST",data:r});case 14:return d=e.sent,e.next=17,f.setError(null);case 17:return e.next=19,f.setEntities({extensions:(0,o.keyBy)(d.completed,"product_slug")});case 19:return e.next=21,(0,a.dispatch)("core/notices").createNotice("success",i,{type:"snackbar"});case 21:e.next=27;break;case 23:return e.prev=23,e.t0=e.catch(11),e.next=27,f.setError((0,u.sprintf)(l,e.t0.message));case 27:return e.prev=27,e.next=30,f.setExtensionsStatus(n,"");case 30:return e.next=32,f.removeFromQueue(t);case 32:return e.next=34,(0,a.select)(p).getNextProcess();case 34:if(!(_=e.sent)){e.next=38;break}return e.next=38,f.runProcess(_);case 38:return e.finish(27);case 39:case"end":return e.stop()}}),e,null,[[11,23,27,39]])})),
/**
   * Set extensions in progress.
   *
   * @param {string} slugs  Extensions in progress.
   * @param {string} status Status.
   */
setExtensionsStatus:function(e,t){return{type:"SET_EXTENSIONS_STATUS",slugs:e,status:t}},
/**
   * Set the extensions layout.
   *
   * @param {Array} layout Extensions layout.
   */
setLayout:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];return{type:"SET_LAYOUT",layout:e}},
/**
   * Set WooCommerce.com data.
   *
   * @param {Object} wccom WooCommerce.com data.
   */
setWccom:function(e){return{type:"SET_WCCOM",wccom:e}},
/**
   * Add process (update/install) to queue.
   *
   * @param {Object}   process            The process.
   * @param {string}   process.actionType Action type.
   * @param {string[]} process.slugs      Extension slugs.
   */
addToQueue:regeneratorRuntime.mark((function e(t){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,f.setExtensionsStatus(t.slugs,m.IN_QUEUE);case 2:return e.abrupt("return",{type:"ADD_TO_QUEUE",process:t});case 3:case"end":return e.stop()}}),e)})),
/**
   * Add process (update/install) to queue.
   *
   * @param {Object}   process       The process.
   * @param {string}   process.type  Process type.
   * @param {string[]} process.slugs Extension slugs.
   */
removeFromQueue:function(e){return{type:"REMOVE_FROM_QUEUE",process:e}},
/**
   * Set the error message.
   *
   * @param {string} error The error.
   */
setError:function(e){return{type:"SET_ERROR",error:e}}},v={getExtensions:function(e){var t=e.extensionSlugs,n=e.entities;return t.map((function(e){return n.extensions[e]}))},getExtensionsByStatus:function(e,t){return v.getExtensions(e).filter((function(e){return t===e.status}))},getEntities:function(e,t){return e.entities[t]},getConnectionStatus:function(e){return e.connected},getLayout:function(e){return e.layout},getNextProcess:function(e){return e.queue[0]||null},getWccomData:function(e){return e.wccom},getError:function(e){return e.error}},x={
/**
   * Loads the extensions during initialization.
   */
getExtensions:regeneratorRuntime.mark((function e(){var t;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,(0,c.apiFetch)({path:"/sensei-internal/v1/sensei-extensions?type=plugin"});case 2:return t=e.sent,e.next=5,f.setLayout(t.layout);case 5:return e.next=7,f.setWccom(t.wccom);case 7:return e.next=9,f.setEntities({extensions:(0,o.keyBy)(t.extensions,"product_slug")});case 9:return e.next=11,f.setExtensions(t.extensions.map((function(e){return e.product_slug})));case 11:return e.next=13,f.setConnectionStatus(t.wccom_connected);case 13:case"end":return e.stop()}}),e)}))},E={SET_EXTENSIONS:function(e,t){var n=e.extensionSlugs;return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{extensionSlugs:n})},SET_EXTENSIONS_STATUS:function(e,t){var n=e.slugs,s=e.status;return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{entities:(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t.entities),{},{extensions:Object.keys(t.entities.extensions).reduce((function(e,o){return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e),{},(0,r/* ["default"] */.Z)({},o,(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t.entities.extensions[o]),{},{status:n.includes(o)?s:t.entities.extensions[o].status})))}),{})})})},SET_CONNECTION_STATUS:function(e,t){var n=e.connected;return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{connected:n})},SET_LAYOUT:function(e,t){var n=e.layout;return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{layout:n})},SET_ENTITIES:function(e,t){var n=e.entities;return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{entities:(0,o.merge)({},t.entities,n)})},SET_WCCOM:function(e,t){var n=e.wccom;return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{wccom:n})},ADD_TO_QUEUE:function(e,t){var n=e.process;return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{queue:[].concat((0,s/* ["default"] */.Z)(t.queue),[n])})},REMOVE_FROM_QUEUE:function(e,t){var n=e.process;return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{queue:t.queue.filter((function(e){return!(0,o.isEqual)(e,n)}))})},SET_ERROR:function(e,t){var n=e.error;return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{error:n})},DEFAULT:function(e,t){return t}};
/* harmony import */(0,a.registerStore)(p,{reducer:(0,l/* .createReducerFromActionMap */.lA)(E,{
/**
   * Extensions list. It is mapped with the entities and served through the selectors.
   */
extensionSlugs:[],
/**
   * Store entities to be used based on the entities key (it can be accessed directly,
   * or mapped based in a key list).
   */
entities:{extensions:{}},connected:!1,layout:[],queue:[],wccom:{},error:null}),actions:f,selectors:v,resolvers:x,controls:c.controls})}
/***/,
/***/3683:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var s=n(5773),r=n(9307),i=n(9400);
/* harmony import */
/* harmony default export */const o=function(e){var t=e.tabs,n=(0,i/* .useQueryStringRouter */.Nt)(),o=n.currentRoute,a=n.goTo;return(0,r.createElement)("nav",null,(0,r.createElement)("ul",{className:"subsubsub sensei-extensions__tabs"},t.map((function(e){var t=e.id,n=e.label,i=e.count;return(0,r.createElement)("li",{key:t,className:"sensei-extensions__tabs__tab"},(0,r.createElement)("a",(0,s/* ["default"] */.Z)({href:"#".concat(t,"-extensions"),onClick:function(e){e.preventDefault(),a(t)}},o===t&&{className:"current","aria-current":"page"}),n,(0,r.createElement)("span",{className:"sensei-extensions__tabs__count count"},"(",i,")")))}))))};
/***/},
/***/6721:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>p
/* harmony export */});
/* harmony import */var s=n(189),r=n(9307),i=n(5736),o=n(7250),a=n(9389),c=n(1491),u=n(3534),l=n(9046),d=n(9818),m=n(5647),__=i.__;
/* harmony import */
/* harmony default export */const p=function(e){var t=e.extensions.filter((function(e){return e.can_update&&e.has_update})),n=t.length,i=(0,d.useDispatch)(m/* .EXTENSIONS_STORE */.h).updateExtensions;if(0===n)return null;var p={key:"update-button",onClick:function(){i(t.map((function(e){return e.product_slug})))}},_=[p=t.some((function(e){return(0,m/* .isLoadingStatus */.t)(e.status)}))?(0,s/* ["default"] */.Z)({children:__("Updating…","sensei-lms"),className:"sensei-extensions__rotating-icon",icon:l/* ["default"] */.Z,disabled:!0},p):(0,s/* ["default"] */.Z)({children:__("Update all","sensei-lms")},p)];return(0,r.createElement)(u/* .Col */.J,{as:"section",className:"sensei-extensions__section",cols:12},(0,r.createElement)("div",{role:"alert",className:"sensei-extensions__update-notification"},(0,r.createElement)(c/* ["default"] */.Z,{updatesCount:n}),1===n?(0,r.createElement)(o/* ["default"] */.Z,{extension:t[0]}):(0,r.createElement)(a/* ["default"] */.Z,{extensions:t,actions:_})))};
/***/},
/***/9389:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var s=n(9307),r=n(5736),i=n(3933),__=r.__;
/* harmony import */
/* harmony default export */const o=function(e){var t=e.extensions,n=e.actions;return(0,s.createElement)(s.Fragment,null,(0,s.createElement)("ul",{className:"sensei-extensions__update-notification__list"},t.map((function(e){return(0,s.createElement)("li",{key:e.product_slug,className:"sensei-extensions__update-notification__list__item"},e.title," ",e.changelog_url&&(0,s.createElement)("a",{href:e.changelog_url,className:"sensei-extensions__update-notification__version-link",target:"_blank",rel:"noreferrer external"},(0,r.sprintf)(// translators: placeholder is the version number.
__("version %s","sensei-lms"),e.version)))}))),(0,s.createElement)(i/* ["default"] */.Z,{actions:n}))};
/***/},
/***/7250:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>i
/* harmony export */});
/* harmony import */var s=n(9307),r=n(3933);
/* harmony import */
/* harmony default export */const i=function(e){var t=e.extension,n=(0,r/* .useExtensionActions */.P)(t);return(0,s.createElement)(s.Fragment,null,(0,s.createElement)("h3",{className:"sensei-extensions__update-notification__title"},t.title),(0,s.createElement)("p",{className:"sensei-extensions__update-notification__description"},t.excerpt),(0,s.createElement)(r/* ["default"] */.Z,{actions:n}))};
/***/},
/***/1491:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var s=n(9307),r=n(5736),i=n(9046),__=r.__,_n=r._n;
/* harmony import */
/* harmony default export */const o=function(e){var t=e.updatesCount;return(0,s.createElement)("small",{className:"sensei-extensions__update-badge"},(0,s.createElement)(i/* ["default"] */.Z,null),1===t?__("Update available","sensei-lms"):(0,r.sprintf)(// translators: placeholder is number of updates available.
_n("%d update available","%d updates available",t,"sensei-lms"),t))};
/***/},
/***/1641:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>u
/* harmony export */});
/* harmony import */var s=n(9307),r=n(5736),i=n(9389),o=n(1491),a=n(3534),c=n(3933),__=r.__,_n=r._n;
/* harmony import */
/* harmony default export */const u=function(e){var t,n,u=e.extensions,l=e.connected,d=u.filter((function(e){return e.has_update})),m=d.length,p=!(null!==(t=window.sensei_extensions)&&void 0!==t&&t.installUrl),_=!(null!==(n=window.sensei_extensions)&&void 0!==n&&n.activateUrl);if(0===m||p&&_&&l)return null;var f,v="",x=[];if(!l&&p&&_)v=_n("Your site needs to be connected to your WooCommerce.com account before this extension can be updated.","Your site needs to be connected to your WooCommerce.com account before these extensions can be updated.",m,"sensei-lms"),x=[{key:"connect",children:__("Connect account","sensei-lms"),href:null===(f=window.sensei_extensions)||void 0===f?void 0:f.connectUrl,isLink:!1,isPrimary:!0}];else if(p){if(!_){var E;v=_n("WooCommerce needs to be activated before this extension can be updated.","WooCommerce needs to be activated before these extensions can be updated.",m,"sensei-lms"),x=[{key:"activate",children:__("Activate WooCommerce","sensei-lms"),href:null===(E=window.sensei_extensions)||void 0===E?void 0:E.activateUrl,isLink:!1,isPrimary:!0}]}}else{var g;v=_n("WooCommerce needs to be installed before this extension can be updated.","WooCommerce needs to be installed before these extensions can be updated.",m,"sensei-lms"),x=[{key:"install",children:__("Install WooCommerce","sensei-lms"),href:null===(g=window.sensei_extensions)||void 0===g?void 0:g.installUrl,isLink:!1,isPrimary:!0}]}return(0,s.createElement)(a/* .Col */.J,{as:"section",className:"sensei-extensions__section",cols:12},(0,s.createElement)("div",{role:"alert",className:"sensei-extensions__update-notification"},(0,s.createElement)(o/* ["default"] */.Z,{updatesCount:m}),(0,s.createElement)("h3",{className:"sensei-extensions__update-notification__title"},v),1===m?(0,s.createElement)(s.Fragment,null,(0,s.createElement)("div",{className:"sensei-extensions__update-notification__description"},(0,s.createElement)("span",null,d[0].title," "),(0,s.createElement)("a",{href:d[0].link,className:"sensei-extensions__update-notification__version-link",target:"_blank",rel:"noreferrer external"},(0,r.sprintf)(// translators: placeholder is the version number.
__("version %s","sensei-lms"),d[0].version))),(0,s.createElement)(c/* ["default"] */.Z,{actions:x})):(0,s.createElement)(i/* ["default"] */.Z,{extensions:d,actions:x})))};
/***/},
/***/7451:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */O:()=>/* reexport safe */s.Z
/* harmony export */});
/* harmony import */var s=n(906);
/* harmony import */n(4464)}
/***/,
/***/906:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>r
/* harmony export */});
/* harmony import */var s=n(9307);
/* harmony import */
/* harmony default export */const r=function(e,t,n){var r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:window,i=(0,s.useCallback)(t,n);
// eslint-disable-next-line react-hooks/exhaustive-deps
(0,s.useEffect)((function(){var t=[e,i,!1];return r.addEventListener.apply(r,t),function(){r.removeEventListener.apply(r,t)}}),[e,i,r])};
/***/},
/***/9373:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */I:()=>/* binding */r
/* harmony export */});
/* harmony import */var s=n(9307);
/* harmony import */
/**
 * WordPress dependencies
 */
/**
 * Use Sensei color theme.
 *
 * Requires enqueueing the sensei-wp-components stylesheet.
 */
function r(){(0,s.useLayoutEffect)((function(){return document.body.classList.add("sensei-color"),function(){return document.body.classList.remove("sensei-color")}}))}
/***/},
/***/4464:
/***/(e,t,n)=>{"use strict";
/* harmony import */n(9307);
/* harmony import */}
/***/,
/***/6400:
/***/(e,t,n)=>{"use strict";
/* unused harmony export preloadedDataUsedOnceMiddleware */
/* harmony import */var s,r=n(6483),i=n(6989);
/* harmony import */n.n(i)().use((s={},function(e,t){return"string"!=typeof e.path||"GET"!==e.method&&e.method||(s[e.path]?e.path=(0,r.addQueryArgs)(e.path,{__skip_preload:1}):s[e.path]=!0),t(e)}))}
/***/,
/***/832:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */lA:()=>/* binding */s
/* harmony export */});
/* unused harmony exports composeFetchAction, createStore */
/* harmony import */n(9818);
/* harmony import */var s=function(e,t){return function(){var n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:t,s=arguments.length>1?arguments[1]:void 0,r=e[s.type]||e.DEFAULT;return r(s,n)}}}
/***/,
/***/7959:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */K:()=>/* binding */s
/* harmony export */});
/* unused harmony export logLink */
/**
 * Send log event.
 *
 * @param {string} eventName  Event name.
 * @param {Array}  properties Event properties.
 */
var s=function(e,t){window.sensei_log_event(e,t)};
/**
 * Enable or disable event logging.
 *
 * @param {boolean} enabled Enabled state.
 */s.enable=function(e){window.sensei_event_logging.enabled=e}}
/***/,
/***/4735:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */x:()=>/* binding */i
/* harmony export */});
/* unused harmony export getWccomProductId */
/* harmony import */var s=n(189),r=n(6483),i=function(e,t){return(0,r.addQueryArgs)("https://woocommerce.com/cart",(0,s/* ["default"] */.Z)({"wccom-replace-with":e.map(o).join(",")},t||{}))},o=function(e){return e.wccom_product_id};
/* harmony import */}
/***/,
/***/9400:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */ZP:()=>u
/* harmony export */,AW:()=>/* reexport safe */a.Z
/* harmony export */,Nt:()=>/* binding */l
/* harmony export */});
/* harmony import */var s=n(6886),r=n(9307),i=n(7451),o=n(4557),a=n(519),c=(0,r.createContext)();
/* harmony import */
/* harmony default export */const u=function(e){var t=e.paramName,n=e.defaultRoute,a=e.children,u=(0,r.useState)((0,o/* .getParam */.j)(t)),l=(0,s/* ["default"] */.Z)(u,2),d=l[0],m=l[1],p=(0,r.useMemo)((function(){
/**
     * Functions that send the user to another route.
     * It changes the URL and update the state of the current route.
     *
     * @param {string}  newRoute New route to send the user.
     * @param {boolean} replace  Flag to mark if should replace or push state.
     */
var e=function(e){var n=arguments.length>1&&void 0!==arguments[1]&&arguments[1];(0,o/* .updateQueryString */.b)(t,e,n),m(e)};return d||e(n,!0),{currentRoute:d,goTo:e}}),[d,t,n]);
// Current route.
// Handle history changes through popstate.
return(0,i/* .useEventListener */.O)("popstate",(function(){m((0,o/* .getParam */.j)(t))}),[t]),(0,r.createElement)(c.Provider,{value:p},a)};
/**
 * Export `Route` component as part of the query string router.
 */
/**
 * Hook to access the query string router values from the context.
 *
 * @return {QueryStringRouterContext} Query string router context.
 *
 * @typedef  {Object}           QueryStringRouterContext
 * @property {string}           currentRoute Current route.
 * @property {function(string)} goTo         Function to navigate between routes.
 */var l=function(){return(0,r.useContext)(c)};
/***/},
/***/519:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>r
/* harmony export */});
/* harmony import */var s=n(9400);
/**
 * Internal dependencies
 */
/**
 * Route component. It works inner the `QueryStringRouter context.
 *
 * @param {Object} props
 * @param {string} props.route    Route name.
 * @param {Object} props.children Render this children if it matches the route.
 *
 * @return {Object|null} Return the children if the routes match. Otherwise return null.
 */
/* harmony default export */const r=function(e){var t=e.route,n=e.children;return(0,s/* .useQueryStringRouter */.Nt)().currentRoute===t?n:null};
/***/},
/***/4557:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */j:()=>/* binding */s
/* harmony export */,b:()=>/* binding */r
/* harmony export */});
/**
 * Get parameter from URL.
 *
 * @param {string} name Name of the param to get.
 *
 * @return {string|null} The value in the param. If it's empty, return null.
 */
var s=function(e){return new URLSearchParams(window.location.search).get(e)||null},r=function(e,t){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],s=window.location.search,r=n?"replaceState":"pushState",i=new URLSearchParams(s);null===t?i.delete(e):i.set(e,t),window.history[r]({},"","?".concat(i.toString()))};
/**
 * Update query string.
 *
 * @param {string}  paramName  Param name to be added to the URL.
 * @param {string}  paramValue Param value to be added to the URL.
 * @param {boolean} replace    Flag if it should replace the state. Otherwise it'll push a new.
 */}
/***/,
/***/9196:
/***/e=>{"use strict";e.exports=window.React}
/***/,
/***/2819:
/***/e=>{"use strict";e.exports=window.lodash}
/***/,
/***/6989:
/***/e=>{"use strict";e.exports=window.wp.apiFetch}
/***/,
/***/5609:
/***/e=>{"use strict";e.exports=window.wp.components}
/***/,
/***/9818:
/***/e=>{"use strict";e.exports=window.wp.data}
/***/,
/***/3418:
/***/e=>{"use strict";e.exports=window.wp.dataControls}
/***/,
/***/2238:
/***/e=>{"use strict";e.exports=window.wp.editor}
/***/,
/***/9307:
/***/e=>{"use strict";e.exports=window.wp.element}
/***/,
/***/2694:
/***/e=>{"use strict";e.exports=window.wp.hooks}
/***/,
/***/5736:
/***/e=>{"use strict";e.exports=window.wp.i18n}
/***/,
/***/444:
/***/e=>{"use strict";e.exports=window.wp.primitives}
/***/,
/***/6483:
/***/e=>{"use strict";e.exports=window.wp.url}
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
/***/8138:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */});
/* harmony import */var s=n(1793);function r(e){if(Array.isArray(e))return(0,s/* ["default"] */.Z)(e)}
/***/},
/***/4649:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/5773:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(){return s=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var s in n)Object.prototype.hasOwnProperty.call(n,s)&&(e[s]=n[s])}return e},s.apply(this,arguments)}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/5181:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/2446:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var s,r,i=[],_n=!0,o=!1;try{for(n=n.call(e);!(_n=(s=n.next()).done)&&(i.push(s.value),!t||i.length!==t);_n=!0);}catch(e){o=!0,r=e}finally{try{_n||null==n.return||n.return()}finally{if(o)throw r}}return i}}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/3764:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/3314:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/189:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */i
/* harmony export */});
/* harmony import */var s=n(4649);function r(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,s)}return n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach((function(t){(0,s/* ["default"] */.Z)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}
/***/},
/***/3782:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */});
/* harmony import */var s=n(808);function r(e,t){if(null==e)return{};var n,r,i=(0,s/* ["default"] */.Z)(e,t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);for(r=0;r<o.length;r++)n=o[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(i[n]=e[n])}return i}
/***/},
/***/808:
/***/(e,t,n)=>{"use strict";
/* harmony export */function s(e,t){if(null==e)return{};var n,s,r={},i=Object.keys(e);for(s=0;s<i.length;s++)n=i[s],t.indexOf(n)>=0||(r[n]=e[n]);return r}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/6886:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */a
/* harmony export */});
/* harmony import */var s=n(6470),r=n(2446),i=n(4013),o=n(3764);
/* harmony import */function a(e,t){return(0,s/* ["default"] */.Z)(e)||(0,r/* ["default"] */.Z)(e,t)||(0,i/* ["default"] */.Z)(e,t)||(0,o/* ["default"] */.Z)()}
/***/},
/***/228:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */a
/* harmony export */});
/* harmony import */var s=n(8138),r=n(5181),i=n(4013),o=n(3314);
/* harmony import */function a(e){return(0,s/* ["default"] */.Z)(e)||(0,r/* ["default"] */.Z)(e)||(0,i/* ["default"] */.Z)(e)||(0,o/* ["default"] */.Z)()}
/***/},
/***/4013:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */});
/* harmony import */var s=n(1793);function r(e,t){if(e){if("string"==typeof e)return(0,s/* ["default"] */.Z)(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?(0,s/* ["default"] */.Z)(e,t):void 0}}
/***/
/******/}},t={};
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
/******/var i=t[s]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return e[s](i,i.exports,n),i.exports;
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
/* harmony import */var e=n(9307),t=n(772);
/* harmony import */
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
(0,e.render)((0,e.createElement)(t/* ["default"] */.Z,null),document.getElementById("sensei-extensions-page"))})()})
/******/();