    
   <?php if ( geekfolio_option( 'geekfolio_mode_switcher' ) =="on") { ?>
                        
    <!-- Dark mode switcher -->
    <div class="geekfolio-mode-switcher cursor-as-pointer d-none d-md-flex"> <!-- hidden-xs hidden-sm -->
        <div class="geekfolio-mode-switcher-item dark"><p class="geekfolio-mode-switcher-item-state"><?php echo esc_html('Dark') ?></p></div>
        <div class="geekfolio-mode-switcher-item auto"><p class="geekfolio-mode-switcher-item-state"><?php echo esc_html('Auto') ?></p></div>
        <div class="geekfolio-mode-switcher-item light"><p class="geekfolio-mode-switcher-item-state"><?php echo esc_html('Light') ?></p></div>
        <div class="geekfolio-mode-switcher-toddler">
            <div class="geekfolio-mode-switcher-toddler-wrap">
                <div class="geekfolio-mode-switcher-toddler-item dark"><p class="geekfolio-mode-switcher-item-state"><?php echo esc_html('Dark') ?></p></div>
                <div class="geekfolio-mode-switcher-toddler-item auto"><p class="geekfolio-mode-switcher-item-state"><?php echo esc_html('Auto') ?></p></div>
                <div class="geekfolio-mode-switcher-toddler-item light"><p class="geekfolio-mode-switcher-item-state"><?php echo esc_html('Light') ?></p></div>
            </div>
        </div>
     </div>
     <?php }?>
 