<footer class="mt-5">
    <div class="nes-container is-dark is-centered footer-custome">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <p>All Rights Reserved &copy 2019-{{ now()->format('Y') }}</p>
              {{-- <p><a href="#">license & Attributes</a></p> --}}
              <p id="v-num">{{config('app.version')}} - Released {{config('app.version_releaase_date')}}</p>
          </div>
        </div>
      </div>
    </div>
</footer>