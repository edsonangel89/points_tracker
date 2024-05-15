const pointsForm = document.getElementById('points-form');
const inputPoints = document.getElementById('points');
const inputClient = document.getElementById('client');
const btnPoints = document.getElementById('points-btn');
const acceptContainer = document.getElementById('accept-form-container');
const acceptForm = document.getElementById('accept-form');
const acceptBtn = document.getElementById('accept-btn');

pointsForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();
    formData.append('points', inputPoints.value);

    fetch(`http://localhost/checker/api/users/update/points/${inputClient.value}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(user => {
        localStorage.setItem('userId', inputClient.value);
        if(user.Prize == 1) {
            inputPoints.disabled = true;
            inputClient.disabled = true;
            btnPoints.disabled = true;
            pointsForm.style.opacity = '0.5';
            acceptContainer.style.visibility = 'visible';
            acceptBtn.focus();
        }
        inputPoints.value = '';
        inputClient.value = '';
    });
})

inputClient.addEventListener('change', function(e) {
    const uid = inputClient.value;

    fetch(`http://www.puntoaqua.com/api/users/get/${uid}`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        if(data == 'Non-user') {
            alert('Usuario no existe');
            inputClient.value = '';
        }
        else {

        }        
    })
})

acceptForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const user = localStorage.getItem('userId');
    fetch(`http://www.puntoaqua.com/api/users/update/prize/${user}`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        inputPoints.disabled = false;
        inputClient.disabled = false;
        btnPoints.disabled = false;
        pointsForm.style.opacity = '1';
        acceptContainer.style.visibility = 'hidden';
        localStorage.removeItem('userId');
    })
})