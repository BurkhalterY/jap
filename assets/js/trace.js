var painting = false;
var x = 0, y = 0;

var positions = new Array();
var initialTime = Date.now();

var c = document.getElementById("canvas");
var ctx = c.getContext("2d");

var c2 = document.getElementById("full-canvas");
var ctx2 = c2.getContext("2d");

ctx.rect(c.width/10, c.height/10, c.width/1.25, c.height/1.25);
ctx.stroke();

ctx.lineWidth = 5;
ctx.lineJoin = "round";
ctx.lineCap = "round";

c.addEventListener("mousedown", function (e) {
	x = e.offsetX*c.width/c.clientWidth;
	y = e.offsetY*c.height/c.clientHeight;
	mousedown();
});

document.addEventListener("mouseup", function (e) {
	mouseup();
});

c.addEventListener("mousemove", function (e) {
	mousemove(e.offsetX*c.width/c.clientWidth, e.offsetY*c.height/c.clientHeight);
	x = e.offsetX*c.width/c.clientWidth;
	y = e.offsetY*c.height/c.clientHeight;
});

c.addEventListener("click", function (e) {
	x = e.offsetX*c.width/c.clientWidth;
	y = e.offsetY*c.height/c.clientHeight;
	click();	
});

document.addEventListener("touchstart", function (e) {
	var rect = e.target.getBoundingClientRect();
	x = e.targetTouches[0].pageX - rect.left;
	y = e.targetTouches[0].pageY - rect.top;
	mousedown();
});

c.addEventListener("touchend", function (e) {
	mouseup();
});

c.addEventListener("touchcancel", function (e) {
	mouseup();
});

c.addEventListener("touchmove", function (e) {
	var rect = e.target.getBoundingClientRect();
	mousemove((e.targetTouches[0].pageX - rect.left)*c.width/c.clientWidth, (e.targetTouches[0].pageY - rect.top)*c.height/c.clientHeight);
	x = e.targetTouches[0].pageX - rect.left;
	y = e.targetTouches[0].pageY - rect.top;
});

function mouseup() {
	painting = false;
}

function mousedown() {
	painting = true;
	positions.push({time:Date.now()-initialTime, action:"start", x:x, y:y});
}

function mousemove(x2, y2) {
	if(painting){
		ctx.beginPath();
		ctx.moveTo(x, y);
		ctx.lineTo(x2, y2);
		ctx.stroke();
		ctx.closePath();
		positions.push({time:Date.now()-initialTime, action:"paint", x:x, y:y});
	}
}

function click() {
	ctx.beginPath();
	ctx.moveTo(x, y);
	ctx.lineTo(x, y);
	ctx.stroke();
	ctx.closePath();
	positions.push({time:Date.now()-initialTime, action:"point", x:x, y:y});
}

function resetCanvas() {
	ctx.clearRect(0, 0, c.width, c.height);
	ctx.lineWidth = 1;
	ctx.rect(c.width/10, c.height/10, c.width/1.25, c.height/1.25);
	ctx.stroke();
	ctx.lineWidth = 5;
	positions.push({time:Date.now()-initialTime, action:"reset"});
}

function validate() {
	addSymbol();
	positions.push({time:Date.now()-initialTime, action:"finish"});
	var dataURL = c2.toDataURL("image/png");
	document.getElementById("image").value = dataURL;
	document.getElementById("json").value = JSON.stringify(positions);
	document.getElementById("form").submit();
}

function addSymbol() {
	positions.push({time:Date.now()-initialTime, action:"addSymbol"});
	if(c2.width > 0){
		let data = ctx2.getImageData(0, 0, c2.width, c2.height);
		c2.width += c.width;
		ctx2.putImageData(data, 0, 0);
	} else {
		c2.width += c.width;
	}
	ctx2.drawImage(c, 0, 0, c.width, c.height, c2.width - c.width, 0, c.width, c.height);
	resetCanvas();
}

function removeSymbol() {
	positions.push({time:Date.now()-initialTime, action:"removeSymbol"});
	if(c2.width >= c.width){
		let data = ctx2.getImageData(0, 0, c2.width, c2.height);
		c2.width -= c.width;
		ctx2.putImageData(data, 0, 0);
	}
}