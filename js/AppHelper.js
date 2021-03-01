// JavaScript Document  AppHelper.js
//Global variables and functions for opening data input window
//To be linked into OpenEpi Applications
var OpenEpi = false; //Set when Etable is loaded and false after unloading
var OEShell = true;
//These global variables must be present for ETable to work with settings from
//this module.
var EntryWin; //for data entry
var ResultWin; //for results
var DemoWin; //for demo data htm
var ExWin; //for demo and Exercise instructions
var newWindow; // for messages
//Jan 2007
var LoadData = false; //Set to true when data are to be loaded from demofile frame (or future storage)
var etablecmds1 = new Array();
var etablecmds2 = new Array();
//var appDataArray=new Array();
var triedtoopen = 0;
var applabel = null; //Label for section in the translation file.  Will be set by InitTranslation and reset to null by t();
//Number of attempts to open the EntryWin window
if (typeof(basefilename)== "undefined")
{
  var basefilename = "NoBaseFile"
  //alert("location.pathname="+location.pathname);
}
//alert("window.top.code.translationpath="+window.top.code.translationpath);  //This works when menu is running alone without a shell
var demofile = ""; //Must be defined even if there is no demo file.

//Basefilename must be defined and set at the beginning of the application
//The other filenames are derived from the basefilename as follows:
demofile = basefilename+"Demo.htm"; //If you do not have a demo file, set this variable to null ("")
//in the application itself
//The Load Demo Data button and the Demo toolbar button
//will be automatically omitted from the interface.

var statsfile = basefilename+".js"; //The file containing statistical routines.
var examplefile = basefilename+"Ex.htm"
var docfile = "../PDFDocs/"+basefilename+"doc.pdf"; //The help or documentation file
var testfile = "../PDFDocs/"+basefilename+"tests.pdf"; //A file describing testing that has been done
var inscreenimg = "Screens/"+basefilename+"In.gif" //Assumes files by these names are supplied in the
var outscreenimg = "Screens/"+basefilename+"Out.gif" //subdirectory called Screens.
var TFrameFile = examplefile;


function useOpenEpiEntry(tblcmdarray1, tblcmdarray2, externalData)
{
  //Opens the ETable module in a new window.  Its properties can be referred to by
  //referring to the EntryWin object.


  //Temporarily disabled!!!
  //if (($("panel2")!=null)&&($("panel2").innerHTML.length>0))     //If it exists, just bring it to the foreground
  //     {return }


  if ($('panel2').innerHTML.length>0)
  {return}
  /*  try
   {
   if (!EntryWin.closed)
     {
      //If it exists, just bring it to the foreground
      EntryWin.focus()
      return
     }
   }
   catch(e)
   {
   }*/
  // alert("61 LoadData="+LoadData);
  appDataArray = new Array() //Initialize the arrays in case this is a rerun
  etablecmds1 = new Array()
  etablecmds2 = new Array()
  //If it does not exist, parse the input table setup commands and make them available
  //in the two arrays, called Etablecmds1 and Etablecmds2, using the functions in the Input
  //object, which know which of the two arrays to employ.

  if (tblcmdarray1 && tblcmdarray1.length>0)
  {
    //There must be tabcmdarray1, probably from a demo file or other outside input
    etablecmds1 = tblcmdarray1; //If commands are provided, use them; otherwise this should do no harm.
    etablecmds2 = tblcmdarray2;
    //alert("etablecmds1 has "+ etablecmds1.length + " commands")
  }
  else
  {
    if (typeof(configureInput)=="undefined") {return}
    if (configureInput()==false)
    {
      //Run configureInput, but, if the user cancelled, just return.
      return
    }
  }
  //open the data entry table as a popup window.

  //Never again after Jan 2007
  //Run Etable in the Panel2 iframe
  //var entryProg="../Etable/ETable.htm";

  //var myFrame=document.getElementById('panel2');
  //alert("about to set SRC at 89")
  //myFrame.setAttribute('src',"../Etable/ETable.htm");
  //frames["panel2"].location.href="../Etable/ETable.htm";

  //showPanel(2);
  //EntryWin=frames["panel2"];
  showPanel(2); //moved down, Mar 2007
  //if (currConfig()=="smartphone")
  //  {showPanelAsWindow(2)}

  //alert("finished loading frame in 94");

  //EntryWin=frames["panel2"]
  //EntryWin=myFrame;  //Mar 2007

  if (externalData)
  {
    appDataArray = externalData;
    //alert("128 ada Must be external Data")
  }
  /*
 if (EntryWin != null && EntryWin.OpenEpi==true)
     {
  //checkWindowOpen()
  }
   else
     {
   //setTimeout("checkWindowOpen()",1000)
   //Give Etable time to load before loading data or trying again
     }
 //alert("finished useOpenEpiEntry")
 */
}

