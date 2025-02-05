<?php

    /*
    *
    *	Bingo Framework Menu Functions
    *	------------------------------------------------
    *	Bingo Framework v3.0
    * 	Copyright Bingo Ideas 2017 - http://wpbingosite.com/
    *
    *	hanata_setup_menus()
    *
    */


    /* CUSTOM MENU SETUP
    ================================================== */
    register_nav_menus( array(
        'main_navigation' => esc_html__( 'Main Menu', 'hanata' ),
        'top_menu'          => esc_html__( 'Top Menu', 'hanata' )   
    ) );

?>
