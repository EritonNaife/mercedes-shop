function nextStep(nextSectionId) {
    // Hide all sections before showing the target section
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.add('hidden');
    });
    
    document.getElementById(nextSectionId).classList.remove('hidden');
    
    // Update step indicators
    const steps = document.querySelectorAll('.step');
    steps.forEach(step => step.classList.remove('active'));
    
    switch(nextSectionId) {
        case 'shipping-section':
            steps[1].classList.add('active');
            break;
        case 'payment-section':
            steps[2].classList.add('active');
            break;
        case 'review-section':
            steps[3].classList.add('active');
            break;
    }
}

function prevStep(prevSectionId) {
    // Move back to the previous step using the same function
    nextStep(prevSectionId);
}

document.addEventListener('DOMContentLoaded', () => {
    const nextButtons = document.querySelectorAll('.next-button');
    const backButtons = document.querySelectorAll('.back-button');

    // Add event listeners to next buttons
    nextButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const target = e.target.getAttribute('onclick').match(/nextStep\('([^']+)'\)/)[1];
            nextStep(target);
        });
    });

    // Add event listeners to back buttons
    backButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const target = e.target.getAttribute('onclick').match(/prevStep\('([^']+)'\)/)[1];
            prevStep(target);
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const shippingRadios = document.querySelectorAll('input[name="shipping"]');
    const sidebarShipping = document.getElementById('sidebar-shipping');
    const sidebarTotal = document.getElementById('sidebar-total');

    // Helper function to parse currency values
    function parseCurrency(currencyString) {
        return parseFloat(currencyString.replace('$', ''));
    }

    // Update shipping cost and recalculate total when shipping option changes
    shippingRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            const shippingCost = parseFloat(radio.dataset.price);
            sidebarShipping.textContent = `$${shippingCost.toFixed(2)}`;
            const subtotal = parseCurrency(document.getElementById('sidebar-subtotal').textContent);
            const tax = parseCurrency(document.getElementById('sidebar-tax').textContent); 
            const newTotal = subtotal + shippingCost + tax;
            sidebarTotal.textContent = `$${newTotal.toFixed(2)}`;
        });
    });

    // Trigger change event on the selected shipping option on page load
    const checkedRadio = document.querySelector('input[name="shipping"]:checked');
    if (checkedRadio) {
        const event = new Event('change');
        checkedRadio.dispatchEvent(event);
    }
});

document.getElementById('card-number').addEventListener('input', function(e) {
    // Format card number as user types (groups of 4 digits)
    let value = e.target.value.replace(/\D/g, ''); 
    value = value.replace(/(\d{4})/g, '$1 ').trim(); 
    e.target.value = value.substring(0, 19); 
});

document.getElementById('expiry').addEventListener('input', function(e) {
    // Format expiry date as MM/YY
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    e.target.value = value.substring(0, 5);
});

document.getElementById('cvv').addEventListener('input', function(e) {
    // Allow only numeric input for CVV, max length 4
    e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
});

document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', () => {
        // Add loading class to submit button to indicate processing
        const submitButton = form.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.classList.add('loading');
        }
    });
});
