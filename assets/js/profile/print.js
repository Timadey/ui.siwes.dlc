$(document).ready(function () {
    $('#passport-block').css({
        right:0
    })


    if($('#if-yes-where').html().trim().length===0){
        $('#if-yes-where').parents('#if-yes-where-block').remove()
    }


    $('#print').click(function(){
        window.print()
    })
});