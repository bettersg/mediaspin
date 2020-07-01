<div href="#" class="list-group-item list-group-item-action"> 
	<div class="bg-dark card text-white">
		<?php if ( $link->image_id() ) : ?><?php echo $link->image( $size ); ?> <?php endif; // Image ID. ?>
        <div class="card-img-overlay" style="background: -webkit-linear-gradient(top, rgba(51, 124, 246, 0.9) 0%, rgba(228, 229, 230, 0.6) 100%);">
			<p class="card-text float-right" style="color: #000000;"><?php the_time( get_option( 'date_format' ) ); ?></p>
			<h4 class="card-title" style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.8);"><?php echo get_field( 'media_agency' ); ?></h4>
			<?php if ( $link->title() ) : ?><h6 class="text-uppercase" style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.8);"><?php echo wp_kses_post( $link->title() ); ?></h6><?php endif; // Title. ?>
			<?php if ( $link->summary() ) : ?><p class="card-text" style="line-height: 1rem; font-size: 1rem; color: #000000;"><?php echo wp_kses_post( $link->summary() ); ?></p><?php endif; // Summary. ?>
        </div>
	</div> 
	<?php get_template_part( 'ratingstemplate' ); ?> 
</div>



<!--  to merge this layout with the index page and this template


<div class="vlp-link-container vlp-template-default <?php // echo $link->custom_class(); ?>">

<?php // echo $link->output_url(); ?>
	<?php if ( $link->image_id() ) : ?>
	<div class="vlp-link-image-container">
		<div class="vlp-link-image">
			<?php
			$size = array( 150, 999 );

			if ( VLP_Settings::get( 'template_use_custom_style' ) ) {
				$size = VLP_Settings::get( 'custom_style_image_size' );

				preg_match( '/^(\d+)x(\d+)$/i', $size, $match );
				if ( ! empty( $match ) ) {
					$size = array( intval( $match[1] ), intval( $match[2] ) );
				}
			}

			// echo $link->image( $size );
			?>
		</div>
	</div>
	<?php endif; // Image ID. ?>
	<div class="vlp-link-text-container">
		<?php if ( $link->title() ) : ?>
		<div class="vlp-link-title">
			<?php // echo wp_kses_post( $link->title() ); ?>
		</div>
		<?php endif; // Title. ?>
		<?php if ( $link->summary() ) : ?>
		<div class="vlp-link-summary">
			<?php // echo wp_kses_post( $link->summary() ); ?>
		</div>
		<?php endif; // Summary. ?>
	</div>
</div>

-->