$("tr").click(function() {
  $(".selected").removeClass("selected"); 
  $(this).addClass("selected");
});

//Controlls users interaction with time
$('.progress').bind('click', function (ev) {
    var $div = $(ev.target); //Location of cursor
    var $display = $div.find('.progress-bar');

    //Determin how wide the progress bar should be.
    var offset = $div.offset();
    var x = ev.clientX - offset.left;

    //Find the percentage of the width
    var widthPercent = (x * 100) / $(this).width() + "%";

    $('.progress-bar').width(widthPercent);
});