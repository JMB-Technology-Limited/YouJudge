var youjudgeURL;
var youjudgeSiteId;
var youjudgeSiteAPIPassword;

function youjudgeStart(url, siteid, siteapipassword) {
	youjudgeURL = url;
	youjudgeSiteId = siteid;
	youjudgeSiteAPIPassword = siteapipassword;
	var request = new XMLHttpRequest;
	request.open('GET', url+'/api/v1/answertype/start.json.php?siteid='+siteid+"&siteapipassword="+youjudgeSiteAPIPassword, true);
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			if (typeof(youjudgeStartGotData) == "function") {
				youjudgeStartGotData(data);
			}
		} else {
		}
	  }
	}
	request.send();
	request = null;
}

function youjudgeGetNextQuestion() {
	var request = new XMLHttpRequest;
	request.open('GET', youjudgeURL+'/api/v1/answertype/get.json.php?siteid='+youjudgeSiteId+"&siteapipassword="+youjudgeSiteAPIPassword, true);
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			if (typeof(youjudgeGetNextQuestionGotData) == "function") {
				youjudgeGetNextQuestionGotData(data);
			}
		} else {
		}
	  }
	}
	request.send();
	request = null;
}

function youjudgeVote(itemid, idx) {
	var request = new XMLHttpRequest;
	request.open('POST', youjudgeURL+'/api/v1/answertype/vote.json.php?siteid='+youjudgeSiteId+"&siteapipassword="+youjudgeSiteAPIPassword, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			if (typeof(youjudgeVoteGotData) == "function") {
				youjudgeVoteGotData(data);
			}
		} else {
		}
	  }
	}
	request.send("itemid="+parseInt(itemid)+"&idx="+parseInt(idx));
	request = null;
}

function youjudgeChart(idx, order, threshhold, limit) {
	var url = youjudgeURL+'/api/v1/answertype/chart.json.php?siteid='+youjudgeSiteId+"&siteapipassword="+youjudgeSiteAPIPassword+'&idx='+idx;
	if (threshhold) url += '&threshhold='+threshhold;
	if (limit) url += '&limit='+limit;
	if (order) url += '&order='+order;
	var request = new XMLHttpRequest;
	request.open('GET', url , true);
	request.onreadystatechange = function() {
	  if (this.readyState === 4){
		if (this.status >= 200 && this.status < 400){
			data = JSON.parse(this.responseText);
			if (typeof(youjudgeChartGotData) == "function") {
				youjudgeChartGotData(data);
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

