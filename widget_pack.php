<?php
   /*
   Plugin Name: Widget Pack
   Plugin URI: http://my-awesomeness-emporium.com
   Description: Plugin to display Recent Posts
   Version: 1.2
   Author: Nikita Pariyani
   Author URI: http://mrtotallyawesome.com
   License: GPL2
   */
?>
<?php
function catch_that_image() {
  		global $post;
  		$first_img = '';
  		ob_start();
  		ob_end_clean();
  		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  		$first_img = $matches [1] [0];

  		if(empty($first_img)){ //Defines a default image
  			$first_img = bloginfo('template_directory');
    		$first_img .= "http://picbook.in/wp-content/uploads/2014/07/puppy_images_in_hd.jpg";
  		}
  		return $first_img;
	}
function wp_featured_image(){
    
    global $post;
    $post_id=$post->ID;
    if ( has_post_thumbnail($post_id) ) {
            the_post_thumbnail(array(100,100));
        }
        else {
            echo '<img src="';
            echo catch_that_image();
            echo '" alt="Unable to load" width="100px" height="100px" class="featuredImage" />';
        }
    
}
function wp_post_date(){
    echo "<strong>Date:  </strong>";
    echo the_date('','','',TRUE);
}
function wp_post_author(){
    global $post;
    echo "<strong>Author:  </strong>";
    $author_id= $post->post_author;
    echo get_the_author_meta('first_name',$author_id);
    echo " ";
    echo get_the_author_meta('last_name',$author_id);
}
function wp_post_category(){
    echo "<strong>Category:</strong>";
    echo "<br>";
    echo get_the_category_list();
}
function wp_comment_number() {
    global $count;
    $count = comments_number();
    echo "$count";
}
function wp_post_excerpt(){
    echo "<strong>Excerpt:</strong>";
    echo "<br>";
    the_excerpt();
}
function wp_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'wp_excerpt_length', 999 );

function wp_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '">   Read More..</a>';
}
add_filter('excerpt_more', 'wp_excerpt_more');

    
include 'recent_posts.php';


?>

