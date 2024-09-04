<?php
/* Template Name: Blog Page */

get_template_part('Template-parts/header');
get_template_part('Template-parts/service-highlights');
?>

<div class="main-content">
    <div class="blog-layout">
        <div class="content-area blog-container">
            <div class="blog-header">
                <h2 class="blog-title">LET'S BLOG</h2>
                <hr class="blog-divider">
            </div>

            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 5,
                'paged' => $paged,
            );

            $blog_query = new WP_Query($args);

            if ($blog_query->have_posts()) :
                while ($blog_query->have_posts()) : $blog_query->the_post();
                    $post_date = get_the_date('d M ');
                    $post_author = get_the_author();
                    $post_comments = get_comments_number();
                    $is_active = is_singular() ? 'active' : '';

                    // Retrieve categories
                    $categories = get_the_category();
                    $category_list = '';
                    if (!empty($categories)) {
                        $category_links = array();
                        foreach ($categories as $category) {
                            $category_links[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                        }
                        $category_list = implode(', ', $category_links);
                    } else {
                        $category_list = 'Uncategorized';
                    }
                    ?>
                    <div class="blog-post <?php echo esc_attr($is_active); ?>">
                        <div class="blog-post-header">
                            <div class="post-date">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="date-link"><?php echo esc_html($post_date); ?></a>
                            </div>
                            <div class="post-separator"></div> 
                            <div class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                        </div>
                        <div class="post-details">
                            <div class="post-thumbnail">
                                <?php if (has_post_thumbnail()) { ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium-large'); ?>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="post-meta">
                                <div class="meta-info">
                                    <p>by <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-link"><?php echo esc_html($post_author); ?></a> 
                                    on <a href="<?php echo esc_url(get_permalink()); ?>" class="date-link"><?php echo esc_html($post_date); ?></a></p>
                                    <p>
                                        <span class="comment-count"><?php echo esc_html($post_comments . ' ' . _n('Comment', 'Comments', $post_comments, 'wp-blog-theme')); ?></span>
                                        <span class="meta-separator">|</span>
                                        <span class="category-links"><?php echo $category_list; ?></span>
                                    </p>
                                </div>
                                <hr class="post-divider">
                            </div>
                            <div class="post-excerpt-container">
                                <div class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_content(), 40, '...'); ?>
                                    <a href="<?php the_permalink(); ?>" class="more-link">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
            else :
                echo '<p>No posts found.</p>';
            endif;

            // Pagination
            ?>
            <div class="pagination-links">
                <?php
                echo paginate_links(array(
                    'total' => $blog_query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => __('<i class="fas fa-chevron-left"></i>'),
                    'next_text' => __('<i class="fas fa-chevron-right"></i>'),
                ));
                ?>
            </div>

            <?php
            wp_reset_postdata();
            ?>
        </div>

        <aside id="sidebar" class="sidebar-area">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_template_part('Template-parts/footer'); ?>
