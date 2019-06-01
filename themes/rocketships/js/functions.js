(function( $ ) {
    $(function() {
        $(".subcategory-card").on("click", function(){
            $(this).toggleClass("hover");
        });
    });

    $('.top-category-card').click(function() {
        $(this).animate({
            left: '-50%'
        }, 500, function() {
            $(this).css('left', '400%');
            $(this).appendTo('#container');
        });

        $(this).next().animate({
            left: '50%'
        }, 500);
    });

})( jQuery )