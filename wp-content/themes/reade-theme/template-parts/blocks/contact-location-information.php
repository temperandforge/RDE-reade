<?php

$fields = get_fields();

?>

<div class="contact-information--section">
 <div class="contact-information--wrap">
  <div class="contact-information--locations">
   <?php foreach($fields['locations'] as $index=>$location) :?>
    <h2>
     <button 
     class="<?php echo ($index % 2 != 0) ? 'btn' : 'btn-blue-dark-blue' ;?>"  
     aria-expanded="<?php echo ($index == 0) ? 'true' : 'false' ;?>"
     aria-controls="location<?php echo $index + 1 ;?>"
     id="location<?php echo $index + 1 ;?>id">
     <span><?php echo $location['location'] ;?></span>
    </button>
   </h2>
   <?php endforeach ;?>
   </div>
  <div class="contact-information--content">
   <?php foreach($fields['locations'] as $index=>$location) :?>
    <div 
    class="contact-information--set <?php echo ($index == 0) ? 'active' : null ;?>" 
    aria-hidden="<?php echo ($index == 0) ? 'false' : 'true' ;?>" 
    id="location<?php echo $index + 1 ;?>"
    aria-labelledby="location<?php echo $index + 1 ;?>id"
    role="region">
     <figure>
      <?php echo wp_get_attachment_image( $location['image']['ID'], 'full' );?>
     </figure>
     <div class="contact-information--block">
      <h3>Servicing:</h3>
      <p><?php echo $location['servicing'] ;?></p>
      <br>
      <?php if(!empty($location['address'])) :?>
       <p><?php echo $location['address'] ;?></p>
      <?php endif ;?>

      <?php foreach($location['contacts'] as $contact) :?>
       <?php if((!empty($contact['contact_type'])) || (!empty($contact['contact_info']))) :?>
        <p>
         <?php if(!empty($contact['contact_type'])) :?>
          <span><?php echo $contact['contact_type'] ;?>:</span> 
         <?php endif ;?>
         <?php if(!empty($contact['contact_info'])) :?>
          <span><?php echo $contact['contact_info'] ;?></span> 
         <?php endif ;?>
        </p>
       <?php endif ;?>
      <?php endforeach ;?>

      <?php foreach($location['point_of_contact'] as $poc) :?>
       <?php if(!empty($poc['position'])) :?>
        <h3><?php echo $poc['position'] ;?></h3>
       <?php endif ;?>

       <?php if(empty($poc['link'])) :?>
        <p><?php echo $poc['name'] ;?></p>
       <?php else :?>
        <a href="<?php echo $poc['link']['url'] ;?>" target="<?php echo $poc['link']['target'] == "_target" ? $poc['link']['target'] : '_self' ;?>"><?php echo $poc['name'] ;?></a>
       <?php endif ;?>
      <?php endforeach ;?>
     </div>
    </div>
   <?php endforeach ;?>
   </div>
 </div>
</div>