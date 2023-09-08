<?php

$fields = get_fields();

?>


<div class="calc bg-grid">
   <svg class="section-full calc-boxes" width="170" height="224" viewBox="0 0 170 224" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19.2041 44.916L93.8502 1L168.398 44.916L93.8083 88.832V185.673L19.2041 141.771V44.916ZM19.2041 44.916L93.8083 88.832L168.398 44.916V141.771L93.8083 185.673" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
<path d="M0.999025 148.317L40.1267 125.297L79.2031 148.317L40.1047 171.336V222.098L0.999025 199.086V148.317ZM0.999025 148.317L40.1047 171.336L79.2031 148.317V199.086L40.1047 222.098" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
</svg>
   <?php

   $calculatorToShow = !empty($fields['calculator_type']) ? $fields['calculator_type'] : 'Particle Size Conversion Table';

   if ($calculatorToShow == 'Weight Conversion Table') {

      ?>
      <div class="calc-main">
         <div class="calc-info">
            <?php

            if (!empty($fields['weight_heading'])) {
               ?>
               <h2 class="calc-info-heading"><?php echo $fields['weight_heading']; ?></h2>
               <?php
            }

            if (!empty($fields['weight_content'])) {
               ?>
               <p class="calc-info-content"><?php echo $fields['weight_content']; ?></p>
               <?php
            }

            if (!empty($fields['weight_btn'])) {
               ?>
               <a class="btn-blue-dark-blue" href="<?php echo $fields['weight_btn']['url']; ?>" <?php if (!empty($fields['weight_btn']['target'])) { ?>target="_blank"<?php } ?>><?php echo $fields['weight_btn']['title']; ?></a>
                        <?php
            }

            ?>
         </div>
         <div class="calc-main-calc weight-table">
            <?php
            
            $th = array('from/to', 'g', 'kg', 'metric ton', 'grain', 'oz', 'lb');

            ?>
            <table cellspacing="0" cellpadding="2" border="0" width="100%">
               <thead>
                  <?php

                  for ($i = 0; $i < count($th); $i++) {
                     ?>
                     <th><?php echo $th[$i]; ?></th>
                     <?php
                  }

                  ?>
               </thead>
               <tbody>
                  <?php

                  if (!empty($fields['values'])) {
                     foreach ($fields['values'] AS $row) {
                        ?>
                        <tr>
                           <?php

                           foreach ($row AS $k => $v) {
                              ?>
                              <td><?php echo $v; ?></td>
                              <?php
                           }

                           ?>
                        </tr>
                        <?php
                     }
                  }

                  ?>
               </tbody>
            </table>
         </div>
      </div>

      <?php

   } else {


      if (!empty($fields['calculator_data'])) {

         // loop through each calculator type
         foreach ($fields['calculator_data'] AS $calc) {

            // a uniqid to identify each calculator via js in case multiple calculators are on the same page
            $thisCalc = uniqid();
            // if the type is equal to $calculatorToShow
            if ($calc['calculator_type'] == $calculatorToShow) {
               
               ?>
               <div class="calc-main <?php echo $thisCalc; ?> <?php echo strtolower(str_replace(' ', '-', $calculatorToShow)); ?>" data-calc="<?php echo $thisCalc; ?>">
                  <div class="calc-info">
                     <?php

                     if (!empty($calc['heading'])) {
                        ?>
                        <h2 class="calc-info-heading"><?php echo $calc['heading']; ?></h2>
                        <?php
                     }

                     if (!empty($calc['content'])) {
                        ?>
                        <p class="calc-info-content"><?php echo $calc['content']; ?></p>
                        <?php
                     }

                     if (!empty($calc['btn'])) {
                        ?>
                        <a class="btn-blue-dark-blue" href="<?php echo $calc['btn']['url']; ?>" <?php if (!empty($calc['btn']['target'])) { ?>target="_blank"<?php } ?>><?php echo $calc['btn']['title']; ?></a>
                        <?php
                     }

                     ?>
                  </div>
                  <div class="calc-main-calc">
                     <?php

                     if (!empty($calc['dropdown_groups'])) {
                        $groupCounter = 1;
                        foreach ($calc['dropdown_groups'] AS $ddg) {
                           ?>
                           <div class="calc-group">
                              <?php

                              if (!empty($ddg['dropdown_group_label'])) {
                                 ?>
                                 <div class="calc-group-label">
                                    <?php echo $ddg['dropdown_group_label']; ?>
                                 </div>
                                 <?php
                              }



                              if (!empty($ddg['dropdowns'])) {
                                 ?>
                                 <div class="calc-group-dd">
                                    <?php
                                    $ddCounter = 1;
                                    foreach ($ddg['dropdowns'] AS $dd) {
                                       
                                       $ddargs = array(
                                          'id' => 'dd-g' . $groupCounter . '-dd' . $ddCounter,
                                          'width' => '200px',
                                          'select_text' => $dd['label'],
                                          'show_all' => true,
                                          'show_all_text' => $dd['label'],
                                          'svg' => '<svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M0.519284 0.465493C0.28888 0.675366 0.272237 1.03228 0.482109 1.26269L5.25031 6.49734C5.35724 6.61473 5.50869 6.68164 5.66749 6.68164C5.82629 6.68164 5.97774 6.61473 6.08467 6.49734L10.8529 1.26268C11.0627 1.03228 11.0461 0.675365 10.8157 0.465492C10.5853 0.255619 10.2284 0.272263 10.0185 0.502667L5.66749 5.27932L1.31648 0.502668C1.1066 0.272264 0.749688 0.25562 0.519284 0.465493Z" fill="#004455"/>
                                             </svg>'
                                       );

                                       $vals = array();

                                       foreach ($dd['values'] AS $values) {
                                          $vals[] = $values['value'];
                                       }

                                       $ddargs['values'] = $vals;

                                       tf_dropdown($ddargs);
                                       
                                       $ddCounter++;
                                    }

                                    ?>
                                 </div>
                                 <?php
                              }

                              ?>
                           </div>
                           <?php

                           $groupCounter++;
                        }
                     }

                     ?>
                  </div>
               </div>
               <?php
            }

         }
      }
   }

   ?>
</div>