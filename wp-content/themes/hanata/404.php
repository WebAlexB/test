<?php 
	get_header(); 
	$hanata_settings = hanata_global_settings();
	$background = hanata_get_config('background');
	$bgs = isset($hanata_settings['img-404']['url']) && $hanata_settings['img-404']['url'] ? $hanata_settings['img-404']['url'] : "";
?>
<div class="container">
	<div class="img-404">
		<?php if($bgs){ ?>
			<img src="<?php echo esc_url($bgs); ?>" alt="<?php echo esc_attr__('Image 404','hanata'); ?>">
		<?php }else{ ?>
			<img src="<?php echo esc_url(get_template_directory_uri().'/images/image_404.png'); ?>" alt="<?php echo esc_attr__('Image 404','hanata'); ?>" >							
		<?php } ?>	
	</div>
	<div class="content-page-404">
		<div class="title-error"><?php echo isset($hanata_settings['title-error']) ? $hanata_settings['title-error'] : esc_html__('page not found', 'hanata'); ?></div>
		<div class="text-error"><?php echo isset($hanata_settings['text-error']) ? $hanata_settings['text-error'] : esc_html__('Sorry but we couldn’t find the page you are looking for.', 'hanata'); ?></div>
		<div class="sub-error"><?php echo isset($hanata_settings['sub-error']) ? $hanata_settings['sub-error'] : esc_html__('If difficulties persist, please contact the System Administrator of this site and report the error below...', 'hanata'); ?></div>
		<a class="btn" href="<?php echo esc_url( home_url('/') ); ?>"><?php echo isset($hanata_settings['btn-error']) ? esc_html($hanata_settings['btn-error']) : esc_html__('home page', 'hanata'); ?></a>	
	</div> 
</div>
<?php
get_footer();