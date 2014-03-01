
function codeAPictureJudgeStartGotData(data) {
	codeAPictureJudgeChart(order);
}

function codeAPictureJudgeChartGotData(data) {
	var html = '';
	for(i in data.pictures) {
		html += '<li><img src="'+data.pictures[i].picture.url_full_size+'" class="ChartImage">'+
				'<div class="ChartScore">'+data.pictures[i].votes_won.toString() + " won out of " + data.pictures[i].votes_total.toString() + '</div>' +
				'</li>';
	}
	document.getElementById("ChartList").innerHTML = html;
}



// Start & load Chart
codeAPictureJudgeStart('http://localhost:20155/',2,'apipassword');




