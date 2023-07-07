<?php

$fields = get_fields();
if(IS_LOCAL) {
echo '<script>console.log('.json_encode($fields, JSON_PRETTY_PRINT).');</script>';//debug
}

?>

<div class="industry-slider--section">
 <div class="industry-slider--main">
  <div class="industry-slider--inner">
   <div class="industry-slider--wrap">
    <div class="industry-slider--slider">
     <?php foreach($fields['items'] as $item) :?>
      <div class="industry-slider--item">
       <div class="industry-slider--content">
        <?php if(!empty($item['heading'])) :?>
         <h3><?php echo $item['heading'] ;?></h3>
        <?php endif ;?>
        <?php if(!empty($item['content'])) :?>
         <p><?php echo $item['content'] ;?></p>
        <?php endif ;?>
       </div>
      </div>
     <?php endforeach ;?>
    </div>
   </div>
  </div>
 </div>
</div>