var codeAPictureJudgeURL;
var codeAPictureSiteId;

function codeAPictureJudgeStart(url, siteid) {
	codeAPictureJudgeURL = url;
	codeAPictureSiteId = siteid;
	var request = new XMLHttpRequest;
	request.open('GET', url+'/api/v1/answertype/start.json.php?siteid='+siteid, true);
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			codeAPictureJudgeStartGotData(data);
		} else {
		}
	  }
	}
	request.send();
	request = null;
}

function codeAPictureJudgeGetNextQuestion() {
	var request = new XMLHttpRequest;
	request.open('GET', codeAPictureJudgeURL+'/api/v1/answertype/get.json.php?siteid='+codeAPictureSiteId, true);
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			codeAPictureJudgeGetNextQuestionGotData(data);
		} else {
		}
	  }
	}
	request.send();
	request = null;
}