function currConfig()
{
  //evaluates detect result from hardware and setting of ScreenConfig in settings and cookie
  //to produce a conclusion for currConfig.  The setting of "normal" results in "",
  //so that currConfig() is either "smartphone" or "".
  var config = "";
  if (ScreenConfig=="auto")
  {config = device}
  else
  {
    if (ScreenConfig=="smartphone")
    {config = ScreenConfig}
  }
  return config;
}

function checkWindowOpen()
{
  //Calls useOpenEpiEntry again if there is no EntryWin, up to 4 times.  Loads
  //data into EntryWin if this is a demo
  alert("in appHelper 145 in checkWindowOpen")
  try
  {

    if (!EntryWin)
    {
      if (triedtoopen<4)
      {
        //alert("Calling useOpenEpiEntry "+"try="+triedtoopen)
        useOpenEpiEntry()
        //alert(93)
      }
      else
      {
        alert("Problem in opening the data entry window.\n If you have a popup window exterminator, you can turn it off, or work by clicking on the ENTER menu item.");
        //Gives user advice, but may also solve the problem through providing more time;
      }
    }
    else
    {
      //EntryWin exists but is not necessarily completely loaded
      triedtoopen = 0
      //EntryWin must exist.  Reset tries to 0.
      //
      do
      {
        if (appDataArray && appDataArray.length>1)
        {

          //alert("sample data in appDataArray[1]="+appDataArray[1]["E0D0"])
          //alert("sample data in appDataArray[5]="+appDataArray[5]["E0D0"])
          if(EntryWin && EntryWin.OpenEpi==true && !EntryWin.closed)
          {
            //EntryWin exists and is completely loaded and not closed")

            EntryWin.dataMatrix = appDataArray;
            //alert("148 sample data in EntryWin.dataMatrix[1]="+EntryWin.dataMatrix[1]["E0D0"])
            //alert("sample data in EntryWin.dataMatrix[5]="+EntryWin.dataMatrix[5]["E0D0"])

            EntryWin.readMemToTable(1); //Get stratum 1 data

            EntryWin.readMetaToTable(); //Get metadata from dataMatrix

            if (EntryWin.dataMatrix.length>2)
            {
              for (i = 0; i<EntryWin.dataMatrix.length-2; i++)
              {
                EntryWin.addStratum()
              }
              EntryWin.changeStratumTo(1);
            }
          }
        }
      }
      while (EntryWin && !(EntryWin.OpenEpi==true) && !EntryWin.closed);
      appDataArray = new Array(); //Clean up
      //alert("166 entryWin.OpenEpi="+EntryWin.OpenEpi)
    }
  }
  catch(e)
  {
    alert("Problem in opening window or reading data.  Error message is: "+e)
  }
}


function openWindow(doc, name, properties)
{
  var theWindow;
  try
  {
    theWindow = window.open(doc, name, properties)
  }
  catch(e)
  {
    return false
  }
  return theWindow;
}

function closeWindow(windowvar)
{
  try
  {
    if (windowvar!=null)
    {
      if(!windowvar.closed)
      {
        windowvar.close()
      }
    }
  }
  catch(e)
  {
  }
}


function closeWindows()
{
  //called automatically from the onUnload event in the <body> tag
  closeWindow(EntryWin)
  // if(currConfig()=="smartphone")
  //    {
  //    if(panelWin!=null){panelWin.close();}
  //    }
  //closeWindow(DemoWin)
  closeWindow(ResultWin) //user may want to leave this one open?
}

function browserLanguage()
{
  //Gets the language of the browser as a two-character,
  //upper-case standard Internet code, such as EN for English or ES for Spanish.
  //If none is found, a null string returns, probably indicating an unusual browser
  var ie = window.navigator.browserLanguage; //Works in IE
  var ns = window.navigator.language; //Works in Netscape
  if (typeof(ie) != "undefined")
  {return ie.toUpperCase().substring(0, 2)}
  else if (typeof (ns)!="undefined")
  {return ns.toUpperCase().substring(0, 2)}
  else {return ""}
}

