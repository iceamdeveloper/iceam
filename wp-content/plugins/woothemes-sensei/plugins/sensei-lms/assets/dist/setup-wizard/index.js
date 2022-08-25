/******/(()=>{// webpackBootstrap
/******/var e={
/***/42:
/***/(e,t)=>{var n;
/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */!function(){"use strict";var r={}.hasOwnProperty;function s(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n)){if(n.length){var a=s.apply(null,n);a&&e.push(a)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var o in n)r.call(n,o)&&n[o]&&e.push(o);else e.push(n.toString())}}return e.join(" ")}e.exports?(s.default=s,e.exports=s):void 0===(n=function(){return s}.apply(t,[]))||(e.exports=n)}()}
/***/,
/***/3743:
/***/e=>{"use strict";
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 *
 * 
 */function t(e){return function(){return e}}
/**
 * This function accepts and discards inputs; it has no side effects. This is
 * primarily useful idiomatically for overridable function endpoints which
 * always need to be callable, since JS lacks a null-call idiom ala Cocoa.
 */var n=function(){};n.thatReturns=t,n.thatReturnsFalse=t(!1),n.thatReturnsTrue=t(!0),n.thatReturnsNull=t(null),n.thatReturnsThis=function(){return this},n.thatReturnsArgument=function(e){return e},e.exports=n}
/***/,
/***/7081:
/***/e=>{"use strict";
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 *
 */
/**
 * Use invariant() to assert state which your program assumes to be true.
 *
 * Provide sprintf-style format (only %s is supported) and arguments
 * to provide information about what broke and what you were
 * expecting.
 *
 * The invariant message will be stripped in production, but the invariant
 * will remain to ensure logic does not differ in production.
 */e.exports=function(e,t,n,r,s,i,a,o){if(!e){var u;if(void 0===t)u=new Error("Minified exception occurred; use the non-minified dev environment for the full error message and additional helpful warnings.");else{var c=[n,r,s,i,a,o],l=0;(u=new Error(t.replace(/%s/g,(function(){return c[l++]})))).name="Invariant Violation"}// we don't care about invariant's own frame
throw u.framesToPop=1,u}}}
/***/,
/***/5350:
/***/(e,t,n)=>{"use strict";
/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 *
 */var r=n(3743);
/**
 * Similar to invariant but only logs a warning if the condition is not met.
 * This can be used to log issues in development environments in critical
 * paths. Removing the logging code for production environments will keep the
 * same logic and follow the same code paths.
 */e.exports=r}
/***/,
/***/9219:
/***/(e,t,n)=>{"use strict";var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},s=o(n(9196)),i=o(n(349)),a=o(n(8470));
/**
                                                                                                                                                                                                                                                                               * External Dependencies
                                                                                                                                                                                                                                                                               */
/**
 * Internal Dependencies
 */function o(e){return e&&e.__esModule?e:{default:e}}var u=void 0;function c(e,t){var n,a,o,l,m,p,d,f,v=[],y={};for(p=0;p<e.length;p++)if("string"!==(m=e[p]).type){
// component node should at least be set
if(!t.hasOwnProperty(m.value)||void 0===t[m.value])throw new Error("Invalid interpolation, missing component node: `"+m.value+"`");
// should be either ReactElement or null (both type "object"), all other types deprecated
if("object"!==r(t[m.value]))throw new Error("Invalid interpolation, component node must be a ReactElement or null: `"+m.value+"`","\n> "+u);
// we should never see a componentClose token in this loop
if("componentClose"===m.type)throw new Error("Missing opening component token: `"+m.value+"`");if("componentOpen"===m.type){n=t[m.value],o=p;break}
// componentSelfClosing token
v.push(t[m.value])}else v.push(m.value);return n&&(l=function(e,t){var n,r,s=t[e],i=0;for(r=e+1;r<t.length;r++)if((n=t[r]).value===s.value){if("componentOpen"===n.type){i++;continue}if("componentClose"===n.type){if(0===i)return r;i--}}
// if we get this far, there was no matching close token
throw new Error("Missing closing component token `"+s.value+"`")}(o,e),d=c(e.slice(o+1,l),t),a=s.default.cloneElement(n,{},d),v.push(a),l<e.length-1&&(f=c(e.slice(l+1),t),v=v.concat(f))),1===v.length?v[0]:(v.forEach((function(e,t){e&&(y["interpolation-child-"+t]=e)})),(0,i.default)(y))}t.Z=function(e){var t=e.mixedString,n=e.components,s=e.throwErrors;if(u=t,!n)return t;if("object"!==(void 0===n?"undefined":r(n))){if(s)throw new Error("Interpolation Error: unable to process `"+t+"` because components is not an object");return t}var i=(0,a.default)(t);try{return c(i,n)}catch(e){if(s)throw new Error("Interpolation Error: unable to process `"+t+"` because of error `"+e.message+"`");return t}}}
//# sourceMappingURL=index.js.map
/***/,
/***/8470:
/***/e=>{"use strict";function t(e){
// {{/example}}
return e.match(/^\{\{\//)?{type:"componentClose",value:e.replace(/\W/g,"")}:
// {{example /}}
e.match(/\/\}\}$/)?{type:"componentSelfClosing",value:e.replace(/\W/g,"")}:
// {{example}}
e.match(/^\{\{/)?{type:"componentOpen",value:e.replace(/\W/g,"")}:{type:"string",value:e}}e.exports=function(e){// split to components and strings
return e.split(/(\{\{\/?\s*\w+\s*\/?\}\})/g).map(t)}}
//# sourceMappingURL=tokenize.js.map
/***/,
/***/349:
/***/(e,t,n)=>{"use strict";
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */var r=n(9196),s="function"==typeof Symbol&&Symbol.for&&Symbol.for("react.element")||60103,i=n(3743),a=n(7081),o=n(5350),u="function"==typeof Symbol&&Symbol.iterator;function c(e,t){
// Do some typechecking here since we call this blindly. We want to ensure
// that we don't block potential future ES APIs.
return e&&"object"==typeof e&&null!=e.key?(n=e.key,r={"=":"=0",":":"=2"},"$"+(""+n).replace(/[=:]/g,(function(e){return r[e]}))):t.toString(36);
// Implicit key determined by the index in the set
var n,r}function l(e,t,n,r){var i,o=typeof e;if("undefined"!==o&&"boolean"!==o||(
// All of the above are perceived as null.
e=null),null===e||"string"===o||"number"===o||
// The following is inlined from ReactElement. This means we can optimize
// some checks. React Fiber also inlines this logic for similar purposes.
"object"===o&&e.$$typeof===s)return n(r,e,
// If it's the only child, treat the name as if it was wrapped in an array
// so that it's consistent if the number of children grows.
""===t?"."+c(e,0):t),1;var m=0,p=""===t?".":t+":";// Count of children found in the current subtree.
if(Array.isArray(e))for(var d=0;d<e.length;d++)m+=l(i=e[d],p+c(i,d),n,r);else{var f=// Before Symbol spec.
function(e){var t=e&&(u&&e[u]||e["@@iterator"]);if("function"==typeof t)return t}(e);if(f){0;for(var v,y=f.call(e),_=0;!(v=y.next()).done;)m+=l(i=v.value,p+c(i,_++),n,r)}else if("object"===o){0;var h=""+e;a(!1,"Objects are not valid as a React child (found: %s).%s","[object Object]"===h?"object with keys {"+Object.keys(e).join(", ")+"}":h,"")}}return m}var m=/\/+/g;function p(e){return(""+e).replace(m,"$&/")}var d,f,v=y,y=function(e){var t=this;if(t.instancePool.length){var n=t.instancePool.pop();return t.call(n,e),n}return new t(e)},_=function(e){var t=this;a(e instanceof t,"Trying to release an instance into a pool of a different type."),e.destructor(),t.instancePool.length<t.poolSize&&t.instancePool.push(e)};function h(e,t,n,r){this.result=e,this.keyPrefix=t,this.func=n,this.context=r,this.count=0}function g(e,t,n){var s,a,o=e.result,u=e.keyPrefix,c=e.func,l=e.context,m=c.call(l,t,e.count++);Array.isArray(m)?b(m,o,n,i.thatReturnsArgument):null!=m&&(r.isValidElement(m)&&(s=m,a=
// Keep both the (mapped) and old keys if they differ, just as
// traverseAllChildren used to do for objects as children
u+(!m.key||t&&t.key===m.key?"":p(m.key)+"/")+n,m=r.cloneElement(s,{key:a},void 0!==s.props?s.props.children:void 0)),o.push(m))}function b(e,t,n,r,s){var i="";null!=n&&(i=p(n)+"/");var a=h.getPooled(t,i,r,s);!function(e,t,n){null==e||l(e,"",t,n)}(e,g,a),h.release(a)}h.prototype.destructor=function(){this.result=null,this.keyPrefix=null,this.func=null,this.context=null,this.count=0},d=function(e,t,n,r){var s=this;if(s.instancePool.length){var i=s.instancePool.pop();return s.call(i,e,t,n,r),i}return new s(e,t,n,r)},(f=h).instancePool=[],f.getPooled=d||v,f.poolSize||(f.poolSize=10),f.release=_;e.exports=function(e){if("object"!=typeof e||!e||Array.isArray(e))return o(!1,"React.addons.createFragment only accepts a single object. Got: %s",e),e;if(r.isValidElement(e))return o(!1,"React.addons.createFragment does not accept a ReactElement without a wrapper object."),e;a(1!==e.nodeType,"React.addons.createFragment(...): Encountered an invalid child; DOM elements are not valid children of React components.");var t=[];for(var n in e)b(e[n],t,n,i.thatReturnsArgument);return t}}
/***/,
/***/5463:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Lt:()=>/* binding */r
/* harmony export */});
/* unused harmony exports API_SPECIAL_ACTIVE_JOB_ID, FETCH_FROM_API, WAIT, START_LOAD_CURRENT_JOB_STATE, SUCCESS_LOAD_CURRENT_JOB_STATE, ERROR_LOAD_CURRENT_JOB_STATE, SET_JOB_STATE, START_IMPORT, SUCCESS_START_IMPORT, ERROR_START_IMPORT, START_UPLOAD_IMPORT_DATA_FILE, SUCCESS_UPLOAD_IMPORT_DATA_FILE, ERROR_UPLOAD_IMPORT_DATA_FILE, START_DELETE_IMPORT_DATA_FILE, SUCCESS_DELETE_IMPORT_DATA_FILE, ERROR_DELETE_IMPORT_DATA_FILE, SET_IMPORT_LOG, ERROR_FETCH_IMPORT_LOG, RESET_STATE */
/**
 * Data import constants.
 */
var r="/sensei-internal/v1/import/"}
/***/,
/***/7769:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */D:()=>/* binding */i
/* harmony export */});
/* harmony import */var r=n(228),s=n(5463),i=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n=[].concat((0,r/* ["default"] */.Z)(e?[e]:[]),(0,r/* ["default"] */.Z)(t||[])).join("/");return s/* .API_BASE_PATH */.Lt+n};
/* harmony import */}
/***/,
/***/7451:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */O:()=>/* reexport safe */r.Z
/* harmony export */,A:()=>/* reexport safe */s.Z
/* harmony export */});
/* harmony import */var r=n(906),s=n(4464);
/* harmony import */}
/***/,
/***/906:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>s
/* harmony export */});
/* harmony import */var r=n(9307);
/* harmony import */
/* harmony default export */const s=function(e,t,n){var s=arguments.length>3&&void 0!==arguments[3]?arguments[3]:window,i=(0,r.useCallback)(t,n);
// eslint-disable-next-line react-hooks/exhaustive-deps
(0,r.useEffect)((function(){var t=[e,i,!1];return s.addEventListener.apply(s,t),function(){s.removeEventListener.apply(s,t)}}),[e,i,s])};
/***/},
/***/9373:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */I:()=>/* binding */s
/* harmony export */});
/* harmony import */var r=n(9307);
/* harmony import */
/**
 * WordPress dependencies
 */
