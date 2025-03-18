function validateNumberInput(inputElement) {
    let value = inputElement.value;
    // Remove non-numeric characters
    value = value.replace(/[^0-9]/g, '');
    // Ensure value is not less than 1
    if (parseInt(value) < 1 || value === '') {
        value = '1';
    }
    inputElement.value = value;
}

document.addEventListener('DOMContentLoaded', function() {
    const numberInput = document.getElementById('numberInput');
    const incrementButton = document.getElementById('increment');
    const decrementButton = document.getElementById('decrement');

    incrementButton.addEventListener('click', function() {
        let currentValue = parseInt(numberInput.value);
        numberInput.value = currentValue + 1;
    });

    decrementButton.addEventListener('click', function() {
        let currentValue = parseInt(numberInput.value);
        if (currentValue > 1) {
            numberInput.value = currentValue - 1;
        }
    });
});