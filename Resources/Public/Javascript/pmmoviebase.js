
/**
 * Automatically init
 */
$(document).ready(function(e) {




    $(".body-bg").animsition({

        inClass               :   'fade-in',
        outClass              :   'fade-out',
        inDuration            :    1500,
        outDuration           :    800,
        linkElement           :   '.animsition-link',
        // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
        loading               :    true,
        loadingParentElement  :   'body', //animsition wrapper element
        loadingClass          :   'animsition-loading',
        unSupportCss          : [ 'animation-duration',
            '-webkit-animation-duration',
            '-o-animation-duration'
        ],
        //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".

        overlay               :   false,

        overlayClass          :   'animsition-overlay-slide',
        overlayParentElement  :   'body'
    });






    // Initinalize Isotope
    var $container = $('#container');
    $('.grid').isotope({
        // options
        itemSelector: '.grid-item',
        layoutMode : 'fitRows',
    });
    $('#container').isotope({ filter: '*' });

    // filter items when filter link is clicked
    $('#filters a').click(function(){
        var selector = $(this).attr('data-filter');
        $container.isotope({ filter: selector });
        return false;
    });
    initIsotope()
    function initIsotope(){
        $('.grid').isotope({
            // options
            itemSelector: '.grid-item',
            layoutMode : 'fitRows',
        });
        $('#container').isotope({ filter: '*' });
    }

});




