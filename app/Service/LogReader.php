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

        // $availableDates = $this->getLogFileDates();

        // if (count($availableDates) == 0) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'No log available'
        //     ]);
        // }
        
        // $configDate = $this->config['date'];

        // if ($configDate == null) {
        //     $configDate = $availableDates[0];
        // }

        // if (!in_array($configDate, $availableDates)) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'No log file found with selected date ' . $configDate
        //     ]);
        // }


        $pattern = "/^(?<date>.*)\-\s(?<type>[a-z_]*)\s\D+(?<ip>.*)\|(?<user>.*)\|(?<url>.*)\|(?<message>.*)/m";

        // $pattern = "/^(?<date>.*)\s\-\s(?<type>[a-z_]*)\s\D+(?<ip>[\.0-9]*)\|(?<user>[a-z]*\b)\|(?<msisdn>[A-z]*\b)\|(?<url>.*)\|(?<message>.*)/m";

        // $fileName =  $configDate;
        $content = file_get_contents(storage_path("$folderName/" . $fileName));
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER, 0);
        $logs = [];
        foreach ($matches as $match) {
            $logs[] = [
                'timestamp' => $match['date'],
                'type' => $match['type'],
                'ip' => $match['ip'],
                'message' => trim($match['message'])
            ];
        }

        // dd($content);


        $date = $fileName;

        $data = [
            // 'available_log_dates' => $availableDates,
            'date' => $date,
            'filename' => $fileName,
            'logs' => $logs
        ];

        return $data;
    }

    public function getSystemLog($fileName)
    {
        $pattern = "/^(?<date>.*)\s\-\s(?<type>[a-z_]*)\s\D+(?<ip>[\.0-9]*)\|(?<user>[a-z]*\b)\|(?<msisdn>[A-z]*\b)\|(?<url>.*)\|(?<message>.*)/m";

        $content = file_get_contents(storage_path('systemlog/' . $fileName));
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER, 0);
        $logs = [];
        foreach ($matches as $match) {
            $logs[] = [
                'timestamp' => $match['date'],
                'type' => $match['type'],
                'ip' => $match['ip'],
                'message' => trim($match['message'])
            ];
        }



        $date = $fileName;

        $data = [
            'date' => $date,
            'filename' => $fileName,
            'logs' => $logs
        ];

        return $data;
    }


}