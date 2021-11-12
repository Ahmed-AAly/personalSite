// Update & delete skill code block
$(function () {
    // update skills
    $('#editSkillModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let recipientID = button.data('skillid') // Extract info from data-* attributes
        let recipientName = button.data('skillname') // Extract info from data-* attributes
        let recipientSatus = button.data('skillstatus') // Extract info from data-* attributes
        let modal = $(this);
        modal.find('.modal-body #skillid').val(recipientID);
        modal.find('.modal-body #editSkillName').val(recipientName);
        modal.find('.modal-body #editSkillStatus').val(recipientSatus);  
    })
    // remove skills
    $('.removeskill').on('click',function(data) {
        let skillID = Number($(this).attr('data-skillid'));
        $("#skillID").val(skillID);
        document.getElementById('removeSkill-Form').submit();
    });
})

// Update & delete certificates code block
$(function () {
    // update certificates
    $('#editCertiModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let recipientID = button.data('certid');
        let recipientName = button.data('certname');
        let recipientURL = button.data('certurl');
        let recipientProvider = button.data('certprovider');
        let recipientDate = button.data('certdate');
        let modal = $(this);
        modal.find('.modal-body #certID').val(recipientID);
        modal.find('.modal-body #updateCertificateName').val(recipientName);
        modal.find('.modal-body #UpdateCertificateURL').val(recipientURL);
        modal.find('.modal-body #updateCertificateProvider').val(recipientProvider);
        modal.find('.modal-body #updateDateAcquired').val(recipientDate);
    })
    // remove certificates
    $('.removeCertification').on('click',function(data) {
        let certID = Number($(this).attr('data-certid'));
        $("#cert-ID").val(certID);
        document.getElementById('removeCert-Form').submit();
    });
})

// edit & delete blog code block
$(function () {
    // edit blog post
    $('.editBlogPost').on('click',function(data) {
        let postID = Number($(this).attr('data-postid'));
        $("#post-ID").val(postID);
        document.getElementById('editPost-Form').submit();
    });
    // delete blog post
    $('#deletePostModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let recipientID = button.data('postid');
        let modal = $(this);
        modal.find('.modal-body #postID').val(recipientID);
    })
})

// delete message block
$(function () {
    // remove messages
    $('.removeMessage').on('click',function(data) {
        let msgID = Number($(this).attr('data-messageid'));
        $("#msgID").val(msgID);
        document.getElementById('removeMSG-Form').submit();
    });
})

// Popover script
$(function () {
    $('[data-toggle="popover"]').popover()
})

// admin settings
$(function () {
    $('#settingsForm').on('submit', function(e) {

        e.preventDefault();

        let formData = $("#settingsForm").serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url: ajaxSettingsURL, // The URL is defined in the settings modal view.
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#alertMSG").html('');
                $("#alertMSG").append('\
                <div id="notificationMSG" class="alert alert-success alert-dismissible fade show list-unstyled" role="alert">Settings updated successfully\
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                    <span aria-hidden="true">&times;</span>\
                    </button>\
                </div>')
            },
            error: function(xhr, status, error){
                $("#alertMSG").html('');
                $("#alertMSG").append('\
                <div id="notificationMSG" class="alert alert-danger alert-dismissible fade show list-unstyled" role="alert">Failed to update settings\
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                    <span aria-hidden="true">&times;</span>\
                    </button>\
                </div>')
            }
        });
    })
})
