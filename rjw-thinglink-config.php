<div class="wrap">
	<?php 
    if ($_GET['settings-updated']) { 
  ?>
		<div id="message" class="updated fade" style="margin: 15px 0 10px;"><p>Your settings have been <strong>saved</strong>.</p></div>
  <?php
   } 
  ?>

  <h2><?php echo esc_html($plugin_name) ?></h2>

  <form method="post" action="options.php" id="tl-setting-form">
    <?php settings_fields( 'rjw-thinglink-group' ); ?>
    <?php do_settings_sections( 'rjw-thinglink-group' ); ?>

    <div id="login_notification" style="margin: 20px; border: 2px solid black;width: 320px;padding:10px; text-align:center;">
        For using ThingLink plugin you need to specify your ThingLink ID. <br/><br/>
    	Log on to <a href="http://www.thinglink.com" target="_blank">ThingLink</a>, visit this Settings page again and copy-paste the
        detected ID to the Settings field below.
    </div>
   
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><b>Your ThingLink ID:</b></th>
            <td><input type="text" id="thinglink_id_input" name="thinglink_id" value="<?php echo esc_attr(get_option('thinglink_id')); ?>" style="width:150px;"/></td>
        </tr>
    </table>
    
    <p class="submit">
      <input type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
    </p>
    
    <div id="save-reminder" style="margin: 20px; border: 2px solid black;width: 320px;padding:10px; text-align:center;">
		  Your ThingLink Id has changed. Please save changes by clicking 'Save Changes' button above.
    </div>
  </form>
   
   <script type="text/javascript">
    function showReminder() { 
      jQuery( '#save-reminder' ).toggle( jQuery( '#thinglink_id_input' ).val() != '<?php echo wp_json_encode( esc_html( get_option( 'thinglink_id' ) ) ); ?>' ); 
    }
    jQuery( '#thinglink_id_input' ).change( showReminder );
    function prefill( obj ) {
      if ( obj[ "name" ] && jQuery( '#thinglink_id_input' ).val() == "") {
        jQuery( '#thinglink_id_input' ).val( obj[ "embedCode" ] );
        jQuery( '#tl-setting-form' ).submit();
	   }

     if ( obj[ "name" ] ) {
      var text = 'You\'re currently logged on to <a href="http://www.thinglink.com" target="_blank">ThingLink</a> as <b>' + obj["name" ] + "</b> with ThingLink ID <b>" + obj[ "embedCode" ]+ "</b>.<br/><br/>" + "If it is your ThingLink account for this website, make sure the Setting field below has the same value.";
      var html = jQuery.parseHTML( text );
      jQuery( "#login_notification" ).empty().append( html );
	   }
	   
	   if( obj[ "error" ] && jQuery( '#thinglink_id_input' ).val() == "") {
      var text = 'You are currently not logged in to <a href="http://www.thinglink.com" target="_blank">ThingLink</a>. Please <a href="http://www.thinglink.com" target="_blank">log in</a> first and then <a href="javascript:location.reload(true)">refresh</a> this page. Alternatively enter you ThingLink Id below and click \'Save Changes\'.';
      var html = jQuery.parseHTML( text );
      jQuery( "#login_notification" ).empty().append( html );
	   }
   }
   </script>

   <script type="text/javascript" src="http://www.thinglink.com/api/me?callback=prefill" ></script>
   <script type="text/javascript">
	   showReminder();
   </script>
   
</div>