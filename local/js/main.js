$(function(){

    $(".actions").click(function()
    {
        if ($(this).hasClass("added")){
            $(this).removeClass("added");
        }
        else {
            $(this).addClass("added");
        }
        $.get(ajaxTo, {
            action  : "counter",
            column  : $(this).attr("data-type"),
            postId  : postId
        });
    });

});