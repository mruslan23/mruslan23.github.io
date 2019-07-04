<?php
    session_start();
    require "../server/config.php";

    if(isset($_SESSION['id']))
    {
        header("Location:feed.php");
    }
    else
    {
        if(isset($_POST['submit']))
        {
            $email = trim(htmlspecialchars($_POST['email']));
            $name = trim(htmlspecialchars($_POST['username']));
            $password = trim(htmlspecialchars(md5($_POST['password'])));

            $query2 = mysqli_query($db, "SELECT * FROM user WHERE 'email' = '$email' AND 'password' = '$password'");

            if(mysqli_num_rows($query2) > 0)
            {
                print("Этот email уже зарегистрирован");
            }
            else
            {
                $query3 = mysqli_query($db, "INSERT INTO user (email, password, name) VALUES ('$email', '$password', '$name')");
                if(!$query3)
                {
                    print("Ошибка, повторите попытку");
                }
                header("Location:auth.php");
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="/css/reg.css">
            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <title>Регистрация</title>
        </head>
        <body>
            <div id="wrapper_reg">
                <form method="POST" action="reg.php">
                    <div class="registry">
                        <div class="reg_head">
                            <h5>Регистрация</h5><hr />
                        </div> 
                        <div class="reg_input">
                            <input type="text" name="email" placeholder="Ваш email"><br/>
                            <input type="text" name="username" placeholder="Ваше имя"><br/>
                            <input type="password" name="password" placeholder="Ваш пароль"><br/><br/>
                        </div>
                        <div class="reg_button">
                            <button class="btn btn-small waves-effect waves-light blue" type="submit" name="submit">Зарегистрироваться
                            </button><br/><br/>
                            <a href="auth.php">Уже есть аккаунт</a> 
                        </div>
                    </div>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
?>

