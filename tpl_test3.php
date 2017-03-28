tpl_test3.php



<?php

/**
 * Prints the row in a grid
 * @param array $posts
 * @param string $class
 */
function printRow($posts, $class) {
    echo '<div class="row">';

    foreach ($posts as $post) {
        echo '<div class="' . $class . '">' . $post . '</div>';
    }

    echo '</div>';
}

$i = 0;
$htmlClasses = ['col-md-4', 'col-md-12', 'col-md-6']; //helper for setting html classes
$buffer = []; //helper array to hold row elements

while (have_posts()) {
    the_post();
    $i++;

    $mod = $i % 3;

    //determine html class
    $htmlClass = $htmlClasses[$mod];

    if ($mod > 0) {
        $buffer[] = $currentPost; //this is the post content
    } else {
        printRow($buffer, $htmlClass);
        $buffer = [];
    }
}

//printing final row if there are elements
if (!empty($buffer)) {
    printRow($buffer, $htmlClass);
}


?>


<?php
    $args=array(
    'post_type' => 'artist',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'caller_get_posts'=> 1
    );
    $my_query = null;
    $my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
    echo '';
$i = 0;
while ($my_query->have_posts()) : $my_query->the_post();
    if($i % 4 == 0) { ?> 
        <div class="row">
    <?php
    }
    ?>
    <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
    <p><a href="<?php the_field('artist_link'); ?>"><?php the_field('artist_name'); ?></a></p>
    <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php the_field('artist_photo'); ?>" alt="" class="img-responsive" /></a></p>

    <?php    
    if($i % 4 == 0) { ?> 
        </div>
    <?php
    }

    $i++;
endwhile;
}
wp_reset_query();
?>