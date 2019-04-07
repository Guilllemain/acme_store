<div class="row expanded">
    @isset($errors)
        @if(count($errors))
            <div class="callout alert" data-closable>
                @foreach ($errors as $error_array)
                    @foreach($error_array as $error)
                        {{$error}}
                    @endforeach
                @endforeach
                <button class="close-button" aria-label="Dismiss message" data-close>
                    <span arial-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endisset

    @isset($success)
        <div class="callout success" data-closable>
             {{$success}}
            <button class="close-button" aria-label="Dismiss message" data-close>
                <span arial-hidden="true">&times;</span>
            </button>
        </div>
    @endisset
</div>