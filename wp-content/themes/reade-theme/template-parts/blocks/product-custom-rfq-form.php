<?php

$fields = get_fields();

?>

<div class="rfq-form--section">
 <div class="rfq-form--main">
  <div class="rfq-form--inner">
   <div class="rfq-form--wrap">
     <h1 class="sr-only">Request A Custom Product</h1>
    <?php if((!empty($fields['heading'])) || (!empty($fields['content']))) :?>
     <div class="rfq-form--heading">
      <?php if(!empty($fields['heading'])) :?>
       <h2><?php echo $fields['heading'] ;?></h2>
      <?php endif ;?>
      <?php if(!empty($fields['content'])) :?>
       <p><?php echo $fields['content'] ;?></p>
      <?php endif ;?>
     </div>
    <?php endif ;?>
    <div class="rfq-form--form">
     <!-- salesforce form -->

    <form id="sf-form" action="https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">
    <input type=hidden name="oid" value="00D3J0000008rZJ">
    <input type=hidden name="retURL" value="http://reade.wpengine.com/itemized-rfq-form-success/">
    <input  id="first_name" maxlength="40" name="first_name" size="20" type="hidden" />
    <input  id="last_name" maxlength="80" name="last_name" size="20" type="hidden" />
    <input  id="company" maxlength="40" name="company" size="20" type="hidden" />
    <input  id="phone" maxlength="40" name="phone" size="20" type="hidden" />
    <input  id="email" maxlength="80" name="email" size="20" type="hidden" />
    <textarea id="street" name="street" style="display: none;"></textarea>
    <input  id="city" maxlength="40" name="city" size="20" type="hidden" />
    <input  id="state" maxlength="20" name="state" size="20" type="hidden" />
    <input  id="zip" maxlength="20" name="zip" size="20" type="hidden" />
    <input id="lead_source" maxlength="20" name="lead_source" size="20" type="hidden" value="Website">
    <input  id="00N3J000001mcrB" maxlength="255" name="00N3J000001mcrB" size="20" type="hidden" />
    <textarea  id="00N3J000001mcrG" name="00N3J000001mcrG" type="text" wrap="soft" style="display: none;"></textarea>

    <textarea id="00N3J000001mdyh" name="00N3J000001mdyh" type="text" wrap="soft" style="display: none;"></textarea>

    <!-- find us -->
    <input  id="00N6g00000TtToG" name="00N6g00000TtToG" value="" type="hidden">

    <!-- find us details -->
    <input  id="00N6g00000U3avS" maxlength="255" name="00N6g00000U3avS" size="20" type="hidden" />

    <!-- preferred method of contact -->
    <input  id="00N6g00000TtToJ" name="00N6g00000TtToJ" size="20" type="hidden">

    <!-- terms and conditions -->
    <input  id="00N6g00000TUVGD" name="00N6g00000TUVGD" type="hidden" value="1">

    <input id="sf-form-submit" type="submit" name="submit" style="display: none;">
    </form>



     <form id="custom-product-request-form" action="https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">


          <div class="rfq-form-slide-1 rfq-form-slide">

               <input type=hidden name="oid" value="00D3J0000008rZJ">
               <input type=hidden name="retURL" value="http://reade.wpengine.com/itemized-rfq-form-success/">

               <input  id="lead_source" name="lead_source" value="Website" type="hidden"></select>

               <input  class="all-fields rfq-input-product" id="00N6g00000TUVFe" maxlength="255" name="00N6g00000TUVFe" size="20" type="text" placeholder="Material or Chemical Formula *" />

               <input  class="all-fields rfq-input-size" id="00N6g00000Tj7ls" maxlength="255" name="00N6g00000Tj7ls" size="20" type="text" placeholder="Size *" />

               <input  class="all-fields rfq-input-shape" id="00N6g00000TBLtL" maxlength="255" name="00N6g00000TBLtL" size="20" type="text" placeholder="Shape" />

               <?php

               $suom = [
                    'id' => '00N6g00000TtToL',
                    'class' => ['all-fields', 'rfq-input-size-measure'],
                    'select_text' => 'Size Unit of Measure *',
                    'width' => '100%',
                    'values' => [
                         'Angstroms' => 'Angstroms',
                         'Centimeters' => 'Centimeters',
                         'Chip' => 'Chip',
                         'Feet' => 'Feet',
                         'Grams' => 'Grams',
                         'Grit' => 'Grit',
                         'Inches' => 'Inches',
                         'Mesh' => 'Mesh',
                         'Meters' => 'Meters',
                         'Microns' => 'Microns',
                         'Millimeters' => 'Millimeters',
                         'Nanometers' => 'Nanometers',
                         'Ounces' => 'Ounces',
                         'Parts' => 'Parts',
                         'Pieces' => 'Pieces',
                         'Troy Ounces' => 'Troy Ounces'
                    ],
                    'svg' => '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"></path>
                                    </svg>'
               ];

               tf_dropdown($suom);

               ?>

               <input  class="all-fields rfq-input-purity" id="00N6g00000TUVFy" maxlength="255" name="00N6g00000TUVFy" size="20" type="text" placeholder="Min. Purity *" />

               <input  class="all-fields rfq-input-quantity" id="00N6g00000TUVG3" name="00N6g00000TUVG3" size="20" type="text" placeholder="Quantity *" />

               <?php

               $quom = [
                    'id' => '00N6g00000TUVFo',
                    'class' => ['all-fields', 'rfq-input-quantity-measure'],
                    'select_text' => 'Quantity Unit of Measure *',
                    'width' => '100%',
                    'values' => [
                         'Bag' => 'Bag',
                         'Bottle' => 'Bottle',
                         'Box' => 'Box',
                         'Can' => 'Can',
                         'Centimeters' => 'Centimeters',
                         'Drum' => 'Drum',
                         'Each' => 'Each',
                         'Feet' => 'Feet',
                         'Gallon' => 'Gallon',
                         'Grams' => 'Grams',
                         'Inches' => 'Inches',
                         'Jar' => 'Jar',
                         'Kilograms' => 'Kilograms',
                         'Meters' => 'Meters',
                         'Metric Tons' => 'Metric Tons',
                         'Millimeters' => 'Millimeters',
                         'N/A' => 'N/A',
                         'Net Tons' => 'Net Tons',
                         'Ounces' => 'Ounces',
                         'Pieces' => 'Pieces',
                         'Pouches' => 'Pouches',
                         'Pounds' => 'Pounds',
                         'Super Sack' => 'Super Sack',
                         'Troy Ounces' => 'Troy Ounces'
                    ],
                    'svg' => '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"></path>
                                    </svg>'
               ];

               tf_dropdown($quom);

               ?>

               <textarea  class="all-fields rfq-input-general-application" id="00N6g00000TUVG8" name="00N6g00000TUVG8" rows="3" type="text" wrap="soft" placeholder="General Application *"></textarea>

               <div class="all-fields rfq-currently-using">
                    <p><input  id="r-currently-using-yes" name="r-currently-using" type="radio" value="1" /><label for="r-currently-using-yes">Currently using this product</label></p>

                    <p><input  id="r-currently-using-no" name="r-currently-using" type="radio" value="0" /><label for="r-currently-using-no">  Not currently using this product</label></p>
               </div>

               <button id="rfq-form-next" class="btn-blue-dark-blue btn-arrow">
                    Next
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 5.95428C12.348 5.61257 12.902 5.61257 13.2437 5.95428L16.7437 9.45428C17.0854 9.79599 17.0854 10.35 16.7437 10.6917L13.2437 14.1917C12.902 14.5334 12.348 14.5334 12.0063 14.1917C11.6646 13.85 11.6646 13.296 12.0063 12.9543L14.0126 10.948H3.875C3.39175 10.948 3 10.5562 3 10.073C3 9.58975 3.39175 9.198 3.875 9.198H14.0126L12.0063 7.19172C11.6646 6.85001 11.6646 6.29599 12.0063 5.95428Z" fill="#FAFAFA"/>
                    </svg>

               </button>
          </div>
          <div class="rfq-form-slide-2 rfq-form-slide rfq-form-slide-hidden">

               <input  class="all-fields-2" id="r-first_name" maxlength="40" name="first_name" size="20" type="text" placeholder="First Name *" />

               <input  class="all-fields-2" id="r-last_name" maxlength="80" name="last_name" size="20" type="text" placeholder="Last Name *" />

               <input  class="all-fields-2" id="r-company" maxlength="40" name="company" size="20" type="text" placeholder="Company *"/>

               <textarea id="r-street" class="all-fields-2" name="street" placeholder="Street"></textarea>

               <input  class="all-fields-2" id="r-city" maxlength="40" name="city" size="20" type="text" placeholder="City *" />

               <input  class="all-fields-2" id="r-state" maxlength="20" name="state" size="20" type="text" placeholder="State/Providence *" />

               <input  class="all-fields-2" id="r-zip" maxlength="20" name="zip" size="20" type="text" placeholder="ZIP *" />

               <input  class="all-fields-2" id="r-country" maxlength="40" name="country" size="20" type="text" placeholder="Country *" />

               <input  class="all-fields-2" id="r-phone" maxlength="40" name="phone" size="20" type="text" placeholder="Phone *" />

               <input  class="all-fields-2" id="r-email" maxlength="80" name="email" size="20" type="text" placeholder="Email *"/>
               <?php

               $pmoc = [
                    'id' => 'r-00N6g00000TtToJ',
                    'class' => ['all-fields-2'],
                    'select_text' => 'Preferred Method of Contact *',
                    'width' => '100%',
                    'values' => [
                         'Email' => 'Email',
                         'Phone' => 'Phone'
                    ],
                    'svg' => '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"></path>
                                    </svg>'
               ];

               tf_dropdown($pmoc);

               ?>

               <textarea class="all-fields-2"  id="r-00N3J000001mdyh" name="00N3J000001mdyh" rows="3" type="text" wrap="soft" placeholder="Notes"></textarea>


               <?php

               $hdyfu = [
                    'id' => 'r-00N6g00000TtToG',
                    'class' => ['all-fields-2'],
                    'select_text' => 'How did you find us? *',
                    'width' => '100%',
                    'values' => [
                         'Online Advetising' => 'Online Advertising',
                         'Other' => 'Other',
                         'Particle Technology Referral' => 'Particle Technology Referral',
                         'Print Advertising' => 'Print Advertising',
                         'Referral' => 'Referral',
                         'Return Customer' => 'Return Customer',
                         'Search Engine' => 'Search Engine',
                         'Thomasnet' => 'Thomasnet'
                    ],
                    'svg' => '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"></path>
                                    </svg>'
               ];

               tf_dropdown($hdyfu);

               ?>


               <input  class="all-fields-2" id="r-00N6g00000U3avS" maxlength="255" name="00N6g00000U3avS" size="20" type="text" placeholder="Enter how you found us *" style="display: none;" value="" />

               <p class="all-fields-2" id="p-accept-terms"><input id="r-accept-terms" type="checkbox" name="r-accept-terms"> I have read and accept the <a href="/about-us/terms-conditions-of-sale/">terms and conditions of sale</a></p>

               <div class="rfq-form-controls">
                    <button id="rfq-form-previous" class="btn-blue-dark-blue btn-arrow-reverse">
                         <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 5.95428C12.348 5.61257 12.902 5.61257 13.2437 5.95428L16.7437 9.45428C17.0854 9.79599 17.0854 10.35 16.7437 10.6917L13.2437 14.1917C12.902 14.5334 12.348 14.5334 12.0063 14.1917C11.6646 13.85 11.6646 13.296 12.0063 12.9543L14.0126 10.948H3.875C3.39175 10.948 3 10.5562 3 10.073C3 9.58975 3.39175 9.198 3.875 9.198H14.0126L12.0063 7.19172C11.6646 6.85001 11.6646 6.29599 12.0063 5.95428Z" fill="#FAFAFA"/>
                         </svg>
                         Previous
                    </button>
                    <button id="rfq-form-submit" class="btn-blue-dark-blue" type="submit" name="submit">
                         Submit
                         <svg class="spinner" viewBox="0 0 50 50">
                              <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                         </svg>
                    </button>
               </div>
          </div>

     </form>

     <?php if($fields['icon'] != 'no-svg') :?>
      <div class="rfq-form--decor <?php echo $fields['icon'] ;?>" aria-hidden="true"></div>
     <?php endif ;?>
    </div>
    <?php if(!empty($fields['image'])) :?>
     <div class="rfq-form--image">
      <figure>
       <?php echo wp_get_attachment_image( $fields['image']['ID'], 'full' );?>
      </figure>
     </div>
    <?php endif ;?>
   </div>
  </div>
 </div>
</div>

