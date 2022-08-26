(()=>{"use strict";var e={n:t=>{var s=t&&t.__esModule?()=>t.default:()=>t;return e.d(s,{a:s}),s},d:(t,s)=>{for(var n in s)e.o(s,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:s[n]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.wp.plugins,s=window.wp.element,n=window.wp.editPost,a=window.wp.i18n,r=window.wp.components,o=window.wp.coreData,i=window.moment;var l=e.n(i);const c="expires-after",p="expires-on",_="starts-on",u=(0,a.__)("Set Course Expiration Date","sensei-pro"),m=(0,a.__)("Set Course Start Date","sensei-pro"),d=e=>l()(e).format(l().HTML5_FMT.DATE),w=e=>{const[t,s]=(0,o.useEntityProp)("postType","course","meta");return[t[e],t=>s({[e]:t})]};(0,t.registerPlugin)("sensei-pro-course-expiration-plugin",{render:()=>{const[e,t]=w("_course_expiration_type"),[o,i]=w("_course_start_type"),[l,x]=(0,s.useState)(!1),[v,h]=(0,s.useState)(!1),[E,b]=w("_course_expiration_length"),[g,y]=w("_course_expires_on_date"),[f,C]=w("_course_starts_on_date"),[S,D]=w("_course_expiration_period"),P=(0,s.createElement)(s.Fragment,null,(0,s.createElement)("div",{className:"sensei-wcpc-course-expiration__expires-after"},(0,s.createElement)(r.TextControl,{className:"sensei-wcpc-course-expiration__expiration-length",label:(0,a.__)("Expiration Length","sensei-pro"),hideLabelFromVision:!0,type:"number",step:1,min:1,value:E,onChange:e=>{const t=Math.max(1,parseInt(e.replace(/\D/g,"")||1,10));b(t)},onKeyPress:e=>{/\D/.test(e.key)&&e.preventDefault()}}),(0,s.createElement)(r.SelectControl,{label:(0,a.__)("Expiration Period","sensei-pro"),hideLabelFromVision:!0,value:S,options:[{label:(0,a.__)("Month(s)","sensei-pro"),value:"month"},{label:(0,a.__)("Week(s)","sensei-pro"),value:"week"},{label:(0,a.__)("Day(s)","sensei-pro"),value:"day"}],onChange:D})),"day"===S&&1===E&&(0,s.createElement)("small",{className:"sensei-wcpc-course-expiration__help-text"},(0,a.__)("The learner access will expire at midnight on the day of enrollment.","sensei-pro"))),N=(e,t,n,a,o)=>(0,s.createElement)("div",null,(0,s.createElement)(r.Button,{onClick:()=>{e(!0)},className:"datepicker","data-testid":"start-date-button"},n),a&&(0,s.createElement)(r.DatePicker,{currentDate:t,onChange:o}));return(0,s.createElement)(n.PluginDocumentSettingPanel,{name:"sensei-wcpc-course-access-period",title:(0,a.__)("Access Period","sensei-pro"),className:"sensei-wcpc-course-expiration"},(0,s.createElement)("p",{className:"sensei-wcpc-course-expiration__intro"},(0,a.__)("Set a timeframe that students will have access to this course.","sensei-pro")),(0,s.createElement)("div",{className:"access-period-starts"},(0,s.createElement)(r.SelectControl,{label:(0,a.__)("Course Access Starts","sensei-pro"),value:o,options:[{label:(0,a.__)("Immediately","sensei-pro"),value:"immediately"},{label:(0,a.__)("On a specific date","sensei-pro"),value:_}],onChange:i}),_===o&&N(h,f,f?(0,a.sprintf)(
/* translators: %s is replaced with start date string in format YYYY-MM-DD */
(0,a.__)("Starts on %s","sensei-pro"),d(f)):m,v,(e=>{C(e),h(!1)}))),(0,s.createElement)("div",{className:"access-period-expires"},(0,s.createElement)(r.SelectControl,{label:(0,a.__)("Course Access Ends","sensei-pro"),value:e,options:[{label:(0,a.__)("Never","sensei-pro"),value:"no-expiration"},{label:(0,a.__)("After a set period","sensei-pro"),value:c},{label:(0,a.__)("On a specific date","sensei-pro"),value:p}],onChange:t}),c===e&&P,p===e&&N(x,g,g?(0,a.sprintf)(
/* translators: %s is replaced with start date string in format YYYY-MM-DD */
(0,a.__)("Expires on %s","sensei-pro"),d(g)):u,l,(e=>{y(e),x(!1)}))))},icon:null})})();