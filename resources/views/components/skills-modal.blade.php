{{-- Add new skill modal --}}
<div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="skillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="skillModalLabel">Add skill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('storeNewSkill')}}">
            @csrf
            <div class="form-group">
              <label for="skillName" class="col-form-label">Skill Name:</label>
              <input type="text" name="skill_name" class="form-control" id="skillName" required autocomplete="off">
            </div>
            <div class="form-group">
              <label for="skillStatus" class="col-form-label">Status</label>
              <select class="form-control" name="skill_status" id="skillStatus" required>
                <option value="1" >Active</option>
                <option value="2" >In-Active</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
</div>

{{-- Update skill Modal --}}

<div class="modal fade" id="editSkillModal" tabindex="-1" aria-labelledby="editSkillModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSkillModalLabel">Update skill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('updateSkill')}}">
          @csrf
          <div class="form-group">
            <input type="hidden" name="skill_id" id="skillid" required>
            <label for="skillName" class="col-form-label">Skill Name:</label>
            <input type="text" name="skill_name" class="form-control" id="editSkillName" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="skillStatus" class="col-form-label">Status</label>
            <select class="form-control" name="skill_status" id="editSkillStatus" required>
              <option value="1" >Active</option>
              <option value="2" >In-Active</option>
            </select>
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
