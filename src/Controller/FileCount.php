<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
class FileCount extends AbstractController
{
    private $commonDirectory;
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->commonDirectory = $parameterBag->get('common_directory');
    }
    public function countFiles(): Response
    {
        //$path = 'C:\ДЗ\5\TEST';
        $total = 0;
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->commonDirectory));
        
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getBasename() === 'count.txt') {
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
