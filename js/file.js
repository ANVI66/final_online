
function manualform() {
    const manualFormToggle = document.getElementById('manual_form_toggle');
    const manualFormDetails = document.getElementById('manual_form_details');
    manualFormToggle.addEventListener('click', function () {
        if (manualFormDetails.style.display === 'none' || manualFormDetails.style.display === '') {
            manualFormDetails.style.display = 'block';
        } else {
            manualFormDetails.style.display = 'none';
        }
    });
}
function toggleManualForm() {
    const manualFormDetails = document.getElementById('manual_form_details');
    manualFormDetails.style.display = manualFormDetails.style.display === 'none' || manualFormDetails.style.display === '' ? 'block' : 'none';
}
manualform();