function completedHTML(stringtofix, omittext)
{
  var regexp = /<html>/i;
  if (!regexp.test(stringtofix))
  {
    //if there is no opening html tag, add initial tags for html
    var htmlheader =
    '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n'+
    '<html>\n'+'<head>\n'+'<title>Untitled Document</title>\n'+
    '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\n'+
    '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">'+
    '</head>\n'+'<body>\n'
    //alert("htmlheader="+htmlheader+ " stringtofix="+stringtofix)

    stringtofix = htmlheader+stringtofix
    // alert("294ah"+stringtofix)
  }

  regexp = /<\/html>/i;
  //If no closing html tag...
  if (!regexp.test(stringtofix))
  {
    //add closing tags
    if (!omittext)
    {
      stringtofix += "\n<br>"+ t("Results from OpenEpi, Version 3, open source calculator--")+ basefilename;
      stringtofix += "\n<br>"+t("Print from the browser with ctrl-P");
      stringtofix += "\n<br>"+t("or select text to copy and paste to other programs.")+"<p></p>\n";
      //stringtofix+="\n"+t("Many browsers have an optional setting to print background colors.")+"\n";
    }
    stringtofix += "</body></html>"

  }
  return stringtofix
}


function writeResults(stringtowrite, windowandfilename, saveifpossible, outputObj, omitfooter)
{
  var htmlstr;
  if (outputObj!=null)
  {
    //There is an outputObj.  Add header.
    htmlstr = htmlHeaderWithData(outputObj.data)+stringtowrite;
    // alert('headerwithdata+stringtowrite'+htmlstr)
  }
  else
  {
    htmlstr = stringtowrite;
    // alert('htmlstr without header'+htmlstr)
  }
  //Jan 2007
  if (starttime> 1)
  {
    timerStop(10)
  } //moved from below

  var resultpane = document.getElementById("panel3");
  htmlstr = completedHTML(htmlstr, omitfooter); //Adds HTML tags and header if necessary
  //alert('htmlstr after completion'+htmlstr)
  //Next line changed to += in order to APPEND to previous result, if any April 2012
  if (resultpane.innerHTML.indexOf(t('No results'))>0)
  {
    //Clear "No results" message
    resultpane.innerHTML = ""
    //     removeCalendar();
  }

  resultpane.innerHTML = htmlstr + resultpane.innerHTML;
  //alert(298+resultpane.innerHTML)
  //htmlstr=completedHTML(htmlstr,omitfooter); //Adds HTML tags and header if necessary
  var fname = ""
  //window.frames["panel2"].timerStop(10);
  showPanel(3); //Open the results panel
  //removeCalendar();
  /*
 if (EntryWin) {EntryWin.timerStop(10)};  //Stop timer and leave it visible for 10 seconds
 ResultWin=window.open("","Results");
 ResultWin.document.open();
 ResultWin.document.write(htmlstr);
 ResultWin.document.close();
 ResultWin.resizeTo(800,600);
 */
  if (saveifpossible)
  {
    fname = savetofile(htmlstr, windowandfilename)
  }
  /*
 setTimeout("if (!ResultWin.closed) {ResultWin.focus();}",100);
 setTimeout("if (!ResultWin.closed) {ResultWin.focus();}",1000);
 setTimeout("if (!ResultWin.closed) {ResultWin.focus();}",2500);
 setTimeout("if (!ResultWin.closed) {ResultWin.focus();}",5000);
 */
}


function popWindow(message, millisecs)
{
  var mwidth = 700;
  var mheight = 50;

  newWindow = window.open("", 'newWindow', 'toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width='+mwidth+',height='+mheight);
  var htmlstr
  htmlstr = '<html><head><script language="javascript">\n'
  htmlstr += 'var t\n'
  htmlstr += 'function closeMe()\n'
  htmlstr += '{\n'
  htmlstr += 't = setTimeout("self.close()",'+millisecs+');\n'
  htmlstr += '}\n'
  htmlstr += '</script>\n'
  htmlstr += '</head>\n'
  htmlstr += '<body onload="closeMe()" bgcolor="#CCCCFF">\n'
  htmlstr += '<body bgcolor="#CCCCFF">\n'

  htmlstr += '<h3>'
  htmlstr += message
  htmlstr += '</h3>\n'
  htmlstr += '</body></html>'
  newWindow.document.open()
  newWindow.document.write(htmlstr);
  newWindow.document.close();
  //newWindow.closeMe()

  if (millisecs>400)
  {
    m = setTimeout("newWindow.focus();", 300);
  }

}

