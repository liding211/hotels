//$("#reg").click(
//	function(){
//	$.post('registration.php', 
//			  {
//				action: "registration",
//				first_name: $("input")[0].value,
//				last_name: $("input")[1].value,
//				email: $("input")[2].value,
//				phone: $("input")[3].value
//			  }, 
//	function(data) {
//		
//		if(data.result){
//			$("#entry_block").hide("slow");
//		}
//		else{
//			$("#reg_err_info").remove();
//		
//			parent = $('<tr></tr>').attr("id", "reg_err_info");
//		
//			$('<td></td>')
//			.attr("colspan", "2")
//			.attr("class", "reg_err")
//			.text(data.error)
//			.appendTo(parent);
//			
//			parent.insertAfter("#reg_submit");
//		}
//	}, 
//	"json");
//});
//$("#login").click(
//	function(){
//	$.post('registration.php', 
//			  {
//				action: "login",
//				email: $("#email_login").val()
//			  }, 
//	function(data) {
//	
//		if (data.result) {
//			$("#entry_block").hide("slow");
//		}
//		else{
//		
//			$("#login_err_info").remove();
//		
//			parent = $('<tr></tr>').attr("id", "login_err_info");
//		
//			$('<td></td>')
//			.attr("colspan", "2")
//			.attr("class", "reg_err")
//			.text(data.error)
//			.appendTo(parent);
//			
//			parent.insertAfter("#login_submit");
//		}
//	}, 
//	"json");
//});
