<div class="w-full pb-6 justify-center">
    <label class="pb-4" for="{{$name}}">{{$title}}:</label>
    <br>
    <input type="{{$type}}" name="{{$name}}" id="{{$name}}" value="{{$value}}" class="border-gray-300 w-full focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="{{$placeholder}}">
    @error($name)
    <div class="bg-red-50 border-l-4 border-red-400 p-3 mt-2 rounded-md">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm text-red-600">{{ $message }}</p>
        </div>
    </div>
    @enderror
</div>

