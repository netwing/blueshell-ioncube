#include "easing_equations.as"
/*
version 1.2.0 AS1
*/
//
var Mp = MovieClip.prototype;
//
Mp.addListener = function() {
 if (!this._listeners) {
  AsBroadcaster.initialize(this);}
 this.addListener.apply(this,arguments);
};
ASSetPropFlags(Mp, "addListener", 1, 0);


//
function tweenManager() {
 this.playing = false
 this.autoStop = false;
 this.broadcastEvents = false; 
 this.autoOverwrite = true; 
 this.tweenList = new Array()
 this.ints = new Array();
 this.lockedTweens = new Object();
 this.now = 0;
 this._th_depth = 6789;
 this.isPaused = false;
 /* ch 120
 this.pausedTime = 0;
 */
}
var tp = tweenManager.prototype;
tp.setupdateInterval = function(time){
	if (this.playing){
		this.deinit()
		this.updateTime = time
		this.init()
	}else{
		this.updateTime = time
	}

}
tp.getupdateInterval = function(){
	return this.updateTime;
}
tp.addProperty("updateInterval",tp.getupdateInterval, tp.setupdateInterval);
// 
tp.setcontrollerDepth = function(v){
 if (_global.isNaN(v)==true) return;
 if(this.tweenHolder._name!=undefined){
	this.tweenHolder.swapDepths(v);
 }else{
	this._th_depth = v;
 }	
}
tp.getcontrollerDepth = function(){
 return this._th_depth;	
}
tp.addProperty("controllerDepth",tp.getcontrollerDepth, tp.setcontrollerDepth);
//
tp.init = function(){
	var tm = this;	
	if(tm.updateTime > 0){
		clearInterval(tm.updateIntId); //
		tm.updateIntId = setInterval(tm,"update",tm.updateTime);
	}else{
		if(tm.tweenHolder._name == undefined){
			tm.tweenHolder = _root.createEmptyMovieClip("_th_",tm._th_depth); 
		}

		tm.tweenHolder.onEnterFrame = function(){				
			tm.update.call(tm);
		}
	}
	tm.playing = true;
	tm.now = getTimer();
}
//
tp.deinit = function(){
	this.playing = false;
	clearInterval(this.updateIntId);
	delete this.tweenHolder.onEnterFrame;
}
//-------------------------- private  methods
tp.update = function() {
	
	var i, t, j,ttm, missing = false;
	
	i = this.tweenList.length;
	if(this.broadcastEvents){
		var ut,et,up,ep;
		ut = {};// list of updated mcs
		et = {};// list of ending mcs
		up = {};// -(MosesSupposes)- list of updated props
		ep = {};// -(MosesSupposes)- list of ending props
	}
	while (i--) {
		t = this.tweenList[i];
		if (t.mc._x == undefined) {	//-(MosesSupposes)- for cleanUp()
			missing = true;
			continue;
		}
		if (t.pt != -1) continue;	//-(MosesSupposes)- skip processing paused tween
		if (t.ts+t.d>this.now) {
			// compute value using equation function
			if (t.ctm == undefined) {
				// compute primitive value
				t.mc[t.pp] = t.ef(this.now-t.ts, t.ps, t.ch, t.d, t.e1, t.e2);
			} else {
				// compute color transform matrix 
				// stm is starting transform matrix, 
				// ctm is change in start & destination matrix 
				// ttm is computed (temporary) transform matrix
				// c is color object
				ttm = {};
				for (j in t.ctm) {
					ttm[j] = t.ef(this.now-t.ts, t.stm[j], t.ctm[j], t.d, t.e1, t.e2);
				}
				t.c.setTransform(ttm);
			}
			if(this.broadcastEvents){
				if(ut[targetpath(t.mc)] == undefined){
						ut[targetpath(t.mc)] = t.mc;
				}
				if(up[targetpath(t.mc)] == undefined){// -(MosesSupposes)- 
						up[targetpath(t.mc)] = [];
				}
				up[targetpath(t.mc)].push(t.ctm!=undefined ? '_ct_' : t.pp);
			}
			if(t.cb.updfunc != undefined){
				//t.cb.updfunc.apply(t.cb.updscope,t.cb.updargs);
				var f = t.cb.updfunc;
				if (typeof f=='string' && t.cb.updscope!=undefined) f = t.cb.updscope[f];
				f.apply(t.cb.updscope,t.cb.updargs);	
			}
		} else {
			// end , set up the property to end value;
			if (t.ctm == undefined) {
				t.mc[t.pp] = t.ps+t.ch;
			} else {
				ttm = {};
				for (j in t.ctm) {
					ttm[j] = t.stm[j]+t.ctm[j];
				}
				t.c.setTransform(ttm);
			}
			if(this.broadcastEvents){
					if(ut[targetpath(t.mc)] == undefined){
						ut[targetpath(t.mc)] = t.mc;
					}
					if(et[targetpath(t.mc)] == undefined){
						et[targetpath(t.mc)] = t.mc;
					}
					if(up[targetpath(t.mc)] == undefined){// -(MosesSupposes)- 
						up[targetpath(t.mc)] = [];
					}
					up[targetpath(t.mc)].push(t.ctm!=undefined ? '_ct_' : t.pp);
					if(ep[targetpath(t.mc)] == undefined){// -(MosesSupposes)- 
						ep[targetpath(t.mc)] = [];
					}
					ep[targetpath(t.mc)].push(t.ctm!=undefined ? '_ct_' : t.pp);
			}
			if(t.cb.updfunc != undefined){
				//t.cb.updfunc.apply(t.cb.updscope,t.cb.updargs);
				var f = t.cb.updfunc;
				if (typeof f=='string' && t.cb.updscope!=undefined) f = t.cb.updscope[f];
				f.apply(t.cb.updscope,t.cb.updargs);
			}
			if (endt == undefined){
				var endt = new Array();
			}
			endt.push(i);
		}
	}
	if (missing) this.cleanUp();// -(MosesSupposes)- 
	for (j in ut){
		ut[j].broadcastMessage('onTweenUpdate', {target:ut[j], props:up[j]});// -(MosesSupposes)- send array of updated props
	}
	if(endt != undefined){
		this.endTweens(endt);
	}
	for (j in et){
		et[j].broadcastMessage('onTweenEnd', {target:et[j], props:ep[j]});// -(MosesSupposes)- send array of ending props
	}
	this.now = getTimer();
	// update timer 
	if (this.updateTime > 0){
		updateAfterEvent();
	}

};
tp.endTweens = function(tid_arr){
var cb_arr, tl, i, cb, j
cb_arr = []
// splice tweens from tweenlist 
tl = tid_arr.length
with(this){
	for (i = 0; i<tl; i++){
		cb = tweenList[tid_arr[i]].cb
		if(cb != undefined){
			var exec = true;
			//do not add callbacks that are in cb_arr
			for(j in cb_arr){
				if (cb_arr[j] ==  cb){
					exec = false;
					break;
				}
			}
			//
			if(exec){
				cb_arr.push(cb)
			}
		}
		tweenList.splice(tid_arr[i],1);
	}
	// execute callbacks
	for (i = 0; i<cb_arr.length;i++){
		//cb_arr[i].func.apply(cb_arr[i].scope,cb_arr[i].args)
		for (var i = 0; i<cb_arr.length;i++){
			var f = cb_arr[i].func;
			if (typeof f=='string' && cb_arr[i].scope!=undefined) 
			f = cb_arr[i].scope[f];

			f.apply(cb_arr[i].scope,cb_arr[i].args);
		}
	}
	//
	if(tweenList.length==0){
	// last tween removed, erase onenterframe function
		deinit();
	}
}
}

