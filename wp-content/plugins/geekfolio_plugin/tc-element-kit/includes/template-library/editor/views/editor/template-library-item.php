<?php
/**
 * Template item
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<# var proLink = window.ElementKitLibreryData.license.link; #>
<# var isActivated = window.ElementKitLibreryData.license.activated; #>
<# var newDemoRateDate = window.ElementKitLibreryData.new_demo_rang_date; #>

<div class="elementor-template-library-template-body">
	<div class="elementor-template-library-template-screenshot">
		<div class="elementor-template-library-template-preview">
			<i class="fa fa-search-plus"></i>
		</div>
		<img src="{{ thumbnail }}" alt="">
	</div>
    <# if ( newDemoRateDate < date ) { #>
    <span class="tc-new-item">NEW</span>
    <# } #>
    <# if ( 1 == is_pro ) { #>
    <span class="tc-pro-item">PRO</span>
    <# } #>
</div>
<div class="elementor-template-library-template-controls">
    <# if ( 1 != is_pro ) { #>
        <?php include('tc-template-library-item-import-btn.php'); ?>
    <# } else { #>
        <# if(isActivated) { #>
            <?php include('tc-template-library-item-import-btn.php'); ?>
        <# } else { #>
            <a class="elementor-template-library-template-action elementor-button tc-elementkit-template-library-template-go-pro" href="{{ proLink }}" target="_blank">
                <i class="eicon-heart"></i><span class="elementor-button-title"><?php
                    esc_html_e( 'Get Pro', 'tc-element-kit' );
                ?></span>
            </a>
	    <# } #>
	<# } #>

</div>
<div class="elementor-template-library-template-name">{{ title }}</div>