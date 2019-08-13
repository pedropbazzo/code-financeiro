@if($errors->any())
    <ul class="collection">
        @foreach($errors->all() as $error)
            <li class="collection-item red white-text">{{$error}}</li>
        @endforeach
    </ul>
@endif