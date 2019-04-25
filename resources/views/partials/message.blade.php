<div class="bg-red-light p-6">
    @isset($errors)
        @if(count($errors))
            <div class="">
                @foreach ($errors as $error_array)
                    @foreach($error_array as $error)
                        {{$error}}
                    @endforeach
                @endforeach
            </div>
        @endif
    @endisset

    @isset($success)
        <div class="">
             {{$success}}
        </div>
    @endisset
</div>