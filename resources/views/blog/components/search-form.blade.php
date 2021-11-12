<div class="container mt-5">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 search-bar">
        <div class="box">
          <div class="nes-container is-dark">
            <form class="" action="{{route('searchPost')}}" method="GET">
              {{-- @csrf --}}
              <div class="nes-field is-inline center-xs form-row">
                <input type="text" name="post_title" id="searchEntry" class="nes-input is-invalid" aria-describedby="searchHelpBlock" placeholder="Search" autocomplete="off">
                <button type="submit" class="is-inline nes-btn is-success">Go</button>
                  @if ($errors->any())
                      @foreach ($errors->all() as $error)
                        <div id="searchEntryInvalid" class="invalid-feedback">
                          <small id="searchHelpBlock" class="form-text text-muted">
                            <span class="nes-text is-error">{{ $error }}</span>
                          </small>
                        </div>
                      @endforeach
                  @endif
                  @if (session('noArticleFound'))
                    <div id="searchEntryInvalid" class="invalid-feedback">
                      <small id="searchHelpBlock" class="form-text">
                        <span class="nes-text is-error">{{ session('noArticleFound') }}</span>
                      </small>
                    </div>
                  @endif
              </div>
            </form>
          </div>
        </div>
        </div>
    </div>
</div>