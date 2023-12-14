typeof Object.create!="function"&&(Object.create=function(i){function n(){}return n.prototype=i,new n}),function(i,n,r,h){var a={_positionClasses:["bottom-left","bottom-right","top-right","top-left","bottom-center","top-center","mid-center"],_defaultIcons:["success","error","info","warning"],init:function(t,o){this.prepareOptions(t,i.toast.options),this.process()},prepareOptions:function(t,o){var s={};typeof t=="string"||t instanceof Array?s.text=t:s=t,this.options=i.extend({},o,s)},process:function(){this.setup(),this.addToDom(),this.position(),this.bindToast(),this.animate()},setup:function(){var t="";if(this._toastEl=this._toastEl||i("<div></div>",{class:"jq-toast-single"}),t+='<span class="jq-toast-loader"></span>',this.options.allowToastClose&&(t+='<span class="close-jq-toast-single">&times;</span>'),this.options.text instanceof Array){this.options.heading&&(t+='<h2 class="jq-toast-heading">'+this.options.heading+"</h2>"),t+='<ul class="jq-toast-ul">';for(var o=0;o<this.options.text.length;o++)t+='<li class="jq-toast-li" id="jq-toast-item-'+o+'">'+this.options.text[o]+"</li>";t+="</ul>"}else this.options.heading&&(t+='<h2 class="jq-toast-heading">'+this.options.heading+"</h2>"),t+=this.options.text;this._toastEl.html(t),this.options.bgColor!==!1&&this._toastEl.css("background-color",this.options.bgColor),this.options.textColor!==!1&&this._toastEl.css("color",this.options.textColor),this.options.textAlign&&this._toastEl.css("text-align",this.options.textAlign),this.options.icon!==!1&&(this._toastEl.addClass("jq-has-icon"),i.inArray(this.options.icon,this._defaultIcons)!==-1&&this._toastEl.addClass("jq-icon-"+this.options.icon)),this.options.class!==!1&&this._toastEl.addClass(this.options.class)},position:function(){typeof this.options.position=="string"&&i.inArray(this.options.position,this._positionClasses)!==-1?this.options.position==="bottom-center"?this._container.css({left:i(n).outerWidth()/2-this._container.outerWidth()/2,bottom:20}):this.options.position==="top-center"?this._container.css({left:i(n).outerWidth()/2-this._container.outerWidth()/2,top:20}):this.options.position==="mid-center"?this._container.css({left:i(n).outerWidth()/2-this._container.outerWidth()/2,top:i(n).outerHeight()/2-this._container.outerHeight()/2}):this._container.addClass(this.options.position):typeof this.options.position=="object"?this._container.css({top:this.options.position.top?this.options.position.top:"auto",bottom:this.options.position.bottom?this.options.position.bottom:"auto",left:this.options.position.left?this.options.position.left:"auto",right:this.options.position.right?this.options.position.right:"auto"}):this._container.addClass("bottom-left")},bindToast:function(){var t=this;this._toastEl.on("afterShown",function(){t.processLoader()}),this._toastEl.find(".close-jq-toast-single").on("click",function(o){o.preventDefault(),t.options.showHideTransition==="fade"?(t._toastEl.trigger("beforeHide"),t._toastEl.fadeOut(function(){t._toastEl.trigger("afterHidden")})):t.options.showHideTransition==="slide"?(t._toastEl.trigger("beforeHide"),t._toastEl.slideUp(function(){t._toastEl.trigger("afterHidden")})):(t._toastEl.trigger("beforeHide"),t._toastEl.hide(function(){t._toastEl.trigger("afterHidden")}))}),typeof this.options.beforeShow=="function"&&this._toastEl.on("beforeShow",function(){t.options.beforeShow()}),typeof this.options.afterShown=="function"&&this._toastEl.on("afterShown",function(){t.options.afterShown()}),typeof this.options.beforeHide=="function"&&this._toastEl.on("beforeHide",function(){t.options.beforeHide()}),typeof this.options.afterHidden=="function"&&this._toastEl.on("afterHidden",function(){t.options.afterHidden()})},addToDom:function(){var t=i(".jq-toast-wrap");if(t.length===0?(t=i("<div></div>",{class:"jq-toast-wrap"}),i("body").append(t)):(!this.options.stack||isNaN(parseInt(this.options.stack,10)))&&t.empty(),t.find(".jq-toast-single:hidden").remove(),t.append(this._toastEl),this.options.stack&&!isNaN(parseInt(this.options.stack),10)){var o=t.find(".jq-toast-single").length,s=o-this.options.stack;s>0&&i(".jq-toast-wrap").find(".jq-toast-single").slice(0,s).remove()}this._container=t},canAutoHide:function(){return this.options.hideAfter!==!1&&!isNaN(parseInt(this.options.hideAfter,10))},processLoader:function(){if(!this.canAutoHide()||this.options.loader===!1)return!1;var t=this._toastEl.find(".jq-toast-loader"),o=(this.options.hideAfter-400)/1e3+"s",s=this.options.loaderBg,e=t.attr("style")||"";e=e.substring(0,e.indexOf("-webkit-transition")),e+="-webkit-transition: width "+o+" ease-in;                       -o-transition: width "+o+" ease-in;                       transition: width "+o+" ease-in;                       background-color: "+s+";",t.attr("style",e).addClass("jq-toast-loaded")},animate:function(){var t=this;if(this._toastEl.hide(),this._toastEl.trigger("beforeShow"),this.options.showHideTransition.toLowerCase()==="fade"?this._toastEl.fadeIn(function(){t._toastEl.trigger("afterShown")}):this.options.showHideTransition.toLowerCase()==="slide"?this._toastEl.slideDown(function(){t._toastEl.trigger("afterShown")}):this._toastEl.show(function(){t._toastEl.trigger("afterShown")}),this.canAutoHide()){var t=this;n.setTimeout(function(){t.options.showHideTransition.toLowerCase()==="fade"?(t._toastEl.trigger("beforeHide"),t._toastEl.fadeOut(function(){t._toastEl.trigger("afterHidden")})):t.options.showHideTransition.toLowerCase()==="slide"?(t._toastEl.trigger("beforeHide"),t._toastEl.slideUp(function(){t._toastEl.trigger("afterHidden")})):(t._toastEl.trigger("beforeHide"),t._toastEl.hide(function(){t._toastEl.trigger("afterHidden")}))},this.options.hideAfter)}},reset:function(t){t==="all"?i(".jq-toast-wrap").remove():this._toastEl.remove()},update:function(t){this.prepareOptions(t,this.options),this.setup(),this.bindToast()}};i.toast=function(t){var o=Object.create(a);return o.init(t,this),{reset:function(s){o.reset(s)},update:function(s){o.update(s)}}},i.toast.options={text:"",heading:"",showHideTransition:"fade",allowToastClose:!0,hideAfter:3e3,loader:!0,loaderBg:"#9EC600",stack:5,position:"bottom-left",bgColor:!1,textColor:!1,textAlign:"left",icon:!1,beforeShow:function(){},afterShown:function(){},beforeHide:function(){},afterHidden:function(){}}}(jQuery,window);
//# sourceMappingURL=jquery.toast.min-97d48b7b.js.map
