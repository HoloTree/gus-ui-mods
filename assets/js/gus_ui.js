/*! Gus UI - v0.1.0
 * http://holotree.com
 * Copyright (c) 2014; * Licensed GPLv2+ */
jQuery(document).ready(function($) {
    //init foundation
    $( document ).foundation();

    tabHeight();
    window.addEventListener( 'resize', tabHeight );

    $( document ).ajaxComplete(function() {
        //tabHeight();
    });


    function tabHeight() {
        var width = $( document ).width();

        if (width > 480) {
            var maxHeight = -1;
            var divs = '#tabs .content';

            if ( undefined != paginatedViews ) {
                $.each( paginatedViews, function( index, value ){
                    if ( $( value ).length > 0 ) {
                        maxHeight = maxHeight > $( value ).height() ? maxHeight : $( value ).height();
                    };
                });
            }

                $(divs).each(function () {
                    maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
                });


            if ( maxHeight > 0 ) {
                $(divs).each(function () {
                    $(this).height(maxHeight);
                });

                $('ul.tabs').not( '.consensus-tabs' ).height(maxHeight);
            }
        }
    }

    $( '#ht-sub-menu-button' ).click(function() {
        $( this ).toggleClass( 'expanded' ).siblings( 'div' ).slideToggle();
    });

});
