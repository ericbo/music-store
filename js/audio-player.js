var player = document.getElementById("music-player");

//Listeners
$("#play-pause").click(function() {
	if(player.paused)
		player.play();
	else
		player.pause();
});

$(".list-group-item").click(function() {
  if( ! $(this).hasClass('ignore') ) {
  	//Display new selection.
    $(".list-group-item").removeClass("active"); 
    $(this).addClass("active");

    //Change song
    player.src = $(this).attr('src');
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
    console.log(widthPercent);

    if(player.currentTime != null)
    {
    	//Percentage of the bar selected * total time
    	player.currentTime = widthPercent * player.duration;
    }
    if(player.paused)
    	player.play();
});

player.onplaying = updateProgress();

function updateProgress() {
	var width = (player.currentTime * 100 / player.duration) + "%";
 	$('.progress-bar').width(width);

 	window.requestAnimationFrame(updateProgress);
}