function oesavefound()
{//revised Sept 2009 to avoid error in Firefox 3.5
  if (window.parent)
  {
    if (window.parent.parent=="OpenepiSave.hta")
    {
      //if (window.parent.parent.savingdata)
      //  {
      return true;
      //  }
    }
  }
  return false;
}

function savetofile(htmstr, name, append)
{
  var calledsave = false;
  var namesaved = ""

  if (oesavefound())
  {
    //Call saving routine and get back path of saved file
    namesaved = window.parent.parent.savingdata(htmstr, name, append)
    popWindow("Results saved in "+namesaved, 6000)
    calledsave = true
  }
  return calledsave;
}

function jsStringFromArray(dataArray)
{
  var jsStr = 'var A = new Array()\n'
  //var ix=0;
  //var val
  //var index = new Array();
  /*
 for (key in dataArray)
   {index[ix]=key;
    ix++;}
 index.sort()
 */
  //jsStr+='var s = new Array();\n'
  for (i = 0; i<dataArray.length; i++)
  {if (i==0) {jsStr += '\n   \/\/Meta data for the dataset...\n';}
    if (i==1) {jsStr += '\n  \/\/Data in one or more strata...\n';}
    var val, j
    jsStr += 'var s'+i+'= new Array();\n'
    for (key in dataArray[i])
    {
      val = dataArray[i][key]
      //jsStr+='s["'+key+'"]='+dataArray[i][key]+'\n'
      //if(key=="Evals") {alert("typeof="+typeof(val)+" length="+val.length)}
      if (typeof(val)=="object")
      {

        //alert("key="+key)
        if (val!=null && val.length)
        {
          // if (val.length==null) {alert("val.length=null" + "val=" + val)}
          if (val.length>0)
          {
            //must be an array
            jsStr += 's'+i+'["'+key+'"]=new Array(';
            for(j = 0; j<val.length; j++)
            {
              jsStr += '"'+val[j]+'"';
              if (j<val.length-1) {jsStr += ',';} //If not the last item, add a comma
            }
            jsStr += ')\n';
          }
        }
      }
      else
      {
        if (typeof(val)!="string")
        {
          jsStr += 's'+i+'["'+key+'"]='+val+'\n' // no quotes
        }
        else
        {
          //jsStr+='A['+i+']["'+key+'"]='+'\"' + val+'\"\n'  //Set up javascript assignment to array
          jsStr += 's'+i+'["'+key+'"]='+'\"' + val+'\"\n'

        }
      }
    }
    jsStr += 'A['+i+']=s'+i+';\n'
    //jsStr+= 's.length=0;\n'
  }

  return jsStr;
}

function jsToHtml(js)
{
  var tag = '<script language="JavaScript" type="text/JavaScript">\n'
  return tag+js+'\n</script>'
}

function dataToJSFunction(dataArray)
{
  //Note: This assumes that the string representing the array names the array 'A'
  var s = 'function dataArray()\n{'

  s += jsStringFromArray(dataArray);
  s += '\nreturn A\n}\n'

  return s;
}

function inputCmdsToJSFunction(inputArray, functionname)
{
  var i;
  var s = 'function '+functionname+'()\n{var A=new Array()\n';
  for (i = 0; i<inputArray.length; i++)
  {
    s += 'A['+i+']='+"\'"+inputArray[i]+"\'"+'\n'
  }
  s += '\nreturn A\n}\n\n'
  return s;
}

function callStatsIf()
{
  //Call stats if panel two is visible.  Mar 2007
  //alert ("Panel 2 display="+document.getElementById('panel2').style.display );
  if (document.getElementById('panel2').style.display != 'none')
  {
    //EntryWin.calculateStats()
    calculateStats()
  }
}


