
RGraph=window.RGraph||{isRGraph:true};RGraph.Effects=RGraph.Effects||{};RGraph.Effects.Rose=RGraph.Effects.Rose||{};RGraph.Rose=function(conf)
{if(typeof conf==='object'&&typeof conf.data==='object'&&typeof conf.id==='string'){var parseConfObjectForOptions=true;}else{var conf={id:conf};conf.data=arguments[1];}
this.id=conf.id;this.canvas=document.getElementById(this.id);this.context=this.canvas.getContext?this.canvas.getContext("2d"):null;this.data=conf.data;this.canvas.__object__=this;this.type='rose';this.isRGraph=true;this.uid=RGraph.CreateUID();this.canvas.uid=this.canvas.uid?this.canvas.uid:RGraph.CreateUID();this.colorsParsed=false;this.coordsText=[];this.original_colors=[];this.firstDraw=true;this.centerx=0;this.centery=0;this.radius=0;this.max=0;this.angles=[];this.angles2=[];this.properties={'chart.background.axes':true,'chart.background.axes.color':'black','chart.background.grid':true,'chart.background.grid.color':'#ccc','chart.background.grid.size':null,'chart.background.grid.radials':null,'chart.background.grid.count':5,'chart.centerx':null,'chart.centery':null,'chart.radius':null,'chart.angles.start':0,'chart.colors':['rgba(255,0,0,0.5)','rgba(255,255,0,0.5)','rgba(0,255,255,0.5)','rgb(0,255,0)','gray','blue','rgb(255,128,255)','green','pink','gray','aqua'],'chart.linewidth':1,'chart.colors.sequential':false,'chart.colors.alpha':null,'chart.margin':0,'chart.strokestyle':'#aaa','chart.gutter.left':25,'chart.gutter.right':25,'chart.gutter.top':25,'chart.gutter.bottom':25,'chart.shadow':false,'chart.shadow.color':'#aaa','chart.shadow.offsetx':0,'chart.shadow.offsety':0,'chart.shadow.blur':15,'chart.title':'','chart.title.background':null,'chart.title.hpos':null,'chart.title.vpos':null,'chart.title.bold':true,'chart.title.font':null,'chart.title.x':null,'chart.title.y':null,'chart.title.halign':null,'chart.title.valign':null,'chart.labels':null,'chart.labels.color':null,'chart.labels.position':'center','chart.labels.axes':'nsew','chart.labels.boxed':false,'chart.labels.offset':0,'chart.text.color':'black','chart.text.font':'Segoe UI, Arial, Verdana, sans-serif','chart.text.size':12,'chart.text.accessible':true,'chart.text.accessible.overflow':'visible','chart.text.accessible.pointerevents':true,'chart.key':null,'chart.key.background':'white','chart.key.position':'graph','chart.key.halign':'right','chart.key.shadow':false,'chart.key.shadow.color':'#666','chart.key.shadow.blur':3,'chart.key.shadow.offsetx':2,'chart.key.shadow.offsety':2,'chart.key.position.gutter.boxed':false,'chart.key.position.x':null,'chart.key.position.y':null,'chart.key.color.shape':'square','chart.key.rounded':true,'chart.key.linewidth':1,'chart.key.colors':null,'chart.key.interactive':false,'chart.key.interactive.highlight.chart.stroke':'black','chart.key.interactive.highlight.chart.fill':'rgba(255,255,255,0.7)','chart.key.interactive.highlight.label':'rgba(255,0,0,0.2)','chart.key.text.color':'black','chart.contextmenu':null,'chart.tooltips':null,'chart.tooltips.event':'onclick','chart.tooltips.effect':'fade','chart.tooltips.css.class':'RGraph_tooltip','chart.tooltips.highlight':true,'chart.highlight.stroke':'rgba(0,0,0,0)','chart.highlight.fill':'rgba(255,255,255,0.7)','chart.annotatable':false,'chart.annotate.color':'black','chart.zoom.factor':1.5,'chart.zoom.fade.in':true,'chart.zoom.fade.out':true,'chart.zoom.hdir':'right','chart.zoom.vdir':'down','chart.zoom.frames':25,'chart.zoom.delay':16.666,'chart.zoom.shadow':true,'chart.zoom.background':true,'chart.zoom.action':'zoom','chart.resizable':false,'chart.resize.handle.adjust':[0,0],'chart.resize.handle.background':null,'chart.adjustable':false,'chart.ymax':null,'chart.ymin':0,'chart.scale.decimals':null,'chart.scale.point':'.','chart.scale.thousand':',','chart.variant':'stacked','chart.variant.threed.depth':10,'chart.exploded':0,'chart.events.mousemove':null,'chart.events.click':null,'chart.animation.roundrobin.factor':1,'chart.animation.roundrobin.radius':true,'chart.animation.grow.multiplier':1,'chart.labels.count':5,'chart.segment.highlight':false,'chart.segment.highlight.count':null,'chart.segment.highlight.fill':'rgba(0,255,0,0.5)','chart.segment.highlight.stroke':'rgba(0,0,0,0)','chart.clearto':'rgba(0,0,0,0)'}
for(var i=0;i<this.data.length;++i){if(typeof this.data[i]==='string'){this.data[i]=parseFloat(this.data[i]);}else if(typeof this.data[i]==='object'){for(var j=0;j<this.data[i].length;++j){if(typeof this.data[i][j]==='string'){this.data[i][j]=parseFloat(this.data[i][j]);}}}}
var linear_data=RGraph.arrayLinearize(this.data);for(var i=0;i<linear_data.length;++i){this["$"+i]={};}
if(!this.canvas.__rgraph_aa_translated__){this.context.translate(0.5,0.5);this.canvas.__rgraph_aa_translated__=true;}
var RG=RGraph,ca=this.canvas,co=ca.getContext('2d'),prop=this.properties,pa2=RG.path2,win=window,doc=document,ma=Math
if(RG.Effects&&typeof RG.Effects.decorate==='function'){RG.Effects.decorate(this);}
this.set=this.Set=function(name)
{var value=typeof arguments[1]==='undefined'?null:arguments[1];if(arguments.length===1&&typeof name==='object'){RG.parseObjectStyleConfig(this,name);return this;}
if(name.substr(0,6)!='chart.'){name='chart.'+name;}
while(name.match(/([A-Z])/)){name=name.replace(/([A-Z])/,'.'+RegExp.$1.toLowerCase());}
if(name==='chart.background.grid.spokes')name='chart.background.grid.radials';if(name==='chart.segments.highlight')name='chart.segment.highlight';if(name==='chart.segments.highlight.fill')name='chart.segment.highlight.fill';if(name==='chart.segments.highlight.stroke')name='chart.segment.highlight.stroke';prop[name.toLowerCase()]=value;return this;};this.get=this.Get=function(name)
{if(name.substr(0,6)!='chart.'){name='chart.'+name;}
while(name.match(/([A-Z])/)){name=name.replace(/([A-Z])/,'.'+RegExp.$1.toLowerCase());}
return prop[name.toLowerCase()];};this.draw=this.Draw=function()
{RG.fireCustomEvent(this,'onbeforedraw');this.gutterLeft=prop['chart.gutter.left'];this.gutterRight=prop['chart.gutter.right'];this.gutterTop=prop['chart.gutter.top'];this.gutterBottom=prop['chart.gutter.bottom'];this.radius=(ma.min(ca.width-this.gutterLeft-this.gutterRight,ca.height-this.gutterTop-this.gutterBottom)/2);this.centerx=((ca.width-this.gutterLeft-this.gutterRight)/2)+this.gutterLeft;this.centery=((ca.height-this.gutterTop-this.gutterBottom)/2)+this.gutterTop;this.angles=[];this.angles2=[];this.total=0;this.startRadians=prop['chart.angles.start'];this.coordsText=[];if(prop['chart.key']&&prop['chart.key'].length>0&&prop['chart.key'].length>=3){this.centerx=this.centerx-this.gutterRight+5;}
if(typeof prop['chart.centerx']=='number')this.centerx=prop['chart.centerx'];if(typeof prop['chart.centery']=='number')this.centery=prop['chart.centery'];if(typeof prop['chart.radius']=='number')this.radius=prop['chart.radius'];if(!this.colorsParsed){this.parseColors();this.colorsParsed=true;}
if(prop['chart.variant'].indexOf('3d')!==-1){var scaleX=1.5;this.context.setTransform(scaleX,0,0,1,(ca.width*scaleX-ca.width)* -0.5,0);}
this.drawBackground();if(prop['chart.variant'].indexOf('3d')!==-1){RG.setShadow(this,'rgba(0,0,0,0.35)',0,15,25);for(var i=prop['chart.variant.threed.depth'];i>0;i-=1){this.centery-=1;this.drawRose({storeAngles:false});RG.setShadow(this,'rgba(0,0,0,0)',0,0,0);for(var j=0,len=this.angles.length;j<len;j+=1){var a=this.angles[j];pa2(co,['b','m',a[4],a[5],'a',a[4],a[5],a[3]+1.5,a[0]-0.01,a[1]+0.01,false,'c','f','rgba(0,0,0,0.1)']);}}}
this.drawRose();this.drawLabels();co.strokeStyle='rgba(0,0,0,0)'
if(prop['chart.contextmenu']){RG.ShowContext(this);}
if(prop['chart.resizable']){RG.AllowResizing(this);}
if(prop['chart.adjustable']){RG.AllowAdjusting(this);}
RG.InstallEventListeners(this);if(prop['chart.segment.highlight']){if(!RG.allowSegmentHighlight){alert('[WARNING] The segment highlight function does not exist - have you included the dynamic library?');}
RG.allowSegmentHighlight({object:this,count:typeof prop['chart.segment.highlight.count']==='number'?prop['chart.segment.highlight.count']:this.data.length,fill:prop['chart.segment.highlight.fill'],stroke:prop['chart.segment.highlight.stroke']});}
if(this.firstDraw){this.firstDraw=false;RG.fireCustomEvent(this,'onfirstdraw');this.firstDrawFunc();}
RG.FireCustomEvent(this,'ondraw');return this;};this.drawBackground=this.DrawBackground=function()
{co.lineWidth=1;if(prop['chart.background.grid']){if(typeof(prop['chart.background.grid.count'])=='number'){prop['chart.background.grid.size']=this.radius/prop['chart.background.grid.count'];}
co.beginPath();co.strokeStyle=prop['chart.background.grid.color'];for(var i=prop['chart.background.grid.size'];i<=this.radius;i+=prop['chart.background.grid.size']){co.moveTo(this.centerx+i,this.centery);co.arc(this.centerx,this.centery,i,0,RG.TWOPI,false);}
co.stroke();co.beginPath();if(typeof prop['chart.background.grid.radials']!=='number'){prop['chart.background.grid.radials']=this.data.length}
var num=(360/prop['chart.background.grid.radials']);for(var i=num;i<=360;i+=num){co.arc(this.centerx,this.centery,this.radius,((i/(180/RG.PI))-RG.HALFPI)+this.startRadians,(((i+0.0001)/(180/RG.PI))-RG.HALFPI)+this.startRadians,false);co.lineTo(this.centerx,this.centery);}
co.stroke();}
if(prop['chart.background.axes']){co.beginPath();co.strokeStyle=prop['chart.background.axes.color'];co.moveTo(this.centerx-this.radius,ma.round(this.centery));co.lineTo(this.centerx+this.radius,ma.round(this.centery));co.moveTo(ma.round(this.centerx-this.radius),this.centery-5);co.lineTo(ma.round(this.centerx-this.radius),this.centery+5);co.moveTo(ma.round(this.centerx+this.radius),this.centery-5);co.lineTo(ma.round(this.centerx+this.radius),this.centery+5);for(var i=(this.centerx-this.radius);i<(this.centerx+this.radius);i+=(this.radius/5)){co.moveTo(ma.round(i),this.centery-3);co.lineTo(ma.round(i),this.centery+3.5);}
for(var i=(this.centery-this.radius);i<(this.centery+this.radius);i+=(this.radius/5)){co.moveTo(this.centerx-3,ma.round(i));co.lineTo(this.centerx+3,ma.round(i));}
co.moveTo(ma.round(this.centerx),this.centery-this.radius);co.lineTo(ma.round(this.centerx),this.centery+this.radius);co.moveTo(this.centerx-5,ma.round(this.centery-this.radius));co.lineTo(this.centerx+5,ma.round(this.centery-this.radius));co.moveTo(this.centerx-5,ma.round(this.centery+this.radius));co.lineTo(this.centerx+5,ma.round(this.centery+this.radius));co.closePath();co.stroke();}
pa2(co,'b c');};this.drawRose=this.DrawRose=function()
{var max=0,data=this.data,margin=RG.degrees2Radians(prop['chart.margin']),opt=arguments[0]||{};co.lineWidth=prop['chart.linewidth'];if(RG.isNull(prop['chart.ymax'])){for(var i=0;i<data.length;++i){if(typeof data[i]=='number'){max=ma.max(max,data[i]);}else if(typeof data[i]=='object'&&prop['chart.variant'].indexOf('non-equi-angular')!==-1){max=ma.max(max,data[i][0]);}else{max=ma.max(max,RG.arraySum(data[i]));}}
this.scale2=RG.getScale2(this,{'max':max,'min':0,'scale.thousand':prop['chart.scale.thousand'],'scale.point':prop['chart.scale.point'],'scale.decimals':prop['chart.scale.decimals'],'ylabels.count':prop['chart.labels.count'],'scale.round':prop['chart.scale.round'],'units.pre':prop['chart.units.pre'],'units.post':prop['chart.units.post']});this.max=this.scale2.max;}else{var ymax=prop['chart.ymax'];this.scale2=RG.getScale2(this,{'max':ymax,'strict':true,'scale.thousand':prop['chart.scale.thousand'],'scale.point':prop['chart.scale.point'],'scale.decimals':prop['chart.scale.decimals'],'ylabels.count':prop['chart.labels.count'],'scale.round':prop['chart.scale.round'],'units.pre':prop['chart.units.pre'],'units.post':prop['chart.units.post']});this.max=this.scale2.max}
this.sum=RG.arraySum(data);co.moveTo(this.centerx,this.centery);co.stroke();if(prop['chart.colors.alpha']){co.globalAlpha=prop['chart.colors.alpha'];}
var sequentialIndex=0;if(typeof(prop['chart.variant'])=='string'&&prop['chart.variant'].indexOf('non-equi-angular')!==-1){var total=0;for(var i=0;i<data.length;++i){total+=data[i][1];}
if(prop['chart.shadow']){RG.setShadow(this,prop['chart.shadow.color'],prop['chart.shadow.offsetx'],prop['chart.shadow.offsety'],prop['chart.shadow.blur']);}
for(var i=0;i<this.data.length;++i){var segmentRadians=((this.data[i][1]/total)*RG.TWOPI);var radius=((this.data[i][0]-prop['chart.ymin'])/(this.max-prop['chart.ymin']))*this.radius;radius=radius*prop['chart.animation.grow.multiplier'];co.strokeStyle=prop['chart.strokestyle'];co.fillStyle=prop['chart.colors'][0];if(prop['chart.colors.sequential']){co.fillStyle=prop['chart.colors'][i];}
co.beginPath();var startAngle=(this.startRadians*prop['chart.animation.roundrobin.factor'])-RG.HALFPI+margin;var endAngle=((this.startRadians+segmentRadians)*prop['chart.animation.roundrobin.factor'])-RG.HALFPI-margin;var exploded=this.getexploded(i,startAngle,endAngle,prop['chart.exploded']);var explodedX=exploded[0];var explodedY=exploded[1];co.arc(this.centerx+explodedX,this.centery+explodedY,prop['chart.animation.roundrobin.radius']?radius*prop['chart.animation.roundrobin.factor']:radius,startAngle,endAngle,0);co.lineTo(this.centerx+explodedX,this.centery+explodedY);co.closePath();co.stroke();co.fill();this.angles[i]=[startAngle,endAngle,0,prop['chart.animation.roundrobin.radius']?radius*prop['chart.animation.roundrobin.factor']:radius,this.centerx+explodedX,this.centery+explodedY,co.strokeStyle,co.fillStyle];sequentialIndex++;this.startRadians+=segmentRadians;}
if(prop['chart.shadow']){RG.noShadow(this);this.redrawRose();}}else{var sequentialColorIndex=0;if(prop['chart.shadow']){RG.setShadow(this,prop['chart.shadow.color'],prop['chart.shadow.offsetx'],prop['chart.shadow.offsety'],prop['chart.shadow.blur']);}
for(var i=0;i<this.data.length;++i){var segmentRadians=(1/this.data.length)*RG.TWOPI;if(typeof this.data[i]=='number'){co.beginPath();co.strokeStyle=prop['chart.strokestyle'];co.fillStyle=prop['chart.colors'][0];if(prop['chart.colors.sequential']){co.fillStyle=prop['chart.colors'][i];}
var radius=((this.data[i]-prop['chart.ymin'])/(this.max-prop['chart.ymin']))*this.radius;radius=radius*prop['chart.animation.grow.multiplier'];var startAngle=(this.startRadians*prop['chart.animation.roundrobin.factor'])-RG.HALFPI+margin;var endAngle=(this.startRadians*prop['chart.animation.roundrobin.factor'])+(segmentRadians*prop['chart.animation.roundrobin.factor'])-RG.HALFPI-margin;var exploded=this.getexploded(i,startAngle,endAngle,prop['chart.exploded']);var explodedX=exploded[0];var explodedY=exploded[1];co.arc(this.centerx+explodedX,this.centery+explodedY,prop['chart.animation.roundrobin.radius']?radius*prop['chart.animation.roundrobin.factor']:radius,startAngle,endAngle,0);co.lineTo(this.centerx+explodedX,this.centery+explodedY);co.closePath();co.stroke();co.fill();co.beginPath();if(endAngle==0){}
this.angles[i]=[startAngle,endAngle,0,radius*prop['chart.animation.roundrobin.factor'],this.centerx+explodedX,this.centery+explodedY,co.strokeStyle,co.fillStyle];sequentialIndex++;}else if(typeof(this.data[i])=='object'){var margin=prop['chart.margin']/(180/RG.PI);if(!this.angles2[i]){this.angles2[i]=[];}
for(var j=0;j<this.data[i].length;++j){var startAngle=(this.startRadians*prop['chart.animation.roundrobin.factor'])-RG.HALFPI+margin;var endAngle=(this.startRadians*prop['chart.animation.roundrobin.factor'])+(segmentRadians*prop['chart.animation.roundrobin.factor'])-RG.HALFPI-margin;var exploded=this.getexploded(i,startAngle,endAngle,prop['chart.exploded']);var explodedX=exploded[0];var explodedY=exploded[1];co.strokeStyle=prop['chart.strokestyle'];co.fillStyle=prop['chart.colors'][j];if(prop['chart.colors.sequential']){co.fillStyle=prop['chart.colors'][sequentialColorIndex++];}
if(j==0){co.beginPath();var startRadius=0;var endRadius=((this.data[i][j]-prop['chart.ymin'])/(this.max-prop['chart.ymin']))*this.radius;endRadius=endRadius*prop['chart.animation.grow.multiplier'];co.arc(this.centerx+explodedX,this.centery+explodedY,prop['chart.animation.roundrobin.radius']?endRadius*prop['chart.animation.roundrobin.factor']:endRadius,startAngle,endAngle,0);co.lineTo(this.centerx+explodedX,this.centery+explodedY);co.closePath();co.stroke();co.fill();this.angles[sequentialIndex++]=[startAngle,endAngle,0,endRadius*prop['chart.animation.roundrobin.factor'],this.centerx+explodedX,this.centery+explodedY,co.strokeStyle,co.fillStyle];this.angles2[i][j]=[startAngle,endAngle,0,endRadius*prop['chart.animation.roundrobin.factor'],this.centerx+explodedX,this.centery+explodedY,co.strokeStyle,co.fillStyle];}else{co.beginPath();var startRadius=endRadius;var endRadius=(((this.data[i][j]-prop['chart.ymin'])/(this.max-prop['chart.ymin']))*this.radius)+startRadius;endRadius=endRadius*prop['chart.animation.grow.multiplier'];co.arc(this.centerx+explodedX,this.centery+explodedY,startRadius*prop['chart.animation.roundrobin.factor'],startAngle,endAngle,0);co.arc(this.centerx+explodedX,this.centery+explodedY,endRadius*prop['chart.animation.roundrobin.factor'],endAngle,startAngle,true);co.closePath();co.stroke();co.fill();this.angles[sequentialIndex++]=[startAngle,endAngle,startRadius*prop['chart.animation.roundrobin.factor'],endRadius*prop['chart.animation.roundrobin.factor'],this.centerx+explodedX,this.centery+explodedY,co.strokeStyle,co.fillStyle];this.angles2[i][j]=[startAngle,endAngle,startRadius*prop['chart.animation.roundrobin.factor'],endRadius*prop['chart.animation.roundrobin.factor'],this.centerx+explodedX,this.centery+explodedY,co.strokeStyle,co.fillStyle];}}}
this.startRadians+=segmentRadians;}
if(prop['chart.shadow']){RG.noShadow(this);}
if(prop['chart.shadow']){this.redrawRose();}}
if(prop['chart.colors.alpha']){co.globalAlpha=1;}
if(prop['chart.title']){RG.drawTitle(this,prop['chart.title'],(ca.height/2)-this.radius,this.centerx,prop['chart.title.size']?prop['chart.title.size']:prop['chart.text.size']+2);}};this.redrawRose=function()
{var angles=this.angles;for(var i=0;i<angles.length;++i){pa2(co,'b a % % % % % false a % % % % % true c f % f % ',angles[i][4],angles[i][5],angles[i][2],angles[i][0],angles[i][1],angles[i][4],angles[i][5],angles[i][3],angles[i][1],angles[i][0],angles[i][6],angles[i][7]);}};this.drawLabels=this.DrawLabels=function()
{co.lineWidth=1;var key=prop['chart.key'];if(key&&key.length){RG.DrawKey(this,key,prop['chart.colors']);}
co.fillStyle=prop['chart.text.color'];co.strokeStyle='black';var radius=this.radius,font=prop['chart.text.font'],size=prop['chart.text.size'],axes=prop['chart.labels.axes'].toLowerCase(),decimals=prop['chart.scale.decimals'],units_pre=prop['chart.units.pre'],units_post=prop['chart.units.post'],centerx=this.centerx,centery=this.centery+(prop['chart.variant'].indexOf('3d')!==-1?prop['chart.variant.threed.depth']:0);if(typeof prop['chart.labels']=='object'&&prop['chart.labels']){this.DrawCircularLabels(co,prop['chart.labels'],font,size,radius+10);}
if(typeof(prop['chart.text.size.scale'])=='number'){size=prop['chart.text.size.scale'];}
var color='rgba(255,255,255,0.8)';if(axes.indexOf('n')>-1){for(var i=0;i<prop['chart.labels.count'];++i){RG.text2(this,{'font':font,'size':size,'x':centerx-10,'y':centery-(radius*((i+1)/prop['chart.labels.count'])),'text':this.scale2.labels[i],'valign':'center','halign':'right','bounding':true,'bounding.fill':color,'bounding.stroke':prop['chart.labels.boxed']?'black':'rgba(0,0,0,0)','tag':'scale'});}}
if(axes.indexOf('s')>-1){for(var i=0;i<prop['chart.labels.count'];++i){RG.Text2(this,{'font':font,'size':size,'x':centerx-10,'y':centery+(radius*((i+1)/prop['chart.labels.count'])),'text':this.scale2.labels[i],'valign':'center','halign':'right','bounding':true,'bounding.fill':color,'bounding.stroke':prop['chart.labels.boxed']?'black':'rgba(0,0,0,0)','tag':'scale'});}}
if(axes.indexOf('e')>-1){for(var i=0;i<prop['chart.labels.count'];++i){RG.Text2(this,{'font':font,'size':size,'x':centerx+(radius*((i+1)/prop['chart.labels.count'])),'y':centery+10,'text':this.scale2.labels[i],'valign':'top','halign':'center','bounding':true,'bounding.fill':color,'bounding.stroke':prop['chart.labels.boxed']?'black':'rgba(0,0,0,0)','tag':'scale'});}}
if(axes.indexOf('w')>-1){for(var i=0;i<prop['chart.labels.count'];++i){RG.Text2(this,{'font':font,'size':size,'x':centerx-(radius*((i+1)/prop['chart.labels.count'])),'y':centery+10,'text':this.scale2.labels[i],'valign':'top','halign':'center','bounding':true,'bounding.fill':color,'bounding.stroke':prop['chart.labels.boxed']?'black':'rgba(0,0,0,0)','tag':'scale'});}}
if(RG.trim(axes).length>0){RG.Text2(this,{'font':font,'size':size,'x':centerx,'y':centery,'text':typeof prop['chart.ymin']==='number'?RG.numberFormat(this,Number(prop['chart.ymin']).toFixed(prop['chart.ymin']===0?'0':prop['chart.scale.decimals']),units_pre,units_post):'0','valign':'center','halign':'center','bounding':true,'bounding.fill':color,'bounding.stroke':prop['chart.labels.boxed']?'black':'rgba(0,0,0,0)','tag':'scale'});}};this.drawCircularLabels=this.DrawCircularLabels=function(co,labels,font,size,radius)
{var variant=prop['chart.variant'],position=prop['chart.labels.position'],radius=radius+5+prop['chart.labels.offset'],centerx=this.centerx,centery=this.centery+(prop['chart.variant'].indexOf('3d')!==-1?prop['chart.variant.threed.depth']:0),labelsColor=prop['chart.labels.color']||prop['chart.text.color'],angles=this.angles
for(var i=0;i<this.data.length;++i){if(typeof(variant)=='string'&&variant.indexOf('non-equi-angular')!==-1){var a=Number(angles[i][0])+((angles[i][1]-angles[i][0])/2);}else{var a=(RG.TWOPI/this.data.length)*(i+1)-(RG.TWOPI/(this.data.length*2));var a=a-RG.HALFPI+(prop['chart.labels.position']=='edge'?((RG.TWOPI/this.data.length)/2):0);}
var x=centerx+(ma.cos(a)*radius);var y=centery+(ma.sin(a)*radius);if(x>centerx){halign='left';}else if(Math.round(x)==centerx){halign='center';}else{halign='right';}
RG.text2(this,{'color':labelsColor,'font':font,'size':size,'x':x,'y':y,'text':String(labels[i]),'halign':halign,'valign':'center','tag':'labels'});}};this.getShape=this.getSegment=function(e)
{RG.fixEventObject(e);var angles=this.angles;var ret=[];var opt=arguments[1]?arguments[1]:{radius:true};for(var i=0;i<angles.length;++i){var angleStart=angles[i][0];var angleEnd=angles[i][1];var radiusStart=opt.radius===false?0:angles[i][2];var radiusEnd=opt.radius===false?this.radius:angles[i][3];var centerX=angles[i][4];var centerY=angles[i][5];var mouseXY=RG.getMouseXY(e);var mouseX=mouseXY[0]-centerX;var mouseY=mouseXY[1]-centerY;co.beginPath();co.arc(centerX,centerY,radiusStart?radiusStart:0.01,angleStart,angleEnd,false);co.arc(centerX,centerY,radiusEnd,angleEnd,angleStart,true);co.closePath();if(co.isPointInPath(mouseXY[0],mouseXY[1])){angles[i][6]=i;if(RG.parseTooltipText){var tooltip=RG.parseTooltipText(prop['chart.tooltips'],angles[i][6]);}
angles[i]['object']=this;angles[i]['x']=angles[i][4];angles[i]['y']=angles[i][5];angles[i]['angle.start']=angles[i][0];angles[i]['angle.end']=angles[i][1];angles[i]['radius.start']=angles[i][2];angles[i]['radius.end']=angles[i][3];angles[i]['index']=angles[i][6];angles[i]['tooltip']=tooltip?tooltip:null;return angles[i];}}
return null;};this.getExploded=this.getexploded=function(index,startAngle,endAngle,exploded)
{var explodedx,explodedy;if(typeof(exploded)=='object'&&typeof(exploded[index])=='number'){explodedx=Math.cos(((endAngle-startAngle)/2)+startAngle)*exploded[index];explodedy=Math.sin(((endAngle-startAngle)/2)+startAngle)*exploded[index];}else if(typeof(exploded)=='number'){explodedx=Math.cos(((endAngle-startAngle)/2)+startAngle)*exploded;explodedy=Math.sin(((endAngle-startAngle)/2)+startAngle)*exploded;}else{explodedx=0;explodedy=0;}
return[explodedx,explodedy];};this.allowTooltips=this.AllowTooltips=function()
{RG.PreLoadTooltipImages(this);RG.InstallWindowMousedownTooltipListener(this);RG.InstallCanvasMousemoveTooltipListener(this);RG.InstallCanvasMouseupTooltipListener(this);};this.highlight=this.Highlight=function(shape)
{if(prop['chart.tooltips.highlight']){if(typeof prop['chart.highlight.style']==='function'){(prop['chart.highlight.style'])(shape);return;}
co.beginPath();co.strokeStyle=prop['chart.highlight.stroke'];co.fillStyle=prop['chart.highlight.fill'];co.arc(shape['x'],shape['y'],shape['radius.end'],shape['angle.start'],shape['angle.end'],false);if(shape['radius.start']>0){co.arc(shape['x'],shape['y'],shape['radius.start'],shape['angle.end'],shape['angle.start'],true);}else{co.lineTo(shape['x'],shape['y']);}
co.closePath();co.stroke();co.fill();}};this.getObjectByXY=function(e)
{var mouseXY=RGraph.getMouseXY(e);var radius=RG.getHypLength(this.centerx,this.centery,mouseXY[0],mouseXY[1]);if(prop['chart.variant'].indexOf('3d')!==-1){radius/=-1;}
if(mouseXY[0]>(this.centerx-this.radius)&&mouseXY[0]<(this.centerx+this.radius)&&mouseXY[1]>(this.centery-this.radius)&&mouseXY[1]<(this.centery+this.radius)&&radius<=this.radius){return this;}};this.getRadius=function(value)
{if(value<0||value>this.max){return null;}
var r=(value/this.max)*this.radius;return r;};this.parseColors=function()
{if(this.original_colors.length===0){this.original_colors['chart.colors']=RG.array_clone(prop['chart.colors']);this.original_colors['chart.key.colors']=RG.array_clone(prop['chart.key.colors']);this.original_colors['chart.text.color']=RG.array_clone(prop['chart.text.color']);this.original_colors['chart.title.color']=RG.array_clone(prop['chart.title.color']);this.original_colors['chart.highlight.stroke']=RG.array_clone(prop['chart.highlight.stroke']);this.original_colors['chart.highlight.fill']=RG.array_clone(prop['chart.highlight.fill']);}
for(var i=0;i<prop['chart.colors'].length;++i){prop['chart.colors'][i]=this.parseSingleColorForGradient(prop['chart.colors'][i]);}
if(!RG.is_null(prop['chart.key.colors'])){for(var i=0;i<prop['chart.key.colors'].length;++i){prop['chart.key.colors'][i]=this.parseSingleColorForGradient(prop['chart.key.colors'][i]);}}
prop['chart.text.color']=this.parseSingleColorForGradient(prop['chart.text.color']);prop['chart.title.color']=this.parseSingleColorForGradient(prop['chart.title.color']);prop['chart.highlight.fill']=this.parseSingleColorForGradient(prop['chart.highlight.fill']);prop['chart.highlight.stroke']=this.parseSingleColorForGradient(prop['chart.highlight.stroke']);prop['chart.segment.highlight.stroke']=this.parseSingleColorForGradient(prop['chart.segment.highlight.stroke']);prop['chart.segment.highlight.fill']=this.parseSingleColorForGradient(prop['chart.segment.highlight.fill']);};this.reset=function()
{};this.parseSingleColorForGradient=function(color)
{if(!color||typeof(color)!='string'){return color;}
if(color.match(/^gradient\((.*)\)$/i)){var parts=RegExp.$1.split(':');var grad=co.createRadialGradient(this.centerx,this.centery,0,this.centerx,this.centery,this.radius);var diff=1/(parts.length-1);grad.addColorStop(0,RG.trim(parts[0]));for(var j=1;j<parts.length;++j){grad.addColorStop(j*diff,RG.trim(parts[j]));}}
return grad?grad:color;};this.interactiveKeyHighlight=function(index)
{var segments=this.angles2;for(var i=0;i<this.angles2.length;i+=1){co.beginPath();co.lineWidth=2;co.fillStyle=prop['chart.key.interactive.highlight.chart.fill'];co.strokeStyle=prop['chart.key.interactive.highlight.chart.stroke'];co.arc(segments[i][index][4],segments[i][index][5],segments[i][index][2],segments[i][index][0],segments[i][index][1],false);co.arc(segments[i][index][4],segments[i][index][5],segments[i][index][3],segments[i][index][1],segments[i][index][0],true);co.closePath();co.fill();co.stroke();}
return};this.on=function(type,func)
{if(type.substr(0,2)!=='on'){type='on'+type;}
if(typeof this[type]!=='function'){this[type]=func;}else{RG.addCustomEventListener(this,type,func);}
return this;};this.firstDrawFunc=function()
{};this.explode=function()
{var obj=this;var opt=arguments[0]||{};var callback=arguments[1]||function(){};var frames=opt.frames?opt.frames:30;var frame=0;var explodedMax=ma.max(ca.width,ca.height);var exploded=Number(this.Get('exploded'));function iterator()
{exploded=(frame/frames)*explodedMax;obj.Set('exploded',exploded);RG.clear(ca);RG.redrawCanvas(ca);if(frame++<frames){RG.Effects.updateCanvas(iterator);}else{callback(obj);}}
iterator();return this;};this.roundrobin=this.roundRobin=function()
{var obj=this;var opt=arguments[0]||{}
var frames=opt.frames||30;var frame=0;var original_margin=prop['chart.margin'];var margin=(360/this.data.length)/2;var callback=arguments[1]||function(){};this.Set('chart.margin',margin);this.Set('chart.animation.roundrobin.factor',0);function iterator()
{RG.clear(obj.canvas);RG.redrawCanvas(obj.canvas);if(frame++<frames){obj.set('animation.roundrobin.factor',frame/frames);obj.set('margin',(frame/frames)*original_margin);RG.Effects.updateCanvas(iterator);}else{obj.set('animation.roundrobin.factor',1);obj.set('margin',original_margin);callback(obj);}}
iterator();return this;};this.implode=function()
{var obj=this;var opt=arguments[0]||{};var callback=arguments[1]||function(){};var frames=opt.frames||30;var frame=0;var explodedMax=ma.max(ca.width,ca.height);var exploded=explodedMax;function iterator()
{exploded=explodedMax-((frame/frames)*explodedMax);obj.Set('exploded',exploded);RG.clear(ca);RG.redrawCanvas(ca);if(frame++<frames){RG.Effects.updateCanvas(iterator);}else{RG.clear(obj.canvas);RG.redrawCanvas(obj.canvas);callback(obj);}}
iterator();return this;};this.grow=function()
{var obj=this;var opt=arguments[0]||{};var callback=arguments[1]||function(){};var frames=opt.frames||30;var frame=0;function iterator()
{obj.Set('animation.grow.multiplier',frame/frames);RG.clear(ca);RG.redrawCanvas(ca);if(frame<frames){frame++;RG.Effects.updateCanvas(iterator);}else{callback(obj);}}
iterator();return this;};RG.Register(this);if(parseConfObjectForOptions){RG.parseObjectStyleConfig(this,conf.options);}};