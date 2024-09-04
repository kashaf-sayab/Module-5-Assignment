<?php

function custom_portfolio_showcase($atts) {
    ob_start();

    
    $atts = shortcode_atts(array(
        'posts' => 6, 
    ), $atts, 'portfolio_showcase');

    
    ?>
    <div class="portfolio-showcase">
        <div class="portfolio-showcase-header">
            <h2 class="portfolio-title">D'SIGN IS THE SOUL</h2>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('portfolio'))); ?>" class="view-all-btn">View All</a>
        </div>
        <hr class="portfolio-showcase-divider">
    </div>
    <?php

    
    $query_args = array(
        'post_type' => 'post', 
        'posts_per_page' => intval($atts['posts']),
        'meta_key' => '_thumbnail_id', 
    );
    $portfolio_query = new WP_Query($query_args);

    
    if ($portfolio_query->have_posts()) :
        echo '<div class="portfolio-grid">';
        while ($portfolio_query->have_posts()) :
            $portfolio_query->the_post();
            ?>
            <div class="portfolio-item">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('medium');
                    } ?>
                </a>
            </div>
            <?php
        endwhile;
        echo '</div>';
    else :
        echo '<p>No portfolio items found.</p>';
    endif;

    
    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('portfolio_showcase', 'custom_portfolio_showcase');
