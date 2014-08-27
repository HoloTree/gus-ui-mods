/**
 * Gus UI
 * http://holotree.com
 *
 * Copyright (c) 2014 Josh Pollock
 * Licensed under the GPLv2+ license.
 */

jQuery(document).ready(function($) {
    //init foundation
    $(document).foundation();

    var maxHeight = -1;
    var divs = '#tabs .content';

    $( divs ).each( function() {
        maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
    });

    $( divs ).each( function() {
        $( this ).height( maxHeight) ;
    });

    $( 'ul.tabs').height( maxHeight );

    $( '#ht-sub-menu-button' ).click(function() {
        $( this ).toggleClass( 'expanded' ).siblings( 'div' ).slideToggle();
    });

});
