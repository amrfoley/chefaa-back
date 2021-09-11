<div class="container">
    @if($errors->any())
        @foreach ($errors->all() as $error)    
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
</div>