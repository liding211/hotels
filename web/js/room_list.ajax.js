var content;
var answer = [];

//ajax query 
function getAjaxContent(){
	$.post(
		'rooms_list',{
			from: $('#from').val(),
			to: $('#to').val()
		},
		function(date){
			
			$("#search_err_info").remove();
			
			answer['result'] = date.result;
			answer['error'] = date.error;
			
			content = date.rooms; //create copy of room list
			
			if(answer['result']){
				getHTML('');
			}
			else{
				$('<font></font>')
				.attr("id", "search_err_info")
				.html(answer['error'])
				.appendTo("#search_form");
			}
		},
		'json' 
	);
}

function getHTML(method){
	
	data = roomSort(method, content);
	
	jQuery.each(data,
		function(index) {
			var price = data[index].price / 100;
			var id = data[index].id;
			var type = data[index].type;

			if (data[index].photo) {
				photo_url = data[index].id + '/' + data[index].photo;
			}	
			else {
				photo_url = 'defult.jpg';
			}
			
			$('<div></div>')
			.attr("class", "room")
			.html(
				'<img src="uploads/' + photo_url + '" class="photo">' + 
				'<p id="type"><a href="index.php?cntr=room&action=view&room_id=' + id + '">' + type + '</a></p>' +
				'<p><span id="price">' + price + '</span>$</p>'
			)
			.appendTo("#content");
		}
	);
}

//sorted room list
function roomSort(field, data){
	len = data.length;
	if(field != ""){
		for (i = 0; i < len - 1; i++) {
			min = i; /* min – позиция минимального элемента */
	 
			/* внутренний цикл. если найден элемент строго меньший текущего минимального, записываем его индекс как минимальный */
			for(j = i + 1; j < len; j++) {
				if(field == "price"){
					if(Number(data[j].price) < Number(data[min].price)){
						min = j;
					}
				}
				if(field == "type"){
					if(data[j].type < data[min].type){
						min = j;
					}
				}
			}
			if(min != i){ /* минимальный элемент не является первым неотсортированным, обмен нужен */
				cont = data[i];
				data[i] = data[min];
				data[min] = cont;
			}
		}
	}
	return data;
}


$(document).ready(
	getAjaxContent
)

$("#search").click(
	function(){
		$("#search_err_info").remove();
		if($('#from').val() && $('#to').val()){
			$("#content").empty();
			getAjaxContent('');
			return false;
		}
		else if($('#from').val() == "" && $('#to').val() == "") {
			error = "You did not specify the period of the search";
		}
		else if($('#from').val() == ""){
			error = "Enter the start date of search";
		}
		else {
			error = "Enter the end date search";
		}
		$('<font></font>')
		.attr("id", "search_err_info")
		.html(error)
		.appendTo("#search_form");
		return false;
	}
);

$("#sort_price").click(
	function(){
		$("#content").empty();
		getHTML('price');
		return false;
	}
);

$("#sort_category").click(
	function(){
		$("#content").empty();
		getHTML('type');
		return false;
	}
);