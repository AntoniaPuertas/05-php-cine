loginForm = document.getElementById('loginForm');
saludo = document.getElementById('saludo');
bloqueSaludo = document.getElementById('bloqueSaludo');

document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    fetch('sesion/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            saludo.innerHTML = `Hola ${username}`;
            bloqueSaludo.style.display = 'block';
            loginForm.style.display = 'none';
        } else {
            alert('Inicio de sesión fallido. Por favor, intente de nuevo.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error. Por favor, intente de nuevo más tarde.');
    });
});