tp.removeDelayedTween = function(index) { //-(MosesSupposes)- broke this out for reuse.
with (this){
        clearInterval(ints[index].intid);
		ints[index] = undefined;
		var isintsempty = true;
		for (var i in ints){
			if (ints[i] != undefined){
				isintsempty = false;
				break;
			}
		}
		if (isintsempty){
			ints = [];
		}
}
}

// ------------- public methods
tp.addTween = function(mc,props,pEnd,sec,eqFunc,callback,extra1,extra2){
	var i, pp, addnew, j, t, ip;
	with(this){
		//
		if(!playing){
			init();
		}
		ip = []; // -(MosesSupposes)- interrupted properties
		for(i in props){
			pp = props[i];
			addnew = true;
			//
			if(pp.substr(0,4)!="_ct_"){
				// there is no color transform prefix, use primitive value tween
				//-(MosesSupposes)- pass string for rel value
				var ch = (typeof pEnd[i]=='string' ? Number(pEnd[i]) : pEnd[i] - mc[pp]);

				if(autoOverwrite){
					// find coliding tween and overwrite it 
					for (j in tweenList){
						t = tweenList[j];
						if(t.mc == mc && t.pp == pp){
							//
							t.ps = mc[pp];
							t.ch = ch;
							t.ts = now;
							t.d = sec*1000;
							t.ef = eqFunc;
							t.cb = callback;
							t.e1 = extra1;
							t.e2 = extra2;
							t.pt = -1;
							addnew = false;		
							ip.push(t.pp);
							break;
						}
					}
				}
				if(addnew){	
				// not found add new
				tweenList.unshift({							
						  mc: mc,				
						  pp: pp, 				
						  ps: mc[pp],			
						  ch: ch, 
						  ts: now, 				
						  d:  sec * 1000, 		
						  ef: eqFunc, 			
						  cb: callback,			
						  e1: extra1,			
						  e2: extra2,
						  pt: -1});			
				}
			} else {
				// color trasform prefix found	
				// compute change matrix
				var c = new Color(mc);
				var stm = c.getTransform();
				// compute difference between starting and desionation matrix
				var ctm = {}
				for(j in pEnd[i]){
					// if is in destination matrix 
					if(pEnd[i][j] != stm[j] && pEnd[i][j] != undefined ){
						ctm[j] = (typeof pEnd[i][j]=='string' ? stm[j] + Number(pEnd[i][j]) : pEnd[i][j] - stm[j]);
					}
				}
				if(autoOverwrite){
				// find coliding tween and overwrite it 
				for (j in tweenList){
					t = tweenList[j];
					if(t.mc == mc && t.ctm != undefined){
							//
							t.c = c
							t.stm = stm	
							t.ctm =  ctm,
							t.ts = now;
							t.d = sec*1000;
							t.ef = eqFunc;
							t.cb = callback;
							t.e1 = extra1;
							t.e2 = extra2;
							t.pt = -1;
							addnew = false;
							ip.push('_ct_');
							break;
						}
					}
				}
				if(addnew){	
				tweenList.unshift({
						mc:  mc,			//reference to movieclip
						c:   c,				//reference to movieclip color
						stm: stm,			//starting transform matrix
						ctm: ctm,			
						ts:  now,
						d:   sec * 1000,
						ef:  eqFunc,
						cb:  callback,
						e1:  extra1,
						e2:  extra2,
						pt: -1
					})
				}			
				
			}
		} // end for
	if(broadcastEvents){
		if (ip.length>0) {
			mc.broadcastMessage('onTweenInterrupt', {target:mc, props:ip});  // -(MosesSupposes)- pass array of props interrupted
		}
		mc.broadcastMessage('onTweenStart', {target:mc, props:props});  // -(MosesSupposes)- pass array of props starting
	}
	if(callback.startfunc != undefined){
		// callback.startfunc.apply(callback.startscope,callback.startargs)
		var f = callback.startfunc;
		if (typeof f=='string' && callback.startscope!=undefined) 
		f = callback.startscope[f];
		
		f.apply(callback.startscope,callback.startargs)
	}
	if (sec==0) update();  // -(MosesSupposes)- fire 0-second tweens immediately instead of waiting for enterframe callback.
	}// end with
}
tp.addTweenWithDelay = function(delay,mc,props,pEnd,sec,eqFunc,callback,extra1,extra2){
with(this){
	var il, intid;
	il = ints.length;
	intid = setInterval(function(obj){
		obj.removeDelayedTween(il);
		if (mc._x!=undefined) { //-(MosesSupposes)- check if clip still exists; otherwise cleanup is already done.
			obj.addTween(mc, props, pEnd, sec, eqFunc, callback, extra1, extra2);
		}
	},delay*1000,this);
	//
	// ints[il] = {mc: mc, props: props, pend:pEnd, intid:intid, st: this.now, delay:delay*1000, args: arguments.slice(1)}
	// array of waiting tweens, mc reference to movieclip, ..., intid setInterval function identifier
	// -(MosesSupposes)- added pt (paused time) prop-
	ints[il] = {mc: mc, props: props, pend:pEnd, intid:intid, st: getTimer(), delay:delay*1000, args: arguments.slice(1), pt:-1} 
	if(!playing){
			init();// -(MosesSupposes)- may be first item called, pause routines need this to be called.
 	}
}
}
//

