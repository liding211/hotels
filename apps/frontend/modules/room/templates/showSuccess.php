<?php 
if (!empty($room->photo)) {
	$photo_url = '/uploads/' . $room->id . '/' . $room->photo;
}	
else {
	$photo_url = '/uploads/defult.jpg';
}
?>
<div id="popup" class="popupclass">
	<a href="#" class="lightbox-close" onclick="$(this).parent().hide('slow'); return false;">
	  <span>Close</span>
	</a>
	<div class="order_info">
		<p>Room reservation is successful. Thank you for using our services.</p>
		<p>
			------------------------------<br />
			Order info #<span id="order_id"></span>:<br />
			------------------------------
		</p>
		<p id="total">Total cost: <span id="order_total"></span>$</a></p>
		<p id="price">Your unique code: <span id="order_hash"></span></p>
		<p>Back to the room <a href="index.php">list</a></p>
	</div>
</div>

<div class="review">
	<img src="<?php echo $photo_url; ?>" class="photo">
    <p id="number">Room number: <?php echo $room->number; ?></a></p>
	<p id="type">Room classification: <?php echo $room->HotelsRoomType->type; ?></a></p>
	<p id="price">Room rate per night: <?php echo $room->price / 100; ?>$</p>
	<form>
	Reserve from
	
	<input type="text" id="from" value="" />
	to <input type="text" id="to" value="" /><br />
	<input type="hidden" name="price" value="'.$row['price'].'">
	<input type="button" id="order" name="order" value="Order"><br />
	<?php echo link_to('Back to search', '@homepage'); ?>
	</form>
</div>
<?php 
    use_helper('Javascript');
    echo javascript_tag('
            $(function() {
                $("#from").datepicker({ dateFormat: "yy-mm-dd", minDate: 0 });
                $("#to").datepicker({ dateFormat: "yy-mm-dd", minDate: 1 });
            });
            order_link = "' . url_for('@make_order') . '";
            room_id = "' . $sf_request->getParameter('id') . '";
        ');
    echo javascript_include_tag('order.ajax.js');
?> 