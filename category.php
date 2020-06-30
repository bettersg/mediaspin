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
        <a class="btn btn-primary" href="#" role="button"><?php _e( 'Learn more »', 'mediaspintheme' ); ?></a>
    </div>
</div>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <?php if ( have_posts() ) : ?>
            <div <?php post_class( 'col-md-7' ); ?> id="post-<?php the_ID(); ?>">
                <h3><?php _e( 'Current Spin', 'mediaspintheme' ); ?></h3>
                <hr/>
                <div class="bg-light clearfix headline">
                    <span class="justify-content-between"> <?php $terms = get_the_terms( get_the_ID(), 'category' ) ?><?php if( !empty( $terms ) ) : ?><?php $term_i = 0; ?><?php foreach( $terms as $term ) : ?><?php if( $term_i == 0 ) : ?><h2 class="float-left text-primary"><?php echo $term->name; ?></h2><?php endif; ?><?php $term_i++; ?><?php endforeach; ?><?php endif; ?> </span>
                </div>
                <div class="list-group">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php PG_Helper::rememberShownPost(); ?>
                        <div style="padding-top: 2rem;" <?php post_class( 'list-group-item list-group-item-action' ); ?> id="post-<?php the_ID(); ?>"> 
                            <div class="d-flex w-100 justify-content-between">
                                <h4 class="mb-1"><?php echo get_field( 'media_agency' ); ?></h4>
                                <small><?php the_time( get_option( 'date_format' ) ); ?></small>
                            </div>                                     
                            <?php echo PG_Image::getPostImage( null, 'medium', array(
                                    'class' => 'article_image img-fluid rounded-lg',
                                    'sizes' => 'max-width(320px) 27vw, max-width(640px) 165px, max-width(768px) 23vw, max-width(1024px) 17vw, max-width(1280px) 206px, 206px',
                                    'style' => 'margin-bottom: 0.5rem;'
                            ), 'both', null ) ?>
                            <h6 class="text-uppercase"><a href="<?php echo esc_url( get_field( 'article_link' ) ); ?>"></a></h6>
                            <p class="mb-1 card-text"><?php the_content(); ?></p>
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
                    <?php endwhile; ?>
                </div>
                <button type="submit" class="border-dark btn btn-block btn-outline-dark btn-primary font-weight-bold mt-2 text-light text-uppercase">
                    <?php _e( 'SUBMIT SURVEY', 'mediaspintheme' ); ?>
                </button>
                <div class="text-center">
                    <a class="btn btn-lg btn-warning ml-auto mr-auto" href="#" role="button" data-toggle="modal" data-target="#article_modal" style="text-transform: uppercase; margin: 1rem auto 2rem;"><?php _e( 'Add another article', 'mediaspintheme' ); ?> <i class="fa-lg fa-plus-circle fas text-primary"></i></a>
                </div>
                <a class="border border-primary btn btn-block btn-light btn-outline-dark text-primary text-uppercase" href="<?php echo esc_url( get_category_link( PG_Helper::getTermFromSlug( '3', 'category' ) ) ); ?>" style="margin-bottom: 3rem; margin-top: 2rem;"><?php _e( 'Go to next Spin >>', 'mediaspintheme' ); ?></a>
            </div>
        <?php else : ?>
            <p><?php _e( 'Sorry, no posts matched your criteria.', 'mediaspintheme' ); ?></p>
        <?php endif; ?>
        <div class="col-md-4 offset-md-1">
            <h3><?php _e( 'List of All Spins', 'mediaspintheme' ); ?></h3>
            <hr/>
            <a class="btn btn-block btn-lg btn-warning" href="#" role="button" data-toggle="modal" data-target="#issue_modal" style="text-transform: uppercase; margin-top: 1rem; margin-bottom: 2rem;"><?php _e( 'Add an Issue', 'mediaspintheme' ); ?> <i class="fa-lg fa-plus-circle fas text-primary"></i></a> 
            <p><?php _e( 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', 'mediaspintheme' ); ?></p>
            <table class="table"> 
                <thead> 
                    <tr> 
                        <th><?php _e( 'Issue', 'mediaspintheme' ); ?></th> 
                        <th><?php _e( 'Spins (#)', 'mediaspintheme' ); ?></th> 
                    </tr>                             
                </thead>                         
                <?php $terms = get_terms( array(
                        'taxonomy' => 'category',
                        'orderby' => 'id',
                        'order' => 'DESC',
                        'hide_empty' => true
                ) ) ?>
                <?php if( !empty( $terms ) ) : ?>
                    <tbody> 
                        <?php foreach( $terms as $term ) : ?>
                            <tr> 
                                <td><?php echo $term->name; ?></td> 
                                <td><?php echo $term->count; ?></td> 
                            </tr>
                        <?php endforeach; ?>                                                                   
                    </tbody>
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
    <footer>
        <p class="text-center">&copy; <a href="https://better.sg" target="_blank"><?php _e( 'Better.sg', 'mediaspintheme' ); ?></a> <?php _e( '2020', 'mediaspintheme' ); ?></p>
    </footer>
</div>        

<?php get_footer( 'jumbotron4' ); ?>