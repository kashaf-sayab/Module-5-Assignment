<?php
/** Template Name: services page */
get_template_part('Template-parts/header');
get_template_part('Template-parts/service-highlights');
?>

<main id="main" class="site-main" role="main">
    <header class="services-header">
        <h1 class="services-title">Our Services</h1>
    </header>

    <section class="services-content">
        <?php
        $args = array(
            'post_type' => 'services', 
            'posts_per_page' => -1
        );

        $services_query = new WP_Query($args);

        if ($services_query->have_posts()) : ?>
            <div class="services-grid">
                <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
                    <div class="item-for-service">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="service-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="detail-for-service">
                            <h2 class="service-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="service-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="read-more-button">Read More</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php else : ?>
            <p class="no-services">Sorry, no services found.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </section>
</main>

<?php
get_template_part('Template-parts/footer');
?>