/**
 * Use Sensei color theme.
 *
 * Requires enqueueing the sensei-wp-components stylesheet.
 */
function s(){(0,r.useLayoutEffect)((function(){return document.body.classList.add("sensei-color"),function(){return document.body.classList.remove("sensei-color")}}))}
/***/},
/***/4464:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>a
/* harmony export */});
/* harmony import */var r=n(228),s=n(9307),i=function(e,t){var n,s;e?(n=document.body.classList).add.apply(n,(0,r/* ["default"] */.Z)(t)):(s=document.body.classList).remove.apply(s,(0,r/* ["default"] */.Z)(t));document.documentElement.classList.toggle("wp-toolbar",!e)};
/* harmony import */
/* harmony default export */const a=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];(0,s.useLayoutEffect)((function(){var t=[].concat((0,r/* ["default"] */.Z)(e),["sensei-wp-admin-fullscreen"]);return i(!0,t),function(){i(!1,t)}}),[e])};
/***/},
/***/3754:
/***/(e,t,n)=>{"use strict";n.r(t),
/* harmony export */n.d(t,{
/* harmony export */fetchFromAPI:()=>/* binding */o
/* harmony export */,fetchSetupWizardData:()=>/* binding */u
/* harmony export */,successFetch:()=>/* binding */c
/* harmony export */,errorFetch:()=>/* binding */l
/* harmony export */,startFetch:()=>/* binding */m
/* harmony export */,startSubmit:()=>/* binding */p
/* harmony export */,successSubmit:()=>/* binding */d
/* harmony export */,errorSubmit:()=>/* binding */f
/* harmony export */,submitStep:()=>/* binding */v
/* harmony export */,setStepData:()=>/* binding */y
/* harmony export */,applyStepData:()=>/* binding */_
/* harmony export */});
/* harmony import */var r=n(9642),s=n(7370),i=regeneratorRuntime.mark(u),a=regeneratorRuntime.mark(v),o=function(e){return{type:r/* .FETCH_FROM_API */.nx,request:e}};
/* harmony import */
/**
 * Fetch setup wizard data action creator.
 */
function u(){var e;return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,m();case 2:return t.prev=2,t.next=5,o({path:r/* .API_BASE_PATH.replace */.Lt.replace(/\/$/,"")});case 5:return e=t.sent,t.next=8,c((0,s/* .normalizeSetupWizardData */.A)(e));case 8:t.next=14;break;case 10:return t.prev=10,t.t0=t.catch(2),t.next=14,l(t.t0);case 14:case"end":return t.stop()}}),i,null,[[2,10]])}
/**
 * @typedef  {Object} SuccessSetupWizardDataAction
 * @property {string} type Action type.
 * @property {Object} data Setup wizard data.
 */
/**
 * Success fetch action creator.
 *
 * @param {Object} data Setup wizard data.
 *
 * @return {SuccessSetupWizardDataAction} Success fetch action.
 */var c=function(e){return{type:r/* .SUCCESS_FETCH_SETUP_WIZARD_DATA */.WS,data:e}},l=function(e){return{type:r/* .ERROR_FETCH_SETUP_WIZARD_DATA */.oq,error:e}},m=function(){return{type:r/* .START_FETCH_SETUP_WIZARD_DATA */.Qs}},p=function(e,t){return{type:r/* .START_SUBMIT_SETUP_WIZARD_DATA */.Zn,step:e,stepData:t}},d=function(e){return{type:r/* .SUCCESS_SUBMIT_SETUP_WIZARD_DATA */.o,step:e}},f=function(e){return{type:r/* .ERROR_SUBMIT_SETUP_WIZARD_DATA */.VZ,error:e}};
/**
 * @typedef  {Object}         ErrorFetchAction
 * @property {string}         type  Action type.
 * @property {Object|boolean} error Error object or false.
 */
/**
 * Error fetch action creator.
 *
 * @param {Object|boolean} error Error object or false.
 *
 * @return {ErrorFetchAction} Error action.
 */
/**
 * Submit step action creator.
 *
 * @param {string}   step                Step name.
 * @param {Object}   stepData            Data to submit.
 * @param {Object}   [options]
 * @param {Function} [options.onSuccess] Step name.
 * @param {Function} [options.onError]   Data to submit.
 */
function v(e,t){var n,s,i,u=arguments;return regeneratorRuntime.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:return n=u.length>2&&void 0!==u[2]?u[2]:{},s=n.onSuccess,i=n.onError,a.next=3,p(e,t);case 3:return a.prev=3,a.next=6,o({path:r/* .API_BASE_PATH */.Lt+e,method:"POST",data:t});case 6:return a.next=8,d(e);case 8:return a.next=10,_(e,t);case 10:return a.next=12,y(e,t);case 12:s&&s(),a.next=20;break;case 15:return a.prev=15,a.t0=a.catch(3),a.next=19,f(a.t0);case 19:i&&i(a.t0);case 20:case"end":return a.stop()}}),a,null,[[3,15]])}
/**
 * @typedef  {Object} SetStepDataAction
 * @property {string} type Action type.
 * @property {string} step Step name.
 * @property {Object} data Step data.
 */
/**
 * Set welcome step data action creator.
 *
 * @param {string} step Step name.
 * @param {Object} data Step data object.
 *
 * @return {SetStepDataAction} Set welcome step data action.
 */var y=function(e,t){return{type:r/* .SET_STEP_DATA */.fv,step:e,data:t}},_=function(e,t){return{type:r/* .APPLY_STEP_DATA */.Pm,step:e,data:t}};
/**
 * Apply side-effects for data change.
 *
 * @param {string} step Step name.
 * @param {Object} data Step data object.
 */}
/***/,
/***/9642:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Lt:()=>/* binding */r
/* harmony export */,nx:()=>/* binding */s
/* harmony export */,Qs:()=>/* binding */i
/* harmony export */,WS:()=>/* binding */a
/* harmony export */,oq:()=>/* binding */o
/* harmony export */,Zn:()=>/* binding */u
/* harmony export */,o:()=>/* binding */c
/* harmony export */,VZ:()=>/* binding */l
/* harmony export */,fv:()=>/* binding */m
/* harmony export */,Pm:()=>/* binding */p
/* harmony export */});
/**
 * Setup wizard constants.
 */
var r="/sensei-internal/v1/setup-wizard/",s="FETCH_FROM_API",i="START_FETCH_SETUP_WIZARD_DATA",a="SUCCESS_FETCH_SETUP_WIZARD_DATA",o="ERROR_FETCH_SETUP_WIZARD_DATA",u="START_SUBMIT_SETUP_WIZARD_DATA",c="SUCCESS_SUBMIT_SETUP_WIZARD_DATA",l="ERROR_SUBMIT_SETUP_WIZARD_DATA",m="SET_STEP_DATA",p="APPLY_STEP_DATA";
/**
 * Generic fetch action type constants.
 */}
