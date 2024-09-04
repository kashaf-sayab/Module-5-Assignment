<!-- Template for displaying comments and the comment form -->

<div id="comments" class="comments-area">

    <!-- Comments Title -->
    <h2 class="comments-title">Comments</h2>
    <hr class="comments-divider">

    <?php if (have_comments()) : ?>
        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ul',
                'short_ping' => true,
                'callback'   => 'custom_comment_callback',
            ));
            ?>
        </ul>

        <?php
        if (get_comment_pages_count() > 1 && get_option('page_comments')) :
            ?>
            <nav class="comment-navigation">
                <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'blog-theme'); ?></h2>
                <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments', 'blog-theme')); ?></div>
                <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'blog-theme')); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; // Check for have_comments() ?>

    <?php if (comments_open()) : ?>
        <section class="post-comments">
            <h2 class="post-comments-title">Post Your Comment</h2>
            <hr class="comments-divider">

            <?php
            comment_form(array(
                'title_reply' => '',
                'comment_field' => '<textarea id="comment" name="comment" rows="5" placeholder="Your Comment..." required></textarea>',
                'fields' => array(
                    'author' => '<p class="comment-form-author">
                                    <label for="author">Name <span class="required">*</span></label>
                                    <input id="author" name="author" type="text" placeholder="Your Name" required />
                                </p>',
                    'email'  => '<p class="comment-form-email">
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input id="email" name="email" type="email" placeholder="Your Email" required />
                                </p>',
                    'url'    => '<p class="comment-form-url">
                                    <label for="url">Website</label>
                                    <input id="url" name="url" type="url" placeholder="Your Website" />
                                </p>',
                ),
                'class_submit' => 'submit-button',
                'submit_field' => '<p class="form-submit">%1$s %2$s</p>',
            ));
            ?>
        </section>
    <?php endif; ?>

</div>
