<div class="card-footer">
    <div style="margin-top: 10px;padding:5px"> 
        <label><?php _e( 'How biased do you think this article and headline are?', 'mediaspintheme' ); ?>
        </label>        
        <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
    </div>
     
</div>      