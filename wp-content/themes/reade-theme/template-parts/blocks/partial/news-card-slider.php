<div class="news-card-slider">
    <?php
    if ($img = get_the_post_thumbnail($npost->ID, 'medium-large')) {
        echo $img;
    }

    ?>
    <div class="card-info">
        <p class="card-post-date"><?php echo date("M jS, Y", strtotime($npost->post_date)); ?></p>
        <h4 class="card-post-title"><?php echo $npost->post_title; ?></h4>
        <a href="<?php echo get_permalink($npost->ID); ?>" class="btn-blue-dark-blue btn-arrow">Read More
            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 5.95452C12.348 5.61282 12.902 5.61281 13.2437 5.95452L16.7437 9.45452C17.0854 9.79623 17.0854 10.3503 16.7437 10.692L13.2437 14.192C12.902 14.5337 12.348 14.5337 12.0063 14.192C11.6646 13.8503 11.6646 13.2962 12.0063 12.9545L14.0126 10.9482H3.875C3.39175 10.9482 3 10.5565 3 10.0732C3 9.58999 3.39175 9.19824 3.875 9.19824H14.0126L12.0063 7.19196C11.6646 6.85025 11.6646 6.29623 12.0063 5.95452Z" fill="#FAFAFA"/>
            </svg>
        </a>
    </div>
</div>