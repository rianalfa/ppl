//Etable.js
//Instantiate new input and output objects
var out=new Output();
var input=new Input();

//Jan 2007

var save=false;
//When true, saving is allowed and Save and Read Data buttons will be displayed.

var OpenEpi=false;
//Set to true by onLoad when (supposedly) all modules have finished loading

var configured=false;

var useTableSettings=false;
//Set by OECommand usetablesettings(true or false)

//Define a variable to hold the current table object
var myTable;

//Define the data array to be passed to the calling application
var jg;

//var Apend=t("Appending");
//var noApend=t("Not Appending");


var currentstratum=1;
//Strata start with 1, not 0

var HighLightP=true;

var dataMatrix=new Array();

var rows=10;
var cols=6;
var cmin=-1;
var cmax=-1;
var rmin=-1;
var rmax=-1;
var x=200;
var y=50;
var w=400;
var h=600;

//Default r x c  table parameters

function loadExternalData()
{
if (LoadData && appDataArray && appDataArray.length>1)
	   {

	    dataMatrix=appDataArray;

		readMemToTable(1);  //Get stratum 1 data

		readMetaToTable();  //Get metadata from dataMatrix

		if (dataMatrix.length>2)
		 {
		     for (i=0; i<dataMatrix.length-2;i++)
		       {
		         addStratum()
		       }
			 changeStratumTo(1);
		 }
		 }
 }



function okCancelDialog(prompt)
{ 
//Shows the confirm modal dialog box.  Placed here so that the dialog appears
  //in front of Etable.  Dialogs called from another window will appear in front of
  //that window, leading to confusion if Etable has been in the foreground.
  return confirm(prompt);
}

function infoDialog(prompt)
{
  //Shows the alert modal dialog box.  Placed here so that the dialog appears
  //in front of Etable.  Dialogs called from another window will appear in front of
  //that window, leading to confusion if Etable has been in the foreground.
  alert(prompt);
}

function setColors()
{
var datacolor= myTable.bgcolor;
var totalcolor="#aaaaaa";
var valuecolor="#bbbbbb";
var variablecolor="#cccccc";
var ccolor = myTable.bgcolor;
//alert("in setcolors")
for (r=0 ; r< myTable.rows ; r++)
  {
		for (c=0; c < myTable.cols ; c++)
		{
		  var tt=myTable.row[r].cell[c].type;
		  // alert("r="+r+" c="+"tt="+tt)
			if ((tt== "data") ||(tt=="calendar")) {ccolor=datacolor;}
			  else if  (tt=="rowtot" || tt== "row total" || tt=="column total") {ccolor=totalcolor;}
			  else if (tt=="valname") {ccolor=valuecolor;}
			  else if (tt=="varname") {ccolor=variablecolor;}
			  else if (tt=="label") {ccolor=variablecolor;};
		    myTable.setCellColor(r,c,ccolor); 
			myTable.out(r,c);   //not efficient, but it works to restore color.  Don't know why
			//Potential types are data, row total, column total, grand total, value label, variable label
		}
  }
}

function fillTable() {
//Fills one stratum of table from memory array
}

function saveTable(){
//Saves one stratum to array in memory

}

function clearTable()
{
 var foundFirst=false;
 removeCalendar();
 for (r=0 ; r< myTable.rows ; r++)
  {
		for (c=0; c < myTable.cols ; c++)
		{
		  var tt=myTable.row[r].cell[c].type;
			if (tt== "data" ||tt=="rowtot" ||tt=="coltot" || tt=="grandtot"||tt=="calendar"||tt=="valname")
			{
			  myTable.insert(r,c,"");
              if ((tt=="data"||tt=="calendar")&& !foundFirst)
                {
                  myTable.moveInputTo(r,c);
                  foundFirst=true;
                }
			}
  		 }
        // myTable.moveInputTo(1,1);
  }
  document.inBox.entryfield.value="";
}

function cmdExecute(cmdArray)
{
//Executes a series of commands passed in as a one-dimensional array
//Commands must be JavaScript as text strings
//alert("in cmdExecute cmdArray has "+cmdArray.length +" commands")
count=0;
for (var i=0; i<cmdArray.length; i++)
  {
  var c=cmdArray[i];
  try
   {
    eval(c);
	count+=1;
   }
   catch(exception)
    {
    if(!confirm("Oops, cannot evaluate["+cmdArray[i] + "\nProblem=" + exception+".]\n Continue?"))
	  {return count}
    }      
  }
 if(typeof(myTable)=="object") {configured=true;}
   else
   {alert("myTable not ready. Please try again.")}
 return count;  
}


