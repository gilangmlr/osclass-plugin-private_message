<?php
  if (!osc_is_web_user_logged_in()) {
    _e("You must log in or register a new account in order to chat the advertiser");
?>
  <p class="contact_button">
    <strong><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login'); ?></a></strong> or <strong><a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account'); ?></a></strong>
  </p>
<?php
    return;
  }

  $item = Item::newInstance()->findByPrimaryKey(intval(Params::getParam('item_id')));
  View::newInstance()->_exportVariableToView('item', $item);

  if(osc_item_user_id() !== osc_logged_user_id() && intval(Params::getParam('item_id'))) {
    _e("This is not your listing item!");
    return;
  }

  if (intval(Params::getParam('item_id'))) {
    $message_rooms = PMModel::newInstance()->getUserMessageRoomsByItemId(intval(Params::getParam('item_id')));
  } else {
    $message_rooms = PMModel::newInstance()->getUserMessageRooms();
  }
?>
<style>
  .message-room {
    margin: 2px;
    padding: 8px;
    border-radius: 4px;
    background-color: rgb(228, 228, 228);
  }
</style>

    <?php
      if (intval(Params::getParam('item_id'))) {
    ?>
      <div style="margin: 2px; padding: 8px;">
        <a href="<?php echo osc_route_url('private-message-list', array('item_id' => null)); ?>">All items</a>
      </div>
    <?php
      }
    ?>

<?php
  foreach ($message_rooms as $key => $message_room) {
?>
  <div class="message-room">
    <div><?php
      if (intval(Params::getParam('item_id')) <= 0) {
        echo "Item ID: ".$message_room['fk_i_item_id'].", ";
      }
    ?>Message Room ID: <?php echo $message_room['pk_i_message_room_id'] ?>, Buyer ID: <?php echo $message_room['fk_i_buyer_id'] ?></div>
    <div><a href="<?php echo osc_route_url('private-message', array('message_room_id' => $message_room['pk_i_message_room_id'])); ?>">View Chat</a></div>
  </div>
<?php
  }
?>

<script>
</script>
