!function(){var e={4184:function(e,t){var r;!function(){"use strict";var n={}.hasOwnProperty;function i(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var s=typeof r;if("string"===s||"number"===s)e.push(r);else if(Array.isArray(r)){if(r.length){var o=i.apply(null,r);o&&e.push(o)}}else if("object"===s)if(r.toString===Object.prototype.toString)for(var u in r)n.call(r,u)&&r[u]&&e.push(u);else e.push(r.toString())}}return e.join(" ")}e.exports?(i.default=i,e.exports=i):void 0===(r=function(){return i}.apply(t,[]))||(e.exports=r)}()}},t={};function r(n){var i=t[n];if(void 0!==i)return i.exports;var s=t[n]={exports:{}};return e[n](s,s.exports,r),s.exports}r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){"use strict";var e=window.wp.element,t=window.wp.domReady,n=r.n(t),i=window.ReactDOM;function s(){return s=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)Object.prototype.hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},s.apply(this,arguments)}var o=r(4184),u=r.n(o);const a=(0,e.forwardRef)(((t,r)=>{let{seconds:n,triggerOnRender:i,deadline:s,isCourseTheme:o,isSmall:a=!0,isSticky:c=!1,isHidden:l=!1,style:d={}}=t,m=144,f=6;a&&(m=81,f=4);const p=1e3*n,_=m/2,h=m*Math.PI,[w,v]=(0,e.useState)(s-Date.now()),[y,g]=(0,e.useState)(!1);(0,e.useEffect)((()=>{v(s-Date.now())}),[s]),(0,e.useEffect)((()=>{if(!i||w<=0)return;g(!0);const e=setTimeout((()=>{v(s-Date.now()),w<=0&&(clearTimeout(e),v(p))}),10)}),[w]);const S={height:m,width:m},q={color:"black",fontSize:.2*m,fontFamily:"sans-serif"};return(0,e.createElement)("div",{ref:r,className:u()({"sensei-lms-quiz-timer__countdown-circular":!0,"sensei-lms-quiz-timer__countdown-circular--sticky":c,"sensei-lms-quiz-timer__countdown-circular--hidden":l,"sensei-lms-quiz-timer-course-theme":o}),style:d},(0,e.createElement)("div",{className:"sensei-lms-quiz-timer__countdown-circular__circle-container",style:S},(0,e.createElement)("div",{style:q},(e=>{e<1&&(e=0);let t=Math.floor(e/1e3%60),r=Math.floor(e/6e4%60),n=Math.floor(e/36e5%24);return n=n<10?"0"+n:n,r=r<10?"0"+r:r,t=t<10?"0"+t:t,("00"===n?"":n+":")+r+":"+t})(w)),(0,e.createElement)("svg",null,(0,e.createElement)("circle",{style:{strokeDasharray:h,strokeDashoffset:y||!y&&w>0?h-w/p*h:h,r:_-f/2,cx:_,cy:_,strokeWidth:f}}))))})),c=t=>{let{time:r,isPreviewMode:n=!1,isCourseTheme:i,...o}=t;const[u,c]=(0,e.useState)(!1),[l,d]=(0,e.useState)(0),[m,f]=(0,e.useState)(!0),p=(0,e.useRef)(null),_=(0,e.useCallback)((()=>{var e;const t=document.querySelector("html");f(t&&t.clientWidth<=782);const r=null===(e=document)||void 0===e?void 0:e.querySelector("#wpadminbar");if(!r)return;if("fixed"!==getComputedStyle(r).getPropertyValue("position"))return void d(0);const{bottom:n}=(null==r?void 0:r.getBoundingClientRect())||{bottom:0};d(n)}),[d]),h=(0,e.useCallback)((()=>{if(!p.current)return;const{top:e,bottom:t}=p.current.getBoundingClientRect()||{};c(t-(t-e)/2<=l)}),[c,l]);return(0,e.useEffect)((()=>(document.addEventListener("scroll",h),window.addEventListener("resize",_),_(),()=>{document.removeEventListener("scroll",h),window.removeEventListener("resize",_)})),[h,_]),(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a,s({seconds:r,triggerOnRender:n,isHidden:u,isSmall:m,ref:p,isCourseTheme:i},o)),!i&&(0,e.createElement)(a,s({seconds:r,triggerOnRender:n,isSticky:!0,isHidden:!u,isSmall:m,style:{top:`${l+20}px`,right:"20px"}},o)))};n()((()=>{const t=parseInt(window.sensei_quiz_timer_params.time_left,10),r=()=>{const e=document.querySelector('button[name="quiz_complete"]');null==e||e.click()},n=document.getElementById("sensei-quiz-timer");if(window.sensei_quiz_timer_params.is_course_theme){const e=document.querySelector(".sensei-course-theme__quiz__header__right");e&&(n.remove(),e.append(n),e.classList.add("sensei-course-theme__quiz__header__right--with-timer"))}if(n){let s=0;t&&(s=1e3*t+Date.now(),setTimeout(r,1e3*t)),(0,i.render)((0,e.createElement)(c,{time:window.sensei_quiz_timer_params.time,deadline:s,isPreviewMode:!window.sensei_quiz_timer_params.is_not_started,isCourseTheme:window.sensei_quiz_timer_params.is_course_theme}),n)}}))}()}();