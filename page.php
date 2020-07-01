<?php get_header( 'jumbotron4' ); ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<?php get_template_part( 'jumbotron' ); ?>  

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div>
            <h3 class="font-weight-bold text-primary"><?php the_title(); ?></h3>
            <small class="font-weight-lighter small text-muted text-right"><?php the_time( get_option( 'date_format' ) ); ?></small>
            <hr class="clearfix float-none"> 
            <p><?php the_content(); ?> </p>
            <p> Have you ever noticed how different media sources report about the same issue differently? </p>

<p> If PM Lee goes for a walk in the park, a mainstream media source might report it as “PM Lee leads the fight against diabetes by taking walks”, while an alternative media source might choose a more sensational headline such as “EXPOSED: PM Lee’s private life in pictures”. The way media sources spin an issue can shape our views, so at <a href="https://better.sg">better.sg</a> (a techforgood collective), we decided to build this tool, SG Media Spin, to help you compare spins from various sources at a glance. <br/> SG Media Spin lets you catalogue a new issue that is trending online, or contribute links to other issues that are already on our page. That way, everyone can clearly see the reporting style of each source, to form a more comprehensive picture of an issue in our minds. </p>

<p class="text-primary font-weight-bold">SG Media Spin is an independent, non-profit, and non-partisan effort, where the only aim is to help Singaporeans consume information more critically.</p>
<small>The content on this site is all user-submitted with only minimal moderation. We do not condone or endorse any of the articles that are posted here by users, as the primary purpose of this site is to allow users to understand the contrast and biases of various news agencies.</small>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-sm-3 pg-empty-placeholder">
            <?php comments_template(); ?>
        </div>
    </div>
    <hr>
    <footer>
        <p class="text-center">&copy; <a href="https://better.sg" target="_blank"><?php _e( 'Better.sg', 'mediaspintheme' ); ?></a> <?php _e( '2020', 'mediaspintheme' ); ?></p>
    </footer>
</div>        
<a class="btn btn-secondary floatingbtn" href="<?php echo esc_url( home_url() ); ?>"> <i class="fa-fw fa-home fa-lg fas  text-center" style="padding-top: 15px;"></i></a>
<?php get_footer( 'jumbotron4' ); ?>