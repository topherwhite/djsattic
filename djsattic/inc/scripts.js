﻿// User Interface Functionsfunction browse_playlist(clr_th,clr_hi){	var browselib = document.getElementById('browselib');	var browselst = document.getElementById('browselst');	var tabcnct = document.getElementById('tabcnct');	var gnrelist = document.getElementById('gnrelist');	var artlist = document.getElementById('artlist');	var alblist = document.getElementById('alblist');	var playlist = document.getElementById('playlist');		browselib.style.backgroundColor = clr_hi;	browselib.style.left = "10px";	browselst.style.backgroundColor = clr_th;	browselst.style.left = "5px";	tabcnct.style.top = "246px";	gnrelist.style.visibility = "hidden";	gnrelist.style.overflow = "hidden";	artlist.style.visibility = "hidden";	artlist.style.overflow = "hidden";	alblist.style.visibility = "hidden";	alblist.style.overflow = "hidden";	playlist.style.visibility = "visible";	playlist.style.overflow = "auto";		if (playlist.innerHTML == "") { PlstCh(); }}function browse_library(clr_th,clr_hi){	var browselib = document.getElementById('browselib');	var browselst = document.getElementById('browselst');	var tabcnct = document.getElementById('tabcnct');	var gnrelist = document.getElementById('gnrelist');	var artlist = document.getElementById('artlist');	var alblist = document.getElementById('alblist');	var playlist = document.getElementById('playlist');		browselib.style.backgroundColor = clr_th;	browselib.style.left = "5px";	browselst.style.backgroundColor = clr_hi;	browselst.style.left = "10px";	tabcnct.style.top = "172px";	gnrelist.style.visibility = "visible";	gnrelist.style.overflow = "auto";	artlist.style.visibility = "visible";	artlist.style.overflow = "auto";	alblist.style.visibility = "visible";	alblist.style.overflow = "auto";	playlist.style.visibility = "hidden";	playlist.style.overflow = "hidden";}function MiniWin(windowlink,width,height){	var options = "toolbar=no";		options += ",location=no";		options += ",directories=no";		options += ",status=no";		options += ",menubar=no";		options += ",scrollbars=yes";		options += ",resizeable=yes";		options += ",copyhistory=no";		options += ",width="+width;		options += ",height="+height;		window.open(windowlink, "_blank", options);}function snglist_dir(bttn){	var msg = '';	if (bttn == 'pl')		{	msg = 'click on a song above to play it';	}	else if (bttn == 'ed')	{	msg = 'edit/view song metadata';	}	else if (bttn == 'ad')	{	msg = 'add song to current playlist';	}	else if (bttn == 'dl')	{	msg = 'delete song from library';	}		top.document.getElementById('snglist_dir').innerHTML='<a style=\'position:relative;top:4px;\'>' + msg + '</a>';}function edit_meta(sess,rank,pos){	var lnk = '../meta/meta_edit.php?type=txt&sess='+ sess +'&refnum='+ rank +'&pos='+ pos +'&key='+ Math.random();	MiniWin(lnk,464,464);}function item_color(type,ref,clr_th,clr_hi){	var stor = document.getElementById(type + "_st");	var prv_id = type + "_" + stor.innerHTML;	var nxt_id = type + "_" + ref;	stor.innerHTML = ref;	document.getElementById(prv_id).style.backgroundColor = clr_th;	document.getElementById(nxt_id).style.backgroundColor = clr_hi;}function pl_plst(str,startpt){	var out = "<embed pluginspace=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\"";	out += " style=\"width:322px;height:127px;\" src=\"../plyr/plyr_multi.swf\" wmode=\"transparent\" swLiveConnect=\"true\"";	out += " type=\"application/x-shockwave-flash\" FlashVars=\"file=../plyr/plst.php?key=";	out += str + "_" + startpt + "_" + Math.random() + "_xml&amp;autolaunch=true\"></embed>";	var lstttl = document.getElementById('lsttitl').value;	document.getElementById('audplyr').innerHTML = out;	document.getElementById('plyrcap').innerHTML = '<b>Playing:</b> ' + lstttl;}function pl_slst(str,startpt){	var gn = document.getElementById("sng_gn_store").innerHTML;	var ar = document.getElementById("sng_ar_store").innerHTML;	var al = document.getElementById("sng_al_store").innerHTML;		var out = "<embed pluginspace=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\"";	out += " style=\"width:322px;height:127px;\" src=\"../plyr/plyr_multi.swf\" wmode=\"transparent\" swLiveConnect=\"true\"";	out += " type=\"application/x-shockwave-flash\" FlashVars=\"file=../plyr/slst.php";	out += "?key=" + str + "_" + gn + "_" + ar + "_" + al + "_" + startpt + "_" + Math.random();	out += "_xml&amp;autolaunch=true\"></embed>";	document.getElementById('audplyr').innerHTML = out;	document.getElementById('plyrcap').innerHTML = "<b>Playing:</b> Selected Library Tracks";}// AJAX Universal Function (start)var xmlHttpfunction GetXmlHttpObject(){	var xmlHttp=null;	try { xmlHttp=new XMLHttpRequest(); }	catch (e)	{	try { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); }		catch (e) { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); }	}	return xmlHttp;}// AJAX Universal Function (end)// Advertisement Click (start)function req_adclick(sess){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }	url = "../worker/adclk_ajax.php?sess=" + sess + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_adclick;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_adclick(){	if (xmlHttp.readyState == 4)	{	var xmlDoc = xmlHttp.responseXML.documentElement;}	}// Advertisement Click (end)// Create New Playlist (start)function req_plst_new(sess){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }	url = "../worker/plst_new_ajax.php?sess=" + sess + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_plst_new;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_plst_new(){	if (xmlHttp.readyState == 4)	{	var xmlDoc = xmlHttp.responseXML.documentElement;				var new_id = xmlDoc.getElementsByTagName('id')[0].childNodes[0].nodeValue;		var new_ttl = xmlDoc.getElementsByTagName('tt')[0].childNodes[0].nodeValue;				var y = document.createElement('option');		var x = document.getElementById('lstslct');		var ref_id = 'plst' + new_id;				y.text = new_ttl;		y.value = new_id;		y.id = ref_id;				try { x.add(y,null); }		catch(ex) { x.add(y); }				document.getElementById('lsttitl').value = new_ttl;		document.getElementById(ref_id).selected = true;				PlstCh();		}	}// Create New Playlist (end)// Delete Current Playlist (start)function req_plst_del(sess){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }	url = "../worker/plst_del_ajax.php?sess=" + sess + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_plst_del;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_plst_del(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;				var x = document.getElementById('lstslct');		x.remove(x.selectedIndex);				var new_id = xmlDoc.getElementsByTagName("id")[0].childNodes[0].nodeValue;				var ref_id = 'plst' + new_id;		document.getElementById(ref_id).selected = true;				PlstCh();}	}// Delete Current Playlist (end)// Rename Current Playlist (start)function req_plst_renm(sess){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }	var lst_ttl = document.getElementById('lsttitl').value;	url = "../worker/plst_renm_ajax.php?sess=" + sess + "&ttl=" + lst_ttl + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_plst_renm;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_plst_renm(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;				var new_ttl = xmlDoc.getElementsByTagName("tt")[0].childNodes[0].nodeValue;		var ref = xmlDoc.getElementsByTagName("id")[0].childNodes[0].nodeValue;				document.getElementById('plst' + ref).innerHTML = new_ttl;		document.getElementById('plst_all').innerHTML = "Play Playlist ("+ new_ttl +")";}	}// Rename Current Playlist (end)// Remove Song From Current Playlist (start)function req_plst_rm(sess,ref){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }	url = "../worker/plst_rm_ajax.php?sess=" + sess + "&ref=" + ref + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_plst_rm;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_plst_rm(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;				var ref = parseInt(xmlDoc.getElementsByTagName("ref")[0].childNodes[0].nodeValue);		var fnl = parseInt(xmlDoc.getElementsByTagName("fnl")[0].childNodes[0].nodeValue);				var src = "";		var rep = fnl-1;				for (i = ref; i < fnl; i++)		{			src = document.getElementById("plst_s"+i).innerHTML;			rep = i;			document.getElementById("plst_s"+(i-1)).innerHTML = src;		}				document.getElementById("plst_s"+rep).innerHTML = " ";		document.getElementById("plst_s"+rep).style.visibility = 'hidden';		document.getElementById("plst_t"+rep).style.visibility = 'hidden';		document.getElementById("plst_r"+rep).style.visibility = 'hidden';		document.getElementById("plst_d"+(rep-1)).style.visibility = 'hidden';		document.getElementById("plst_u"+rep).style.visibility = 'hidden';}	}// Remove Song From Current Playlist (end)// Move Song Within Current Playlist (start)function req_plst_mv(sess,act,ref){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }		url = "../worker/plst_mv_ajax.php?sess=" + sess + "&act=" + act + "&ref=" + ref + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_plst_mv;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_plst_mv(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;				var src = parseInt(xmlDoc.getElementsByTagName("src")[0].childNodes[0].nodeValue)-1;		var dst = parseInt(xmlDoc.getElementsByTagName("dst")[0].childNodes[0].nodeValue)-1;				var src_id = document.getElementById("plst_s"+src);		var dst_id = document.getElementById("plst_s"+dst);				var src_syn = src_id.innerHTML;		var dst_syn = dst_id.innerHTML;				src_id.innerHTML = dst_syn;		dst_id.innerHTML = src_syn;				}	}// Move Song Within Current Playlist (start)// Add Single Song to Playlist (start)function req_plst_add(sess,ref){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }		url = "../worker/plst_add_ajax.php?sess=" + sess + "&ref=" + ref + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_plst_add;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_plst_add(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;			var status = xmlDoc.getElementsByTagName("s")[0].childNodes[0].nodeValue;				if (status == 1)		{	alert('The currently selected playlist already contains that song. No song may exist more than once within a single playlist.');		}		if (status == 2)		{	alert('The currently selected playlist already contains 50 songs. No playlist may contain more than 50 songs.');		}		if (status == 3)		{	var nm = (parseInt(xmlDoc.getElementsByTagName("n")[0].childNodes[0].nodeValue)-1);			var tt = xmlDoc.getElementsByTagName("t")[0].childNodes[0].nodeValue;			var ar = xmlDoc.getElementsByTagName("r")[0].childNodes[0].nodeValue;			var al = xmlDoc.getElementsByTagName("a")[0].childNodes[0].nodeValue;			var ln = xmlDoc.getElementsByTagName("l")[0].childNodes[0].nodeValue;						var code = "<a class=\"tt\">" + tt + "</a>" + "<a class=\"ar\">" + ar + "</a>";			code += "<a class=\"al\">" + al + "</a>" + "<a class=\"ln\">" + ln + "</a>";						document.getElementById("plst_s"+nm).innerHTML = code;			document.getElementById("plst_t"+nm).style.visibility = "visible";			document.getElementById("plst_s"+nm).style.visibility = "visible";			document.getElementById("plst_r"+nm).style.visibility = "visible";			document.getElementById("plst_d"+(nm-1)).style.visibility = "visible";			document.getElementById("plst_u"+nm).style.visibility = "visible";			}}	}// Add Single Song to Playlist (end)// Add a Full Album to Playlist (start)function req_plst_addalb(sess,ref){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }		url = "../worker/plst_addalb_ajax.php?sess=" + sess + "&ref=" + ref + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_plst_addalb;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_plst_addalb(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;			var st = parseInt(xmlDoc.getElementsByTagName("st")[0].childNodes[0].nodeValue);		var nm = parseInt(xmlDoc.getElementsByTagName("nm")[0].childNodes[0].nodeValue);		var tr = parseInt(xmlDoc.getElementsByTagName("tr")[0].childNodes[0].nodeValue) - 1;						var e1	=	"The album could not be added to the currently selected playlist due to an unspecified error. Please try again.";		var e2	=	"The album could not be added because the currently selected playlist is completely full.";			e2	+=	" No playlist may contain more than 50 songs.";		var e3	=	"The album could not be added because the currently selected playlist does not have enough free slots to fit every song.";			e3	+=	" No playlist may contain more than 50 songs.";				if		(st == 1) { alert(e1); }		else if	(st == 2) { alert(e2); }		else if	(st == 3) { alert(e3); }		else if	(st == 4)		{	var sn = "";	var tt = "";	var ar = "";	var al = "";	var ln = "";	var ad = "";	var code = "";			for (i = 0; i < nm; i++)			{	sn = xmlDoc.getElementsByTagName("s")[i];				tt = sn.getElementsByTagName("t")[0].childNodes[0].nodeValue;				ar = sn.getElementsByTagName("r")[0].childNodes[0].nodeValue;				al = sn.getElementsByTagName("a")[0].childNodes[0].nodeValue;				ln = sn.getElementsByTagName("l")[0].childNodes[0].nodeValue;				ad = tr + i;						code = "<a class=\"tt\">" + tt + "</a>" + "<a class=\"ar\">" + ar + "</a>";				code += "<a class=\"al\">" + al + "</a>" + "<a class=\"ln\">" + ln + "</a>";								document.getElementById("plst_s"+ad).innerHTML = code;				document.getElementById("plst_t"+ad).style.visibility = "visible";				document.getElementById("plst_s"+ad).style.visibility = "visible";				document.getElementById("plst_r"+ad).style.visibility = "visible";				if (ad != 0)				{	document.getElementById("plst_d"+(ad-1)).style.visibility = "visible";					document.getElementById("plst_u"+ad).style.visibility = "visible";				}			}		}}	}// Add a Full Album to Playlist (end)// Reorganize Songlist (start)function req_slst_org(orgby,sess){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }	url = "../worker/slst_org_ajax.php?sess=" + sess + "&orgby=" + orgby + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_slst_org;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_slst_org(){	if (xmlHttp.readyState == 4)	{			var gn = document.getElementById("sng_gn_store").innerHTML;		var ar = document.getElementById("sng_ar_store").innerHTML;		var al = document.getElementById("sng_al_store").innerHTML;				if (gn == "empty") { gn = ""; }		if (ar == "empty") { ar = ""; }		if (al == "empty") { al = ""; }				SngCsc(gn,ar,al);}	}// Reorganize Songlist (end)// Update Rating on a Song (start)function req_sng_rate(sess,ref){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }	var listItem = document.RateIt.newPage.selectedIndex;	var rt = document.RateIt.newPage.options[listItem].value;	url = "../worker/sng_rate_ajax.php?sess=" + sess + "&ref=" + ref + "&rt=" + rt + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_sng_rate;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_sng_rate(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;			var rating = xmlDoc.getElementsByTagName("rating")[0].childNodes[0].nodeValue;}	}// Update Rating on a Song (end)// Delete a Song from the Library (start)function req_sng_del(sess,rnk,num){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }		var gn = document.getElementById("sng_gn_store").innerHTML;	var ar = document.getElementById("sng_ar_store").innerHTML;	var al = document.getElementById("sng_al_store").innerHTML;	var snd = "&gn=" + gn + "&ar=" + ar + "&al=" + al;		url = "../worker/sng_del_ajax.php?sess=" + sess + "&ref=" + rnk + "&num=" + num + snd + "&key=" + Math.random();//	alert(url);//	xmlHttp.onreadystatechange = stateChng_sng_del;//	xmlHttp.open("GET",url,true);//	xmlHttp.send(null);}function stateChng_sng_del(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;			var status = xmlDoc.getElementsByTagName("status")[0].childNodes[0].nodeValue;		var lastofalb = xmlDoc.getElementsByTagName("lastofalb")[0].childNodes[0].nodeValue;		var lstremovals = xmlDoc.getElementsByTagName("lstremovals")[0].childNodes[0].nodeValue;				if (status == 1)		{					}				if (lastofalb == 1)		{				}}	}// Delete a Song from the Library (end)// Change Current Playlist (start)function req_plst_chng(sess){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }	var listItem = document.getElementById("lstslct").selectedIndex;	var ref = document.getElementById("lstslct").options[listItem].value;	var title = document.getElementById("lstslct").options[listItem].innerHTML;	var load = "<div class=\"s\" style=\"top:1px;font-weight:bold;\"><a class=\"tt\">loading playlist...</a></div>";		load += "<div style=\"top:1px;font-weight:bold;\" class=\"t\"><a class=\"tr\">&gt;</a></div>";	document.getElementById("playlist").innerHTML = load;	url = "../worker/plst_chng_ajax.php?sess=" + sess + "&ref=" + ref + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_plst_chng;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_plst_chng(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;		var num = parseInt(xmlDoc.getElementsByTagName("num")[0].childNodes[0].nodeValue);				var title = xmlDoc.getElementsByTagName("lst")[0].childNodes[0].nodeValue;		var date = xmlDoc.getElementsByTagName("date")[0].childNodes[0].nodeValue;		var key = xmlDoc.getElementsByTagName("key")[0].childNodes[0].nodeValue;				document.getElementById('lsttitl').value = title;				var code = "<div class=\"t\" style=\"top:1px;\"><a class=\"tr\" style=\"font-weight:bold;\">&gt;</a></div>";				if (num < 1)		{	code += "<div class=\"s\" style=\"top:1px;\">";			code += "<a class=\"tt\" id=\"plst_all\" style=\"font-weight:bold;\">Empty Playlist ("+ title +")</a>";			code += "<a class=\"al\" id=\"plst_date\" style=\"left:560px;\">Created: <i>" + date + "</i></a>";			code += "</div>";			code += "<div style=\"top:"+(23)+"px;\" id=\"plst_s0\" class=\"s\">";			code += "<a class=\"tt\">this playlist is currently empty</a></div>";		}		else		{	code += "<div class=\"s\" style=\"top:1px;\">";			code += "<a class=\"tt\" id=\"plst_all\" style=\"font-weight:bold;\"";			code += " onMouseOver=\"hdr_ov('plst_all');\" onMouseOut=\"hdr_of('plst_all');\"";			code += " onClick=\"PlPlst(" + key + ",1);\">Play Playlist (" + title + ")</a>";			code += "<a class=\"al\" id=\"plst_date\" style=\"left:560px;\">Created: <i>" + date + "</i></a>";			code += "</div>";		}				for (i = 0; i < 50; i++)		{	var vt = (i + 1) * 21 + 2;						if (i < num)			{	var it = xmlDoc.getElementsByTagName("i")[i];							code += "<div style=\"top:"+ vt +"px;\" id=\"plst_r"+ i +"\" class=\"r\" onClick=\"PlstRm("+ (i+1) +");\"></div>";			code += "<div style=\"top:"+ vt +"px;\" id=\"plst_d"+ i +"\" class=\"d\" onClick=\"PlstMv('mvd',"+ (i+1) +");\"></div>";			code += "<div style=\"top:"+ vt +"px;\" id=\"plst_u"+ i +"\" class=\"u\" onClick=\"PlstMv('mvu',"+ (i+1) +");\"></div>";			code += "<div style=\"top:"+(vt-1)+"px;\" id=\"plst_t"+ i +"\" class=\"t\"><a class=\"tr\">" + (i+1) + ".</a></div>";			code += "<div style=\"top:"+(vt-1)+"px;\" id=\"plst_s"+ i +"\" class=\"s\" onClick=\"PlPlst("+ key +","+ (i+1) +");\">";			code += "<a class=\"tt\">" + it.getElementsByTagName("t")[0].childNodes[0].nodeValue + "</a>";			code += "<a class=\"ar\">" + it.getElementsByTagName("r")[0].childNodes[0].nodeValue + "</a>";			code += "<a class=\"al\">" + it.getElementsByTagName("a")[0].childNodes[0].nodeValue + "</a>";			code += "<a class=\"ln\">" + it.getElementsByTagName("l")[0].childNodes[0].nodeValue + "</a>";			}						else			{			code += "<div style=\"top:"+ vt +"px;visibility:hidden;\" id=\"plst_r"+ i +"\" class=\"r\" onClick=\"PlstRm("+ (i+1) +");\"></div>";			code += "<div style=\"top:"+ vt +"px;visibility:hidden;\" id=\"plst_d"+ i +"\" class=\"d\" onClick=\"PlstMv('mvd',"+ (i+1) +");\"></div>";			code += "<div style=\"top:"+ vt +"px;visibility:hidden;\" id=\"plst_u"+ i +"\" class=\"u\" onClick=\"PlstMv('mvu',"+ (i+1) +");\"></div>";			code += "<div style=\"top:"+(vt-1)+"px;visibility:hidden;\" id=\"plst_t"+ i +"\" class=\"t\"><a class=\"tr\">" + (i+1) + ".</a></div>";			code += "<div style=\"top:"+(vt-1)+"px;visibility:hidden;\" id=\"plst_s"+ i +"\" class=\"s\" onClick=\"PlPlst("+ key +","+ (i+1) +");\">";			}						code += "</div>";		}				document.getElementById("playlist").innerHTML = code;		document.getElementById("plst_u0").style.visibility = "hidden";		document.getElementById("plst_d" + (num-1)).style.visibility = "hidden";}	}// Change Current Playlist (end)// Load Browse Lists (start)function req_lst_browse(sess,type,gn,ar){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }	//	var gn_store = document.getElementById("sng_gn_store");//	var ar_store = document.getElementById("sng_ar_store");//	var al_store = document.getElementById("sng_al_store");			if (type == 'gnre')		{ var mode = "genre";	var snd = "";	}	else if (type == 'art') { var mode = "artist";	var snd = "&gn=" + gn;		}	else if (type == 'alb') { var mode = "album";	var snd = "&gn=" + gn + "&ar=" + ar;	}		var load = "<div class=\"i\" style=\"top:1px;font-weight:bold;\"><a onClick=\"\">";		load += "&gt; loading " + mode + "s...</a></div>";	document.getElementById(type + "list").innerHTML = load;		browse_libr();	url = "../worker/lst_retr_ajax.php?sess=" + sess + "&type=" + type + snd + "&key=" + Math.random();	xmlHttp.onreadystatechange = stateChng_lst_browse;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_lst_browse(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;		var type = xmlDoc.getElementsByTagName("type")[0].childNodes[0].nodeValue;		var num = parseInt(xmlDoc.getElementsByTagName("num")[0].childNodes[0].nodeValue);		var hdr = xmlDoc.getElementsByTagName("hdr")[0].childNodes[0].nodeValue;		var gref = xmlDoc.getElementsByTagName("gref")[0].childNodes[0].nodeValue;		var aref = xmlDoc.getElementsByTagName("aref")[0].childNodes[0].nodeValue;				var m_g = "";		var m_r = "";				var gnstore	= document.getElementById("sng_gn_store");		var arstore	= document.getElementById("sng_ar_store");		var alstore	= document.getElementById("sng_al_store");								if (gref != 'na')			{	m_g = gref;			gnstore.innerHTML = gref;		}		else		{	gnstore.innerHTML = "empty";	}				if (aref != 'na')		{	m_r = aref;			arstore.innerHTML = aref;		}		else		{	arstore.innerHTML = "empty";	}				if (type == "gnre")		{	var code = "<div class=\"st\" id=\"gnre_st\">i0</div>";				code += "<div class=\"it\" id=\"gnre_i0\" onClick=\"ItmClr('gnre','i0');LstCsc('art','','');\">";				code += "<a>" + hdr + "</a></div>";							for (i = 0; i < num; i++)			{	var it = xmlDoc.getElementsByTagName("i")[i];				var m_g = it.getElementsByTagName("g")[0].childNodes[0].nodeValue;				var tt = it.getElementsByTagName("t")[0].childNodes[0].nodeValue;								code += "<div class=\"i\" id=\"gnre_i"+ (i+1) +"\" style=\"top:"+ ((i+1)*20+1) +"px;\"";				code += " onClick=\"ItmClr('gnre','i"+ (i+1) +"');LstCsc('art','"+ m_g +"','');\"><a>" + tt + "</a></div>";			}						document.getElementById("gnrelist").innerHTML = code;			LstCsc('art','','');		}				else if (type == "art")		{	var code = "<div class=\"st\" id=\"art_st\">i0</div>";				code += "<div class=\"it\" id=\"art_i0\" onClick=\"ItmClr('art','i0');LstCsc('alb','" + m_g + "','');\">";				code += "<a>" + hdr + "</a></div>";						for (i = 0; i < num; i++)			{	var it = xmlDoc.getElementsByTagName("i")[i];				var m_r = it.getElementsByTagName("r")[0].childNodes[0].nodeValue;				var tt = it.getElementsByTagName("t")[0].childNodes[0].nodeValue;								code += "<div class=\"i\" id=\"art_i"+ (i+1) +"\" style=\"top:"+ ((i+1)*20+1) +"px;\"";				code += " onClick=\"ItmClr('art','i"+ (i+1) +"');LstCsc('alb','"+ m_g +"','"+ m_r +"');\"><a>" + tt + "</a></div>";			}						document.getElementById("artlist").innerHTML = code;			LstCsc('alb',m_g,'');		}				else if (type == "alb")		{	var code = "<div class=\"st\" id=\"alb_st\">i0</div>";				code += "<div class=\"it\" id=\"alb_i0\" onClick=\"ItmClr('alb','i0');SngCsc('"+m_g+"','"+m_r+"','');\">";				code += "<a>" + hdr + "</a></div>";						for (i = 0; i < num; i++)			{	var it = xmlDoc.getElementsByTagName("i")[i];				var m_a = it.getElementsByTagName("a")[0].childNodes[0].nodeValue;				var tt = it.getElementsByTagName("t")[0].childNodes[0].nodeValue;								code += "<div class=\"i\" id=\"alb_i"+ (i+1) +"\" style=\"top:"+ ((i+1)*20+1) +"px;\"";				code += " onClick=\"ItmClr('alb','i"+ (i+1) +"');SngCsc('"+m_g+"','"+m_r+"','"+m_a+"');\"><a>" + tt + "</a></div>";				code += "<div class=\"a\" style=\"top:"+ ((i+1)*20+2) +"px;\"";				code += " onClick=\"AdAlb('"+ m_a +"');\"></div>";						}						document.getElementById("alblist").innerHTML = code;			SngCsc(m_g,m_r,'');		}}	}// Load Browse Lists (end)// Load Song List (start)function req_sng_browse(sess,gn,ar,al){	xmlHttp=GetXmlHttpObject();	if (xmlHttp==null) { alert ("Your browser does not support this feature."); return; }		var gn_store = document.getElementById("sng_gn_store");	var ar_store = document.getElementById("sng_ar_store");	var al_store = document.getElementById("sng_al_store");	var snd = "";		if (gn != "") { snd += "&gn=" + gn; gn_store.innerHTML = gn; } else { gn_store.innerHTML = "empty"; }	if (ar != "") { snd += "&ar=" + ar; ar_store.innerHTML = ar; } else { ar_store.innerHTML = "empty"; }	if (al != "") { snd += "&al=" + al; al_store.innerHTML = al; } else { al_store.innerHTML = "empty"; }		var load = "<div class=\"s\" style=\"top:1px;font-weight:bold;\">";		load += "<a class=\"tr\">&gt;</a><a class=\"tt\">loading song list...</a></div>";	document.getElementById('snglist').innerHTML = load;		url = "../worker/sngs_retr_ajax.php?sess=" + sess + snd + "&key=" + Math.random();		xmlHttp.onreadystatechange = stateChng_sng_browse;	xmlHttp.open("GET",url,true);	xmlHttp.send(null);}function stateChng_sng_browse(){	if (xmlHttp.readyState == 4)	{	var xmlDoc=xmlHttp.responseXML.documentElement;			var org = xmlDoc.getElementsByTagName("or")[0].childNodes[0].nodeValue;		var time_str = xmlDoc.getElementsByTagName("tm")[0].childNodes[0].nodeValue;		var num = parseInt(xmlDoc.getElementsByTagName("cn")[0].childNodes[0].nodeValue,16);		var size = parseInt(xmlDoc.getElementsByTagName("sz")[0].childNodes[0].nodeValue,16) / 100;				var ar = new Array();			var al = new Array();		var cnt = num;		var code = "";				if (num > 200)		{	cnt = 200;			code += "<div class=\"s\" style=\"top:"+ (201*21+1) +"px;font-style:italic;\">";			code += "<a class=\"tt\">there are more songs to list, but this display is limited to 200 songs at a time.</a>";			code += "<a class=\"al\">the player, however, will load the full song list.</a></div>";		}					code += "<div class=\"st\" id=\"sng_st\">i0</div>";			code += "<div class=\"s\" id=\"sng_i0\" style=\"top:1px;font-weight:bold;\"";			code += " onClick=\"PlSngs('"+ org +"',1);\"><a class=\"tr\">&gt;</a><a class=\"tt\" id=\"sng_all\"";			code += " onMouseOver=\"hdr_ov('sng_all');\" onMouseOut=\"hdr_of('sng_all');\"";			code += ">Play All Listed Songs</a></div>";				for (i = 0; i < cnt; i++)		{	var p = i - 1;			var it = xmlDoc.getElementsByTagName("i")[i];			var rn = parseInt(it.getElementsByTagName("n")[0].childNodes[0].nodeValue,16);			ar[i] = it.getElementsByTagName("r")[0].childNodes[0].nodeValue;			al[i] = it.getElementsByTagName("a")[0].childNodes[0].nodeValue;						if (ar[i] == '_') { ar[i] = ar[p]; } ar[p] = "";			if (al[i] == '_') { al[i] = al[p]; } al[p] = "";												code += "<div style=\"top:"+ ((i+1)*21+1) +"px;\" id=\"sng_i"+ (i+1) +"\" class=\"s\"";			code += " onClick=\"PlSngs('"+ org +"',"+ (i+1) +");ItmClr('sng','i"+ (i+1) +"');\">";			code += "<a class=\"tr\">"+ parseInt(it.getElementsByTagName("k")[0].childNodes[0].nodeValue,16) +".</a>";			code += "<a class=\"tt\">"+ it.getElementsByTagName("t")[0].childNodes[0].nodeValue +"</a>";			code += "<a class=\"ar\">"+ ar[i] +"</a><a class=\"al\">"+ al[i] +"</a>";			code += "<a class=\"ln\">"+ it.getElementsByTagName("l")[0].childNodes[0].nodeValue +"</a></div>";			code += "<div class=\"a\" style=\"top:"+ ((i+1)*21+2) +"px;\"";			code += " onClick=\"AdSng("+ rn +");\"></div>";					code += "<div class=\"e\" style=\"top:"+ ((i+1)*21+2) +"px;\"";			code += " onClick=\"EdSng("+ rn +","+ (i+1) +");\"></div>";					code += "<div class=\"d\" style=\"top:"+ ((i+1)*21+2) +"px;\"";			code += " onClick=\"DlSng("+ rn +","+ (i+1) +");\"></div>";				}		document.getElementById("snglist").innerHTML = code;				snap = "<a>" + num + " songs, " + size + " MBs, " + time_str + " total time.</a>";		document.getElementById("snap_i").innerHTML = snap;		}	}