//
tp.removeTween = function(mc,props){
with (this){
	var all, i, j, ip;
	all = false;
	if(props == undefined && broadcastEvents!=true){
		// props are undefined, remove all tweens
		all = true;
	}
	i = tweenList.length; 
	ip = {};
	while (i--){
		if(tweenList[i].mc == mc){
			if(all){// -(MosesSupposes)- added second condition for ip, below
				tweenList.splice(i,1);
			}else{
				// removing tweening of properties
				for(j in props){
					if(tweenList[i].pp == props[j]){
						tweenList.splice(i,1);
						if(ip[targetpath(mc)] == undefined){// -(MosesSupposes)- 
							ip[targetpath(mc)] = {t:mc,p:[]};
						}
						ip[targetpath(mc)].p.push(props[j]);
							// props.splice(j,1) 
							// (because allows add same properties for same mc,
							// all tweens must be checked) 
					} else if (props[j] == "_ct_" && tweenList[i].ctm != undefined && tweenList[i].mc == mc){
							// removing of colorTransform tweens
						tweenList.splice(i,1);
						if(ip[targetpath(mc)] == undefined){// -(MosesSupposes)- 
							ip[targetpath(mc)] = {t:mc,p:[]};
						}
						ip[targetpath(mc)].p.push('_ct_');
					}
				}
			}
		}
	}
	i = ints.length;
	// delayed tweens 
	while(i--){
		if(ints[i].mc == mc) {
			if(all){
				// REMOVE ALL
				removeDelayedTween(Number(i)); //-(MosesSupposes)- 
			} else {
				// REMOVE PROPERTIES
				for(j in props){
					for(var k in ints[i].props){
						if(ints[i].props[k] == props[j]) {
							// remove tween properties + property end values
							ints[i].props.splice(k,1);
							ints[i].pend.splice(k,1);
							if(ip[targetpath(mc)] == undefined){// -(MosesSupposes)- 
								ip[targetpath(mc)] = {t:mc,p:[]};
							}
							ip[targetpath(mc)].p.push(props[j]);
						} 
					}
					if(ints[i].props.length == 0){
						clearInterval(ints[i].intid)
						// no properties to tween
					}
				}
			}
		}
	}
	if(broadcastEvents){
		for (var k in ip) {
			if (ip[k].p.length>0) {
				ip[k].t.broadcastMessage('onTweenInterrupt', {target:ip[k].t, props:ip[k].p});  // -(MosesSupposes)- pass array of props interrupted
			}
		}
	}
	if(tweenList.length==0){
		// last tween removed, erase onenterframe function
		deinit();
	}
}//end with	
}
tp.isTweening = function(mc,prop){
	with(this){
		var allprops = (prop==undefined);
		for (var i in tweenList){
			var t = tweenList[i];
			if(tweenList[i].mc == mc && tweenList[i].pt == -1 /*-(MosesSupposes)- tween is not paused*/
				&& (allprops || prop==t.pp || (prop=='_ct_' && t.ctm!=undefined))) {
				// mc found, so break loop
				return true;			}
		}
		return false;
	}
}
tp.getTweens = function(mc){
	with(this){
		var count = 0;
		for (var i in tweenList){
			if(tweenList[i].mc == mc){
				// found, increase count
				count++;
			}
		}
		return count;
	}
}
tp.lockTween = function(mc,bool){
	this.lockedTweens[targetpath(mc)] = bool;			
}
tp.isTweenLocked = function(mc){
	if(this.lockedTweens[targetpath(mc)] == undefined){
		return false;
	}else{
		return this.lockedTweens[targetpath(mc)];
	}			
}
tp.ffTween = function(mc, propsObj){
	var all = (mc==undefined);
	var allprops = (propsObj==undefined);
	with (this) {
		for (var i in tweenList){
			var t = tweenList[i];
			if((t.mc == mc || all) && (allprops || propsObj[t.pp]==true)) {
				if (t.pt != -1) {
					t.pt = -1;
				}
				t.ts = now - t.d; // back up start time so update will think it's done.
			}
		}
		// calling ffTween during a delay will affect all properties.
		for (var i in ints){
			if(ints[i] != undefined) {
				if ((ints[i].mc == mc || all)) {
					if (ints[i].mc._x!=undefined) { // be sure clip still exists
						var args = ints[i].args;
						args[3] = 0; // set tween time to none
						addTween.apply(this, args);
					}
					removeDelayedTween(Number(i));
				}
			}
		}
		update();
	}
}
tp.rewTween = function(mc, propsObj) {
	var all = (mc==undefined);
	var allprops = (propsObj==undefined);
	with (this){
	for (var i in tweenList){
		var t = tweenList[i];
		if((t.mc == mc || all) && (allprops || propsObj[t.pp]==true)) {
			if (t.pt != -1) {
				t.pt = -1;
			}
			t.ts = now; // reset start time
		}
	}
	// rewind will kill a delay.
	for (var i in ints){ 
		if(ints[i] != undefined) {
			if ((ints[i].mc == mc || all)) {
				if (ints[i].mc._x!=undefined) { // be sure clip still exists
					addTween.apply(this, ints[i].args);
				}
				removeDelayedTween(Number(i));
			}
		}
	}
	update();
	}
}

