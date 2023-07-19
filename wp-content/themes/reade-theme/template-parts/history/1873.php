<?php
echo '<script>console.log('.json_encode($args, JSON_PRETTY_PRINT).');</script>';//debug
?>

<div id="history-1873" class="historical-event panel">
   <div class="flex gap-x-3">
      <h2><?php echo $args['year'];?></h2>
      <div class="max-w-20"><?php echo __($args['content'], TEXTDOMAIN);?></div>
   </div>
   <picture>
      <img src="https://picsum.photos/1920/1080.webp" alt="" />
   </picture>
   <h3><?php echo __($args['heading'], TEXTDOMAIN);?></h3>
</div>
