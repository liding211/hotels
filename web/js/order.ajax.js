$("#order").click(
	function(){
		
		if($('#from').val() && $('#to').val()){
			$('#err_info').remove();
			makeOrder();
			return true;
		}
		else if($('#from').val() == "" && $('#to').val() == "") {
			error = "You did not specify the period of reservation";
		}
		else if($('#from').val() == ""){
			error = "Enter the start date of search";
		}
		else {
			error = "Enter the end date search";
		}
		
		$('#err_info').remove();
		
		$('<div></div>')
		.attr("id", "err_info")
		.html(error)
		.insertAfter('#order');
		return false;
		
	}
);

function makeOrder(){
	$.post('order.php', 
		  {
			from: $("#from").val(),
			to: $("#to").val()
		  }, 
		function(data) {
			if(data.result){
				
				//clear pervios error
				$('#err_info').remove();
				
				$("#order_id").text(data.order_info.id);
				$("#order_total").text(data.order_info.total / 100);
				$("#order_hash").text(data.order_info.hash);
				
				$("#popup").show("slow");
			}
			else{
						
				$('#err_info').remove();
				
				$('<div></div>')
				.attr("id", "err_info")
				.html(data.error)
				.insertAfter('#order');
				return false;
				
			}
		}, 
		"json"
		);
}