tp.isTweenPaused = function(mc, prop) { // -(MosesSupposes)- Returns false if mc/prop is not tweening.
	if (mc==undefined) return null;
	var allprops = (prop==undefined);
	with (this) {
	for (var i in tweenList){
		var t = tweenList[i];
		if(tweenList[i].mc == mc && (allprops || prop==t.pp || (prop=='_ct_' && t.ctm!=undefined))) {
			return Boolean(tweenList[i].pt != -1);
		}
	}
	// if pause was called during a delay prop string is ignored.
	for (var i in ints) {
		if (ints[i] != undefined && ints[i].mc == mc) {
			return Boolean(ints[i].pt != -1) 
		}
	}
	}
	return false;
}

tp.pauseTween = function(mc, propsObj) { //-(MosesSupposes)-
	var all = (mc==undefined);
	with (this){
	if (all==false && isTweenPaused(mc)==true) return;

	var allprops = (propsObj==undefined);
	
	for (var i in tweenList){
		var t = tweenList[i];
		if(t.pt == -1 && (t.mc == mc || all) && (allprops || propsObj[t.pp]==true || (propsObj._ct_!=undefined && t.ctm!=undefined))) {
			t.pt = now;
		}
	}
	// you can pause a tween during a delay, but not pause/unpause individual props.
	for (var i in ints){
		if(ints[i] != undefined) {
			if (ints[i].pt == -1 && (ints[i].mc == mc || all)) {
				ints[i].pt = now;
			}
		}
	}
	}
}