/***/,
/***/3383:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>c
/* harmony export */});
/* harmony import */var r,s=n(4649),i=n(6989),a=n.n(i),o=n(9642),u=n(7959);
/* harmony import */
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
/* harmony default export */const c=(r={},(0,s/* ["default"] */.Z)(r,o/* .FETCH_FROM_API */.nx,(function(e){var t=e.request;return a()(t)})),(0,s/* ["default"] */.Z)(r,o/* .APPLY_STEP_DATA */.Pm,(function(e){var t=e.step,n=e.data;if("welcome"===t)u/* .logEvent.enable */.K.enable(n.usage_tracking)})),r);
/***/},
/***/7690:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>c
/* harmony export */});
/* harmony import */var r=n(9818),s=n(8825),i=n(3754),a=n(9640),o=n(3383),u=n(1863);
/* harmony import */
/* harmony default export */const c=function(){(0,r.registerStore)("sensei/setup-wizard",{reducer:s/* ["default"] */.Z,actions:i,selectors:a,controls:o/* ["default"] */.Z,resolvers:u})};
/***/},
/***/7370:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */o:()=>/* binding */a
/* harmony export */,A:()=>/* binding */o
/* harmony export */});
/* harmony import */var r=n(189),s=n(5736),i=n(7486),__=s.__,a=function(e){return(0,r/* ["default"] */.Z)((0,r/* ["default"] */.Z)({},e),{},{options:e.options.map((function(e){return(0,r/* ["default"] */.Z)((0,r/* ["default"] */.Z)({},e),{},{slug:e.product_slug,title:(t=e,s=t.product_slug,a=t.title,o=t.price,n=t.status===i/* .INSTALLED_STATUS */.eF?__("Installed","sensei-lms"):o?"".concat(o," ").concat(__("per year","sensei-lms")):__("Free","sensei-lms"),"".concat(a).concat("woocommerce"===s?"*":""," — ").concat(n)),rawTitle:e.title});var t,n,s,a,o}))})},o=function(e){return(0,r/* ["default"] */.Z)((0,r/* ["default"] */.Z)({},e),{},{features:a(e.features)})};
/* harmony import */}
/***/,
/***/8825:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>m
/* harmony export */});
/* harmony import */var r=n(4649),s=n(228),i=n(189),a=n(9642),o=n(7486),u=n(4735),c={isFetching:!0,fetchError:!1,isSubmitting:!1,submitError:!1,data:{completedSteps:[],welcome:{usage_tracking:!1},purpose:{selected:[],other:""},features:{selected:[],options:[]},ready:{}}},l=function(e,t){return t.map((function(t){return e.includes(t.slug)?(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},t),{},{status:(0,u/* .getWccomProductId */.s)(t)?o/* .EXTERNAL_STATUS */.oi:o/* .INSTALLING_STATUS */.z$,error:null}):t}))};
/* harmony import */
/**
 * Setup wizard reducer.
 *
 * @param {Object}         state  Current state.
 * @param {{type: string}} action Action to update the state.
 *
 * @return {Object} State updated.
 */
