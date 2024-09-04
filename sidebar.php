<div id="sidebar" class="sidebar-area">
    <!-- Portfolio Widget -->
    <?php if (is_active_sidebar('right-sidebar')) : ?>
        <?php dynamic_sidebar('right-sidebar'); ?>
    <?php endif; ?>

  <!-- Recent Posts -->
<aside id="recent-posts" class="widget">
    <h2 class="widget-title">Recent Posts</h2>
    <hr />
    <ul class="recent-posts-list">
        <?php
        $args = array(
            'posts_per_page' => 5,
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1
        );

        $recent_posts_query = new WP_Query($args);

        if ($recent_posts_query->have_posts()) :
            while ($recent_posts_query->have_posts()) : $recent_posts_query->the_post(); ?>
                <li>
                    <div class="recent-post-thumbnail">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail');
                        } else {
                            echo '<img src="' . esc_url(get_template_directory_uri() . '/images/default-thumbnail.jpg') . '" alt="Default Thumbnail">';
                        } ?>
                    </div>
                    <div class="recent-post-info">
                        <h3 class="recent-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <span class="recent-post-meta"><?php the_author(); ?> | <?php echo get_the_date('F j, Y'); ?></span>
                    </div>
                </li>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>No recent posts found.</p>
        <?php endif; ?>
    </ul>
</aside>


  <!-- Related Posts -->
<aside id="related-posts" class="widget">
    <h2 class="widget-title">Related Posts</h2>
    <hr />
    <ul class="recent-posts-list">
        <?php
        $current_post_id = get_the_ID();
        $categories = wp_get_post_categories($current_post_id);
        $args = array(
            'category__in' => $categories,
            'post__not_in' => array($current_post_id),
            'posts_per_page' => 5,
            'ignore_sticky_posts' => 1
        );

        $related_posts_query = new WP_Query($args);

        if ($related_posts_query->have_posts()) :
            while ($related_posts_query->have_posts()) : $related_posts_query->the_post(); ?>
                <li>
                    <div class="recent-post-thumbnail">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail');
                        } else {
                            echo '<img src="' . esc_url(get_template_directory_uri() . '/images/default-thumbnail.jpg') . '" alt="Default Thumbnail">';
                        } ?>
                    </div>
                    <div class="recent-post-info">
                        <h3 class="recent-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <span class="recent-post-meta"><?php the_author(); ?> | <?php echo get_the_date('F j, Y'); ?></span>
                    </div>
                </li>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>No related posts found.</p>
        <?php endif; ?>
    </ul>
</aside>
<!-- Popular Posts -->
<aside id="popular-posts" class="widget">
    <h2 class="widget-title">Popular Posts</h2>
    <hr />
    <ul class="recent-posts-list">
        <?php
        $args = array(
            'posts_per_page' => 5,
            'orderby' => 'comment_count', // Order by the number of comments
            'order' => 'DESC',
            'ignore_sticky_posts' => 1
        );

        $popular_posts_query = new WP_Query($args);

        if ($popular_posts_query->have_posts()) :
            while ($popular_posts_query->have_posts()) : $popular_posts_query->the_post(); ?>
                <li>
                    <div class="recent-post-thumbnail">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail');
                        } else {
                            echo '<img src="' . esc_url(get_template_directory_uri() . '/images/default-thumbnail.jpg') . '" alt="Default Thumbnail">';
                        } ?>
                    </div>
                    <div class="recent-post-info">
                        <h3 class="recent-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <span class="recent-post-meta"><?php the_author(); ?> | <?php echo get_the_date('F j, Y'); ?></span>
                    </div>
                </li>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>No popular posts found.</p>
        <?php endif; ?>
    </ul>
</aside>


    <!-- Archives -->
    <aside id="archives" class="widget">
        <h2 class="widget-title">Archives</h2>
        <hr />
        <ul>
            <?php wp_get_archives(); ?>
        </ul>
    </aside>
</div>