tp.unpauseTween = function(mc, propsObj) { //-(MosesSupposes)-
	var all = (mc==undefined);
	with (this) {
	if (all==false && isTweenPaused(mc)===false) return;
	var allprops = (propsObj==undefined);
	if (!playing) init();
	for (var i in tweenList){
		var t = tweenList[i];
		if(t.pt != -1 && (t.mc == mc || all) && (allprops || propsObj[t.pp]==true) || (propsObj._ct_!=undefined && t.ctm!=undefined)) {
			// update start times 
			t.ts = now-(t.pt-t.ts);
			t.pt = -1;
		}
	}
	// you can pause a tween during a delay, but not pause/unpause individual props.
	for (i in ints) {
		if(ints[i] != undefined) {
			if (ints[i].pt != -1 && (ints[i].mc == mc || all)) {
				// update start times 
				ints[i].delay -= (ints[i].pt - ints[i].st);
				ints[i].st = now;
				ints[i].intid = setInterval(function(obj,id){
					obj.addTween.apply(obj, obj.ints[id].args);
					clearInterval(obj.ints[id].intid);
					obj.ints[id] = undefined;
				},ints[i].delay,this,i);
			}
		}
	}
	}
}






tp.pauseAll = function(){
	pauseTween();
}
tp.unpauseAll = function(){
	unpauseTween();
}
tp.stopAll = function(){
	with (this){
		for (var i in ints){
			removeDelayedTween(Number(i));  //-(MosesSupposes)- 
		}
		// stop all running tweens
		tweenList = new Array();	
		deinit();
	}
}

tp.toString = function(){
	return "[AS1 tweenManager 1.2.0]";
}
delete tp;
//----------------------------- end of tweenManager

if(_global.$tweenManager == undefined){
	_global.$tweenManager = new tweenManager();
} else {
	// -(MosesSupposes)- Also fix for re-testing a published swf locally during tweens
	_global.$tweenManager.cleanUp();
	_global.$tweenManager.init();
	//_global.$tweenManager.playing = false; //(original LZ code - might disrupt loaded swfs)
}
// easing equations 
var Mp = MovieClip.prototype;
Mp.addListener = function() {
 if (!this._listeners) {
  AsBroadcaster.initialize(this);
 }
 this.addListener.apply(this,arguments);
};
ASSetPropFlags(Mp, "addListener", 1, 0)

