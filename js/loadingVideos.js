$(document).ready(function() {
    $(".youtube").each(function() {
		
        $(this).css('background-image', 'url(http://i.ytimg.com/vi/' + this.id + '/sddefault.jpg)');
        $(this).append($('<div/>', {'class': 'play'}));
    
        $(document).delegate('#'+this.id, 'click', function() {
            
            var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
            if ($(this).data('params')) iframe_url+='&'+$(this).data('params');
			
            var iframe = $('<iframe/>', {'frameborder': '0', 'src': iframe_url, 'width': $(this).width(), 'height': $(this).height(), 'allow' : 'fullscreen'})
			iframe.attr("allowfullscreen");
            
            $(this).replaceWith(iframe);
        });
    });
 });
