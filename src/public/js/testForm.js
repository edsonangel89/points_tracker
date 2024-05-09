const form = document.getElementById('login-form');
const inputEmail = document.getElementById('email');
const inputPassword = document.getElementById('password');

const pointsForm = document.getElementById('points-form');
const inputPoints = document.getElementById('points');

form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();
    formData.append('email', inputEmail.value);
    formData.append('password', inputPassword.value);
    fetch('http://localhost/checker/api/sessions/login', {
        method: 'POST',
        body: formData
    })
    .then(response => {
    })
    .then(data => {
        inputEmail.value = '';
        inputPassword.value = '';
    });
})

pointsForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();
    formData.append('points', inputPoints.value);
    
    fetch('http://localhost/checker/api/users/update/points/4', {
        method: 'POST',
        body: formData
    })
    .then(response => {
    })
    .then(data => {
        inputPoints.value = 0;
    });
})