// == core methods ==
Mp.tween = function(props, pEnd, seconds, animType, delay, callback, extra1, extra2) {
	if (_global.$tweenManager.isTweenLocked(this)){
		trace("tween not added, this movieclip is locked");
		return;
	}	
	if (arguments.length<2) {
		trace("tween not added, props & pEnd must be defined");
		return;
	}
	// parse arguments to valid type:
	// parse properties
	if (typeof (props) == "string") {
		if (props.indexOf(',')>-1) { //-(MosesSupposes)- enables comma-delimited string for mulitple props
			props = props.split(' ').join('').split(',');
		}
		else props = [props];
	}
	// parse end values
	// if pEnd is not array 
	if (!(pEnd instanceof Array)) { //-(MosesSupposes)- modified to work with string rel values
		pEnd = [pEnd];
		while (pEnd.length<props.length) {// and added this routine to allow single end val to be passed for multiple props.
			pEnd.push(pEnd[0]);
		}
	}
	// parse time properties
	if(seconds == undefined) {
		seconds = 2;
	}else if (seconds<0.01){
		seconds = 0;
	}
	if (delay<0.01 || delay == undefined) {
		delay = 0;
	}
	// parse animtype to reference to equation function 
	switch(typeof(animType)){
	case "string":
		var eqf = Math[animType.toLowerCase()];
		break;
	case "function":
		var eqf = animType;
	break;
	case "object":
		if(animType.pts != undefined && animType.ease != undefined){
		var eqf = animType.ease;
		var extra1 = animType.pts; 
		}
	}
	if (eqf == undefined) {
		// set default tweening equation
		var eqf = Math.easeoutexpo;
	}

	// parse callback function
	switch(typeof (callback)) {
	case "function":
		callback = {func:callback, scope:this._parent};
		break;
	case "string":
		var ilp, funcp, scope, args, a;
		ilp = callback.indexOf("(");
		funcp = callback.slice(0, ilp);
		
		scope = eval(funcp.slice(0, funcp.lastIndexOf(".")));
		func = eval(funcp);
		args = callback.slice(ilp+1, callback.lastIndexOf(")")).split(",");
		for (var i = 0; i<args.length; i++) {
			a = eval(args[i]);
			if (a != undefined) {
				args[i] = a;
			}
		}
		callback = {func:func, scope:scope, args:args };
		break;
	}
	if(_global.$tweenManager.autoStop){
		// automatic removing tweens as in Zeh proto
		_global.$tweenManager.removeTween(this); // -(MosesSupposes)- changed to stop all tweening props in target. (Similar props are overwritten regardless of autoStop.)
	}
	
	if(delay > 0){
		_global.$tweenManager.addTweenWithDelay(delay,this, props, pEnd, seconds, eqf, callback, extra1, extra2);
	}else{
		_global.$tweenManager.addTween(this, props, pEnd, seconds, eqf, callback, extra1, extra2);
	}
};
//

// -- tween control methods --
Mp.stopTween = function(props) {
	if (typeof (props) == "string") {
		if (props.indexOf(',')>-1) {//-(MosesSupposes)- enables comma-delimited string for mulitple props
			props = props.split(' ').join('').split(',');
		}
		else props = [props];
	}
	_global.$tweenManager.removeTween(this, props);
};
//
Mp.isTweening = function(prop:String) { //-(MosesSupposes)- added prop param
	//returns boolean
	return _global.$tweenManager.isTweening(this, prop);
};
//
Mp.getTweens = function() {
	// returns count of running tweens
	return _global.$tweenManager.getTweens(this);
};
//
Mp.lockTween = function() {
	// 
	_global.$tweenManager.lockTween(this,true);
};
//
Mp.unlockTween = function() {
	// 
	_global.$tweenManager.lockTween(this,false);
};
//
Mp.isTweenLocked = function() {
	// 
	return _global.$tweenManager.isTweenLocked(this);
};
//
Mp.isTweenPaused = function(prop:String) { //-(MosesSupposes)-
	// 
	return _global.$tweenManager.isTweenPaused(this, prop);
};
//
Mp.pauseTween = function(props) { //-(MosesSupposes)-
	// 
	var propsObj;
	if (props!=undefined) {
		if (typeof (props) == "string") {
			if (props.indexOf(',')>-1) {// enables comma-delimited string for mulitple props
				props = props.split(' ').join('').split(',');
			}
			else props = [props];
		}
		propsObj = {};
		for (var i in props) propsObj[props[i]] = true;
	}
	_global.$tweenManager.pauseTween(this, propsObj);
};
//
Mp.unpauseTween = function(props) { //-(MosesSupposes)-
	// 
	var propsObj;
	if (props!=undefined) {
		if (typeof (props) == "string") {
			if (props.indexOf(',')>-1) {// enables comma-delimited string for mulitple props
				props = props.split(' ').join('').split(',');
			}
			else props = [props];
		}
		propsObj = {};
		for (var i in props) propsObj[props[i]] = true;
	}
	_global.$tweenManager.unpauseTween(this, propsObj);
};
//
Mp.pauseAllTweens = function() { //-(MosesSupposes)-
	// globally pause all tweens. (just a shortcut so you don't have to type _global.$tweenManager)
	_global.$tweenManager.pauseTween();
};
//
Mp.unpauseAllTweens = function() { //-(MosesSupposes)-
	// globally unpause all tweens (just a shortcut so you don't have to type _global.$tweenManager)
	_global.$tweenManager.unpauseTween();
};
//
Mp.stopAllTweens = function() { //-(MosesSupposes)-
	// globally stop all tweens (just a shortcut so you don't have to type _global.$tweenManager)
	_global.$tweenManager.stopAll();
};

