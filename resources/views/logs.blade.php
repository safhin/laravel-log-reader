<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Error Logs</h3>
                <div class="pl-table">
                    <div class="pl-thead tall">
                        <div class="row">
                            <div class="col">Date</div>
                            <div class="col">Content</div>
                        </div>
                    </div>
                    <div class="pl-tbody">
                        @foreach ($logs as $logFile)
                        
                            <div class="row">
                                <div class="col">{{ $logFile }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <h3>Event Logs</h3>
                <div class="pl-table">
                    <div class="pl-thead tall">
                        <div class="row">
                            <div class="col">Logs</div>
                        </div>
                    </div>
                    <div class="pl-tbody">
                        @foreach ($accessLogs as $log)
                        @php
                            $date = \Carbon\Carbon::now();
                            $date2 = preg_match("/09-02-2022/", $log);
                            echo $date2;
                        @endphp
                            <div class="row">
                                <div class="col">{{ $log }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>