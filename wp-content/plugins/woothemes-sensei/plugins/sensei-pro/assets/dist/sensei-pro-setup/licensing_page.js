!function(){var e={4184:function(e,t){var n;!function(){"use strict";var i={}.hasOwnProperty;function s(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var r=typeof n;if("string"===r||"number"===r)e.push(n);else if(Array.isArray(n)){if(n.length){var l=s.apply(null,n);l&&e.push(l)}}else if("object"===r)if(n.toString===Object.prototype.toString)for(var a in n)i.call(n,a)&&n[a]&&e.push(a);else e.push(n.toString())}}return e.join(" ")}e.exports?(s.default=s,e.exports=s):void 0===(n=function(){return s}.apply(t,[]))||(e.exports=n)}()}},t={};function n(i){var s=t[i];if(void 0!==s)return s.exports;var r=t[i]={exports:{}};return e[i](r,r.exports,n),r.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var i in t)n.o(t,i)&&!n.o(e,i)&&Object.defineProperty(e,i,{enumerable:!0,get:t[i]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){"use strict";var e={};n.r(e),n.d(e,{activateLicense:function(){return E},activateLicenseFail:function(){return S},activateLicenseStart:function(){return w},activateLicenseSuccess:function(){return N},fetchFromApi:function(){return y},installSenseiCore:function(){return A},installSenseiCoreFail:function(){return I},installSenseiCoreStart:function(){return b},installSenseiCoreSuccess:function(){return P}});var t={};n.r(t),n.d(t,{getLicenseActivate:function(){return L},getSenseiInstall:function(){return k},isLicenseActivated:function(){return x}});var i=window.wp.element,s=window.wp.data,r=window.wp.components,l=window.wp.i18n;const a="sensei-pro/setup",o="FETCH_FROM_API",c="ACTIVATE_LICENSE_START",C="ACTIVATE_LICENSE_FAIL",u="ACTIVATE_LICENSE_SUCCESS",p="INSTALL_SENSEI_CORE_START",d="INSTALL_SENSEI_CORE_FAIL",v="INSTALL_SENSEI_CORE_SUCCESS",m=(0,l.__)("Something went wrong. Please try again.","sensei-pro"),_=(0,l.__)("License activation failed. Please try again.","sensei-pro"),f=window.senseiProSetup||{},h={licenseActivate:{activated:f.licenseActivated||!1,licenseKey:f.licenseKey||"",licenseDomain:f.licenseDomain||"",inProgress:!1,error:""},senseiInstall:{installed:f.senseiInstalled||!1,activated:f.senseiActivated||!1,activateUrl:f.senseiActivateUrl||"",inProgress:!1,error:""}},g={[c]:e=>({...e,licenseActivate:{...e.licenseActivate,inProgress:!0,error:""}}),[C]:(e,t)=>{let{error:n}=t;return{...e,licenseActivate:{...e.licenseActivate,inProgress:!1,error:n||_}}},[u]:(e,t)=>{let{licenseKey:n}=t;return{...e,licenseActivate:{...e.licenseActivate,inProgress:!1,activated:!0,licenseKey:n||""}}},[p]:e=>({...e,senseiInstall:{...e.senseiInstall,inProgress:!0,error:""}}),[d]:(e,t)=>{let{error:n="",installed:i=!1}=t;return{...e,senseiInstall:{...e.senseiInstall,inProgress:!1,error:n||m,installed:i}}},[v]:(e,t)=>{let{activateUrl:n}=t;return{...e,senseiInstall:{...e.senseiInstall,inProgress:!1,installed:!0,activateUrl:n||""}}}},y=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return{type:o,...e}};function*E(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};yield w(e);const t=(null==e?void 0:e.licenseKey)||"";try{var n;const i=yield y({request:{path:"/activate-license",method:"POST",data:{license_key:(null==e?void 0:e.licenseKey)||"",plugin_slug:(null===(n=window.senseiProSetup)||void 0===n?void 0:n.plugin_slug)||""}}});!0===(null==i?void 0:i.success)?yield N({licenseKey:t}):yield S({error:i.message})}catch(e){yield S()}}const w=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return{type:c,...e}},S=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return{type:C,...e}},N=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return{type:u,...e}};function*A(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};yield b(e);try{const e=yield y({request:{path:"/install-sensei",method:"POST"}});if(!0===(null==e?void 0:e.success))if(e.activate_sensei_url)try{window.location=e.activate_sensei_url}catch{yield P({activateUrl:e.activate_sensei_url})}else yield P();else yield I({error:e.message||""})}catch(e){yield I()}}const b=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return{type:p,...e}},I=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return{type:d,...e}},P=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return{type:v,...e}},L=e=>e.licenseActivate,x=e=>e.licenseActivate.activated,k=e=>e.senseiInstall;var T=window.wp.apiFetch,O=n.n(T),M={[o]:e=>{let{request:t}=e;return O()({...t,path:`/sensei-pro-internal/v1/sensei-pro-setup${t.path}`})}};const j=(0,s.createReduxStore)(a,{reducer:function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:h,t=arguments.length>1?arguments[1]:void 0;return"function"==typeof g[t.type]?g[t.type](e,t):e},actions:e,selectors:t,controls:M,initialState:h});(0,s.register)(j);const B=()=>(0,i.createElement)("svg",{width:"35",height:"35",viewBox:"0 0 35 35",fill:"none",xmlns:"http://www.w3.org/2000/svg"},(0,i.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M11.8836 27.5187C12.6203 26.9095 12.3221 26.2631 13.3568 26.0256C13.3105 26.5408 13.7158 27.0633 13.9747 27.5187C13.7068 26.5449 13.9689 26.0985 14.1696 25.61C15.0241 23.5285 12.5434 22.1813 10.8522 21.8519C11.4299 21.4155 11.8333 20.9843 12.5587 20.9097C11.6521 20.896 10.7587 21.1061 9.9577 21.52C7.22603 22.9286 5.06066 20.1317 6.49273 17.597C7.25642 16.2419 8.12621 16.2199 8.90776 15.3028C9.09527 15.7734 9.15935 16.2887 9.09107 16.7976C9.3353 16.2377 9.37522 15.6153 9.21029 15.0365C8.95556 14.1462 8.22601 14.1405 8.0905 12.8599C8.06213 12.5921 7.83155 13.0102 7.44446 12.6562C7.35202 12.5711 7.16608 12.4193 7.04423 12.4881C6.83413 12.6042 6.6004 12.5091 6.47382 12.5758C6.26846 12.6861 6.20595 12.4566 5.98115 12.6189C5.5867 12.903 5.54468 12.5847 5.16546 12.6336C4.69065 12.6945 4.37919 13.3258 4.10817 13.0133C3.85973 12.7292 3.60342 13.2145 3.42326 13.2145C3.29784 13.2145 2.65595 14.0542 2.37385 13.2875C2.16218 12.7145 1.68736 13.8337 1.4342 13.454C1.35384 13.3332 1.13324 13.7397 0.991954 13.3379C0.959389 13.2455 0.995105 13.131 0.728286 13.2649C0.199901 13.5286 0.387409 13.1058 0.219334 12.8836C0.0139678 12.611 -0.0590398 12.611 0.0512594 12.1687C0.138974 11.8174 0.00503877 11.2932 0.542353 11.2039C0.679439 11.1813 0.806021 11.1902 0.995105 10.811C1.23041 10.3362 1.56393 10.5636 1.50406 10.3477C1.41634 10.0321 1.85544 9.60612 2.05923 9.40548C2.33025 9.13446 2.68478 8.73843 2.81084 8.35711C2.83343 8.29146 2.95528 8.10237 3.06243 7.98209C3.26202 7.76044 3.32137 7.97474 3.62075 7.86444C3.83662 7.78408 3.66855 8.0031 3.88127 7.67956C3.94955 7.57661 4.13758 7.67378 4.34715 7.57556C4.98295 7.27758 5.04215 7.28255 5.20013 6.59022C5.23007 6.45944 5.26106 6.35807 5.39499 6.3712C5.66444 6.39799 5.72537 6.23411 5.89081 6.23727C6.0384 6.24147 6.09198 6.15848 6.17076 6.05869C6.61143 5.48408 6.85252 5.91267 7.0479 5.86803C7.19812 5.83389 7.10306 5.48986 7.50066 5.597C8.06791 5.7488 7.88199 5.46149 8.2465 5.55551C8.67404 5.66581 8.70346 6.05869 8.99706 6.1527C9.35002 6.26458 9.51652 6.67846 9.75183 6.67373C10.5796 6.66008 10.3296 7.28248 10.8522 7.52829C10.4593 7.10233 10.8821 6.41323 9.98869 6.32394C9.7891 6.30451 9.71925 5.98727 9.42301 5.83863C9.06428 5.66005 9.10157 5.2803 8.45501 5.12378C8.62046 5.01348 8.67245 5.13586 8.77382 4.92892C8.91669 4.63689 8.99705 4.80707 9.0522 4.62796C9.10262 4.46146 9.06586 4.36743 9.45715 4.21721C9.86369 4.06069 10.255 3.70038 10.6169 3.71982C10.9367 3.7361 11.0712 3.5071 11.0518 3.21822C11.0323 2.91884 10.9714 2.5081 11.598 2.63468C11.9746 2.70927 11.9672 2.64046 11.9657 2.36839C11.9625 2.09579 12.0639 1.93087 12.3932 1.94243C12.6343 1.94978 12.8712 1.93665 12.962 1.63254C13.0335 1.39145 13.471 1.33053 13.7047 1.23966C14.4836 0.937652 14.5918 1.37202 14.8035 0.98965C14.9763 0.678712 15.2831 0.147175 15.6297 0.525343C15.6996 0.601502 15.7636 0.657702 15.9974 0.376177C16.1938 0.142447 16.6613 -0.153785 16.8283 0.249595C16.8939 0.408741 17.04 0.571038 17.166 0.365672C17.1912 0.325229 17.2227 0.280584 17.2968 0.262726C17.4218 0.234363 17.4901 0.198647 17.5531 0.167659C18.0894 -0.101786 18.3231 -0.0839285 18.0773 0.499607C17.7264 1.33742 20.0233 -0.0110242 19.3846 0.898785C19.1493 1.23231 20.705 1.42139 20.9314 1.57319C21.0564 1.6567 21.0506 1.72813 21.286 1.77593C21.953 1.90671 21.9425 1.84421 21.9829 2.41934C22.0008 2.67985 22.2482 2.53384 22.2482 2.86579C22.2482 4.28391 23.4063 3.57004 23.5954 3.92308C23.6264 3.98243 23.6742 4.03496 23.7903 4.03496C24.1553 4.03496 24.1758 3.95775 24.3412 4.27026C24.4085 4.39684 24.4631 4.46092 24.6538 4.525C24.9468 4.62322 24.929 4.65894 24.8192 4.89109C24.6868 5.16631 24.8938 5.16211 25.1601 5.18732C25.4043 5.21253 25.522 5.35382 25.69 5.55341C25.9626 5.87643 26.387 5.96887 26.7473 6.15638C26.9527 6.26195 26.7505 6.52562 27.0971 6.80084C27.3535 7.00358 27.4827 6.97522 27.1386 7.23731C25.6863 8.34688 27.6779 8.04533 28.2343 9.07721C28.3593 9.30779 28.5247 9.59509 28.7642 9.86033C29.3178 10.4691 29.0085 10.6377 29.3079 11.0185C29.4807 11.2375 29.3451 11.185 29.6277 11.3819C30.2948 11.8462 29.3688 12.1546 28.8446 11.9445C28.6051 11.8494 28.4365 11.7181 28.4827 11.8762C28.52 12.0059 28.4559 12.0968 28.3546 12.195C28.0478 12.4928 28.6555 12.3767 28.8 12.3541C29.2438 12.2869 30.4303 12.1519 30.4214 12.6015C30.4093 13.1851 30.7565 13.3164 31.0364 13.3547C31.4907 13.4188 31.6199 13.5049 31.87 13.9519C32.0963 14.3553 32.2287 14.1394 32.5785 14.4966C32.818 14.7424 33.1132 15.1799 32.6279 15.244C32.5118 15.2587 32.3852 15.2456 32.3316 15.2886C32.1872 15.4005 32.0816 15.4346 31.9892 15.4641C31.2628 15.7036 32.3316 15.8244 32.5937 15.7634C32.8232 15.7114 33.1074 15.6327 33.329 15.6936C33.4703 15.7324 33.484 15.9037 33.9304 15.9767C34.0791 16.0019 34.0182 16.2372 33.9451 16.4011C33.6888 16.9683 34.4158 16.6674 34.3396 17.0965C34.2965 17.3449 34.6075 17.7457 34.1731 17.7546C34.0334 17.7578 33.8874 17.7157 33.8916 17.8439C33.9005 18.1238 33.485 17.7667 33.1127 18.1506C32.974 18.2935 32.6452 18.3933 32.4425 18.127C32.3652 18.0256 32.2712 17.9437 31.9093 18.0661C31.5538 18.1869 31.3121 18.605 31.1562 17.9589C31.1147 17.7893 31.0327 17.7861 30.8064 17.7026C30.4996 17.5881 30.5264 17.0177 30.0768 17.3854C29.9266 17.5062 29.7554 17.5429 29.55 17.4867C29.197 17.3901 28.8057 17.5182 28.7726 17.2336C28.7191 16.7588 28.302 16.4237 27.8451 16.4473C27.4832 16.4683 27.1633 16.5366 26.9727 16.0854C27.114 16.6022 27.4806 16.6364 27.9107 16.6364C28.2663 16.6364 28.4764 16.836 28.5389 17.2336C28.6492 17.9348 29.0405 17.4941 29.5363 17.8234C29.7806 17.9841 29.956 18.2446 30.0542 18.5472C30.1556 18.8597 30.9639 18.4847 30.7465 19.2321C30.654 19.5535 30.4829 19.6759 30.1509 19.9365C29.1657 20.7149 28.9216 19.9463 28.6308 20.5688C28.4806 20.8918 28.4759 20.6523 28.1497 20.8099C27.6092 21.0688 27.2636 20.469 26.8676 20.6891C26.4196 20.9391 26.4553 20.4764 26.0026 20.7873C25.6275 21.0447 25.2462 20.5924 25.0661 21.2963C24.9127 21.8976 24.2772 21.9113 23.9867 21.5883C23.5235 21.0746 23.6621 22.1944 23.0964 21.7327C22.7955 21.4901 22.5738 21.8446 22.1332 21.8519C21.3217 21.864 20.933 21.1045 20.537 21.5662C20.0648 22.114 19.7223 21.4827 19.715 20.9244C19.7076 20.354 17.8047 20.5446 16.8041 20.2468C16.2505 20.083 14.5115 20.2826 15.0772 19.3193C14.1643 20.354 16.1996 20.2899 16.7537 20.5252C17.0872 20.6649 17.3567 20.7784 17.6797 20.8272C17.9996 21.6119 18.2065 22.4617 18.238 23.498C18.3436 22.9292 18.3678 22.3488 18.3079 21.7768C18.2018 20.761 18.9014 22.2815 18.9854 22.499C19.4375 23.6932 18.9314 25.8852 17.7868 26.5433C17.4938 25.5937 17.0263 24.7029 16.4039 23.9198C17.0337 24.9577 17.9197 27.0791 17.2096 28.2924C16.6187 28.0497 16.136 27.5943 15.8592 27.0134C16.0467 27.8963 16.8719 28.8743 17.8677 28.5513C19.605 27.9867 19.5975 29.1683 21.9012 29.3648C23.5756 29.6594 25.9648 29.3648 27.1064 29.463C27.7289 29.5165 30.3483 29.9852 30.3368 30.6937C30.2906 33.6251 29.2606 33.78 26.5551 34.0568C24.9831 34.2177 23.7672 34.2825 22.0754 34.3504C18.2921 34.5022 13.741 34.5054 10.1111 34.3462C8.33174 34.2682 7.47545 34.2538 5.58618 33.9859C3.69691 33.718 2.66062 33.0226 2.69056 30.8371C2.70321 30.0311 4.91592 29.2622 5.63818 29.1742C6.49273 29.0701 7.85469 29.1878 9.09422 28.8665C10.3879 28.5298 10.9293 28.3079 11.8836 27.5187ZM25.0235 11.4749C24.6128 11.363 24.8985 11.1088 24.191 11.4376C23.774 11.6314 23.7146 11.0936 23.2934 11.1892C22.8706 11.2842 22.6978 10.8572 22.068 10.7485C21.2865 10.613 21.8506 10.3955 20.6121 10.6634C20.3736 10.7138 20.173 10.4239 19.4298 10.5263C18.5589 10.6471 18.8641 10.748 18.3368 10.2212C17.6681 9.55412 17.1382 10.0021 16.4517 9.7327C16.9817 10.1734 17.3556 9.78207 17.9807 10.3194C17.3866 10.6839 16.6944 12.4455 15.615 12.5558C16.7899 12.84 17.3583 13.4939 18.4366 13.6515C19.6766 13.8301 20.6042 13.9624 21.267 15.0586C22.0071 16.2855 22.3464 15.578 23.4153 15.504C24.0912 15.4578 24.1075 15.0139 24.2194 14.5438C24.3743 13.8947 24.5303 13.8647 24.9831 13.7786C25.5057 13.6788 25.3823 13.5328 25.2452 13.3647C24.8759 12.9093 25.2914 12.8169 25.6039 12.7187C26.1501 12.5474 25.7079 12.5191 25.7079 12.2764C25.0246 12.0395 25.5514 11.7034 25.9327 11.5542C26.3482 11.831 26.5283 11.7848 26.7116 11.748C26.9795 11.6913 27.1581 11.8268 27.3844 11.6719C27.0509 11.7107 26.9826 11.5752 26.7011 11.6183C26.5745 11.6377 26.4243 11.6467 26.1622 11.4781C25.7216 11.1923 25.4983 11.6031 25.0235 11.4749ZM19.4208 15.8212L16.7395 14.3768C13.5072 12.6362 12.035 15.2062 10.9971 18.0246L9.11523 19.9601C10.464 19.0651 11.5644 18.0676 12.9831 18.0766C13.2098 18.0777 16.7087 19.362 16.1455 17.8339C16.0441 17.5587 16.3645 17.6952 16.4522 17.3008C16.5504 16.8496 16.5862 16.9268 16.9318 17.2147C17.1492 17.3964 17.4496 17.514 17.3577 17.0865C17.3173 16.8958 17.2611 16.7246 18.0458 17.076C18.4166 17.2414 18.2795 16.9063 18.7916 16.8391C19.5033 16.7467 19.3515 16.0156 19.6866 15.9131C19.8726 15.8548 20.0601 16.0649 20.4104 15.7093C20.5322 15.5859 20.6798 15.4725 20.9824 15.556C20.631 15.3637 20.4419 15.5203 20.2633 15.6363C19.9035 15.8716 19.7633 15.5397 19.4208 15.8212ZM13.9406 10.7233C14.3334 10.6697 14.7268 10.6282 15.1244 10.6014C15.2016 10.5746 15.2673 10.5195 15.3062 10.4449C15.3435 10.3719 15.3492 10.2858 15.324 10.2065C15.3477 9.97588 15.4816 9.76999 15.6843 9.65706L15.6812 9.64971C15.0467 9.65286 14.5346 9.91338 13.887 10.2096C13.7572 10.269 13.8261 10.5043 13.5965 10.7737C13.5829 11.0668 13.3838 11.3189 13.1007 11.3961C13.0146 11.405 12.9342 11.4497 12.8801 11.518C12.825 11.5878 12.8029 11.6755 12.816 11.7622C12.6495 11.9602 12.3738 12.0274 12.1358 11.9261C11.6448 11.7207 11.2781 11.7517 11.0355 12.0211C11.3406 11.8394 11.7235 11.8546 12.0135 12.0584C12.3423 12.2328 12.7504 12.1404 12.9725 11.841C13.0035 11.6934 13.1301 11.5863 13.2809 11.5789C13.6291 11.4381 13.8481 11.1519 13.9406 10.7233Z",fill:"white"})),F=()=>{var e,t,n,r;const o=(0,s.useSelect)((e=>e(a).getLicenseActivate()),[]),c=(null===(e=window.senseiProSetup)||void 0===e?void 0:e.locales)||{},C=(null===(t=c.header)||void 0===t?void 0:t.title.not_activated)||(0,l.__)("Now let's activate the plugin","sensei-pro"),u=(null===(n=c.header)||void 0===n||null===(r=n.title)||void 0===r?void 0:r.activated)||(0,l.__)("The plugin is activated!","sensei-pro");return(0,i.createElement)("div",{className:"sensei-pro-setup-header"},(0,i.createElement)("div",{className:"sensei-pro-setup-header__content"},(0,i.createElement)("div",{className:"sensei-pro-setup-header__icon"},(0,i.createElement)(B,null)),(0,i.createElement)("h1",{className:"sensei-pro-setup-header__title"},o.activated?u:C)))};var R=window.React;function K(e){return e.startsWith("{{/")?{type:"componentClose",value:e.replace(/\W/g,"")}:e.endsWith("/}}")?{type:"componentSelfClosing",value:e.replace(/\W/g,"")}:e.startsWith("{{")?{type:"componentOpen",value:e.replace(/\W/g,"")}:{type:"string",value:e}}function H(e,t){let n,i,s=[];for(let r=0;r<e.length;r++){const l=e[r];if("string"!==l.type){if(void 0===t[l.value])throw new Error(`Invalid interpolation, missing component node: \`${l.value}\``);if("object"!=typeof t[l.value])throw new Error(`Invalid interpolation, component node must be a ReactElement or null: \`${l.value}\``);if("componentClose"===l.type)throw new Error(`Missing opening component token: \`${l.value}\``);if("componentOpen"===l.type){n=t[l.value],i=r;break}s.push(t[l.value])}else s.push(l.value)}if(n){const r=function(e,t){const n=t[e];let i=0;for(let s=e+1;s<t.length;s++){const e=t[s];if(e.value===n.value){if("componentOpen"===e.type){i++;continue}if("componentClose"===e.type){if(0===i)return s;i--}}}throw new Error("Missing closing component token `"+n.value+"`")}(i,e),l=H(e.slice(i+1,r),t),a=(0,R.cloneElement)(n,{},l);if(s.push(a),r<e.length-1){const n=H(e.slice(r+1),t);s=s.concat(n)}}return s=s.filter(Boolean),0===s.length?null:1===s.length?s[0]:(0,R.createElement)(R.Fragment,null,...s)}function U(e){const{mixedString:t,components:n,throwErrors:i}=e;if(!n)return t;if("object"!=typeof n){if(i)throw new Error(`Interpolation Error: unable to process \`${t}\` because components is not an object`);return t}const s=function(e){return e.split(/(\{\{\/?\s*\w+\s*\/?\}\})/g).map(K)}(t);try{return H(s,n)}catch(e){if(i)throw new Error(`Interpolation Error: unable to process \`${t}\` because of error \`${e.message}\``);return t}}function $(){return $=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var i in n)Object.prototype.hasOwnProperty.call(n,i)&&(e[i]=n[i])}return e},$.apply(this,arguments)}var z=n(4184),D=n.n(z);const V=e=>{let{inProgress:t=!1,className:n,...s}=e;return(0,i.createElement)(r.Animate,{type:t?"loading":""},(e=>{let{className:t}=e;return(0,i.createElement)(r.Button,$({className:D()(n,t)},s))}))},W=e=>{var t,n;let{inProgress:o,error:c}=e;const[C,u]=(0,i.useState)(""),{activateLicense:p}=(0,s.useDispatch)(a),d=(0,i.useCallback)((e=>{e.preventDefault(),p({licenseKey:C})}),[C,p]),v=(null===(t=(window.senseiProSetup.locales||{}).license_activation)||void 0===t||null===(n=t.title)||void 0===n?void 0:n.not_activated)||(0,l.__)("Activate the plugin","sensei-pro");return(0,i.createElement)(r.Card,{className:"sensei-pro-activate",as:"form",onSubmit:d},(0,i.createElement)(r.CardHeader,{isShady:!0},(0,i.createElement)("div",{className:"sensei-pro-activate__header"},(0,i.createElement)("h2",{className:"sensei-pro-activate__title"},v),(0,i.createElement)("p",{className:"sensei-pro-activate__title-note"},U({mixedString:(0,l.__)("You can find the key in by navigating to your purchases in your SenseiLMS.com {{link}}account{{/link}}.","sensei-pro"),components:{link:(0,i.createElement)(r.ExternalLink,{href:"https://senseilms.com/my-account"})}})))),(0,i.createElement)(r.CardBody,{className:"sensei-pro-activate__body"},(0,i.createElement)(r.TextControl,{className:"sensei-pro-activate__license-key",label:(0,l.__)("License key","sensei-pro"),required:!0,onChange:u,value:C,disabled:o})),(0,i.createElement)(r.CardFooter,null,(0,i.createElement)(V,{isPrimary:!0,type:"submit",disabled:o,inProgress:o},(0,l.__)("Activate","sensei-pro")),c&&(0,i.createElement)("p",{className:"sensei-pro-activate__fail"},c)))};var q=window.wp.primitives,Z=(0,i.createElement)(q.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,i.createElement)(q.Path,{d:"M18.3 5.6L9.9 16.9l-4.6-3.4-.9 1.2 5.8 4.3 9.3-12.6z"}));const G=e=>{var t,n;let{licenseKey:s}=e;const a=(null===(t=(window.senseiProSetup.locales||{}).license_activation)||void 0===t||null===(n=t.title)||void 0===n?void 0:n.activated)||(0,l.__)("The plugin is activated!","sensei-pro");return(0,i.createElement)(r.Card,{className:"sensei-pro-activate"},(0,i.createElement)(r.CardHeader,{isShady:!0},(0,i.createElement)("h2",{className:"sensei-pro-activate__title"},a),(0,i.createElement)(r.Icon,{className:"sensei-pro-activated__icon",icon:Z})),s&&(0,i.createElement)(r.CardBody,null,(0,i.createElement)("p",null,(0,i.createElement)("strong",null,(0,l.__)("License Key:","sensei-pro"))," ",s)))},Y=()=>{const e=(0,s.useSelect)((e=>e(a).getLicenseActivate()),[]);return e.activated?(0,i.createElement)(G,e):(0,i.createElement)(W,e)},J=e=>{let{activateUrl:t,activated:n}=e;return n?null:(0,i.createElement)(r.Card,{className:"sensei-pro-activate"},(0,i.createElement)(r.CardHeader,{isShady:!0},(0,i.createElement)("h2",{className:"sensei-pro-activate__title"},(0,l.__)("Sensei is installed!","sensei-pro")),(0,i.createElement)(r.Icon,{className:"sensei-pro-activated__icon",icon:Z})),!n&&t&&(0,i.createElement)(r.CardBody,null,(0,i.createElement)(r.Button,{href:t,isPrimary:!0},(0,l.__)("Activate Sensei","sensei-pro"))))};var Q=(0,i.createElement)(q.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"-2 -2 24 24"},(0,i.createElement)(q.Path,{d:"M10.2 3.28c3.53 0 6.43 2.61 6.92 6h2.08l-3.5 4-3.5-4h2.32c-.45-1.97-2.21-3.45-4.32-3.45-1.45 0-2.73.71-3.54 1.78L4.95 5.66C6.23 4.2 8.11 3.28 10.2 3.28zm-.4 13.44c-3.52 0-6.43-2.61-6.92-6H.8l3.5-4c1.17 1.33 2.33 2.67 3.5 4H5.48c.45 1.97 2.21 3.45 4.32 3.45 1.45 0 2.73-.71 3.54-1.78l1.71 1.95c-1.28 1.46-3.15 2.38-5.25 2.38z"})),X=(0,i.createElement)(q.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"-2 -2 24 24"},(0,i.createElement)(q.Path,{d:"M10 2c4.42 0 8 3.58 8 8s-3.58 8-8 8-8-3.58-8-8 3.58-8 8-8zm1.13 9.38l.35-6.46H8.52l.35 6.46h2.26zm-.09 3.36c.24-.23.37-.55.37-.96 0-.42-.12-.74-.36-.97s-.59-.35-1.06-.35-.82.12-1.07.35-.37.55-.37.97c0 .41.13.73.38.96.26.23.61.34 1.06.34s.8-.11 1.05-.34z"}));const ee=e=>{let{inProgress:t,error:n,className:o}=e;const{installSenseiCore:c}=(0,s.useDispatch)(a),C=(0,i.useCallback)((e=>{e.preventDefault(),c()}),[c]);return(0,i.createElement)(r.Card,{className:`${o} sensei-pro-install-sensei`,as:"form",onSubmit:C},(0,i.createElement)(r.CardHeader,{isShady:!0},(0,i.createElement)("div",{className:"sensei-pro-install-sensei__header"},(0,i.createElement)("h2",{className:"sensei-pro-install-sensei__title"},(0,i.createElement)(r.Icon,{icon:t?Q:X,className:D()({"sensei-pro-install-sensei__title-icon":!0,"sensei-pro-install-sensei__title-icon--warning":!t,"sensei-pro-install-sensei__title-icon--installing":t})}),(0,l.__)("Install Sensei","sensei-pro")),(0,i.createElement)("p",{className:"sensei-pro-install-sensei__title-note"},(0,l.__)("Looks like you don't have Sensei installed yet. Sensei Pro needs Sensei installed in order to be usable.","sensei-pro")))),(0,i.createElement)(r.CardBody,{className:"sensei-pro-install-sensei__body"},(0,i.createElement)(V,{isPrimary:!0,type:"submit",disabled:t,inProgress:t},(0,l.__)("Install Sensei","sensei-pro")),t&&(0,i.createElement)("p",{className:"sensei-pro-activate__note"},(0,l.__)("Installing… this may take a while.","sensei-pro")),n&&(0,i.createElement)("p",{className:"sensei-pro-activate__fail"},n===m?U({mixedString:(0,l.__)("Sensei LMS installation failed. You can try to {{link}}install it manually{{/link}}.","sensei-pro"),components:{link:(0,i.createElement)(r.ExternalLink,{className:"sensei-pro-install-sensei__fail-link",href:"https://senseilms.com/documentation/getting-started-with-sensei/"})}}):n)))},te=e=>{const t=(0,s.useSelect)((e=>e(a).getSenseiInstall()),[]);return t.installed?(0,i.createElement)(J,$({},e,t)):(0,i.createElement)(ee,$({},e,t))},ne=document.getElementById("sensei-pro-setup__container");(0,i.render)((0,i.createElement)((()=>{var e;const t=(0,s.useSelect)((e=>e(a).isLicenseActivated()),[]),n=(null===(e=window.senseiProSetup)||void 0===e?void 0:e.requires_sensei)||!1;return(0,i.createElement)(i.Fragment,null,(0,i.createElement)(F,null),(0,i.createElement)(Y,null),t&&n&&(0,i.createElement)(r.Animate,{type:"appear",options:{origin:"bottom left"}},(e=>{let{className:t}=e;return(0,i.createElement)(te,{className:t})})))}),null),ne)}()}();