<?php get_header() ?>

<!-- s-content
    ================================================== -->
<section class="s-content">

    <h3 class="text-center"><?php single_cat_title() ?></h3>

    <?php
    $term = get_queried_object();
    $term_meta = get_term_meta($term->term_id, 'taxonomy_options', true);

    echo '<h3 class="text-center">' . $term->name . '</h3>';
    ?>

    <div class="row masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>

            <?php
            while (have_posts()) {
                the_post();
                get_template_part("template-parts/post-formats/post", get_post_format());
            }
            ?>

        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <?php philosophy_pagination(); ?>
            </nav>
        </div>
    </div>


</section> <!-- s-content -->


<?php get_footer(); ?>