/* harmony default export */const m=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:c,t=arguments.length>1?arguments[1]:void 0;switch(t.type){case a/* .START_FETCH_SETUP_WIZARD_DATA */.Qs:return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e),{},{isFetching:!0,fetchError:!1});case a/* .SUCCESS_FETCH_SETUP_WIZARD_DATA */.WS:return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e),{},{isFetching:!1,data:(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e.data),t.data)});case a/* .ERROR_FETCH_SETUP_WIZARD_DATA */.oq:return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e),{},{isFetching:!1,fetchError:t.error});case a/* .START_SUBMIT_SETUP_WIZARD_DATA */.Zn:var n=t.stepData,o=t.step,u=null;// Clear status and error for retry.
return"features-installation"===o&&(u=(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e),{},{data:(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e.data),{},{features:(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e.data.features),{},{options:l(n.selected,e.data.features.options)})})})),(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},u||e),{},{isSubmitting:!0,submitError:!1});case a/* .SUCCESS_SUBMIT_SETUP_WIZARD_DATA */.o:return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e),{},{isSubmitting:!1,data:(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e.data),{},{completedSteps:[].concat((0,s/* ["default"] */.Z)(e.data.completedSteps),[t.step])})});case a/* .ERROR_SUBMIT_SETUP_WIZARD_DATA */.VZ:return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e),{},{isSubmitting:!1,submitError:t.error});case a/* .SET_STEP_DATA */.fv:return(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e),{},{data:(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e.data),{},(0,r/* ["default"] */.Z)({},t.step,(0,i/* ["default"] */.Z)((0,i/* ["default"] */.Z)({},e.data[t.step]),t.data)))});default:return e}};
/***/},
/***/1863:
/***/(e,t,n)=>{"use strict";n.r(t),
/* harmony export */n.d(t,{
/* harmony export */getStepData:()=>/* binding */o
/* harmony export */});
/* harmony import */var r=n(9642),s=n(3754),i=n(7370),a=regeneratorRuntime.mark(o);
/* harmony import */
/**
 * Internal dependencies
 */
function o(e,t){var n;return regeneratorRuntime.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:if(t){a.next=2;break}return a.abrupt("return");case 2:return a.next=4,(0,s.fetchFromAPI)({path:r/* .API_BASE_PATH */.Lt+e});case 4:return n=a.sent,a.abrupt("return",(0,s.setStepData)(e,(0,i/* .normalizeFeaturesData */.o)(n)));case 6:case"end":return a.stop()}}),a)}
/***/},
/***/9640:
/***/(e,t,n)=>{"use strict";n.r(t),
/* harmony export */n.d(t,{
/* harmony export */isFetching:()=>/* binding */i
/* harmony export */,getFetchError:()=>/* binding */a
/* harmony export */,isSubmitting:()=>/* binding */o
/* harmony export */,getSubmitError:()=>/* binding */u
/* harmony export */,getStepData:()=>/* binding */c
/* harmony export */,getNavigationSteps:()=>/* binding */l
/* harmony export */,isCompleteStep:()=>/* binding */m
/* harmony export */});
/* harmony import */var r=n(189),s=n(5686),i=function(e){return e.isFetching},a=function(e){return e.fetchError},o=function(e){return e.isSubmitting},u=function(e){return e.submitError},c=function(e,t){return e.data[t]},l=function(e){var t=e.data.completedSteps,n=s/* .steps.map */.S.map((function(e){return(0,r/* ["default"] */.Z)((0,r/* ["default"] */.Z)({},e),{},{isComplete:t.includes(e.key),isNext:!1})}));return(n.find((function(e){return!e.isComplete}))||n[0]).isNext=!0,n},m=function(e,t){return e.data.completedSteps.includes(t)};
/* harmony import */}
/***/,
/***/7552:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */m:()=>/* binding */a
/* harmony export */});
/* harmony import */var r=n(9307),s=n(9818),i=n(5609),a=function(e){var t=(0,s.useSelect)((function(t){return{stepData:t("sensei/setup-wizard").getStepData(e),isSubmitting:t("sensei/setup-wizard").isSubmitting(),error:t("sensei/setup-wizard").getSubmitError(),isComplete:t("sensei/setup-wizard").isCompleteStep(e)}}),[]),n=t.stepData,a=t.isSubmitting,o=t.error,u=t.isComplete,c=(0,s.useDispatch)("sensei/setup-wizard").submitStep,l=o?(0,r.createElement)(i.Notice,{status:"error",className:"sensei-setup-wizard__submit-error",isDismissible:!1},o.message):null;return{stepData:n,submitStep:(0,r.useCallback)((function(t,n){return c(e,t,n)}),[e,c]),isSubmitting:a,error:o,errorNotice:l,isComplete:u}};
/* harmony import */}
/***/,
/***/7346:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>s
/* harmony export */});
/* harmony import */var r=n(9307);
/* harmony import */
/* harmony default export */const s=function(){return(0,r.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",role:"img","aria-hidden":"true",focusable:"false"},(0,r.createElement)("path",{d:"M9 18.6L3.5 13l1-1L9 16.4l9.5-9.9 1 1z",fill:"currentColor"}))};
/***/},
/***/4978:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>l
/* harmony export */});
/* harmony import */var r=n(9307),s=n(5609),i=n(5736),a=n(4735),o=n(6507),u=n(9274),c=n(4500),__=i.__;
/* harmony import */
/* harmony default export */const l=function(e){var t=e.features,n=void 0===t?[]:t,i=e.isSubmitting,l=e.errorNotice,m=e.onInstall,p=e.onSkip;return(0,r.createElement)(s.Modal,{className:"sensei-setup-wizard__features-confirmation-modal",title:__("Would you like to install the following features now?","sensei-lms"),isDismissible:!1},(0,r.createElement)(c/* ["default"] */.Z,{items:n.map((function(e){var t=e.slug,s=e.title,i=e.excerpt;return{title:s,content:(0,r.createElement)(u/* ["default"] */.Z,{slug:t,excerpt:i,observation:(0,o/* .getFeatureObservation */.Q)(t,n)})}}))}),(0,r.createElement)("div",{className:"sensei-setup-wizard__modal-footer"},(0,r.createElement)("p",null,__("You won't have access to this functionality until the extensions have been installed.","sensei-lms")),n.some(a/* .getWccomProductId */.s)&&(0,r.createElement)("p",null,(0,r.createElement)("strong",null,__("WooCommerce.com will open in a new tab so that you can complete the purchase process.","sensei-lms"))),l,(0,r.createElement)("div",{className:"sensei-setup-wizard__group-buttons group-right"},(0,r.createElement)(s.Button,{className:"sensei-setup-wizard__button",isTertiary:!0,isBusy:i,disabled:i,onClick:p},__("I'll do it later","sensei-lms")),(0,r.createElement)(s.Button,{className:"sensei-setup-wizard__button",isPrimary:!0,isBusy:i,disabled:i,onClick:m},__("Install now","sensei-lms")))))};
/***/},
/***/6507:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Q:()=>/* binding */i
/* harmony export */});
/* harmony import */var r=n(5736),s=n(4735),__=r.__,i=function(e,t){if("woocommerce"!==e||!t)return null;var n=t.filter(s/* .getWccomProductId */.s).map((function(e){return e.rawTitle})).join(__(" and ","sensei-lms"));return(0,r.sprintf)(// translators: Placeholder is the plugin titles.
__("* WooCommerce is required to receive updates for %1$s.","sensei-lms"),n)};
/* harmony import */}
/***/,
/***/9274:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var r=n(5773),s=n(9307),i=n(5736),a=n(7959),__=i.__;
/* harmony import */
/* harmony default export */const o=function(e){var t=e.slug,n=e.excerpt,i=e.link,o=e.observation;return(0,s.createElement)(s.Fragment,null,n,i&&(0,s.createElement)(s.Fragment,null," ",(0,s.createElement)("a",(0,r/* ["default"] */.Z)({className:"sensei-setup-wizard__learn-more link__color-primary",href:i,target:"_blank",rel:"noopener noreferrer"},(0,a/* .logLink */.B)("setup_wizard_features_learn_more",{slug:t})),__("Learn more","sensei-lms"))),o&&(0,s.createElement)("em",{className:"sensei-setup-wizard__feature-observation"},o))};
/***/},
/***/7486:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */z$:()=>/* binding */c
/* harmony export */,VP:()=>/* binding */l
/* harmony export */,eF:()=>/* binding */m
/* harmony export */,oi:()=>/* binding */p
/* harmony export */,ZP:()=>f
/* harmony export */});
/* harmony import */var r,s=n(4649),i=n(9307),a=n(5609),o=n(5736),u=n(7346),__=o.__,c="installing",l="error",m="installed",p="external",d=(r={},(0,s/* ["default"] */.Z)(r,c,(0,i.createElement)(i.Fragment,null,(0,i.createElement)(a.Spinner,null),(0,i.createElement)("span",{className:"screen-reader-text"},__("Installing plugin","sensei-lms")))),(0,s/* ["default"] */.Z)(r,l,(0,i.createElement)("i",{className:"sensei-setup-wizard__circle-icon-wrapper error-icon-wrapper alert-icon"},(0,i.createElement)("span",{className:"screen-reader-text"},__("Error installing plugin","sensei-lms")))),(0,s/* ["default"] */.Z)(r,m,(0,i.createElement)("i",{className:"sensei-setup-wizard__circle-icon-wrapper success-icon-wrapper"},(0,i.createElement)(u/* ["default"] */.Z,null),(0,i.createElement)("span",{className:"screen-reader-text"},__("Plugin installed","sensei-lms")))),(0,s/* ["default"] */.Z)(r,p,(0,i.createElement)(a.Dashicon,{icon:"external"},(0,i.createElement)("span",{className:"screen-reader-text"},__("Purchasing plugin","sensei-lms")))),r);
/* harmony import */
/* harmony default export */const f=function(e){var t=e.status;return(0,i.createElement)("div",{className:"sensei-setup-wizard__icon-status"},d[t])};
/***/},
/***/1132:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>m
/* harmony export */});
/* harmony import */var r=n(4649),s=n(228),i=n(9307),a=n(42),o=n.n(a),u=n(5609),c=n(5736),l=n(9274),__=c.__;
/* harmony import */
/* harmony default export */const m=function(e){var t=e.features,n=e.isSubmitting,a=e.errorNotice,c=e.selectedSlugs,m=e.onChange,p=e.onContinue,d=function(e){return function(t){m((0,s/* ["default"] */.Z)(t?[e].concat((0,s/* ["default"] */.Z)(c)):c.filter((function(t){return t!==e}))))}};return(0,i.createElement)(i.Fragment,null,(0,i.createElement)("div",{className:"sensei-setup-wizard__checkbox-list"},(!t||0===t.length)&&(0,i.createElement)(u.Notice,{status:"error",isDismissible:!1},__("No features found.","sensei-lms")),t.filter((function(e){return!e.unselectable})).map((function(e){var t=e.slug,n=e.title,s=e.excerpt,a=e.link,m=e.status;return(0,i.createElement)(u.CheckboxControl,{key:t,label:n,help:(0,i.createElement)(l/* ["default"] */.Z,{slug:t,excerpt:s,link:a}),onChange:d(t),checked:c.includes(t),disabled:["installed","installing","error"].includes(m),className:o()("sensei-setup-wizard__checkbox",(0,r/* ["default"] */.Z)({},"status-".concat(m),m))})}))),a,(0,i.createElement)(u.Button,{isPrimary:!0,isBusy:n,disabled:n,className:"sensei-setup-wizard__button sensei-setup-wizard__button-card",onClick:p},__("Continue","sensei-lms")))};
/***/},
/***/1689:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>g
/* harmony export */});
/* harmony import */var r=n(228),s=n(6886),i=n(9307),a=n(2819),o=n(5736),u=n(5609),c=n(7486),l=n(7959),m=n(9400),p=n(7552),d=n(4735),f=n(4978),v=n(6016),y=n(1132),_=n(3011),__=o.__,h="woocommerce";
/* harmony import */
/* harmony default export */const g=function(){var e=(0,i.useState)(!1),t=(0,s/* ["default"] */.Z)(e,2),n=t[0],o=t[1],g=(0,i.useState)(!1),b=(0,s/* ["default"] */.Z)(g,2),w=b[0],E=b[1],Z=(0,i.useState)([]),S=(0,s/* ["default"] */.Z)(Z,2),k=S[0],N=S[1],x=(0,m/* .useQueryStringRouter */.Nt)().goTo,C=(0,p/* .useSetupWizardStep */.m)("features"),z=C.stepData,P=C.submitStep,O=C.isSubmitting,T=C.errorNotice,j=z.options,A=z.selected,R=(0,p/* .useSetupWizardStep */.m)("features-installation").submitStep;// Mark as selected also the already submitted slugs (Except the installed ones).
(0,i.useEffect)((function(){N((function(e){return(0,a.uniq)([].concat((0,r/* ["default"] */.Z)(e),(0,r/* ["default"] */.Z)(function(e,t){return e.filter((function(e){var n=t.find((function(t){return t.slug===e}));return!!n&&c/* .INSTALLED_STATUS */.eF!==n.status}))}(A,j))))}))}),[A,j]);// Get selected features based on the selectedSlugs.
var D=(0,i.useCallback)((function(){return j.filter((function(e){return k.includes(e.slug)}))}),[j,k]),F=(0,i.useCallback)((function(){var e=j.find((function(e){return h===e.slug}));return e&&c/* .INSTALLED_STATUS */.eF===e.status}),[j]);// Add or remove WooCommerce to the selected slugs.
(0,i.useEffect)((function(){var e=D(),t=e.some((function(e){return e.slug===h})),n=e.some(d/* .getWccomProductId */.s);n||!t?!n||t||F()||N((function(e){return[].concat((0,r/* ["default"] */.Z)(e),[h])})):N((function(e){return e.filter((function(e){return e!==h}))}))}),[D,F]);// Finish and submit features selection.
var I=function(){R({selected:k},{onSuccess:function(){o(!1),E(!0)}})},B=function(){var e=D().filter((function(e){return(0,d/* .getWccomProductId */.s)(e)&&c/* .INSTALLED_STATUS */.eF!==e.status}));if(e.length){var t=(0,d/* .getWoocommerceComPurchaseUrl */.x)(e,z.wccom);window.open(t)}},L=function(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];x("ready");var t=!0===e?"setup_wizard_features_install_cancel":"setup_wizard_features_continue";(0,l/* .logEvent */.K)(t,{slug:k.join(",")})};// Start features installation.
return(0,i.createElement)(i.Fragment,null,(0,i.createElement)("div",{className:"sensei-setup-wizard__title"},(0,i.createElement)(_.H,null,__("Enhance your online courses with these optional features.","sensei-lms"))),(0,i.createElement)(u.Card,{className:"sensei-setup-wizard__card",elevation:2},(0,i.createElement)(u.CardBody,null,w?(0,i.createElement)(v/* ["default"] */.Z,{onContinue:L,onRetry:function(e){R({selected:e}),(0,l/* .logEvent */.K)("setup_wizard_features_install_retry",{slug:e.join(",")})}}):(0,i.createElement)(y/* ["default"] */.Z,{features:j,isSubmitting:O,errorNotice:T,selectedSlugs:k,onChange:N,onContinue:function(){P({selected:k},{onSuccess:function(){o(!0),0===k.length&&L()}})}}))),n&&(0,i.createElement)(f/* ["default"] */.Z,{features:D(),isSubmitting:O,errorNotice:T,onInstall:function(){(0,l/* .logEvent */.K)("setup_wizard_features_install",{slug:k.join(",")}),I(),B()},onSkip:function(){return L(!0)}}))};
/***/},
/***/6016:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>p
/* harmony export */});
/* harmony import */var r=n(6886),s=n(9307),i=n(5609),a=n(5736),o=n(6507),u=n(9274),c=n(7486),l=n(8183),m=n(4500),__=a.__;
/* harmony import */
/* harmony default export */const p=function(e){var t,n=e.onContinue,a=e.onRetry,p=(0,s.useState)(!0),d=(0,r/* ["default"] */.Z)(p,2),f=d[0],v=d[1],y=(0,s.useState)(!0),_=(0,r/* ["default"] */.Z)(y,2),h=_[0],g=_[1],b=(0,s.useState)(!1),w=(0,r/* ["default"] */.Z)(b,2),E=w[0],Z=w[1],S=(0,l/* ["default"] */.Z)(h),k=S.options.filter((function(e){return S.selected.includes(e.slug)}));if(// Update general statuses when features is updated.
(0,s.useEffect)((function(){v(k.some((function(e){return e.status===c/* .INSTALLING_STATUS */.z$}))),g(k.some((function(e){return[c/* .INSTALLING_STATUS */.z$,c/* .EXTERNAL_STATUS */.oi].includes(e.status)}))),Z(k.some((function(e){return e.status===c/* .ERROR_STATUS */.VP})))}),[k]),f)t=(0,s.createElement)(i.Button,{isPrimary:!0,isBusy:!0,disabled:!0,className:"sensei-setup-wizard__button"},__("Installing…","sensei-lms"));else if(E){t=(0,s.createElement)(s.Fragment,null,(0,s.createElement)(i.Button,{isPrimary:!0,className:"sensei-setup-wizard__button",onClick:function(){a(k.filter((function(e){return e.status===c/* .ERROR_STATUS */.VP})).map((function(e){return e.slug})))}},__("Retry","sensei-lms")),(0,s.createElement)(i.Button,{isSecondary:!0,className:"sensei-setup-wizard__button",onClick:n},__("Continue","sensei-lms")))}else t=(0,s.createElement)(i.Button,{isPrimary:!0,className:"sensei-setup-wizard__button",onClick:n},__("Continue","sensei-lms"));return(0,s.createElement)("div",{className:"sensei-setup-wizard__features-installation-feedback"},(0,s.createElement)(m/* ["default"] */.Z,{items:k.map((function(e){var t=e.slug,n=e.title,r=e.excerpt,i=e.link,l=e.error,m=e.status;return{title:n,content:(0,s.createElement)(s.Fragment,null,(0,s.createElement)(u/* ["default"] */.Z,{slug:t,excerpt:r,link:i,observation:(0,o/* .getFeatureObservation */.Q)(t,k)}),l&&(0,s.createElement)("p",{className:"sensei-setup-wizard__error-message"},l," ",(0,s.createElement)("button",{className:"sensei-setup-wizard__retry-button",type:"button",onClick:function(){return a([t])}},__("Retry?","sensei-lms")))),before:(0,s.createElement)(c/* ["default"] */.ZP,{status:m})}}))}),(0,s.createElement)("div",{className:"sensei-setup-wizard__group-buttons group-center"},t))};
/***/},
/***/8183:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>a
/* harmony export */});
/* harmony import */var r=n(6886),s=n(9307),i=n(9818);
/* harmony import */
/* harmony default export */const a=function(e){var t=(0,s.useState)(0),n=(0,r/* ["default"] */.Z)(t,2),a=n[0],o=n[1],u=(0,i.useSelect)((function(e){return e("sensei/setup-wizard").getStepData("features",!0)}),[a]),c=(0,i.useDispatch)("sensei/setup-wizard").invalidateResolution;return(0,s.useEffect)((function(){if(e){var t=setTimeout((function(){
// Invalidate resolution to get fresh content from the server.
c("getStepData",["features",!0]),o((function(e){return e+1}))}),2e3);return function(){clearTimeout(t)}}}),[a,e,c]),u};
/***/},
/***/8437:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var r=n(189),s=n(9307),i=n(9400),a=n(306);
/* harmony import */
/* harmony default export */const o=function(e){var t=e.steps,n=(0,i/* .useQueryStringRouter */.Nt)(),o=n.currentRoute;return t=function(e,t){var n=t.goTo;return e.map((function(e){return(0,r/* ["default"] */.Z)((0,r/* ["default"] */.Z)({},e),{},{onClick:e.isComplete||e.isNext?function(){return n(e.key)}:void 0})}))}(t,{goTo:n.goTo}),(0,s.createElement)(a/* ["default"] */.Z,{steps:t,currentStep:o})};
/***/},
/***/1808:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */a:()=>/* binding */d
/* harmony export */});
/* harmony import */var r=n(228),s=n(189),i=n(6886),a=n(9307),o=n(5736),u=n(5609),c=n(9400),l=n(7552),m=n(3011),__=o.__,p=[{id:"share_knowledge",title:__("Share your knowledge","sensei-lms"),description:__("You are a hobbyist interested in sharing your knowledge.","sensei-lms")},{id:"generate_income",title:__("Generate income","sensei-lms"),description:__("You would like to generate additional income for yourself or your business.","sensei-lms")},{id:"promote_business",title:__("Promote your business","sensei-lms"),description:__("You own a business and would like to use online courses to promote it.","sensei-lms")},{id:"provide_certification",title:__("Provide certification training","sensei-lms"),description:__("You want to help people become certified professionals.","sensei-lms")},{id:"train_employees",title:__("Train employees","sensei-lms"),description:__("You work at a company that regularly trains new or existing employees.","sensei-lms")},{id:"educate_students",title:__("Educate students","sensei-lms"),description:__("You are an educator who would like to create an online classroom.","sensei-lms")},{id:"other",title:__("Other","sensei-lms")}],d=function(){var e=(0,c/* .useQueryStringRouter */.Nt)().goTo,t=(0,l/* .useSetupWizardStep */.m)("purpose"),n=t.stepData,o=t.submitStep,d=t.isSubmitting,f=t.errorNotice,v=(0,a.useState)({selected:[],other:""}),y=(0,i/* ["default"] */.Z)(v,2),_=y[0],h=_.selected,g=_.other,b=y[1];(0,a.useEffect)((function(){return b(n)}),[n]);var w=!h.length,E=function(){e("features")};return(0,a.createElement)(a.Fragment,null,(0,a.createElement)("div",{className:"sensei-setup-wizard__title"},(0,a.createElement)(m.H,null,__("What is your primary purpose for offering online courses?","sensei-lms")),(0,a.createElement)("p",null," ",__("Choose any that apply","sensei-lms")," ")),(0,a.createElement)(u.Card,{className:"sensei-setup-wizard__card",elevation:2},(0,a.createElement)(u.CardBody,null,(0,a.createElement)("div",{className:"sensei-setup-wizard__checkbox-list"},p.map((function(e){var t=e.id,n=e.title,i=e.description;return(0,a.createElement)(u.CheckboxControl,{key:t,label:n,help:i,onChange:function(){return function(e){b((function(t){return(0,s/* ["default"] */.Z)((0,s/* ["default"] */.Z)({},t),{},{selected:h.includes(e)?h.filter((function(t){return t!==e})):[e].concat((0,r/* ["default"] */.Z)(h))})}))}(t)},checked:h.includes(t),className:"sensei-setup-wizard__checkbox"})})),h.includes("other")&&(0,a.createElement)(u.TextControl,{className:"sensei-setup-wizard__textcontrol-other",value:g,placeholder:__("Description","sensei-lms"),onChange:function(e){return b((function(t){return(0,s/* ["default"] */.Z)((0,s/* ["default"] */.Z)({},t),{},{other:e})}))}})),f,(0,a.createElement)(u.Button,{isPrimary:!0,isBusy:d,disabled:d||w,className:"sensei-setup-wizard__button sensei-setup-wizard__button-card",onClick:function(){o({selected:h,other:g},{onSuccess:E})}},__("Continue","sensei-lms")))))};
/* harmony import */}
/***/,
/***/3467:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */J:()=>/* binding */v
/* harmony export */});
/* harmony import */var r=n(5773),s=n(6886),i=n(9307),a=n(5736),o=n(5609),u=n(2335),c=n(2866),l=n(7959),m=n(7552),p=n(520),d=n(3011),f=n(4500),__=a.__,v=function(){var e=(0,m/* .useSetupWizardStep */.m)("ready"),t=e.submitStep,n=e.isComplete;(0,i.useEffect)((function(){n||t()}),[n,t]);var a=(0,p/* ["default"] */.Z)(),v=(0,s/* ["default"] */.Z)(a,3),y=v[0],_=v[1],h=v[2];return(0,i.createElement)(i.Fragment,null,(0,i.createElement)("div",{className:"sensei-setup-wizard__title"},(0,i.createElement)(d.H,null,__("You're ready to start creating online courses!","sensei-lms"))),(0,i.createElement)(o.Card,{className:"sensei-setup-wizard__card",elevation:2},(0,i.createElement)(o.CardBody,null,(0,i.createElement)(d/* .Section */.$,{className:"sensei-setup-wizard__mailinglist-signup"},(0,i.createElement)(d.H,null,__("Join our mailing list","sensei-lms")),(0,i.createElement)("p",null,__("We're here for you — get tips, product updates, and inspiration straight to your mailbox.","sensei-lms")),(0,i.createElement)(u/* .MailingListSignupForm */.L,null)),(0,i.createElement)(d/* .Section */.$,null,(0,i.createElement)(d.H,null,__("What's next?","sensei-lms")),(0,i.createElement)(f/* ["default"] */.Z,{items:[{title:__("Create some courses","sensei-lms"),content:__("You're ready to create online courses.","sensei-lms"),after:(0,i.createElement)(o.Button,(0,r/* ["default"] */.Z)({className:"sensei-setup-wizard__button",isPrimary:!0,href:"post-new.php?post_type=course"},(0,l/* .logLink */.B)("setup_wizard_ready_create_course")),__("Create a course","sensei-lms"))},{title:__("Import content","sensei-lms"),content:__("Transfer existing content to your site — just import a CSV file.","sensei-lms"),after:(0,i.createElement)(o.Button,(0,r/* ["default"] */.Z)({className:"sensei-setup-wizard__button",isSecondary:!0,href:"edit.php?post_type=course&page=sensei-tools&tool=import-content"},(0,l/* .logLink */.B)("setup_wizard_ready_import")),__("Import content","sensei-lms"))},{title:__("Install a sample course","sensei-lms"),content:(0,c/* .formatString */.U)(__("Install the {{em}}Getting Started with Sensei LMS{{/em}} course.","sensei-lms")),after:(0,i.createElement)("div",null,(0,i.createElement)(o.Button,{className:"sensei-setup-wizard__button",isSecondary:!0,onClick:y,isBusy:_,disabled:_},__("Install a sample course","sensei-lms")),h&&(0,i.createElement)("div",{className:"sensei-setup-wizard__error-message"},__("The sample course could not be imported. Please try again.","sensei-lms")))},{title:"Learn more",content:(0,c/* .formatString */.U)(__("Visit SenseiLMS.com to learn how to {{link}}create your first course.{{/link}}","sensei-lms"),{link:// eslint-disable-next-line jsx-a11y/anchor-has-content
(0,i.createElement)("a",(0,r/* ["default"] */.Z)({className:"link__color-primary",href:"https://senseilms.com/lesson/courses/",target:"_blank",rel:"noopener noreferrer"},(0,l/* .logLink */.B)("setup_wizard_ready_learn_more")))})}],className:"sensei-setup-wizard__item-list"})))),(0,i.createElement)("div",{className:"sensei-setup-wizard__bottom-actions"},(0,i.createElement)("a",(0,r/* ["default"] */.Z)({className:"link__color-secondary",href:"edit.php?post_type=course"},(0,l/* .logLink */.B)("setup_wizard_ready_exit")),__("Exit to Courses","sensei-lms"))))};
/* harmony import */}
/***/,
/***/2335:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */L:()=>/* binding */l
/* harmony export */});
/* harmony import */var r=n(5773),s=n(9307),i=n(5609),a=n(5736),o=n(7959),u=n(7552),c=n(4500),__=a.__,l=function(){var e=(0,u/* .useSetupWizardStep */.m)("ready").stepData;return(0,s.createElement)("form",{action:e.mc_url,method:"post",target:"_blank",className:"sensei-setup-wizard__mailinglist-signup-form"},(0,s.createElement)("input",{type:"hidden",name:"gdpr[".concat(e.gdpr_field,"]"),value:"Y"}),(0,s.createElement)(c/* ["default"] */.Z,{className:"sensei-setup-wizard__item-list",items:[{title:"",content:(0,s.createElement)(i.TextControl,{type:"email",name:"EMAIL",defaultValue:e.admin_email}),after:(0,s.createElement)(i.Button,(0,r/* ["default"] */.Z)({className:"sensei-setup-wizard__button",isPrimary:!0,type:"submit"},(0,o/* .logLink */.B)("setup_wizard_ready_mailing_list")),__("Yes, please!","sensei-lms"))}]}))};
/* harmony import */}
/***/,
/***/520:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>c
/* harmony export */});
/* harmony import */var r=n(6886),s=n(9307),i=n(6989),a=n.n(i),o=n(7769),u=n(7959);
/* harmony import */
/* harmony default export */const c=function(){var e=(0,s.useState)(!1),t=(0,r/* ["default"] */.Z)(e,2),n=t[0],i=t[1],c=(0,s.useState)(null),l=(0,r/* ["default"] */.Z)(c,2),m=l[0],p=l[1],d=(0,s.useState)(null),f=(0,r/* ["default"] */.Z)(d,2),v=f[0],y=f[1],_=(0,s.useState)(0),h=(0,r/* ["default"] */.Z)(_,2),g=h[0],b=h[1],w=function(e){i(!1),p(e.message),y(null)};// Logs polling.
(0,s.useEffect)((function(){v&&a()({path:(0,o/* .buildJobEndpointUrl */.D)(v,["process"]),method:"POST"}).then((function(e){if("completed"!==e.status.status)b((function(e){return e+1}));else{var t=window.sensei_setup_wizard.nonce;window.location.assign("?redirect_imported_sample=1&job_id=".concat(v,"&nonce=").concat(t))}})).catch(w)}),[v,g]);return[function(){i(!0),p(null),a()({path:(0,o/* .buildJobEndpointUrl */.D)(null,["start-sample"]),method:"POST"}).then((function(e){y(e.id)})).catch(w),(0,u/* .logEvent */.K)("setup_wizard_ready_install_course")},n,m]};
/***/},
/***/5686:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */S:()=>/* binding */c
/* harmony export */});
/* harmony import */var r=n(9307),s=n(5736),i=n(5258),a=n(1808),o=n(1689),u=n(3467),__=s.__,c=[{key:"welcome",container:(0,r.createElement)(i/* .Welcome */.c,null),label:__("Welcome","sensei-lms")},{key:"purpose",container:(0,r.createElement)(a/* .Purpose */.a,null),label:__("Purpose","sensei-lms")},{key:"features",container:(0,r.createElement)(o/* ["default"] */.Z,null),label:__("Features","sensei-lms")},{key:"ready",container:(0,r.createElement)(u/* .Ready */.J,null),label:__("Ready","sensei-lms")}];
/* harmony import */}
/***/,
/***/5258:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */c:()=>/* binding */m
/* harmony export */});
/* harmony import */var r=n(6886),s=n(9307),i=n(5736),a=n(5609),o=n(4636),u=n(9400),c=n(7552),l=n(3011),__=i.__,m=function(){var e=(0,s.useState)(!1),t=(0,r/* ["default"] */.Z)(e,2),n=t[0],i=t[1],m=(0,u/* .useQueryStringRouter */.Nt)().goTo,p=(0,c/* .useSetupWizardStep */.m)("welcome"),d=p.stepData,f=p.submitStep,v=p.isSubmitting,y=p.errorNotice,_=function(){i(!1),m("purpose")};return(0,s.createElement)(s.Fragment,null,(0,s.createElement)("div",{className:"sensei-setup-wizard__title"},(0,s.createElement)(l.H,null," ",__("Welcome to Sensei LMS!","sensei-lms")," ")),(0,s.createElement)(a.Card,{className:"sensei-setup-wizard__card",elevation:2},(0,s.createElement)(a.CardBody,null,(0,s.createElement)("p",null,__("Thank you for choosing Sensei LMS!","sensei-lms")),(0,s.createElement)("p",null,__("This setup wizard will help you get started creating online courses more quickly. It is optional and should take only a few minutes.","sensei-lms")),(0,s.createElement)(a.Button,{isPrimary:!0,className:"sensei-setup-wizard__button sensei-setup-wizard__button-card",onClick:function(){return i(!0)}},__("Continue","sensei-lms")))),(0,s.createElement)("div",{className:"sensei-setup-wizard__bottom-actions"},(0,s.createElement)("a",{href:"edit.php?post_type=course",type:"wp-admin",className:"link__color-secondary"},__("Not right now","sensei-lms"))),n&&(0,s.createElement)(o/* .UsageModal */.w,{tracking:d.usage_tracking,isSubmitting:v,onClose:function(){return i(!1)},onContinue:function(e){f({usage_tracking:e},{onSuccess:_})}},y))};
/* harmony import */}
/***/,
/***/4636:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */w:()=>/* binding */u
/* harmony export */});
/* harmony import */var r=n(6886),s=n(9307),i=n(9219),a=n(5609),o=n(5736),__=o.__,u=function(e){var t=e.tracking,n=e.onContinue,o=e.onClose,u=e.isSubmitting,c=e.children,l=(0,i/* ["default"] */.Z)({mixedString:__("Get improved features and faster fixes by sharing non-sensitive data via {{link}}usage tracking{{/link}} that shows us how Sensei LMS is used. No personal data is tracked or stored.","sensei-lms"),components:{
/* eslint-disable jsx-a11y/anchor-has-content */
link:(0,s.createElement)("a",{href:"https://senseilms.com/documentation/what-data-does-sensei-track/",className:"link__color-secondary",target:"_blank",rel:"noreferrer",type:"external"})
/* eslint-enable jsx-a11y/anchor-has-content */}}),m=(0,s.useState)(!1),p=(0,r/* ["default"] */.Z)(m,2),d=p[0],f=p[1];return(0,s.useEffect)((function(){return f(t)}),[t]),(0,s.createElement)(a.Modal,{title:__("Build a Better Sensei LMS","sensei-lms"),onRequestClose:o,className:"sensei-setup-wizard__usage-modal"},(0,s.createElement)("div",{className:"sensei-setup-wizard__usage-wrapper"},(0,s.createElement)("div",{className:"sensei-setup-wizard__usage-modal-message"},l),(0,s.createElement)("div",{className:"sensei-setup-wizard__tracking"},(0,s.createElement)(a.CheckboxControl,{className:"sensei-setup-wizard__tracking-checkbox",checked:d,label:__("Yes, count me in!","sensei-lms"),onChange:function(){return f(!d)}})),c,(0,s.createElement)(a.Button,{className:"sensei-setup-wizard__button sensei-setup-wizard__button-modal",isPrimary:!0,isBusy:u,disabled:u,onClick:function(){return n(d)}},__("Continue","sensei-lms"))))};
/* harmony import */}
/***/,
/***/4500:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>o
/* harmony export */});
/* harmony import */var r=n(9307),s=n(42),i=n.n(s),a=n(9666);
/* harmony import */
/* harmony default export */const o=
/**
 * List component from `@woocommerce/components`.
 */
