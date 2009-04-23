<?php
/*
Plugin Name: iRedlof Link Checker
Plugin URI: http://iredlof.com/2009/04/iredlof-link-checker/
Description: Being a Blogger, you always have to exchange links with other sites and very often have to purchase links from other pages also.In a long term link building process you have to build tens of thousands of links. Do you ever spend time to check whether all your old links which you purchased are still there or not.There are very high chances that the other webmaster may have dropped your link after collecting the payments. It is also a very time consuming process to check back links daily and practically impossible.Well what if your wordpress could maintain a list of back links to your site and check them daily. iRedlof Link Scanner plugin is what it is build for.
Author: Rohit LalChandani
Version: 1.0
Author URI: http://iredlof.com
*/

if (!class_exists("iRedlofLinkChecker")) 
{
	class iRedlofLinkChecker
	{
		var $adminOptionsName = "iRedlofLinkCheckerAdminOptions";
		
		function iRedlofLinkChecker()
		{
		}
		
		function init() 
		{
			$this->getAdminOptions();
		}
			
		function getAdminOptions() 
		{
			$LinkCheckerAdminOptions = array('otherlinks' => 'http://www.indiaprab.blogspot.com/2009/03/link-exchange-directory-submit-your.html, http://www.currentposts.blogspot.com, http://www.yahoo.com, http://www.google.com',
				'mylink' => 'iredlof.com');
			$LinkCheckerOptions = get_option($this->adminOptionsName);
			if (!empty($LinkCheckerOptions)) {
				foreach ($LinkCheckerOptions as $key => $option)
					$LinkCheckerAdminOptions[$key] = $option;
			}
			update_option($this->adminOptionsName, $LinkCheckerAdminOptions);
			return $LinkCheckerAdminOptions;
		}
		
		//Prints out the admin page
		function printAdminPage() 
		{
					$LinkCheckerOptions = $this->getAdminOptions();
										
					if (isset($_POST['update_LinkCheckerSettings'])) { 
						if (isset($_POST['link_others'])) {
							$LinkCheckerOptions['otherlinks'] = $_POST['link_others'];
						}
						if (isset($_POST['link_mylink'])) {
							$LinkCheckerOptions['mylink'] = $_POST['link_mylink'];
						}
						update_option($this->adminOptionsName, $LinkCheckerOptions);
						
						?>
<div class="updated"><p><strong><?php _e("Settings Updated.", "iRedlofLinkChecker");?></strong></p></div>
					<?php
					} 
					?>
<div class=wrap><h2>iRedlof Link Checker</h2><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
" />
If you like this plugin then please do not hesitate to donate. <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" style="vertical-align:middle;" />
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
</form>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h4>Your website link to check in other websites link page. (Eg: iredlof.com))</h4><h5><span style="color:RED;">NOTE :</span> DO NOT include <i>http://www</i> in your web addresses below else it will give <span style="color:RED;">ERRORS or INAPPROPRIATE RESULTS</span>.</h5>
<input type="text" name="link_mylink" id="link_mylink" style="width: 80%;" value="<?php _e(apply_filters('format_to_edit',$LinkCheckerOptions['mylink']), 'iRedlofLinkChecker') ?>" /><br/><br/><br/>
<h4>Add other websites link page URL(s) to check your above link into (seperated by comma[,]).</h4><h5><span style="color:RED;">NOTE :</span> Don't forget to include <i>http://www</i> in your web addresses below else it will give <span style="color:RED;">ERRORS.</span></h5>
<textarea name="link_others" id="link_others" style="width: 80%; height: 100px;"><?php 
$iredlof_links="";
if($LinkCheckerOptions['otherlinks']=="") echo($iredlof_links); else  _e(apply_filters('format_to_edit',$LinkCheckerOptions['otherlinks']), 'iRedlofLinkChecker') ?></textarea>
<div class="submit">
<input type="submit" name="update_LinkCheckerSettings" value="<?php _e('Update Settings', 'iRedlofLinkChecker') ?>" /></div>
<input type="hidden" name="wAddress" id="wAddress" value="<?php _e(get_bloginfo('siteurl'), 'iRedlofLinkChecker'); ?>" />
</form>
<hr />
<div class=wrap id="link_status"><b>Status:</b> Click check links button to check your links. </div>
<div class="submit"><input type="button" onclick="javascript:iRedlofCheckLinks();" value="Check Links" /></div>
 </div>
 <div class=wrap><h4>Help Section</h4><hr /><b>Note:</b>Follow above given rules strictly as ignoring them can leave you with inappropriate results or errors.<br/><br/><b>Q1.</b> What is iRedlof Link Checker ?<br/><b>A1.</b> Being a Blogger, you always have to exchange links with other sites and very often have to purchase links from other pages also.<br/>In a long term link building process you have to build tens of thousands of links. Do you ever spend time to check whether all your old links which you purchased are still there or not.<br/>There are very high chances that the other webmaster may have dropped your link after collecting the payments. It is also a very time consuming process to check back links daily and practically impossible.<br/>Well what if your wordpress could maintain a list of back links to your site and check them daily. iRedlof Link Scanner plugin is what it is build for.<br /><br/><b>Q2.</b> How to use iRedlof Link Checker ?<br/><b>A2.</b> It is very simple to use this plugin, all you have to do is key in your own domain name in field 1 on the top and also key in other sites link pages seprated by comma(,) in field 2 where they put your exchanged link of field 1, Thats all, Now all you have to do is HIT Check Links Button and check whether your exchanged link is still up on those websites.
</div>
<br/><br/>
					<?php
		}//End function printAdminPage()
	}//End Class iRedlofLinkChecker
}

if (class_exists("iRedlofLinkChecker")) {
	$dl_pluginSeries = new iRedlofLinkChecker();
}

//Initialize the admin panel
if (!function_exists("iRedlofLinkChecker_ap")) {
	function iRedlofLinkChecker_ap() {
		global $dl_pluginSeries;
		if (!isset($dl_pluginSeries)) {
			return;
		}
		if (function_exists('add_links_page')) {
	add_links_page('iRedlof Link Checker', 'iRedlof Link Checker', 9, basename(__FILE__), array(&$dl_pluginSeries, 'printAdminPage'));
		}
	}	
}

if (isset($dl_pluginSeries)) {
	//Actions
	add_action('admin_menu', 'iRedlofLinkChecker_ap');
	add_action('link_checker/link_checker.php',  array(&$dl_pluginSeries, 'init'));
	add_action('admin_footer', 'linkCheckerSupportFiles');
}

function linkCheckerSupportFiles()
{
	echo '<script type="text/javascript" src="'.get_bloginfo('siteurl')."/".PLUGINDIR."/".dirname(plugin_basename(__FILE__)).'/js/link_checker.js"></script>'."\n";
}

?>