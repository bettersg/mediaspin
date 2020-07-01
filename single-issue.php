<?php get_header(); ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<?php get_template_part( 'jumbotron' ); ?>  

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
       
            <div class="col-md-7">
                <h3><?php _e( 'Current Spin', 'mediaspintheme' ); ?></h3>
                <hr/>
                    <div <?php post_class( 'bg-light clearfix headline' ); ?> id="post-<?php the_ID(); ?>">
                        <span class="justify-content-between"> <h2 class="float-left text-primary"><?php the_title(); ?></h2><small class="float-right pull-right text-right"><?php the_time( get_option( 'date_format' ) ); ?></small> </span>
                    </div>

<?php get_template_part( 'articlemodal' ); ?>  

                    
                <?php
                    $linked_articles_query_args = array(
                        'post__in' => PG_Helper::getRelationshipFieldValue( 'linked_articles' ) ?: array(''),
                        'post_type' => 'any',
                        'post_status' => 'any',
                        'posts_per_page' => -1,
                        'ignore_sticky_posts' => true,
                        'orderby' => 'post__in'
                    )
                ?>
                <?php $linked_articles_query = new WP_Query( $linked_articles_query_args ); ?>
                <?php if ( $linked_articles_query->have_posts() ) : ?>
                    <?php while ( $linked_articles_query->have_posts() ) : $linked_articles_query->the_post(); ?>
                        <?php PG_Helper::rememberShownPost(); ?>
                        <div <?php post_class( 'list-group' ); ?> id="post-<?php the_ID(); ?>">
                            <div class="list-group-item list-group-item-action" style="padding-top: 2rem;"> 
                                <div class="d-flex w-100 justify-content-between">
                                    <h4 class="mb-1"><?php echo get_field( 'media_agency' ); ?></h4>
                                    <small><?php the_time( get_option( 'date_format' ) ); ?></small>
                                </div>                                         
                                <h6 class="text-uppercase"></h6>
                                <?php the_content(); ?>
                                <div class="clearfix"></div>
                                
                                <?php get_template_part( 'ratingstemplate' ); ?>                                          
                                
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                 
                <div class="text-center">
                    <a class="btn btn-lg btn-warning ml-auto mr-auto" href="#" role="button" data-toggle="modal" data-target="#article_modal" style="text-transform: uppercase; margin: 1rem auto 2rem;"><?php _e( 'Add another article', 'mediaspintheme' ); ?> <i class="fa-lg fa-plus-circle fas text-primary"></i></a>
                </div>
            </div>
        <?php else : ?>
            <p><?php _e( 'Sorry, no posts matched your criteria.', 'mediaspintheme' ); ?></p>
        <?php endif; ?>
        <?php
            $issue_query_args = array(
                'post_type' => 'issue',
                'nopaging' => true,
                'order' => 'DESC',
                'orderby' => 'date'
            )
        ?>
        <?php $issue_query = new WP_Query( $issue_query_args ); ?>
        <div class="col-md-4 offset-md-1">
            <h3><?php _e( 'List of All Spins', 'mediaspintheme' ); ?></h3>
            <hr/>
            <a class="btn btn-block btn-lg btn-warning" href="#" role="button" data-toggle="modal" data-target="#issue_modal" style="text-transform: uppercase; margin-top: 1rem; margin-bottom: 2rem;"><?php _e( 'Add an Issue', 'mediaspintheme' ); ?> <i class="fa-lg fa-plus-circle fas text-primary"></i></a> 
            <p><?php _e( 'These are the issues that users have submitted thus far.&nbsp;', 'mediaspintheme' ); ?></p>
            <table class="table"> 
                <thead> 
                    <tr> 
                        <th><?php _e( 'Issue', 'mediaspintheme' ); ?></th> 
                        <th><?php _e( 'Spins (#)', 'mediaspintheme' ); ?></th> 
                    </tr>                             
                </thead>                         
                <?php if ( $issue_query->have_posts() ) : ?>
                    <?php while ( $issue_query->have_posts() ) : $issue_query->the_post(); ?>
                        <?php PG_Helper::rememberShownPost(); ?>
                        <tbody <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                            <tr> 
                                <td><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></td> 
                                <td><?php echo count(get_field('linked_articles')) ?></td> 
                            </tr>                                     
                        </tbody>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'mediaspintheme' ); ?></p>
                <?php endif; ?> 
            </table>                     
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="pg-empty-placeholder">
            <?php comments_template(); ?>
        </div>
    </div>
    <hr>
    <a class="btn btn-secondary floatingbtn" href="<?php echo esc_url( home_url() ); ?>"> <i class="fa-fw fa-home fa-lg fas  text-center" style="padding-top: 15px;"></i></a>
    <footer>
        <p class="text-center">&copy; <a href="https://better.sg" target="_blank"><?php _e( 'Better.sg', 'mediaspintheme' ); ?></a> <?php _e( '2020', 'mediaspintheme' ); ?></p>
    </footer>
</div>        
<a class="btn btn-secondary floatingbtn" href="<?php echo esc_url( home_url() ); ?>"> <i class="fa-fw fa-home fa-lg fas  text-center" style="padding-top: 15px;"></i></a>

<?php get_template_part( 'issuemodal' ); ?>
 

<?php get_footer( ); ?>