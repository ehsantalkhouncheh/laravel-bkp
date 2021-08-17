<div class="flex">
    <input {{ $attributes }}
        type="checkbox"
        class="form-checkbox mr-2 border-cool-gray-300 block transition duration-150 ease-in-out sm:text-sm sm:leading-5"
    />
    <x-label>{{$slot}}</x-label>
</div>
