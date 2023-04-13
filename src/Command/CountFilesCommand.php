<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

// Объявление $defaltName и $defaultdescription (Названия комманды и описания)
#[AsCommand( 
    name: 'count:files',
    description: 'Command, that counts numbers in files named "count"',
)]

// Класс для подсчёта файлов "count"
class CountFilesCommand extends Command
{
    // Переменная, служащая для получение корневой директории, указанной в config/services.yaml
    private $commonDirectory;

    // Передача классу корневой переменной, указанной в config/services.yaml, используя конструктор
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->commonDirectory = $parameterBag->get('common_directory');
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        
        // Переменная для подсчёта всех чисел в файлах "count"
        $total = 0; 
        // Объект, предназначенный для перебора всех файлов и папок в заданных директориях/поддиректориях
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->commonDirectory));
        
        /* 
        Перебор всех файлов и папок в корневой директории.
        Проверяется, является ли текущий элемент итератора файлом и имеет ли он название "count", игнорируя расширение
        И, если да, то из него считывается содержимое, которое должно быть числом, и добавляется к общей сумме $total
        Далее значение переменной $total выводится в коммандной строке
        */
        foreach ($iterator as $file)
        {      
            if($file->isFile() && pathinfo($file, PATHINFO_FILENAME) == 'count'){
                $openfile = fopen($file, 'r');
                while (($line = fgets($openfile)) !== false) {
                    $number = intval($line);
                    if ($number) $total += $number;
                }
            }
        }

        $output->writeln('Total: '.$total);

        return Command::SUCCESS;
    }
}
