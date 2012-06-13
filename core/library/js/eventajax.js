jQuery(document).ready(function($) {
    $(".tribe-events-calendar-buttons a").live("click", function(e){
        e.preventDefault();
        var pageLocation = $(this).attr('href');
        pageLocation = pageLocation + ' #tribe-events-content';
        $("#tribe-events-content").load(pageLocation,function(){
            //Just do nothing
        }); 
    });  
});