//
Mp.ffTween = function(props) { //-(MosesSupposes)-
	// 
	var propsObj;
	if (props!=undefined) {
		if (typeof (props) == "string") {
			if (props.indexOf(',')>-1) {// enables comma-delimited string for mulitple props
				props = props.split(' ').join('').split(',');
			}
			else props = [props];
		}
		propsObj = {};
		for (var i in props) propsObj[props[i]] = true;
	}
	_global.$tweenManager.ffTween(this, propsObj);
};
Mp.rewTween = function(props) { //-(MosesSupposes)-
	// 
	var propsObj;
	if (props!=undefined) {
		if (typeof (props) == "string") {
			if (props.indexOf(',')>-1) {// enables comma-delimited string for mulitple props
				props = props.split(' ').join('').split(',');
			}
			else props = [props];
		}
		propsObj = {};
		for (var i in props) propsObj[props[i]] = true;
	}
	_global.$tweenManager.rewTween(this, propsObj);
};
//

// == shortcut methods == 
// these methods only pass parameters to tween method
Mp.alphaTo = function (destAlpha, seconds, animType, delay, callback, extra1, extra2) {
	this.tween(["_alpha"],[destAlpha],seconds,animType,delay,callback,extra1,extra2)
}
//
Mp.scaleTo = function (destScale, seconds, animType, delay, callback, extra1, extra2) {
	this.tween(["_xscale", "_yscale"],[destScale, destScale],seconds,animType,delay,callback,extra1,extra2)
}
//
Mp.sizeTo = function (destSize, seconds, animType, delay, callback, extra1, extra2) { //-(MosesSupposes)- 
	this.tween(["_width", "_height"],[destSize, destSize],seconds,animType,delay,callback,extra1,extra2)
}
//
Mp.slideTo = function (destX, destY, seconds, animType, delay, callback, extra1, extra2) {
	this.tween(["_x", "_y"],[destX, destY],seconds,animType,delay,callback,extra1,extra2)
}
//
Mp.rotateTo = function (destRotation, seconds, animType, delay, callback, extra1, extra2) {
	// note: to force counterclockwise rotation pass a neg value in string for relative positioning
	this.tween(["_rotation"],[destRotation],seconds,animType,delay,callback,extra1,extra2)
}
//
//
//
//
// getColorTransObj :: Global helper function that returns an object with transform props. -(MosesSupposes)- 
// 		example of how it could be used elsewhere: new Color(photo_mc).setTransform(_global.getColorTransObj('contrast',150));
_global.getColorTransObj = function(type, amt, rgb)
{
	trace (arguments);
	switch(type) {
		case 'brightness': // amt:-100=black, 0=normal, 100=white
		var percent = 100 - Math.abs(amt);
		var offset = 0;
		if (amt > 0) offset = 256 * (amt / 100);
		return {ra: percent, rb:offset,
				ga: percent, gb:offset,
				ba: percent,bb:offset}
		//
		case 'brightOffset': // "burn" effect. amt:-100=black, 0=normal, 100=white
		var offset = 256*(amt/100);
		return {ra:100, rb:offset, ga:100, gb:offset, ba:100, bb:offset};
		//
		case 'contrast': // amt:0=gray, 100=normal, 200=high-contrast, higher=posterized.
		var o = {};
		o.ra = o.ga = o.ba = amt;
		o.rb = o.gb = o.bb = 128 - (128/100*amt);
		return o;
		//
		case 'invertColor': // amt:0=normal,50=gray,100=photo-negative
		var o = {};
		o.ra = o.ga = o.ba = 100 - 2 * amt;
		o.rb = o.gb = o.bb = amt * (255/100);
		return o;
		//
		case 'tint': // amt:0=none,100=solid color (>100=posterized to tint, <0=inverted posterize to tint)
		if (rgb == undefined || rgb == null) break; // rgb:0xRRGGBB number or null for reset
		var r = (rgb >> 16) ;
		var g = (rgb >> 8) & 0xFF;
		var b = rgb & 0xFF;
		var ratio = amt / 100;
		var o = {rb:r*ratio, gb:g*ratio, bb:b*ratio};
		o.ra = o.ga = o.ba = 100 - amt;
		return o;
	}
	return {rb:0, ra:100, gb:0, ga:100, bb:0, ba:100}; // resets to normal.
}
//  -- Color methods -- 
// Number datatyping added to these since relative vals are not supported. -(MosesSupposes)-
Mp.brightnessTo = function (bright, seconds, animType, delay, callback, extra1, extra2) {
	this.tween(["_ct_"],[_global.getColorTransObj('brightness',bright)],seconds,animType,delay,callback,extra1,extra2)
}
//
Mp.brightOffsetTo = function(percent, seconds, animType, delay, callback, extra1, extra2) {
	this.tween(["_ct_"], [_global.getColorTransObj('brightOffset',percent)], seconds, animType, delay, callback, extra1, extra2);
};
//
Mp.contrastTo = function(percent, seconds, animType, delay, callback, extra1, extra2) {
	// from Robert Penner color toolkit
	this.tween(["_ct_"], [_global.getColorTransObj('contrast',percent)], seconds, animType, delay, callback, extra1, extra2);
};
//
Mp.colorTo = function (rgb, seconds, animType, delay, callback, extra1, extra2) {
	this.tween(["_ct_"],[_global.getColorTransObj('tint',100,rgb)],seconds,animType,delay,callback,extra1,extra2)
}
//
Mp.colorTransformTo = function (ra, rb, ga, gb, ba, bb, aa, ab,	seconds, animType, delay, callback, extra1, extra2) {
	// destination color transform matrix
	var destCt = {ra: ra ,rb: rb , ga: ga, gb: gb, ba: ba, bb: bb, aa: aa, ab: ab}
	this.tween(["_ct_"],[destCt],seconds,animType,delay,callback,extra1,extra2)
}
// invertColorTo: invert colors like a photo-negative, based on a percentage -(MosesSupposes)- based on Penner / SuperColor (http://www.lalex.com)
Mp.invertColorTo = function (percent, seconds, animType, delay, callback, extra1, extra2) { 
	this.tween(["_ct_"],[_global.getColorTransObj('invertColor',percent)],seconds,animType,delay,callback,extra1,extra2)
}
// tintTo: same as colorTo but second param is percent to tint -(MosesSupposes)- based on Penner / SuperColor (http://www.lalex.com)
Mp.tintTo = function (rgb, percent, seconds, animType, delay, callback, extra1, extra2) {
	this.tween(["_ct_"],[_global.getColorTransObj('tint',percent,rgb)],seconds,animType,delay,callback,extra1,extra2)
}
//