/**
 * External dependencies
 */
/**
 * Internal dependencies
 */
/**
 * List component to display a list of items.
 *
 * @param {Object} props props for list
 */
function(e){var t=e.className,n=e.items,s=e.children,o=i()("sensei-list",t);return(0,r.createElement)("ul",{className:o,role:"menu"},n.map((function(e,t){var n=e.className,o=e.href,u=e.key,c="function"==typeof e.onClick||o,l=i()("sensei-list__item",n,{"has-action":c});return(0,r.createElement)("li",{key:u||t,className:l},s?s(e,t):(0,r.createElement)(a/* ["default"] */.Z,{item:e}))})))};
/***/},
/***/9666:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>a
/* harmony export */});
/* harmony import */var r=n(9307),s=n(9630);
/* harmony import */function i(e){var t=e.href,n=e.linkType;return n||(t?"external":null)}
/**
 * List component to display a list of items.
 *
 * @param {Object} props props for list item
 */
/* harmony default export */const a=function(e){var t=e.item,n=t.before,a=t.title,o=t.after,u=t.content,c=t.onClick,l=t.href,m=t.target,p=t.listItemTag,d="function"==typeof c||l,f=l?"a":"div",v={className:"sensei-list__item-inner",onClick:"function"==typeof c?c:null,"aria-disabled":d?"false":null,tabIndex:d?"0":null,role:d?"menuitem":null,onKeyDown:function(e){return d?
/**
 * WordPress dependencies
 */
function(e,t){"function"==typeof t&&e.keyCode===s.ENTER&&t()}(e,c):null},target:l?m:null,type:i(t),href:l,"data-list-item-tag":p};return(0,r.createElement)(f,v,n&&(0,r.createElement)("div",{className:"sensei-list__item-before"},n),(0,r.createElement)("div",{className:"sensei-list__item-text"},(0,r.createElement)("span",{className:"sensei-list__item-title"},a),u&&(0,r.createElement)("span",{className:"sensei-list__item-content"},u)),o&&(0,r.createElement)("div",{className:"sensei-list__item-after"},o))};
/***/},
/***/3011:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */H:()=>/* binding */o
/* harmony export */,$:()=>/* binding */u
/* harmony export */});
/* harmony import */var r=n(3782),s=n(9307),i=["component","children"],a=(0,s.createContext)(2);
/* harmony import */
/**
 * These components are used to frame out the page content for accessible heading hierarchy. Instead of defining fixed heading levels
 * (`h2`, `h3`, …) you can use `<H />` to create "section headings", which look to the parent `<Section />`s for the appropriate
 * heading level.
 *
 * @param {Object} props -
 * @return {Object} -
 */
