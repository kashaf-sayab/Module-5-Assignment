<?php
get_template_part('Template-parts/header');
get_template_part('Template-parts/service-highlights');
?>

<div class="single-post-layout">
    <div class="single-post-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="single-post">
                <!-- Post Title -->
                <h1 class="post-content-title"><?php the_title(); ?></h1>

                <!-- Post Meta -->
                <div class="single-post-meta">
                    by <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author"><?php the_author(); ?></a>
                    on <a href="<?php echo esc_url(get_permalink()); ?>" class="date"><?php the_date(); ?></a> 
                    <span class="comments"><?php comments_number('No comments', '1 comment', '% comments'); ?></span>
                    <span class="vertical-line">|</span> 
                    <span class="post-category"><?php the_category(', '); ?></span>
                </div>

                <!-- Divider Line -->
                <hr class="divider-line">

                <!-- Post Content -->
                <div class="single-post-content">
                    <?php the_content(); ?>
                </div>

                <!-- Tags Section -->
                <?php if (has_tag()) : ?>
                    <div class="post-tags">
                        <h2 class="tags-heading">TAGS:</h2>
                        <?php the_tags('<span class="tag">', '</span><span class="tag">', '</span>'); ?>
                    </div>
                <?php endif; ?>

                <!-- Comments Template -->
                <?php comments_template('Template-parta/comment'); ?>
            </article>
        <?php endwhile; endif; ?>
    </div>
    

    <aside id="sidebar" class="sidebar-area">
        <?php get_sidebar(); ?>
    </aside>

    </div>
<?php get_template_part('Template-parts/footer'); ?>
