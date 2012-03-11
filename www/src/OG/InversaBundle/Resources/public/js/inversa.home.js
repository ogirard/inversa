/**
 * JavaScript code for home animation
 */
 
 var texts = ['panflutetext', 'violintext', 'flutetext', 'organtext', 'ensembleinversatext'];
 
 var panfluteimages = ['panfluteimage1', 'panfluteimage2', 'panfluteimage3'];
 var violinimages = ['violinimage1', 'violinimage2'];
 var fluteimages = ['fluteimage1', 'fluteimage2'];
 var organimages = ['organimage1', 'organimage2'];
 
 OnStartup = StartHomeAnimation;
 
 function ResetHome() {
	 $('#mainMenu').removeClass('defaultmenu');
	 $('#mainMenu').addClass('homemenu');
	 
	 // hide text & images
	 HideItems(texts);
	 HideItems(panfluteimages);
	 HideItems(violinimages);
	 HideItems(fluteimages);
	 HideItems(organimages); 	 

	 // set image positions
	 SetLeft('panfluteimage2', 153); // target:  71px
 	 SetLeft('violinimage2', 652); // target:  724px
	 SetLeft('fluteimage2', 385); // target:  479px
	 SetLeft('organimage1', 553); // target:  469px
	 
	 // move out text
	 MoveLeftOut('violintext'); // target: 793px
	 MoveLeftOut('organtext'); // target: 202px
	 MoveRightOut('panflutetext'); // target: 0px
	 MoveRightOut('flutetext'); // target: 202px
 }
 
 function StartHomeAnimation() {
	 ResetHome();
	 
	 // fade and slide in images
	 FadeInItems(panfluteimages);
	 FadeInItems(violinimages);
	 FadeInItems(fluteimages);
	 FadeInItems(organimages);
	 SlideHorizontally('panfluteimage2', 71);
 	 SlideHorizontally('violinimage2', 724);
 	 SlideHorizontally('fluteimage2', 479);
 	 SlideHorizontally('organimage1', 469);
	 
	 // fade slide in texts (after 2s)
	 DelayItems(texts, 2000);
	 SlideTextHorizontally('violintext', 793);
	 SlideTextHorizontally('organtext', 202);
	 SlideTextHorizontally('panflutetext', 0);
	 SlideTextHorizontally('flutetext', 202);
	 
	 // fade in center text (after 3.5s)
     $('#ensembleinversatext').delay(3500).fadeIn(1500);
 }
 
 function HideItems(ids) {
 	 $.each(ids, function(i, id) { $('#' + id).hide(); });	 	
 }
 
 function FadeInItems(ids) {
 	 $.each(ids, function(i, id) { $('#' + id).fadeIn(1500); });	 	
 }
 
 function DelayItems(ids, d) {
 	 $.each(ids, function(i, id) { $('#' + id).delay(d); });	 	
 }
 
 function SlideHorizontally(id, to) {
	 $('#' + id).delay(GetRandom(0,500)).animate({
	   left: to + 'px'
	 }, GetRandom(1000,2500));
 }
 
 function SlideTextHorizontally(id, to) {
	 $('#' + id).delay(GetRandom(0,500)).fadeIn(GetRandom(250,1000)).animate({
	   left: to + 'px'
	 }, GetRandom(1000,2500));
 }
  
 function SetLeft(id, left) {
	 $('#' + id).css('left', left + 'px'); 
 }
 
 function MoveLeftOut(id) {
	 $('#' + id).css('left', '-1000px'); 
 }
 
 function MoveRightOut(id) {
	 $('#' + id).css('left', $(document).width() + 'px'); 
 }

 
 