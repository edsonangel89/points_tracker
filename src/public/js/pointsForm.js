const pointsForm = document.getElementById('points-form');
const inputPoints = document.getElementById('points');
const inputClient = document.getElementById('client');

pointsForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();
    formData.append('points', inputPoints.value);
    formData.append('client', inputClient.value);
    
    fetch('http://localhost/checker/api/users/update/points/4', {
        method: 'POST',
        body: formData
    })
    .then(response => {
    })
    .then(data => {
        inputPoints.value = 0;
        inputClient.value = 0;
    });
})