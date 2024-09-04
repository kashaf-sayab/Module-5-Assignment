<?php
// Ensure that the comment form is only displayed if comments are open
if (comments_open()) : 
?>
    <section class="post-comments">
        <h2 class="comments-title">Leave a Comment</h2>
        
        <?php
        // Display the comment form
        comment_form(array(
            'title_reply' => '', // Remove default "Leave a Comment" title
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
            'class_submit' => 'submit-button', // Custom class for submit button
            'submit_field' => '<p class="form-submit">%1$s %2$s</p>', // Custom submit button markup
        ));
        ?>
    </section>
<?php
endif;
?>
