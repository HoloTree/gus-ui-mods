/**
 * Gus UI
 * http://holotree.com
 *
 * Copyright (c) 2014 Josh Pollock
 * Licensed under the GPLv2+ license.
 */

jQuery(document).ready(function($) {
    //init foundation
    $( document ).foundation();

    tabHeight();
    window.addEventListener( 'resize', tabHeight );

    $( document ).ajaxComplete(function() {
        //tabHeight();
    });


    function tabHeight() {
        var width = $(document).width();
        var divs = '#tabs .content';
        if (width > 640) {
            var maxHeight = -1;


            if (undefined != paginatedViews) {
                $.each(paginatedViews, function (index, value) {
                    if ($(value).length > 0) {
                        maxHeight = maxHeight > $(value).height() ? maxHeight : $(value).height();
                    }
                    ;
                });
            }

            $(divs).each(function () {
                maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
            });


            if (maxHeight > 0) {
                $(divs).each(function () {
                    $(this).height(maxHeight);
                });

                $('ul.tabs').height(maxHeight);
            }
        }
        else {

            $('ul.tabs').removeAttr( 'style' );
            $(divs).each(function () {
              $(this).removeAttr( 'style' );
            });
        }
    }


    $( '#ht-sub-menu-button' ).click(function() {
        $( this ).toggleClass( 'expanded' ).siblings( 'div' ).slideToggle();
    });

});
