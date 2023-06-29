<?php

$fields = get_fields();

?>

<?php if(!empty($fields['quote'])) :?>
 <div class="static-testimonial--section">
  <div class="static-testimonial--wrap">
   <figure class="quote-figure">
    <blockquote
    <?php if(($fields['include_url_source']) && (!empty($fields['link']))) :?>
     cite="<?php echo $fields['link']['url'] ;?>"
    <?php endif ;?>
    >
     <p class="quote">"<?php echo $fields['quote'] ;?>"</p>
    </blockquote>
    <figcaption>
     <?php if(!empty($fields['quote_by'])) :?>
      <span class="quote-by"><?php echo $fields['quote_by'] ;?><?php echo !empty($fields['link']) ? ',' : null ;?></span>
      <?php if(!empty($fields['link'])) :?>
       <cite>
        <a 
        href="<?php echo $fields['link']['url'] ;?>"
        target="<?php echo $fields['link']['target'] ?: '_self';?>">
        <?php echo $fields['link']['title'] ;?></a>
       </cite>
      <?php endif ;?>
     <?php endif ;?>
     <?php if((!empty($fields['quote_by'])) && (!empty($fields['role']))) :?>
      <br>
     <?php endif ;?>
     <?php if(!empty($fields['role'])) :?>
      <span class="quote-by-role">-<?php echo $fields['role'] ;?></span>
     <?php endif ;?>
    </figcaption>
   </figure>
  </div>
 </div>
<?php endif ;?>