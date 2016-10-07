<?php
 if ( isset( $_POST['submit'] ) ){// if submit is sett
	
	// user feedback
	echo '<div id="message" class="notice error is-dismissible" style="background-color:#FFE2C1;"><p>Ok Sparky Almost there <strong>Add Some Code </strong> to this Form.</p></div>';

}//end  if submit is sett	
 //------------  THE FORM   ------------
			echo '<div id="frmwrap" >';
			echo '<form action="" method="POST"	enctype="multipart/form-data">';

			//Plugin Name
			echo qufield_input('text','* Plugin Name', 'PluginNAME', 'MY WP PLugin');
			
			//Description:
			echo qufield_input('text','Plugin Description', 'pluginDESCRIPTION', 'Enter Plugin Description');
			
			// TAGS
			echo qufield_input('text','Tags', 'TAGS', 'Helps when people search online, separate with commas');

			// NONCE
			wp_nonce_field( 'wppqst_action', 'wppqst_nonce', 'ref-from' , 'the_admin');
			

			//SUBMIT
			echo get_submit_button('Save');
			echo '</form></div>';	
