(function(t){var s=function(){this.$body=t("body"),this.$chatInput=t(".chat-input"),this.$chatList=t(".conversation-list"),this.$chatSendBtn=t(".chat-send"),this.$chatForm=t("#chat-form")};s.prototype.save=function(){var a=this.$chatInput.val(),i=moment().format("h:mm");return a==""?(this.$chatInput.focus(),!1):(t('<li class="clearfix odd"><div class="chat-avatar"><img src="/images/users/avatar-1.jpg" alt="male"><i>'+i+'</i></div><div class="conversation-text"><div class="ctext-wrap"><i>Dominic</i><p>'+a+"</p></div></div></li>").appendTo(".conversation-list"),this.$chatInput.focus(),this.$chatList.animate({scrollTop:this.$chatList.prop("scrollHeight")},1e3),!0)},s.prototype.init=function(){var a=this;a.$chatInput.keypress(function(i){var n=i.which;if(n==13)return a.save(),!1}),a.$chatForm.on("submit",function(i){return i.preventDefault(),a.save(),a.$chatForm.removeClass("was-validated"),a.$chatInput.val(""),!1})},t.ChatApp=new s,t.ChatApp.Constructor=s})(window.jQuery),function(t){t.ChatApp.init()}(window.jQuery);
//# sourceMappingURL=component.chat-2bac8885.js.map
