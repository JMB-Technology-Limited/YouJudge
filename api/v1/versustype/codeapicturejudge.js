var codeAPictureJudgeURL;
var codeAPictureSiteId;

function codeAPictureJudgeStart(url, siteid) {
	codeAPictureJudgeURL = url;
	codeAPictureSiteId = siteid;
	var request = new XMLHttpRequest;
	request.open('GET', url+'/api/v1/versustype/start.json.php?siteid='+siteid, true);
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			if (typeof(codeAPictureJudgeStartGotData) == "function") {
				codeAPictureJudgeStartGotData(data);
			}
		} else {
		}
	  }
	}
	request.send();
	request = null;
}


function codeAPictureJudgeGetNextQuestion() {
	var request = new XMLHttpRequest;
	request.open('GET', codeAPictureJudgeURL+'/api/v1/versustype/get.json.php?siteid='+codeAPictureSiteId, true);
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			if (typeof(codeAPictureJudgeGetNextQuestionGotData) == "function") {
				codeAPictureJudgeGetNextQuestionGotData(data);
			}
		} else {
		}
	  }
	}
	request.send();
	request = null;
}


function codeAPictureJudgeVote(winningpictureid, losingpictureid) {
	var request = new XMLHttpRequest;
	request.open('POST', codeAPictureJudgeURL+'/api/v1/versustype/vote.json.php?siteid='+codeAPictureSiteId, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			if (typeof(codeAPictureJudgeVoteGotData) == "function") {
				codeAPictureJudgeVoteGotData(data);
			}
		} else {
		}
	  }
	}
	request.send("winningpictureid="+parseInt(winningpictureid)+"&losingpictureid="+parseInt(losingpictureid));
	request = null;
}

function escapeHTML(inString) {
	var pre = document.createElement('pre');
    var text = document.createTextNode( inString );
    pre.appendChild(text);
    return pre.innerHTML;
}

