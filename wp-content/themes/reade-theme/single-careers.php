<?php

get_header();

?>

<main id="main-content" class="main-content-wrap">
    <div class="theme-main">
        <div class="theme-inner-wrap">
            <div class="single-position--container">
                <?php while( have_posts() ): ?>
                    <?php the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>
        </div>
     </div>
</main>
<?php get_footer(); ?>