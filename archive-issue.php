<?php get_header( 'jumbotron4' ); ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="fade modal pg-show-modal" id="issue_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php _e( 'New Spin Issue Submission', 'mediaspintheme' ); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="issue_form_mailer_id">
                <?php $mailer = new PG_Simple_Form_Mailer(); ?>
                <?php $mailer->process( array(
                        'form_id' => 'issue_form_mailer_id',
                        'send_to_email' => true,
                        'post_type' => 'article',
                        'captcha' => true,
                        'captcha_key' => get_theme_mod( 'captcha_key' ),
                        'captcha_secret' => get_theme_mod( 'captcha_secret' )
                ) ); ?>
                <?php if( !$mailer->processed || $mailer->error) : ?>
                    <form action="<?php echo '#issue_form_mailer_id'; ?>" method="post" onsubmit="event.stopImmediatePropagation();event.stopPropagation();">
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">
                                <?php _e( 'Title of the Issue or Incident (phrased simply and objectively)', 'mediaspintheme' ); ?>
                            </label>
                            <input type="text" class="form-control" id="recipient-name" placeholder="e.g. Criticisms of Candidate ABC" required name="issue_form_mailer_id_1" value="<?php echo ( isset( $_POST['issue_form_mailer_id_1'] ) ? $_POST['issue_form_mailer_id_1'] : '' ); ?>">
                        </div>
                        <div class="form-group">
                            <label for="article1" class="form-control-label">
                                <?php _e( 'Link to Article 1 that spins it:', 'mediaspintheme' ); ?>
                            </label>
                            <input type="text" class="form-control" id="article1" required name="issue_form_mailer_id_2" value="<?php echo ( isset( $_POST['issue_form_mailer_id_2'] ) ? $_POST['issue_form_mailer_id_2'] : '' ); ?>">
                        </div>
                        <div class="form-group">
                            <label for="media-agency1" class="form-control-label">
                                <?php _e( 'Name of Media Agency', 'mediaspintheme' ); ?>
                            </label>
                            <input type="text" class="form-control" id="media-agency1" required placeholder="e.g. Straits Times, Channel NewsAsia, Mothership" name="issue_form_mailer_id_3" value="<?php echo ( isset( $_POST['issue_form_mailer_id_3'] ) ? $_POST['issue_form_mailer_id_3'] : '' ); ?>">
                        </div>
                        <div class="form-group">
                            <label for="article2" class="form-control-label">
                                <?php _e( 'Link to Article 2 that spins it differently:', 'mediaspintheme' ); ?>
                            </label>
                            <input type="text" class="form-control" id="article2" required name="issue_form_mailer_id_4" value="<?php echo ( isset( $_POST['issue_form_mailer_id_4'] ) ? $_POST['issue_form_mailer_id_4'] : '' ); ?>">
                        </div>
                        <div class="form-group">
                            <label for="media-agency2" class="form-control-label">
                                <?php _e( 'Name of Media Agency', 'mediaspintheme' ); ?>
                            </label>
                            <input type="text" class="form-control" id="media-agency2" required placeholder="e.g. Straits Times, Channel NewsAsia, Mothership" name="issue_form_mailer_id_5" value="<?php echo ( isset( $_POST['issue_form_mailer_id_5'] ) ? $_POST['issue_form_mailer_id_5'] : '' ); ?>">
                        </div>
                        <div class="g-recaptcha" style="margin:10px 0;" data-sitekey="<?php echo get_theme_mod( 'captcha_key' ) ?>"></div>
                        <input type="hidden" name="issue_form_mailer_id" value="1"/>
                    </form>
                <?php endif; ?>
                <?php if( $mailer->processed ) : ?>
                    <?php echo $mailer->message; ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <?php _e( 'Close', 'mediaspintheme' ); ?>
                </button>
                <button type="submit" class="btn btn-primary">
                    <?php _e( 'SUBMIT', 'mediaspintheme' ); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="fade modal pg-show-modal" id="article_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="article_form_mailer_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php _e( 'New Article Submission for Current Issue', 'mediaspintheme' ); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $mailer = new PG_Simple_Form_Mailer(); ?>
                <?php $mailer->process( array(
                        'form_id' => 'article_form_mailer_id',
                        'send_to_email' => true,
                        'save_to_post_type' => true,
                        'post_type' => 'article',
                        'captcha' => true,
                        'captcha_key' => get_theme_mod( 'captcha_key' ),
                        'captcha_secret' => get_theme_mod( 'captcha_secret' )
                ) ); ?>
                <?php if( !$mailer->processed || $mailer->error) : ?>
                    <form action="<?php echo '#article_form_mailer_id'; ?>" method="post" onsubmit="event.stopImmediatePropagation();event.stopPropagation();">
                        <input type="hidden" placeholder="CurrentIssue" name="article_form_mailer_id_1" value="<?php echo ( isset( $_POST['article_form_mailer_id_1'] ) ? $_POST['article_form_mailer_id_1'] : '' ); ?>"></input>
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">
                                <?php _e( 'Link to Article 1 that spins it:', 'mediaspintheme' ); ?>
                            </label>
                            <input type="text" class="form-control" id="recipient-name" required placeholder="https://linkhere.com" name="article_form_mailer_id_2" value="<?php echo ( isset( $_POST['article_form_mailer_id_2'] ) ? $_POST['article_form_mailer_id_2'] : '' ); ?>">
                        </div>
                        <div class="form-group">
                            <label for="media-agency" class="form-control-label">
                                <?php _e( 'Name of Media Agency', 'mediaspintheme' ); ?>
                            </label>
                            <input type="text" class="form-control" id="media-agency" required placeholder="e.g. Straits Times, Channel NewsAsia, Mothership" name="article_form_mailer_id_3" value="<?php echo ( isset( $_POST['article_form_mailer_id_3'] ) ? $_POST['article_form_mailer_id_3'] : '' ); ?>">
                        </div>
                        <div class="g-recaptcha" style="margin:10px 0;" data-sitekey="<?php echo get_theme_mod( 'captcha_key' ) ?>"></div>
                        <input type="hidden" name="article_form_mailer_id" value="1"/>
                    </form>
                <?php endif; ?>
                <?php if( $mailer->processed ) : ?>
                    <?php echo $mailer->message; ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <?php _e( 'Close', 'mediaspintheme' ); ?>
                </button>
                <button type="submit" class="btn btn-primary">
                    <?php _e( 'SUBMIT', 'mediaspintheme' ); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="jumbotron jumbotron-fluid" style="background-position: right top; background-size: contain; background-repeat: no-repeat; background-color: #ffffff; background-clip: border-box; background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/undraw_online_articles_79ff.png');">
    <div class="container white_tint_jumbotron">
        <h1 class="display-3 font-weight-bold text-primary titlespin"><?php echo get_theme_mod( 'page_title', __( 'SG Media Spin', 'mediaspintheme' ) ); ?></h1>
        <p class="font-weight-bolder"><?php echo get_theme_mod( 'page_desc', __( 'How different websites report the same thing.', 'mediaspintheme' ) ); ?></p>
        <a class="btn btn-primary" href="<?php echo esc_url( get_page_link( PG_Helper::getPostFromSlug( 'about', 'page' ) ) ); ?>" role="button"><?php _e( 'Learn more »', 'mediaspintheme' ); ?></a>
    </div>