//Note: The functions evalEntry and evalKey MUST exist, since they are called specifically by the dynamic stratum's input box.

function evalEntry()
{
//call input box evaluation in current stratum
if (typeof (myTable) != null)
  {
    myTable.evalEntry();
    myTable.moveInputNext();
   }
}

function evalKey(evt) {
  var keyCode = document.layers ? evt.which : document.all ?  
        evt.keyCode : evt.keyCode;
 //alert("keycode "+evt.keyCode);
  if (keyCode == 9)   
    {evalEntry();
	return false;}
  else if (keyCode ==40) {
    myTable.moveUpDown=true;
    evalEntry();
	return false;} 
  else if (keyCode==38) {
    myTable.moveUpDown=true;
	myTable.moveUp=true;
	evalEntry();
	return false;}	
  else {return true;}
}

function userInsert(){
	row = document.forms["insertForm"].row.value
	col = document.forms["insertForm"].col.value
	val = document.forms["insertForm"].val.value
	myTable.insert(row,col,val)
	myTable.calcTotals(row,col);
}

function setCellValue(r,c,setting)
{
myTable.insert(r,c,setting)
}

function getCellValue(r,c)
{
value=myTable.get(r,c);
return value
}

function showObject(obj) 
{
	obj.style.visibility="visible";
}
var delstrat=t( "Delete this Stratum?");
var selstrat=t('Please select a Stratum before deleting.');

function deleteStratum()
{
var i,n;
 var strat = document.form1.theStratum;
 var chosen=strat.selectedIndex+1;  //Options are zero based, but strata are 1 based.
 if (chosen > 0 ) 
   {
      if (confirm(delstrat) )
      {
	   changeStratumTo(chosen-1);
	   //changeStratumTo(chosen-1);  //actually the one just before the one chosen
	   //strat.selectedIndex-=1;
	   strat.options[chosen-1]=null;
	   //Fix names of strata beyond deletion, if they are system generated.
	    if (strat.options.length>=chosen)
		  {
		   for (i=chosen; i<=strat.options.length; i++)
		     {
			  n=strat.options[i-1].text
			  if (/(Stratum)\s\d*/.test(n))
			    {
				 strat.options[i-1].text="Stratum "+(i);
				}
			 }
		  } 
	   if (dataMatrix[chosen])
	     {dataMatrix.splice(chosen,1);}
	   strat.focus()
	   myTable.moveInputTo(dataMatrix[0].datarmin,dataMatrix[0].datacmin);
       } 
	}   
   else 
  	  {
	  alert(selstrat);
	  }
 
 if (strat.options.length<2)
	    {
		 //Hide the selection box
		 ShowHide("stratsel_span",false);
		 ShowHide("delbtn_span",false);
		}
}

function changeStratumTo(newchoice)
{
evalEntry();
var strat = document.form1.theStratum;
//alert("New Stratum="+newchoice + "currentstratum="+currentstratum)
//Store currentstratum to dataMatrix
storeAllToMem(currentstratum, MaxValueAtLeft, MaxValueAtTop, ExposureLeft);
//Get new stratum from dataMatrix if it exists there
//following  line was commented out.  Replaced Mar 31, 2013
//getAllFromMem(newchoice,MaxValueAtLeft, MaxValueAtTop, ExposureLeft);

clearTable();
readMemToTable(newchoice)
//Set currentstratum to newchoice
currentstratum=newchoice
strat.selectedIndex=newchoice-1
strat.focus()
}

var plsenter=t("Please enter data for this stratum before adding another.");

function addStratum()
{
evalEntry();  //Assimulate the last entry in the current stratum
if (storeAllToMem(currentstratum, MaxValueAtLeft, MaxValueAtTop, ExposureLeft))
   {
    //At least one data item found.  OK to add stratum
	var strat = document.form1.theStratum;
	var option = new Option("Stratum "+(strat.options.length+1),"Optional Name",false,true);
	ShowHide("stratsel_span",true);
	ShowHide("delbtn_span",true);      
	strat.options[strat.options.length] = option;
	changeStratumTo(strat.options.length)
	//strat.focus()
    myTable.moveInputTo(dataMatrix[0].datarmin,dataMatrix[0].datacmin); 
   }
else
   {
    alert(plsenter)
	clearTable();
   }     
}

