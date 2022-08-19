<!-- Modal -->
<div class="modal" id="modalTest" tabindex="-1" aria-labelledby="modalTestLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTestLabel">license & Attributes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="license-Attrs-style">
        {!! Cache::get('licenseAttributeContent') !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="nes-btn btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>