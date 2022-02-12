<option value="">Select Date</option>
@foreach ($logFiles as $item)
    <option value="{{ $item }}">{{ $item }}</option>
@endforeach