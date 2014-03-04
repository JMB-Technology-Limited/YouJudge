function youjudgeStartGotData(data) {
	// load first question!
	nextItem();
}

function nextItem() {
	youjudgeGetNextQuestion();
}

function youjudgeGetNextQuestionGotData(data) {
	item1Element.src = data.item1.url_full_size;
	item2Element.src = data.item2.url_full_size;
	item1Id = data.item1.id;
	item2Id = data.item2.id;
}

function voteItem1() {
	youjudgeVote(item1Id,item2Id);
}

function voteItem2() {
	youjudgeVote(item2Id,item1Id);
}

function youjudgeVoteGotData(data) {
	nextItem();
}


// set up page and some variables
var item1Element = document.getElementById("Picture1");
var item2Element = document.getElementById("Picture2");
var item1Id;
var item2Id;
// start loading data on this quiz
youjudgeStart('http://localhost:20155/',2,'apipassword');

