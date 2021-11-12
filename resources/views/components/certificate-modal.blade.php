{{-- Add new certificate modal --}}
<div class="modal fade" id="certiModal" tabindex="-1" aria-labelledby="certiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="certiModalLabel">Add Certificate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('storeNewCertificate')}}">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="certificateName" class="col-form-label">Certificate Name</label>
                <input type="text" name="certificate_name" class="form-control" id="certificateName" required autocomplete="off">
              </div>
              <div class="form-group col-md-6">
                  <label for="certificateURL" class="col-form-label">Certificate URL</label>
                  <input type="text" name="certificate_url" class="form-control" id="certificateURL" required autocomplete="off">
              </div>
              <div class="form-group col-md-6">
                <label for="certificateProvider" class="col-form-label">Certificate Provider</label>
                <select class="form-control" name="certificate_provider" id="certificateProvider" required>
                  @foreach ($getCertProviders as $certprovider)
                  <option value="{{$certprovider->id}}" >{{$certprovider->provider}}</option>                     
                  @endforeach

                </select>
              </div>
              <div class="form-group col-md-6">
                  <label for="dateAcquired" class="col-form-label">Date Acquired</label>
                  <input type="date" name="date_acquired" class="form-control" id="dateAcquired" required autocomplete="off">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

{{-- update certificate modal --}}
<div class="modal fade" id="editCertiModal" tabindex="-1" aria-labelledby="editCertiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCertiModalLabel">Update Certificate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('updateCertificate')}}">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="hidden" name="cert_id" id="certID" required>
              <label for="updateCertificateName" class="col-form-label">Certificate Name</label>
              <input type="text" name="certificate_name" class="form-control" id="updateCertificateName" required autocomplete="off">
            </div>
            <div class="form-group col-md-6">
                <label for="UpdateCertificateURL" class="col-form-label">Certificate URL</label>
                <input type="text" name="certificate_url" class="form-control" id="UpdateCertificateURL" required autocomplete="off">
            </div>
            <div class="form-group col-md-6">
              <label for="updateCertificateProvider" class="col-form-label">Certificate Provider</label>
              <select class="form-control" name="certificate_provider" id="updateCertificateProvider" required>
                @foreach ($getCertProviders as $certprovider)
                <option value="{{$certprovider->id}}" >{{$certprovider->provider}}</option>                     
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
                <label for="updateDateAcquired" class="col-form-label">Date Acquired</label>
                <input type="date" name="date_acquired" class="form-control" id="updateDateAcquired" required autocomplete="off">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>