@include('frontend_layouts.modals.licenseattri')
<footer class="mt-5">
    <div class="nes-container is-dark is-centered footer-custome">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <p>All Rights Reserved &copy 2019-{{ now()->format('Y') }}</p>
            @if (null !== Cache::get('licenseAttributeContent'))
            <p><a href="#" id="modalTest" data-toggle="modal" data-target="#modalTest">license & Attributes</a></p>
            @endif
            <p id="v-num">{{config('app.version')}} - Released {{config('app.version_releaase_date')}}</p>
          </div>
        </div>
      </div>
    </div>
</footer>