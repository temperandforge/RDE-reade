<div class="single-share" id="single-share">

    <?php

    $share_text = get_field('share_text', 'options') ? get_field('share_text', 'options') : 'Share';

    echo '<p class="share-text">' . $share_text . '</p>';

    ?>
    <div class="single-share-icon-container">
        <div class="single-share-icon">
            <a class="fillall" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>" target="_blank">
                <span class="sr-only">Share on LinkedIn</span>
            </a>
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.22203 20.4229H1.05378V7.30516H5.22203V20.4229ZM3.1379 5.46624C1.78936 5.46624 0.808594 4.48547 0.808594 3.13693C0.808594 1.78838 1.91195 0.807617 3.1379 0.807617C4.48645 0.807617 5.46722 1.78838 5.46722 3.13693C5.46722 4.48547 4.48645 5.46624 3.1379 5.46624ZM20.4238 20.4229H16.2556V13.3123C16.2556 11.2282 15.3974 10.6152 14.1715 10.6152C12.9455 10.6152 11.7196 11.596 11.7196 13.4349V20.4229H7.55133V7.30516H11.4744V9.14409C11.8422 8.28593 13.3133 6.93738 15.3974 6.93738C17.7267 6.93738 20.1786 8.28592 20.1786 12.3316V20.4229H20.4238Z" fill="#009FC6"/>
            </svg>
        </div>

        <div class="single-share-icon">
            <a class="fillall" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_permalink()); ?>" target="_blank">
                <span class="sr-only">Share on Twitter</span>
            </a>
            <svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.4238 2.71588C19.6883 3.08367 18.9527 3.20626 18.0945 3.32886C18.9527 2.83848 19.5657 2.1029 19.8109 1.12214C19.0753 1.61252 18.2171 1.85771 17.2364 2.10291C16.5008 1.36733 15.3974 0.876953 14.2941 0.876953C11.7196 0.876953 9.75804 3.32886 10.371 5.78076C7.06095 5.65817 4.11866 4.06443 2.03455 1.61252C0.931189 3.45145 1.54417 5.78076 3.2605 7.00671C2.64752 7.00671 2.03455 6.76152 1.42157 6.51633C1.42157 8.35526 2.77012 10.0716 4.60905 10.562C3.99607 10.6846 3.38309 10.8072 2.77012 10.6846C3.2605 12.2783 4.73164 13.5043 6.57057 13.5043C5.09943 14.6076 2.89271 15.2206 0.808594 14.9754C2.64752 16.0788 4.73164 16.8143 6.93835 16.8143C14.4167 16.8143 18.5849 10.562 18.3397 4.8C19.1979 4.30962 19.9334 3.57405 20.4238 2.71588Z" fill="#009FC6"/>
            </svg>
        </div>

        <div class="single-share-icon">
            <a class="fillall" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">
                <span class="sr-only">Share on Twitter</span>
            </a>
            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.4238 10.0762C20.4238 4.68198 16.0104 0.268555 10.6162 0.268555C5.22202 0.268555 0.808594 4.68198 0.808594 10.0762C0.808594 14.98 4.36385 19.0256 9.02247 19.7612V12.8959H6.57057V10.0762H9.02247V7.86946C9.02247 5.41755 10.4936 4.06901 12.7003 4.06901C13.8037 4.06901 14.907 4.3142 14.907 4.3142V6.7661H13.6811C12.4551 6.7661 12.0874 7.50167 12.0874 8.23724V10.0762H14.7844L14.2941 12.8959H11.9648V19.8838C16.8686 19.1482 20.4238 14.98 20.4238 10.0762Z" fill="#009FC6"/>
            </svg>
        </div>
    </div>                 
</div>