function htmlHeaderWithData(dataArray)
{

  var s =
  '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n'+
  '<html>\n'+'<head>\n'+'<title>Results</title>\n'+
  '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\n';
  s += '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">'

  s += '</head>\n'

  var s1 = 'function runEtable()\n'+
  '{\n'+
  'if (typeOf useOpenEpiEntry=="function")\n'+
  ' {\n'+
  '   useOpenEpiEntry(etableCmds1(),etableCmds2(),dataArray());\n'+
  '\t}\n'+
  ' }\n'

  //s+=jsToHtml(dataToJSFunction(dataArray)+inputCmdsToJsFunction(cmds1,"etableCmds1")+inputCmdsToJsFunction(cmds2,"etableCmds2")+s1);
  s += jsToHtml(dataToJSFunction(dataArray)+inputCmdsToJSFunction(etablecmds1, "etableCmds1")+inputCmdsToJSFunction(etablecmds2, "etableCmds2")+s1);


  s += '</head><body onload="runEtable()">\n'

  return s
}

var dialoghandle = "";

function modalDialog(urlname)
{
  //Shows an htm file containing suitable code to keep the dialog in front of
  //other windows.  To use this technique, copy DialogYesNo.htm and modify it for
  //your application.  It will automatically call processDialog(choice) when the user
  //makes a choice. processDialog must be in the application.
  //var waitover=0;
  //var result=null;
  //var winhandle=null;
  attributes = 'height=200,width=300,left=300,top=200'
  dialoghandle = openWindow(urlname, "dialogwin", attributes);
}

function loadIframe(iframename, filetoload)
{
  window.frames[iframename].location.href = filetoload;
}

//A function for writing the entire front end document as an HTML string, using document.write

