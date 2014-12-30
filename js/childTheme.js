/**
 * File Name childTheme.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.0
 * @updated 03.14.14
 **/
// ######################################################################


/**
 * childTheme
 * @version 2.0
 * @updated 03.14.14
 **/
var childTheme = {
	
	
	/**
	 * init
	 * @version 2.0
	 * @updated 03.14.14
	 **/
	init : function() {
		
		// this.setParams();
		
		this.mbpScaleFix();
		
	} // end init : function
	
	
	
	/**
	 * mbpScaleFix
	 * @version 2.0
	 * @updated 03.14.14
	 **/
	,mbpScaleFix : function() {
		
		if ( typeof MBP !== 'undefined' ) {
			MBP.scaleFix();
		}
		
	} // end mbpScaleFix : function
	
	
	
	// ##################################################
	/**
	 * Setters
	 **/
	// ##################################################
	
	
	
	/**
	 * setParams
	 * 
	 * version 1.0
	 * updated 00.00.13
	 **/
	,setParams : function() {
		
		
		
	}  // end setParams : function
	
	
	
}; // end var childTheme






/**
 * jQuery
 **/
jQuery(document).ready(function() {
	
	childTheme.init();
	
});