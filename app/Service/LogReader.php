<?php


namespace App\Service;

use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\File as FacadesFile;

class LogReader
{

    public function getLogFileDates()
    {
        $dates = [];
        $files = glob(storage_path('errorlog/*.txt'));
        
        $files = array_reverse($files);
        foreach ($files as $path) {
            $fileName = basename($path);
            array_push($dates, $fileName);
        }
        return $dates;
    }

    public function getLogFiles($folderName)
    {
        $dates = [];
        $files = glob(storage_path("$folderName/*.txt"));
        
        $files = array_reverse($files);
        foreach ($files as $path) {
            $fileName = basename($path);
            array_push($dates, $fileName);
        }
        return $dates;
    }


    public function get($folderName, $fileName)
    {

        if($folderName == "errorlog"){
            $pattern = "/^(?<date>.*)\-\s(?<type>[a-z_]*)\s\D+(?<ip>.*)\|(?<user>.*)\|(?<url>.*)\|(?<message>.*)/m";
        }elseif($folderName == "systemlog"){
            $pattern = "/^(?<date>.*)\s\-\s(?<type>[a-z_]*)\s\D+(?<ip>[\.0-9]*)\|(?<user>[a-z]*\b)\|(?<message>.*)/m";
        }else{
            $pattern = "/^(?<date>.*)\-\s(?<type>[a-z_]*)\s\D+(?<dummy>.*)\|(?<url>.*)\|(?<event>.*)\|(?<message>.*)/m";
        }
        
        $content = file_get_contents(storage_path("$folderName/" . $fileName));
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER, 0);
        $logs = [];
        foreach ($matches as $match) {
            if($folderName == "errorlog" || $folderName == "systemlog"){
                $logs[] = [
                    'timestamp' => $match['date'],
                    'type' => $match['type'],
                    'ip' => $match['ip'],
                    'message' => trim($match['message'])
                ];
            }else{
                $logs[] = [
                    'timestamp' => $match['date'],
                    'type' => $match['type'],
                    'event' => $match['event'],
                    'message' => trim($match['message'])
                ];
            }
        }
        return $logs;
    }

}