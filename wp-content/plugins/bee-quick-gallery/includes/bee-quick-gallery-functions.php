<?php

  add_action( 'admin_notices', 'bee_layer_pro_notice' );

function bee_layer_pro_notice() {
    ?>
    <div class="notice  is-dismissible" >
       <a style="text-decoration:none;" href="https://beescripts.com/product/grid-gallery-pro" target="_blank"><img src="<?php echo plugin_dir_url( __FILE__ ).'../public/css/images/gallery-pro.png'; ?>" alt="upgrade pro version" /></a>
    </div>


    <?php
}

$bee_qucik_gallery_prefix='bee_quick_gallery';


// Register Custom Post Type
function bee_quick_gallery_post_type() {

	$labels = array(
		'name'                  => _x( 'Quick Galleries', 'Post Type General Name', 'bee_quick_gallery' ),
		'singular_name'         => _x( 'Quick gallery', 'Post Type Singular Name', 'bee_quick_gallery' ),
		'menu_name'             => __( 'Quick Gallery', 'bee_quick_gallery' ),
		'name_admin_bar'        => __( 'Quick Gallery', 'bee_quick_gallery' ),
		'archives'              => __( 'Item Archives', 'bee_quick_gallery' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bee_quick_gallery' ),
		'all_items'             => __( 'Galleries', 'bee_quick_gallery' ),
		'add_new_item'          => __( 'Add New Gallery', 'bee_quick_gallery' ),
		'add_new'               => __( 'Add Gallery', 'bee_quick_gallery' ),
		'new_item'              => __( 'New Gallery', 'bee_quick_gallery' ),
		'edit_item'             => __( 'Edit Gallery', 'bee_quick_gallery' ),
		'update_item'           => __( 'Update Gallery', 'bee_quick_gallery' ),
		'view_item'             => __( 'View Item', 'bee_quick_gallery' ),
		'search_items'          => __( 'Search Gallery', 'bee_quick_gallery' ),
		'not_found'             => __( 'Not gallery found', 'bee_quick_gallery' ),
		'not_found_in_trash'    => __( 'Not gallery found in Trash', 'bee_quick_gallery' ),
		'featured_image'        => __( 'Featured Image', 'bee_quick_gallery' ),
		'set_featured_image'    => __( 'Set featured image', 'bee_quick_gallery' ),
		'remove_featured_image' => __( 'Remove featured image', 'bee_quick_gallery' ),
		'use_featured_image'    => __( 'Use as featured image', 'bee_quick_gallery' ),
		'insert_into_item'      => __( 'Insert into item', 'bee_quick_gallery' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bee_quick_gallery' ),
		'items_list'            => __( 'Items list', 'bee_quick_gallery' ),
		'items_list_navigation' => __( 'Items list navigation', 'bee_quick_gallery' ),
		'filter_items_list'     => __( 'Filter items list', 'bee_quick_gallery' ),
	);
	$args = array(
		'label'                 => __( 'Quick gallery', 'bee_quick_gallery' ),
		'description'           => __( 'Quick Gallery generate gallery in easy method and quickly', 'bee_quick_gallery' ),
		'labels'                => $labels,
		'supports'              => array( 'title', ),
	
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-format-gallery',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'bee_quick_gallery', $args );

}
add_action( 'init', 'bee_quick_gallery_post_type', 0 );

//Define Fields

add_filter( 'rwmb_meta_boxes', 'bee_quick_gallery_meta_boxes' );
function bee_quick_gallery_meta_boxes( $bee_quick_gallery_fields ) {
    $prefix = 'rw_';
 
    // Fields
    $bee_quick_gallery_fields[] = array(
        'title'      => __( 'Upload Images', 'bee_quick_gallery' ),
        'post_types' => 'bee_quick_gallery',
        'fields'     => array(
            array(
                'name' => __( 'Gallery Images', 'bee_quick_gallery' ),
                'id'   => 'bee_qucik_gallery_images',
                'type' => 'image_advanced',
            ),
        )
    );
    return $bee_quick_gallery_fields;
}

///
function add_paging_for_gallery( $bee_quick_paging ){
  $bee_quick_paging[] = "bee_gallery_page";
  return $bee_quick_paging;
}
add_filter( 'query_vars', 'add_paging_for_gallery' );
function bee_quick_gallery_front_view($bee_gal_id)
{

         
extract(shortcode_atts(array(
      'id' => ''
      
   ), $bee_gal_id));

$bee_quick_gallery_images = rwmb_meta( 'bee_qucik_gallery_images', 'size=full' ,$id); 

$bee_quick_gal_options= get_option('quick_gal_options'); 
$bee_quick_gal_title= $bee_quick_gal_options['bee_quick_gal_title'];
$bee_quick_gal_desc= $bee_quick_gal_options['bee_quick_gal_desc'];
$bee_gal_limit = $bee_quick_gal_options['bee_quick_gal_limit'];
if($bee_gal_limit =="")
{
$bee_gal_limit=12;
}

    $bee_gal_total = count($bee_quick_gallery_images);
    $bee_gal_pages = ceil($bee_gal_total / $bee_gal_limit);
    $bee_gal_result = ceil($bee_gal_total / $bee_gal_limit);

    $bee_gal_current = isset($_GET['bee_gallery_page']) ? $_GET['bee_gallery_page'] : 1;
    $bee_gal_next = $bee_gal_current < $bee_gal_pages ? $bee_gal_current + 1 : null;
    $bee_gal_previous = $bee_gal_current > 1 ? $bee_gal_current - 1 : null;

    $bee_gal_offset = ($bee_gal_current - 1) * $bee_gal_limit;
    $bee_gal_items = array_slice($bee_quick_gallery_images, $bee_gal_offset, $bee_gal_limit);
?>
<div id="bee-quick-grid-gallery" class="bee-quick-grid-gallery">
				<section class="beegrid-wrap">
					<ul class="beegrid">
					<li class='beegrid-sizer'></li><!-- for Masonry column width -->
					<?php
					



if ( !empty( $bee_gal_items ) ) {
    foreach ( $bee_gal_items as $bee_quick_gallery_image ) {
	
        echo "<li><figure>
		<img src='{$bee_quick_gallery_image['url']}' alt='{$bee_quick_gallery_image['alt']}' />";
	
		if (($bee_quick_gal_title=='yes') AND ! empty($bee_quick_gal_title))
	{
	echo "<figcaption><h3>{$bee_quick_gallery_image['title']}</h3>";
	
	}
	if (($bee_quick_gal_desc=='yes') AND ! empty($bee_quick_gal_desc))
	{ 
	
	echo "<p>{$bee_quick_gallery_image['caption']}</p></figcaption>";
	
	
	}
							echo" </figure>	</li>";
  } 
}
?>						
					</ul>
				
				</section><!-- // bee_quick_slideshow -->
					
				<section class="bee_quick_slideshow">
				<ul>
				
				<?php
				

if ( !empty( $bee_gal_items ) ) {
    foreach ( $bee_gal_items as $bee_quick_gallery_image ) {
	
        echo "
		
						<li>
							<figure>
		<img src='{$bee_quick_gallery_image['url']}' alt='{$bee_quick_gallery_image['alt']}' /><figcaption>";
		if (($bee_quick_gal_title=='yes') AND ! empty($bee_quick_gal_title))
	{
	echo "<h3>{$bee_quick_gallery_image['title']}</h3>";
	
	}
	if (($bee_quick_gal_desc=='yes') AND ! empty($bee_quick_gal_desc))
	{ 
	
	echo "<p>{$bee_quick_gallery_image['caption']}</p>";
	
	
	}
		
	
	
							echo "</figcaption></figure>
							
						</li>";
    }
}
	
	?>
	
	</ul>
					<nav>
						<span class="icon nav-prev"></span>
						<span class="icon nav-next"></span>
						<span class="icon nav-close"></span>
					</nav>
					<div class="bee-info-keys icon">Navigate with arrow keys</div>
			</div><!-- // bee-quick-grid-gallery -->
		</div>
		<?php echo "<p>(Page: ". $bee_gal_current . " of " . $bee_gal_result .")</p>"; ?>
<? if($bee_gal_previous): ?>
    <a href="<?php echo get_permalink(); ?>?bee_gallery_page=<?= $bee_gal_previous ?>">Previous</a>
<? endif ?>
<? if($bee_gal_next) : ?>
    <a href="<?php echo get_permalink(); ?>?bee_gallery_page=<?= $bee_gal_next ?>">Next</a>
<? endif ?>
<?php
			
		}

add_shortcode('beequick','bee_quick_gallery_front_view');

//Generate shorcode in admin

add_action( 'manage_bee_quick_gallery_posts_custom_column', function ( $bee_column_name, $post_id ) 
{
$bee_quick_gallery="";
    if ( $bee_column_name == 'bee_gallery_shortcode')
	$bee_quick_gallery="[beequick id=".get_the_ID()."]";
        printf( '<input type="text" value="'.$bee_quick_gallery.'"  readonly />');
}, 10, 2 );


add_filter('manage_bee_quick_gallery_posts_columns', function ( $bee_columns ) 
{
    if( is_array( $bee_columns ) && ! isset( $bee_columns['bee_gallery_shortcode'] ) )
        $bee_columns['bee_gallery_shortcode'] = __( 'Gallery Shortcode' );     
		 
    return $bee_columns;
} );

// Admin Settings

/**
 * Register a custom menu page.
 */
//add_submenu_page( 'bee_quick_gallery','options','Quick options','admin_menu','pencil');


add_filter( 'mb_settings_pages', 'bee_quick_gal_options_page' );
function bee_quick_gal_options_page( $settings_pages )
{
	$settings_pages[] = array(
		'id'          => 'quick_gal_options',
	   'option_name'     => 'quick_gal_options',
		'parent'          => 'edit.php?post_type=bee_quick_gallery',
		'menu_title'   => __( 'Options', 'textdomain' ),
		
		'tabs'        => array(
			'general' => __( 'General Settings', 'textdomain' ),
			
		),
		
	);
	return $settings_pages;
}
// Register meta boxes and fields for settings page
add_filter( 'rwmb_meta_boxes', 'prefix_options_meta_boxes' );
function prefix_options_meta_boxes( $meta_boxes )
{
	$meta_boxes[] = array(
		'id'             => 'general',
		'title'          => __( 'General', 'textdomain' ),
		'settings_pages' => 'quick_gal_options',
		'tab'            => 'general',
		'fields' => array(
			array(
				'name' => __( 'Number of images per page ?', 'textdomain' ),
				'id'   => 'bee_quick_gal_limit',
				'type' => 'number',
				
			),
		array(
                'id'      => 'bee_quick_gal_title',
                'name'    => __( 'Enable Caption', 'textdomain' ),
                'type'    => 'radio',
				'std'     =>'no',
                'options' => array(
                    'yes' => __( 'Yes', 'textdomain' ),
                    'no' => __( 'No', 'textdomain' ),
                ),
            ),
			array(
                'id'      => 'bee_quick_gal_desc',
                'name'    => __( 'Enable Description', 'textdomain' ),
                'type'    => 'radio',
				'std'     =>'no',
                'options' => array(
                    'yes' => __( 'Yes', 'textdomain' ),
                    'no' => __( 'No', 'textdomain' ),
                ),
            ),
			
		),
	);
	
	
	return $meta_boxes;
}

//Custom Css

function bee_quick_gal_custom_css() {
	wp_enqueue_style(
		'bee-gal-custom-style',
		  plugin_dir_url( __FILE__ )  . 'includes/bee_quick_gal_custom_css.css');
	
	$bee_quick_gal_options= get_option('quick_gal_options'); 
$bee_quick_gal_title= $bee_quick_gal_options['bee_quick_gal_title'];
$bee_quick_gal_desc= $bee_quick_gal_options['bee_quick_gal_desc'];
   $bee_quick_gal_custom_css="";
       if ($bee_quick_gal_title=='no' && $bee_quick_gal_desc=='no' )
	{ 
	   
	    $bee_quick_gal_custom_css = "
		
	.beegrid figcaption {
	display:none;
	
	}
		
				";
				
				}
        wp_add_inline_style( 'bee-gal-custom-style', $bee_quick_gal_custom_css );
}
add_action( 'wp_enqueue_scripts', 'bee_quick_gal_custom_css' );


