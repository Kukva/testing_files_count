# Testing_files_count
Counting numbers in the files "count"

Данный "проект" является тестовым заданием

Задание: Есть список директорий неограниченной вложенности. В каждой директории может присутствовать файл count. 
Необходимо написать консольное приложение с использованием фреймворка Symfony, которое будет проходиться по всем директориям и возвращать сумму всех чисел из файлов count.

Программа считывает все числа из файлов "сount" и выводит либо в браузере, либо в коммандной строке.

Для запуска приложение требуется выполнить следующие действия:
---------------------------------------------------------------
1) Требуется ввести корневую директорию в параметр **common_directory** в **'config/services.yaml'**
2) В терминале проекта выполнить - symfony serve
3) Открыть в браузере страницу http://localhost:8000/count

В окне браузера появится запись Total: "Сумма чисел"

Для запуска команды требуется ввести следующую комманду:
---------------------------------------------------------------
1) Требуется ввести корневую директорию в параметр **common_directory** в **'config/services.yaml'**
2) Выполнить комманду - php bin/console count:files


В консоли появится запись 'Total: "Сумма чисел"'
