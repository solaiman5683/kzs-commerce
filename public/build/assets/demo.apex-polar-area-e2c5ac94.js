import{A as r}from"./apexcharts.min-4b05f444.js";import"./_commonjsHelpers-042e6b4d.js";var a=["#3e60d5","#47ad77","#fa5c7c"],t=$("#basic-polar-area").data("colors");t&&(a=t.split(","));var o={series:[14,23,21,17,15,10],chart:{height:380,type:"polarArea"},stroke:{colors:["#fff"]},fill:{opacity:.8},labels:["Vote A","Vote B","Vote C","Vote D","Vote E","Vote F"],legend:{position:"bottom"},colors:a,responsive:[{breakpoint:480,options:{chart:{width:200},legend:{position:"bottom"}}}]},e=new r(document.querySelector("#basic-polar-area"),o);e.render();var o={series:[42,47,52,58,65],chart:{height:380,type:"polarArea"},labels:["Rose A","Rose B","Rose C","Rose D","Rose E"],fill:{opacity:1},stroke:{width:1},yaxis:{show:!1},legend:{position:"bottom"},plotOptions:{polarArea:{rings:{strokeWidth:0},spokes:{strokeWidth:0}}},theme:{monochrome:{enabled:!0,shadeTo:"light",color:"#3e60d5",shadeIntensity:.6}}},e=new r(document.querySelector("#monochrome-polar-area"),o);e.render();
//# sourceMappingURL=demo.apex-polar-area-e2c5ac94.js.map
