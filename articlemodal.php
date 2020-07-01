<?php if( $mailer->processed ) : ?>
    <?php echo '<script>alert("'. $mailer->message. '");</script>'  ?>
<?php endif; ?>   

    <div class="fade modal pg-show-modal" id="article_modal" tabindex="-1" role="dialog" aria-labelledby="article_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?php $mailer = new PG_Article_Form_Mailer(); ?>
        <?php $mailer->process( array(
                'form_id' => 'article_form_mailer_id',
                'send_to_email' => true,
                'save_to_post_type' => true,
                'post_type' => 'article',
                'captcha' => true,
                'captcha_key' => get_theme_mod( 'captcha_key' ),
                'captcha_secret' => get_theme_mod( 'captcha_secret' )
        ) ); ?>
        
        <form action="#" class="wordpress-ajax-form" method="post" onsubmit="event.stopImmediatePropagation();event.stopPropagation();">

        <div class="modal-content" id="article_form_mailer_id">
            <div class="modal-header">
                <h5 class="modal-title" id="article_modallabel"><?php _e( 'New Article Submission for Current Issue', 'mediaspintheme' ); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php global $post;   ?>
                <input type="hidden" placeholder="CurrentIssue" name="issue" value="<?php echo $post->ID; ?>"></input>
                <div class="form-group">
                    <label for="message-text" class="form-control-label">
                        <?php _e( 'Link to news article (not social media or forum post) that spins it:', 'mediaspintheme' ); ?>
                    </label>
                    <input type="text" class="form-control" id="article1" required placeholder="https://linkhere.com (do not post social media or forum links)" name="article1" value="<?php echo ( isset( $_POST['article1'] ) ? $_POST['article1'] : '' ); ?>">
                </div>
                 
                <div class="g-recaptcha" style="margin:10px 0;" data-sitekey="<?php echo get_theme_mod( 'captcha_key' ) ?>"></div>
                <input type="hidden" name="article_form_mailer_id" value="1"/>
                  
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
        </form>
            
        
       
    </div>
</div>

