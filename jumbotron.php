<div class="jumbotron jumbotron-fluid" style="background-position: right top; background-size: contain; background-repeat: no-repeat; background-color: #ffffff; background-clip: border-box; background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/undraw_online_articles_79ff.png');">
    <div class="container white_tint_jumbotron">
        <h1 class="display-3 font-weight-bold text-primary titlespin"><a href="<?php echo get_home_url(); ?>"><?php echo get_theme_mod( 'page_title', __( 'SG Media Spin', 'mediaspintheme' ) ); ?></a></h1>
        <p class="font-weight-bolder"><?php echo get_theme_mod( 'page_desc', __( 'How different websites report the same thing.', 'mediaspintheme' ) ); ?></p>
        <a class="btn btn-primary memehide" href="<?php echo esc_url( get_page_link( PG_Helper::getPostFromSlug( 'about', 'page' ) ) ); ?>" role="button"><?php _e( 'Learn more »', 'mediaspintheme' ); ?></a>
    </div>
</div>