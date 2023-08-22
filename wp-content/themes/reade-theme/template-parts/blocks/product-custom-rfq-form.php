<?php

$fields = get_fields();

?>

<div class="rfq-form--section">
 <div class="rfq-form--main">
  <div class="rfq-form--inner">
   <div class="rfq-form--wrap">
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

               <!--  ----------------------------------------------------------------------  -->
               <!--  NOTE: These fields are optional debugging elements. Please uncomment    -->
               <!--  these lines if you wish to test in debug mode.                          -->
               <!--  <input type="hidden" name="debug" value=1>                              -->
               <!--  <input type="hidden" name="debugEmail"                                  -->
               <!--  value="accounts@temperandforge.com">                                    -->
               <!--  ----------------------------------------------------------------------  -->

               <input  id="lead_source" name="lead_source" value="Website" type="hidden"></select>

               <input  class="all-fields rfq-input-product" id="00N6g00000TUVFe" maxlength="255" name="00N6g00000TUVFe" size="20" type="text" placeholder="Material or Chemical Formula *" />

               <input  class="all-fields rfq-input-size" id="00N6g00000Tj7ls" maxlength="255" name="00N6g00000Tj7ls" size="20" type="text" placeholder="Size *" />

               <input  class="all-fields rfq-input-shape" id="00N6g00000TBLtL" maxlength="255" name="00N6g00000TBLtL" size="20" type="text" placeholder="Shape" />

               <select  class="all-fields rfq-input-size-measure" id="00N6g00000TtToL" name="00N6g00000TtToL" title="Size Unit of Measure">
                    <option value="0">Size Unit of Measure *</option><option value="Angstroms">Angstroms</option>
                    <option value="Centimeters">Centimeters</option>
                    <option value="Chip">Chip</option>
                    <option value="Feet">Feet</option>
                    <option value="Grams">Grams</option>
                    <option value="Grit">Grit</option>
                    <option value="Inches">Inches</option>
                    <option value="Mesh">Mesh</option>
                    <option value="Meters">Meters</option>
                    <option value="Microns">Microns</option>
                    <option value="Millimeters">Millimeters</option>
                    <option value="Nanometers">Nanometers</option>
                    <option value="Ounces">Ounces</option>
                    <option value="Parts">Parts</option>
                    <option value="Pieces">Pieces</option>
                    <option value="Troy Ounces">Troy Ounces</option>
               </select>

               <input  class="all-fields rfq-input-purity" id="00N6g00000TUVFy" maxlength="255" name="00N6g00000TUVFy" size="20" type="text" placeholder="Min. Purity *" />

               <input  class="all-fields rfq-input-quantity" id="00N6g00000TUVG3" name="00N6g00000TUVG3" size="20" type="text" placeholder="Quantity *" />

               <select  class="all-fields rfq-input-quantity-measure" id="00N6g00000TUVFo" name="00N6g00000TUVFo" title="Unit of Measure"><option value="0">Quantity Unit of Measure *</option>
                    <option value="Bag">Bag</option>
                    <option value="Bottle">Bottle</option>
                    <option value="Box">Box</option>
                    <option value="Can">Can</option>
                    <option value="Centimeters">Centimeters</option>
                    <option value="Drum">Drum</option>
                    <option value="Each">Each</option>
                    <option value="Feet">Feet</option>
                    <option value="Gallon">Gallon</option>
                    <option value="Grams">Grams</option>
                    <option value="Inches">Inches</option>
                    <option value="Jar">Jar</option>
                    <option value="Kilograms">Kilograms</option>
                    <option value="Meters">Meters</option>
                    <option value="Metric Tons">Metric Tons</option>
                    <option value="Millimeters">Millimeters</option>
                    <option value="N/A">N/A</option>
                    <option value="Net Tons">Net Tons</option>
                    <option value="Ounces">Ounces</option>
                    <option value="Pieces">Pieces</option>
                    <option value="Pouches">Pouches</option>
                    <option value="Pounds">Pounds</option>
                    <option value="Super Sack">Super Sack</option>
                    <option value="Troy Ounces">Troy Ounces</option>
               </select>

               <textarea  class="all-fields rfq-input-general-application" id="00N6g00000TUVG8" name="00N6g00000TUVG8" rows="3" type="text" wrap="soft" placeholder="General Application *"></textarea>

               <div class="all-fields rfq-currently-using">
                    <p><input  id="00N6g00000TtToF" name="00N6g00000TtToF" type="checkbox" value="1" /><label for="00N6g00000TtToF">Currently using this product</label></p>

                    <p><input  id="00N6g00000TtToH" name="00N6g00000TtToH" type="checkbox" value="1" /><label for="00N6g00000TtToH">  Not currently using this product</label></p>
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

               <select class="all-fields-2"  id="r-00N6g00000TtToJ" name="00N6g00000TtToJ" title="Preferred Method of Contact">
                    <option value="0">Preferred Method of Contact *</option><option value="Email">Email</option>
                    <option value="Phone">Phone</option>
               </select>

               <textarea class="all-fields-2"  id="r-00N3J000001mdyh" name="00N3J000001mdyh" rows="3" type="text" wrap="soft" placeholder="Notes"></textarea>

               <select class="all-fields-2"  id="r-00N6g00000TtToG" name="00N6g00000TtToG" title="Find Us"><option value="0">How did you find us? *</option>
                    <option value="Online Advertising">Online Advertising</option>
                    <option value="Other">Other</option>
                    <option value="Particle Technolgy  Referral">Particle Technolgy  Referral</option>
                    <option value="Print Advertising">Print Advertising</option>
                    <option value="Referral">Referral</option>
                    <option value="Return Customer">Return Customer</option>
                    <option value="Search Engine">Search Engine</option>
                    <option value="Thomasnet">Thomasnet</option>
               </select>

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

