// JavaScript Document
// I Menu di Blue Marinara
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_nbGroup(event, grpName) { //v6.0
var i,img,nbArr,args=MM_nbGroup.arguments;
  if (event == "init" && args.length > 2) {
    if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
      img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
      if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
      nbArr[nbArr.length] = img;
      for (i=4; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
        if (!img.MM_up) img.MM_up = img.src;
        img.src = img.MM_dn = args[i+1];
        nbArr[nbArr.length] = img;
    } }
  } else if (event == "over") {
    document.MM_nbOver = nbArr = new Array();
    for (i=1; i < args.length-1; i+=3) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = (img.MM_dn && args[i+2]) ? args[i+2] : ((args[i+1])?args[i+1] : img.MM_up);
      nbArr[nbArr.length] = img;
    }
  } else if (event == "out" ) {
    for (i=0; i < document.MM_nbOver.length; i++) { img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
  } else if (event == "down") {
    nbArr = document[grpName];
    if (nbArr) for (i=0; i < nbArr.length; i++) { img=nbArr[i]; img.src = img.MM_up; img.MM_dn = 0; }
    document[grpName] = nbArr = new Array();
    for (i=2; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = img.MM_dn = (args[i+1])? args[i+1] : img.MM_up;
      nbArr[nbArr.length] = img;
  } }
}

