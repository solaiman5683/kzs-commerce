import{$ as m}from"./jquery-1242cc52.js";import{h as b}from"./moment-e9e012b5.js";import"./_commonjsHelpers-042e6b4d.js";import"./jquery-f89b34b5.js";window.$=m;window.jQuery=m;window.moment=b;(function(){var i=sessionStorage.getItem("__ATTEX_CONFIG__"),e=document.getElementsByTagName("html")[0],a={theme:"light",nav:"vertical",layout:{mode:"fluid",position:"fixed"},topbar:{color:"light"},menu:{color:"light"},sidenav:{size:"default",user:!1}},e=document.getElementsByTagName("html")[0];let t=Object.assign(JSON.parse(JSON.stringify(a)),{});var r=e.getAttribute("data-bs-theme");t.theme=r!==null?r:a.theme;var l=e.getAttribute("data-layout");t.nav=l!==null?l==="topnav"?"horizontal":"vertical":a.nav;var n=e.getAttribute("data-layout-mode");t.layout.mode=n!==null?n:a.layout.mode;var s=e.getAttribute("data-layout-position");t.layout.position=s!==null?s:a.layout.position;var u=e.getAttribute("data-topbar-color");t.topbar.color=u??a.topbar.color;var d=e.getAttribute("data-sidenav-size");t.sidenav.size=d!==null?d:a.sidenav.size;var f=e.getAttribute("data-sidenav-user");t.sidenav.user=f!==null?!0:a.sidenav.user;var v=e.getAttribute("data-menu-color");if(t.menu.color=v!==null?v:a.menu.color,window.defaultConfig=JSON.parse(JSON.stringify(t)),i!==null&&(t=JSON.parse(i)),window.config=t,e.getAttribute("data-layout")==="topnav"?t.nav="horizontal":t.nav="vertical",t&&(e.setAttribute("data-bs-theme",t.theme),e.setAttribute("data-layout-mode",t.layout.mode),e.setAttribute("data-menu-color",t.menu.color),e.setAttribute("data-topbar-color",t.topbar.color),e.setAttribute("data-layout-position",t.layout.position),t.nav=="vertical")){let o=t.sidenav.size;window.innerWidth<=767?o="full":window.innerWidth>=767&&window.innerWidth<=1140&&self.config.sidenav.size!=="full"&&self.config.sidenav.size!=="fullscreen"&&(o="condensed"),e.setAttribute("data-sidenav-size",o),t.sidenav.user&&t.sidenav.user.toString()==="true"?e.setAttribute("data-sidenav-user",!0):e.removeAttribute("data-sidenav-user")}})();
//# sourceMappingURL=head-398a8c15.js.map
