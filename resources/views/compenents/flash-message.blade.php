@if (session()->has('message'))
<div class="fixed top-0 left-1/2 transform-traslate-x-1/2 bg-green-500 text-white px-48 py-3">
    <p>
        {{session('message')}}
    </p>

</div>
    
@endif