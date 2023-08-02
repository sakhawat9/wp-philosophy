<?php

/**
 * Template Name: Tex Query Example
 */

 $philosophy_query_args = array(
    'post_type' => 'book',
    'posts_par_page' => -1,
    'text_query' => array(
        'relation' => 'AND',
        array(
            'relation' => 'AND',
            array(
                'taxonomy'=>'language',
                'field'=>'slug',
                'terms'=> array('english'),
            ),
            array(
                'taxonomy'=>'language',
                'field'=>'slug',
                'terms'=>'bangla',
                'operator'=>'Not IN'
            )
            ),
            array(
                'taxonomy'=>'genre',
                'field'=>'slug',
                'terms'=> array('classic'),
            ),
    )
 );

 $philosophy_posts = new WP_Query($philosophy_query_args);
//  echo $philosophy_posts->found_posts;

 while($philosophy_posts->have_posts()){
    $philosophy_posts->the_post();
    the_title();
    echo "<br/>";
 }
 wp_reset_query();