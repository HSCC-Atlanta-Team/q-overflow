$.fn.isOnScreen = function(){
    // https://codepen.io/vram1980/pen/RwPGwa
    var win = $(window);

    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};

function loadGravitar(element)
{
    element = $(element);

    if (!element.isOnScreen()) {
        console.log('gravitar not on screen');
        return;
    }

    if (element.hasClass('loaded')) {
        console.log('gravitar already loaded');
        return;
    }

    var username = element.data('username');
    var size = element.data('size');
    var url = `${baseUrl}/ajax/gravatar/${username}?s=${size}`;

    $.getJSON(url, function (data) {
        console.log('GRAVATAR LOADED');
        element.attr('src', data.url);
        element.addClass('loaded');
    });
}

$(document).ready(function () {
    $(window).scroll(function() {
        $('.gravatar').each(function (idx, element) {
            loadGravitar(element);
        });
    });
});