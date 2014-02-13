function codeAPictureJudgeStartGotData(data) {
	// add Buttons for answers
	var html = '';
	for(i in data.answers) {
		html += '<li><input type="button" '+
					' value="'+escapeHTML(data.answers[i].answer)+'" '+
					' onclick="clickAnswer('+data.answers[i].idx+');"></li>';
	}
	document.getElementById("AnswerButtonList").innerHTML = html;
	// load first question!
	nextPicture();
}

function clickAnswer(idx){
	alert("idx "+idx);
}

function nextPicture() {
	codeAPictureJudgeGetNextQuestion();
}

function codeAPictureJudgeGetNextQuestionGotData(data) {
	pictureElement.src = data.picture.url_full_size;
}

// set up page and some variables
var pictureElement = document.getElementById("Picture");
// start loading data on this quiz
codeAPictureJudgeStart('http://localhost:20155/',1);

