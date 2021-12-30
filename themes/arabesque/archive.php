<?php
$mkdf_blog_type = arabesque_mikado_get_archive_blog_list_layout();
arabesque_mikado_include_blog_helper_functions( 'lists', $mkdf_blog_type );
$mkdf_holder_params = arabesque_mikado_get_holder_params_blog();

get_header();
//arabesque_mikado_get_title();
do_action('arabesque_mikado_action_before_main_content');
?>
<div class="mkdf-title-holder mkdf-centered-type mkdf-title-va-header-bottom mkdf-title-content-va-middle publication-search-section" style="height: 132px;background-color: #f4f4f4" data-height="132">
		<div class="mkdf-title-wrapper" style="height: 132px">
		<div class="mkdf-title-inner">
			<div class="mkdf-grid">
			<div class="mkdf-grid-row">
				<!--<div class="mkdf-grid-col-7">
					<h2 class="mkdf-page-title entry-title pb-title text-left pd-top-15">DSS News and Publications</h2>
				</div>-->
				<div class="mkdf-grid-col-9">
					<div class="pb-search">
					<?php include('searchform-news.php'); ?>
					</div>
				</div>
				</div>
			</div>
	    </div>
	</div>
</div>
<div class="<?php echo esc_attr( $mkdf_holder_params['holder'] ); ?>">
	<?php do_action( 'arabesque_mikado_action_after_container_open' ); ?>
	
	<div class="<?php echo esc_attr( $mkdf_holder_params['inner'] ); ?>">
		<?php arabesque_mikado_get_blog( $mkdf_blog_type ); ?>
	</div>
	
	<?php do_action( 'arabesque_mikado_action_before_container_close' ); ?>
</div>

<?php do_action( 'arabesque_mikado_action_blog_list_additional_tags' ); ?>
<?php get_footer(); ?>