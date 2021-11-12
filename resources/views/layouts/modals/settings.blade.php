<div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingsModalLabel">Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="alertMSG" class="list-unstyled"></ul>
                <form id="settingsForm">
                    @csrf
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="maintenancemode" id="maintenanceMode" 
                        {{ cache('siteSettings')['maintenancemode'] === 'true' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="maintenanceMode">Maintenance mode</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-5">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    // this route url is passed to the Ajax request, when user updated the site settings.
    const ajaxSettingsURL = "{{ route('updateSettings') }}";
</script>