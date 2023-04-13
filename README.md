# Testing_files_count
Counting numbers in the files "count"

Данный "проект" является тестовым заданием

Задание: Есть список директорий неограниченной вложенности. В каждой директории может присутствовать файл count. 
Необходимо написать консольное приложение с использованием фреймворка Symfony, которое будет проходиться по всем директориям и возвращать сумму всех чисел из файлов count.

Программа считывает все числа из файлов "сount" с расширение txt и выводит либо в браузере, либо в коммандной строке.
Для работы программы требуется ввести корневую директорию в параметр **common_directory** в **'config/services.yaml'**

Для запуска приложение требуется выполнить следующие действия:
---------------------------------------------------------------
1) В терминале проекта выполнить - symfony serve
2) Открыть в браузере страницу http://localhost:8000/count

В окне браузера появится запись Total: "Сумма чисел"

Для запуска команды требуется ввести следующую комманду:
---------------------------------------------------------------
php bin/console count:files


В консоли появится запись 'Total: "Сумма чисел"'
