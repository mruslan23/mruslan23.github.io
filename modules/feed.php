<?php
session_start();
require "../server/config.php";
$name_id = $_SESSION['id'];
$query_name = mysqli_query($db, "SELECT name FROM user WHERE id = $name_id LIMIT 1");
$User = mysqli_fetch_assoc($query_name);

if(!isset($_SESSION['id']))
{
    header("Location:".$site_url);

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
        <link rel="stylesheet" href="/css/feed.css">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <title>Чат</title>
    </head>
    <body>
        <div id="wrapper">
            <nav>
                <div class="nav-wrapper blue">
                <a href="#!" class="brand-logo" style="margin-left:10px"><i class="material-icons">chat</i>Чат</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href=""><i class="material-icons">refresh</i></a></li>
                    <li><a href=""><i class="material-icons">search</i></a></li>
                    <li><a href="/server/exit.php"><i class="material-icons">exit_to_app</i></a></li>
                </ul>
                </div>
            </nav>
            <div class="middle">
                <main class="content">
                    <aside class="right-sidebar">

                    </aside>
                    <div class="message_container" id="message_container">
                        <?php
                            $query5 = mysqli_query($db, "SELECT * FROM message");
                            if(mysqli_num_rows($query5) > 0)
                            {
                                while($mes = mysqli_fetch_assoc($query5))
                                {
                                    $user_id = $mes['user_id'];
                                    $message = $mes['message'];
                                    $time = $mes['time'];
                                    $query6 = mysqli_query($db, "SELECT name FROM user WHERE id = $user_id LIMIT 1");
                                    $mesUser = mysqli_fetch_assoc($query6);
                                    ?>
                                    <div class="message_line">
                                        <?php 
                                        print("<span class='ms_name'>".$mesUser['name']."</span> <br/>".$message); 
                                        ?>
                                    </div>
                                        <?php
                                        print("<span style='color:black'>".explode(":", explode(" ", $time)[1])[0].":".explode(":", explode(" ", $time)[1])[1]."</span>");
                                        ?>
                                    <br/>                                   

                                    <?php
                                }
                            }
                            else{
                                
                            }
                        ?>
                    </div>
                    <aside class="left-sidebar">
                    <div class="collection">
                        <a href="#!" class="collection-item active blue">Диалог 1</a>
                        <a href="#!" class="collection-item">Диалог 2</a>
                        <a href="#!" class="collection-item">Диалог 3</a>
                        <a href="#!" class="collection-item">Диалог 4</a>
                    </div>
                    </aside>    
                    <div class="messageadd">
                        <form method="POST" action="/server/messageadd.php" name="messages">
                            <div class="sms">
                                <div class="input-field col s12">
                                    <textarea name="text" id="text" placeholder="Напишите сообщение..."></textarea>
                                </div>
                            </div>
                            <div class="send">
                                <div class="input-field col s12">
                                    <button class="btn btn-small waves-effect waves-light blue" type="submit" name="submit">Отправить
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
        <div id="status">
            
        </div>
        <script>
            window.onload = function(){
                var socket = new WebSocket("ws://localhost:8080")
                var status = document.querySelector("#status");
                
                socket.onmessage = function(event){
                    let message = JSON.parse(event.data);
                    showMessage(message.user, message.msg);
                }
                socket.onerror = function(event){
                    status.innerHTML = "ошибка: " + event.message;
                }
                document.forms["messages"].onsubmit = function(){
                    var user = "<?php echo $User['name'] ?>";
                    let message = {
                        msg: this.text.value,
                        user: user
                }
                var val = document.getElementById("text");
                var session_id = <?php echo $_SESSION['id']?>;
                socket.send(JSON.stringify(message));

                jQuery.ajax({
                    type:'POST',
                    url:'/server/messageadd.php',
                    data: {"text":message.msg, "sess_id":session_id},
                    success:function(response){
                        // $("#text").append(response);
                        $("#text").val('');
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                });

                return false;
                }
            
            }
            function showMessage(user, message) {
                var cont = document.getElementById('message_container');
                var div = document.createElement('div');
                var time = document.createElement('span');
                var br = document.createElement('br');
                var date = new Date();
                div.className = "message_line";
                time.style.color = "black";
                cont.appendChild(div);
                time.innerHTML = " " + date.getHours() + ":" + date.getMinutes();
                cont.appendChild(time);
                cont.appendChild(br);
                div.innerHTML = "<span class='ms_name'>" + user + "</span> <br/>";
                div.appendChild(document.createTextNode(message));
            }
        </script>
        
    </body>
    </html>

    <?php
}
?>