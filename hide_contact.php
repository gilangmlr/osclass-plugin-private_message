<script>
  var content = "<h2><?php _e("Chat publisher"); ?></h2>";
  <?php
  if( osc_item_is_expired () ) {
  ?>
    content += '<p>' +
          "<?php _e("The listing is expired. You can't chat the publisher."); ?>" +
      '</p>';
  <?php
  } else if( !osc_is_web_user_logged_in() ) {
  ?>
    content += '<p>' +
          '<?php _e("You must log in or register a new account in order to chat the advertiser"); ?>' +
      '</p>' +
      '<p class="contact_button">' +
          '<strong><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login'); ?></a></strong>' + ' or ' +
          '<strong><a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account'); ?></a></strong>' +
      '</p>';
  <?php
  } else {
  ?>
    <?php
    $message_room = PMModel::newInstance()->getUserMessageRoomByItemId(osc_item_id());
    if ($message_room['e_item_status'] === 'for-sale') {
      $item_status = '';
    } else if ($message_room['e_item_status'] === 'reserved') {
      $item_status = 'Reserved';
    } else if ($message_room['e_item_status'] === 'sold') {
      $item_status = 'Sold';
    }

    if( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) {
    ?>
      var redirectLocation = '<?php echo osc_route_url('private-message-list', array('item_id' => osc_item_id())); ?>';
      content += '<button id="chatWithSeller" onClick="window.location.href='+"'"+redirectLocation+"'"+'"><?php echo $item_status; ?> - View Chats</button>';
    <?php
    } else {
    ?>
      <?php
      if(!isset($message_room['pk_i_message_room_id'])) {
        $redirectUrl = osc_route_url('private-message-start', array('item_id' => osc_item_id()));
      } else {
        $message_room_id = $message_room['pk_i_message_room_id'];
        $redirectUrl = osc_route_url('private-message', array('message_room_id' => $message_room_id));
      }
      ?>
      <?php
      if ($item_status === '') {
      ?>
        var redirectLocation = '<?php echo $redirectUrl; ?>';
        content += '<button id="chatWithSeller" onClick="window.location.href='+"'"+redirectLocation+"'"+'">Chat with Seller</button>';
      <?php
      } else {
      ?>
        content += '<button style="background-color: grey;" disabled><?php echo $item_status; ?></button>';
      <?php
      }
      ?>
    <?php
    }
    ?>
  <?php
  }
  ?>
  $('#contact').html(content);

  <?php if( osc_users_enabled() && osc_is_web_user_logged_in() ) { ?>
    $('#header .nav li:nth-child(1)').before($('<li style="margin-right: 16px;"><a href="<?php echo osc_route_url('private-message-list', array('item_id' => null)); ?>">Private Message</a></li>'));
  <?php } ?>
</script>
