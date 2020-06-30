
<div class="fade modal pg-show-modal" id="issue_modal" tabindex="-1" role="dialog" aria-labelledby="issue_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <?php $mailer = new PG_Issue_Form_Mailer(); ?>
    <?php $mailer->process( array(
            'form_id' => 'issue_form_mailer_id',
            'send_to_email' => true,
            'save_to_post_type' => true,
            'post_type' => 'article',
            'captcha' => false,
            'captcha_key' => get_theme_mod( 'captcha_key' ),
            'captcha_secret' => get_theme_mod( 'captcha_secret' )
    ) ); ?>
    <?php if( !$mailer->processed || $mailer->error) : ?>
    <form action="#" method="post" onsubmit="event.stopImmediatePropagation();event.stopPropagation();">

        <div class="modal-content" id="issue_form_mailer_id">
            <div class="modal-header">
                <h5 class="modal-title" id="issue_modallabel"><?php _e( 'New Spin Issue Submission', 'mediaspintheme' ); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="issue_title" class="form-control-label">
                        <?php _e( 'Title of the Issue or Incident (phrased simply and objectively)', 'mediaspintheme' ); ?>
                    </label>
                    <input type="text" class="form-control" id="issue_title" name="issue_title" placeholder="e.g. Criticisms of Candidate ABC" required>
                </div>
    <!--           <div class="form-group">
                    <label for="issue_date" class="form-control-label">
                        Date that the Issue or Incident took place or was first reported
                    </label>
                    <input type="text" class="form-control" id="issue_date" name="issue_date" placeholder="29/06/2020" required>
                </div>
    --> 
                <div class="form-group">
                    <label for="message-text" class="form-control-label">
                        <?php _e( 'Link to news article (not social media or forum post) that spins it:', 'mediaspintheme' ); ?>
                    </label>
                    <input type="text" class="form-control" id="article1" required placeholder="https://linkhere.com (do not post social media or forum links)" name="article1" value="<?php echo ( isset( $_POST['article1'] ) ? $_POST['article1'] : '' ); ?>">
                </div>
                 
                <div class="g-recaptcha" style="margin:10px 0;" data-sitekey="<?php echo get_theme_mod( 'captcha_key' ) ?>"></div>
                <input type="hidden" name="issue_form_mailer_id" value="1"/>
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
    <?php endif; ?>
    <?php if( $mailer->processed ) : ?>
        <?php echo '<script>alert("'. $mailer->message. '");</script>'; ?>
    <?php endif; ?>   
    </div>
</div>
