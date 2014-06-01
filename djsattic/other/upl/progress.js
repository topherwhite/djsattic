var running = false;

function progressStart() {
	
	running = true;
	progressGet();
	return true;
}


function    progressGet () {
	var id = $('UPLOAD_IDENTIFIER').value;
	//IE cache buster 
	var t = new Date().getTime();
	var url = 'progress.php?ID='+id+'&t='+t;
	
	new ajax(url, {
		method: 'get',
		onComplete: progressComplete,
		update: 'output'
	}
	);
	
}

function progressComplete(request) {
	if (running) {
		window.setTimeout(progressGet,1000);
	}
}