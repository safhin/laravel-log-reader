@foreach ($logs['logs'] as $log)
    <tr>
        <td>{{ $log['timestamp'] }}</td>
        <td>
            <span class="badge badge-danger">{{ $log['type'] }}</span>
        </td>
        <td>{{ $log['ip'] }}</td>
        <td>{{ $log['message'] }}</td>
    </tr>
@endforeach