function writeFrontEnd(apptitle, authors, description, demofile)
{
  //String of HTML code to write
  var fe = "";
  //fe+='<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=4">'
  fe += '</HEAD>';
  fe += '<BODY onLoad="initPanels(1);translateHTML(document);" onUnload="closeWindows();" onBeforeUnload="closeWindows();">';
  //The first works in Netscape; the second in IE 6
  fe += '<div id="mainDiv">'; //wrapper for the entire application
  fe += '<div id="menuDiv">'; //wrapper for the menu
  fe += '<div id="menuDivInner">';
  fe += '&nbsp;&nbsp;';
  fe += ExpColl+d; //the expand/collapse items and the menu object
  fe += '</div>'; //end of menuDivInner
  fe += '</div>'; //end of menuDiv
  fe += '<div id="appDiv" >'
  //fe+='<div id="appDivInner" style="float: left; top:0;">'
  fe += '<div id="appDivInner">'

  //fe+='<div id="tabDiv" name="tabDiv" style="float:left; top:0px; height:27px;">';
  fe += '<div id="tabDiv" name="tabDiv" style="top:0px; height:27px;">';
 // fe += '<button id="toMenu" style="top:0px;height:25px;">Menu</button>'
 if (currConfig()=="smartphone")
  {  //Back to menu button if in smartphone mode
  fe += '<div id="tab0" style="color:blue;background-color:white;" class ="tab" onClick= "location.href=&#039;../menu/OE_Menu.htm&#039;">'
  fe += t('Menu')
  fe += '</div>'
  }
  fe += '<div id="tab1" class="tab" onClick = "showPanel(1);" onMouseOver="hover(this);" onMouseOut="setState(1)">'
  fe += t('Start')
  fe += '</div>'
  fe += '<div id="tab2" class="tab"'+'onClick = "useOpenEpiEntry();showPanel(2);" onMouseOver="hover(this);" onMouseOut="setState(2);">'
  fe += t('Enter')
  fe += '</div>'
  fe += '<div id="tab3" class="tab" onClick = "callStatsIf(); showPanel(3);" onMouseOver="hover(this);" onMouseOut="setState(3);">'
  fe += t('Results')
  fe += '</div>'
  fe += '<div id="tab4" class="tab" onClick = "showExWindow();showPanel(4);" onMouseOver="hover(this);" onMouseOut="setState(4)">'
 // fe += '<div id="tab4" class="tab" onClick = "showPanel(4);showExWindow();" onMouseOver="hover(this);" onMouseOut="setState(4)">'
  //fe += '<div id="tab4" class="tab" onClick = "showExWindow();" onMouseOver="hover(this);" onMouseOut="setState(4)">'
  fe += t('Examples')
  fe += '</div>'
  fe += '<div id="tab5" class="tab" onClick = "location.href=&#39;../briefDoc/UsingOpenEpi.htm&#39;" onMouseOver="hover(this);" onMouseOut="setState(5)">'
 // fe += '<div id="tab5" class="tab" onClick = "showPanel(5);" onMouseOver="hover(this);" onMouseOut="setState(5)">'
  fe += t("Help");
  fe += '</div>'
  fe += '</div>'; //end of tabDiv


  fe += '<div id="panel1" class="panel">'

  fe += '<table width="100%" position:relative; border="0" cellspacing="0" cellpadding="0" bgcolor="#CCCCCC">';
  fe += '  <tr color="#FFFFFF">';

  //fe+='<div id="banner" style="background-color:#EEEEEE; color:#FFFFFF;">'
  fe += '<td align="center" width="43%"  bgcolor="#EEEEEE"><span style="color:black">'
  fe += '<strong>'+t("Open Source Statistics for Public Health");
  fe += '</strong></span></td>';
  fe += '<td align="center" width="15%" bgcolor="#EEEEEE"><a href="'+ docfile +'" target="Documentation">'+t('Documentation')+'</a></td>'
  fe += '<td align="center" width="15%" bgcolor="#EEEEEE"><a href="'+ testfile +'" target="Testing">'+t('Testing')+'</a></td>'
  fe += '<td align="center" width="15%" bgcolor="#EEEEEE"><a href="../BriefDoc/About.htm" target="_blank">'+t('About')+'</a></td>'
  fe += '<td align="center" width="15%" bgcolor="#EEEEEE"><a href="../BriefDoc/UsingOpenEpi.htm" target="_blank">'+t('Help')+'</a></td>'
  fe += '  </tr>';
  fe += '  </table>';
  //fe+='</div>'

  fe += '<div id="Panel1Col1" class="column">';
  fe += '<input style="margin-bottom:5px;margin-top:5px;" name="btnEnter" type="button" id="btnEnter" value="'+t("Enter New Data")+'" onClick="useOpenEpiEntry();showPanel(2);return false"';
  fe += '      style="text-align:center; background-color:#800000; color:white; font-family:arial; font-weight:bold; font-size:14pt;">';
  if (inscreenimg.length>0)
  {
    fe += '<br/><image name="inputscreen" width="80%" alt="Input screen image"  src="'+inscreenimg+'" border="0">'
  }

  fe += '<div class="colHeading">'
  fe += t('Author(s)');
  fe += '  </div>'; //end of colHeading
  fe += t(authors);
  fe += '  </div>'; //end of Panel1Col1
  fe += '<div id="Panel1Col2" class="column">';
  fe += '<div class="colHeading">'
  fe += t(apptitle); // for example,     Proportion<br>Confidence Limits for a Single Proportion
  fe += '</div>'; //end of colHeading
  fe += t(description);
  if (outscreenimg.length>0)
  {
    fe += '<div id="outimg" style="text-align:center;"><p></p><image id="outputscreen" name="outputscreen" alt="Output screen image"  width="80%"  src="'+outscreenimg+'"  border="1"></p></div>'
  }
  /*
 if ((demofile.length>0) && (currConfig()!="smartphone"))
   {
     fe+='<table width=100% border="0" cellspacing="0" cellpadding="0">'
     fe+='<tr>'
  fe+='<iframe name="demoframe" id="demoframe"  src=demofile class="panel" APPLICATION="yes"></iframe>'
     fe+='<td  border="0" cellpadding="0" style="text-align:center">'
     fe+='<input name="btnDemo" type="button" id="btnDemo" value="'+t("Load Demo Data")+'" onClick=\"javascript:LoadData=true;loadIframe(\'demoframe\', \''+demofile+'\');\" '

  fe+='style="text-align:center; background-color:#666666; color:white; font-family:arial; font-weight:bold; font-size:14pt;">'
     fe+='</td>'
     fe+='</tr>'
     fe+='</table>'
   }
   */
  fe += '  </div>'; //end of Panel1Col2

  fe += '<div id="FooterPanel1">'
  if (oesavefound())
  {
    fe += t('Running from OpenEpiSave.HTA. Results will be saved automatically in ..\RESULTS folder');
  }
  else
  {
    fe += t('Select, copy, and paste results to other programs or print from browser with Ctrl-P.');
  }
  fe += '</div>'; //end of FooterPanel1

  fe += '</div>'; //End of the panel1 div.
  fe += '<div id="panel2" name="panel2" class="panel" ></div>';
  //alert("703 of ah") ;
  var phr100 = t("No results yet. ENTER some data and choose CALCULATE.");
  fe += '<div id="panel3" class="panel"><h2 align="left"><br/><br/>'+phr100+'</h2></div>';
  var phr101 = t("It looks like there are no examples for this exercise.");
  fe += '<div id="panel4" class="panel"><div id="NoExampleMsg"><h2>'+phr101+'</h2></div></div>';
  fe += '<div id="panel5" class = "panel"></div>';
  fe += '</div>' //end of appDivInner
  fe += '</div>' //end of appDiv
  fe += '</div>' //end of mainDiv
  fe += '</body>';
  fe += '</html>';
  //console.log( "All of fe at 749\n"+fe);

  document.write(fe);


  document.close();
}


