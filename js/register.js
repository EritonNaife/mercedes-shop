document.querySelector('.register-form').addEventListener('submit', (e) => {
      // Get email input value
    const email = document.querySelector('input[name="email"]').value;

     // Validate email format
    if (!email.includes('@')) {
        alert('Please enter a valid email.');
        e.preventDefault();
    }
});