function o(e){return(0,s.createElement)(a.Consumer,null,(function(t){var n="h"+Math.min(t,6);return(0,s.createElement)(n,e)}))}
/**
 * The section wrapper, used to indicate a sub-section (and change the header level context).
 *
 * @param {Object} props
 * @param {string} props.component
 * @param {Node}   props.children
 * @return {Object} -
 */function u(e){var t=e.component,n=e.children,o=(0,r/* ["default"] */.Z)(e,i),u=t||"div";return(0,s.createElement)(a.Consumer,null,(function(e){return(0,s.createElement)(a.Provider,{value:e+1},!1===t?n:(0,s.createElement)(u,o,n))}))}
/***/},
/***/5983:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>s
/* harmony export */});
/* harmony import */var r=n(9307);
/* harmony import */
/* harmony default export */const s=function(){return(0,r.createElement)("svg",{role:"img","aria-hidden":"true",focusable:"false",width:"18",height:"18",viewBox:"0 0 18 18",fill:"none",xmlns:"http://www.w3.org/2000/svg"},(0,r.createElement)("mask",{id:"mask0","mask-type":"alpha",maskUnits:"userSpaceOnUse",x:"2",y:"3",width:"14",height:"12"},(0,r.createElement)("path",{d:"M6.59631 11.9062L3.46881 8.77875L2.40381 9.83625L6.59631 14.0287L15.5963 5.02875L14.5388 3.97125L6.59631 11.9062Z",fill:"white"})),(0,r.createElement)("g",{mask:"url(#mask0)"},(0,r.createElement)("rect",{width:"18",height:"18",fill:"white"})))};
/***/},
/***/306:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>p
/* harmony export */});
/* harmony import */var r=n(2951),s=n(1976),i=n(7591),a=n(4337),o=n(9307),u=n(5609),c=n(42),l=n.n(c),m=n(5983);
/* harmony import */
/* harmony default export */const p=function(e){(0,i/* ["default"] */.Z)(n,e);var t=(0,a/* ["default"] */.Z)(n);function n(){return(0,r/* ["default"] */.Z)(this,n),t.apply(this,arguments)}return(0,s/* ["default"] */.Z)(n,[{key:"renderCurrentStepContent",value:function(){var e=this.props,t=e.currentStep,n=e.steps.find((function(e){return t===e.key}));return n.content?(0,o.createElement)("div",{className:"sensei-stepper_content"},n.content):null}},{key:"render",value:function(){var e=this.props,t=e.className,n=e.currentStep,r=e.steps,s=e.isPending,i=r.findIndex((function(e){return n===e.key})),a=l()("sensei-stepper",t);return(0,o.createElement)("div",{className:a},(0,o.createElement)("div",{className:"sensei-stepper__steps"},r.map((function(e,t){var r=e.key,a=e.label,c=e.description,p=e.isComplete,d=e.onClick,f=r===n,v=l()("sensei-stepper__step",{"is-active":f,"is-complete":void 0!==p?p:i>t}),y=f&&s?(0,o.createElement)(u.Spinner,null):(0,o.createElement)("div",{className:"sensei-stepper__step-icon"},(0,o.createElement)("span",{className:"sensei-stepper__step-number"},t+1),(0,o.createElement)(m/* ["default"] */.Z,null)),_="function"==typeof d?"button":"div";return(0,o.createElement)(o.Fragment,{key:r},(0,o.createElement)("div",{className:v},(0,o.createElement)(_,{className:"sensei-stepper__step-label-wrapper",onClick:"function"==typeof d?function(){return d(r)}:null},y,(0,o.createElement)("div",{className:"sensei-stepper__step-text"},(0,o.createElement)("span",{className:"sensei-stepper__step-label"},a),c&&(0,o.createElement)("span",{className:"sensei-stepper__step-description"},c)))),(0,o.createElement)("div",{className:"sensei-stepper__step-divider"}))}))),this.renderCurrentStepContent())}}]),n}(o.Component);
/***/},
/***/6400:
/***/(e,t,n)=>{"use strict";
/* unused harmony export preloadedDataUsedOnceMiddleware */
/* harmony import */var r,s=n(6483),i=n(6989);
/* harmony import */n.n(i)().use((r={},function(e,t){return"string"!=typeof e.path||"GET"!==e.method&&e.method||(r[e.path]?e.path=(0,s.addQueryArgs)(e.path,{__skip_preload:1}):r[e.path]=!0),t(e)}))}
/***/,
/***/2866:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */U:()=>/* binding */o
/* harmony export */});
/* unused harmony export formattingComponents */
/* harmony import */var r=n(189),s=n(9307),i=n(9219),a={em:(0,s.createElement)("em",null),strong:(0,s.createElement)("strong",null),code:(0,s.createElement)("code",null),small:(0,s.createElement)("small",null),sub:(0,s.createElement)("sub",null),sup:(0,s.createElement)("sup",null),br:(0,s.createElement)("br",null),p:(0,s.createElement)("p",null),del:(0,s.createElement)("del",null)},o=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return(0,i/* ["default"] */.Z)({mixedString:e,components:(0,r/* ["default"] */.Z)((0,r/* ["default"] */.Z)({},a),t)})};
/* harmony import */}
/***/,
/***/7959:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */K:()=>/* binding */r
/* harmony export */,B:()=>/* binding */s
/* harmony export */});
/**
 * Send log event.
 *
 * @param {string} eventName  Event name.
 * @param {Array}  properties Event properties.
 */
