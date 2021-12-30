<?php
get_header();
//arabesque_mikado_get_title();
get_template_part( 'slider' );
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
<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();
	//Get blog single type and load proper helper
	arabesque_mikado_include_blog_helper_functions( 'singles', 'standard' );
	
	//Action added for applying module specific filters that couldn't be aparabesqued on init
	do_action( 'arabesque_mikado_action_blog_single_loaded' );
	
	//Get classes for holder and holder inner
	$mkdf_holder_params = arabesque_mikado_get_holder_params_blog();
	?>

	<div class="<?php echo esc_attr( $mkdf_holder_params['holder'] ); ?>">
		<?php do_action( 'arabesque_mikado_action_after_container_open' ); ?>
		
		<div class="<?php echo esc_attr( $mkdf_holder_params['inner'] ); ?>">
			<?php arabesque_mikado_get_blog_single( 'standard' ); ?>
		</div>
		
		<?php do_action( 'arabesque_mikado_action_before_container_close' ); ?>
	</div>
<?php endwhile; endif;

get_footer(); ?>