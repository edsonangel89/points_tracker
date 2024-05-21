const infoForm = document.getElementById('info-form');
const inputId = document.getElementById('client');
const userTable = document.getElementById('user-table');

infoForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const idValue = inputId.value;

    fetch(`https://www.puntoaqua.com/api/users/get/${idValue}`, {
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
                <td id='uid'>${user.UserID}</td>
                <td id='ufn'>${user.FirstName}</td>
                <td id='uln'>${user.LastName}</td>
                
                <td id='upo'>${user.Points}</td>
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