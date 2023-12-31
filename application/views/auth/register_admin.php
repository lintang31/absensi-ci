<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!---Custom CSS File--->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
/* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background: rgb(37, 26, 31);
    background: -moz-radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
    background: -webkit-radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
    background: radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#251a1f", endColorstr="#ebebeb", GradientType=1);
}

.container {
    position: relative;
    max-width: 700px;
    width: 80%;
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.container header {
    font-size: 1.5rem;
    color: #333;
    font-weight: 500;
    text-align: center;
}

.container .form {
    margin-top: 30px;
}

.form .input-box {
    position: relative;
    /* Tambahkan ini */
    width: 100%;
    margin-top: 20px;
}

.input-box label {
    color: #333;
}

.form :where(.input-box input, .select-box) {
    position: relative;
    height: 50px;
    width: 100%;
    outline: none;
    font-size: 1rem;
    color: #707070;
    margin-top: 8px;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 0 15px;
}

.input-box input:focus {
    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}

.form .column {
    display: flex;
    column-gap: 15px;
}

.form .gender-box {
    margin-top: 20px;
}

/* Tambahkan gaya untuk ikon mata */
.form .input-box .toggle-password {
    position: absolute;
    top: 70%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #707070;
}

.gender-box h3 {
    color: #333;
    font-size: 1rem;
    font-weight: 400;
    margin-bottom: 8px;
}

.form :where(.gender-option, .gender) {
    display: flex;
    align-items: center;
    column-gap: 50px;
    flex-wrap: wrap;
}

.form .gender {
    column-gap: 5px;
}

.gender input {
    accent-color: rgb(130, 106, 251);
}

.form :where(.gender input, .gender label) {
    cursor: pointer;
}

.gender label {
    color: #707070;
}

.address :where(input, .select-box) {
    margin-top: 15px;
}

.select-box select {
    height: 100%;
    width: 100%;
    outline: none;
    border: none;
    color: #707070;
    font-size: 1rem;
}

.form button {
    height: 55px;
    width: 100%;
    color: #fff;
    font-size: 1rem;
    font-weight: 400;
    margin-top: 30px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background: rgb(37, 26, 31);
    background: -moz-radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
    background: -webkit-radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
    background: radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#251a1f", endColorstr="#ebebeb", GradientType=1);
}

.form button:hover {
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background: rgb(37, 26, 31);
    background: -moz-radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
    background: -webkit-radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
    background: radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#251a1f", endColorstr="#ebebeb", GradientType=1);
}

/*Responsive*/
@media screen and (max-width: 500px) {
    .form .column {
        flex-wrap: wrap;
    }

    .form :where(.gender-option, .gender) {
        row-gap: 15px;
    }
}
</style>

<body>
    <section class="container">
        <header>Register Admin Form</header>
        <form action="<?php echo base_url('auth/process_register_admin'); ?>" method="post" class="form">
            <div class="input-box">
                <input type="text" name="username" placeholder="username" required />
            </div>
            <div class="input-box">
                <label>Email </label>
                <input type="text" name="email" placeholder="Email" required />
            </div>
            <div class="input-box">
                <label>Nama Depan </label>
                <input type="text" name="nama_depan" placeholder="Nama  Depan" required />
            </div>
            <div class="input-box">
                <label>Nama Belakang </label>
                <input type="text" name="nama_belakang" placeholder="Nama Belakang" required />
            </div>
            <div class="input-box">
                <label>*Password Minimal 8 Karakter </label>
                <input type="Password" placeholder="Password" name="password" id="password" required />
                <span class="fa fa-fw fa-eye-slash field-icon toggle-password" onclick="togglePassword()"></span>
            </div>
            </div>
            <button type="submit">Submit</button>
            <div class="register_link">
                <p>sudah punya akun?<a href='<?php echo base_url('auth'); ?>' style=color:blue> Login</a>
                </p>
            </div>
            <script>
            function togglePassword() {
                var passwordField = document.getElementById("password");
                var icon = document.querySelector(".toggle-password");

                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                } else {
                    passwordField.type = "password";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                }
            }
            </script>
        </form>
    </section>
</body>

</html>