var r=function(e,t){window.sensei_log_event(e,t)};
/**
 * Enable or disable event logging.
 *
 * @param {boolean} enabled Enabled state.
 */r.enable=function(e){window.sensei_event_logging.enabled=e};
/**
 * Send log event when link is opened.
 *
 * @param {string} eventName  Event name.
 * @param {Array}  properties Event properties.
 * @return {Object} Element attributes.
 */
var s=function(e,t){return{onClick:function(){return r(e,t)},onAuxClick:function(n){return function(e){return 1===e.button}(n)&&r(e,t)}}};
/***/},
/***/4735:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */x:()=>/* binding */i
/* harmony export */,s:()=>/* binding */a
/* harmony export */});
/* harmony import */var r=n(189),s=n(6483),i=function(e,t){return(0,s.addQueryArgs)("https://woocommerce.com/cart",(0,r/* ["default"] */.Z)({"wccom-replace-with":e.map(a).join(",")},t||{}))},a=function(e){return e.wccom_product_id};
/* harmony import */}
/***/,
/***/9400:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */ZP:()=>c
/* harmony export */,AW:()=>/* reexport safe */o.Z
/* harmony export */,Nt:()=>/* binding */l
/* harmony export */});
/* harmony import */var r=n(6886),s=n(9307),i=n(7451),a=n(4557),o=n(519),u=(0,s.createContext)();
/* harmony import */
/* harmony default export */const c=function(e){var t=e.paramName,n=e.defaultRoute,o=e.children,c=(0,s.useState)((0,a/* .getParam */.j)(t)),l=(0,r/* ["default"] */.Z)(c,2),m=l[0],p=l[1],d=(0,s.useMemo)((function(){
/**
     * Functions that send the user to another route.
     * It changes the URL and update the state of the current route.
     *
     * @param {string}  newRoute New route to send the user.
     * @param {boolean} replace  Flag to mark if should replace or push state.
     */
var e=function(e){var n=arguments.length>1&&void 0!==arguments[1]&&arguments[1];(0,a/* .updateQueryString */.b)(t,e,n),p(e)};return m||e(n,!0),{currentRoute:m,goTo:e}}),[m,t,n]);
// Current route.
// Handle history changes through popstate.
return(0,i/* .useEventListener */.O)("popstate",(function(){p((0,a/* .getParam */.j)(t))}),[t]),(0,s.createElement)(u.Provider,{value:d},o)};
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
 */var l=function(){return(0,s.useContext)(u)};
