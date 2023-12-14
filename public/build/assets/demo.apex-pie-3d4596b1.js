import{A as a}from"./apexcharts.min-4b05f444.js";import"./_commonjsHelpers-042e6b4d.js";var o=["#3e60d5","#6c757d","#47ad77","#fa5c7c","#e3eaef"],t=$("#simple-pie").data("colors");t&&(o=t.split(","));var r={chart:{height:320,type:"pie"},series:[44,55,41,17,15],labels:["Series 1","Series 2","Series 3","Series 4","Series 5"],colors:o,legend:{show:!0,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0,offsetY:7},responsive:[{breakpoint:600,options:{chart:{height:240},legend:{show:!1}}}]},e=new a(document.querySelector("#simple-pie"),r);e.render();var o=["#39afd1","#ffbc00","#313a46","#fa5c7c","#47ad77"],t=$("#simple-donut").data("colors");t&&(o=t.split(","));var r={chart:{height:320,type:"donut"},series:[44,55,41,17,15],legend:{show:!0,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0,offsetY:7},labels:["Series 1","Series 2","Series 3","Series 4","Series 5"],colors:o,responsive:[{breakpoint:600,options:{chart:{height:240},legend:{show:!1}}}]},e=new a(document.querySelector("#simple-donut"),r);e.render();var r={chart:{height:320,type:"pie"},series:[25,15,44,55,41,17],labels:["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],legend:{show:!0,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0,offsetY:7},theme:{monochrome:{enabled:!0}},responsive:[{breakpoint:600,options:{chart:{height:240},legend:{show:!1}}}]},e=new a(document.querySelector("#monochrome-pie"),r);e.render();var o=["#3e60d5","#6c757d","#47ad77","#fa5c7c","#e3eaef"],t=$("#gradient-donut").data("colors");t&&(o=t.split(","));var r={chart:{height:320,type:"donut"},series:[44,55,41,17,15],legend:{show:!0,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0,offsetY:7},labels:["Series 1","Series 2","Series 3","Series 4","Series 5"],colors:o,responsive:[{breakpoint:600,options:{chart:{height:240},legend:{show:!1}}}],fill:{type:"gradient"}},e=new a(document.querySelector("#gradient-donut"),r);e.render();var o=["#39afd1","#ffbc00","#313a46","#fa5c7c","#47ad77"],t=$("#patterned-donut").data("colors");t&&(o=t.split(","));var r={chart:{height:320,type:"donut",dropShadow:{enabled:!0,color:"#111",top:-1,left:3,blur:3,opacity:.2}},stroke:{show:!0,width:2},series:[44,55,41,17,15],colors:o,labels:["Comedy","Action","SciFi","Drama","Horror"],dataLabels:{dropShadow:{blur:3,opacity:.8}},fill:{type:"pattern",opacity:1,pattern:{enabled:!0,style:["verticalLines","squares","horizontalLines","circles","slantedLines"]}},states:{hover:{enabled:!1}},legend:{show:!0,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0,offsetY:7},responsive:[{breakpoint:600,options:{chart:{height:240},legend:{show:!1}}}]},e=new a(document.querySelector("#patterned-donut"),r);e.render();var o=["#39afd1","#ffbc00","#3e60d5","#47ad77"],t=$("#image-pie").data("colors");t&&(o=t.split(","));var r={chart:{height:320,type:"pie"},labels:["Series 1","Series 2","Series 3","Series 4"],colors:o,series:[44,33,54,45],fill:{type:"image",opacity:.85,image:{src:["/images/small/small-1.jpg","/images/small/small-2.jpg","/images/small/small-3.jpg","/images/small/small-4.jpg"],width:25,imagedHeight:25}},stroke:{width:4},dataLabels:{enabled:!1},legend:{show:!0,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0,offsetY:7},responsive:[{breakpoint:600,options:{chart:{height:240},legend:{show:!1}}}]},e=new a(document.querySelector("#image-pie"),r);e.render();var o=["#3e60d5","#6c757d","#47ad77","#fa5c7c"],t=$("#update-donut").data("colors");t&&(o=t.split(","));var r={chart:{height:320,type:"donut"},dataLabels:{enabled:!1},series:[44,55,13,33],colors:o,legend:{show:!0,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0,offsetY:7},responsive:[{breakpoint:600,options:{chart:{height:240},legend:{show:!1}}}]},e=new a(document.querySelector("#update-donut"),r);e.render();function s(){var i=e.w.globals.series.map(function(){return Math.floor(Math.random()*100)+1});return i.push(Math.floor(Math.random()*(100-1+1))+1),i}function n(){var i=e.w.globals.series.map(function(){return Math.floor(Math.random()*100)+1});return i.pop(),i}function l(){return e.w.globals.series.map(function(){return Math.floor(Math.random()*(100-1+1))+1})}function d(){return r.series}document.querySelector("#randomize").addEventListener("click",function(){e.updateSeries(l())});document.querySelector("#add").addEventListener("click",function(){e.updateSeries(s())});document.querySelector("#remove").addEventListener("click",function(){e.updateSeries(n())});document.querySelector("#reset").addEventListener("click",function(){e.updateSeries(d())});
//# sourceMappingURL=demo.apex-pie-3d4596b1.js.map