function ShowHide(spanname, show)
{
  //var spanname;
  if (document.all) 
    {
     if (show)
	     {
		  eval("document.all."+spanname+".style.visibility='visible';");
		 }
     else 
	     {
		  eval("document.all."+spanname+".style.visibility='hidden';");
		 }
	 }
  else 
     {
    if(navigator.userAgent.indexOf("Gecko")!= -1) 
	 {// is NS6 ?
      if (show) 
	     {
		   document.getElementById(spanname).style.visibility="visible";
		  }
      else 
	     {
		 document.getElementById(spanname).style.visibility='hidden';
		 }
	  }
  else 
      {
    if (show) 
	     {
		 
		 eval("document.layers['"+spanname+"'].visibility='show';");
		 alert('show');
		 }
    else 
	     {
		 
		 eval("document.layers['"+spanname+"'].visibility='hide';"); 
		 }
	  }
  }
}


function hideObject(obj) 
{
	if (ns4) obj.visibility = "hide"
	else if (ie4) obj.visibility = "hidden"
}

var timerid
var stopid
var starttime;


function timerStart()
{
starttime=new Date();  //Get current time
//ShowHide("proc_span",true);
document.body.style.cursor='wait';//change cursor to hourglass--seems to work on time only in NS
//document.getElementById("proc_span").innerHTML="Processing.."
}

function timerStop(hideAfter)
{
//stop timer
document.body.style.cursor='default';
var now=new Date();

 try
 { 
var elapsedtime=(now.getTime()-starttime.getTime())/1000;
document.getElementById("proc_span").innerHTML="Done<br>" + elapsedtime+ ' seconds';
}
catch(err)
{
//ignore error
}
setTimeout('document.getElementById("proc_span").innerHTML=""',1000*hideAfter);  //Make timer display invisible
														 
}

function EntryTableAsHTML (obj)
{
var out=new Output();
var w=Math.round(600/obj.cols);
if (w<40){w=40};
if (w>100){w=100}
out.newtable(obj.cols+1,w);
//alert("obj.cols="+obj.cols)
out.title("<h3>" + obj.headText + "</h3>");
out.line(obj.cols+1);
for (var r=0; r<obj.rows; r++)
{
   out.newrow()
   for (var c=0; c<obj.cols; c++)
   {
    if (myTable.row[r].cell[c].type=="data")
      {
	  out.cell(myTable.get(r,c))
	  }
	else
	  {
	  out.header(myTable.get(r,c))
	  }   
   }
}
out.endtable();
return out.s
}

var beforecalc=t("Please enter data before choosing 'Calculate.'");

function calculateStats(){
//cStratum=1; //temporarily

//timerStart();
removeCalendar();
evalEntry();
if (currentstratum==1)
{
  if (storeAllToMem(currentstratum, MaxValueAtLeft, MaxValueAtTop, ExposureLeft))
   {
    //At least one data item found.  Do calculations. 
	//timerStart();
    if (parent) {OECalculate(dataMatrix);}
   }
   else
   {

    alert(beforecalc)
	clearTable();
	myTable.moveInputNext();
	myTable.moveInputTo(myTable.inputR-1,myTable.inputC);
	timerStop(0.01);
   }  
}
else
{
    if (!storeAllToMem(currentstratum, MaxValueAtLeft, MaxValueAtTop, ExposureLeft))
	  {
	    //stratum must be empty
	    deleteStratum();
	  }
    if (parent) 
	  {
	  // Go ahead and calculate anyway because there are other strata
	  // timerStart();
	    OECalculate(dataMatrix);
		
	  }
}
}

function EtableOpen()
{
  //This is nonsense and should be removed
  if(parent) 
    {
	OpenEpi=true;
    return true;
    }
}

//<BODY onLoad="JavaScript:setTimeout('EtableOpen()',1000); loadExternalData();" onUnload="JavaScript:OpenEpi=false;">


