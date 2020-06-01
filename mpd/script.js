setTimeout(function(){
window.location.href = window.location.protocol +'//'+ window.location.host + window.location.pathname;
}, 100000);

function increaseTime(time){
	songTime = time.split("/");
	songTimeElapsed = songTime[0].split(":");
	songTimeFull = songTime[1].split(":");
	
	if ( parseInt(songTimeElapsed[0],10) >= parseInt(songTimeFull[0],10) && parseInt(songTimeElapsed[1],10) >= parseInt(songTimeFull[1],10) && !( parseInt(songTimeFull[0],10) == 0 && parseInt(songTimeFull[1],10) == 0 && parseInt(songTimeElapsed[1],10)%30 != 0 ) )
	{
		window.location.href = window.location.protocol +'//'+ window.location.host + window.location.pathname;
		
	}else{
		if ( songTimeElapsed[1] == 59 )
		{
			songTimeElapsed[1] = 0;
			songTimeElapsed[0] = parseInt(songTimeElapsed[0],10) + 1 ;
		}else{
			songTimeElapsed[1] = parseInt(songTimeElapsed[1],10) + 1 ;
		}
			
	}
	if (songTimeElapsed[1] < 10 )
	{
		songTimeElapsed[1] = '0'+songTimeElapsed[1]
	}
	
	
	percentElapsed = ( parseInt(songTimeElapsed[0],10) * 60 + parseInt(songTimeElapsed[1],10) ) /
	( parseInt(songTimeFull[0],10) * 60 + parseInt(songTimeFull[1],10) )
	*100;
	
	bar_time.style.width = percentElapsed+"%";
	return songTimeElapsed[0]+':'+songTimeElapsed[1]+'/'+songTime[1];
	
}

function getPosition(e) {
	var rect = e.target.getBoundingClientRect();
	var x = e.clientX - rect.left;
	var y = e.clientY - rect.top;
	return {
		x,
		y
	}
}
function setPlayPosition(e){	
	var full = document.getElementById('full_bar_time_id').offsetWidth;
	var position = getPosition(e);
	var percentToSet = (position.x/full) * 100 ;
	
	
	var http = new XMLHttpRequest();
	var url = 'setPosition.php';
	var params = 'seek='+percentToSet.toFixed(0);
	http.open('POST', url, true);

	//Send the proper header information along with the request
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {
       
		
		var bar_time = document.getElementById('bar_time_id');
		time.childNodes[1].innerHTML = increaseTime(http.responseText);
		
    }
	}
	http.send(params);
	
}

function setVolume(e){    
        var full = document.getElementById('vbar_full').offsetWidth;
        var position = getPosition(e);
        var percentToSet = (position.x/full) * 83 ;


        var http = new XMLHttpRequest();
        var url = 'setVolume.php';
        var params = 'volume='+percentToSet.toFixed(0);
        http.open('POST', url, true);

        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {

		var volume =  document.getElementById('volume_id')
                volume.innerHTML = http.responseText;

    }
        }
        http.send(params);
	
}


var songTime;
var songTimeElapsed;
var songTimeFull;
var percentElapsed;

var time = document.getElementById('time-id');
var bar_time = document.getElementById('bar_time_id');

document.getElementById('full_bar_time_id').addEventListener('click', setPlayPosition);
document.getElementById('vbar_full').addEventListener('click', setVolume);

setInterval(function(){
	if (document.getElementById('pause') != null )
	{
		time.childNodes[1].innerHTML = increaseTime(time.childNodes[1].innerHTML);
	}
}, 1000);