function MM_preloadImages() { //v3.0
 var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
   var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
   if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function mmLoadMenus() {
  if (window.mm_menu_0119122257_0) return;
  window.mm_menu_0119122257_0 = new Menu("root",177,17,"Verdana, Arial, Helvetica, sans-serif",11,"#000000","#FFFFFF","#FFFFFF","#000099","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0119122257_0.addMenuItem("Scadenze&nbsp;e&nbsp;Promemoria","location='scadenze.php'");
   mm_menu_0119122257_0.fontWeight="bold";
   mm_menu_0119122257_0.hideOnMouseOut=true;
   mm_menu_0119122257_0.bgColor='#000000';
   mm_menu_0119122257_0.menuBorder=1;
   mm_menu_0119122257_0.menuLiteBgColor='#000000';
   mm_menu_0119122257_0.menuBorderBgColor='#000000';
window.mm_menu_0119122439_0 = new Menu("root",150,17,"Verdana, Arial, Helvetica, sans-serif",11,"#000000","#FFFFFF","#FFFFFF","#000084","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0119122439_0.addMenuItem("Listini&nbsp;Posti&nbsp;Barca","location='listini_posti_barca.php'");
  mm_menu_0119122439_0.addMenuItem("Listini&nbsp;Generici","location='listini_generici.php'");
  mm_menu_0119122439_0.addMenuItem("Crea&nbsp;Nuovo&nbsp;Listino","location='listini_nuovo.php'");
   mm_menu_0119122439_0.fontWeight="bold";
   mm_menu_0119122439_0.hideOnMouseOut=true;
   mm_menu_0119122439_0.bgColor='#555555';
   mm_menu_0119122439_0.menuBorder=1;
   mm_menu_0119122439_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0119122439_0.menuBorderBgColor='#000000';

  window.mm_menu_0119122746_0 = new Menu("root",280,17,"Verdana, Arial, Helvetica, sans-serif",11,"#000000","#FFFFFF","#FFFFFF","#000084","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0119122746_0.addMenuItem("Inserisci&nbsp;Nuovo&nbsp;Contratto","location='contratto_nuovo.php'");
  mm_menu_0119122746_0.addMenuItem("Rapporto&nbsp;Contratti","location='report_contratti.php'");
  mm_menu_0119122746_0.addMenuItem("Contratti&nbsp;in&nbsp;Scadenza","location='contratti_in_scadenza.php'");
  mm_menu_0119122746_0.addMenuItem("Rapporto&nbsp;Annuale","location='rapporto_annuale.php'");
  mm_menu_0119122746_0.addMenuItem("Rapporto&nbsp;Corrispettivi","location='corrispettivi.php'");
  mm_menu_0119122746_0.addMenuItem("Rapporto&nbsp;Rendite","location='rendite.php'");  
  mm_menu_0119122746_0.addMenuItem("Statistica&nbsp;Contratti&nbsp;per&nbsp;Nazionalit&agrave;","location='statistiche1.php'");
  mm_menu_0119122746_0.addMenuItem("Statistica&nbsp;Presenze&nbsp;per&nbsp;Dimensione&nbsp;Risorsa","location='statistiche2.php'");
  mm_menu_0119122746_0.addMenuItem("Statistica&nbsp;Presenze&nbsp;per&nbsp;Tipo&nbsp;Imbarcazione","location='statistiche3.php'");
  mm_menu_0119122746_0.addMenuItem("Statistica&nbsp;Contratti&nbsp;per&nbsp;Provincia","location='statistiche4.php'");
  mm_menu_0119122746_0.fontWeight="bold";
   mm_menu_0119122746_0.hideOnMouseOut=true;
   mm_menu_0119122746_0.bgColor='#555555';
   mm_menu_0119122746_0.menuBorder=1;
   mm_menu_0119122746_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0119122746_0.menuBorderBgColor='#000000';

      window.mm_menu_0119123555_0 = new Menu("root",240,17,"Verdana, Arial, Helvetica, sans-serif",11,"#000000","#FFFFFF","#FFFFFF","#000084","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0119123555_0.addMenuItem("Fatture","location='fatture.php'");
  mm_menu_0119123555_0.addMenuItem("Prima Nota","location='prima_nota.php'");
  mm_menu_0119123555_0.addMenuItem("Lettere&nbsp;di&nbsp;Scadenza&nbsp;Contratti","location='contratti_scadenze.php'");
  mm_menu_0119123555_0.addMenuItem("Lettere&nbsp;di&nbsp;Scadenza&nbsp;Assicurazioni","location='assicurazioni_scadenze.php'");
  mm_menu_0119123555_0.addMenuItem("Lettere&nbsp;di&nbsp;Spese&nbsp;Condominiali","location='stampa_spese_condominiali.php'");
  mm_menu_0119123555_0.addMenuItem("Gestione&nbsp;Template&nbsp;di&nbsp;Stampa","location='stampa_gestione_template.php'");
 mm_menu_0119123555_0.addMenuItem("Statistiche&nbsp;di&nbsp;Gestione","location='percentuali.php'");
   mm_menu_0119123555_0.fontWeight="bold";
   mm_menu_0119123555_0.hideOnMouseOut=true;
   mm_menu_0119123555_0.bgColor='#555555';
   mm_menu_0119123555_0.menuBorder=1;
   mm_menu_0119123555_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0119123555_0.menuBorderBgColor='#000000';

  window.mm_menu_0125150644_0 = new Menu("root",197,17,"Verdana, Arial, Helvetica, sans-serif",11,"#000000","#FFFFFF","#FFFFFF","#000099","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0125150644_0.addMenuItem("Inserimento&nbsp;Nuovo&nbsp;Cliente","location='cliente_inserimento.php'");
  mm_menu_0125150644_0.addMenuItem("Inserimento&nbsp;Nota","location='nota_inserimento.php'");
  mm_menu_0125150644_0.addMenuItem("Comunicazioni&nbsp;ai&nbsp;Clienti","location='clienti_comunicazioni.php'");
  mm_menu_0125150644_0.addMenuItem("Stampa&nbsp;Etichette","location='clienti_etichette.php'");
   mm_menu_0125150644_0.fontWeight="bold";
   mm_menu_0125150644_0.hideOnMouseOut=true;
   mm_menu_0125150644_0.bgColor='#000000';
   mm_menu_0125150644_0.menuBorder=1;
   mm_menu_0125150644_0.menuLiteBgColor='#000000';
   mm_menu_0125150644_0.menuBorderBgColor='#000000';

    window.mm_menu_0125164214_0 = new Menu("root",187,17,"Verdana, Arial, Helvetica, sans-serif",11,"#000000","#FFFFFF","#FFFFFF","#000099","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0125164214_0.addMenuItem("Inserimento&nbsp;Nuova&nbsp;Barca","location='barca_inserimento.php?id=0'");
  mm_menu_0125164214_0.addMenuItem("Assicurazioni&nbsp;in&nbsp;Scadenza","location='assicurazioni_in_scadenza.php'");
   mm_menu_0125164214_0.fontWeight="bold";
   mm_menu_0125164214_0.hideOnMouseOut=true;
   mm_menu_0125164214_0.bgColor='#000000';
   mm_menu_0125164214_0.menuBorder=1;
   mm_menu_0125164214_0.menuLiteBgColor='#000000';
   mm_menu_0125164214_0.menuBorderBgColor='#000000';

    window.mm_menu_0125165432_0 = new Menu("root",157,17,"Verdana, Arial, Helvetica, sans-serif",11,"#000000","#FFFFFF","#FFFFFF","#000099","left","middle",3,0,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0125165432_0.addMenuItem("Rapporto&nbsp;Presenze","location='report_presenze.php'");
  mm_menu_0125165432_0.addMenuItem("Rapporto&nbsp;Arrivi","location='report_arrivi.php'");
  mm_menu_0125165432_0.addMenuItem("Gestione&nbsp;Pontili","location='pontili.php'");
   mm_menu_0125165432_0.fontWeight="bold";
   mm_menu_0125165432_0.hideOnMouseOut=true;
   mm_menu_0125165432_0.bgColor='#000000';
   mm_menu_0125165432_0.menuBorder=1;
   mm_menu_0125165432_0.menuLiteBgColor='#000000';
   mm_menu_0125165432_0.menuBorderBgColor='#000000';

mm_menu_0125164214_0.writeMenus();
} // mmLoadMenus()
function conferma_cancellazione() {
	var response = window.confirm("Confermi la cancellazione ?");
	if (response) {
		return true;
	}
	else {
		return false;
	}
}