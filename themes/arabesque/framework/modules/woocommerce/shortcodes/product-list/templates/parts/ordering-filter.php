<?php if($show_ordering_filter == 'yes'){ ?>
<div class="mkdf-pl-ordering-outer">
    <div class="mkdf-pl-ordering-holder">
        <h6 class="mkdf-pl-ordering-filter-title"><?php esc_html_e('Filter','arabesque'); ?></h6>
        <div class="mkdf-pl-ordering">
            <div class="mkdf-pl-ordering-inner">
                <h5 class="mkdf-pl-ordering-title"><?php esc_html_e('Sort By','arabesque'); ?></h5>
                <ul>
                    <?php echo arabesque_mikado_get_module_part( $this_object->getProductOrderingList($params) ); ?>
                </ul>
            </div>
            <div class="mkdf-pl-ordering-inner">
                <h5 class="mkdf-pl-ordering-title"><?php esc_html_e('Price Range','arabesque'); ?></h5>
                <ul class="mkdf-pl-ordering-price">
                    <?php echo arabesque_mikado_get_module_part( $this_object->getProductPricingList($params) ); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php } ?>