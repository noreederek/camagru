var saved = new Array;
var width = new Array;
var height = new Array;
var x = new Array;
var y = new Array;
var canva_filters = document.getElementById("canva_filters");
var context_filters = canva_filters.getContext("2d");
var i = 0;

function getCanvasCenter(canvas) {
	return {
		x: canvas.width / 2,
		y: canvas.height / 2
	};
}

function submitfilter(ev) {
	var data = ev.target.src;
	var node = document.createElement("img");
	node.src = data;
	width[i] = node.width/2;
	height[i] = node.height/2;
	var pos = getCanvasCenter(canva_filters);
	x[i] = pos.x;
	y[i] = pos.y;
	context_filters.drawImage(node, x[i], y[i], width[i], height[i]);
	context_filters.save();
	saved[i] = node;
	i++;
	var buttons = document.getElementById('move');
	buttons.style.display = "flex";

	var snap = document.getElementById("snap");
	snap.setAttribute("onclick", "disable_buttons()");
}

function	plus_image()
{
	width[i - 1] += width[i - 1] * 10 / 100;
	height[i - 1] += height[i - 1] * 10 / 100;
	context_filters.clearRect(0, 0, 960, 720);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}


function	minus_image()
{
	width[i - 1] -= width[i - 1] * 10 / 100;
	height[i - 1] -= height[i - 1] * 10 / 100;
	context_filters.clearRect(0, 0, 960, 720);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	move_left()
{
	x[i - 1] -= 10;
	x[i - 1] -= 10;
	context_filters.clearRect(0, 0, 960, 720);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	move_right()
{
	x[i - 1] += 10;
	x[i - 1] += 10;
	context_filters.clearRect(0, 0, 960, 720);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	move_up()
{
	y[i - 1] -= 10;
	y[i - 1] -= 10;
	context_filters.clearRect(0, 0, 960, 720);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	move_down()
{
	y[i - 1] += 10;
	y[i - 1] += 10;
	context_filters.clearRect(0, 0, 960, 720);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	do_reset()
{
	reset_buttons();
	context_filters.clearRect(0, 0, 960, 720);
	context_filters.save();
	var snap = document.getElementById('snap');
	snap.removeAttribute("onclick");
	for (var j = 0; j < i; j++)
	{
		delete saved[j];
	}
	i = 0;
	var move = document.getElementById('move');
	move.style.display = 'none';
}
