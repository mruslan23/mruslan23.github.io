<?php
    session_start();
    require "../server/config.php";

    if(isset($_SESSION['id']))
    {
        header("Location:feed.php");
    }
    else
    {
        
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="/css/auth.css">
            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <title>Авторизация</title>
        </head>
        <body>
            <div id="wrapper_reg">
                <form method="POST" action="auth.php">
                    <div class="registry">
                        <div class="reg_head">
                            <h5>Вход</h5><hr />
                        </div> 
                        <div class="reg_input">
                            <input type="text" name="email" placeholder="E-mail"> <br/>
                            <input type="password" name="password" placeholder="Пароль"> <br/><br/>
                        </div>
                        <div class="reg_button">
                            <button class="btn btn-small waves-effect waves-light blue" type="submit" name="submit">Войти
                            </button><br/><br/>
                            <a href="reg.php">Создать аккаунт</a>
                        </div>
                    </div>
                </form>
                <?php
                if(isset($_POST['submit']))
                {
                    $email = trim(htmlspecialchars($_POST['email']));
                    $password = trim(htmlspecialchars(md5($_POST['password'])));
                    $query1 = mysqli_query($db, "SELECT * FROM user WHERE email = '$email' AND password = '$password'");

                    if(mysqli_num_rows($query1) > 0)
                    {
                        $user = mysqli_fetch_assoc($query1);
                        $_SESSION['id'] = $user['id'];
                        header("Location:feed.php");
                    }
                    else
                    {
                        
                        print("<div style='display:inline-block;margin-left:30px;color:red;'>Не удается войти, проверьте введенные данные</div>");
                    }
                }?>
            </div>         
        </body>
        </html>
        <?php
    }
?>

