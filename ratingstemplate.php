<div class="align-content-end card-footer"  >
    <div style="margin-top: 10px"> 
        <label><?php _e( 'How biased is this article?', 'mediaspintheme' ); ?>
        </label>        
        <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
    </div>     
</div>      
