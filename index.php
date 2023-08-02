<?php get_header() ?>


<!-- s-content
================================================== -->
<section class="s-content">

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
    <?php
    // Get options
    $options = get_option('custom_admin'); // unique id of the framework

    echo $options['opt-text']; // id of the field
    echo esc_html($options['opt-textarea']) . "</br>"; // id of the field
    if ($options['is-favorite']) {
        echo esc_html($options['page-favorite-text']);
    }

    ?>
    <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <?php philosophy_pagination(); ?>
            </nav>
        </div>
    </div>


</section> <!-- s-content -->


<?php get_footer(); ?>