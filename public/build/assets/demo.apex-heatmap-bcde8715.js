import{A as l}from"./apexcharts.min-4b05f444.js";import"./_commonjsHelpers-042e6b4d.js";const h=()=>{function a(c,t){for(var r=0,n=[];r<c;){var d=(r+1).toString(),s=Math.floor(Math.random()*(t.max-t.min+1))+t.min;n.push({x:d,y:s}),r++}return n}var e=["#3e60d5"],m=$("#basic-heatmap").data("colors");m&&(e=m.split(","));var i={chart:{height:380,type:"heatmap"},dataLabels:{enabled:!1},colors:e,series:[{name:"Metric 1",data:a(20,{min:0,max:90})},{name:"Metric 2",data:a(20,{min:0,max:90})},{name:"Metric 3",data:a(20,{min:0,max:90})},{name:"Metric 4",data:a(20,{min:0,max:90})},{name:"Metric 5",data:a(20,{min:0,max:90})},{name:"Metric  6",data:a(20,{min:0,max:90})},{name:"Metric 7",data:a(20,{min:0,max:90})},{name:"Metric 8",data:a(20,{min:0,max:90})},{name:"Metric 9",data:a(20,{min:0,max:90})}],xaxis:{type:"category"}},o=new l(document.querySelector("#basic-heatmap"),i);o.render()},x=()=>{function a(c,t){for(var r=0,n=[];r<c;){var d=(r+1).toString(),s=Math.floor(Math.random()*(t.max-t.min+1))+t.min;n.push({x:d,y:s}),r++}return n}var e=["#F3B415","#F27036","#663F59","#6A6E94","#4E88B4","#00A7C6","#18D8D8","#A9D794","#46AF78"],m=$("#multiple-series-heatmap").data("colors");m&&(e=m.split(","));var i={chart:{height:380,type:"heatmap"},dataLabels:{enabled:!1},colors:e,series:[{name:"Metric 1",data:a(20,{min:0,max:90})},{name:"Metric 2",data:a(20,{min:0,max:90})},{name:"Metric 3",data:a(20,{min:0,max:90})},{name:"Metric 4",data:a(20,{min:0,max:90})},{name:"Metric 5",data:a(20,{min:0,max:90})},{name:"Metric 6",data:a(20,{min:0,max:90})},{name:"Metric 7",data:a(20,{min:0,max:90})},{name:"Metric 8",data:a(20,{min:0,max:90})},{name:"Metric 9",data:a(20,{min:0,max:90})}],xaxis:{type:"category"}},o=new l(document.querySelector("#multiple-series-heatmap"),i);o.render()},p=()=>{function a(c,t){for(var r=0,n=[];r<c;){var d=(r+1).toString(),s=Math.floor(Math.random()*(t.max-t.min+1))+t.min;n.push({x:d,y:s}),r++}return n}var e=["#fa6767","#f9bc0d","#44badc","#42d29d"],m=$("#color-range-heatmap").data("colors");m&&(e=m.split(","));var i={chart:{height:380,type:"heatmap"},plotOptions:{heatmap:{shadeIntensity:.5,colorScale:{ranges:[{from:-30,to:5,name:"Low",color:e[0]},{from:6,to:20,name:"Medium",color:e[1]},{from:21,to:45,name:"High",color:e[2]},{from:46,to:55,name:"Extreme",color:e[3]}]}}},dataLabels:{enabled:!1},series:[{name:"Jan",data:a(20,{min:-30,max:55})},{name:"Feb",data:a(20,{min:-30,max:55})},{name:"Mar",data:a(20,{min:-30,max:55})},{name:"Apr",data:a(20,{min:-30,max:55})},{name:"May",data:a(20,{min:-30,max:55})},{name:"Jun",data:a(20,{min:-30,max:55})},{name:"Jul",data:a(20,{min:-30,max:55})},{name:"Aug",data:a(20,{min:-30,max:55})},{name:"Sep",data:a(20,{min:-30,max:55})}]},o=new l(document.querySelector("#color-range-heatmap"),i);o.render()},M=()=>{function a(c,t){for(var r=0,n=[];r<c;){var d=(r+1).toString(),s=Math.floor(Math.random()*(t.max-t.min+1))+t.min;n.push({x:d,y:s}),r++}return n}var e=["#39afd1","#47ad77"],m=$("#rounded-heatmap").data("colors");m&&(e=m.split(","));var i={chart:{height:380,type:"heatmap"},stroke:{width:0},plotOptions:{heatmap:{radius:30,enableShades:!1,colorScale:{ranges:[{from:0,to:50,color:e[0]},{from:51,to:100,color:e[1]}]}}},colors:e,dataLabels:{enabled:!0,style:{colors:["#fff"]}},series:[{name:"Metric1",data:a(20,{min:0,max:90})},{name:"Metric2",data:a(20,{min:0,max:90})},{name:"Metric3",data:a(20,{min:0,max:90})},{name:"Metric4",data:a(20,{min:0,max:90})},{name:"Metric5",data:a(20,{min:0,max:90})},{name:"Metric6",data:a(20,{min:0,max:90})},{name:"Metric7",data:a(20,{min:0,max:90})},{name:"Metric8",data:a(20,{min:0,max:90})},{name:"Metric8",data:a(20,{min:0,max:90})}],xaxis:{type:"category"},grid:{borderColor:"#f1f3fa"}},o=new l(document.querySelector("#rounded-heatmap"),i);o.render()};h();x();p();M();
//# sourceMappingURL=demo.apex-heatmap-bcde8715.js.map
