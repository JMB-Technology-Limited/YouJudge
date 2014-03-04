function youjudgeStartGotData(data) {
	// add Buttons for answers
	var html = '';
	for(i in data.answers) {
		html += '<li><input type="button" '+
					' value="'+escapeHTML(data.answers[i].answer)+'" '+
					' onclick="clickAnswer('+data.answers[i].idx+');"></li>';
	}
	document.getElementById("AnswerButtonList").innerHTML = html;
	// add links for chart
	var html = '';
	for(i in data.answers) {
		html += '<li><a href="chart.html?idx='+data.answers[i].idx+'">'+
					escapeHTML(data.answers[i].answer)+
					' chart</a></li>';
	}
	document.getElementById("ChartsLinkList").innerHTML = html;
	// load first question!
	nextItem();
}

function clickAnswer(idx){
	youjudgeVote(itemId, idx);
}

function youjudgeVoteGotData(data) {
	var html = '';
	for(i in data.stats) {
		html += '<p>'+escapeHTML(data.stats[i].answer)+' has '+data.stats[i].votes+' votes.</p>'
	}
	document.getElementById("LastVoteDetails").innerHTML = html;
	nextItem();
}

function nextItem() {
	youjudgeGetNextQuestion();
}

function youjudgeGetNextQuestionGotData(data) {
	itemElement.src = data.item.url_full_size;
	itemId = data.item.id;
}

// set up page and some variables
var itemElement = document.getElementById("Picture");
var itemId;
// start loading data on this quiz
youjudgeStart('http://localhost:20155/',1,'apipassword');

