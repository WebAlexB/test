<?php

    /*
    *
    *	Bingo MEGA MENU FRAMEWORK
    *	------------------------------------------------
    *	Bingo Framework
    * 	Copyright Bingo Ideas 2017 - http://wpbingosite.com/
    *
    */

    class hanata_mega_menu {

        /*--------------------------------------------*
         * Constructor
         *--------------------------------------------*/

        /**
         * Initializes the plugin by setting localization, filters, and administration functions.
         */
        function __construct() {
			
			// add new fields via hook
			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'hanata_mega_menu_add_custom_fields' ), 10, 5 );
			
            // add custom menu fields to menu
            add_filter( 'wp_setup_nav_menu_item', array( $this, 'hanata_mega_menu_add_custom_nav_fields' ) );

            // save menu custom fields
            add_action( 'wp_update_nav_menu_item', array( $this, 'hanata_mega_menu_update_custom_nav_fields' ), 10, 3 );

            // edit menu walker
            add_filter( 'wp_edit_nav_menu_walker', array( $this, 'hanata_mega_menu_edit_walker' ), 10, 2 );

        } // end constructor
        
        /**
         * Add custom fields to edit menu page
         *
         * @access      public
         * @since       1.0
         * @return      void
         */
        function hanata_mega_menu_add_custom_fields( $item_id, $item, $depth, $args ) {
			?>
        	<div class="menu-options">
				<?php if ( $depth == 0 ) { ?>
					<h4><?php esc_html_e( 'Mega Menu Options', 'hanata' ); ?></h4>
					<p class="field-custom description description-wide">
						<label
							for="edit-menu-megamenu-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Enable Mega Menu', 'hanata' ); ?>
							<input type="checkbox" id="edit-menu-megamenu-<?php echo esc_attr($item_id); ?>"
								   class="edit-menu-item-custom" id="menu-megamenu[<?php echo esc_attr($item_id); ?>]"
								   name="menu-megamenu[<?php echo esc_attr($item_id); ?>]"
								   value="1" <?php echo checked( ! empty( $item->megamenu ), 1, false ); ?> />
						</label>
					</p>				
					<p class="field-custom description description-wide">
						<label
							for="edit-menu-is-fullwidth-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Full Width Mega Menu', 'hanata' ); ?>
							<input type="checkbox" id="edit-menu-is-fullwidth-<?php echo esc_attr($item_id); ?>"
								   class="edit-menu-item-custom" id="menu-is-fullwidth[<?php echo esc_attr($item_id); ?>]"
								   name="menu-is-fullwidth[<?php echo esc_attr($item_id); ?>]"
								   value="1" <?php echo checked( ! empty( $item->isfullwidth ), 1, false ); ?> />
						</label>
					</p>
				<?php } ?>
				<p class="field-custom description description-wide" style="height: 10px;"></p>

                <h4><?php esc_html_e( 'Custom Menu Options', 'hanata' ); ?></h4>

                <p class="field-custom description description-wide">
                    <label
                        for="edit-menu-loggedin-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Visible only when logged in', 'hanata' ); ?>
                        <input type="checkbox" id="edit-menu-loggedin-<?php echo esc_attr($item_id); ?>"
                               class="edit-menu-item-custom" id="menu-loggedin[<?php echo esc_attr($item_id); ?>]"
                               name="menu-loggedin[<?php echo esc_attr($item_id); ?>]"
                               value="1" <?php echo checked( ! empty( $item->loggedin ), 1, false ); ?> />
                    </label>
                </p>

                <p class="field-custom description description-wide">
                    <label
                        for="edit-menu-loggedout-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Visible only when logged out', 'hanata' ); ?>
                        <input type="checkbox" id="edit-menu-loggedout-<?php echo esc_attr($item_id); ?>"
                               class="edit-menu-item-custom" id="menu-loggedout[<?php echo esc_attr($item_id); ?>]"
                               name="menu-loggedout[<?php echo esc_attr($item_id); ?>]"
                               value="1" <?php echo checked( ! empty( $item->loggedout ), 1, false ); ?> />
                    </label>
                </p>
				
				<p class="field-custom description description-wide">
					<label
						for="edit-menu-newbadge-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'New Badge', 'hanata' ); ?>
						<input type="checkbox" id="edit-menu-newbadge-<?php echo esc_attr($item_id); ?>"
							   class="edit-menu-item-custom" id="menu-newbadge[<?php echo esc_attr($item_id); ?>]"
							   name="menu-newbadge[<?php echo esc_attr($item_id); ?>]"
							   value="1" <?php echo checked( ! empty( $item->newbadge ), 1, false ); ?> />
					</label>
				</p>
				<p class="field-custom description description-wide">
					<label
						for="edit-menu-salebadge-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Sale Badge', 'hanata' ); ?>
						<input type="checkbox" id="edit-menu-salebadge-<?php echo esc_attr($item_id); ?>"
							   class="edit-menu-item-custom" id="menu-salebadge[<?php echo esc_attr($item_id); ?>]"
							   name="menu-salebadge[<?php echo esc_attr($item_id); ?>]"
							   value="1" <?php echo checked( ! empty( $item->salebadge ), 1, false ); ?> />
					</label>
				</p>				

                <?php if ( $depth == 0 ) { ?>

					<p class="field-custom description description-thin"
					   style="height: auto;overflow: hidden;width: 50%;float: none;">
						<label
							for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Menu Icon (Icon Mind / Font Awesome)', 'hanata' ); ?>
							<input type="text" id="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>"
								   class="widefat edit-menu-item-custom" name="menu-item-icon[<?php echo esc_attr($item_id); ?>]"
								   placeholder="fa fa-star" value="<?php echo esc_attr( $item->icon ); ?>"/>
						</label>
					</p>
					
					<p class="field-imagemenu description description-wide">
						<label for="edit-menu-item-imagemenu-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Menu Thumbnail', 'hanata' ); ?>
						<input id="edit-menu-item-imagemenu-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-imagemenu" name="menu-item-imagemenu[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->imagemenu ); ?>" type="hidden">
						<?php if($item->imagemenu){?>
							<img class="edit-menu-item-imagemenu-<?php echo esc_attr($item_id);?>" src="<?php echo esc_url( $item->imagemenu ); ?>" style="display: block; width:60px;height:auto;">
						<?php }else{?>
							<img class="edit-menu-item-imagemenu-<?php echo esc_attr($item_id);?>" src="" style="display: none; width:60px;height:auto;">
						<?php } ?>
						<a class="bwp_upload_image_button" href="javascript:void(0);" data-image_id="edit-menu-item-imagemenu-<?php echo esc_attr($item_id);?>"><?php esc_html_e( 'Browse', 'hanata' ); ?></a>
						<a class="bwp_remove_image_button" href="javascript:void(0);" data-image_id="edit-menu-item-imagemenu-<?php echo esc_attr($item_id);?>"><?php esc_html_e( 'Remove', 'hanata' ); ?></a>
						</label>
					</p>					
                <?php } ?>				

                <?php if ( $depth >= 1 ) { ?>

                    <h4><?php esc_html_e( 'Mega Menu Column Options', 'hanata' ); ?></h4>
					<p class="field-custom description description-wide">
						<label
							for="edit-menu-menucol-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Mega Menu Columns', 'hanata' ); ?></label>
						<select class="fat" id="edit-menu-menucol-<?php echo esc_attr($item_id); ?>"
								name="menu-menucol[<?php echo esc_attr($item_id); ?>]">
							<?php for ( $i = 0; $i <= 12; $i ++ ) {
								if ( $i == $item->menucol ) {
									echo '<option selected="selected">' . esc_html($i) . '</option>';
								} else {
									echo '<option>' . esc_html($i) . '</option>';
								}
							}
							?>
						</select>
					</p>				
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-hidetitle-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Hide Title', 'hanata' ); ?>
                            <input type="checkbox" id="edit-menu-hidetitle-<?php echo esc_attr($item_id); ?>"
                                   class="edit-menu-item-custom" id="menu-hidetitle[<?php echo esc_attr($item_id); ?>]"
                                   name="menu-hidetitle[<?php echo esc_attr($item_id); ?>]"
                                   value="1" <?php echo checked( ! empty( $item->hidetitle ), 1, false ); ?> />
                        </label>
                    </p>
					
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-megatitle-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Mega Menu No Link Title', 'hanata' ); ?>
                            <input type="checkbox" id="edit-menu-megatitle-<?php echo esc_attr($item_id); ?>"
                                   class="edit-menu-item-custom" id="menu-megatitle[<?php echo esc_attr($item_id); ?>]"
                                   name="menu-megatitle[<?php echo esc_attr($item_id); ?>]"
                                   value="1" <?php echo checked( ! empty( $item->megatitle ), 1, false ); ?> />
                        </label>
                    </p>

					<p class="field-imagecontent description description-wide">
						<label for="edit-menu-item-imagecontent-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Custom HTML Image', 'hanata' ); ?>
						<input id="edit-menu-item-imagecontent-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-imagecontent" name="menu-item-imagecontent[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->imagecontent ); ?>" type="hidden">
						<?php if($item->imagecontent){?>
							<img class="edit-menu-item-imagecontent-<?php echo esc_attr($item_id);?>" src="<?php echo esc_url( $item->imagecontent ); ?>" style="display: block; width:400px;height:auto;">
						<?php }else{?>
							<img class="edit-menu-item-imagecontent-<?php echo esc_attr($item_id);?>" src="" style="display: none; width:400px;height:auto;">
						<?php } ?>
						<a class="bwp_upload_image_button" href="javascript:void(0);" data-image_id="edit-menu-item-imagecontent-<?php echo esc_attr($item_id);?>"><?php esc_html_e( 'Browse', 'hanata' ); ?></a>
						<a class="bwp_remove_image_button" href="javascript:void(0);" data-image_id="edit-menu-item-imagecontent-<?php echo esc_attr($item_id);?>"><?php esc_html_e( 'Remove', 'hanata' ); ?></a>
						</label>
					</p>
					
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-item-width-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Custom HTML Column Width (optional)', 'hanata' ); ?>
                            <input type="text" id="edit-menu-item-width-<?php echo esc_attr($item_id); ?>"
                                   class="widefat edit-menu-item-custom" name="menu-item-width[<?php echo esc_attr($item_id); ?>]"
                                   value="<?php echo esc_attr( $item->menuwidth ); ?>"/>
                        </label>
                    <p><?php esc_html_e( 'Optionally set a width here for the menu column, ideal if you want to make it wider. Numeric value (no px).', 'hanata' ); ?></p>
                    </p>

                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-item-htmlcontent-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Custom HTML Column (within Mega Menu)', 'hanata' ); ?>
                            <textarea id="edit-menu-item-htmlcontent-<?php echo esc_attr($item_id); ?>"
                                      name="menu-item-htmlcontent[<?php echo esc_attr($item_id); ?>]" cols="30"
                                      rows="4"><?php echo esc_textarea( $item->htmlcontent ); ?></textarea>
                        </label>
                    </p>

                <?php } ?>
            </div>
        	<?php
        }

        /**
         * Add custom fields to $item nav object
         * in order to be used in custom Walker
         *
         * @access      public
         * @since       1.0
         * @return      void
         */
        function hanata_mega_menu_add_custom_nav_fields( $menu_item ) {
            $menu_item->subtitle        = get_post_meta( $menu_item->ID, '_menu_item_subtitle', true );
            $menu_item->htmlcontent     = get_post_meta( $menu_item->ID, '_menu_item_htmlcontent', true );
            $menu_item->megamenu        = get_post_meta( $menu_item->ID, '_menu_megamenu', true );
            $menu_item->menucol    = get_post_meta( $menu_item->ID, '_menu_menucol', true );
            $menu_item->isfullwidth  = get_post_meta( $menu_item->ID, '_menu_is_fullwidth', true );
            $menu_item->loggedin     = get_post_meta( $menu_item->ID, '_menu_loggedin', true );
            $menu_item->loggedout    = get_post_meta( $menu_item->ID, '_menu_loggedout', true );
            $menu_item->newbadge   		= get_post_meta( $menu_item->ID, '_menu_newbadge', true );
			$menu_item->salebadge   		= get_post_meta( $menu_item->ID, '_menu_salebadge', true );
			$menu_item->hidetitle       = get_post_meta( $menu_item->ID, '_menu_hidetitle', true );
            $menu_item->megatitle       = get_post_meta( $menu_item->ID, '_menu_megatitle', true );
            $menu_item->icon        = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
            $menu_item->menuwidth       = get_post_meta( $menu_item->ID, '_menu_item_width', true );
			$menu_item->imagemenu       = get_post_meta( $menu_item->ID, '_menu_item_imagemenu', true );
			$menu_item->imagecontent      = get_post_meta( $menu_item->ID, '_menu_item_imagecontent', true );
			
            return $menu_item;
        }

        /**
         * Save menu custom fields
         *
         * @access      public
         * @since       1.0
         * @return      void
         */
        function hanata_mega_menu_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

            // Check if element is properly sent
            if ( isset( $_REQUEST['menu-item-subtitle'] ) ) {
                $subtitle_value = $_REQUEST['menu-item-subtitle'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_subtitle', $subtitle_value );
            }

            if ( isset( $_REQUEST['menu-item-icon'][ $menu_item_db_id ] ) ) {
                $menu_icon_value = $_REQUEST['menu-item-icon'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_icon', $menu_icon_value );
            }

            if ( isset( $_REQUEST['menu-item-htmlcontent'][ $menu_item_db_id ] ) ) {
                $menu_htmlcontent_value = $_REQUEST['menu-item-htmlcontent'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_htmlcontent', $menu_htmlcontent_value );
            }
			
            if ( isset( $_REQUEST['menu-item-imagemenu'][ $menu_item_db_id ] ) ) {
                $menu_imagemenu_value = $_REQUEST['menu-item-imagemenu'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_imagemenu', $menu_imagemenu_value );
            }			

            if ( isset( $_REQUEST['menu-megamenu'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_megamenu', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_megamenu', 0 );
            }

            if ( isset( $_REQUEST['menu-menucol'][ $menu_item_db_id ] ) ) {
                $menucol_value = $_REQUEST['menu-menucol'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_menucol', $menucol_value );
            }

            if ( isset( $_REQUEST['menu-is-fullwidth'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_is_fullwidth', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_is_fullwidth', 0 );
            }

            if ( isset( $_REQUEST['menu-loggedin'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_loggedin', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_loggedin', 0 );
            }

            if ( isset( $_REQUEST['menu-loggedout'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_loggedout', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_loggedout', 0 );
            }

            if ( isset( $_REQUEST['menu-newbadge'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_newbadge', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_newbadge', 0 );
            }
			
            if ( isset( $_REQUEST['menu-salebadge'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_salebadge', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_salebadge', 0 );
            }
			
            if ( isset( $_REQUEST['menu-hidetitle'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_hidetitle', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_hidetitle', 0 );
            }			

            if ( isset( $_REQUEST['menu-megatitle'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_megatitle', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_megatitle', 0 );
            }
			
            if ( isset( $_REQUEST['menu-item-imagecontent'][ $menu_item_db_id ] ) ) {
                $menu_image_value = $_REQUEST['menu-item-imagecontent'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_imagecontent', $menu_image_value );
            }
			
            if ( isset( $_REQUEST['menu-item-width'][ $menu_item_db_id ] ) ) {
                $menu_width_value = $_REQUEST['menu-item-width'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_width', $menu_width_value );
            }

        }

        /**
         * Define new Walker edit
         *
         * @access      public
         * @since       1.0
         * @return      void
         */
        function hanata_mega_menu_edit_walker( $walker, $menu_id ) {

            return 'Walker_Nav_Menu_Edit_Custom';

        }

    }

    $GLOBALS['hanata_mega_menu'] = new hanata_mega_menu();

?>