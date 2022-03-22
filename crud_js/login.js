$(document).ready(function () {
    $('#login_user').click(function (e) {
        e.preventDefault();

        var username = $('#user').val();
        var password = $('#pass').val();

        $.ajax({
            method: "POST",
            url: "proses/login.php",
            data: {
                "username": username,
                "password": password
            },
            success: function (r) {
                var res = r.split("/");
                if (res[0] == 'success' && res[1] == 'admin') {
                    window.location.href = 'admin/index.php';
                    alert('Login Successfully');
                } else if (res[0] == 'success' && res[1] == 'resepsionis') {
                    window.location.href = 'resepsionis/index.php';
                    alert('Login Successfully');
                } else {
                    alert('Wrong Password Or Username');
                }
            }
        })
    })
})