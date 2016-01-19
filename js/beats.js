var baseURL = window.location.protocol + "//" + window.location.hostname + "/";

function deleteBeat(id) {
	var XHR = new XMLHttpRequest();
  
  XHR.addEventListener('load', function(event) {
    if(XHR.status === 201) {
    	location.reload();
    }
    else
    	console.log("Error");
  });

  XHR.open('GET', baseURL +'ajax/beats.php?function=delete&id=' + id);
  XHR.send();
}

function undoBeat(id) {
	var XHR = new XMLHttpRequest();

  XHR.addEventListener('load', function(event) {
    if(XHR.status === 201) {
    	location.reload();
    }
  });

  XHR.open('GET', baseURL +'ajax/beats.php?function=undo&id=' + id);
  XHR.send();
}