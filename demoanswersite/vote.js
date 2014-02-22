function codeAPictureJudgeStartGotData(data) {
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
	nextPicture();
}

function clickAnswer(idx){
	codeAPictureJudgeVote(pictureId, idx);
}

function codeAPictureJudgeVoteGotData(data) {
	var html = '';
	for(i in data.stats) {
		html += '<p>'+escapeHTML(data.stats[i].answer)+' has '+data.stats[i].votes+' votes.</p>'
	}
	document.getElementById("LastVoteDetails").innerHTML = html;
	nextPicture();
}

function nextPicture() {
	codeAPictureJudgeGetNextQuestion();
}

function codeAPictureJudgeGetNextQuestionGotData(data) {
	pictureElement.src = data.picture.url_full_size;
	pictureId = data.picture.id;
}

// set up page and some variables
var pictureElement = document.getElementById("Picture");
var pictureId;
// start loading data on this quiz
codeAPictureJudgeStart('http://localhost:20155/',1);

