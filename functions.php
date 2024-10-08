<?php
function mytheme_setup() {
    add_theme_support('block-templates');
    add_theme_support('editor-styles');
    add_editor_style('style.css'); 

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'blog-theme'),
    ));
    
    add_theme_support('custom-logo', array(
        'width'       => 150,
        'height'      => 50,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    add_theme_support('post-thumbnails');

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'mytheme_setup');

function mytheme_enqueue_scripts() {
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');
function create_services_post_type() {
    register_post_type('services',
        array(
            'labels' => array(
                'name' => __('Services'),
                'singular_name' => __('Service'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Service'),
                'edit_item' => __('Edit Service'),
                'new_item' => __('New Service'),
                'view_item' => __('View Service'),
                'search_items' => __('Search Services'),
                'not_found' => __('No services found'),
                'not_found_in_trash' => __('No services found in Trash'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-admin-tools',
            'rewrite' => array('slug' => 'services'),
             'show_in_rest' => true, 
        )
    );
}
add_action('init', 'create_services_post_type');

function wp_blog_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Right Sidebar', 'wp_blog_theme'),
        'id'            => 'right-sidebar',
        'description'   => __('Widgets in this area will be shown on the right-hand side.', 'wp_blog_theme'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2><hr />',
    ));
}
add_action('widgets_init', 'wp_blog_theme_widgets_init');

// Register the custom widget
function wp_blog_theme_custom_portfolio_widget()
{
	register_widget('Featured_Images_Widget');
}
add_action('widgets_init', 'wp_blog_theme_custom_portfolio_widget');

// Define the custom widget
class Featured_Images_Widget extends WP_Widget
{

	public function __construct()
	{
		parent::__construct(
			'featured_images_widget',
			__('Featured Images Widget', 'blog-theme'),
			array('description' => __('Displays featured images of recent posts.', 'blog-theme'))
		);
	}

	public function widget($args, $instance)
	{
		echo $args['before_widget'];

		$query_args = array(
			'posts_per_page' => 8, 
			'meta_key' => '_thumbnail_id', 
		);
		$query = new WP_Query($query_args);

		if ($query->have_posts()) {
			echo '<ul class="featured-images-widget">';
			while ($query->have_posts()) {
				$query->the_post();
				?>
				<li class="featured-image-item">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('small'); ?>
					</a>
				</li>
				<?php
			}
			echo '</ul>';
		} else {
			echo '<p>' . __('No featured images found.', 'wp-blog-theme') . '</p>';
		}

		wp_reset_postdata();

		echo $args['after_widget'];
	}


	public function update($new_instance, $old_instance)
	{
		return $new_instance;
	}
}
require get_template_directory(). '/Template-parts/portfolio_showcase.php';
// for comment
function custom_comment_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class('comment-item'); ?>>
        <div class="comment-body">
            <div class="comment-meta">
                <span class="comment-icon">&#x1F5E8;</span>
                <span class="comment-author"><?php comment_author(); ?></span>
                <span class="comment-date">said on <?php comment_date(); ?> at <?php comment_time(); ?></span>
            </div>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <div class="comment-reply">
                <?php comment_reply_link(array_merge($args, array('reply_text' => '<i class="fas fa-reply"></i> Reply'))); ?>
            </div>
        </div>
        <hr class="comment-divider">
    </li>
<?php
}