/***/},
/***/519:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>s
/* harmony export */});
/* harmony import */var r=n(9400);
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
/* harmony default export */const s=function(e){var t=e.route,n=e.children;return(0,r/* .useQueryStringRouter */.Nt)().currentRoute===t?n:null};
/***/},
/***/4557:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */j:()=>/* binding */r
/* harmony export */,b:()=>/* binding */s
/* harmony export */});
/**
 * Get parameter from URL.
 *
 * @param {string} name Name of the param to get.
 *
 * @return {string|null} The value in the param. If it's empty, return null.
 */
var r=function(e){return new URLSearchParams(window.location.search).get(e)||null},s=function(e,t){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=window.location.search,s=n?"replaceState":"pushState",i=new URLSearchParams(r);null===t?i.delete(e):i.set(e,t),window.history[s]({},"","?".concat(i.toString()))};
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
/***/9307:
/***/e=>{"use strict";e.exports=window.wp.element}
/***/,
/***/5736:
/***/e=>{"use strict";e.exports=window.wp.i18n}
/***/,
/***/9630:
/***/e=>{"use strict";e.exports=window.wp.keycodes}
/***/,
/***/6483:
/***/e=>{"use strict";e.exports=window.wp.url}
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
/***/7169:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/2951:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/1976:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function s(e,t,n){return t&&r(e.prototype,t),n&&r(e,n),Object.defineProperty(e,"prototype",{writable:!1}),e}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */})},
/***/4337:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */a
/* harmony export */});
/* harmony import */var r=n(7597),s=n(8119),i=n(9492);
/* harmony import */function a(e){var t=(0,s/* ["default"] */.Z)();return function(){var n,s=(0,r/* ["default"] */.Z)(e);if(t){var a=(0,r/* ["default"] */.Z)(this).constructor;n=Reflect.construct(s,arguments,a)}else n=s.apply(this,arguments);return(0,i/* ["default"] */.Z)(this,n)}}
/***/},
/***/4649:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/5773:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(){return r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},r.apply(this,arguments)}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/7597:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e){return r=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)},r(e)}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/7591:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */});
/* harmony import */var r=n(6983);function s(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),Object.defineProperty(e,"prototype",{writable:!1}),t&&(0,r/* ["default"] */.Z)(e,t)}
/***/},
/***/8119:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}
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
/* harmony export */function r(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var r,s,i=[],_n=!0,a=!1;try{for(n=n.call(e);!(_n=(r=n.next()).done)&&(i.push(r.value),!t||i.length!==t);_n=!0);}catch(e){a=!0,s=e}finally{try{_n||null==n.return||n.return()}finally{if(a)throw s}}return i}}
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
/***/189:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */i
/* harmony export */});
/* harmony import */var r=n(4649);function s(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?s(Object(n),!0).forEach((function(t){(0,r/* ["default"] */.Z)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}
/***/},
/***/3782:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */s
/* harmony export */});
/* harmony import */var r=n(808);function s(e,t){if(null==e)return{};var n,s,i=(0,r/* ["default"] */.Z)(e,t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);for(s=0;s<a.length;s++)n=a[s],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(i[n]=e[n])}return i}
/***/},
/***/808:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e,t){if(null==e)return{};var n,r,s={},i=Object.keys(e);for(r=0;r<i.length;r++)n=i[r],t.indexOf(n)>=0||(s[n]=e[n]);return s}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/9492:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */i
/* harmony export */});
/* harmony import */var r=n(3940),s=n(7169);
/* harmony import */function i(e,t){if(t&&("object"===(0,r/* ["default"] */.Z)(t)||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return(0,s/* ["default"] */.Z)(e)}
/***/},
/***/6983:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e,t){return r=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},r(e,t)}
/***/n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
/***/6886:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */o
/* harmony export */});
/* harmony import */var r=n(6470),s=n(2446),i=n(4013),a=n(3764);
/* harmony import */function o(e,t){return(0,r/* ["default"] */.Z)(e)||(0,s/* ["default"] */.Z)(e,t)||(0,i/* ["default"] */.Z)(e,t)||(0,a/* ["default"] */.Z)()}
/***/},
/***/228:
/***/(e,t,n)=>{"use strict";
/* harmony export */n.d(t,{
/* harmony export */Z:()=>/* binding */o
/* harmony export */});
/* harmony import */var r=n(8138),s=n(5181),i=n(4013),a=n(3314);
/* harmony import */function o(e){return(0,r/* ["default"] */.Z)(e)||(0,s/* ["default"] */.Z)(e)||(0,i/* ["default"] */.Z)(e)||(0,a/* ["default"] */.Z)()}
/***/},
/***/3940:
/***/(e,t,n)=>{"use strict";
/* harmony export */function r(e){return r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},r(e)
/***/}n.d(t,{
/* harmony export */Z:()=>/* binding */r
/* harmony export */})},
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
/******/var i=t[r]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return e[r](i,i.exports,n),i.exports;
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
/******/ // define __esModule on exports
/******/n.r=e=>{
/******/"undefined"!=typeof Symbol&&Symbol.toStringTag&&
/******/Object.defineProperty(e,Symbol.toStringTag,{value:"Module"})
/******/,Object.defineProperty(e,"__esModule",{value:!0})}
/******/,
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(()=>{"use strict";
/* harmony import */var e=n(9307),t=n(9818),r=n(5609),s=n(5736),i=n(9373),a=(n(6400),n(7690)),o=n(7451),u=n(9400),c=n(8437),__=s.__;
/* harmony import */
/**
 * Register setup wizard store.
 */
(0,a/* ["default"] */.Z)();(0,e.render)((0,e.createElement)((function(){(0,o/* .useWpAdminFullscreen */.A)(["sensei-setup-wizard__page"]),(0,i/* .useSenseiColorTheme */.I)();var n=(0,t.useSelect)((function(e){var t=e("sensei/setup-wizard");return{isFetching:t.isFetching(),error:t.getFetchError(),navigationSteps:t.getNavigationSteps()}}),[]),s=n.isFetching,a=n.error,l=n.navigationSteps,m=(0,t.useDispatch)("sensei/setup-wizard").fetchSetupWizardData;// We want to show the loading before any content.
return(0,e.useLayoutEffect)((function(){m()}),[m]),s?(0,e.createElement)(r.Spinner,{className:"sensei-setup-wizard__main-loader"}):a?(0,e.createElement)(r.Notice,{status:"error",isDismissible:!1},__("An error has occurred while fetching the data. Please try again later!","sensei-lms"),(0,e.createElement)("br",null),__("Error details:","sensei-lms")," ",a.message):(0,e.createElement)(u/* ["default"] */.ZP,{paramName:"step",defaultRoute:l.find((function(e){return e.isNext})).key},(0,e.createElement)("div",{className:"sensei-setup-wizard__header"},(0,e.createElement)(c/* ["default"] */.Z,{steps:l})),(0,e.createElement)("div",{className:"sensei-setup-wizard__container"},l.map((function(t){return(0,e.createElement)(u/* .Route */.AW,{key:t.key,route:t.key},t.container)}))))}),null),document.getElementById("sensei-setup-wizard-page"))})()})
/******/();