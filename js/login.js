function validar() {
    username = document.getElementById('username').value
    password = document.getElementById('password').value
    alerta = document.getElementById('alerta')

    if (username == '' && password == '') {
        alerta.innerHTML = 'Introduce el nombre y la contraseña'
        return false
    } else if (username == '') {
        alerta.innerHTML = 'Introduce el nombre'
        return false
    } else if (password == '') {
        alerta.innerHTML = 'Introduce la contraseña'
        return false
    } else {
        return true
    }
}