function showExWindow()
{
  var fe = '<html>'
  fe += '<head>'
  fe += '<title>Untitled Document</title>'
  fe += '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'

  fe += '</head>'
  fe += '<body  bgcolor="#FFFFFF" text="#336666" link="#009999" vlink="#66CCCC" alink="#00FFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="translateHTML();">'
  fe += '<table width="90%" border="0" cellspacing="0" cellpadding="4">'
  fe += '<tr>'
  fe += '<td rowspan="2" bgcolor="#336666">'
  if (currConfig() != "smartphone")
  {
    //include the logo
    fe += '<img src="../img/OpenEpi1.gif" name="image" width="184px" height="51px"></td>'
  }
  fe += '<td width="100%" bgcolor="#336666"><font color="#eeeeee"><h1>'
  fe += 'Demos and Exercises'
  fe += '</h1> </font></td>'
  fe += '</tr>'
  fe += '</table>'
  fe += '<br>'
  if (currConfig() != "smartphone")
  {
    fe += '<table width="90%" border="0" cellspacing="4" cellpadding="2" align="center">'
  }
  else
  {
    //align table left for smartphone
    fe += '<table width="90%" border="0" cellspacing="4" cellpadding="2" align="left">'
  }
  fe += '<tr valign="middle">'
  fe += '<td bgcolor="#CCCCCC">      <h2>'
  fe += basefilename+'--Demo'
  fe += '</h2></td>'

  if (currConfig() != "smartphone")
  {
    fe += '<td width="150px" align="center" rowspan="2"> <img src="'+inscreenimg+'" name="image" width="350" height="204" border="0"><br>'
    fe += '</td>'
  }
  fe += '</tr>';

  if (Demo!=null)
  {
    fe += '<tr>'
    fe += '<td>'

    //fe+=t(Demo)  //Aug 2007
    fe += Demo
    fe += '</td>'
    fe += '</tr>'
  }

  if (Exercises!=null)
  {
    fe += '<tr>'
    fe += '<td bgcolor="#CCCCCC" colspan="2" align="center"> <h2>'+ t("More Exercises")+ '</h2></td>'
    fe += '</tr>'
    fe += '<tr>'
    fe += '<td valign="top" colspan="2"><br>'
    //fe+= t(Exercises)    //Aug 2007
    fe += Exercises
    fe += '</td>'
    fe += '</tr>'
  }
  fe += '<tr>'
  fe += '<td align="center" width="100" colspan="2">&nbsp;'
  fe += '</td>'
  fe += '</tr>'
  fe += '</table>'
  //'<table width="90%" border="0" cellspacing="0" cellpadding="4px" align="center">'+
  //  '<tr align="center">'+
  //'<td><a href="#">&lt;&lt; Previous</a>'+
  //  '&#149; <a href="#">Next &gt;&gt;</a></td>'+
  //  '</tr>'+
  //'</table>'+
  fe += '<p>&nbsp;</p>'
  fe += '<table width="96%" border="0" cellspacing="0" cellpadding="2px" bgcolor="#CCCCCC">'
  fe += '<tr> '
  fe += '<td>&nbsp; </td>'
  fe += '<td align="right">&nbsp;</td>'
  fe += '</tr>'
  fe += '</table>'
  fe += '</body>'
  fe += '</html>';

  var resultpane = document.getElementById("panel4");

  resultpane.innerHTML = fe;
 // translateHTML(resultpane.body); //August 2007
  //var theMenu=document.getElementById("menuDivInner");
  //translateHTML(theMenu);
  //htmlstr=completedHTML(htmlstr,omitfooter); //Adds HTML tags and header if necessary

  showPanel(4); //Open the results panel



  //end of AppHelper.js
}