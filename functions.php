<?php

/** Facet widget * */
include('facet-widget.php');

// register projects filtering widget and area for it
function register_facet_widget() {
    register_widget('Facet_Widget');
}

add_action('widgets_init', 'register_facet_widget');

/** Facet reset button widget * */
include('facet-reset-widget.php');

// register projects filtering widget and area for it
function register_facet_reset_widget() {
    register_widget('Facet_Reset_Widget');
}
