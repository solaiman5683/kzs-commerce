import"./chart.min-438885df.js";import"./_commonjsHelpers-042e6b4d.js";(function(l){var s=function(){this.$body=l("body"),this.charts=[],this.defaultColors=["#3e60d5","#47ad77","#fa5c7c","#ffbc00"]};s.prototype.bubbleExample=function(){var a=document.getElementById("bubble-example"),e=a.getAttribute("data-colors"),t=e?e.split(","):this.defaultColors,r=a.getContext("2d"),o=new Chart(r,{type:"bubble",data:{labels:["Jan","Feb","March","April","May","June"],datasets:[{label:"Fully Rounded",data:[{x:10,y:20,r:5},{x:20,y:10,r:5},{x:15,y:15,r:5}],borderColor:t[0],backgroundColor:i(t[0],.3),borderWidth:2,borderSkipped:!1},{label:"Small Radius",data:[{x:12,y:22},{x:22,y:20},{x:5,y:15}],backgroundColor:i(t[1],.3),borderColor:t[1],borderWidth:2,borderSkipped:!1}]},options:{responsive:!0,maintainAspectRatio:!1,plugins:{legend:{display:!1,position:"top"}},scales:{x:{grid:{display:!1}},y:{grid:{display:!1}}}}});this.charts.push(o)},s.prototype.donutExample=function(){var a=document.getElementById("donut-example"),e=a.getAttribute("data-colors"),t=e?e.split(","):this.defaultColors,r=a.getContext("2d"),o=new Chart(r,{type:"doughnut",data:{labels:["Direct","Affilliate","Sponsored","E-mail"],datasets:[{data:[300,135,48,154],backgroundColor:t,borderColor:"transparent",borderWidth:"3"}]},options:{responsive:!0,maintainAspectRatio:!1,cutoutPercentage:60,plugins:{legend:{display:!1,position:"top"}}}});this.charts.push(o)},s.prototype.pieExample=function(){var a=document.getElementById("pie-example"),e=a.getAttribute("data-colors"),t=e?e.split(","):this.defaultColors,r=a.getContext("2d"),o=new Chart(r,{type:"pie",data:{labels:["Jan","Feb","March","April","May"],datasets:[{label:"Fully Rounded",data:[12,19,14,15,40],backgroundColor:t}]},options:{indexAxis:"y",responsive:!0,maintainAspectRatio:!1,plugins:{legend:{display:!1}}}});this.charts.push(o)},s.prototype.polarAreaExample=function(){var a=document.getElementById("polar-area-example"),e=a.getAttribute("data-colors"),t=e?e.split(","):this.defaultColors,r=a.getContext("2d"),o=new Chart(r,{type:"polarArea",data:{labels:["Jan","Feb","March","April","May"],datasets:[{label:"Dataset 1",data:[12,19,14,15,20],backgroundColor:t}]},options:{responsive:!0,maintainAspectRatio:!1,plugins:{legend:{display:!1,position:"top"}},scales:{r:{display:!1}}}});this.charts.push(o)},s.prototype.radarExample=function(){var a=document.getElementById("radar-example"),e=a.getAttribute("data-colors"),t=e?e.split(","):this.defaultColors,r=a.getContext("2d"),o=new Chart(r,{type:"radar",data:{labels:["Jan","Feb","March","April","May","June"],datasets:[{label:"Dataset 1",data:[12,29,39,22,28,34],borderColor:t[0],backgroundColor:i(t[0],.3)},{label:"Dataset 2",data:[10,19,15,28,34,39],borderColor:t[1],backgroundColor:i(t[1],.3)}]},options:{responsive:!0,maintainAspectRatio:!1,plugins:{legend:{display:!1}}}});this.charts.push(o)},s.prototype.scatterExample=function(){var a=document.getElementById("scatter-example"),e=a.getAttribute("data-colors"),t=e?e.split(","):this.defaultColors,r=a.getContext("2d"),o=new Chart(r,{type:"scatter",data:{labels:["Jan","Feb","March","April","May","June","July"],datasets:[{label:"Dataset 1",data:[{x:10,y:50},{x:50,y:10},{x:15,y:15},{x:20,y:45},{x:25,y:18},{x:34,y:38}],borderColor:t[0],backgroundColor:i(t[0],.3)},{label:"Dataset 2",data:[{x:15,y:45},{x:40,y:20},{x:30,y:5},{x:35,y:25},{x:18,y:25},{x:40,y:8}],borderColor:t[1],backgroundColor:i(t[1],.3)}]},options:{responsive:!0,maintainAspectRatio:!1,plugins:{legend:{display:!1}},scales:{x:{grid:{display:!1}},y:{grid:{display:!1}}}}});this.charts.push(o)},s.prototype.barLineExample=function(){var a=document.getElementById("bar-line-example"),e=a.getAttribute("data-colors"),t=e?e.split(","):this.defaultColors,r=a.getContext("2d"),o=new Chart(r,{type:"line",data:{labels:["Jan","Feb","March","April","May","June","July"],datasets:[{label:"Dataset 1",data:[10,20,35,18,15,25,22],backgroundColor:t[0],stack:"combined",type:"bar"},{label:"Dataset 2",data:[13,23,38,22,25,30,28],borderColor:t[1],stack:"combined"}]},options:{responsive:!0,maintainAspectRatio:!1,plugins:{legend:{display:!1}},scales:{x:{grid:{display:!1}},y:{stacked:!0,grid:{display:!1}}}}});this.charts.push(o)},s.prototype.init=function(){var a=this;Chart.defaults.font.family='-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',Chart.defaults.color="#8391a2",Chart.defaults.scale.grid.color="#8391a2",this.bubbleExample(),this.donutExample(),this.pieExample(),this.polarAreaExample(),this.radarExample(),this.barLineExample(),this.scatterExample(),l(window).on("resizeEnd",function(e){l.each(a.charts,function(t,r){try{r.destroy()}catch{}}),a.bubbleExample(),a.donutExample(),a.pieExample(),a.polarAreaExample(),a.radarExample(),a.barLineExample(),a.scatterExample()}),l(window).resize(function(){this.resizeTO&&clearTimeout(this.resizeTO),this.resizeTO=setTimeout(function(){l(this).trigger("resizeEnd")},500)})},l.ChartJs=new s,l.ChartJs.Constructor=s})(window.jQuery),function(l){l.ChartJs.init()}(window.jQuery);function i(l,s){var a=parseInt(l.slice(1,3),16),e=parseInt(l.slice(3,5),16),t=parseInt(l.slice(5,7),16);return s?"rgba("+a+", "+e+", "+t+", "+s+")":"rgb("+a+", "+e+", "+t+")"}
//# sourceMappingURL=demo.chartjs-other-257c8614.js.map
