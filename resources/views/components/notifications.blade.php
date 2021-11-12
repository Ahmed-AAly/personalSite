@if (session('successstatus'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('successstatus') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('failedstatus'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('failedstatus') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors)
    @foreach ($errors->all() as $message)
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endforeach
@endif

@if (session('noArticleFound'))
    <span class="nes-text is-error">{{ session('noArticleFound') }}</span>
@endif