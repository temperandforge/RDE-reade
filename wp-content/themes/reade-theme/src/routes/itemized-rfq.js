import loadjs from 'loadjs'
const { $ } = window
const $body = $(document.body)

export default {
  init() {

  },
  finalize() {

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

        if ($('#rfq-address-line-1').val() == '') {
          errors.push('Please enter an address');
          if (!errorFields.includes('rfq-address-line-1')) {
            errorFields.push('rfq-address-line-1');
          }
        }

        if ($('#rfq-city').val() == '') {
          errors.push('Please enter a city');
          if (!errorFields.includes('rfq-city')) {
            errorFields.push('rfq-city');
          }
        }

        if ($('#rfq-state').val() == '') {
          errors.push('Please enter a state');
          if (!errorFields.includes('rfq-state')) {
            errorFields.push('rfq-state');
          }
        }

        if ($('#rfq-zip').val() == '') {
          errors.push('Please enter a ZIP');
          if (!errorFields.includes('rfq-zip')) {
            errorFields.push('rfq-zip');
          }
        }

        if ($('#find_us p').text() == 'How did you find us?') {
          errors.push('Please let us know how you found READE');
          if (!errorFields.includes('find_us')) {
            errorFields.push('find_us');
          }
        }

        if ($('#find_us p').text() == 'Other') {
          if ($('#rfq-find-us-other').val() == '') {
            errors.push('Please enter how you found READE');
            if (!errorFields.includes('rfq-find-us-other')) {
              errorFields.push('rfq-find-us-other');
            }
          }
        }
        
        if (!$('#rfq-accept-terms').is(':checked')) {
          errors.push('Please accept the terms and conditions of sale');
          if (!errorFields.includes('rfq-tos')) {
            errorFields.push('rfq-tos');
          }
        }

        if (errors.length) {
          return false;
        }


        // update salesforce form with values from this field
        $('#sf-form #first_name').val($('#rfq-first-name').val());
        $('#sf-form #last_name').val($('#rfq-last-name').val());
        $('#sf-form #company').val($('#rfq-company').val());
        $('#sf-form #phone').val($('#rfq-phone').val());
        $('#sf-form #email').val($('#rfq-email').val());
        $('#sf-form #street').text($('#rfq-address-line-1').val() + ($('#rfq-address-line-2').val() ? "\r\n" + $('#rfq-address-line-2').val() : ''));
        $('#sf-form #city').val($('#rfq-city').val());
        $('#sf-form #state').val($('#rfq-state').val());
        $('#sf-form #zip').val($('#rfq-zip').val());
        $('#00N3J000001mdyh').text($('#rfq-notes').val());

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

        // product 1 name
        if ($('#sf-product-1-name').length) {
          if ($('#sf-product-1-name').text() != '') {
            $('#00N3J000001mcrB').val($('#sf-product-1-name').text());

            // product 1 details
            $('#00N3J000001mcrG').text($('#sf-product-1-qty').val() + "\r\n" + $('dl#product-units-1 dt p').text() + "\r\n" + $('#sf-product-1-attributes').text());
          } else {
            $('#00N3J000001mcrB').val('');
            $('#00N3J000001mcrG').text('');
          }
        } else {
          $('#00N3J000001mcrB').val('');
          $('#00N3J000001mcrG').text('');
        }



        // product 2 name
        if ($('#sf-product-2-name').length) {
          if ($('#sf-product-2-name').text() != '') {
            $('#00N3J000001mcrL').val($('#sf-product-2-name').text());

            // product 2 details
            $('#00N3J000001mcrQ').text($('#sf-product-2-qty').val() + "\r\n" + $('dl#product-units-2 dt p').text() + "\r\n" + $('#sf-product-2-attributes').text());
          } else {
            $('#00N3J000001mcrL').val('');
            $('#00N3J000001mcrQ').text('');
          }
        } else {
          $('#00N3J000001mcrL').val('');
          $('#00N3J000001mcrQ').text('');
        }

        // product 3 name
        if ($('#sf-product-3-name').length) {
          if ($('#sf-product-3-name').text() != '') {
            $('#00N3J000001mcrV').val($('#sf-product-3-name').text());

            // product 3 details
            $('#00N3J000001mcra').text($('#sf-product-3-qty').val() + "\r\n" + $('dl#product-units-3 dt p').text() + "\r\n" + $('#sf-product-3-attributes').text());
          }else {
            $('#00N3J000001mcrV').val('');
            $('#00N3J000001mcra').text('');
          }
        } else {
          $('#00N3J000001mcrV').val('');
          $('#00N3J000001mcra').text('');
        }

        // product 4 name
        if ($('#sf-product-4-name').length) {
          if ($('#sf-product-4-name').text() != '') {
            $('#00N3J000001mdxo').val($('#sf-product-4-name').text());

            // product 4 details
            $('#00N3J000001mdxt').text($('#sf-product-4-qty').val() + "\r\n" + $('dl#product-units-4 dt p').text() + "\r\n" + $('#sf-product-4-attributes').text());
          }else {
            $('#00N3J000001mdxo').val('');
            $('#00N3J000001mdxt').text('');
          }
        } else {
          $('#00N3J000001mdxo').val('');
          $('#00N3J000001mdxt').text('');
        }

        // product 5 name
        if ($('#sf-product-5-name').length) {
          if ($('#sf-product-5-name').text() != '') {
            $('#00N3J000001mdxy').val($('#sf-product-5-name').text());

            // product 5 details
            $('#00N3J000001mdy8').text($('#sf-product-5-qty').val() + "\r\n" + $('dl#product-units-5 dt p').text() + "\r\n" + $('#sf-product-5-attributes').text());
          }else {
            $('#00N3J000001mdxy').val('');
            $('#00N3J000001mdy8').text('');
          }
        } else {
          $('#00N3J000001mdxy').val('');
          $('#00N3J000001mdy8').text('');
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
        
            $('#sf-form-submit').click();
            // $(this).find('.spinner').css('display', 'block');
            // $(this).find('svg:not(.spinner').css('display', 'none');
            // $.ajax({
            //     type: "POST",
            //     url: "/wp-content/themes/reade-theme/_woo-ajax.php",
            //     data: 'action=doSubmit&formData=x',
            //     success: function(responseText){
            //       //alert(responseText);
            //       if (responseText == 'success') {
            //         $(this).find('.spinner').css('display', 'none');
            //         $(this).find('svg:not(.spinner').css('display', 'block');

            //         document.location.href = '/itemized-rfq-form-success/';
            //       }
            //     },
            //     error: function() {
            //       //alert('there was an error');
            //     },
            //     complete: function() {
            //     }
            //   });

          } else {
            // do this
            //$('.rfq-error-message').html('<p>' + errors.toString() + '</p>');
            //$('.rfq-error-message').show();

            let fields = $('.piq-form input:not([type="submit"])');
            fields.each(function(index, element) {
              $(element).removeClass('rfq-error');
            });
            $('#find_us').removeClass('rfq-error');
            $('#rfq-tos').removeClass('rfq-error');

            errorFields.forEach(function(id) {
              document.getElementById(id).classList.add('rfq-error');
            });

            enableForm();
          }
      });
      
    }

    handleRFQSubmit();
    handleRFQDropdown();
  },
}