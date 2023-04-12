<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'count:files',
    description: 'Command, that counts numbers in files named "count"',
)]
class CountFilesCommand extends Command
{

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $rootdirectory = 'C:\ДЗ\5\TEST'; //Введите корневую папку
        $total = 0;
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($rootdirectory));

        foreach ($iterator as $file)
        {
            if($file->isFile() && $file->getFilename() === 'count.txt'){
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
