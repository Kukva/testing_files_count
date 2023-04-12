<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FileCount extends AbstractController
{
    public function countFiles(): Response
    {
        $path = 'C:\ДЗ\5\TEST';
        $total = 0;
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        
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
