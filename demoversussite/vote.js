function codeAPictureJudgeStartGotData(data) {
	// load first question!
	nextPicture();
}

function nextPicture() {
	codeAPictureJudgeGetNextQuestion();
}

function codeAPictureJudgeGetNextQuestionGotData(data) {
	picture1Element.src = data.picture1.url_full_size;
	picture2Element.src = data.picture2.url_full_size;
	picture1Id = data.picture1.id;
	picture2Id = data.picture2.id;
}

function votePicture1() {
	codeAPictureJudgeVote(picture1Id,picture2Id);
}

function votePicture2() {
	codeAPictureJudgeVote(picture2Id,picture1Id);
}

function codeAPictureJudgeVoteGotData(data) {
	nextPicture();
}


// set up page and some variables
var picture1Element = document.getElementById("Picture1");
var picture2Element = document.getElementById("Picture2");
var picture1Id;
var picture2Id;
// start loading data on this quiz
codeAPictureJudgeStart('http://localhost:20155/',2);

