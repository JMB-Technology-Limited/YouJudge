
function youjudgeStartGotData(data) {
	youjudgeChart(order);
}

function youjudgeChartGotData(data) {
	var html = '';
	for(i in data.items) {
		html += '<li><img src="'+data.items[i].item.url_full_size+'" class="ChartImage">'+
				'<div class="ChartScore">'+data.items[i].votes_won.toString() + " won out of " + data.items[i].votes_total.toString() + '</div>' +
				'</li>';
	}
	document.getElementById("ChartList").innerHTML = html;
}



// Start & load Chart
youjudgeStart('http://localhost:20155/',2,'apipassword');




