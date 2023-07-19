<?php

$fields = get_fields();

?>

<div class="position-qualifications--section">
 <div class="position-qualifications--main">
  <div class="position-qualifications--inner">
   <div class="position-qualifications--wrap">
    <div class="position-qualifications--heading">
     <?php if(!empty($fields['heading'])) :?>
      <h2><?php echo $fields['heading'] ;?></h2>
     <?php endif ;?>
    </div>
    <div class="position-qualifications--qualifications">
     <?php foreach($fields['qualifications'] as $qual) :?>
      <div class="position-qualifications--qualification">
       <div class="position-qualification--content">
        <h3><?php echo $qual['heading'] ;?></h3>
        <p><?php echo $qual['content'] ;?></p>
       </div>
      </div>
     <?php endforeach ;?>
     </div>
   </div>
  </div>
 </div>
</div>