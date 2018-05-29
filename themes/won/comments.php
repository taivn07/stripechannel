<?php if (post_password_required()) return; ?>

<section class="section-comment">
        <?php if (have_comments()) { ?>

            <h2 class="ui-title-type-1"><?php comments_number( esc_html__('0 Comments', 'won'), esc_html__( 'The Comment (1)', 'won' ), esc_html__( 'The Comments (%)', 'won' ) ); ?></h2>
        
            <ul class="comments-list list-unstyled">
                <?php wp_list_comments('callback=won_theme_comment'); ?>
            </ul>
            <?php
            // Are there comments to navigate through?

            if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                <footer class="navigation comment-navigation" role="navigation">
                    <div class="nav_comment_text"><?php esc_html_e( 'Comment navigation', 'won' ); ?></div>
                    <div class="previous"><?php previous_comments_link(__('&larr; Older Comments', 'won')); ?></div>
                    <div class="next right"><?php next_comments_link(__('Newer Comments &rarr;', 'won')); ?></div>
                </footer><!-- .comment-navigation -->
            <?php endif; // Check for comment navigation ?>

            <?php if (!comments_open() && get_comments_number()) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'won' ); ?></p>
            <?php endif; ?>
            
        <?php } ?>
</section>

<section class="section-reply-form" id="comments">
    
    <?php

        $aria_req = ($req ? " aria-required='true'" : '');
        $comment_args = array(
            'title_reply' => wp_kses('<h2 class="ui-title-type-1">' . esc_html__( 'Leave a reply', 'won' ) . '</h2>', true),
            'fields' => apply_filters('comment_form_default_fields', array(
                'author' => '<div class="row"><div class="col-md-6"><input type="text" name="author" value="' . esc_attr($commenter['comment_author']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. esc_html__('Name','won') .'" /></div>',
                'email' => '<div class="col-md-6"><input type="text" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. esc_html__('Email','won') .'" /></div></div>',
                
            )),
            'comment_field' => '<div class="row"><div class="col-md-12 ">                               
                                        <textarea class="form-control" rows="7" name="comment" placeholder="'. esc_html__('Your Comment ...','won') .'"></textarea>
                                </div></div>',
            'label_submit' => esc_html__('Submit Comment','won'),
            'comment_notes_before' => '',
            'comment_notes_after' => '',
        );
        ?>

        <?php global $post; ?>
        <?php if ('open' == $post->comment_status) { ?>
            <div class="commentform">
                        <?php comment_form($comment_args); ?>
            </div>
        <?php } ?>



