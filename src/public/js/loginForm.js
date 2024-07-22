const form = document.getElementById('login-form');
const inputEmail = document.getElementById('email');
const inputPassword = document.getElementById('password');

form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();
    formData.append('email', inputEmail.value);
    formData.append('password', inputPassword.value);
    fetch('https://www.puntoaqua.com/api/sessions/login', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        /*const authorizationHeader = response.headers.get('Authorization');
        /*console.log(response.headers)
        const token = authorizationHeader.split(' ')[1];
        console.log(token);*/
        
        response.json()
    })
    .then(data => {
        console.log(data);
        switch(data) {
            case 'Non-user':
                alert('No existe usuario');
            break;
            case 'Wrong-password':
                alert('Contraseña incorrecta');
            break;
            case 'Non-verified':
                alert('Correo no verificado, confirma tu correo electrónico en bandeja de entrada y vuelve a intentar');
            break;
            default:
                window.location.href = '/';
            break;
        }
    });
})

