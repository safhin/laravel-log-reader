<?php

namespace App\Http\Controllers;

use App\Service\CustomLogWriteService;
use App\Service\LogReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function Ramsey\Uuid\v1;

class LogTestController extends Controller
{

    function array_keys_multi(array $array)
    {
        $keys = array();

        foreach ($array as $key => $value) {
            $keys[] = $key;

            if (is_array($array[$key])) {
                $keys = array_merge($keys, $this->array_keys_multi($array[$key]));
            }
        }

        return $keys;
    }

    public function findLogFolder($folderName){
        $logReader = new LogReader();
        $logFiles = $logReader->getLogFiles($folderName);
        return view('logfiles',[
            'logFiles' => $logFiles,
        ]);
    }

    public function logViewer()
    {
        $logReader = new LogReader();
        $logFiles = $logReader->getLogFileDates();
        $logReader = new LogReader();
        $logFiles = $logReader->getLogFiles('errorlog');
        $logs = $logReader->get('errorlog',$logFiles[0]);


        return view('log',[
            'logs' => $logs,
            'logFiles' => $logFiles,
        ]);

    }

    public function logViewerByFileName($folderName, $fileName){
        $logReader = new LogReader();
        $logs = $logReader->get($folderName, $fileName);
        return view('single',[
            'logs' => $logs,
        ]);
    }

}
