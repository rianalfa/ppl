var expand='Expand All';
var collapse='Collapse';
if (typeof(t)=="function")
   {
   expand=t(expand);
   collapse=t(collapse);
   }
var ExpColl = '<a href="javascript: d.openAll();">'
ExpColl += expand +'</a> &#124; <a href="javascript: d.closeAll();">' + collapse +'</a><br />'

d = new dTree('d');
d.config.target="blank";
//Default target for display of URLs is main window of menu
//To override this and pop up a separate window, specify the window/target name as the
//sixth parameter in the d.add parameters, as in some of the Net Links below

d.add(0,-1,'Home','../Menu/OE_Menu.htm');
d.add(1,0,'Info and Help');
    d.add(2,1,'About OpenEpi','../BriefDoc/About.htm');
	d.add(3,1,'News','../BriefDoc/news.htm');
	d.add(4,1,'Choosing a method', '../Search/Choosing.htm');
	d.add(5,1,'Using OpenEpi', '../BriefDoc/UsingOpenEpi.htm');
	d.add(6,1,'Credits', '../BriefDoc/Credits.htm');
	d.add(7,1,'Licensing/Disclaimer', '../BriefDoc/Licensing.htm');
	d.add(9,1,'History','../BriefDoc/History.htm');
d.add(100,0,'Language/Options/Settings', '../settings/Settings.htm','','','../img/globe.gif');
d.add(11,0,'Calculator','../Calculator/calculator.htm');
//d.add(102,0,'Nutrition Stats','','','','','',true);
//d.add(103,102,'Body Size','../BodySize/BodySize.htm');
d.add(12,0,'Counts','','','','','',true);
	d.add(13,12,'Std.Mort.Ratio','../SMR/SMR.htm');
	d.add(14,12,'Proportion','../Proportion/Proportion.htm');
	d.add(15,12,'Two by Two Table','../TwobyTwo/TwobyTwo.htm');
	d.add(16,12,'Dose-Response','../DoseResponse/DoseResponse.htm');
	d.add(17,12,'R by C Table','../RbyC/RbyC.htm');
    d.add(18,12,'Matched Case Control','../MatchCC/MatchCC.htm');
	d.add(19,12,'Screening', '../DiagnosticTest/DiagnosticTest.htm');
d.add(20,0,'Person Time','','','','','',true)
	d.add(21,20,'1 Rate','../PersonTime1/PersonTime1.htm');
	d.add(22,20,'Compare 2 Rates','../PersonTime2/PersonTime2.htm');
d.add(24,0,'Continuous Variables','','','','','',true);
	d.add(25,24,'Mean CI','../Mean/CIMean.htm');
	d.add(26,24,'Median/%ile CI','../Median/CIMedian.htm');
	d.add(27,24,'t test','../Mean/t_testMean.htm');
	d.add(28,24,'ANOVA','../Mean/ANOVA.htm');
d.add(30,0,'Sample Size','','','','','',false);    //collapsed
	d.add(31,30,'Proportion','../SampleSize/SSPropor.htm');
	d.add(32,30,'Unmatched CC','../SampleSize/SSCC.htm');
	d.add(33,30,'Cohort/RCT','../SampleSize/SSCohort.htm');
	d.add(34,30,'Mean Difference','../SampleSize/SSMean.htm');
d.add(35,0,'Power','','','','','',false);   //collapsed
	d.add(2,35,'Unmatched CC','../Power/PowerCC.htm');
	d.add(3,35,'Cohort','../Power/PowerCohort.htm');
	d.add(4,35,'Clinical Trial','../Power/PowerRCT.htm');
	d.add(5,35,'X-Sectional','../Power/PowerCross.htm');
	d.add(6,35,'Mean Difference','../Power/PowerMean.htm');
d.add(50,0,'Random numbers','../Random/Random.htm');
d.add(110,0,'Searches','','','','','',true);
    d.add(111,110,'Google--Internet','http://www.google.com');
	d.add(112,110,'PubMed--MEDLARS','http://www.pubmed.gov');
d.add(200,0,'Internet Links','../Links/Links.htm');
d.add(115,0,'Download OpenEpi','../Downloads/Downloads.htm');
d.add(45,0,'Development');
	d.add(46,45,'Proposal', '../Documentation/Proposal2.htm');
	d.add(47,45,'Toolkit Description','../Documentation/ToolkitDoc.htm');
	//d.add(48,45,'Toolkit Example','../Toolkit/Proportion.htm');
	d.add(49,45,'Translations','../Documentation/Translation.htm');
	d.add(50,45,'JavaScript Tips','../Documentation/JavaScriptTips.htm');

	  //	document.write(ExpColl+ d);

