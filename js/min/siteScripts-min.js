window.Modernizr=function(e,t,n){function r(e){g.cssText=e}function a(e,t){return r(b.join(e+";")+(t||""))}function i(e,t){return typeof e===t}function o(e,t){return!!~(""+e).indexOf(t)}function s(e,t){for(var r in e){var a=e[r];if(!o(a,"-")&&g[a]!==n)return"pfx"==t?a:!0}return!1}function l(e,t,r){for(var a in e){var o=t[e[a]];if(o!==n)return r===!1?e[a]:i(o,"function")?o.bind(r||t):o}return!1}function c(e,t,n){var r=e.charAt(0).toUpperCase()+e.slice(1),a=(e+" "+S.join(r+" ")+r).split(" ");return i(t,"string")||i(t,"undefined")?s(a,t):(a=(e+" "+C.join(r+" ")+r).split(" "),l(a,t,n))}function u(){m.input=function(n){for(var r=0,a=n.length;a>r;r++)M[n[r]]=n[r]in v;return M.list&&(M.list=!!t.createElement("datalist")&&!!e.HTMLDataListElement),M}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),m.inputtypes=function(e){for(var r=0,a,i,o,s=e.length;s>r;r++)v.setAttribute("type",i=e[r]),a="text"!==v.type,a&&(v.value=x,v.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(i)&&v.style.WebkitAppearance!==n?(f.appendChild(v),o=t.defaultView,a=o.getComputedStyle&&"textfield"!==o.getComputedStyle(v,null).WebkitAppearance&&0!==v.offsetHeight,f.removeChild(v)):/^(search|tel)$/.test(i)||(a=/^(url|email)$/.test(i)?v.checkValidity&&v.checkValidity()===!1:v.value!=x)),k[e[r]]=!!a;return k}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var d="2.8.3",m={},p=!0,f=t.documentElement,h="modernizr",y=t.createElement(h),g=y.style,v=t.createElement("input"),x=":)",E={}.toString,b=" -webkit- -moz- -o- -ms- ".split(" "),w="Webkit Moz O ms",S=w.split(" "),C=w.toLowerCase().split(" "),T={},k={},M={},z=[],N=z.slice,P,F=function(e,n,r,a){var i,o,s,l,c=t.createElement("div"),u=t.body,d=u||t.createElement("body");if(parseInt(r,10))for(;r--;)s=t.createElement("div"),s.id=a?a[r]:h+(r+1),c.appendChild(s);return i=["&#173;",'<style id="s',h,'">',e,"</style>"].join(""),c.id=h,(u?c:d).innerHTML+=i,d.appendChild(c),u||(d.style.background="",d.style.overflow="hidden",l=f.style.overflow,f.style.overflow="hidden",f.appendChild(d)),o=n(c,e),u?c.parentNode.removeChild(c):(d.parentNode.removeChild(d),f.style.overflow=l),!!o},j=function(t){var n=e.matchMedia||e.msMatchMedia;if(n)return n(t)&&n(t).matches||!1;var r;return F("@media "+t+" { #"+h+" { position: absolute; } }",function(t){r="absolute"==(e.getComputedStyle?getComputedStyle(t,null):t.currentStyle).position}),r},L={}.hasOwnProperty,O;O=i(L,"undefined")||i(L.call,"undefined")?function(e,t){return t in e&&i(e.constructor.prototype[t],"undefined")}:function(e,t){return L.call(e,t)},Function.prototype.bind||(Function.prototype.bind=function(e){var t=this;if("function"!=typeof t)throw new TypeError;var n=N.call(arguments,1),r=function(){if(this instanceof r){var a=function(){};a.prototype=t.prototype;var i=new a,o=t.apply(i,n.concat(N.call(arguments)));return Object(o)===o?o:i}return t.apply(e,n.concat(N.call(arguments)))};return r}),T.rgba=function(){return r("background-color:rgba(150,255,150,.5)"),o(g.backgroundColor,"rgba")},T.backgroundsize=function(){return c("backgroundSize")},T.borderradius=function(){return c("borderRadius")},T.textshadow=function(){return""===t.createElement("div").style.textShadow},T.opacity=function(){return a("opacity:.55"),/^0.55$/.test(g.opacity)},T.cssanimations=function(){return c("animationName")},T.csstransitions=function(){return c("transition")},T.video=function(){var e=t.createElement("video"),n=!1;try{(n=!!e.canPlayType)&&(n=new Boolean(n),n.ogg=e.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),n.h264=e.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),n.webm=e.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,""))}catch(r){}return n},T.audio=function(){var e=t.createElement("audio"),n=!1;try{(n=!!e.canPlayType)&&(n=new Boolean(n),n.ogg=e.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),n.mp3=e.canPlayType("audio/mpeg;").replace(/^no$/,""),n.wav=e.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),n.m4a=(e.canPlayType("audio/x-m4a;")||e.canPlayType("audio/aac;")).replace(/^no$/,""))}catch(r){}return n},T.localstorage=function(){try{return localStorage.setItem(h,h),localStorage.removeItem(h),!0}catch(e){return!1}};for(var R in T)O(T,R)&&(P=R.toLowerCase(),m[P]=T[R](),z.push((m[P]?"":"no-")+P));return m.input||u(),m.addTest=function(e,t){if("object"==typeof e)for(var r in e)O(e,r)&&m.addTest(r,e[r]);else{if(e=e.toLowerCase(),m[e]!==n)return m;t="function"==typeof t?t():t,"undefined"!=typeof p&&p&&(f.className+=" "+(t?"":"no-")+e),m[e]=t}return m},r(""),y=v=null,function(e,t){function n(e,t){var n=e.createElement("p"),r=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",r.insertBefore(n.lastChild,r.firstChild)}function r(){var e=v.elements;return"string"==typeof e?e.split(" "):e}function a(e){var t=y[e[f]];return t||(t={},h++,e[f]=h,y[h]=t),t}function i(e,n,r){if(n||(n=t),g)return n.createElement(e);r||(r=a(n));var i;return i=r.cache[e]?r.cache[e].cloneNode():m.test(e)?(r.cache[e]=r.createElem(e)).cloneNode():r.createElem(e),!i.canHaveChildren||d.test(e)||i.tagUrn?i:r.frag.appendChild(i)}function o(e,n){if(e||(e=t),g)return e.createDocumentFragment();n=n||a(e);for(var i=n.frag.cloneNode(),o=0,s=r(),l=s.length;l>o;o++)i.createElement(s[o]);return i}function s(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return v.shivMethods?i(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+r().join().replace(/[\w\-]+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'})+");return n}")(v,t.frag)}function l(e){e||(e=t);var r=a(e);return v.shivCSS&&!p&&!r.hasCSS&&(r.hasCSS=!!n(e,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),g||s(e,r),e}var c="3.7.0",u=e.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,m=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,p,f="_html5shiv",h=0,y={},g;!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",p="hidden"in e,g=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return"undefined"==typeof e.cloneNode||"undefined"==typeof e.createDocumentFragment||"undefined"==typeof e.createElement}()}catch(n){p=!0,g=!0}}();var v={elements:u.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:c,shivCSS:u.shivCSS!==!1,supportsUnknownElements:g,shivMethods:u.shivMethods!==!1,type:"default",shivDocument:l,createElement:i,createDocumentFragment:o};e.html5=v,l(t)}(this,t),m._version=d,m._prefixes=b,m._domPrefixes=C,m._cssomPrefixes=S,m.mq=j,m.testProp=function(e){return s([e])},m.testAllProps=c,m.testStyles=F,f.className=f.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(p?" js "+z.join(" "):""),m}(this,this.document),function(e){"use strict";e.matchMedia=e.matchMedia||function(e,t){var n,r=e.documentElement,a=r.firstElementChild||r.firstChild,i=e.createElement("body"),o=e.createElement("div");return o.id="mq-test-1",o.style.cssText="position:absolute;top:-100em",i.style.background="none",i.appendChild(o),function(e){return o.innerHTML='&shy;<style media="'+e+'"> #mq-test-1 { width: 42px; }</style>',r.insertBefore(i,a),n=42===o.offsetWidth,r.removeChild(i),{matches:n,media:e}}}(e.document)}(this),function(e){"use strict";function t(){b(!0)}var n={};e.respond=n,n.update=function(){};var r=[],a=function(){var t=!1;try{t=new e.XMLHttpRequest}catch(n){t=new e.ActiveXObject("Microsoft.XMLHTTP")}return function(){return t}}(),i=function(e,t){var n=a();n&&(n.open("GET",e,!0),n.onreadystatechange=function(){4!==n.readyState||200!==n.status&&304!==n.status||t(n.responseText)},4!==n.readyState&&n.send(null))},o=function(e){return e.replace(n.regex.minmaxwh,"").match(n.regex.other)};if(n.ajax=i,n.queue=r,n.unsupportedmq=o,n.regex={media:/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi,keyframes:/@(?:\-(?:o|moz|webkit)\-)?keyframes[^\{]+\{(?:[^\{\}]*\{[^\}\{]*\})+[^\}]*\}/gi,comments:/\/\*[^*]*\*+([^/][^*]*\*+)*\//gi,urls:/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,findStyles:/@media *([^\{]+)\{([\S\s]+?)$/,only:/(only\s+)?([a-zA-Z]+)\s?/,minw:/\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,maxw:/\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,minmaxwh:/\(\s*m(in|ax)\-(height|width)\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/gi,other:/\([^\)]*\)/g},n.mediaQueriesSupported=e.matchMedia&&null!==e.matchMedia("only all")&&e.matchMedia("only all").matches,!n.mediaQueriesSupported){var s=e.document,l=s.documentElement,c=[],u=[],d=[],m={},p=30,f=s.getElementsByTagName("head")[0]||l,h=s.getElementsByTagName("base")[0],y=f.getElementsByTagName("link"),g,v,x,E=function(){var e,t=s.createElement("div"),n=s.body,r=l.style.fontSize,a=n&&n.style.fontSize,i=!1;return t.style.cssText="position:absolute;font-size:1em;width:1em",n||(n=i=s.createElement("body"),n.style.background="none"),l.style.fontSize="100%",n.style.fontSize="100%",n.appendChild(t),i&&l.insertBefore(n,l.firstChild),e=t.offsetWidth,i?l.removeChild(n):n.removeChild(t),l.style.fontSize=r,a&&(n.style.fontSize=a),e=x=parseFloat(e)},b=function(t){var n="clientWidth",r=l[n],a="CSS1Compat"===s.compatMode&&r||s.body[n]||r,i={},o=y[y.length-1],m=(new Date).getTime();if(t&&g&&p>m-g)return e.clearTimeout(v),void(v=e.setTimeout(b,p));g=m;for(var h in c)if(c.hasOwnProperty(h)){var w=c[h],S=w.minw,C=w.maxw,T=null===S,k=null===C,M="em";S&&(S=parseFloat(S)*(S.indexOf(M)>-1?x||E():1)),C&&(C=parseFloat(C)*(C.indexOf(M)>-1?x||E():1)),w.hasquery&&(T&&k||!(T||a>=S)||!(k||C>=a))||(i[w.media]||(i[w.media]=[]),i[w.media].push(u[w.rules]))}for(var z in d)d.hasOwnProperty(z)&&d[z]&&d[z].parentNode===f&&f.removeChild(d[z]);d.length=0;for(var N in i)if(i.hasOwnProperty(N)){var P=s.createElement("style"),F=i[N].join("\n");P.type="text/css",P.media=N,f.insertBefore(P,o.nextSibling),P.styleSheet?P.styleSheet.cssText=F:P.appendChild(s.createTextNode(F)),d.push(P)}},w=function(e,t,r){var a=e.replace(n.regex.comments,"").replace(n.regex.keyframes,"").match(n.regex.media),i=a&&a.length||0;t=t.substring(0,t.lastIndexOf("/"));var s=function(e){return e.replace(n.regex.urls,"$1"+t+"$2$3")},l=!i&&r;t.length&&(t+="/"),l&&(i=1);for(var d=0;i>d;d++){var m,p,f,h;l?(m=r,u.push(s(e))):(m=a[d].match(n.regex.findStyles)&&RegExp.$1,u.push(RegExp.$2&&s(RegExp.$2))),f=m.split(","),h=f.length;for(var y=0;h>y;y++)p=f[y],o(p)||c.push({media:p.split("(")[0].match(n.regex.only)&&RegExp.$2||"all",rules:u.length-1,hasquery:p.indexOf("(")>-1,minw:p.match(n.regex.minw)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:p.match(n.regex.maxw)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}b()},S=function(){if(r.length){var t=r.shift();i(t.href,function(n){w(n,t.href,t.media),m[t.href]=!0,e.setTimeout(function(){S()},0)})}},C=function(){for(var t=0;t<y.length;t++){var n=y[t],a=n.href,i=n.media,o=n.rel&&"stylesheet"===n.rel.toLowerCase();a&&o&&!m[a]&&(n.styleSheet&&n.styleSheet.rawCssText?(w(n.styleSheet.rawCssText,a,i),m[a]=!0):(!/^([a-zA-Z:]*\/\/)/.test(a)&&!h||a.replace(RegExp.$1,"").split("/")[0]===e.location.host)&&("//"===a.substring(0,2)&&(a=e.location.protocol+a),r.push({href:a,media:i})))}S()};C(),n.update=C,n.getEmValue=E,e.addEventListener?e.addEventListener("resize",t,!1):e.attachEvent&&e.attachEvent("onresize",t)}}(this);/**
 * File Name childTheme.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
var childTheme={init:function(){this.functionName()},functionName:function(){}};