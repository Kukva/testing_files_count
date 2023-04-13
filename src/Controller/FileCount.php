<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

// Класс для подсчёта файлов "count"
class FileCount extends AbstractController
{
    // Переменная, служащая для получение корневой директории, указанной в config/services.yaml
    private $commonDirectory;

    // Передача классу корневой переменной, указанной в config/services.yaml, используя конструктор
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->commonDirectory = $parameterBag->get('common_directory');
    }
    public function countFiles(): Response
    {
        // Переменная для подсчёта всех чисел в файлах "count"
        $total = 0;
        // Объект, предназначенный для перебора всех файлов и папок в заданных директориях/поддиректориях
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->commonDirectory));
        
        /* 
        Перебор всех файлов и папок в корневой директории.
        Проверяется, является ли текущий элемент итератора файлом и имеет ли он название "count", игнорируя расширение
        И, если да, то из него считывается содержимое, которое должно быть числом, и добавляется к общей сумме $total
        Далее значение переменной $total выводится в окне браузера засчёт HTTP-ответ
        */
        foreach ($iterator as $file) {
            if ($file->isFile() && pathinfo($file, PATHINFO_FILENAME) == 'count') {
                $openfile = fopen($file, 'r');
                while (($line = fgets($openfile)) !== false) {
                    $number = intval($line);
                    if ($number) $total += $number;
                }
                fclose($openfile);
            }
        }
        
        return new Response('Total: '.$total);
    }


}
