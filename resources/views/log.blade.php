<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log Reader</title>

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
   
    <script>
        $(document).ready(function(){
            $("#example").DataTable({
                "pageLength": 10
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
                        @foreach ($folders as $folder)
                            <option value="{{ $folder }}" @if (isset($_GET['dir']) && $_GET['dir']  == $folder) selected @endif>{{ Str::ucfirst($folder) }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <select class="form-control" id="logSelect">
                        <option value="">Select Date</option>
                        @foreach ($logFiles as $item)
                            <option value="{{ $item }}" @if (isset($_GET['file']) == $item) selected @endif>{{ $item }}</option>
                        @endforeach
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
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log['timestamp'] }}</td>
                                <td><span class="badge badge-danger">{{ $log['type'] }}</span></td>
                                <td>
                                    @isset($log['ip'])
                                        {{ $log['ip'] }}
                                    @endisset
                                </td>
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
                        jQuery('#logSelect').html(data);
                    }
                });

            }else alert("Please Select Log Folder");
        });


        $('#logSelect').on('change', function() {
            var folderName = $('#folderSelect').find(":selected").val();
            console.log(folderName);
            var fileName = $('#logSelect').find(":selected").text();
            if(fileName.length !=0){
                // var request_url = site_url+'/log-viewer/'+folderName+'/'+fileName;
                window.location = site_url+'/log-viewer?dir='+folderName+'&file='+fileName;
                // jQuery.ajax({
                //     url: request_url,
                //     type: "get",
                //     success:function(data){
                //         jQuery('#data').html(data);
                //     }
                // });

            }else alert("Please Select Date");
        });

        
    </script>

    
</body>
</html>