const infoForm = document.getElementById('info-form');
const inputId = document.getElementById('client');
const userTable = document.getElementById('user-table');

infoForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const idValue = inputId.value;

    fetch(`http://localhost/checker/api/users/get/${idValue}`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(user => {
        if(user.UserID != undefined) {
            if(userTable.hasChildNodes()) {
                const user = document.getElementById('user');
                userTable.removeChild(user);    
            }
            const newRow = document.createElement('tr');
            newRow.setAttribute('id', 'user');
            newRow.innerHTML = `
                <td>${user.UserID}</td>
                <td>${user.FirstName}</td>
                <td>${user.LastName}</td>
                <td>${user.Email}</td>
                <td>${user.Points}</td>
            `;
            userTable.appendChild(newRow);
            inputId.value = '';
        }
        else {
            alert('El usuario no existe');
            inputId.value = '';
        }
        
    })
})