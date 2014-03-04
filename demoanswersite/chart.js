
function youjudgeStartGotData(data) {
	youjudgeChart(idx);
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



// Get GET paramaters
var queryDict = {}
location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]})

// Get data we want
var idx = queryDict['idx'];

// Start & load Chart
youjudgeStart('http://localhost:20155/',1,'apipassword');




