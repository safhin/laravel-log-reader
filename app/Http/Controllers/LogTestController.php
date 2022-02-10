<?php

namespace App\Http\Controllers;

use App\Service\CustomLogWriteService;
use App\Service\LogReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function Ramsey\Uuid\v1;

class LogTestController extends Controller
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

    public function getLog()
    {
        $logReader = new LogReader();
        $logs = $logReader->get();
        return response()->json(['success' => true, 'data' => $logs]);
    }

    public function logViewer(){
        $logReader = new LogReader();
        $logs = $logReader->get();
        return view('log')->with('logs', $logs);
    }



    public function eventLogWrite()
    {
        $message = 'Error happend';
        CustomLogWriteService::ErrorLogWrite($message);
        return 'code came to the catch block';
    }
}
