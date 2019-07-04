# myChat
Установка
---------
1. Скачать XAMPP сервер
2. Клонировать данный репозиторий в **xampp/htdocs/**
3. Запустить XAMPP сервер
4. Нажать кнопку Config напротив Apache и в выпадающем списке выбрать httpd.conf,
затем найти и изменить две строки с адресом к проекту на:
'DocumentRoot "C:/xampp/htdocs/myChat"'
'<Directory "C:/xampp/htdocs/myChat">'
5. В XAMPP запустить Apache и MySQL
6. Для запуска сервера websocket в командной строке выполнить переход в директорию
командой **cd C:/xampp/htdocs/myChat/websocket.host/bin**
и выполнить команду **php chat-server.php**
7. Зайти в браузер и ввести в адресной строке **localhost**
