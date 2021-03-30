<div>
    <div class="
        border
        p-5
        text-gray-100
        bg-gray-500
        text-3xl
        sm:bg-blue-500
        md:bg-red-500
        lg:bg-yellow-500
        xl:bg-green-500
">{{ $title }}</div>
    <div class="lg:flex">
        <div class="border p-5 text-center sm:text-left lg:w-1/2">
            {!! $content !!}
        </div>
        <div class="border p-5 lg:w-1/2">
            <img src="{{ 'img/cake.jpg' }}" width="200" height="200" alt="Image">
        </div>
    </div>

</div>
