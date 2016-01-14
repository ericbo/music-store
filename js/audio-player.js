var baseURL = window.location.protocol + "//" + window.location.hostname + "/";
var player = document.getElementById("music-player");

$(document).ready(changeSize);

$(window).resize(changeSize);

$(window).keydown(function(e) {
    if(e.keyCode == 32)
        transition();
});

//Listeners
$(".play-pause").click(transition);

$(".list-group-item").click(function() {
  if( ! $(this).hasClass('ignore') ) {
  	//Display new selection.
    $(".list-group-item").removeClass("active"); 
    $(this).addClass("active");

    //Change song
    if(player.canPlayType('audio/mpeg'))
        player.src = baseURL + "music/" + $(this).attr('src') + ".mp3";
    else
        if(player.canPlayType('audio/ogg; codecs="vorbis"'))
            player.src = baseURL + "music/" + $(this).attr('src') + ".ogg";
    player.play();
  }
});

//Controlls users interaction with time
$('.progress').bind('click', function (ev) {
    var $div = $(ev.target); //Location of cursor
    var $display = $div.find('.progress-bar');

    //Determin how wide the progress bar should be.
    var offset = $div.offset();
    var x = ev.clientX - offset.left;
    var widthPercent = (x) / $(this).width();

    if(player.currentTime != null)
    {
    	//Percentage of the bar selected * total time
    	player.currentTime = widthPercent * player.duration;
    }
    if(player.paused)
    	player.play();
});
player.onplaying = function() {
    changeToPause();
    updateProgress();
}

player.onpause = function() {changeToPlay()};

function updateProgress() {
	var width = (player.currentTime * 100 / player.duration) + "%";
 	$('.progress-bar').width(width);

 	window.requestAnimationFrame(updateProgress);
}


/* Functions */
function transition() {
    if(player.paused)
        player.play();
    else
        player.pause();
}

function changeToPause() {
    var $playPause = $(".glyphicon-play");
    $playPause.removeClass("glyphicon-play");
    $playPause.addClass("glyphicon-pause");
}

function changeToPlay() {
    var $playPause = $(".glyphicon-pause");
    $playPause.removeClass("glyphicon-pause");
    $playPause.addClass("glyphicon-play");
}

function loadFooter() {
    $("#controls").addClass('hidden');
    $("footer").removeClass('hidden');
    $("body").addClass("fix-body");
}

function disableFooter() {
    $("#controls").removeClass('hidden');
    $("footer").addClass('hidden');
    $("body").removeClass("fix-body");
}

function changeSize() {
    if($("body").height() > $(window).height()) { //Page has a scroll bar.
        if($("footer").hasClass('hidden'))   //If the footer does not exist
            loadFooter();
    }
}