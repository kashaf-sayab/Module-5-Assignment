<?php
get_template_part('Template-parts/header');
?>

<main id="main" class="site-main" role="main">
    <header class="search-header">
        <h1 class="search-title">Search Results for: <?php echo get_search_query(); ?></h1>
    </header>

    <section class="search-content">
        <?php
        $search_query = get_search_query();
        $args = array(
            's' => $search_query,
            'post_type' => array('post', 'page'),
            'post_status' => 'publish',
            'posts_per_page' => 8,
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
        );
        $custom_query = new WP_Query($args);

        if ($custom_query->have_posts()) : ?>
            <div class="search-results-grid">
                <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                    <div class="search-result-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="search-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="search-details">
                            <h2 class="search-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="search-meta">
                                <span class="search-author">by <?php the_author(); ?></span>
                                <span class="search-date">on <?php echo get_the_date(); ?></span>
                                <span class="search-categories"><?php the_category(', '); ?></span>
                            </div>
                            <div class="search-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="read-more-button">Read More</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="search-pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('&laquo; Previous', 'textdomain'),
                    'next_text' => __('Next &raquo;', 'textdomain'),
                ));
                ?>
            </div>

        <?php else : ?>
            <?php
            // Check for categories and tags
            $categories = get_terms(array(
                'taxonomy' => 'category',
                'hide_empty' => false,
                'name__like' => $search_query,
            ));

            $tags = get_terms(array(
                'taxonomy' => 'post_tag',
                'hide_empty' => false,
                'name__like' => $search_query,
            ));

            if (!empty($categories) || !empty($tags)) :
                $category_ids = wp_list_pluck($categories, 'term_id');
                $tag_ids = wp_list_pluck($tags, 'term_id');

                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 10,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                    'tax_query' => array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'term_id',
                            'terms'    => $category_ids,
                        ),
                        array(
                            'taxonomy' => 'post_tag',
                            'field'    => 'term_id',
                            'terms'    => $tag_ids,
                        ),
                    ),
                );
                $custom_query = new WP_Query($args);

                if ($custom_query->have_posts()) : ?>
                    <div class="search-results-grid">
                        <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                            <div class="search-result-item">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="search-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="search-details">
                                    <h2 class="search-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="search-meta">
                                        <span class="search-author">by <?php the_author(); ?></span>
                                        <span class="search-date">on <?php echo get_the_date(); ?></span>
                                        <span class="search-categories"><?php the_category(', '); ?></span>
                                    </div>
                                    <div class="search-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="read-more-button">Read More</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <div class="search-pagination">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => __('&laquo; Previous', 'textdomain'),
                            'next_text' => __('Next &raquo;', 'textdomain'),
                        ));
                        ?>
                    </div>

                <?php else : ?>
                    <p class="no-results">Sorry, no posts found related to your search criteria.</p>
                <?php endif;

                wp_reset_postdata();
            else : ?>
                <p class="no-results">Sorry, no results found for your search query.</p>
            <?php endif; ?>
        <?php endif; ?>
    </section>
</main>

<?php get_template_part('Template-parts/footer'); ?>
