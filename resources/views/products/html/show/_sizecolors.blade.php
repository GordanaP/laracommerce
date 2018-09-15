<option value="">Select a color</option>

@foreach ($colors as $color)
    <option value="{{ $color->id}}">
        {{ $color->name }}
    </option>
@endforeach
