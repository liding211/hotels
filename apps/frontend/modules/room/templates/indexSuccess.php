<form id="search_form">
	Available rooms with  
	<input type="text" id="from" value="" />
	to 
	<input type="text" id="to" value="" />
	<input type="submit" id="search" name="search" value="search"> 
	Sorted by 
	<a id="sort_price" href="#">price</a> | 
	<a id="sort_category" href="#">category</a>.
</form>
<div id="content"></div>

<script type="text/javascript">
	$(function() {
		$("#from").datepicker({ dateFormat: "yy-mm-dd", minDate: 0 });
		$("#to").datepicker({ dateFormat: "yy-mm-dd", minDate: 1 });
	});
</script>
<script type="text/javascript" src="js/room_list.ajax.js"></script>