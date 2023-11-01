  function resetPage(){
    location.reload();
  }


// --------------------------------------------//


  $(document).ready(function(){
   $('#getName').on("keyup", function(){
     var getName = $(this).val();
     $.ajax({
       method:'POST',
       url:'../searchajax.php',
       data:{name:getName},
       success:function(response)
       {
            $("#showdata").html(response);
       } 
     });
   });
  });


// ---------------------------------------------------// 

  
    $(document).ready(function() {
        $("#salary_details").validate({
            rules: {
                Total_no_of_days: {
                    required: true,
                    minlength: 1,
                },
                ot: {
                    required: true,
                    minlength: 1,
                },
                Salary_date: {
                    required: true,                                                       
                }
            },
            messages: {
                Total_no_of_days: {
                    required: "Please check",
                },
                ot: {
                    required: "Please check",
                },
                Salary_date: {
                    required: "Please check",
                }
            },
            submitHandler: function(form) {
                form.submit();
               
            }
        });

      
    });
// -------------------------------------------//

     document.getElementById('emp_working').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('Basic').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('ot').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('Advance').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('conveyance').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('Convenience').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('basicallowan').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('rentalallowan').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('medicalallowan').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('esi_epf').addEventListener('change', calculateTotalWorkingDays);
  document.getElementById('bas_inc').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('increse').addEventListener('input', calculateTotalWorkingDays);



  function calculateTotalWorkingDays() {
    let esiEpfOption = document.getElementById('esi_epf').value;
    let esi75Input = document.getElementById('esi75');
    let esi325Input = document.getElementById('esi325');
    let epf12Input = document.getElementById('EPF12');
    let epf18Input = document.getElementById('EPF18');
    let epf_367Input = document.getElementById('EPF367');
    let epf_833Input = document.getElementById('EPF833');
    let epf_basicInput = document.getElementById('EPF_BASIC');

    let basicPay = parseFloat(document.getElementById('bas_inc').value);
  let increment = parseFloat(document.getElementById('increse').value);

  let finalBasicPay = basicPay + increment;
  document.getElementById('Basic').value = finalBasicPay.toFixed(2);


    let company_basic_pay = parseFloat(document.getElementById('Basic').value);

    if (!isNaN(company_basic_pay)) {
      let monthlyWorkingDays = parseFloat(document.getElementById('Total_no_of_days').value);
      let employee_WorkingDays = parseFloat(document.getElementById('emp_working').value);
      let exactDaysInput = document.getElementById('final_emp_working');
      let convenience = parseFloat(document.getElementById('Convenience').value);
      let ot = parseFloat(document.getElementById('ot').value);
      let advance = parseFloat(document.getElementById('Advance').value);
      let totalsalary = parseFloat(document.getElementById('totalsalary').value);
      let basicAllowance = parseFloat(document.getElementById('basicallowan').value);
      let RentalAllowance = parseFloat(document.getElementById('rentalallowan').value);
      let MedicalAllowance = parseFloat(document.getElementById('medicalallowan').value);
      let lopdays = parseFloat(document.getElementById('LOP_DAYS').value);

if (parseFloat(employee_WorkingDays) >= parseFloat(monthlyWorkingDays)-1 ) {
    employee_WorkingDays += 1;
} 
else if (parseFloat(employee_WorkingDays) >= parseFloat(monthlyWorkingDays)-2 ) {
    employee_WorkingDays += 1;
} 
 else {
  employee_WorkingDays = parseFloat(employee_WorkingDays); // Convert the value to float
  exactDaysInput.value = employee_WorkingDays; // Assign the value directly to exactDaysInput
}

employee_WorkingDays = parseFloat(employee_WorkingDays); 


var perDaySalary = parseFloat(company_basic_pay / monthlyWorkingDays);
var final_BasicSalary = parseFloat(perDaySalary * employee_WorkingDays);
document.getElementById('totalsalary').value = final_BasicSalary.toFixed(2);
exactDaysInput.value = employee_WorkingDays;

var epf_basic = 0;
var epf_employee = 0;
var epf_company = 0;
var esi_employee = 0;
var esi_company = 0;
var epfcomp833 = 0;
var epfcomp367 = 0;

if (company_basic_pay <= 10000) {
  epf_basic = parseFloat(final_BasicSalary * 30 / 100);
} else {
  epf_basic = parseFloat((3334 / monthlyWorkingDays) * employee_WorkingDays);
}

epf_employee = parseFloat(epf_basic * 0.12);
epf_company = parseFloat(epf_basic * 0.12);
esi_employee = parseFloat(epf_basic * 0.0075);
esi_company = parseFloat(epf_basic * 0.0325);
epfcomp833 = parseFloat(epf_basic * 0.0833);
epfcomp367 = parseFloat(epf_basic * 0.0367);

if (esiEpfOption === 'Yes') {
  esi75Input.value = esi_employee.toFixed(2);
  esi325Input.value = esi_company.toFixed(2);
  epf12Input.value = epf_employee.toFixed(2);
  epf18Input.value = epf_company.toFixed(2);
  epf_367Input.value = epfcomp367.toFixed(2);
  epf_833Input.value = epfcomp833.toFixed(2);
  epf_basicInput.value = epf_basic.toFixed(2);
} else {
  esi75Input.value = '0';
  esi325Input.value = '0';
  epf12Input.value = '0';
  epf18Input.value = '0';
  epf_367Input.value = '0';
  epf_833Input.value = '0';
  epf_basicInput.value = '0';
}

var additional_allow = parseFloat((company_basic_pay / monthlyWorkingDays) * employee_WorkingDays);
var basic_allow = parseFloat(additional_allow * 0.45);
var rental_allow = parseFloat(additional_allow * 0.25);
var medical_allow = parseFloat(additional_allow * 0.30);
var convenience_final = parseFloat((convenience / monthlyWorkingDays) * employee_WorkingDays);

var totalsalary_all_value = 0;
if (esiEpfOption === 'Yes') {
  totalsalary_all_value = parseFloat((convenience_final + ot + final_BasicSalary) - (advance + epf_employee + esi_employee));
} else {
  totalsalary_all_value = parseFloat((convenience_final + ot + final_BasicSalary) - (advance));
}

var lopdaysss = parseFloat(monthlyWorkingDays - employee_WorkingDays);
var increments = parseFloat(basic_allow + medical_allow + rental_allow + ot + convenience);
var deductions = parseFloat(epf_employee + esi_employee + advance);


      document.getElementById('esi75').value = esi75Input.value;
      document.getElementById('esi325').value = esi325Input.value;
      document.getElementById('EPF12').value = epf12Input.value;
      document.getElementById('EPF18').value = epf18Input.value;
      document.getElementById('EPF367').value = epf_367Input.value;
      document.getElementById('EPF833').value = epf_833Input.value;
      document.getElementById('EPF_BASIC').value = epf_basicInput.value;
      document.getElementById('basicallowan').value = basic_allow.toFixed(2);
      document.getElementById('rentalallowan').value = rental_allow.toFixed(2);
      document.getElementById('medicalallowan').value = medical_allow.toFixed(2);
      document.getElementById('final_salary_fixed').value = totalsalary_all_value.toFixed(2);
      document.getElementById('LOP_DAYS').value = lopdaysss;
      document.getElementById('deduction').value = deductions.toFixed(2);
      document.getElementById('increment').value = increments.toFixed(2);
      document.getElementById('conveyance').value = convenience_final.toFixed(2);
    } else {

      // Invalid salary value
      document.getElementById('result').innerHTML = 'Please provide a valid basic salary.';
    }
  }

  var inputs = document.querySelectorAll('#Basic, #bas_inc, #increse');
  inputs.forEach(function (input) {
    input.addEventListener('input', calculateTotalWorkingDays);
  });

  calculateTotalWorkingDays();


  // -------------------------------------------//

     $(document).ready(function() {
            // Send Search Text to the server
            $("#search").keyup(function() {
                let searchText = $(this).val();
                if (searchText != "") {
                    $.ajax({
                        url: "../includes/conn.php",
                        method: "post",
                        data: {
                            query: searchText
                        },
                        success: function(response) { 
                            $("#show-list").html(response);
                        }
                    });
                } else {
                    $("#show-list").html("");
                }
            });

            // Set searched text in input field on click of search button
            $(document).on("click", "a", function() {
                $("#search").val($(this).text());
                $("#show-list").html("");
            });
        });