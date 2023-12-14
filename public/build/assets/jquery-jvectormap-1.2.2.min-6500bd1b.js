(function(t){var e={set:{colors:1,values:1,backgroundColor:1,scaleColors:1,normalizeFunction:1,focus:1},get:{selectedRegions:1,selectedMarkers:1,mapObject:1,regionName:1}};t.fn.vectorMap=function(s){var n,i,n=this.children(".jvectormap-container").data("mapObject");if(s==="addMap")a.WorldMap.maps[arguments[1]]=arguments[2];else{if(!(s!=="set"&&s!=="get"||!e[s][arguments[1]]))return i=arguments[1].charAt(0).toUpperCase()+arguments[1].substr(1),n[s+i].apply(n,Array.prototype.slice.call(arguments,2));s=s||{},s.container=this,n=new a.WorldMap(s)}return this}})(jQuery),function(t){function e(n){var h=n||window.event,l=[].slice.call(arguments,1),r=0,p=0,o=0;return n=t.event.fix(h),n.type="mousewheel",h.wheelDelta&&(r=h.wheelDelta/120),h.detail&&(r=-h.detail/3),o=r,h.axis!==void 0&&h.axis===h.HORIZONTAL_AXIS&&(o=0,p=-1*r),h.wheelDeltaY!==void 0&&(o=h.wheelDeltaY/120),h.wheelDeltaX!==void 0&&(p=-1*h.wheelDeltaX/120),l.unshift(n,r,p,o),(t.event.dispatch||t.event.handle).apply(this,l)}var s=["DOMMouseScroll","mousewheel"];if(t.event.fixHooks)for(var i=s.length;i;)t.event.fixHooks[s[--i]]=t.event.mouseHooks;t.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var n=s.length;n;)this.addEventListener(s[--n],e,!1);else this.onmousewheel=e},teardown:function(){if(this.removeEventListener)for(var n=s.length;n;)this.removeEventListener(s[--n],e,!1);else this.onmousewheel=null}},t.fn.extend({mousewheel:function(n){return n?this.bind("mousewheel",n):this.trigger("mousewheel")},unmousewheel:function(n){return this.unbind("mousewheel",n)}})}(jQuery);var a={inherits:function(t,e){function s(){}s.prototype=e.prototype,t.prototype=new s,t.prototype.constructor=t,t.parentClass=e},mixin:function(t,e){var s;for(s in e.prototype)e.prototype.hasOwnProperty(s)&&(t.prototype[s]=e.prototype[s])},min:function(t){var e=Number.MAX_VALUE,s;if(t instanceof Array)for(s=0;s<t.length;s++)t[s]<e&&(e=t[s]);else for(s in t)t[s]<e&&(e=t[s]);return e},max:function(t){var e=Number.MIN_VALUE,s;if(t instanceof Array)for(s=0;s<t.length;s++)t[s]>e&&(e=t[s]);else for(s in t)t[s]>e&&(e=t[s]);return e},keys:function(t){var e=[],s;for(s in t)e.push(s);return e},values:function(t){var e=[],s,i;for(i=0;i<arguments.length;i++){t=arguments[i];for(s in t)e.push(t[s])}return e}};a.$=jQuery,a.AbstractElement=function(t,e){this.node=this.createElement(t),this.name=t,this.properties={},e&&this.set(e)},a.AbstractElement.prototype.set=function(t,e){var s;if(typeof t=="object")for(s in t)this.properties[s]=t[s],this.applyAttr(s,t[s]);else this.properties[t]=e,this.applyAttr(t,e)},a.AbstractElement.prototype.get=function(t){return this.properties[t]},a.AbstractElement.prototype.applyAttr=function(t,e){this.node.setAttribute(t,e)},a.AbstractElement.prototype.remove=function(){a.$(this.node).remove()},a.AbstractCanvasElement=function(t,e,s){this.container=t,this.setSize(e,s),this.rootElement=new a[this.classPrefix+"GroupElement"],this.node.appendChild(this.rootElement.node),this.container.appendChild(this.node)},a.AbstractCanvasElement.prototype.add=function(t,e){e=e||this.rootElement,e.add(t),t.canvas=this},a.AbstractCanvasElement.prototype.addPath=function(t,e,s){var i=new a[this.classPrefix+"PathElement"](t,e);return this.add(i,s),i},a.AbstractCanvasElement.prototype.addCircle=function(t,e,s){var i=new a[this.classPrefix+"CircleElement"](t,e);return this.add(i,s),i},a.AbstractCanvasElement.prototype.addGroup=function(t){var e=new a[this.classPrefix+"GroupElement"];return t?t.node.appendChild(e.node):this.node.appendChild(e.node),e.canvas=this,e},a.AbstractShapeElement=function(t,e,s){this.style=s||{},this.style.current={},this.isHovered=!1,this.isSelected=!1,this.updateStyle()},a.AbstractShapeElement.prototype.setHovered=function(t){this.isHovered!==t&&(this.isHovered=t,this.updateStyle())},a.AbstractShapeElement.prototype.setSelected=function(t){this.isSelected!==t&&(this.isSelected=t,this.updateStyle(),a.$(this.node).trigger("selected",[t]))},a.AbstractShapeElement.prototype.setStyle=function(t,e){var s={};typeof t=="object"?s=t:s[t]=e,a.$.extend(this.style.current,s),this.updateStyle()},a.AbstractShapeElement.prototype.updateStyle=function(){var t={};a.AbstractShapeElement.mergeStyles(t,this.style.initial),a.AbstractShapeElement.mergeStyles(t,this.style.current),this.isHovered&&a.AbstractShapeElement.mergeStyles(t,this.style.hover),this.isSelected&&(a.AbstractShapeElement.mergeStyles(t,this.style.selected),this.isHovered&&a.AbstractShapeElement.mergeStyles(t,this.style.selectedHover)),this.set(t)},a.AbstractShapeElement.mergeStyles=function(t,e){var s;e=e||{};for(s in e)e[s]===null?delete t[s]:t[s]=e[s]},a.SVGElement=function(t,e){a.SVGElement.parentClass.apply(this,arguments)},a.inherits(a.SVGElement,a.AbstractElement),a.SVGElement.svgns="http://www.w3.org/2000/svg",a.SVGElement.prototype.createElement=function(t){return document.createElementNS(a.SVGElement.svgns,t)},a.SVGElement.prototype.addClass=function(t){this.node.setAttribute("class",t)},a.SVGElement.prototype.getElementCtr=function(t){return a["SVG"+t]},a.SVGElement.prototype.getBBox=function(){return this.node.getBBox()},a.SVGGroupElement=function(){a.SVGGroupElement.parentClass.call(this,"g")},a.inherits(a.SVGGroupElement,a.SVGElement),a.SVGGroupElement.prototype.add=function(t){this.node.appendChild(t.node)},a.SVGCanvasElement=function(t,e,s){this.classPrefix="SVG",a.SVGCanvasElement.parentClass.call(this,"svg"),a.AbstractCanvasElement.apply(this,arguments)},a.inherits(a.SVGCanvasElement,a.SVGElement),a.mixin(a.SVGCanvasElement,a.AbstractCanvasElement),a.SVGCanvasElement.prototype.setSize=function(t,e){this.width=t,this.height=e,this.node.setAttribute("width",t),this.node.setAttribute("height",e)},a.SVGCanvasElement.prototype.applyTransformParams=function(t,e,s){this.scale=t,this.transX=e,this.transY=s,this.rootElement.node.setAttribute("transform","scale("+t+") translate("+e+", "+s+")")},a.SVGShapeElement=function(t,e,s){a.SVGShapeElement.parentClass.call(this,t,e),a.AbstractShapeElement.apply(this,arguments)},a.inherits(a.SVGShapeElement,a.SVGElement),a.mixin(a.SVGShapeElement,a.AbstractShapeElement),a.SVGPathElement=function(t,e){a.SVGPathElement.parentClass.call(this,"path",t,e),this.node.setAttribute("fill-rule","evenodd")},a.inherits(a.SVGPathElement,a.SVGShapeElement),a.SVGCircleElement=function(t,e){a.SVGCircleElement.parentClass.call(this,"circle",t,e)},a.inherits(a.SVGCircleElement,a.SVGShapeElement),a.VMLElement=function(t,e){a.VMLElement.VMLInitialized||a.VMLElement.initializeVML(),a.VMLElement.parentClass.apply(this,arguments)},a.inherits(a.VMLElement,a.AbstractElement),a.VMLElement.VMLInitialized=!1,a.VMLElement.initializeVML=function(){try{document.namespaces.rvml||document.namespaces.add("rvml","urn:schemas-microsoft-com:vml"),a.VMLElement.prototype.createElement=function(t){return document.createElement("<rvml:"+t+' class="rvml">')}}catch{a.VMLElement.prototype.createElement=function(e){return document.createElement("<"+e+' xmlns="urn:schemas-microsoft.com:vml" class="rvml">')}}document.createStyleSheet().addRule(".rvml","behavior:url(#default#VML)"),a.VMLElement.VMLInitialized=!0},a.VMLElement.prototype.getElementCtr=function(t){return a["VML"+t]},a.VMLElement.prototype.addClass=function(t){a.$(this.node).addClass(t)},a.VMLElement.prototype.applyAttr=function(t,e){this.node[t]=e},a.VMLElement.prototype.getBBox=function(){var t=a.$(this.node);return{x:t.position().left/this.canvas.scale,y:t.position().top/this.canvas.scale,width:t.width()/this.canvas.scale,height:t.height()/this.canvas.scale}},a.VMLGroupElement=function(){a.VMLGroupElement.parentClass.call(this,"group"),this.node.style.left="0px",this.node.style.top="0px",this.node.coordorigin="0 0"},a.inherits(a.VMLGroupElement,a.VMLElement),a.VMLGroupElement.prototype.add=function(t){this.node.appendChild(t.node)},a.VMLCanvasElement=function(t,e,s){this.classPrefix="VML",a.VMLCanvasElement.parentClass.call(this,"group"),a.AbstractCanvasElement.apply(this,arguments),this.node.style.position="absolute"},a.inherits(a.VMLCanvasElement,a.VMLElement),a.mixin(a.VMLCanvasElement,a.AbstractCanvasElement),a.VMLCanvasElement.prototype.setSize=function(t,e){var s,i,n,h;if(this.width=t,this.height=e,this.node.style.width=t+"px",this.node.style.height=e+"px",this.node.coordsize=t+" "+e,this.node.coordorigin="0 0",this.rootElement){for(s=this.rootElement.node.getElementsByTagName("shape"),n=0,h=s.length;n<h;n++)s[n].coordsize=t+" "+e,s[n].style.width=t+"px",s[n].style.height=e+"px";for(i=this.node.getElementsByTagName("group"),n=0,h=i.length;n<h;n++)i[n].coordsize=t+" "+e,i[n].style.width=t+"px",i[n].style.height=e+"px"}},a.VMLCanvasElement.prototype.applyTransformParams=function(t,e,s){this.scale=t,this.transX=e,this.transY=s,this.rootElement.node.coordorigin=this.width-e-this.width/100+","+(this.height-s-this.height/100),this.rootElement.node.coordsize=this.width/t+","+this.height/t},a.VMLShapeElement=function(t,e){a.VMLShapeElement.parentClass.call(this,t,e),this.fillElement=new a.VMLElement("fill"),this.strokeElement=new a.VMLElement("stroke"),this.node.appendChild(this.fillElement.node),this.node.appendChild(this.strokeElement.node),this.node.stroked=!1,a.AbstractShapeElement.apply(this,arguments)},a.inherits(a.VMLShapeElement,a.VMLElement),a.mixin(a.VMLShapeElement,a.AbstractShapeElement),a.VMLShapeElement.prototype.applyAttr=function(t,e){switch(t){case"fill":this.node.fillcolor=e;break;case"fill-opacity":this.fillElement.node.opacity=Math.round(e*100)+"%";break;case"stroke":e==="none"?this.node.stroked=!1:this.node.stroked=!0,this.node.strokecolor=e;break;case"stroke-opacity":this.strokeElement.node.opacity=Math.round(e*100)+"%";break;case"stroke-width":parseInt(e,10)===0?this.node.stroked=!1:this.node.stroked=!0,this.node.strokeweight=e;break;case"d":this.node.path=a.VMLPathElement.pathSvgToVml(e);break;default:a.VMLShapeElement.parentClass.prototype.applyAttr.apply(this,arguments)}},a.VMLPathElement=function(t,e){var s=new a.VMLElement("skew");a.VMLPathElement.parentClass.call(this,"shape",t,e),this.node.coordorigin="0 0",s.node.on=!0,s.node.matrix="0.01,0,0,0.01,0,0",s.node.offset="0,0",this.node.appendChild(s.node)},a.inherits(a.VMLPathElement,a.VMLShapeElement),a.VMLPathElement.prototype.applyAttr=function(t,e){t==="d"?this.node.path=a.VMLPathElement.pathSvgToVml(e):a.VMLShapeElement.prototype.applyAttr.call(this,t,e)},a.VMLPathElement.pathSvgToVml=function(t){var e=0,s=0,i,n;return t=t.replace(/(-?\d+)e(-?\d+)/g,"0"),t.replace(/([MmLlHhVvCcSs])\s*((?:-?\d*(?:\.\d+)?\s*,?\s*)+)/g,function(h,l,r,p){r=r.replace(/(\d)-/g,"$1,-").replace(/^\s+/g,"").replace(/\s+$/g,"").replace(/\s+/g,",").split(","),r[0]||r.shift();for(var o=0,c=r.length;o<c;o++)r[o]=Math.round(100*r[o]);switch(l){case"m":return e+=r[0],s+=r[1],"t"+r.join(",");case"M":return e=r[0],s=r[1],"m"+r.join(",");case"l":return e+=r[0],s+=r[1],"r"+r.join(",");case"L":return e=r[0],s=r[1],"l"+r.join(",");case"h":return e+=r[0],"r"+r[0]+",0";case"H":return e=r[0],"l"+e+","+s;case"v":return s+=r[0],"r0,"+r[0];case"V":return s=r[0],"l"+e+","+s;case"c":return i=e+r[r.length-4],n=s+r[r.length-3],e+=r[r.length-2],s+=r[r.length-1],"v"+r.join(",");case"C":return i=r[r.length-4],n=r[r.length-3],e=r[r.length-2],s=r[r.length-1],"c"+r.join(",");case"s":return r.unshift(s-n),r.unshift(e-i),i=e+r[r.length-4],n=s+r[r.length-3],e+=r[r.length-2],s+=r[r.length-1],"v"+r.join(",");case"S":return r.unshift(s+s-n),r.unshift(e+e-i),i=r[r.length-4],n=r[r.length-3],e=r[r.length-2],s=r[r.length-1],"c"+r.join(",")}return""}).replace(/z/g,"e")},a.VMLCircleElement=function(t,e){a.VMLCircleElement.parentClass.call(this,"oval",t,e)},a.inherits(a.VMLCircleElement,a.VMLShapeElement),a.VMLCircleElement.prototype.applyAttr=function(t,e){switch(t){case"r":this.node.style.width=e*2+"px",this.node.style.height=e*2+"px",this.applyAttr("cx",this.get("cx")||0),this.applyAttr("cy",this.get("cy")||0);break;case"cx":if(!e)return;this.node.style.left=e-(this.get("r")||0)+"px";break;case"cy":if(!e)return;this.node.style.top=e-(this.get("r")||0)+"px";break;default:a.VMLCircleElement.parentClass.prototype.applyAttr.call(this,t,e)}},a.VectorCanvas=function(t,e,s){return this.mode=window.SVGAngle?"svg":"vml",this.mode=="svg"?this.impl=new a.SVGCanvasElement(t,e,s):this.impl=new a.VMLCanvasElement(t,e,s),this.impl},a.SimpleScale=function(t){this.scale=t},a.SimpleScale.prototype.getValue=function(t){return t},a.OrdinalScale=function(t){this.scale=t},a.OrdinalScale.prototype.getValue=function(t){return this.scale[t]},a.NumericScale=function(t,e,s,i){this.scale=[],e=e||"linear",t&&this.setScale(t),e&&this.setNormalizeFunction(e),s&&this.setMin(s),i&&this.setMax(i)},a.NumericScale.prototype={setMin:function(t){this.clearMinValue=t,typeof this.normalize=="function"?this.minValue=this.normalize(t):this.minValue=t},setMax:function(t){this.clearMaxValue=t,typeof this.normalize=="function"?this.maxValue=this.normalize(t):this.maxValue=t},setScale:function(t){var e;for(e=0;e<t.length;e++)this.scale[e]=[t[e]]},setNormalizeFunction:function(t){t==="polynomial"?this.normalize=function(e){return Math.pow(e,.2)}:t==="linear"?delete this.normalize:this.normalize=t,this.setMin(this.clearMinValue),this.setMax(this.clearMaxValue)},getValue:function(t){var e=[],s=0,i,n=0,h;for(typeof this.normalize=="function"&&(t=this.normalize(t)),n=0;n<this.scale.length-1;n++)i=this.vectorLength(this.vectorSubtract(this.scale[n+1],this.scale[n])),e.push(i),s+=i;for(h=(this.maxValue-this.minValue)/s,n=0;n<e.length;n++)e[n]*=h;for(n=0,t-=this.minValue;t-e[n]>=0;)t-=e[n],n++;return n==this.scale.length-1?t=this.vectorToNum(this.scale[n]):t=this.vectorToNum(this.vectorAdd(this.scale[n],this.vectorMult(this.vectorSubtract(this.scale[n+1],this.scale[n]),t/e[n]))),t},vectorToNum:function(t){var e=0,s;for(s=0;s<t.length;s++)e+=Math.round(t[s])*Math.pow(256,t.length-s-1);return e},vectorSubtract:function(t,e){var s=[],i;for(i=0;i<t.length;i++)s[i]=t[i]-e[i];return s},vectorAdd:function(t,e){var s=[],i;for(i=0;i<t.length;i++)s[i]=t[i]+e[i];return s},vectorMult:function(t,e){var s=[],i;for(i=0;i<t.length;i++)s[i]=t[i]*e;return s},vectorLength:function(t){var e=0,s;for(s=0;s<t.length;s++)e+=t[s]*t[s];return Math.sqrt(e)}},a.ColorScale=function(t,e,s,i){a.ColorScale.parentClass.apply(this,arguments)},a.inherits(a.ColorScale,a.NumericScale),a.ColorScale.prototype.setScale=function(t){var e;for(e=0;e<t.length;e++)this.scale[e]=a.ColorScale.rgbToArray(t[e])},a.ColorScale.prototype.getValue=function(t){return a.ColorScale.numToRgb(a.ColorScale.parentClass.prototype.getValue.call(this,t))},a.ColorScale.arrayToRgb=function(t){var e="#",s,i;for(i=0;i<t.length;i++)s=t[i].toString(16),e+=s.length==1?"0"+s:s;return e},a.ColorScale.numToRgb=function(t){for(t=t.toString(16);t.length<6;)t="0"+t;return"#"+t},a.ColorScale.rgbToArray=function(t){return t=t.substr(1),[parseInt(t.substr(0,2),16),parseInt(t.substr(2,2),16),parseInt(t.substr(4,2),16)]},a.DataSeries=function(t,e){var s;t=t||{},t.attribute=t.attribute||"fill",this.elements=e,this.params=t,t.attributes&&this.setAttributes(t.attributes),a.$.isArray(t.scale)?(s=t.attribute==="fill"||t.attribute==="stroke"?a.ColorScale:a.NumericScale,this.scale=new s(t.scale,t.normalizeFunction,t.min,t.max)):t.scale?this.scale=new a.OrdinalScale(t.scale):this.scale=new a.SimpleScale(t.scale),this.values=t.values||{},this.setValues(this.values)},a.DataSeries.prototype={setAttributes:function(t,e){var s=t,i;if(typeof t=="string")this.elements[t]&&this.elements[t].setStyle(this.params.attribute,e);else for(i in s)this.elements[i]&&this.elements[i].element.setStyle(this.params.attribute,s[i])},setValues:function(t){var e=Number.MIN_VALUE,s=Number.MAX_VALUE,i,n,h={};if(this.scale instanceof a.OrdinalScale||this.scale instanceof a.SimpleScale)for(n in t)t[n]?h[n]=this.scale.getValue(t[n]):h[n]=this.elements[n].element.style.initial[this.params.attribute];else{if(!this.params.min||!this.params.max){for(n in t)i=parseFloat(t[n]),i>e&&(e=t[n]),i<s&&(s=i);this.params.min||this.scale.setMin(s),this.params.max||this.scale.setMax(e),this.params.min=s,this.params.max=e}for(n in t)i=parseFloat(t[n]),isNaN(i)?h[n]=this.elements[n].element.style.initial[this.params.attribute]:h[n]=this.scale.getValue(i)}this.setAttributes(h),a.$.extend(this.values,t)},clear:function(){var t,e={};for(t in this.values)this.elements[t]&&(e[t]=this.elements[t].element.style.initial[this.params.attribute]);this.setAttributes(e),this.values={}},setScale:function(t){this.scale.setScale(t),this.values&&this.setValues(this.values)},setNormalizeFunction:function(t){this.scale.setNormalizeFunction(t),this.values&&this.setValues(this.values)}},a.Proj={degRad:180/Math.PI,radDeg:Math.PI/180,radius:6381372,sgn:function(t){return t>0?1:t<0?-1:t},mill:function(t,e,s){return{x:this.radius*(e-s)*this.radDeg,y:-this.radius*Math.log(Math.tan((45+.4*t)*this.radDeg))/.8}},mill_inv:function(t,e,s){return{lat:(2.5*Math.atan(Math.exp(.8*e/this.radius))-5*Math.PI/8)*this.degRad,lng:(s*this.radDeg+t/this.radius)*this.degRad}},merc:function(t,e,s){return{x:this.radius*(e-s)*this.radDeg,y:-this.radius*Math.log(Math.tan(Math.PI/4+t*Math.PI/360))}},merc_inv:function(t,e,s){return{lat:(2*Math.atan(Math.exp(e/this.radius))-Math.PI/2)*this.degRad,lng:(s*this.radDeg+t/this.radius)*this.degRad}},aea:function(t,e,s){var i=0,n=s*this.radDeg,h=29.5*this.radDeg,l=45.5*this.radDeg,r=t*this.radDeg,p=e*this.radDeg,o=(Math.sin(h)+Math.sin(l))/2,c=Math.cos(h)*Math.cos(h)+2*o*Math.sin(h),m=o*(p-n),u=Math.sqrt(c-2*o*Math.sin(r))/o,d=Math.sqrt(c-2*o*Math.sin(i))/o;return{x:u*Math.sin(m)*this.radius,y:-(d-u*Math.cos(m))*this.radius}},aea_inv:function(t,e,s){var i=t/this.radius,n=e/this.radius,h=0,l=s*this.radDeg,r=29.5*this.radDeg,p=45.5*this.radDeg,o=(Math.sin(r)+Math.sin(p))/2,c=Math.cos(r)*Math.cos(r)+2*o*Math.sin(r),m=Math.sqrt(c-2*o*Math.sin(h))/o,u=Math.sqrt(i*i+(m-n)*(m-n)),d=Math.atan(i/(m-n));return{lat:Math.asin((c-u*u*o*o)/(2*o))*this.degRad,lng:(l+d/o)*this.degRad}},lcc:function(t,e,s){var i=0,n=s*this.radDeg,h=e*this.radDeg,l=33*this.radDeg,r=45*this.radDeg,p=t*this.radDeg,o=Math.log(Math.cos(l)*(1/Math.cos(r)))/Math.log(Math.tan(Math.PI/4+r/2)*(1/Math.tan(Math.PI/4+l/2))),c=Math.cos(l)*Math.pow(Math.tan(Math.PI/4+l/2),o)/o,m=c*Math.pow(1/Math.tan(Math.PI/4+p/2),o),u=c*Math.pow(1/Math.tan(Math.PI/4+i/2),o);return{x:m*Math.sin(o*(h-n))*this.radius,y:-(u-m*Math.cos(o*(h-n)))*this.radius}},lcc_inv:function(t,e,s){var i=t/this.radius,n=e/this.radius,h=0,l=s*this.radDeg,r=33*this.radDeg,p=45*this.radDeg,o=Math.log(Math.cos(r)*(1/Math.cos(p)))/Math.log(Math.tan(Math.PI/4+p/2)*(1/Math.tan(Math.PI/4+r/2))),c=Math.cos(r)*Math.pow(Math.tan(Math.PI/4+r/2),o)/o,m=c*Math.pow(1/Math.tan(Math.PI/4+h/2),o),u=this.sgn(o)*Math.sqrt(i*i+(m-n)*(m-n)),d=Math.atan(i/(m-n));return{lat:(2*Math.atan(Math.pow(c/u,1/o))-Math.PI/2)*this.degRad,lng:(l+d/o)*this.degRad}}},a.WorldMap=function(t){var e=this,s;if(this.params=a.$.extend(!0,{},a.WorldMap.defaultParams,t),!a.WorldMap.maps[this.params.map])throw new Error("Attempt to use map which was not loaded: "+this.params.map);this.mapData=a.WorldMap.maps[this.params.map],this.markers={},this.regions={},this.regionsColors={},this.regionsData={},this.container=a.$("<div>").css({width:"100%",height:"100%"}).addClass("jvectormap-container"),this.params.container.append(this.container),this.container.data("mapObject",this),this.container.css({position:"relative",overflow:"hidden"}),this.defaultWidth=this.mapData.width,this.defaultHeight=this.mapData.height,this.setBackgroundColor(this.params.backgroundColor),this.onResize=function(){e.setSize()},a.$(window).resize(this.onResize);for(s in a.WorldMap.apiEvents)this.params[s]&&this.container.bind(a.WorldMap.apiEvents[s]+".jvectormap",this.params[s]);this.canvas=new a.VectorCanvas(this.container[0],this.width,this.height),"ontouchstart"in window||window.DocumentTouch&&document instanceof DocumentTouch?this.params.bindTouchEvents&&this.bindContainerTouchEvents():this.bindContainerEvents(),this.bindElementEvents(),this.createLabel(),this.params.zoomButtons&&this.bindZoomButtons(),this.createRegions(),this.createMarkers(this.params.markers||{}),this.setSize(),this.params.focusOn&&(typeof this.params.focusOn=="object"?this.setFocus.call(this,this.params.focusOn.scale,this.params.focusOn.x,this.params.focusOn.y):this.setFocus.call(this,this.params.focusOn)),this.params.selectedRegions&&this.setSelectedRegions(this.params.selectedRegions),this.params.selectedMarkers&&this.setSelectedMarkers(this.params.selectedMarkers),this.params.series&&this.createSeries()},a.WorldMap.prototype={transX:0,transY:0,scale:1,baseTransX:0,baseTransY:0,baseScale:1,width:0,height:0,setBackgroundColor:function(t){this.container.css("background-color",t)},resize:function(){var t=this.baseScale;this.width/this.height>this.defaultWidth/this.defaultHeight?(this.baseScale=this.height/this.defaultHeight,this.baseTransX=Math.abs(this.width-this.defaultWidth*this.baseScale)/(2*this.baseScale)):(this.baseScale=this.width/this.defaultWidth,this.baseTransY=Math.abs(this.height-this.defaultHeight*this.baseScale)/(2*this.baseScale)),this.scale*=this.baseScale/t,this.transX*=this.baseScale/t,this.transY*=this.baseScale/t},setSize:function(){this.width=this.container.width(),this.height=this.container.height(),this.resize(),this.canvas.setSize(this.width,this.height),this.applyTransform()},reset:function(){var t,e;for(t in this.series)for(e=0;e<this.series[t].length;e++)this.series[t][e].clear();this.scale=this.baseScale,this.transX=this.baseTransX,this.transY=this.baseTransY,this.applyTransform()},applyTransform:function(){var t,e,s,i;this.defaultWidth*this.scale<=this.width?(t=(this.width-this.defaultWidth*this.scale)/(2*this.scale),s=(this.width-this.defaultWidth*this.scale)/(2*this.scale)):(t=0,s=(this.width-this.defaultWidth*this.scale)/this.scale),this.defaultHeight*this.scale<=this.height?(e=(this.height-this.defaultHeight*this.scale)/(2*this.scale),i=(this.height-this.defaultHeight*this.scale)/(2*this.scale)):(e=0,i=(this.height-this.defaultHeight*this.scale)/this.scale),this.transY>e?this.transY=e:this.transY<i&&(this.transY=i),this.transX>t?this.transX=t:this.transX<s&&(this.transX=s),this.canvas.applyTransformParams(this.scale,this.transX,this.transY),this.markers&&this.repositionMarkers(),this.container.trigger("viewportChange",[this.scale/this.baseScale,this.transX,this.transY])},bindContainerEvents:function(){var t=!1,e,s,i=this;this.container.mousemove(function(n){return t&&(i.transX-=(e-n.pageX)/i.scale,i.transY-=(s-n.pageY)/i.scale,i.applyTransform(),e=n.pageX,s=n.pageY),!1}).mousedown(function(n){return t=!0,e=n.pageX,s=n.pageY,!1}),a.$("body").mouseup(function(){t=!1}),this.params.zoomOnScroll&&this.container.mousewheel(function(n,h,l,r){var p=a.$(i.container).offset(),o=n.pageX-p.left,c=n.pageY-p.top,m=Math.pow(1.3,r);i.label.hide(),i.setScale(i.scale*m,o,c),n.preventDefault()})},bindContainerTouchEvents:function(){var t,e,s=this,i,n,h,l,r,p=function(o){var c=o.originalEvent.touches,m,u,d,g;o.type=="touchstart"&&(r=0),c.length==1?(r==1&&(d=s.transX,g=s.transY,s.transX-=(i-c[0].pageX)/s.scale,s.transY-=(n-c[0].pageY)/s.scale,s.applyTransform(),s.label.hide(),(d!=s.transX||g!=s.transY)&&o.preventDefault()),i=c[0].pageX,n=c[0].pageY):c.length==2&&(r==2?(u=Math.sqrt(Math.pow(c[0].pageX-c[1].pageX,2)+Math.pow(c[0].pageY-c[1].pageY,2))/e,s.setScale(t*u,h,l),s.label.hide(),o.preventDefault()):(m=a.$(s.container).offset(),c[0].pageX>c[1].pageX?h=c[1].pageX+(c[0].pageX-c[1].pageX)/2:h=c[0].pageX+(c[1].pageX-c[0].pageX)/2,c[0].pageY>c[1].pageY?l=c[1].pageY+(c[0].pageY-c[1].pageY)/2:l=c[0].pageY+(c[1].pageY-c[0].pageY)/2,h-=m.left,l-=m.top,t=s.scale,e=Math.sqrt(Math.pow(c[0].pageX-c[1].pageX,2)+Math.pow(c[0].pageY-c[1].pageY,2)))),r=c.length};a.$(this.container).bind("touchstart",p),a.$(this.container).bind("touchmove",p)},bindElementEvents:function(){var t=this,e;this.container.mousemove(function(){e=!0}),this.container.delegate("[class~='jvectormap-element']","mouseover mouseout",function(s){var i=a.$(this).attr("class").baseVal?a.$(this).attr("class").baseVal:a.$(this).attr("class"),n=i.indexOf("jvectormap-region")===-1?"marker":"region",h=n=="region"?a.$(this).attr("data-code"):a.$(this).attr("data-index"),l=n=="region"?t.regions[h].element:t.markers[h].element,r=n=="region"?t.mapData.paths[h].name:t.markers[h].config.name||"",p=a.$.Event(n+"LabelShow.jvectormap"),o=a.$.Event(n+"Over.jvectormap");s.type=="mouseover"?(t.container.trigger(o,[h]),o.isDefaultPrevented()||l.setHovered(!0),t.label.text(r),t.container.trigger(p,[t.label,h]),p.isDefaultPrevented()||(t.label.show(),t.labelWidth=t.label.width(),t.labelHeight=t.label.height())):(l.setHovered(!1),t.label.hide(),t.container.trigger(n+"Out.jvectormap",[h]))}),this.container.delegate("[class~='jvectormap-element']","mousedown",function(s){e=!1}),this.container.delegate("[class~='jvectormap-element']","mouseup",function(s){var i=a.$(this).attr("class").baseVal?a.$(this).attr("class").baseVal:a.$(this).attr("class"),n=i.indexOf("jvectormap-region")===-1?"marker":"region",h=n=="region"?a.$(this).attr("data-code"):a.$(this).attr("data-index"),l=a.$.Event(n+"Click.jvectormap"),r=n=="region"?t.regions[h].element:t.markers[h].element;e||(t.container.trigger(l,[h]),(n==="region"&&t.params.regionsSelectable||n==="marker"&&t.params.markersSelectable)&&(l.isDefaultPrevented()||(t.params[n+"sSelectableOne"]&&t.clearSelected(n+"s"),r.setSelected(!r.isSelected))))})},bindZoomButtons:function(){var t=this;a.$("<div/>").addClass("jvectormap-zoomin").text("+").appendTo(this.container),a.$("<div/>").addClass("jvectormap-zoomout").html("&#x2212;").appendTo(this.container),this.container.find(".jvectormap-zoomin").click(function(){t.setScale(t.scale*t.params.zoomStep,t.width/2,t.height/2)}),this.container.find(".jvectormap-zoomout").click(function(){t.setScale(t.scale/t.params.zoomStep,t.width/2,t.height/2)})},createLabel:function(){var t=this;this.label=a.$("<div/>").addClass("jvectormap-label").appendTo(a.$("body")),this.container.mousemove(function(e){var s=e.pageX-15-t.labelWidth,i=e.pageY-15-t.labelHeight;s<5&&(s=e.pageX+15),i<5&&(i=e.pageY+15),t.label.is(":visible")&&t.label.css({left:s,top:i})})},setScale:function(t,e,s,i){var n,h=a.$.Event("zoom.jvectormap");t>this.params.zoomMax*this.baseScale?t=this.params.zoomMax*this.baseScale:t<this.params.zoomMin*this.baseScale&&(t=this.params.zoomMin*this.baseScale),typeof e<"u"&&typeof s<"u"&&(n=t/this.scale,i?(this.transX=e+this.defaultWidth*(this.width/(this.defaultWidth*t))/2,this.transY=s+this.defaultHeight*(this.height/(this.defaultHeight*t))/2):(this.transX-=(n-1)/t*e,this.transY-=(n-1)/t*s)),this.scale=t,this.applyTransform(),this.container.trigger(h,[t/this.baseScale])},setFocus:function(t,e,s){var i,n,h,l,r;if(a.$.isArray(t)||this.regions[t]){for(a.$.isArray(t)?l=t:l=[t],r=0;r<l.length;r++)this.regions[l[r]]&&(n=this.regions[l[r]].element.getBBox(),n&&(typeof i>"u"?i=n:(h={x:Math.min(i.x,n.x),y:Math.min(i.y,n.y),width:Math.max(i.x+i.width,n.x+n.width)-Math.min(i.x,n.x),height:Math.max(i.y+i.height,n.y+n.height)-Math.min(i.y,n.y)},i=h)));this.setScale(Math.min(this.width/i.width,this.height/i.height),-(i.x+i.width/2),-(i.y+i.height/2),!0)}else t*=this.baseScale,this.setScale(t,-e*this.defaultWidth,-s*this.defaultHeight,!0)},getSelected:function(t){var e,s=[];for(e in this[t])this[t][e].element.isSelected&&s.push(e);return s},getSelectedRegions:function(){return this.getSelected("regions")},getSelectedMarkers:function(){return this.getSelected("markers")},setSelected:function(t,e){var s;if(typeof e!="object"&&(e=[e]),a.$.isArray(e))for(s=0;s<e.length;s++)this[t][e[s]].element.setSelected(!0);else for(s in e)this[t][s].element.setSelected(!!e[s])},setSelectedRegions:function(t){this.setSelected("regions",t)},setSelectedMarkers:function(t){this.setSelected("markers",t)},clearSelected:function(t){var e={},s=this.getSelected(t),i;for(i=0;i<s.length;i++)e[s[i]]=!1;this.setSelected(t,e)},clearSelectedRegions:function(){this.clearSelected("regions")},clearSelectedMarkers:function(){this.clearSelected("markers")},getMapObject:function(){return this},getRegionName:function(t){return this.mapData.paths[t].name},createRegions:function(){var t,e,s=this;for(t in this.mapData.paths)e=this.canvas.addPath({d:this.mapData.paths[t].path,"data-code":t},a.$.extend(!0,{},this.params.regionStyle)),a.$(e.node).bind("selected",function(i,n){s.container.trigger("regionSelected.jvectormap",[a.$(this).attr("data-code"),n,s.getSelectedRegions()])}),e.addClass("jvectormap-region jvectormap-element"),this.regions[t]={element:e,config:this.mapData.paths[t]}},createMarkers:function(t){var e,s,i,n,h,l=this;if(this.markersGroup=this.markersGroup||this.canvas.addGroup(),a.$.isArray(t))for(h=t.slice(),t={},e=0;e<h.length;e++)t[e]=h[e];for(e in t)n=t[e]instanceof Array?{latLng:t[e]}:t[e],i=this.getMarkerPosition(n),i!==!1&&(s=this.canvas.addCircle({"data-index":e,cx:i.x,cy:i.y},a.$.extend(!0,{},this.params.markerStyle,{initial:n.style||{}}),this.markersGroup),s.addClass("jvectormap-marker jvectormap-element"),a.$(s.node).bind("selected",function(r,p){l.container.trigger("markerSelected.jvectormap",[a.$(this).attr("data-index"),p,l.getSelectedMarkers()])}),this.markers[e]&&this.removeMarkers([e]),this.markers[e]={element:s,config:n})},repositionMarkers:function(){var t,e;for(t in this.markers)e=this.getMarkerPosition(this.markers[t].config),e!==!1&&this.markers[t].element.setStyle({cx:e.x,cy:e.y})},getMarkerPosition:function(t){return a.WorldMap.maps[this.params.map].projection?this.latLngToPoint.apply(this,t.latLng||[0,0]):{x:t.coords[0]*this.scale+this.transX*this.scale,y:t.coords[1]*this.scale+this.transY*this.scale}},addMarker:function(t,e,r){var i={},n=[],h,l,r=r||[];for(i[t]=e,l=0;l<r.length;l++)h={},h[t]=r[l],n.push(h);this.addMarkers(i,n)},addMarkers:function(t,e){var s;for(e=e||[],this.createMarkers(t),s=0;s<e.length;s++)this.series.markers[s].setValues(e[s]||{})},removeMarkers:function(t){var e;for(e=0;e<t.length;e++)this.markers[t[e]].element.remove(),delete this.markers[t[e]]},removeAllMarkers:function(){var t,e=[];for(t in this.markers)e.push(t);this.removeMarkers(e)},latLngToPoint:function(t,e){var s,i=a.WorldMap.maps[this.params.map].projection,n=i.centralMeridian;this.width-this.baseTransX*2*this.baseScale,this.height-this.baseTransY*2*this.baseScale;var h,l;return this.scale/this.baseScale,e<-180+n&&(e+=360),s=a.Proj[i.type](t,e,n),h=this.getInsetForPoint(s.x,s.y),h?(l=h.bbox,s.x=(s.x-l[0].x)/(l[1].x-l[0].x)*h.width*this.scale,s.y=(s.y-l[0].y)/(l[1].y-l[0].y)*h.height*this.scale,{x:s.x+this.transX*this.scale+h.left*this.scale,y:s.y+this.transY*this.scale+h.top*this.scale}):!1},pointToLatLng:function(t,e){var s=a.WorldMap.maps[this.params.map].projection,i=s.centralMeridian,n=a.WorldMap.maps[this.params.map].insets,h,l,r,p,o;for(h=0;h<n.length;h++)if(l=n[h],r=l.bbox,p=t-(this.transX*this.scale+l.left*this.scale),o=e-(this.transY*this.scale+l.top*this.scale),p=p/(l.width*this.scale)*(r[1].x-r[0].x)+r[0].x,o=o/(l.height*this.scale)*(r[1].y-r[0].y)+r[0].y,p>r[0].x&&p<r[1].x&&o>r[0].y&&o<r[1].y)return a.Proj[s.type+"_inv"](p,-o,i);return!1},getInsetForPoint:function(t,e){var s=a.WorldMap.maps[this.params.map].insets,i,n;for(i=0;i<s.length;i++)if(n=s[i].bbox,t>n[0].x&&t<n[1].x&&e>n[0].y&&e<n[1].y)return s[i]},createSeries:function(){var t,e;this.series={markers:[],regions:[]};for(e in this.params.series)for(t=0;t<this.params.series[e].length;t++)this.series[e][t]=new a.DataSeries(this.params.series[e][t],this[e])},remove:function(){this.label.remove(),this.container.remove(),a.$(window).unbind("resize",this.onResize)}},a.WorldMap.maps={},a.WorldMap.defaultParams={map:"world_mill_en",backgroundColor:"#505050",zoomButtons:!0,zoomOnScroll:!0,zoomMax:8,zoomMin:1,zoomStep:1.6,regionsSelectable:!1,markersSelectable:!1,bindTouchEvents:!0,regionStyle:{initial:{fill:"white","fill-opacity":1,stroke:"none","stroke-width":0,"stroke-opacity":1},hover:{"fill-opacity":.8},selected:{fill:"yellow"},selectedHover:{}},markerStyle:{initial:{fill:"grey",stroke:"#505050","fill-opacity":1,"stroke-width":1,"stroke-opacity":1,r:5},hover:{stroke:"black","stroke-width":2},selected:{fill:"blue"},selectedHover:{}}},a.WorldMap.apiEvents={onRegionLabelShow:"regionLabelShow",onRegionOver:"regionOver",onRegionOut:"regionOut",onRegionClick:"regionClick",onRegionSelected:"regionSelected",onMarkerLabelShow:"markerLabelShow",onMarkerOver:"markerOver",onMarkerOut:"markerOut",onMarkerClick:"markerClick",onMarkerSelected:"markerSelected",onViewportChange:"viewportChange"};
//# sourceMappingURL=jquery-jvectormap-1.2.2.min-6500bd1b.js.map
