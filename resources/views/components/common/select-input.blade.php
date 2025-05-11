<div class="w-full pb-6 justify-center">
    <label class="pb-4" for="{{$name}}">{{$placeholder}}:</label>
    <br>
    <select name="{{$name}}" id="{{$name}}" class="border-gray-300 w-full focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm">
        @if(is_null($selectedValue))
            <option value="" disabled selected>Selecciona una opción</option>
        @endif
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ $selectedValue == $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
</div>