function summaryTable()
{
var htmlstr="";
var clearStr="Clear"
var calculateStr="Calculate"
if(t)
  {
    clearStr=t("Clear")
    calculateStr=t("Calculate")
  }

//htmlstr+='<DIV id="button1">';
htmlstr+='<FORM name="form1" id="form1">';  //experiment
htmlstr+='<br />';

//htmlstr+='<input type="button" name="Clear" value=clearStr onClick="clearTable();return false;">';
htmlstr+='<button type="button" onClick="clearTable();return false;">'+clearStr+'</button>';

htmlstr+='<span id="settings_span" name="settings_span" style="visibility:hidden;">';

htmlstr+=' <a name="settinglink" href="../settings/Settings.htm" target="_self">'+"Settings "+'</a>'

//htmlstr+='<font size=-1>&nbsp;Conf. level &nbsp;\='+ConfLevel+'\%</font>';
htmlstr+='<small style="text-align:left">&nbsp;Conf. level\='+ConfLevel+'\%</small>';

htmlstr+='</span>';
//htmlstr+='<input type="submit" value="Calculate" onClick="timerStart();setTimeout(\'calculateStats()\',100);return false;"  name="calc" id="calc">';
htmlstr+='<button type="button" id="calc" onClick="callStatsIf();return false;">'+calculateStr+ '</button>';

//htmlstr+='<br /><span id="scontrols_span" style="visibility:hidden; position:absolute;top:40;left:40;">';
htmlstr+='<span id="scontrols_span" style="visibility:hidden;">';

//htmlstr+='<FORM NAME=form1>';
//htmlstr+='<table name=scontrols id=scontrols style="position:relative; top:0;left:0;">';
htmlstr+='<table name=scontrols id=scontrols>';

htmlstr+='<tr>';
htmlstr+='<td>';
htmlstr+='<INPUT TYPE="button" VALUE="'+t("Add Stratum")+'" NAME=btnAddStrat ';
htmlstr+='   onclick="addStratum()">';
htmlstr+='</td>';
htmlstr+='<td>';
htmlstr+='<span id="stratsel_span"';
htmlstr+='style="position:relative;top:0;left:0">';
htmlstr+='<SELECT NAME=theStratum onChange="changeStratumTo(selectedIndex+1);" SIZE=1>';
htmlstr+='   <OPTION VALUE=0>'+t("Stratum")+' 1';
htmlstr+='</SELECT>';
htmlstr+='</span>';
htmlstr+='</td>';
htmlstr+='<td>';
htmlstr+='<span id="delbtn_span"';
htmlstr+='style="position:relative;top:0;left:0">';
htmlstr+='<input type="button" value="Delete Stratum" name="btnDeleteStrat" onClick="deleteStratum()">';
htmlstr+='</span>';
htmlstr+='</td>';
htmlstr+='</tr>';
htmlstr+='</table>';
htmlstr+='</span>'; //Misplaced end tag caused tables not to show in Safari for Mac.  Moving it down two lines fixed the problem.
htmlstr+='</FORM>';
//htmlstr+='</span>';
//htmlstr+='<span id="proc_span" style="position:absolute;top:350;left:10">';

//htmlstr+='</span>';
// showStringInDiv(htmlstr,"panel2");
//document.write(htmlstr);
 // console.log("564 ETable"+ htmlstr)
return htmlstr;
}

/*
 ffmsg="If you are running OpenEpi in Firefox on local disk, enter ABOUT:CONFIG in Firefox's address bar.";
 ffmsg+=" Consent to the scary message. Find SECURITY.FILEURI.STRICT_ORIGIN_POLICY and double-click it ";
 ffmsg+=" to change the value to 'false'. This one-time setting restores Firefox 3.x Javascript function to that of "
 ffmsg+="Firefox 2.0 and other browsers."
var tries=0
var numcmds=0
var parentobjOK=false;
//Test for error caused by Firefox 3.x that affects only local disk version of OpenEpi
try
{
 if (typeof(etablecmds1)=="object")
   {
     parentobjOK=true;
   }
}
catch(err)
{
  alert(ffmsg);
}

*/
//if (window != null && window.parent != null)

function tableFromCommands()
{
if (typeof (etablecmds1) =="object")
{
  numcmds=cmdExecute(etablecmds1)
  if (numcmds!=-1)
   {
    myTable.build();
  // myTable.css="#panel2 { width: 100%}"+ myTable.css
   insertCSS("#panel2"+myTable.css);

   //cssString="<style media=\"screen,projection\" type=\"text/css\">" + myTable.css+ "</style>";
  // document.getElementsByTagName("head")[0].innerHTML+= cssString;
 //alert("Etablejs 605 myTable.div \n"+ myTable.div);
 //$("panel2").HTML+=  myTable.div ;    //use jQuery to write the HTML code for the table
// $("panel2").innerHTML+=  myTable.div ;    //use jQuery to write the HTML code for the table
 addStringToDiv(myTable.div,"panel2");
    //document.write(myTable.div);
//The document.write must be in the body or called from the body or it will write
//over the existing HTML in the window, including the buttons.
    myTable.activate();
    setColors();
   // tries=0
   // numcmds=0

     if (etablecmds2 != null) {numcmds=cmdExecute(etablecmds2);}

	}
document.close()
myTable.moveInputNext();
}
}

//end of script
