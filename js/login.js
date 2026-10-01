document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    
    let formData = new FormData(this); 
    let errorDiv = document.getElementById('errorMessage');
    errorDiv.textContent = '';

    fetch('../../actions/users/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = data.redirect;
        } else {
            errorDiv.textContent = data.message;
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        errorDiv.textContent = 'Serveri het xndir ka';
    });
});