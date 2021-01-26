(function(a,b){if(a.cleanData){var c=a.cleanData;a.cleanData=function(b){for(var d=0,p;null!=(p=b[d]);d++)try{a(p).triggerHandler("remove")}catch(g){}c(b)}}else{var d=a.fn.remove;a.fn.remove=function(b,c){return this.each(function(){c||b&&!a.filter(b,[this]).length||a("*",this).add([this]).each(function(){try{a(this).triggerHandler("remove")}catch(b){}});return d.call(a(this),b,c)})}}a.widget=function(b,c,d){var g=b.split(".")[0],k;b=b.split(".")[1];k=g+"-"+b;d||(d=c,c=a.Widget);a.expr[":"][k]=function(c){return!!a.data(c,
b)};a[g]=a[g]||{};a[g][b]=function(a,b){arguments.length&&this._createWidget(a,b)};c=new c;c.options=a.extend(!0,{},c.options);a[g][b].prototype=a.extend(!0,c,{namespace:g,widgetName:b,widgetEventPrefix:a[g][b].prototype.widgetEventPrefix||b,widgetBaseClass:k},d);a.widget.bridge(b,a[g][b])};a.widget.bridge=function(c,d){a.fn[c]=function(p){var g="string"===typeof p,k=Array.prototype.slice.call(arguments,1),u=this;p=!g&&k.length?a.extend.apply(null,[!0,p].concat(k)):p;if(g&&"_"===p.charAt(0))return u;
g?this.each(function(){var d=a.data(this,c),f=d&&a.isFunction(d[p])?d[p].apply(d,k):d;if(f!==d&&f!==b)return u=f,!1}):this.each(function(){var b=a.data(this,c);b?b.option(p||{})._init():a.data(this,c,new d(p,this))});return u}};a.Widget=function(a,b){arguments.length&&this._createWidget(a,b)};a.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",options:{disabled:!1},_createWidget:function(b,c){a.data(c,this.widgetName,this);this.element=a(c);this.options=a.extend(!0,{},this.options,this._getCreateOptions(),
b);var d=this;this.element.bind("remove."+this.widgetName,function(){d.destroy()});this._create();this._trigger("create");this._init()},_getCreateOptions:function(){return a.metadata&&a.metadata.get(this.element[0])[this.widgetName]},_create:function(){},_init:function(){},destroy:function(){this.element.unbind("."+this.widgetName).removeData(this.widgetName);this.widget().unbind("."+this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass+"-disabled ui-state-disabled")},widget:function(){return this.element},
option:function(c,d){var p=c;if(0===arguments.length)return a.extend({},this.options);if("string"===typeof c){if(d===b)return this.options[c];p={};p[c]=d}this._setOptions(p);return this},_setOptions:function(b){var c=this;a.each(b,function(a,b){c._setOption(a,b)});return this},_setOption:function(a,b){this.options[a]=b;"disabled"===a&&this.widget()[b?"addClass":"removeClass"](this.widgetBaseClass+"-disabled ui-state-disabled").attr("aria-disabled",b);return this},enable:function(){return this._setOption("disabled",
!1)},disable:function(){return this._setOption("disabled",!0)},_trigger:function(b,c,d){var g=this.options[b];c=a.Event(c);c.type=(b===this.widgetEventPrefix?b:this.widgetEventPrefix+b).toLowerCase();d=d||{};if(c.originalEvent){b=a.event.props.length;for(var k;b;)k=a.event.props[--b],c[k]=c.originalEvent[k]}this.element.trigger(c,d);return!(a.isFunction(g)&&!1===g.call(this.element[0],c,d)||c.isDefaultPrevented())}}})(jQuery);(function(a,b){function c(){}function d(a){E=[a]}function h(a,b,c){return a&&a.apply(b.context||b,c)}function e(e){function H(a){!A++&&b(function(){B();C&&(G[r]={s:[a]});I&&(a=I.apply(e,[a]));h(e.success,e,[a,n]);h(J,e,[e,n])},0)}function F(a){!A++&&b(function(){B();C&&a!=s&&(G[r]=a);h(e.error,e,[e,a]);h(J,e,[e,a])},0)}e=a.extend({},K,e);var J=e.complete,I=e.dataFilter,L=e.callbackParameter,M=e.callback,P=e.cache,C=e.pageCache,N=e.charset,r=e.url,x=e.data,O=e.timeout,D,A=0,B=c;e.abort=function(){!A++&&
B()};if(!1===h(e.beforeSend,e,[e])||A)return e;r=r||k;x=x?"string"==typeof x?x:a.param(x,e.traditional):k;r+=x?(/\?/.test(r)?"&":"?")+x:k;L&&(r+=(/\?/.test(r)?"&":"?")+encodeURIComponent(L)+"=?");P||C||(r+=(/\?/.test(r)?"&":"?")+"_"+(new Date).getTime()+"=");r=r.replace(/=\?(&|$)/,"="+M+"$1");C&&(D=G[r])?D.s?H(D.s[0]):F(D):b(function(k,e,n){if(!A){n=0<O&&b(function(){F(s)},O);B=function(){n&&clearTimeout(n);k[l]=k[f]=k[m]=k[t]=null;y[w](k);e&&y[w](e)};window[M]=d;k=a(q)[0];k.id=v+Q++;N&&(k[g]=N);
var h=function(a){(k[f]||c)();a=E;E=void 0;a?H(a[0]):F(u)};z.msie?(k.event=f,k.htmlFor=k.id,k[l]=function(){/loaded|complete/.test(k.readyState)&&h()}):(k[t]=k[m]=h,z.opera?(e=a(q)[0]).text="jQuery('#"+k.id+"')[0]."+t+"()":k[p]=p);k.src=r;y.insertBefore(k,y.firstChild);e&&y.insertBefore(e,y.firstChild)}},0);return e}var p="async",g="charset",k="",u="error",v="_jqjsp",f="onclick",t="on"+u,m="onload",l="onreadystatechange",w="removeChild",q="<script/>",n="success",s="timeout",z=a.browser,y=a("head")[0]||
document.documentElement,G={},Q=0,E,K={callback:v,url:location.href};e.setup=function(b){a.extend(K,b)};a.jsonp=e})(jQuery,setTimeout);var JSON;JSON||(JSON={});
(function(){function a(a){return 10>a?"0"+a:a}function b(a){h.lastIndex=0;return h.test(a)?'"'+a.replace(h,function(a){var b=g[a];return"string"===typeof b?b:"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+a+'"'}function c(a,d){var f,g,m,l,h=e,q,n=d[a];n&&"object"===typeof n&&"function"===typeof n.toJSON&&(n=n.toJSON(a));"function"===typeof k&&(n=k.call(d,a,n));switch(typeof n){case "string":return b(n);case "number":return isFinite(n)?String(n):"null";case "boolean":case "null":return String(n);case "object":if(!n)return"null";
e+=p;q=[];if("[object Array]"===Object.prototype.toString.apply(n)){l=n.length;for(f=0;f<l;f+=1)q[f]=c(f,n)||"null";m=0===q.length?"[]":e?"[\n"+e+q.join(",\n"+e)+"\n"+h+"]":"["+q.join(",")+"]";e=h;return m}if(k&&"object"===typeof k)for(l=k.length,f=0;f<l;f+=1)"string"===typeof k[f]&&(g=k[f],(m=c(g,n))&&q.push(b(g)+(e?": ":":")+m));else for(g in n)Object.prototype.hasOwnProperty.call(n,g)&&(m=c(g,n))&&q.push(b(g)+(e?": ":":")+m);m=0===q.length?"{}":e?"{\n"+e+q.join(",\n"+e)+"\n"+h+"}":"{"+q.join(",")+
"}";e=h;return m}}"function"!==typeof Date.prototype.toJSON&&(Date.prototype.toJSON=function(){return isFinite(this.valueOf())?this.getUTCFullYear()+"-"+a(this.getUTCMonth()+1)+"-"+a(this.getUTCDate())+"T"+a(this.getUTCHours())+":"+a(this.getUTCMinutes())+":"+a(this.getUTCSeconds())+"Z":null},String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(){return this.valueOf()});var d=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
h=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,e,p,g={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},k;"function"!==typeof JSON.stringify&&(JSON.stringify=function(a,b,d){var g;p=e="";if("number"===typeof d)for(g=0;g<d;g+=1)p+=" ";else"string"===typeof d&&(p=d);if((k=b)&&"function"!==typeof b&&("object"!==typeof b||"number"!==typeof b.length))throw Error("JSON.stringify");return c("",{"":a})});
"function"!==typeof JSON.parse&&(JSON.parse=function(a,b){function c(a,d){var k,e,g=a[d];if(g&&"object"===typeof g)for(k in g)Object.prototype.hasOwnProperty.call(g,k)&&(e=c(g,k),void 0!==e?g[k]=e:delete g[k]);return b.call(a,d,g)}var k;a=String(a);d.lastIndex=0;d.test(a)&&(a=a.replace(d,function(a){return"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)}));if(/^[\],:{}\s]*$/.test(a.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
"]").replace(/(?:^|:|,)(?:\s*\[)+/g,"")))return k=eval("("+a+")"),"function"===typeof b?c({"":k},""):k;throw new SyntaxError("JSON.parse");})})();/*
 MIT License
*/
(function(){this.Templ=function(a,b){var c=1,d={},h=function(a,b,e,p,f){for(var t=b;-1!=(b=a.indexOf("{%",b));){var m=c++,l=a.indexOf("%}",b),l=a.slice(b+2,l),w="{_"+m+"}";if(f||e&&l.match(e))return e=t-2,l=b+l.length+4,d[m]={buffer:a.slice(e,l),expr:p},a.substr(0,e)+w+a.substr(l);if(m=l.match(/\s*for\s+((?:\w+\s*,)?\s*\w+)\s+in\s+(.+?)\s*$/i))a=h(a,b+2,/\s*endfor\s*/i,{type:"for",elem:m[1],list:m[2]});else if(m=l.match(/\s*if\s+(.+)\s*/i))a=h(a,b+2,/\s*endif\s*/i,{type:"if",cond:m[1]});else if(m=
l.match(/\s*set\s+(\w+)(?:\s*=\s*(.*)?)?\s*/i))l={type:"set",svar:m[1],sval:m[2]},a=m[2]?h(a,b,null,l,!0):h(a,b+2,/\s*endset\s*/i,l);b+=w.length}return a},e=function(a,b){return a=a.replace(/{_(\d+?)}/g,function(a,c){var f=d[c];if(f.expr){var g;switch(f.expr.type){case "if":var m=p(b,f.expr.cond,"TEMPL ERROR: invalid condition: "+f.expr.cond+".");return(g=f.buffer.match(m?/{%\s*if\s+.+?\s*%}([\s\S]*?){%/i:/{%\s*else\s*%}([\s\S]*?){%/i))?e(g[1],b):"";case "for":with(b)var l=eval(f.expr.list);if("undefined"==
typeof l)throw Error('TEMPL ERROR: Undefined list "'+f.expr.list+'".');a:if(g=l,g.hasOwnProperty("length"))g=!!g.length;else{for(var h in g)if(g.hasOwnProperty(h)){g=!0;break a}g=!1}if(g){if(g=f.buffer.match(/{%\s*for.*?\s*%}([\s\S]*?){%/i)){var q,f=f.expr.elem,n=f.split(/\s*,\s*/);h="";2==n.length&&(m=n[0],f=n[1]);for(q in l)n={},m&&(n[m]=q),n[f]=l[q],h+=e(g[1],n);return h}return""}return(g=f.buffer.match(/{%\s*else\s*%}([\s\S]*?){%/i))?e(g[1],l):"";case "set":return m=f.expr,f=m.sval?p(b,m.sval,
""):e(f.buffer.replace(/{%.*?%}/g,""),b),b[m.svar]=f,""}}else{m=p(b,d[c].buffer,'TEMPL ERROR: Undefined variable "'+d[c].buffer+'".');if(f.modif.length)for(l in f.modif){if(void 0==f.modif[l])break;q=f.modif[l];h=[];if(n=f.modif[l].match(/(\w+)\(([\s\S]+)\)/)){q=n[1];h=n[2].split(/\s*,\s*/);with(b)for(g in h)h[g]=eval(h[g])}h.unshift(m);q=Templ.modifiers[q]||window[q];if("function"!=typeof q)throw Error('TEMPL ERROR: Unknown modifier "'+f.modif[l]+'".');m=q.apply(this,h)}return m}})},p=function(a,
c,d){var e;with(a)try{e=eval(c)}catch(f){try{with(b)e=eval(c)}catch(h){try{e=eval(c)}catch(m){throw Error(d);}}}return e};return e(h(function(a){var b=0;for(a=a.replace(/^\s*|\s*$/g,"");-1!=(b=a.indexOf("{{",b));){var e=c++,h=a.indexOf("}}",b),f=a.slice(b+2,h).replace(/^\s*|\s*$/g,"").split("|"),p="{_"+e+"}";d[e]={buffer:f.shift(),modif:f};a=a.substr(0,b)+p+a.substr(h+2);b+=p.length}return a}(a),0),b)};this.Templ.modifiers={};this.Templ.addModifiers=function(a){for(var b in a)this.modifiers[b]=a[b]}})();Templ.addModifiers({upper:function(a){return a.toUpperCase()},lower:function(a){return a.toLowerCase()},capitalize:function(a){return a.charAt(0).toUpperCase()+a.substring(1).toLowerCase()},ucwords:function(a){return a.replace(/^(.)|\s(.)/g,function(a){return a.toUpperCase()})},empty:function(a,b){return a?a:String(b)},trim:function(a,b){var c="undefined"!=typeof b?"[\\s"+b+"]":"\\s";return a.replace(RegExp("(^"+c+"*)|("+c+"*$)","g"),"")},esc:function(a){return a.replace(/&/g,"&amp;").replace(/</g,
"&lt;").replace(/>/g,"&gt;")},stripTags:function(a){return a.replace(/<\w+(\s+("[^"]*"|'[^']*'|[^>])+)?>|<\/\w+>/gi,"")},truncate:function(a,b,c){b=b||50;c=c||"...";return a.length>b?a.slice(0,b-c.length)+c:String(a)},repeat:function(a,b){return Array((b||1)+1).join(a)},cat:function(){return Array.prototype.slice.call(arguments).join("")},nl2br:function(a){return a.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g,"$1<br/>")},replace:function(a,b,c){return String(a).replace(RegExp(b,"gi"),c)},urlEncode:function(a,
b){return b?encodeURIComponent(a):encodeURI(a)}});(function(a){function b(b,d){var h,e;function p(b){z.start=w?b.pageX:b.pageY;b=parseInt(l.obj.css(q));h="auto"==b?0:b;a(document).bind("mousemove",u);document.ontouchmove=function(b){a(document).unbind("mousemove");u(b.touches[0])};a(document).bind("mouseup",k);l.obj.bind("mouseup",k);l.obj[0].ontouchend=document.ontouchend=function(b){a(document).unbind("mouseup");l.obj.unbind("mouseup");k(b.touches[0])};return!1}function g(b){1<=f.ratio||(b=a.event.fix(b||window.event),s-=(b.wheelDelta?b.wheelDelta/
120:-b.detail/3)*d.wheel,s=Math.min(f[d.axis]-v[d.axis],Math.max(0,s)),l.obj.css(q,s/t.ratio),f.obj.css(q,-s),b.preventDefault())}function k(b){a(document).unbind("mousemove",u);a(document).unbind("mouseup",k);l.obj.unbind("mouseup",k);document.ontouchmove=l.obj[0].ontouchend=document.ontouchend=null;return!1}function u(a){1<=f.ratio||(e=Math.min(m[d.axis]-l[d.axis],Math.max(0,h+((w?a.pageX:a.pageY)-z.start))),s=e*t.ratio,f.obj.css(q,-s),l.obj.css(q,e));return!1}var v={obj:a(".viewport",b)},f={obj:a(".overview",
b)},t={obj:a(".scrollbar",b)},m={obj:a(".track",t.obj)},l={obj:a(".thumb",t.obj)},w="x"==d.axis,q=w?"left":"top",n=w?"Width":"Height",s;e=h=0;var z={};this.update=function(a){v[d.axis]=v.obj[0]["offset"+n];f[d.axis]=f.obj[0]["scroll"+n];f.ratio=v[d.axis]/f[d.axis];t.obj.toggleClass("disable",1<=f.ratio);m[d.axis]="auto"==d.size?v[d.axis]:d.size;l[d.axis]=Math.min(m[d.axis],Math.max(0,"auto"==d.sizethumb?m[d.axis]*f.ratio:d.sizethumb));t.ratio="auto"==d.sizethumb?f[d.axis]/m[d.axis]:(f[d.axis]-v[d.axis])/
(m[d.axis]-l[d.axis]);s="relative"==a&&1>=f.ratio?Math.min(f[d.axis]-v[d.axis],Math.max(0,s)):0;s="bottom"==a&&1>=f.ratio?f[d.axis]-v[d.axis]:isNaN(parseInt(a))?s:parseInt(a);l.obj.css(q,s/t.ratio);f.obj.css(q,-s);z.start=l.obj.offset()[q];a=n.toLowerCase();t.obj.css(a,m[d.axis]);m.obj.css(a,m[d.axis]);l.obj.css(a,l[d.axis])};this.update();(function(){l.obj.bind("mousedown",p);l.obj[0].ontouchstart=function(a){a.preventDefault();l.obj.unbind("mousedown");p(a.touches[0]);return!1};m.obj.bind("mouseup",
u);d.scroll&&this.addEventListener?(b[0].addEventListener("DOMMouseScroll",g,!1),b[0].addEventListener("mousewheel",g,!1)):d.scroll&&(b[0].onmousewheel=g)})();return this}a.tiny=a.tiny||{};a.tiny.scrollbar={options:{axis:"y",wheel:40,scroll:!0,size:"auto",sizethumb:"auto"}};a.fn.tinyscrollbar=function(c){c=a.extend({},a.tiny.scrollbar.options,c);this.each(function(){a(this).data("tsb",new b(a(this),c))});return this};a.fn.tinyscrollbar_update=function(b){return a(this).data("tsb").update(b)}})(jQuery);var _={getParam:function(a){var b=["URL","cookie"],c,d=RegExp(a+"=(.*?)(?:[;&]|$)");for(c in b)if(a=document[b[c]].match(d))return a[1];return!1},send:function(){this.log("send",arguments);arguments[0]=appSettings.host+arguments[0];$.get.apply(arguments.callee,[].slice.call(arguments))},getRandom:function(){return(""+Math.random()).substr(2)+ +new Date},log:function(){if(window.console){var a=Array.prototype.slice.call(arguments);console.log(a)}},isDeviceScreenWide:function(){return 640<$(window).width()},
findObjInArray:function(a,b,c){for(var d in a)if(a[d][c]==b)return a[d];return!1},dec2hex:function(a){return"#"+(a+16777215+1).toString(16).substr(-6)},regQuote:function(a){return a.replace(RegExp("[.\\\\+*?\\[\\^\\]$(){}=!<>|:\\-]","g"),"\\$&")},cookie:{create:function(a,b,c){c=c||{};var d=c.expires;if("number"==typeof d&&d){var h=new Date;h.setTime(h.getTime()+1E3*d);d=c.expires=h}d&&d.toUTCString&&(c.expires=d.toUTCString());b=encodeURIComponent(b);a=a+"="+b;for(var e in c)a+="; "+e,b=c[e],!0!==
b&&(a+="="+b);document.cookie=a},read:function(a){return(a=document.cookie.match(RegExp("(?:^|; )"+a.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g,"\\$1")+"=([^;]*)")))?decodeURIComponent(a[1]):null},remove:function(a){this.create(a,null,{expires:-1})}}};String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,"")};
Templ.addModifiers({emotions:function(a){var b=appSettings.emotions||!1;if(!b)return!1;var c=[],d="",h;for(h in b)c.push(h);d=_.regQuote(c.join("~")).replace(/~/g,"|");return a.replace(RegExp("("+d+")","g"),function(a,c){return b[c]?'<img class="emotion" src="'+appSettings.emotionsPath+"/"+b[c]+'.png">':c})},parseLinks:function(a){for(var b="";""!=a;){var c;var d=a;c=d.indexOf("http://");var h=d.indexOf("https://"),d=d.indexOf("www.");-1==c&&-1==h&&-1==d?c=-1:(-1==c&&(c=999999),-1==h&&(h=999999),
-1==d&&(d=999999),c=Math.min(c,h,d));-1==c?(b+=a,a=""):(b+=a.substr(0,c),a=a.substr(c),c=a.indexOf(" "),-1==c&&(c=a.length),h=a.substr(0,c),b=-1==h.indexOf("http")?b+('<a href="http://'+h+'" target="_blank">'+h+"</a>"):b+('<a href="'+h+'" target="_blank">'+h+"</a>"),a=a.substr(c))}return b}});$.widget("ui.flashcomsChat",{options:{host:null,addCSS:{},roomID:null,maxHistoryMessages:50,onJoinLink:null,imagesPath:"../files/images",emotionsPath:"./img/emotions"},templates:{main:'<div class="fchat"></div>',loading:'<div class="fchat-loading">Loading...</div>',error:'<div class="fchat-error">{{ message }}</div>',chat:'<div class="fchat-header"><span class="fchat-header-title">{{ room.name }}</span></div><div class="fchat-inner"><div class="fchat-scrollbar"><div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div><div class="viewport"><ul class="overview">\x3c!-- Content goes here --\x3e</ul></div></div></div><div class="fchat-tools-panel"><form><input type="text" class="text-field"><button type="submit">Send</button></form><button type="button" class="fchat-join">Join chat!</button></div>',
message:'<div class="msg"><b class="msg-author">{{ sender.name|stripTags }}{% if receiver.name %} &gt; <span>{{ receiver.name|stripTags }}</span>{% endif %}:</b>{{ message.content|stripTags|parseLinks|emotions }}{% if message.youTubeLink %} <br /><a href="{{ message.youTubeLink|stripTags }}" target="_blank">{{ message.youTubeLink|stripTags }}</a>{% endif %}{% if message.imageID %} <br /> <a href="{{imagesPath}}//{{ message.imageID }}.{{ message.imageExtension }}" target="_blank"><img src="{{imagesPath}}//{{ message.imageID }}_s.{{ message.imageExtension }}"/></a>{% endif %}</div>',
drawing:'<div class="msg">{{ sender.name|stripTags }} sent a drawing</div>'},rooms:[],room:{},users:null,user:{},autoLogged:!1,historyLength:0,loggedOutCount:0,sid:null,_init:function(){if(null!=this.instance)return this.instance;this.instance=this;$(this.element).append(this.render(this.templates.main));this.cont=this.element.find(".fchat").css(this.options.addCSS);this.cont.html(this.render(this.templates.loading));this.sid=this.getRandom();this.initConnection(this.proxy(this.login));$(window).bind("beforeunload",
this.proxy(this.remove))},initConnection:function(a){var b=this,c=!1;this.send("/connect?appType=minichat",function(){c=!0;b.onPoll.call(b)});var d=window.setInterval(function(){c&&(window.clearInterval(d),a.call(b))},1500);this.sendIAmAliveLoop()},onPoll:function(a){try{if(a)switch(a.action){case "LoginResult":this.onLogin(a);break;case "OnUserJoin":this.onUserJoin(a);break;case "OnUserLeave":this.onUserleave(a);break;case "ReceiveMessage":this.onNewMessage(a)}}catch(b){_.log("onPoll error",b)}this.instance&&
this.send("/poll",this.proxy(this.onPoll))},sendIAmAliveLoop:function(){var a=this;null==this.sendIAmAliveInterval&&(this.sendIAmAliveInterval=window.setInterval(function(){a.send("/sendIAmAlive",a.onSendIAmAlive)},6E4))},onSendIAmAlive:function(a){},login:function(){var a=this.getParam("uid");a?(this.autoLogged=!0,this.send("/autoLogin",{uid:a})):(this.autoLogged=!1,this.send("/guestLogin",{name:this.getRandomName(),fake:1}))},getRoomList:function(a){this.send("/getRoomList",a)},joinRoom:function(a,
b){this.send("/joinRoom",{roomID:a},b)},cacheUserList:function(a){this.users||(this.users={});for(var b=0,c=a.length;b<c;b++)this.users[a[b].id]=a[b]},onUserJoin:function(a){a.roomID==this.room.id&&this.cacheUserList([a.user])},onUserleave:function(a){delete this.users[a.user.id]},getUserList:function(a){this.users={};this.send("/getUserList",{roomID:a},this.proxy(function(a){this.cacheUserList(a.users)}))},onLogin:function(a){this.user=a.user;this.getRoomList(this.proxy(function(a){this.rooms=a;
var c=this.options.roomID?this.options.roomID:a[0].id;this.joinRoom(c,this.proxy(function(d){d.result?(this.room=this.findObjInArray(a,c,"id"),this.getUserList(c),this.chatScreen()):this.displayError("Error joining room.")}))}))},chatScreen:function(){this.cont.html(this.render(this.templates.chat,{room:this.room}));this.scrollCont=this.element.find(".fchat-scrollbar");this.messageCont=this.scrollCont.find(".overview");this.toolsPanel=this.cont.find(".fchat-tools-panel");this.textField=this.toolsPanel.find(".text-field");
this.toolsPanelHeight=this.toolsPanel.outerHeight(!0);this.autoLogged||this.toolsPanel.find("form").remove();this.contInner=this.cont.find(".fchat-inner");this.contViewport=this.cont.find(".viewport");this.contHeight=this.cont.height()-this.cont.find(".fchat-header").outerHeight();this.contHeight-=this.contInner.outerHeight()-this.contInner.height();this.setScrollHeight();this.scrollCont.tinyscrollbar();this.initScreenEvents();this.getRoomHistory(this.room.id)},initScreenEvents:function(){var a=function(){this.toolsPanel.is(":hidden")&&
(this.updateScrollHeight(this.contHeight-this.toolsPanel.outerHeight(!0)),this.toolsPanel.show())};this.cont.bind({click:this.proxy(function(b){b.stopPropagation();a.call(this)}),mouseenter:this.proxy(a),mouseleave:this.proxy(function(){this.autoLogged&&this.textField.is(":focus")||(this.toolsPanel.hide(),this.updateScrollHeight())})});this.autoLogged&&this.toolsPanel.find("form").submit(this.proxy(this.sendMessage));this.options.onJoinLink&&this.toolsPanel.find(".fchat-join").click(this.options.onJoinLink)},
sendMessage:function(a){a.preventDefault();if(this.autoLogged){a=$.trim(this.textField.val());if(!a)return this.textField.focus(),!1;this.send("/sendMessage",{roomID:this.room.id,message:JSON.stringify({senderID:this.user.id,content:a,receiverID:"",whisper:!1})});this.textField.val("").focus()}},getRoomHistory:function(a){this.send("/getHistory",{roomID:a},this.proxy(function(b){b.roomID==a&&this.appendNewMessages(b.history)}))},onNewMessage:function(a){if(this.users){var b=this.users[a.message.senderID],
c=this.users[a.message.receiverID];if(!b){b="";_.log("message from unknown user",a.message.senderID);_.log("known users:");for(var d in this.users)_.log(this.users[d])}c||(c="");this.appendNewMessages([{sender:b,receiver:c,message:a.message}])}},appendNewMessages:function(a){if(a.length){for(var b in a){if(void 0==a[b])break;var c=a[b];c.imagesPath=this.options.imagesPath;c.message.whisper||(0==c.message.content.indexOf("[[DRW]]")?this.messageCont.append(this.render(this.templates.drawing,c)):this.messageCont.append(this.render(this.templates.message,
c)))}this.historyLength+=a.length;this.removeExtraMessages();this.updateScrollHeight()}},removeExtraMessages:function(){if(this.historyLength>this.options.maxHistoryMessages){var a=this.historyLength-this.options.maxHistoryMessages;this.messageCont.find(".msg:lt("+a+")").remove();this.historyLength-=a}},updateScrollHeight:function(a){this.setScrollHeight(a);this.scrollCont.tinyscrollbar_update("bottom")},setScrollHeight:function(a){this.contViewport.height(a||this.contHeight-(this.toolsPanel.is(":visible")?
this.toolsPanelHeight:0))},displayError:function(a){this.cont.html(this.render(this.templates.error,{message:a}))},remove:function(){this.logout(this.proxy(this._destroy))},logout:function(a){this.send("/logout",a||function(){})},_destroy:function(){delete this.instance;this.loggedOutCount++;this.cont.remove()},proxy:function(a){var b=this;return function(){return a.apply(b,arguments)}},send:function(){_.log("this.options",this.options);_.log("arguments",arguments);var a=[].slice.call(arguments),
b={url:this.options.host+a.shift(),callbackParameter:"callback",data:{},error:this.proxy(function(){function a(){b.displayError("Connection to the server failed.")}var b=this;0==this.loggedOutCount?setTimeout(a,100):this.loggedOutCount--})},c=a.shift();b["object"==typeof c?"data":"success"]=c;b.data.sid=this.sid;a[0]&&(b.success=a[0]);$.jsonp(b)},getParam:function(a){var b=["URL","cookie"],c,d;a=RegExp("(?:[;&? ]|^)"+a+"=(.*?)(?:[;&]|$)");for(c in b)if(void 0!=b[c]&&(d=document[b[c]].match(a)))return d[1];
return!1},findObjInArray:function(a,b,c){for(var d in a)if(a[d][c]==b)return a[d];return!1},render:function(a,b){return Templ(a,b||{})},getRandomName:function(){return"_gu"+this.getRandom()},getRandom:function(){return(""+Math.random()).substr(2)+ +new Date}});