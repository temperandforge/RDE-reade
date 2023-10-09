import loadjs from 'loadjs'

const { $ } = window
const $body = $(document.body)


export default {
  init() {

  },
  finalize() {

    function disableForm() {
      $('#rfq-form-submit').prop('disabled', true);
      $('#rfq-form-submit svg').show();
    }

    function enableForm() {
      $('#rfq-form-submit').prop('disabled', false);
      $('#rfq-form-submit svg').hide();
    }

    let fieldsnotempty = ['rfq-input-product', 'rfq-input-size', 'rfq-input-size-measure', 'rfq-input-purity', 'rfq-input-quantity', 'rfq-input-quantity-measure', 'rfq-input-general-application'];
    let allfields2 = ['r-first_name', 'r-last_name', 'r-company', 'r-street', 'r-city', 'r-state', 'r-zip', 'r-country', 'r-phone', 'r-email'];
    let errorfields = [];
    let errorfields2 = [];

    $('#rfq-form-next').on('click', function(e) {
      e.preventDefault();

      if (validateFormPart1()) {
        $('.all-fields').removeClass('rfq-error');
        $('.rfq-form-slide-1').css('display', 'none').addClass('rfq-form-slide-hidden');
        $('.rfq-form-slide-2').fadeIn(function() {
          $(this).removeClass('rfq-form-slide-hidden');
        }).css('display', 'flex');
      } else {
        //console.log(errorfields);
        $('.all-fields').removeClass('rfq-error');
        $('#00N6g00000TtToL, #00N6g00000TUVFo').removeClass('rfq-error');

        for (let i = 0; i < errorfields.length; i++) {
          if (document.getElementsByClassName(errorfields[i]).length) {
            document.getElementsByClassName(errorfields[i])[0].classList.add('rfq-error');
          } else {
            if (document.getElementById(errorfields[i])) {
              document.getElementById(errorfields[i]).classList.add('rfq-error');
            }
          }
        }

      }
    })



    $('#rfq-form-submit').on('click', function(e) {
      disableForm();
      e.preventDefault();
      if (validateFormPart2()) {
        $('.all-fields-2').removeClass('rfq-error');
        $('#r-00N6g00000TtToJ, #r-00N6g00000TtToG').removeClass('rfq-error');
        

         // update salesforce form with values from this field
        $('#sf-form #first_name').val($('#r-first_name').val());
        $('#sf-form #last_name').val($('#r-last_name').val());
        $('#sf-form #company').val($('#r-company').val());
        $('#sf-form #phone').val($('#r-phone').val());
        $('#sf-form #sfemail').val($('#r-email').val());
        $('#sf-form #street').text($('#r-street').val());
        $('#sf-form #city').val($('#r-city').val());
        $('#sf-form #state').val($('#r-state').val());
        $('#sf-form #zip').val($('#r-zip').val());
        $('#00N3J000001mdyh').text($('#r-00N3J000001mdyh').val());

        // how they found us
        $('#00N6g00000TtToG').val($('#r-00N6g00000TtToG dt p').text());

        // found us details - if "other" is selected
        $('#00N6g00000U3avS').val($('#r-00N6g00000U3avS').val());

        // preferred method of contact
        $('#00N6g00000TtToJ').val($('#r-00N6g00000TtToJ dt p').text());

        // product 1 name
        $('#00N3J000001mcrB').val($('#00N6g00000TUVFe').val());

        // product 1 details
        $('#00N3J000001mcrG').text(
            'Size: ' + $('#00N6g00000Tj7ls').val() + "\r\n" + 
            'Shape: ' + $('#00N6g00000TBLtL').val() + "\r\n" + 
            'Size Unit: ' + $('#00N6g00000TtToL dt p').text() + "\r\n" + 
            'Min. Purity: ' + $('#00N6g00000TUVFy').val() + "\r\n" + 
            'Quantity: ' + $('#00N6g00000TUVG3').val() + "\r\n" + 
            'Quantity Unit: ' + $('#00N6g00000TUVFo dt p').text() + "\r\n" + 
            'Currently Using: ' + ($('#r-currently-using-yes').is(':checked') ? 'Yes' : 'No') + "\r\n" + 
            'General Application: ' + $('#00N6g00000TUVG8').val()
        );
 
        $('#sf-form-submit').click();



      } else {
        enableForm();
        $('.all-fields-2').removeClass('rfq-error');
        $('#r-00N6g00000TtToJ, #r-00N6g00000TtToG').removeClass('rfq-error');
        
        for (let i = 0; i < errorfields2.length; i++) {
          document.getElementById(errorfields2[i]).classList.add('rfq-error');
        }
      }
    })

    $('#rfq-form-previous').on('click', function(e) {
      e.preventDefault();
      $('.rfq-form-slide-2').addClass('rfq-form-slide-hidden').css('display', 'none');
      $('.rfq-form-slide-1').fadeIn(function() {
      //removeClass('rfq-form-slide-hidden');
      }).css('display', 'flex');
    })

    function validateFormPart2() {
      errorfields2 = [];

      for (let i = 0; i < allfields2.length; i++) {
        if ($('#'+allfields2[i]).val() == '' || $('#' + allfields2[i]).val() == '0') {
          if (!errorfields2.includes(allfields2[i])) {
            errorfields2.push(allfields2[i]);
          }
        }
      }

      let phoneNumber = $('#r-phone').val();
      let cleanedPhoneNumber = phoneNumber.replace(/\D/g, '');
      let phoneRegex = /^[0-9]{10,15}$/;

      if (!phoneRegex.test(cleanedPhoneNumber)) {
        if (!errorfields2.includes('r-phone')) {
          errorfields2.push('r-phone');
        }
      }

      let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test($('#r-email').val())) {
        if (!errorfields2.includes('r-email')) {
          errorfields2.push('r-email');
        }
      }

      if ($('#r-00N6g00000TtToJ dt p').text() == 'Preferred Method of Contact *') {
        if (!errorfields2.includes('r-00N6g00000TtToJ')) {
          errorfields2.push('r-00N6g00000TtToJ');
        }
      }

      if ($('#r-00N6g00000TtToG dt p').text() == 'How did you find us? *') {
        if (!errorfields2.includes('r-00N6g00000TtToG')) {
          errorfields2.push('r-00N6g00000TtToG');
        }
      }

      if ($('#r-00N6g00000TtToG dt p').text() == 'Other') {
        if ($('#r-00N6g00000U3avS').val() == '') {
           if (!errorfields2.includes('r-00N6g00000U3avS')) {
             errorfields2.push('r-00N6g00000U3avS');
           }
         }
      }

      // if ($('#r-00N6g00000TtToG').val() == 'Other') {
      //   if ($('#r-00N6g00000U3avS').val() == '') {
      //     if (!errorfields2.includes('r-00N6g00000U3avS')) {
      //       errorfields2.push('r-00N6g00000U3avS');
      //     }
      //   }
      // }

      if ($('#p-accept-terms input:checked').length != 1) {
        if (!errorfields2.push('p-accept-terms')) {
          errorfields2.push('p-accept-terms');
        }
      }

      if (errorfields2.length) {
        return false;
      }

      return true;
    }

    $('#r-00N6g00000TtToG ul li').on('click', function() {
      if ($(this).text() == 'Other') {
        $('#r-00N6g00000U3avS').css('display', 'block');
      } else {
        $('#r-00N6g00000U3avS').css('display', 'none');
        $('#r-00N6g00000U3avS').val('');
      }
    })

    function validateFormPart1() {
      errorfields = [];
      for (let i = 0; i < fieldsnotempty.length; i++) {
        if ($('.'+fieldsnotempty[i]).val() == '' || $('.'+fieldsnotempty[i]).val() == '0') {
          if (!errorfields.includes(fieldsnotempty[i])) {
            errorfields.push(fieldsnotempty[i]);
          }
        }
      }

      if ($('#00N6g00000TtToL dt p').text() == 'Size Unit of Measure *') {
        if (!errorfields.includes('00N6g00000TtToL')) {
          errorfields.push('00N6g00000TtToL');
        }
      }

      if ($('#00N6g00000TUVFo dt p').text() == 'Quantity Unit of Measure *') {
        if (!errorfields.includes('00N6g00000TUVFo')) {
          errorfields.push('00N6g00000TUVFo');
        }
      }
      
      if (isNaN($('.rfq-input-quantity').val())) {
        if (!errorfields.includes('rfq-input-quantity')) {
          errorfields.push('rfq-input-quantity');
        }
      }
      if ($('.rfq-currently-using input:checked').length != 1) {
        if (!errorfields.includes('rfq-currently-using')) {
          errorfields.push('rfq-currently-using');
        }
      }



      if (errorfields.length) {
        return false;
      }

      return true;
    }
  },
}