const signForm = document.getElementById('sign-form');
const inputFname = document.getElementById('fname');
const inputLname = document.getElementById('lname');
const inputEmail = document.getElementById('email');
const inputPassword = document.getElementById('password');
const inputConfirmPassword = document.getElementById('confirm-password');
const passwordAlerts = document.getElementsByClassName('contrasena-alert');

signForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const regexpPassword = /[a-bA-Z0-9]/;
    const formData = new FormData();

    const valueFname = inputFname.value;
    const valueLname = inputLname.value;
    const valueEmail = inputEmail.value;
    const valuePassword = inputPassword.value;

    formData.append('fname', valueFname);
    formData.append('lname', valueLname);
    formData.append('email', valueEmail);
    formData.append('password', valuePassword);

    if(inputPassword.value.includes(' ') || inputConfirmPassword.value.includes(' ')) {
        alert('Las contrasenas no pueden contener espacios en blanco');
        inputPassword.value = '';
        inputConfirmPassword.value = ''; 
        return;
    }

    if(inputPassword.value != inputConfirmPassword.value) {
        alert('Las contraseñas deben coincidir')
    }
    else {
        if(!regexpPassword.test(inputPassword.value)) {
            alert('La contraseña solo puede contener letras mayúsculas o minúsculas y números');
        }
        else {
            fetch('http://localhost/checker/api/users/add', {
            method: 'POST',
            body: formData
            })
            .then(response => response.json())
            .then(data => {
                window.location.href = `/checker/mail?email=${data[0]}&token=${data[1]}`;
                inputFname.value = '';
                inputLname.value = '';
                inputEmail.value = '';
                inputPassword.value = '';
                inputConfirmPassword.value = '';
            })
        }
    }
})

inputPassword.addEventListener('input', function(e) {
    const passwordValue = inputPassword.value;
    const confirmPasswordValue = inputConfirmPassword.value;
    if(passwordValue != confirmPasswordValue) {
        inputPassword.style.border = 'solid red 1px';
        inputConfirmPassword.style.border = 'solid red 1px';
        passwordAlerts[0].style.display = 'inline-block';
        passwordAlerts[1].style.display = 'inline-block';
    }
    else {
        inputPassword.style.border = 'none';
        inputConfirmPassword.style.border = 'none';
        passwordAlerts[0].style.display = 'none';
        passwordAlerts[1].style.display = 'none';
    }  
})

inputConfirmPassword.addEventListener('input', function(e) {
    const passwordValue = inputPassword.value;
    const confirmPasswordValue = inputConfirmPassword.value;
    if(passwordValue != confirmPasswordValue) {
        inputPassword.style.border = 'solid red 1px';
        inputConfirmPassword.style.border = 'solid red 1px';
        passwordAlerts[0].style.display = 'inline-block';
        passwordAlerts[1].style.display = 'inline-block';
    }
    else {
        inputPassword.style.border = 'none';
        inputConfirmPassword.style.border = 'none';
        passwordAlerts[0].style.display = 'none';
        passwordAlerts[1].style.display = 'none';
    }  
})

inputEmail.addEventListener('change', function(e) {
    const email = inputEmail.value;
    const formData = new FormData();

    formData.append('email', email);

    fetch('http://localhost/checker/api/users/get/email', {
        method: 'POST',
        body: formData 
    })
    .then(response => response.json())
    .then(data => {
        if(data) {
            alert('Usuario ya existe');
            inputEmail.value = '';
        }        
    })
})