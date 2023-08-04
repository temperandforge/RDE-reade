import loadjs from 'loadjs'
const { $ } = window
const $body = $(document.body)

export default {
  init() {

  },
  finalize() {
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

        if (errors.length) {
          return false;
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
            $('.rfq-error-message').hide();
            $(this).find('.spinner').css('display', 'block');
            $(this).find('svg:not(.spinner').css('display', 'none');
            $.ajax({
                type: "POST",
                url: "/wp-content/themes/reade-theme/_woo-ajax.php",
                data: 'action=doSubmit&formData=x',
                success: function(responseText){
                  //alert(responseText);
                  if (responseText == 'success') {
                    $(this).find('.spinner').css('display', 'none');
                    $(this).find('svg:not(.spinner').css('display', 'block');

                    document.location.href = '/itemized-rfq-form-success/';
                  }
                },
                error: function() {
                  //alert('there was an error');
                },
                complete: function() {
                }
              });

          } else {
            // do this
            //$('.rfq-error-message').html('<p>' + errors.toString() + '</p>');
            //$('.rfq-error-message').show();

            let fields = $('.piq-form input:not([type="submit"])');
            fields.each(function(index, element) {
              $(element).removeClass('rfq-error');
            });

            errorFields.forEach(function(id) {
              document.getElementById(id).classList.add('rfq-error');
            });

            enableForm();
          }
      });
      
    }

    handleRFQSubmit();
  },
}