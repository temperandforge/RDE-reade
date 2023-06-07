<?php 
if($fields = get_fields()): ?>

<div class="hero">
   <div class="hero-content">
      <h1 class="title is-1"><?php echo $fields['heading']?:get_the_title();?></h1>
      <p><?php echo $fields['content']; ?></p>
      <?php if(array_key_exists('btns', $fields) && $buttons = $fields['btns']): ?>
         <div class="btns-wrap">
            <?php foreach($buttons as $idx => $btn): $btn = $btn['btn']; ?>
            <a class="btn<?php echo $idx%2 ? " btn-outlined": " btn-primary";?>" href="<?php echo $btn['url'];?>" target="<?php echo $btn['target']?:'_self';?>">
               <?php echo $btn['title']; ?>
            </a>
            <?php endforeach;?>
         </div>
      <?php endif;?>
   </div>
   <div class="hero-img">
      <?php if($img = $fields['img']): ?>
      <picture>
         <?php echo wp_get_attachment_image($img['ID'], [2048,2048], false, ['role' =>'presentation']); ?>
      </picture>
      <?php endif;?>
   </div>
</div>

<?php endif; ?>
