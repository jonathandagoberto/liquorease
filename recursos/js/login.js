const passwordInput = document.getElementById('txt_pass');
    const passwordButton = document.getElementById('password-button');

    passwordInput.addEventListener('input', function() {
        if (passwordInput.value.length === 6) {
            passwordButton.style.backgroundColor = 'green';
        } else {
            passwordButton.style.backgroundColor = 'red';
        }
    });
