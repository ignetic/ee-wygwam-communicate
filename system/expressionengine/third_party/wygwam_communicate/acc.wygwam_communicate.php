<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * Wygwam Communicate Accessory
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Module
 * @author		Simon Andersohn
 * @copyright 	Copyright (c) 2013 Simon Andersohn
 */

// ------------------------------------------------------------------------


class Wygwam_communicate_acc
{
	var $name		= 'Wygwam Communicate';
	var $id			= 'wygwam_communicate';
	var $version		= '1.0';
	var $description	= 'Enable WYSIWYG Editing in Communicate using Wygwam';
	var $sections		= array();
 	
	
	function __construct()
	{
		$this->EE =& get_instance();
		
		// variables
		$this->base 			= BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->id;
		$this->wigwam_base		= URL_THIRD_THEMES.'wygwam/';
	}
	

	function set_sections()
	{

		if ($this->EE->input->get('C') == "tools_communicate") {	

			// add jQuery to control panel head
			//$this->EE->cp->add_to_head('<link type="text/css" href="'.$this->wigwam_base.'styles/wygwam.css" rel="stylesheet" />');
			$this->EE->cp->add_to_foot('<script src="'.$this->wigwam_base.'lib/ckeditor/ckeditor.js"></script>');

			$this->EE->cp->add_to_foot('
				<script type="text/javascript">
				
					function createEditor(id) {
						var skin = "wygwam3";
						if (parseInt(CKEDITOR.version) < 4) {
							skin = "wygwam2";
						}
						return CKEDITOR.replace( id, {
							toolbar: "Full",
							//uiColor: "#e2e2e2",
							height: 400,
							allowedContent: true,
							skin: skin,
						});
						
					}
				
					$(document).ready(function() {
						var instance = createEditor("message");
						$("select.#mailtype").val("html");
						$("#plaintext_alt_cont").show();
						
						$("select.#mailtype").on("change", function() {
							if ($(this).val() == "html") {
								instance = createEditor("message");
							} else if (instance) {
								instance.destroy();
							}
						});
					});
					
				</script>
			');
				
		}
		
		
		// Hide Accessory Tab
		$script = "$('#accessoryTabs .{$this->id}').parent('li').hide();";
		
		$this->sections["
			<script type='text/javascript'>
			  //<![CDATA[
			  {$script}
			  //]]>
			</script>
		"] = '';
		
				
	}
	
	function update()
	{
		return TRUE;
	}
}