<?php 
$show_page_heading = get_post_meta(won_get_current_id(), "won_met_page_heading", true)?get_post_meta(won_get_current_id(), "won_met_page_heading", true):'yes';
 ?>
<?php if($show_page_heading == 'yes'){ ?>
    <h2 class="post-title">
    	<a href="<?php esc_url(the_permalink());?>" title="<?php the_title();?>">
    		<?php the_title();?>
    	</a>
    </h2>
<?php } ?>

<?php 
	the_content();
?>
<div class="page-link">
<?php 
wp_link_pages();
 ?>
 </div>
