
// for Google Analytics
var _gaq = _gaq || [];


!function(definition) {
 	window.bgUI = definition(jQuery);
}(function($) {
		   
	var   HOST
		, isHosted
		, BASE_URL
		, isCUSTOM_PAGE
		, CUSTOM_URL
		, IMAGES_URL
		, JSON = $('html').data('json')
		, activateGoogleAnalytics = false
		;
	
	
	// this is the public object that is exposed by bgUI
	var pub = {
		
			host 			: null,
			baseUrl 		: null,
			
			googleEvent : function(eventArray) {
				if ( isHosted && activateGoogleAnalytics ) _gaq.push(eventArray);
			},
			
			jsonRequest : function(requestObj) {
			},
			
			showBusy : function() { },
			
			hideBusy : function() { },
			
			theEnd : null
	}
	
	// domReady wrapper
	function onDomReady(fn) { $(fn); }
	
	
	/***********************   INITIALIZATION  *************************/
	onDomReady(function() {
						
		var   $menuTopics = $('ul#menuTopics')
			, $levelOne = $menuTopics.find('>li')
			, json = $('html').data('json')
			;
								
		HOST = pub.host = json.host;
		isHosted = pub.isHosted = json.isHosted;
		BASE_URL = pub.baseUrl = json.baseUrl;
		activateGoogleAnalytics  = json.activateGoogleAnalytics;
				
		pub.googleEvent(['_setAccount',json.googleAnalyticsId]);
		pub.googleEvent(['_trackPageview']);
		
		
		// bind events to the menu bar for dropdown menus
		$levelOne.hover(
				function() {
					$menuTopics.find('>li[active]').removeAttr('active')
					$(this).attr('active','active')
					$menuTopics.find('ul').hide()
					$(this).find('ul').show()
					},
				function() {
					$(this).removeAttr('active')
					$(this).find('ul').hide()
		})
		
		
	})
	
		
	return pub;
})
