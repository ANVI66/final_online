
function showHide() {
    let travelhistory = document.getElementById('exit')
    if (travelhistory.value == 'Exit') {
        document.getElementById('hidden-panel').style.display = 'block'
    } else {
        document.getElementById('hidden-panel').style.display = 'none'
    }
}

  $(document).ready(function() {
    $('form').validate({
      rules: {
        ID: {
          required: true,
          rangelength: [1, 8]
        },
        NAME: {
          required: true,
          rangelength: [1, 20]
        },

        // Add the same rules for other input fields that require a character limit
        // DEPARTMENT, WORKNATURE, JOININGDATE, COMPANY, BASIC, BANKNAME, ACCOUNTNO, IFSCCODE, SALARYACCOUNT, ESI_EPF, STATUS


        DEPARTMENT: {
          required: true,
          rangelength: [1, 20]
        },WORKNATURE: {
          required: true,
          rangelength: [1, 20]
        },JOININGDATE: {
          required: true,
          rangelength: [1, 20]
        },COMPANY: {
          required: true
        },BASIC: {
          required: true,
          rangelength: [1, 20]
        },BANKNAME: {
          required: true,
          rangelength: [1, 20]
        },ACCOUNTNO: {
          required: true,
          rangelength: [1, 20]
        },IFSCCODE: {
          required: true,
          rangelength: [1, 20]
        },SALARYACCOUNT: {
          required: true,
          rangelength: [1, 20]
        },ESI_EPF: {
          required: true,
          rangelength: [1, 20]
        },STATUS: {
          required: true,
          rangelength: [1, 20]
        }
       
      },
      messages: {
        ID: {
            required: 'Please Enter this field',
            rangelength: 'the lenth is too long'
        },
        NAME: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
        // Add the same messages for other input fields
        DEPARTMENT: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
        WORKNATURE: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        JOININGDATE: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
        COMPANY: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        BASIC: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        }, 
        BANKNAME: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        ACCOUNTNO: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        IFSCCODE: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        SALARYACCOUNT: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
       
        EPFNO: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
        STATUS: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },

      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });



  function updateESI_EPFFields(selectElement) {
    var esiNumberField = document.getElementById("esino");
    var epfNumberField = document.getElementById("epfno");

    if (selectElement.value === "No") {
      esiNumberField.value = "0";
      epfNumberField.value = "0";
      esiNumberField.setAttribute("disabled", "disabled");
      epfNumberField.setAttribute("disabled", "disabled");
    } else {
      esiNumberField.removeAttribute("disabled");
      epfNumberField.removeAttribute("disabled");
    }
  }