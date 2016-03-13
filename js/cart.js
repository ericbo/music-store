var baseURL = window.location.protocol + "//" + window.location.hostname + "/";

function addToCart(id,exclusive = false) {
	var XHR = new XMLHttpRequest();
  
  XHR.addEventListener('load', function(event) {
    if(XHR.status === 201) {
    	var cart = JSON.parse(XHR.response);
      window.location = baseURL + "cart.php"
    }
    else
    	console.log("Error");
  });

  if(exclusive != false)
  	XHR.open('GET', baseURL +'ajax/cart.php?function=add&id=' + id + '&exclusive=1');
  else
  	XHR.open('GET', baseURL +'ajax/cart.php?function=add&id=' + id);

  XHR.send();
}

function removeFromCart(id) {
	var XHR = new XMLHttpRequest();
  
  XHR.addEventListener('load', function(event) {
    if(XHR.status === 201) {
    	location.reload();
    }
    else
    	console.log("Error");
  });

  XHR.open('GET', baseURL +'ajax/cart.php?function=remove&id=' + id);

  XHR.send();
}

function updateCartSize(val) {
	document.getElementById("cartSize").innerHTML = val;
}