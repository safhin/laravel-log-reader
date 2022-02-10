<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log Reader</title>

    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body ng-controller="LogCtrl">
    <section class="content">
        <div class="top_content">
            <div class="top_content_left">
                <div>
                    <p class="selected_date" style="font-size: 14px;">
                        <strong>
                            <span ng-show="response.success">Showing Logs: {{$logs['date']}}</span>
                        </strong>
                    </p>
                </div>
            </div>

            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option value="event_log">Select Log Type:</option>
                <option value="event_log">Event Log</option>
                <option value="errorlog">Error Log</option>
                <option value="systemlog">System Log</option>
            </select>
        </div>

        <div>
            <div class="pl-table">
                <div class="pl-thead tall">
                    <div class="row">
                        <div class="col">Timestamp</div>
                        <div class="col">Type</div>
                        <div class="col">IP</div>
                        <div class="col">Message</div>
                    </div>
                </div>
                <div class="pl-tbody">
                    @foreach ($logs['logs'] as $log)
                        <div class="row">
                            <div class="col">{{ $log['timestamp'] }}</div>
                            <div class="col">
                                @if ($log['type'] == "error_log")
                                    <span class="badge badge-danger">{{ $log['type'] }}</span>
                                @elseif($log['type'] == "access_log")
                                    <span class="badge badge-info">Access Log</span>
                                @endif
                            </div>
                            <div class="col">{{ $log['ip'] }}</div>
                            <div class="col">{{ $log['message'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $.ajax({
                    type: "GET",
                    url: "custom-logger",
                    dataType:'json',
                    success: function(data) {
                        log = data.data;
                        console.log(log.date);
                    }
                });
            });
        </script>
    </section>
</body>
</html>