// frameTo shorcut method and _frame property - MovieClip only
Mp.getFrame = function() {
	return this._currentframe;
};
Mp.setFrame = function(fr) {
	this.gotoAndStop(Math.round(fr));
};
Mp.addProperty("_frame", Mp.getFrame, Mp.setFrame);
//
Mp.frameTo = function(endframe, duration, animType, delay, callback, extra1, extra2) {
	if (endframe == undefined) {
		endframe = this._totalframes;
	}
	this.tween("_frame", endframe, duration, animType, delay, callback, extra1, extra2);
};
//



// Copy all lmc_tween functionality to TextFields and set ASSetPropFlags for both -(MosesSupposes)-
var TFP = TextField.prototype;
if (!TFP.origAddListener) {
	TFP.origAddListener = TFP.addListener;// avoid unwanted recursion by storing ref to original method
	ASSetPropFlags(TFP, 'origAddListener', 1, 0);
	TFP.addListener = function() {
		if (!this._listeners) {
			AsBroadcaster.initialize(this);
		}
		this.origAddListener.apply(this,arguments);
	};
}
var $_$methods = [
	"tween", "stopTween", "isTweening", "getTweens", "lockTween", "isTweenLocked", "unlockTween",
	"isTweenPaused", "pauseTween", "unpauseTween", "pauseAllTweens", "unpauseAllTweens", "stopAllTweens",
	"ffTween", "rewTween", "getFrame", "setFrame", "_frame", "frameTo",
	"alphaTo", "brightnessTo", "colorTo", "colorTransformTo", "invertColorTo", "tintTo",
	"scaleTo", "sizeTo", "slideTo", "rotateTo", "brightOffsetTo", "contrastTo" ];
for (var $_$i in $_$methods) {
	ASSetPropFlags(Mp, $_$methods[$_$i], 1, 0);
	if ($_$methods[$_$i].toLowerCase().indexOf('frame')==-1) { // do not copy any of the 'frameTo' stuff
		TFP[$_$methods[$_$i]] = Mp[$_$methods[$_$i]];
		ASSetPropFlags(TFP, $_$methods[$_$i], 1, 0);
	}
}


delete Mp;
delete TFP;
delete tweenManager;
delete $_$methods;
delete $_$i;