import loadjs from 'loadjs'
const { $ } = window
const $body = $(document.body)

export default {
  init() {

  },
  finalize() {

    function handleCurrentlyUsing() {

      function debounce(fn, duration) {
        var timer;
        return function(e){
          clearTimeout(timer);
          timer = setTimeout(fn, duration, e);
        }
      }

      $('.general-application-textarea').on('input', debounce((e) => {
        let $thistextarea = e.target;
        let $thisitem = $(e.target).parent().parent().parent();
        let $thiscartkey = $thisitem.data('cart-key');
        let $thisvalue = $(e.target).val();

        $.ajax({
          type: "POST",
          url: "/wp-content/themes/reade-theme/_woo-ajax.php",
          data: 'action=doUpdateGeneralApplication&cart-key=' + $thiscartkey + '&value=' + $thisvalue,
          success: function(responseText){
            if (responseText != 'success') {
              console.log('something went wrong saving this response, please try again.');
            }
          },
          error: function() {
            //alert('there was an error');
          },
          complete: function() {
          }
        });

      }, 500));

      $('input[type="radio"]').on('change', function(e) {
        let thisvalue = $(this).val();
        let thisitem = $(this).parent().parent().parent().parent();
        let thiscartkey = thisitem.data('cart-key');

        $.ajax({
          type: "POST",
          url: "/wp-content/themes/reade-theme/_woo-ajax.php",
          data: 'action=doChangeCurrentlyUsing&cart-key=' + thiscartkey + '&value=' + thisvalue,
          success: function(responseText){
            //alert(responseText);
            if (responseText != 'success') {
              console.log('something went wrong saving this response, please try again.');
            }
          },
          error: function() {
            //alert('there was an error');
          },
          complete: function() {
          }
        });
      });
    }

    function handleGeneralApplication() {

    }

    function handleRFQDropdown() {
      $('#find_us ul li').on('click', function() {
        let livalue = $(this).text();
        $('#find_us p').css('color', '#045');

        if (livalue == 'Other') {
          $('#rfq-find-us-other').css('display', 'block');
        } else {
          $('#rfq-find-us-other').css('display', 'none');
        }
      })

      $('#how-to-contact ul li').on('click', function() {
        $('#how-to-contact p').css('color', '#045');
      })

      $('#rfq-state ul li').on('click', function() {
        $('#rfq-state p').css('color', '#045');
      })

      $('#rfq-country ul li').on('click', function() {
        $('#rfq-country p').css('color', '#045');
      })
    }

    function handleRFQSubmit() {
      let errors = [];
      let errorFields = [];

      function validateRFQForm() {
        errorFields = [];
        errors = [];
        // input type="text" id="rfq-first-name" name="rfq-first-name" placeholder="First Name" value="">
        //                     <input type="text" id="rfq-last-name" name="rfq-last-name" placeholder="Last Name" value="">
        //                     <input type="text" id="rfq-company" name="rfq-company" placeholder="Company" value="">
        //                     <input type="phone" id="rfq-phone" name="rfq-phone" placeholder="Phone Number" value="">
        //                     <input type="email" id="rfq-email" name="rfq-email" placeholder="Email" value="">
        //                     <input type="text" id="rfq-address-line-1" name="rfq-address-line-1" placeholder="Address" value="">
        //                     <input type="text" id="rfq-address-line-2" name="rfq-address-line-2" placeholder="Address Line 2" value="">
        //                     <input type="text" id="rfq-city" name="rfq-city" placeholder="City" value="">
        //                     <input type="text" id="rfq-state" name="rfq-state" placeholder="State" value="">
        //                     <input type="text" id="rfq-zip" name="rfq-zip" placeholder="Zip" value="">

        if ($('#rfq-first-name').val() == '') {
          errors.push('Please enter a first name');
          if (!errorFields.includes('rfq-first-name')) {
            errorFields.push('rfq-first-name');
          }
        }

        if ($('#rfq-last-name').val() == '') {
          errors.push('Please enter a last name');
          if (!errorFields.includes('rfq-last-name')) {
            errorFields.push('rfq-last-name');
          }
        }

        if ($('#rfq-company').val() == '') {
          errors.push('Please enter a company');
          if (!errorFields.includes('rfq-company')) {
            errorFields.push('rfq-company');
          }
        }
        
        if ($('#rfq-phone').val() == '') {
          errors.push('Please enter a phone number');
          if (!errorFields.includes('rfq-phone')) {
            errorFields.push('rfq-phone');
          }
        } else {
          let phoneNumber = $('#rfq-phone').val();
          let cleanedPhoneNumber = phoneNumber.replace(/\D/g, '');
          let phoneRegex = /^[0-9]{10,15}$/;

          if (!phoneRegex.test(cleanedPhoneNumber)) {
            errors.push('Please enter a valid phone number');
            if (!errorFields.includes('rfq-phone')) {
              errorFields.push('rfq-phone');
            }
          }
        }

        if ($('#rfq-email').val() == '') {
          errors.push('Please enter an email address');
          if (!errorFields.includes('rfq-email')) {
            errorFields.push('rfq-email');
          }
        } else {
          let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test($('#rfq-email').val())) {
            errors.push = 'Please enter a valid email address';
            if (!errorFields.includes('rfq-email')) {
              errorFields.push('rfq-email');
            }
          }
        }

        // is now optional, no longer required
        // if ($('#rfq-address-line-1').val() == '') {
        //   errors.push('Please enter an address');
        //   if (!errorFields.includes('rfq-address-line-1')) {
        //     errorFields.push('rfq-address-line-1');
        //   }
        // }

        // is now optional, no longer required
        // if ($('#rfq-city').val() == '') {
        //   errors.push('Please enter a city');
        //   if (!errorFields.includes('rfq-city')) {
        //     errorFields.push('rfq-city');
        //   }
        // }

        // is now optional, no longer required
        // if ($('#rfq-state p').text() == 'State/Providence') {
        //   errors.push('Please enter a state');
        //   if (!errorFields.includes('rfq-state')) {
        //     errorFields.push('rfq-state');
        //   }
        // }

        // is now optional, no longer required
        // if ($('#rfq-zip').val() == '') {
        //   errors.push('Please enter a ZIP');
        //   if (!errorFields.includes('rfq-zip')) {
        //     errorFields.push('rfq-zip');
        //   }
        // }

        if ($('#find_us p').text() == 'How did you find us? *') {
          errors.push('Please let us know how you found READE');
          if (!errorFields.includes('find_us')) {
            errorFields.push('find_us');
          }
        }

        // is now optional, no longer required
        // if ($('#rfq-country p').text() == 'Select Country') {
        //   errors.push('Please enter a country');
        //   if (!errorFields.includes('rfq-country')) {
        //     errorFields.push('rfq-country');
        //   }
        // }

        if ($('#find_us p').text() == 'Other') {
          if ($('#rfq-find-us-other').val() == '') {
            errors.push('Please enter how you found READE');
            if (!errorFields.includes('rfq-find-us-other')) {
              errorFields.push('rfq-find-us-other');
            }
          }
        }
        
        // optional, no longer required
        // if ($('#how-to-contact p').text() == 'Preferred method of contact?') {
        //   errors.push('Please select your preferred method of contact');
        //   if (!errorFields.includes('how-to-contact')) {
        //     errorFields.push('how-to-contact');
        //   }
        // }

        if (!$('#rfq-accept-terms').is(':checked')) {
          errors.push('Please accept the terms and conditions of sale');
          if (!errorFields.includes('rfq-tos')) {
            errorFields.push('rfq-tos');
          }
        }

        let items = $('.piq-cart-item');

       // if (items.length) {

          // check textarea info is there
          // items.each(function(index, element) {
          //   let $thisitem = $(this);
          //   let thiscartkey = $thisitem.data('cart-key');

          //   // general application is now optional, no longer required

          //   // if ($thisitem.find('#rfq-' + thiscartkey + '-general-application').val() == '') {
          //   //   errors.push('Please enter general application details');
          //   //   if (!errorFields.includes('rfq-' + thiscartkey + '-general-application')) {
          //   //     errorFields.push('rfq-' + thiscartkey + '-general-application');
          //   //   }
          //   //   if (!errorFields.includes('general-application-' + thiscartkey)) {
          //   //     errorFields.push('general-application-' + thiscartkey);
          //   //   }
          //   // }
          // });

          // check radio button has been selected
          // items.each(function(index, element) {
          //   let $thisradio = $(this);
          //   let thisradiocartkey = $thisradio.data('cart-key');
            
          //   // currently using is now optional, no longer required
            
          //   // if ($thisradio.find('input[type="radio"]:checked').length != 1) {
          //   //   errors.push('Please select currently using status');
          //   //   if (!errorFields.includes('currently-using-' + thisradiocartkey)) {
          //   //     errorFields.push('currently-using-' + thisradiocartkey);
          //   //   }
          //   //   if (!errorFields.includes('rfq-' + thisradiocartkey + '-using-yes')) {
          //   //     errorFields.push('rfq-' + thisradiocartkey + '-using-yes');
          //   //   }
          //   //   if (!errorFields.includes('rfq-' + thisradiocartkey + '-using-no')) {
          //   //     errorFields.push('rfq-' + thisradiocartkey + '-using-no');
          //   //   }
          //   // }
          // });
       // }

        if (errors.length) {
          return false;
        }


        // update salesforce form with values from this field
        $('#sf-form #first_name').val($('#rfq-first-name').val());
        $('#sf-form #last_name').val($('#rfq-last-name').val());
        $('#sf-form #company').val($('#rfq-company').val());
        $('#sf-form #phone').val($('#rfq-phone').val());
        $('#sf-form #sfemail').val($('#rfq-email').val());
        $('#sf-form #street').text($('#rfq-address-line-1').val() ? $('#rfq-address-line-1').val() : 'Not Specified' + ($('#rfq-address-line-2').val() ? "\r\n" + $('#rfq-address-line-2').val() : ''));
        $('#sf-form #city').val($('#rfq-city').val() ? $('#rfq-city').val() : 'Not Specified');
        $('#sf-form #state').val($('#rfq-state dt p').text() == 'State/Providence' ? 'Not Specified' : $('#rfq-state dt p').text());
        $('#sf-form #country').val($('#rfq-country dt p').text());
        $('#sf-form #zip').val($('#rfq-zip').val() ? $('#rfq-zip').val() : 'Not Specified');
        
        // additional comments
        $('#00N6g00000TtToE').text($('#rfq-notes').val());

        // how they found us
        $('#00N6g00000TtToG').val($('#find_us p').text());

        // found us details - if "other" is selected
        $('#00N6g00000U3avS').val($('#rfq-find-us-other').val());

        // preferred method of contact
        if ($('#how-to-contact p').text() != 'Preferred method of contact?') {
          $('#00N6g00000TtToJ').val($('#how-to-contact p').text());
        } else {
          $('#00N6g00000TtToJ').val('Unspecified');
        }

        let p1cu, p2cu, p3cu, p4cu, p5cu;

        // product 1 name
        if ($('#sf-product-1-name').length) {
          if ($('#sf-product-1-name').text() != '') {
            $('#00N6g00000VMFwG').val($('#sf-product-1-name').text());

            // product 1 details
            p1cu = $('#product-1-using input[type="radio"]:checked').val();

            if (p1cu === undefined) {
              p1cu = 'Not Specified';
            } else {
              p1cu = $('#product-1-using input[type="radio"]:checked').val() == '1' ? 'Yes' : 'No';
            }

            //console.log($('#product-1-using input[type="radio"]:checked').val());
            $('#00N6g00000VMFwF').text($('#sf-product-1-qty').val() + "\r\n" + $('dl#product-units-1 dt p').text() + "\r\n" + $('#sf-product-1-attributes').text() + "\r\nCurrently Using: " + p1cu + "\r\nGeneral Application: " + ($('.product-1-general-application').val() ? $('.product-1-general-application').val() : 'Not Specified'));
          } else {
            $('#00N6g00000VMFwG').val('');
            $('#00N6g00000VMFwF').text('');
          }
        } else {
          $('#00N6g00000VMFwG').val('');
          $('#00N6g00000VMFwF').text('');
        }



        // product 2 name
        if ($('#sf-product-2-name').length) {
          if ($('#sf-product-2-name').text() != '') {
            $('#00N6g00000VMFwI').val($('#sf-product-2-name').text());

            // product 2 details
            p2cu = $('#product-2-using input[type="radio"]:checked').val();

            if (p2cu === undefined) {
              p2cu = 'Not Specified';
            } else {
              p2cu = $('#product-2-using input[type="radio"]:checked').val() == '1' ? 'Yes' : 'No';
            }
            $('#00N6g00000VMFwH').text($('#sf-product-2-qty').val() + "\r\n" + $('dl#product-units-2 dt p').text() + "\r\n" + $('#sf-product-2-attributes').text() + "\r\nCurrently Using: " + p2cu + "\r\nGeneral Application: " + ($('.product-2-general-application').val() ? $('.product-2-general-application').val() : 'Not Specified'));
          } else {
            $('#00N6g00000VMFwI').val('');
            $('#00N6g00000VMFwH').text('');
          }
        } else {
          $('#00N6g00000VMFwI').val('');
          $('#00N6g00000VMFwH').text('');
        }

        // product 3 name
        if ($('#sf-product-3-name').length) {
          if ($('#sf-product-3-name').text() != '') {
            $('#00N6g00000VMFwK').val($('#sf-product-3-name').text());

            // product 3 details
            p3cu = $('#product-3-using input[type="radio"]:checked').val();

            if (p3cu === undefined) {
              p3cu = 'Not Specified';
            } else {
              p3cu = $('#product-3-using input[type="radio"]:checked').val() == '1' ? 'Yes' : 'No';
            }
            $('#00N6g00000VMFwJ').text($('#sf-product-3-qty').val() + "\r\n" + $('dl#product-units-3 dt p').text() + "\r\n" + $('#sf-product-3-attributes').text() + "\r\nCurrently Using: " + p3cu + "\r\nGeneral Application: " + ($('.product-3-general-application').val() ? $('.product-3-general-application').val() : 'Not Specified'));
          }else {
            $('#00N6g00000VMFwK').val('');
            $('#00N6g00000VMFwJ').text('');
          }
        } else {
          $('#00N6g00000VMFwK').val('');
          $('#00N6g00000VMFwJ').text('');
        }

        // product 4 name
        if ($('#sf-product-4-name').length) {
          if ($('#sf-product-4-name').text() != '') {
            $('#00N6g00000VMFwM').val($('#sf-product-4-name').text());

            // product 4 details
            p4cu = $('#product-4-using input[type="radio"]:checked').val();

            if (p4cu === undefined) {
              p4cu = 'Not Specified';
            } else {
              p4cu = $('#product-4-using input[type="radio"]:checked').val() == '1' ? 'Yes' : 'No';
            }
            $('#00N6g00000VMFwL').text($('#sf-product-4-qty').val() + "\r\n" + $('dl#product-units-4 dt p').text() + "\r\n" + $('#sf-product-4-attributes').text() + "\r\nCurrently Using: " + p4cu + "\r\nGeneral Application: " + ($('.product-4-general-application').val() ? $('.product-4-general-application').val() : 'Not Specified'));
          }else {
            $('#00N6g00000VMFwM').val('');
            $('#00N6g00000VMFwL').text('');
          }
        } else {
          $('#00N6g00000VMFwM').val('');
          $('#00N6g00000VMFwL').text('');
        }

        // product 5 name
        if ($('#sf-product-5-name').length) {
          if ($('#sf-product-5-name').text() != '') {
            $('#00N6g00000VMFwO').val($('#sf-product-5-name').text());

            // product 5 details
            p5cu = $('#product-5-using input[type="radio"]:checked').val();

            if (p1cu === undefined) {
              p5cu = 'Not Specified';
            } else {
              p5cu = $('#product-5-using input[type="radio"]:checked').val() == '1' ? 'Yes' : 'No';
            }
            $('#00N6g00000VMFwN').text($('#sf-product-5-qty').val() + "\r\n" + $('dl#product-units-5 dt p').text() + "\r\n" + $('#sf-product-5-attributes').text() + "\r\nCurrently Using: " + p5cu + "\r\nGeneral Application: " + ($('.product-5-general-application').val() ? $('.product-5-general-application').val() : 'Not Specified'));
          }else {
            $('#00N6g00000VMFwO').val('');
            $('#00N6g00000VMFwN').text('');
          }
        } else {
          $('#00N6g00000VMFwO').val('');
          $('#00N6g00000VMFwN').text('');
        }

        
        return true;


      }

      

      function disableForm() {
        $('#piq-form-submit').prop('disabled', true);
      }

      function enableForm() {
        $('#piq-form-submit').prop('disabled', false);
      }
      
      $('#piq-itemized-rfq').on('submit', function(e) {
          e.preventDefault();
          disableForm();

          if (validateRFQForm()) {
            e.preventDefault();
            

            $('.rfq-error-message').hide();

            //console.log('submit form');
             //submit form
             setTimeout(function() {
               $('#piq-itemized-rfq').off('submit').submit();
             }, 250);
          

          } else {

            let fields = $('.piq-form input:not([type="submit"])');
            fields.each(function(index, element) {
              $(element).removeClass('rfq-error');
            });
            $('#rfq-state').removeClass('rfq-error');
            $('#rfq-country').removeClass('rfq-error');
            $('#find_us').removeClass('rfq-error');
            $('#rfq-tos').removeClass('rfq-error');
            $('#how-to-contact').removeClass('rfq-error');
           // $('.general-application').removeClass('rfq-error');
            //$('.general-application-textarea').removeClass('rfq-error');
            //$('.rfq-using-yes').removeClass('rfq-error');
            //$('.rfq-using-no').removeClass('rfq-error');
            //$('.currently-using').removeClass('rfq-error');

            errorFields.forEach(function(id) {
              document.getElementById(id).classList.add('rfq-error');
            });

            enableForm();

            if (window.innerWidth <= 768) {
              if (document.getElementsByClassName('rfq-error').length) {
                document.getElementsByClassName('rfq-error')[0].scrollIntoView();
              }
            }
          }
      });
      
    }

    handleRFQSubmit();
    handleRFQDropdown();
    handleCurrentlyUsing();
    handleGeneralApplication();
  }
}
