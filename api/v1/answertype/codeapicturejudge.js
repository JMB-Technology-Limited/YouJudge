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
	request.open('GET', codeAPictureJudgeURL+'/api/v1/answertype/get.json.php?siteid='+codeAPictureSiteId, true);
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

function codeAPictureJudgeVote(pictureid, idx) {
	var request = new XMLHttpRequest;
	request.open('POST', codeAPictureJudgeURL+'/api/v1/answertype/vote.json.php?siteid='+codeAPictureSiteId, true);
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
	request.send("pictureid="+parseInt(pictureid)+"&idx="+parseInt(idx));
	request = null;
}

function codeAPictureJudgeChart(idx, order, threshhold, limit) {
	var url = codeAPictureJudgeURL+'/api/v1/answertype/chart.json.php?siteid='+codeAPictureSiteId+'&idx='+idx;
	if (threshhold) url += '&threshhold='+threshhold;
	if (limit) url += '&limit='+limit;
	if (order) url += '&order='+order;
	var request = new XMLHttpRequest;
	request.open('GET', url , true);
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			if (typeof(codeAPictureJudgeChartGotData) == "function") {
				codeAPictureJudgeChartGotData(data);
			}
		} else {
		}
	  }
	}
	request.send();
	request = null;
}


function escapeHTML(inString) {
	var pre = document.createElement('pre');
    var text = document.createTextNode( inString );
    pre.appendChild(text);
    return pre.innerHTML;
}

