<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<?php get_template_part( 'jumbotron' ); ?>  

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div>
        <?php while ( have_posts() ) : the_post(); ?>        
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                                
            <header class="entry-header"><h3 class="font-weight-bold text-primary"><?php the_title(); ?></h3></header>
            <small class="font-weight-lighter small text-muted text-right"><?php the_time( get_option( 'date_format' ) ); ?></small>
            <hr class="clearfix float-none"> 
         
                <div class="entry-content container row">
                    <div class="col-md-7">
                        <?php
                            the_content();
                            
                        ?>
                    </div>
                    <div class="col-md-4 offset-md-1 ">
                        <?php comments_template(); ?>
                    </div>
                </div><!-- .entry-content -->
            </article><!-- #post-## -->

        <?php endwhile; // End of the loop. ?>         


        </div>
    </div>
 
    <hr>
    <footer>
        <p class="text-center">&copy; <a href="https://better.sg" target="_blank"><?php _e( 'Better.sg', 'mediaspintheme' ); ?></a> <?php _e( '2020', 'mediaspintheme' ); ?></p>
    </footer>
</div>        
<a class="btn btn-secondary floatingbtn" href="<?php echo esc_url( home_url() ); ?>"> <i class="fa-fw fa-home fa-lg fas  text-center" style="padding-top: 15px;"></i></a>
<?php get_footer( 'jumbotron4' ); ?>