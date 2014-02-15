
function codeAPictureJudgeStartGotData(data) {
	codeAPictureJudgeChart(idx);
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



// Get GET paramaters
var queryDict = {}
location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]})

// Get data we want
var idx = queryDict['idx'];

// Start & load Chart
codeAPictureJudgeStart('http://localhost:20155/',1);




