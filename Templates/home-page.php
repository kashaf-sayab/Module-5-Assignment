<?php
/**
 * Template Name: Homepage Template
 */
get_template_part('template-parts/header');
?>

<div class="home-page-container">
    <?php
    while (have_posts()) : the_post(); ?>
        <section class="slider">
            <div class="slider-image-content">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/slider-image.png'); ?>" alt="slider Image" class="slider-image">
                <div class="image-text">
                    <h1>Gearing up the ideas</h1>
                    <p>Discover innovative solutions and creative ideas to elevate your projects. Transforming visions into reality with elegance and expertise.</p>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
    <?php
get_template_part('template-parts/service-highlights');?>
    <div class="portfolio-section">
        <?php echo do_shortcode('[portfolio_showcase]'); ?>
    </div>

<?php get_template_part('template-parts/footer'); ?>
