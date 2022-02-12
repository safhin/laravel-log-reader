<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log Reader</title>

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src='https://code.jquery.com/jquery-1.12.3.js'></script>
    <script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
   
    <script>
        $(document).ready(function(){
            $("#example").DataTable({
                "pageLength": 5
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="row py-4">
            <div class="col-md-3">

                <div class="form-group">
                    <select class="form-control" id="folderSelect">
                        <option value="">Select Log</option>
                         <option value="errorlog" selected>Error Log</option>
                         <option value="eventlog">Event Log</option>
                         <option value="systemlog">System Log</option>
                    </select>
                </div>


                <div class="form-group">
                    <select class="form-control" id="logSelect">
                        <option value="">Select Date</option>
                        <option value="{{ $logs['filename'] }}" selected>{{ $logs['filename'] }}</option>
                    </select>
                </div>
                
            </div>
            <div class="col-md-9">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Type</th>
                            <th>IP</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        @foreach ($logs['logs'] as $log)
                            <tr>
                                <td>{{ $log['timestamp'] }}</td>
                                <td><span class="badge badge-danger">{{ $log['type'] }}</span></td>
                                <td>{{ $log['ip'] }}</td>
                                <td>{{ $log['message'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <input type="hidden" class="site_url" value="{{url('/')}}">

    <script>
        var site_url = $('.site_url').val();

        $('#folderSelect').on('change', function() {

            var folderName = $('#folderSelect').val();
            if(folderName.length !=0){

                var request_url = site_url+'/log-files/'+folderName;
                jQuery.ajax({
                    url: request_url,
                    type: "get",
                    success:function(data){
                        // console.log(data);
                        jQuery('#logSelect').html(data);
                    }
                });

            }else alert("Please Select Log Folder");
        });


        $('#logSelect').on('change', function() {
            var folderName = $('#folderSelect').val();
            var fileName = $('#logSelect').find(":selected").text();
            if(fileName.length !=0){
                var request_url = site_url+'/log-viewer/'+folderName+'/'+fileName;
                jQuery.ajax({
                    url: request_url,
                    type: "get",
                    success:function(data){
                        jQuery('#data').html(data);
                    }
                });

            }else alert("Please Select Date");
        });

        
    </script>

    
</body>
</html>