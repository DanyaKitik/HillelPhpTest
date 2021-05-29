<ul class="nav nav-pills nav-fill">
    <li class="nav-item" style="margin: 20px">
        <a class="nav-link active" href="{{route('home')}}">Home</a>
    </li>
    @if(auth()->user())
        <li class="nav-item" style="margin: 20px">
            <a class="nav-link active" href="{{route('show')}}">My Posts</a>
        </li>
    @else
        <li class="nav-item" style="margin: 20px; border: 2px solid black; border-radius: 5px;">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">My Posts</a>
        </li>
    @endif
    @if(auth()->user())
        <li class="nav-item" style="margin: 20px; border: 2px solid black; border-radius: 5px;">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Register</a>
        </li>
    @else
        <li class="nav-item" style="margin: 20px">
            <a class="nav-link active" href="{{route('register')}}">Register</a>
        </li>
    @endif
</ul>

