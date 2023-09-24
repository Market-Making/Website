(self.webpackChunk=self.webpackChunk||[]).push([[769],{769:function(C){C.exports=function(F){var a={};function d(t){if(a[t])return a[t].exports;var _=a[t]={i:t,l:!1,exports:{}};return F[t].call(_.exports,_,_.exports,d),_.l=!0,_.exports}return d.m=F,d.c=a,d.d=function(t,_,p){d.o(t,_)||Object.defineProperty(t,_,{enumerable:!0,get:p})},d.r=function(t){typeof Symbol!="undefined"&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},d.t=function(t,_){if(1&_&&(t=d(t)),8&_||4&_&&typeof t=="object"&&t&&t.__esModule)return t;var p=Object.create(null);if(d.r(p),Object.defineProperty(p,"default",{enumerable:!0,value:t}),2&_&&typeof t!="string")for(var u in t)d.d(p,u,function(P){return t[P]}.bind(null,u));return p},d.n=function(t){var _=t&&t.__esModule?function(){return t.default}:function(){return t};return d.d(_,"a",_),_},d.o=function(t,_){return Object.prototype.hasOwnProperty.call(t,_)},d.p="",d(d.s=8)}([function(F,a,d){"use strict";function t(_){for(var p in _)a.hasOwnProperty(p)||(a[p]=_[p])}Object.defineProperty(a,"__esModule",{value:!0}),t(d(13)),t(d(17))},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var t=d(18);function _(p){var u,P;return p.jsonrpc=p.jsonrpc||a.JSON_RPC_VERSION,p.id=t.getPayloadId(),p.batch||p.method==="eth_batchRequest"?(p.method="eth_batchRequest",p.batch=(P=(u=p.batch)===null||u===void 0?void 0:u.map(function(v){return _(v)}))!=null?P:[],p):(p.params=p.params||[],p)}a.JSON_RPC_VERSION="2.0",a.createJsonRpcRequestPayload=function(p,u){var P=[{}];return u&&(P=Array.isArray(u)?u:[{to:u.to,value:u.amount}]),{params:P,method:p,jsonrpc:a.JSON_RPC_VERSION,id:t.getPayloadId()}},a.createJsonRpcBatchRequestPayload=function(p){p===void 0&&(p=[]);var u=Array.isArray(p)?p:[p];return{method:"eth_batchRequest",jsonrpc:a.JSON_RPC_VERSION,id:t.getPayloadId(),batch:u.filter(Boolean).map(function(P){return _(P)})}},a.standardizeRequestPayload=_},function(F,a,d){"use strict";var t,_=this&&this.__extends||(t=function(g,y){return(t=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(n,c){n.__proto__=c}||function(n,c){for(var s in c)c.hasOwnProperty(s)&&(n[s]=c[s])})(g,y)},function(g,y){function n(){this.constructor=g}t(g,y),g.prototype=y===null?Object.create(y):(n.prototype=y.prototype,new n)});Object.defineProperty(a,"__esModule",{value:!0});var p=d(0),u=d(4),P=function(g){function y(n,c){var s=g.call(this,"Fortmatic SDK Error: ["+n+"] "+c)||this;return s.code=n,s.__proto__=Error,Object.setPrototypeOf(s,y.prototype),s}return _(y,g),y}(Error);a.FortmaticError=P;var v=function(){function g(y,n){this.code=y,this.message="Fortmatic SDK Warning: ["+y+"] "+n}return g.prototype.log=function(){console.warn(this.message)},g}();a.FortmaticWarning=v;var h=function(g){function y(n){var c,s,e=g.call(this)||this;e.__proto__=Error;var r=Number((c=n)===null||c===void 0?void 0:c.code),f=((s=n)===null||s===void 0?void 0:s.message)||"Internal error";return e.code=u.isJsonRpcErrorCode(r)?r:p.RPCErrorCode.InternalError,e.message="Fortmatic RPC Error: ["+e.code+"] "+f,Object.setPrototypeOf(e,y.prototype),e}return _(y,g),y}(Error);a.RpcError=h,a.createMissingApiKeyError=function(){return new P(p.SDKErrorCode.MissingApiKey,"Please provide a Fortmatic API key that you acquired from the developer dashboard.")},a.createModalNotReadyError=function(){return new P(p.SDKErrorCode.ModalNotReady,"Modal is not ready.")},a.createInvalidArgumentError=function(g){var y,n,c,s;return new P(p.SDKErrorCode.InvalidArgument,"Invalid "+(y=g.argIndex,s=(n=y+1)%100,(c=n%10)===1&&s!==11?n+"st":c===2&&s!==12?n+"nd":c===3&&s!==13?n+"rd":n+"th")+" argument given to `"+g.functionName+"`.\n  Expected: `"+g.expected+"`\n  Received: `"+g.received+"`")},a.createSynchronousWeb3MethodWarning=function(){return new v(p.SDKWarningCode.SyncWeb3Method,"Non-async web3 methods will be deprecated in web3 > 1.0 and are not supported by the Fortmatic provider. An async method is to be used instead.")},a.createDuplicateIframeWarning=function(){return new v(p.SDKWarningCode.DuplicateIframe,"Duplicate iframes found.")}},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var t=d(1);a.emitWeb3Payload=function(_,p,u){return u===void 0&&(u=[]),new Promise(function(P,v){_.sendAsync(t.createJsonRpcRequestPayload(p,u),function(h,g){h?v(h):P(g.result)})})},a.emitFortmaticPayload=function(_,p){return new Promise(function(u,P){_.sendFortmaticAsync(p,function(v,h){v?P(v):u(h?h.result:{})})})}},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var t=d(0);function _(u){return!!u&&!(!u.jsonrpc||!u.id||!u.method||!u.batch||u.params)}function p(u){return!!u&&!(!u.jsonrpc||!u.id||!u.method||!u.params||u.batch)}a.isJsonRpcBatchRequestPayload=_,a.isJsonRpcRequestPayload=p,a.isJsonRpcResponsePayload=function(u){return!!u&&!(!u.jsonrpc||!u.id||!u.result&&u.result!==null&&!u.error)},a.isFmRequest=function(u){return!(!u||!u.payload)&&p(u.payload)},a.isFmBatchRequest=function(u){return!(!u||!u.payload)&&_(u.payload)},a.isFmPayloadMethod=function(u){return!!u&&typeof u=="string"&&Object.values(t.FmPayloadMethod).includes(u)},a.isJsonRpcErrorCode=function(u){return!!u&&typeof u=="number"&&Object.values(t.RPCErrorCode).includes(u)}},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var t=function(_){this.sdk=_};a.BaseModule=t},function(F,a,d){"use strict";var t=this&&this.__awaiter||function(n,c,s,e){return new(s||(s=Promise))(function(r,f){function l(i){try{O(e.next(i))}catch(o){f(o)}}function w(i){try{O(e.throw(i))}catch(o){f(o)}}function O(i){var o;i.done?r(i.value):(o=i.value,o instanceof s?o:new s(function(R){R(o)})).then(l,w)}O((e=e.apply(n,c||[])).next())})},_=this&&this.__generator||function(n,c){var s,e,r,f,l={label:0,sent:function(){if(1&r[0])throw r[1];return r[1]},trys:[],ops:[]};return f={next:w(0),throw:w(1),return:w(2)},typeof Symbol=="function"&&(f[Symbol.iterator]=function(){return this}),f;function w(O){return function(i){return function(o){if(s)throw new TypeError("Generator is already executing.");for(;l;)try{if(s=1,e&&(r=2&o[0]?e.return:o[0]?e.throw||((r=e.return)&&r.call(e),0):e.next)&&!(r=r.call(e,o[1])).done)return r;switch(e=0,r&&(o=[2&o[0],r.value]),o[0]){case 0:case 1:r=o;break;case 4:return l.label++,{value:o[1],done:!1};case 5:l.label++,e=o[1],o=[0];continue;case 7:o=l.ops.pop(),l.trys.pop();continue;default:if(!(r=(r=l.trys).length>0&&r[r.length-1])&&(o[0]===6||o[0]===2)){l=0;continue}if(o[0]===3&&(!r||o[1]>r[0]&&o[1]<r[3])){l.label=o[1];break}if(o[0]===6&&l.label<r[1]){l.label=r[1],r=o;break}if(r&&l.label<r[2]){l.label=r[2],l.ops.push(o);break}r[2]&&l.ops.pop(),l.trys.pop();continue}o=c.call(n,l)}catch(R){o=[6,R],e=0}finally{s=r=0}if(5&o[0])throw o[1];return{value:o[0]?o[1]:void 0,done:!0}}([O,i])}}},p=this&&this.__values||function(n){var c=typeof Symbol=="function"&&Symbol.iterator,s=c&&n[c],e=0;if(s)return s.call(n);if(n&&typeof n.length=="number")return{next:function(){return n&&e>=n.length&&(n=void 0),{value:n&&n[e++],done:!n}}};throw new TypeError(c?"Object is not iterable.":"Symbol.iterator is not defined.")};Object.defineProperty(a,"__esModule",{value:!0});var u=d(0),P=d(4),v=d(7),h=d(2);function g(n,c){var s,e,r,f,l,w;(function(i){var o,R,m,b,T,M,A=!!i.data.response.error||!!i.data.response.message||!!i.data.response.code,I={message:(R=(o=i.data.response.error)===null||o===void 0?void 0:o.message,m=R!=null?R:i.data.response.message,m!=null?m:"Fortmatic: Modal was closed without executing action!"),code:(T=(b=i.data.response.error)===null||b===void 0?void 0:b.code,M=T!=null?T:i.data.response.code,M!=null?M:1)};i.data.response.error=A?I:null})(c);var O=(e=(s=c.data.response)===null||s===void 0?void 0:s.id)!=null?e:void 0;return{response:new v.JsonRpcResponse(function(i,o){return o&&P.isJsonRpcBatchRequestPayload(i)&&i.batch.find(function(R){return R.id===o})||i}(n,O)).applyResult((r=c.data.response)===null||r===void 0?void 0:r.result).applyError((f=c.data.response)===null||f===void 0?void 0:f.error),id:(w=(l=c.data.response)===null||l===void 0?void 0:l.id,w!=null?w:void 0)}}var y=function(){function n(c,s){this.endpoint=c,this.encodedQueryParams=s,this.messageHandlers=new Set,this.initMessageListener()}return n.prototype.post=function(c,s,e){return t(this,void 0,void 0,function(){var r,f=this;return _(this,function(l){switch(l.label){case 0:return[4,c.iframe];case 1:return r=l.sent(),[2,new Promise(function(w,O){if(r.contentWindow){var i=[],o=P.isJsonRpcBatchRequestPayload(e)?e.batch.map(function(T){return T.id}):[];r.contentWindow.postMessage({msgType:s+"-"+f.encodedQueryParams,payload:e},"*");var R=f.on(u.FmIncomingWindowMessage.FORTMATIC_HANDLE_RESPONSE,(b=function(){R(),m()},function(T){var M=g(e,T),A=M.id,I=M.response;A&&P.isJsonRpcBatchRequestPayload(e)&&o.includes(A)?(i.push(I.payload),i.length===e.batch.length&&(b(),w(i))):A&&A===e.id&&(b(),w(I.payload))})),m=f.on(u.FmIncomingWindowMessage.FORTMATIC_USER_DENIED,function(T){return function(M){var A=g(e,M),I=A.id,S=A.response,E={message:"Fortmatic: Modal was closed without executing action!",code:1},j=S.hasError?S.payload:S.applyError(E).payload;if(I&&P.isJsonRpcBatchRequestPayload(e)&&o.includes(I)){i.push(j);for(var k=i.length;k<e.batch.length;k++)i.push(new v.JsonRpcResponse(e.batch[k]).applyError(E).payload);T(),w(i)}else I&&I===e.id&&(T(),w(j))}}(function(){m(),R()}))}else O(h.createModalNotReadyError());var b})]}})})},n.prototype.on=function(c,s){var e=this,r=s.bind(window),f=function(l){l.data.msgType===c+"-"+e.encodedQueryParams&&r(l)};return this.messageHandlers.add(f),function(){return e.messageHandlers.delete(f)}},n.prototype.initMessageListener=function(){var c=this;window.addEventListener("message",function(s){var e,r,f;if(s.origin===c.endpoint&&s.data&&s.data.msgType&&c.messageHandlers.size){s.data.response=(f=s.data.response)!=null?f:{};try{for(var l=p(c.messageHandlers.values()),w=l.next();!w.done;w=l.next())(0,w.value)(s)}catch(O){e={error:O}}finally{try{w&&!w.done&&(r=l.return)&&r.call(l)}finally{if(e)throw e.error}}}})},n}();a.FmPayloadTransport=y},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var t=d(4),_=function(){function p(u){u instanceof p?(this._jsonrpc=u.payload.jsonrpc,this._id=u.payload.id,this._result=u.payload.result,this._error=u.payload.error):t.isJsonRpcResponsePayload(u)?(this._jsonrpc=u.jsonrpc,this._id=u.id,this._result=u.result,this._error=u.error):(this._jsonrpc=u.jsonrpc,this._id=u.id,this._result=null,this._error=null)}return p.prototype.applyError=function(u){return this._error=u,this},p.prototype.applyResult=function(u){return this._result=u,this},Object.defineProperty(p.prototype,"hasError",{get:function(){return this._error!==void 0&&this._error!==null},enumerable:!0,configurable:!0}),Object.defineProperty(p.prototype,"hasResult",{get:function(){return this._result!==void 0&&this._result!==null},enumerable:!0,configurable:!0}),Object.defineProperty(p.prototype,"payload",{get:function(){return{jsonrpc:this._jsonrpc,id:this._id,result:this._result,error:this._error}},enumerable:!0,configurable:!0}),p}();a.JsonRpcResponse=_},function(F,a,d){F.exports=d(9)},function(F,a,d){"use strict";var t=this&&this.__assign||function(){return(t=Object.assign||function(v){for(var h,g=1,y=arguments.length;g<y;g++)for(var n in h=arguments[g])Object.prototype.hasOwnProperty.call(h,n)&&(v[n]=h[n]);return v}).apply(this,arguments)},_=this&&this.__importStar||function(v){if(v&&v.__esModule)return v;var h={};if(v!=null)for(var g in v)Object.hasOwnProperty.call(v,g)&&(h[g]=v[g]);return h.default=v,h};Object.defineProperty(a,"__esModule",{value:!0});var p=d(10);a.default=p.Fortmatic;var u=d(2);a.FortmaticError=u.FortmaticError,a.FortmaticWarning=u.FortmaticWarning,a.RpcError=u.RpcError;var P=_(d(0));Object.assign(p.Fortmatic,t(t({},P),{FortmaticError:u.FortmaticError,FortmaticWarning:u.FortmaticWarning,RpcError:u.RpcError})),function(v){for(var h in v)a.hasOwnProperty(h)||(a[h]=v[h])}(d(0))},function(F,a,d){"use strict";var t,_=this&&this.__extends||(t=function(i,o){return(t=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(R,m){R.__proto__=m}||function(R,m){for(var b in m)m.hasOwnProperty(b)&&(R[b]=m[b])})(i,o)},function(i,o){function R(){this.constructor=i}t(i,o),i.prototype=o===null?Object.create(o):(R.prototype=o.prototype,new R)}),p=this&&this.__awaiter||function(i,o,R,m){return new(R||(R=Promise))(function(b,T){function M(S){try{I(m.next(S))}catch(E){T(E)}}function A(S){try{I(m.throw(S))}catch(E){T(E)}}function I(S){var E;S.done?b(S.value):(E=S.value,E instanceof R?E:new R(function(j){j(E)})).then(M,A)}I((m=m.apply(i,o||[])).next())})},u=this&&this.__generator||function(i,o){var R,m,b,T,M={label:0,sent:function(){if(1&b[0])throw b[1];return b[1]},trys:[],ops:[]};return T={next:A(0),throw:A(1),return:A(2)},typeof Symbol=="function"&&(T[Symbol.iterator]=function(){return this}),T;function A(I){return function(S){return function(E){if(R)throw new TypeError("Generator is already executing.");for(;M;)try{if(R=1,m&&(b=2&E[0]?m.return:E[0]?m.throw||((b=m.return)&&b.call(m),0):m.next)&&!(b=b.call(m,E[1])).done)return b;switch(m=0,b&&(E=[2&E[0],b.value]),E[0]){case 0:case 1:b=E;break;case 4:return M.label++,{value:E[1],done:!1};case 5:M.label++,m=E[1],E=[0];continue;case 7:E=M.ops.pop(),M.trys.pop();continue;default:if(!(b=(b=M.trys).length>0&&b[b.length-1])&&(E[0]===6||E[0]===2)){M=0;continue}if(E[0]===3&&(!b||E[1]>b[0]&&E[1]<b[3])){M.label=E[1];break}if(E[0]===6&&M.label<b[1]){M.label=b[1],b=E;break}if(b&&M.label<b[2]){M.label=b[2],M.ops.push(E);break}b[2]&&M.ops.pop(),M.trys.pop();continue}E=o.call(i,M)}catch(j){E=[6,j],m=0}finally{R=b=0}if(5&E[0])throw E[1];return{value:E[0]?E[1]:void 0,done:!0}}([I,S])}}};Object.defineProperty(a,"__esModule",{value:!0});var P=d(11),v=d(12),h=d(19),g=d(20),y=d(0),n=d(3),c=d(1),s=d(21),e=d(23),r=d(24),f=d(2),l=function(){function i(o){if(!o.apiKey)throw f.createMissingApiKeyError();this.apiKey=o.apiKey,this.gsnRelay=o.gsnRelay,this.endpoint=new URL(o.endpoint).origin,this.encodedQueryParams=e.encodeQueryParameters({API_KEY:this.apiKey,DOMAIN_ORIGIN:window.location?window.location.origin:"",ETH_NETWORK:o.ethNetwork,host:new URL(this.endpoint).host,sdk:r.name,version:r.version,gsnRelay:o.gsnRelay})}return i.prototype.getProvider=function(){return i.__provider__.has(this.encodedQueryParams)||i.__provider__.set(this.encodedQueryParams,new s.FmProvider(this.endpoint,this.apiKey,this.encodedQueryParams)),i.__provider__.get(this.encodedQueryParams)},i.__provider__=new Map,i}();a.SDK=l;var w=function(i){function o(R,m){var b=i.call(this,{apiKey:R,ethNetwork:m,endpoint:P.PHANTOM_URL})||this;return b.user=new v.PhantomUser(b),b}return _(o,i),o.prototype.loginWithMagicLink=function(R){return p(this,void 0,void 0,function(){var m,b,T,M;return u(this,function(A){switch(A.label){case 0:return m=R.email,b=R.showUI,T=b===void 0||b,M=c.createJsonRpcRequestPayload(y.FmPayloadMethod.fm_auth_login_with_magic_link,[{email:m,showUI:T}]),[4,n.emitFortmaticPayload(this.getProvider(),M)];case 1:return A.sent(),[2,this.user]}})})},o}(l);a.PhantomMode=w;var O=function(i){function o(R,m,b){b===void 0&&(b={gsnRelay:!1});var T=i.call(this,{apiKey:R,ethNetwork:m,endpoint:P.WIDGET_URL,gsnRelay:b.gsnRelay})||this;return T.transactions=new h.TransactionsModule(T),T.user=new g.UserModule(T),T}return _(o,i),o.prototype.configure=function(R){R===void 0&&(R={});var m=c.createJsonRpcRequestPayload(y.FmPayloadMethod.fm_configure,[R]);return n.emitFortmaticPayload(this.getProvider(),m)},o.Phantom=w,o}(l);a.WidgetMode=O,a.Fortmatic=O},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),a.WIDGET_URL="https://x2.fortmatic.com",a.PHANTOM_URL="https://auth.fortmatic.com"},function(F,a,d){"use strict";var t,_=this&&this.__extends||(t=function(h,g){return(t=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(y,n){y.__proto__=n}||function(y,n){for(var c in n)n.hasOwnProperty(c)&&(y[c]=n[c])})(h,g)},function(h,g){function y(){this.constructor=h}t(h,g),h.prototype=g===null?Object.create(g):(y.prototype=g.prototype,new y)});Object.defineProperty(a,"__esModule",{value:!0});var p=d(0),u=d(3),P=d(1),v=function(h){function g(){return h!==null&&h.apply(this,arguments)||this}return _(g,h),g.prototype.getIdToken=function(y){var n=P.createJsonRpcRequestPayload(p.FmPayloadMethod.fm_auth_get_access_token,[y]);return u.emitFortmaticPayload(this.sdk.getProvider(),n)},g.prototype.getMetadata=function(){var y=P.createJsonRpcRequestPayload(p.FmPayloadMethod.fm_auth_get_metadata);return u.emitFortmaticPayload(this.sdk.getProvider(),y)},g.prototype.isLoggedIn=function(){var y=P.createJsonRpcRequestPayload(p.FmPayloadMethod.fm_is_logged_in);return u.emitFortmaticPayload(this.sdk.getProvider(),y)},g.prototype.logout=function(){var y=P.createJsonRpcRequestPayload(p.FmPayloadMethod.fm_auth_logout);return u.emitFortmaticPayload(this.sdk.getProvider(),y)},g}(d(5).BaseModule);a.PhantomUser=v},function(F,a,d){"use strict";function t(_){for(var p in _)a.hasOwnProperty(p)||(a[p]=_[p])}Object.defineProperty(a,"__esModule",{value:!0}),t(d(14)),t(d(15)),t(d(16))},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),function(t){t.fm_composeSend="fm_composeSend",t.fm_logout="fm_logout",t.fm_get_balances="fm_get_balances",t.fm_get_transactions="fm_get_transactions",t.fm_is_logged_in="fm_is_logged_in",t.fm_accountSettings="fm_accountSettings",t.fm_deposit="fm_deposit",t.fm_get_user="fm_get_user",t.fm_configure="fm_configure",t.fm_auth_login_with_magic_link="fm_auth_login_with_magic_link",t.fm_auth_get_access_token="fm_auth_get_access_token",t.fm_auth_get_metadata="fm_auth_get_metadata",t.fm_auth_logout="fm_auth_logout"}(a.FmPayloadMethod||(a.FmPayloadMethod={}))},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),function(t){t.FORTMATIC_HANDLE_RESPONSE="FORTMATIC_HANDLE_RESPONSE",t.FORTMATIC_OVERLAY_READY="FORTMATIC_OVERLAY_READY",t.FORTMATIC_SHOW_OVERLAY="FORTMATIC_SHOW_OVERLAY",t.FORTMATIC_HIDE_OVERLAY="FORTMATIC_HIDE_OVERLAY",t.FORTMATIC_USER_DENIED="FORTMATIC_USER_DENIED",t.FORTMATIC_USER_LOGOUT="FORTMATIC_USER_LOGOUT"}(a.FmIncomingWindowMessage||(a.FmIncomingWindowMessage={})),function(t){t.FORTMATIC_HANDLE_BATCH_REQUEST="FORTMATIC_HANDLE_BATCH_REQUEST",t.FORTMATIC_HANDLE_REQUEST="FORTMATIC_HANDLE_REQUEST",t.FORTMATIC_HANDLE_FORTMATIC_REQUEST="FORTMATIC_HANDLE_FORTMATIC_REQUEST"}(a.FmOutgoingWindowMessage||(a.FmOutgoingWindowMessage={}))},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),function(t){t.MissingApiKey="MISSING_API_KEY",t.ModalNotReady="MODAL_NOT_READY",t.InvalidArgument="INVALID_ARGUMENT"}(a.SDKErrorCode||(a.SDKErrorCode={})),function(t){t.SyncWeb3Method="SYNC_WEB3_METHOD",t.DuplicateIframe="DUPLICATE_IFRAME"}(a.SDKWarningCode||(a.SDKWarningCode={})),function(t){t[t.ParseError=-32700]="ParseError",t[t.InvalidRequest=-32600]="InvalidRequest",t[t.MethodNotFound=-32601]="MethodNotFound",t[t.InvalidParams=-32602]="InvalidParams",t[t.InternalError=-32603]="InternalError",t[t.MagicLinkFailedVerification=-1e4]="MagicLinkFailedVerification",t[t.MagicLinkExpired=-10001]="MagicLinkExpired",t[t.MagicLinkRateLimited=-10002]="MagicLinkRateLimited",t[t.UserAlreadyLoggedIn=-10003]="UserAlreadyLoggedIn"}(a.RPCErrorCode||(a.RPCErrorCode={}))},function(F,a,d){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),function(t){t.LoginWithEmail="email",t.LoginWithPhone="phone"}(a.WidgetModePrimaryLoginOption||(a.WidgetModePrimaryLoginOption={}))},function(F,a,d){"use strict";var t=this&&this.__generator||function(p,u){var P,v,h,g,y={label:0,sent:function(){if(1&h[0])throw h[1];return h[1]},trys:[],ops:[]};return g={next:n(0),throw:n(1),return:n(2)},typeof Symbol=="function"&&(g[Symbol.iterator]=function(){return this}),g;function n(c){return function(s){return function(e){if(P)throw new TypeError("Generator is already executing.");for(;y;)try{if(P=1,v&&(h=2&e[0]?v.return:e[0]?v.throw||((h=v.return)&&h.call(v),0):v.next)&&!(h=h.call(v,e[1])).done)return h;switch(v=0,h&&(e=[2&e[0],h.value]),e[0]){case 0:case 1:h=e;break;case 4:return y.label++,{value:e[1],done:!1};case 5:y.label++,v=e[1],e=[0];continue;case 7:e=y.ops.pop(),y.trys.pop();continue;default:if(!(h=(h=y.trys).length>0&&h[h.length-1])&&(e[0]===6||e[0]===2)){y=0;continue}if(e[0]===3&&(!h||e[1]>h[0]&&e[1]<h[3])){y.label=e[1];break}if(e[0]===6&&y.label<h[1]){y.label=h[1],h=e;break}if(h&&y.label<h[2]){y.label=h[2],y.ops.push(e);break}h[2]&&y.ops.pop(),y.trys.pop();continue}e=u.call(p,y)}catch(r){e=[6,r],v=0}finally{P=h=0}if(5&e[0])throw e[1];return{value:e[0]?e[1]:void 0,done:!0}}([c,s])}}};Object.defineProperty(a,"__esModule",{value:!0});var _=function(){var p;return t(this,function(u){switch(u.label){case 0:p=0,u.label=1;case 1:return p<Number.MAX_SAFE_INTEGER?[4,++p]:[3,3];case 2:return u.sent(),[3,4];case 3:p=0,u.label=4;case 4:return[3,1];case 5:return[2]}})}();a.getPayloadId=function(){return _.next().value}},function(F,a,d){"use strict";var t,_=this&&this.__extends||(t=function(v,h){return(t=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(g,y){g.__proto__=y}||function(g,y){for(var n in y)y.hasOwnProperty(n)&&(g[n]=y[n])})(v,h)},function(v,h){function g(){this.constructor=v}t(v,h),v.prototype=h===null?Object.create(h):(g.prototype=h.prototype,new g)});Object.defineProperty(a,"__esModule",{value:!0});var p=d(0),u=d(1),P=function(v){function h(){return v!==null&&v.apply(this,arguments)||this}return _(h,v),h.prototype.send=function(g,y){var n=u.createJsonRpcRequestPayload(p.FmPayloadMethod.fm_composeSend,g);this.sdk.getProvider().sendFortmaticAsync(n,y)},h}(d(5).BaseModule);a.TransactionsModule=P},function(F,a,d){"use strict";var t,_=this&&this.__extends||(t=function(y,n){return(t=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(c,s){c.__proto__=s}||function(c,s){for(var e in s)s.hasOwnProperty(e)&&(c[e]=s[e])})(y,n)},function(y,n){function c(){this.constructor=y}t(y,n),y.prototype=n===null?Object.create(n):(c.prototype=n.prototype,new c)}),p=this&&this.__awaiter||function(y,n,c,s){return new(c||(c=Promise))(function(e,r){function f(O){try{w(s.next(O))}catch(i){r(i)}}function l(O){try{w(s.throw(O))}catch(i){r(i)}}function w(O){var i;O.done?e(O.value):(i=O.value,i instanceof c?i:new c(function(o){o(i)})).then(f,l)}w((s=s.apply(y,n||[])).next())})},u=this&&this.__generator||function(y,n){var c,s,e,r,f={label:0,sent:function(){if(1&e[0])throw e[1];return e[1]},trys:[],ops:[]};return r={next:l(0),throw:l(1),return:l(2)},typeof Symbol=="function"&&(r[Symbol.iterator]=function(){return this}),r;function l(w){return function(O){return function(i){if(c)throw new TypeError("Generator is already executing.");for(;f;)try{if(c=1,s&&(e=2&i[0]?s.return:i[0]?s.throw||((e=s.return)&&e.call(s),0):s.next)&&!(e=e.call(s,i[1])).done)return e;switch(s=0,e&&(i=[2&i[0],e.value]),i[0]){case 0:case 1:e=i;break;case 4:return f.label++,{value:i[1],done:!1};case 5:f.label++,s=i[1],i=[0];continue;case 7:i=f.ops.pop(),f.trys.pop();continue;default:if(!(e=(e=f.trys).length>0&&e[e.length-1])&&(i[0]===6||i[0]===2)){f=0;continue}if(i[0]===3&&(!e||i[1]>e[0]&&i[1]<e[3])){f.label=i[1];break}if(i[0]===6&&f.label<e[1]){f.label=e[1],e=i;break}if(e&&f.label<e[2]){f.label=e[2],f.ops.push(i);break}e[2]&&f.ops.pop(),f.trys.pop();continue}i=n.call(y,f)}catch(o){i=[6,o],s=0}finally{c=e=0}if(5&i[0])throw i[1];return{value:i[0]?i[1]:void 0,done:!0}}([w,O])}}};Object.defineProperty(a,"__esModule",{value:!0});var P=d(0),v=d(3),h=d(1),g=function(y){function n(){return y!==null&&y.apply(this,arguments)||this}return _(n,y),n.prototype.login=function(){return p(this,void 0,void 0,function(){return u(this,function(c){return[2,this.sdk.getProvider().enable()]})})},n.prototype.logout=function(){var c=h.createJsonRpcRequestPayload(P.FmPayloadMethod.fm_logout);return v.emitFortmaticPayload(this.sdk.getProvider(),c)},n.prototype.getUser=function(){var c=h.createJsonRpcRequestPayload(P.FmPayloadMethod.fm_get_user);return v.emitFortmaticPayload(this.sdk.getProvider(),c)},n.prototype.getBalances=function(){var c=h.createJsonRpcRequestPayload(P.FmPayloadMethod.fm_get_balances);return v.emitFortmaticPayload(this.sdk.getProvider(),c)},n.prototype.getTransactions=function(){var c=h.createJsonRpcRequestPayload(P.FmPayloadMethod.fm_get_transactions);return v.emitFortmaticPayload(this.sdk.getProvider(),c)},n.prototype.isLoggedIn=function(){var c=h.createJsonRpcRequestPayload(P.FmPayloadMethod.fm_is_logged_in);return v.emitFortmaticPayload(this.sdk.getProvider(),c)},n.prototype.settings=function(){var c=h.createJsonRpcRequestPayload(P.FmPayloadMethod.fm_accountSettings);return v.emitFortmaticPayload(this.sdk.getProvider(),c)},n.prototype.deposit=function(c){var s=h.createJsonRpcRequestPayload(P.FmPayloadMethod.fm_deposit,[c||{}]);return v.emitFortmaticPayload(this.sdk.getProvider(),s)},n}(d(5).BaseModule);a.UserModule=g},function(F,a,d){"use strict";var t=this&&this.__awaiter||function(s,e,r,f){return new(r||(r=Promise))(function(l,w){function O(R){try{o(f.next(R))}catch(m){w(m)}}function i(R){try{o(f.throw(R))}catch(m){w(m)}}function o(R){var m;R.done?l(R.value):(m=R.value,m instanceof r?m:new r(function(b){b(m)})).then(O,i)}o((f=f.apply(s,e||[])).next())})},_=this&&this.__generator||function(s,e){var r,f,l,w,O={label:0,sent:function(){if(1&l[0])throw l[1];return l[1]},trys:[],ops:[]};return w={next:i(0),throw:i(1),return:i(2)},typeof Symbol=="function"&&(w[Symbol.iterator]=function(){return this}),w;function i(o){return function(R){return function(m){if(r)throw new TypeError("Generator is already executing.");for(;O;)try{if(r=1,f&&(l=2&m[0]?f.return:m[0]?f.throw||((l=f.return)&&l.call(f),0):f.next)&&!(l=l.call(f,m[1])).done)return l;switch(f=0,l&&(m=[2&m[0],l.value]),m[0]){case 0:case 1:l=m;break;case 4:return O.label++,{value:m[1],done:!1};case 5:O.label++,f=m[1],m=[0];continue;case 7:m=O.ops.pop(),O.trys.pop();continue;default:if(!(l=(l=O.trys).length>0&&l[l.length-1])&&(m[0]===6||m[0]===2)){O=0;continue}if(m[0]===3&&(!l||m[1]>l[0]&&m[1]<l[3])){O.label=m[1];break}if(m[0]===6&&O.label<l[1]){O.label=l[1],l=m;break}if(l&&O.label<l[2]){O.label=l[2],O.ops.push(m);break}l[2]&&O.ops.pop(),O.trys.pop();continue}m=e.call(s,O)}catch(b){m=[6,b],f=0}finally{r=l=0}if(5&m[0])throw m[1];return{value:m[0]?m[1]:void 0,done:!0}}([o,R])}}};Object.defineProperty(a,"__esModule",{value:!0});var p=d(0),u=d(3),P=d(1),v=d(4),h=d(22),g=d(6),y=d(7),n=d(2),c=function(){function s(e,r,f){this.apiKey=r,this.isFortmatic=!0,this.queue=[],this.overlay=new h.FmIframeController(e,f),this.payloadTransport=new g.FmPayloadTransport(e,f),this.listen()}return s.prototype.sendAsync=function(e,r){if(!r)throw n.createInvalidArgumentError({functionName:"sendAsync",argIndex:1,expected:"function",received:r===null?"null":typeof r});if(Array.isArray(e))return this.enqueue({onRequestComplete:r,payload:P.createJsonRpcBatchRequestPayload(e)});var f=P.standardizeRequestPayload(e);return v.isJsonRpcBatchRequestPayload(f),this.enqueue({onRequestComplete:r,payload:f})},s.prototype.sendFortmaticAsync=function(e,r){if(!r)throw n.createInvalidArgumentError({functionName:"sendFortmaticAsync",argIndex:1,expected:"function",received:r===null?"null":typeof r});var f=P.standardizeRequestPayload(e);this.enqueue({onRequestComplete:r,payload:f,isFortmaticMethod:!0})},s.prototype.send=function(e,r){return typeof e=="string"?u.emitWeb3Payload(this,e,r):r?void this.sendAsync(e,r):(n.createSynchronousWeb3MethodWarning().log(),new y.JsonRpcResponse(e).applyError({code:-32603,message:"Non-async web3 methods will be deprecated in web3 > 1.0 and are not supported by the Fortmatic provider. An async method is to be used instead."}).payload)},s.prototype.enable=function(){return u.emitWeb3Payload(this,"eth_accounts")},s.prototype.request=function(e){return t(this,void 0,void 0,function(){return _(this,function(r){return[2,u.emitWeb3Payload(this,e.method,e.params)]})})},s.prototype.on=function(e,r){return console.warn("Fortmatic doesn't support event emit!"),function(){}},s.prototype.enqueue=function(e){e&&(this.queue.push(e),this.overlay.overlayReady&&this.dequeue())},s.prototype.dequeue=function(){return t(this,void 0,void 0,function(){var e,r,f,l;return _(this,function(w){switch(w.label){case 0:return this.queue.length===0?[2]:(e=this.queue.shift())?(r=e.payload,v.isJsonRpcBatchRequestPayload(r)?r.batch.length===0?[2,e.onRequestComplete(null,[])]:[4,this.payloadTransport.post(this.overlay,p.FmOutgoingWindowMessage.FORTMATIC_HANDLE_REQUEST,r)]:[3,2]):[3,5];case 1:f=w.sent(),e.onRequestComplete(null,f),w.label=2;case 2:return v.isJsonRpcRequestPayload(r)?[4,this.payloadTransport.post(this.overlay,e.isFortmaticMethod?p.FmOutgoingWindowMessage.FORTMATIC_HANDLE_FORTMATIC_REQUEST:p.FmOutgoingWindowMessage.FORTMATIC_HANDLE_REQUEST,r)]:[3,4];case 3:(l=w.sent()).error?e.onRequestComplete(new n.RpcError(l.error),l):e.onRequestComplete(null,l),w.label=4;case 4:this.dequeue(),w.label=5;case 5:return[2]}})})},s.prototype.listen=function(){var e=this;this.payloadTransport.on(p.FmIncomingWindowMessage.FORTMATIC_OVERLAY_READY,function(){e.dequeue()}),this.payloadTransport.on(p.FmIncomingWindowMessage.FORTMATIC_USER_DENIED,function(){e.queue.forEach(function(r){var f=new y.JsonRpcResponse(r.payload),l={message:"Fortmatic: Modal was closed without executing action!",code:1};r.onRequestComplete(new n.RpcError(l),f.applyError(l).payload)}),e.queue.slice(0)})},s}();a.FmProvider=c},function(F,a,d){"use strict";var t=this&&this.__awaiter||function(n,c,s,e){return new(s||(s=Promise))(function(r,f){function l(i){try{O(e.next(i))}catch(o){f(o)}}function w(i){try{O(e.throw(i))}catch(o){f(o)}}function O(i){var o;i.done?r(i.value):(o=i.value,o instanceof s?o:new s(function(R){R(o)})).then(l,w)}O((e=e.apply(n,c||[])).next())})},_=this&&this.__generator||function(n,c){var s,e,r,f,l={label:0,sent:function(){if(1&r[0])throw r[1];return r[1]},trys:[],ops:[]};return f={next:w(0),throw:w(1),return:w(2)},typeof Symbol=="function"&&(f[Symbol.iterator]=function(){return this}),f;function w(O){return function(i){return function(o){if(s)throw new TypeError("Generator is already executing.");for(;l;)try{if(s=1,e&&(r=2&o[0]?e.return:o[0]?e.throw||((r=e.return)&&r.call(e),0):e.next)&&!(r=r.call(e,o[1])).done)return r;switch(e=0,r&&(o=[2&o[0],r.value]),o[0]){case 0:case 1:r=o;break;case 4:return l.label++,{value:o[1],done:!1};case 5:l.label++,e=o[1],o=[0];continue;case 7:o=l.ops.pop(),l.trys.pop();continue;default:if(!(r=(r=l.trys).length>0&&r[r.length-1])&&(o[0]===6||o[0]===2)){l=0;continue}if(o[0]===3&&(!r||o[1]>r[0]&&o[1]<r[3])){l.label=o[1];break}if(o[0]===6&&l.label<r[1]){l.label=r[1],r=o;break}if(r&&l.label<r[2]){l.label=r[2],l.ops.push(o);break}r[2]&&l.ops.pop(),l.trys.pop();continue}o=c.call(n,l)}catch(R){o=[6,R],e=0}finally{s=r=0}if(5&o[0])throw o[1];return{value:o[0]?o[1]:void 0,done:!0}}([O,i])}}},p=this&&this.__values||function(n){var c=typeof Symbol=="function"&&Symbol.iterator,s=c&&n[c],e=0;if(s)return s.call(n);if(n&&typeof n.length=="number")return{next:function(){return n&&e>=n.length&&(n=void 0),{value:n&&n[e++],done:!n}}};throw new TypeError(c?"Object is not iterable.":"Symbol.iterator is not defined.")},u=this&&this.__read||function(n,c){var s=typeof Symbol=="function"&&n[Symbol.iterator];if(!s)return n;var e,r,f=s.call(n),l=[];try{for(;(c===void 0||c-- >0)&&!(e=f.next()).done;)l.push(e.value)}catch(w){r={error:w}}finally{try{e&&!e.done&&(s=f.return)&&s.call(f)}finally{if(r)throw r.error}}return l};Object.defineProperty(a,"__esModule",{value:!0});var P=d(0),v=d(6),h=d(2),g={display:"none",position:"fixed",top:"0",right:"0",width:"100%",height:"100%",borderRadius:"0",border:"none",zIndex:"2147483647"},y=function(){function n(c,s){this.endpoint=c,this.encodedQueryParams=s,this._overlayReady=!1,this.iframe=this.init(),this.payloadTransport=new v.FmPayloadTransport(c,s),this.listen()}return Object.defineProperty(n.prototype,"overlayReady",{get:function(){return this._overlayReady},enumerable:!0,configurable:!0}),n.prototype.init=function(){var c=this;return new Promise(function(s){var e=function(){if(l=c.encodedQueryParams,w=[].slice.call(document.querySelectorAll(".fortmatic-iframe")),!!w.find(function(O){var i;return(i=O.src)===null||i===void 0?void 0:i.includes(l)}))h.createDuplicateIframeWarning().log();else{var r=document.createElement("iframe");r.classList.add("fortmatic-iframe"),r.dataset.fortmaticIframeLabel=new URL(c.endpoint).host,r.src=new URL("/send?params="+c.encodedQueryParams,c.endpoint).href,function(O){var i,o;try{for(var R=p(Object.entries(g)),m=R.next();!m.done;m=R.next()){var b=u(m.value,2),T=b[0],M=b[1];O.style[T]=M}}catch(A){i={error:A}}finally{try{m&&!m.done&&(o=R.return)&&o.call(R)}finally{if(i)throw i.error}}}(r),document.body.appendChild(r);var f=document.createElement("img");f.src="https://static.fortmatic.com/assets/trans.gif",f.style.position="fixed",document.body.appendChild(f),s(r)}var l,w};["loaded","interactive","complete"].includes(document.readyState)?e():window.addEventListener("load",e,!1)})},n.prototype.showOverlay=function(){return t(this,void 0,void 0,function(){return _(this,function(c){switch(c.label){case 0:return[4,this.iframe];case 1:return c.sent().style.display="block",[2]}})})},n.prototype.hideOverlay=function(){return t(this,void 0,void 0,function(){return _(this,function(c){switch(c.label){case 0:return[4,this.iframe];case 1:return c.sent().style.display="none",[2]}})})},n.prototype.listen=function(){var c=this;this.payloadTransport.on(P.FmIncomingWindowMessage.FORTMATIC_OVERLAY_READY,function(){c._overlayReady=!0}),this.payloadTransport.on(P.FmIncomingWindowMessage.FORTMATIC_HIDE_OVERLAY,function(){c.hideOverlay()}),this.payloadTransport.on(P.FmIncomingWindowMessage.FORTMATIC_SHOW_OVERLAY,function(){c.showOverlay()})},n}();a.FmIframeController=y},function(F,a,d){"use strict";var t;Object.defineProperty(a,"__esModule",{value:!0}),function(_){_.HARMONY="HARMONY"}(t||(t={})),a.encodeQueryParameters=function(_){return btoa(JSON.stringify(_))},a.decodeQueryParameters=function(_){return JSON.parse(atob(_))}},function(F){F.exports=JSON.parse('{"name":"fortmatic","version":"2.4.0","description":"Fortmatic Javascript SDK","author":"Fortmatic <team@fortmatic.com> (https://fortmatic.com/)","license":"MIT","repository":{"type":"git","url":"https://github.com/fortmatic/fortmatic-js"},"keywords":["auth","login","web3","crypto","ethereum","metaMask","wallet","blockchain","dapp"],"homepage":"https://www.fortmatic.com","main":"dist/cjs/fortmatic.js","types":"dist/cjs/src/index.d.ts","scripts":{"start":"npm run clean:build && ./scripts/start.sh","build":"npm run clean:build && ./scripts/build.sh","test":"npm run clean:test-artifacts && ./scripts/test.sh","lint":"eslint --fix src/**/*.ts","clean":"npm-run-all -s clean:*","clean:test-artifacts":"rimraf coverage && rimraf .nyc_output","clean:build":"rimraf dist","clean_node_modules":"rimraf node_modules"},"dependencies":{},"devDependencies":{"@ikscodes/browser-env":"~0.3.1","@ikscodes/eslint-config":"~6.2.0","@ikscodes/prettier-config":"^0.1.0","@istanbuljs/nyc-config-typescript":"~0.1.3","@types/jsdom":"~12.2.4","@types/sinon":"~7.5.0","@types/webpack":"~4.41.0","@typescript-eslint/eslint-plugin":"~2.17.0","ava":"2.2.0","cross-env":"~6.0.3","eslint":"~6.8.0","eslint-import-resolver-typescript":"~2.0.0","eslint-plugin-import":"~2.20.0","eslint-plugin-jsx-a11y":"~6.2.3","eslint-plugin-prettier":"~3.1.2","eslint-plugin-react":"~7.18.0","eslint-plugin-react-hooks":"~1.7.0","lodash":"~4.17.15","npm-run-all":"~4.1.5","nyc":"13.1.0","prettier":"~1.19.1","rimraf":"~3.0.0","sinon":"7.1.1","ts-loader":"~6.2.1","ts-node":"~8.5.2","typescript":"~3.7.2","webpack":"~4.41.2","webpack-chain":"~6.2.0","webpack-cli":"~3.3.10"},"ava":{"require":["ts-node/register"],"files":["test/**/*.spec.ts"],"extensions":["ts"],"compileEnhancements":false,"verbose":true},"nyc":{"extends":"@istanbuljs/nyc-config-typescript","all":false,"check-coverage":true,"per-file":true,"lines":99,"statements":99,"functions":99,"branches":99,"reporter":["html","lcov"]}}')}]).default}}]);