</div>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <?php
            $issue_query_args = array(
                'post_type' => 'issue',
                'posts_per_page' => 1,
                'paged' => get_query_var( 'paged' ) ?: 1,
                'order' => 'DESC',
                'orderby' => 'date'
            )
        ?>
        <?php $issue_query = new WP_Query( $issue_query_args ); ?>
        <?php if ( $issue_query->have_posts() ) : ?>
            <div class="col-md-7">
                <h3><?php _e( 'Current Spin', 'mediaspintheme' ); ?></h3>
                <hr/>
                <?php while ( $issue_query->have_posts() ) : $issue_query->the_post(); ?>
                    <?php PG_Helper::rememberShownPost(); ?>
                    <div <?php post_class( 'bg-light clearfix headline' ); ?> id="post-<?php the_ID(); ?>">
                        <span class="justify-content-between"> <h2 class="float-left text-primary"><?php the_title(); ?></h2><small class="float-right pull-right text-right"><?php the_time( get_option( 'date_format' ) ); ?></small> </span>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
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
                                <div class="card-footer">
                                    <div style="margin-top: 15px;"> 
                                        <label>
                                            <?php _e( 'How biased do you think this article and headline are?', 'mediaspintheme' ); ?>
                                        </label>
                                        <div class="btn-group btn-group-sm d-flex text-center" role="group" aria-label="Small button group">
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Very Negative', 'mediaspintheme' ); ?>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Slightly -', 'mediaspintheme' ); ?>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Neutral', 'mediaspintheme' ); ?>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Slightly +', 'mediaspintheme' ); ?>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Very Positive', 'mediaspintheme' ); ?>
                                            </button>
                                        </div>
                                    </div>
                                    <div style="margin-top: 15px;"> 
                                        <label>
                                            <?php _e( 'How much would you trust this article?', 'mediaspintheme' ); ?>
                                        </label>
                                        <div class="btn-group btn-group-sm d-flex text-center" role="group" aria-label="Small button group">
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Not at all', 'mediaspintheme' ); ?>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Slightly', 'mediaspintheme' ); ?> 
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Moderately', 'mediaspintheme' ); ?>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Quite a lot', 'mediaspintheme' ); ?>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-vote">
                                                <?php _e( 'Totally', 'mediaspintheme' ); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>                                         
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'mediaspintheme' ); ?></p>
                <?php endif; ?>
                <button type="submit" class="border-dark btn btn-block btn-outline-dark btn-primary font-weight-bold mt-2 text-light text-uppercase">
                    <?php _e( 'SUBMIT SURVEY', 'mediaspintheme' ); ?>
                </button>
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
<?php get_footer( 'jumbotron4' ); ?>