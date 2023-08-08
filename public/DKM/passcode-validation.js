document.addEventListener('DOMContentLoaded', () => {
    const aksesSelect = document.getElementById('akses');
    const passcodeModal = new bootstrap.Modal(document.getElementById('passcodeModal'));
    const passcodeInput = document.getElementById('passcodeInput');
    const checkPasscodeBtn = document.getElementById('checkPasscodeBtn');
    const submitBtn = document.getElementById('submitBtn');

    function enableSubmitButton() {
        submitBtn.style.display = 'block'; // Show the submit button
        submitBtn.disabled = false;
    }

    function disableSubmitButton() {
        submitBtn.style.display = 'none'; // Hide the submit button
        submitBtn.disabled = true;
    }

    aksesSelect.addEventListener('change', () => {
        if (aksesSelect.value === 'admin') {
            passcodeModal.show();
            disableSubmitButton(); // Hide and disable submit button when 'admin' is selected
        } else {
            passcodeModal.hide();
            enableSubmitButton(); // Show and enable submit button when 'tamu' is selected
        }
    });

    checkPasscodeBtn.addEventListener('click', () => {
        if (passcodeInput.value === '!00ManajemendkMbKU99?') { // Replace with the actual passcode
            enableSubmitButton();
            passcodeModal.hide();
        } else {
            disableSubmitButton();
            passcodeInput.value = '';
            passcodeInput.focus();
        }
    });

    passcodeInput.addEventListener('input', () => {
        if (aksesSelect.value === 'admin' && passcodeInput.value === '!00ManajemendkMbKU99?') { // Replace with the actual passcode
            enableSubmitButton();
        } else {
            disableSubmitButton();
        }
    });

    // Rest of your code...
});
