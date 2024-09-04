<?php
/** Template Name: Portfolio */
get_template_part('Template-parts/header');
get_template_part('Template-parts/service-highlights');
?>
<div class="page-content">
    

    <div class="portfolio-wrapper">
        <header class="portfolio-header">
            <h2>DESIGN IS THE SOUL</h2>
            <nav class="portfolio-nav">
                <a href="<?php echo add_query_arg('filter', 'advertising', get_permalink()); ?>" class="btn <?php if (isset($_GET['filter']) && $_GET['filter'] == 'advertising') echo 'active'; ?>">Advertising</a>
                <a href="<?php echo add_query_arg('filter', 'multimedia', get_permalink()); ?>" class="btn <?php if (isset($_GET['filter']) && $_GET['filter'] == 'multimedia') echo 'active'; ?>">Multimedia</a>
                <a href="<?php echo add_query_arg('filter', 'photography', get_permalink()); ?>" class="btn <?php if (isset($_GET['filter']) && $_GET['filter'] == 'photography') echo 'active'; ?>">Photography</a>
            </nav>
        </header>
        <hr class="portfolio-divider">

        <section class="portfolio-gallery">
            <?php
            $args = array(
                'posts_per_page' => 12,
                'paged' => max(1, get_query_var('paged')),
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id', 
                        'compare' => 'EXISTS',
                    ),
                ),
            );

            if (isset($_GET['filter']) && $_GET['filter'] == 'advertising') {
                $args['category_name'] = 'advertising';
            }
            
            elseif (isset($_GET['filter']) && $_GET['filter'] == 'multimedia') {
                $args['category_name'] = 'multimedia';
            }
            
            elseif (isset($_GET['filter']) && $_GET['filter'] == 'photography') {
            
            }

        
            $portfolio_query = new WP_Query($args);

            
            if ($portfolio_query->have_posts()) :
                while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
            ?>
                    <article class="portfolio-card">
                        <a href="<?php the_permalink(); ?>" class="portfolio-link">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </article>
            <?php
                endwhile;
            else :
                echo '<p>No portfolio items found.</p>';
            endif;

        
            wp_reset_postdata();
            ?>
        </section>

        <!-- Custom Pagination -->
        <div class="portfolio-pagination">
            <?php
            echo paginate_links(array(
                'total' => $portfolio_query->max_num_pages,
                'current' => max(1, get_query_var('paged')),
                'format' => '?page=%#%',
                'prev_text' => __('<i class="fas fa-arrow-left"></i>'),
                'next_text' => __('<i class="fas fa-arrow-right"></i>'),
            ));
            ?>
        </div>
    </div>
    <?php
     the_content(); 
    
    ?>
</div>
<?php
get_template_part('Template-parts/footer');?>