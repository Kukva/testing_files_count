<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[AsCommand(
    name: 'count:files',
    description: 'Command, that counts numbers in files named "count"',
)]
class CountFilesCommand extends Command
{
    private $commonDirectory;
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->commonDirectory = $parameterBag->get('common_directory');
        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        
        $total = 0;
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->commonDirectory));

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
