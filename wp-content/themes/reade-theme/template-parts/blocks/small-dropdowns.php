<?php
// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { 
   ?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/small-dropdown.webp" alt="Preview of Benefits Block">
   </figure>
<?php 
} else if( $fields = get_fields() ?: []) {
   // echo '<script>console.log('.json_encode($fields, JSON_PRETTY_PRINT).');</script>';//debug
?>

<div class="small-dropdowns">
   <div class="small-dropdowns--image">
      <picture>
         <?php echo wp_get_attachment_image($fields['image']['ID'], 'full'); ?>
      </picture>
   </div>
   <div class="small-dropdowns--accordion">
      <?php foreach($fields['dropdowns'] as $idx => $item ): ?>
      <section class="relative border-[#009FC6] border-b border-solid">
         <h2 class="mb-0">
            <button
               class="flex justify-between rounded-t-1 group relative w-full cursor-pointer items-center transition-all ease-in"
               data-collapse-target="collapse-<?php echo $idx; ?>"
            >
               <span><?php echo $item['heading']; ?></span>
               <svg aria-hidden="true" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M7.37109 17.3936L15.348 25.3705M15.348 25.3705L23.3249 17.3936M15.348 25.3705L15.348 4.8584" stroke="#009FC6" stroke-width="2.4468" stroke-linecap="round" stroke-linejoin="round"/> </svg>
            </button>
         </h2>
         <div
            data-collapse="collapse-<?php echo $idx; ?>"
            class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out"
         >
            <div class="pt-[0.68rem] pb-[1.56rem]">
               <?php echo $item['content']; ?>
            </div>
         </div>
      </section>
      <?php endforeach; ?>
   </div>


   <script>
      const dropdowns = document.querySelectorAll('.small-dropdowns [data-collapse-target]');
      dropdowns.forEach(dropdown => {
         dropdown.onclick = (e) => {
            const target = document.querySelector(`.small-dropdowns [data-collapse="${dropdown.dataset.collapseTarget}"]`);
            if( target.classList.contains('open')) {
               target.classList.remove('open')
            } else {
               // document.querySelectorAll(`.small-dropdowns [data-collapse]`).forEach( el =>el.classList.remove('open') );
               setTimeout(() => {
                  target.classList.add('open');
               }, 50);
            }
         }
      });
   </script>
</div>


<?php 
} ?>
