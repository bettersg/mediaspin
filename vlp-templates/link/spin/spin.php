<div class="list-group-item list-group-item-action vlp"> 
	<a href="<?php echo $link->output_url(); ?>" target="_blank" >
		<div class="bg-dark card text-white">
			<?php if ( $link->image_id() ) : ?><?php echo $link->image( $size ); ?> <?php endif; // Image ID. ?>
			
				<div class="card-img-overlay" style="background: -webkit-linear-gradient(top, rgba(51, 124, 246, 0.9) 0%, rgba(228, 229, 230, 0.6) 100%); overflow:hidden;">
					<p class="card-text float-right" style="color: #000000;"><?php the_time( get_option( 'date_format' ) ); ?></p>
					<h4 class="card-title" style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.8);"><?php echo get_field( 'media_agency' ); ?></h4>
					<?php if ( $link->title() ) : ?><h5 class="text-uppercase" style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.8);"><?php echo wp_kses_post( $link->title() ); ?></h5><?php endif; // Title. ?>
					<?php if ( $link->summary() ) : ?><p class="card-text" style="line-height: 1rem; font-size: 1rem; color: #000000;"><?php echo wp_kses_post( $link->summary() ); ?></p><?php endif; // Summary. ?>
				</div>
			
		</div> 
	</a>
	<?php get_template_part( 'ratingstemplate' ); ?> 
</div>



