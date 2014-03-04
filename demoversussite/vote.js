function youjudgeStartGotData(data) {
	// load first question!
	nextPicture();
}

function nextPicture() {
	youjudgeGetNextQuestion();
}

function youjudgeGetNextQuestionGotData(data) {
	picture1Element.src = data.picture1.url_full_size;
	picture2Element.src = data.picture2.url_full_size;
	picture1Id = data.picture1.id;
	picture2Id = data.picture2.id;
}

function votePicture1() {
	youjudgeVote(picture1Id,picture2Id);
}

function votePicture2() {
	youjudgeVote(picture2Id,picture1Id);
}

function youjudgeVoteGotData(data) {
	nextPicture();
}


// set up page and some variables
var picture1Element = document.getElementById("Picture1");
var picture2Element = document.getElementById("Picture2");
var picture1Id;
var picture2Id;
// start loading data on this quiz
youjudgeStart('http://localhost:20155/',2,'apipassword');

