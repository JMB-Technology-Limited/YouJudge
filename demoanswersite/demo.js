function nextPicture() {
	codeAPictureJudgeGetNextQuestion();
}

function codeAPictureJudgeGetNextQuestionGotData(data) {
	pictureElement.src = data.picture.url_full_size;
}

// set up page and some variables
codeAPictureJudgeStart('http://localhost:20155/',1);
var pictureElement = document.getElementById("Picture");

function codeAPictureJudgeStartGotData(data) {
	// load first question!
	nextPicture();
}



