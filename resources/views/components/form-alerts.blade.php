<div>
    <div class="mb-3">
        @if( Session::get('info') )
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {!! Session::get('info') !!}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if( Session::get('fail') )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! Session::get('fail') !!}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if( Session::get('success') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! Session::get('success') !!}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
