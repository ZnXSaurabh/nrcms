@csrf


@isset($escalation)

    @method('PUT')    

@endisset


<div class="col-md-6">

    <div class="form-group">

        <label for="department">Department</label>
        
        <select name="department" id="department">
            <option value="">Select Department...</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" @isset($escalation){{ old('department', $escalation->department_id) == $department->id ? ' selected' : '' }}@else{{ old('department') == $department->id ? ' selected' : '' }}@endisset>{{ $department->name }}</option>
            @endforeach
        </select>

        @error('department')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>

<div class="col-md-6 mb-5">

    <div class="form-group">

        <label for="complaint_status">Complaint Status</label>

        <select name="complaint_status" id="complaint_status">
            <option value="">Select Status...</option>
            <option value="Initiated" @isset($escalation){{ old('complaint_status', $escalation->complaint_status) == 'Initiated' ? ' selected' : '' }}@else{{ old('complaint_status') == 'Initiated' ? ' selected' : '' }}@endisset>Initiated</option>
            <option value="Allocated but Not Resolved" @isset($escalation){{ old('complaint_status', $escalation->complaint_status) == 'Allocated but Not Resolved' ? ' selected' : '' }}@else{{ old('complaint_status') == 'Allocated but Not Resolved' ? ' selected' : '' }}@endisset>Allocated but Not Resolved</option>
        </select>

        @error('complaint_status')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>
    

<div class="row m-0">
    
    <div class="col-md-3">

        <div class="form-group">
    
            <label for="l1_escalation_days">Level 1 Escalation Days</label>
    
            <input type="number" name="l1_escalation_days" id="l1_escalation_days" value="@isset($escalation){{ old('l1_escalation_days', $escalation->l1_escalation_days) }}@else{{ old('l1_escalation_days')}}@endisset">
    
            @error('l1_escalation_days')
    
                <div class="invalid-feedback">{{ $message }}</div>
    
            @enderror
    
        </div>
    
    </div>
    
    <div class="col-md-3">
    
        <div class="form-group">
    
            <label for="l1_escalation_role">Level 1 Escalation Role</label>
            
            <select name="l1_escalation_role" id="l1_escalation_role">
                <option value="">Select Role...</option>
                <option value="ADEN" @isset($escalation){{ old('l1_escalation_role', $escalation->l1_escalation_role) == 'ADEN' ? ' selected' : '' }}@else{{ old('l1_escalation_role') == 'ADEN' ? ' selected' : '' }}@endisset>ADEN</option>
                <option value="DEN" @isset($escalation){{ old('l1_escalation_role', $escalation->l1_escalation_role) == 'DEN' ? ' selected' : '' }}@else{{ old('l1_escalation_role') == 'DEN' ? ' selected' : '' }}@endisset>DEN</option>
                <option value="SDEN" @isset($escalation){{ old('l1_escalation_role', $escalation->l1_escalation_role) == 'SDEN' ? ' selected' : '' }}@else{{ old('l1_escalation_role') == 'SDEN' ? ' selected' : '' }}@endisset>SDEN</option>
            </select>
    
            @error('l1_escalation_role')
    
                <div class="invalid-feedback">{{ $message }}</div>
    
            @enderror
    
        </div>
    
    </div>
    
</div>

<div class="row m-0">
    
    <div class="col-md-3">

        <div class="form-group">
    
            <label for="l2_escalation_days">Level 2 Escalation Days</label>
    
            <input type="number" name="l2_escalation_days" id="l2_escalation_days" value="@isset($escalation){{ old('l2_escalation_days', $escalation->l2_escalation_days) }}@else{{ old('l2_escalation_days')}}@endisset">
    
            @error('l2_escalation_days')
    
                <div class="invalid-feedback">{{ $message }}</div>
    
            @enderror
    
        </div>
    
    </div>
    
    <div class="col-md-3">
    
        <div class="form-group">
    
            <label for="l2_escalation_role">Level 2 Escalation Role</label>
            
            <select name="l2_escalation_role" id="l2_escalation_role">
                <option value="">Select Role...</option>
                <option value="ADEN" @isset($escalation){{ old('l2_escalation_role', $escalation->l2_escalation_role) == 'ADEN' ? ' selected' : '' }}@else{{ old('l2_escalation_role') == 'ADEN' ? ' selected' : '' }}@endisset>ADEN</option>
                <option value="DEN" @isset($escalation){{ old('l2_escalation_role', $escalation->l2_escalation_role) == 'DEN' ? ' selected' : '' }}@else{{ old('l2_escalation_role') == 'DEN' ? ' selected' : '' }}@endisset>DEN</option>
                <option value="SDEN" @isset($escalation){{ old('l2_escalation_role', $escalation->l2_escalation_role) == 'SDEN' ? ' selected' : '' }}@else{{ old('l2_escalation_role') == 'SDEN' ? ' selected' : '' }}@endisset>SDEN</option>
            </select>
    
            @error('l2_escalation_role')
    
                <div class="invalid-feedback">{{ $message }}</div>
    
            @enderror
    
        </div>
    
    </div>    
    
</div>

<div class="row m-0">
    
    <div class="col-md-3">

        <div class="form-group">
    
            <label for="l3_escalation_days">Level 3 Escalation Days</label>
    
            <input type="number" name="l3_escalation_days" id="l3_escalation_days" value="@isset($escalation){{ old('l3_escalation_days', $escalation->l3_escalation_days) }}@else{{ old('l3_escalation_days')}}@endisset">
    
            @error('l3_escalation_days')
    
                <div class="invalid-feedback">{{ $message }}</div>
    
            @enderror
    
        </div>
    
    </div>
    
    <div class="col-md-3">
    
        <div class="form-group">
    
            <label for="l3_escalation_role">Level 3 Escalation Role</label>
            
            <select name="l3_escalation_role" id="l3_escalation_role">
                <option value="">Select Role...</option>
                <option value="ADEN" @isset($escalation){{ old('l3_escalation_role', $escalation->l3_escalation_role) == 'ADEN' ? ' selected' : '' }}@else{{ old('l3_escalation_role') == 'ADEN' ? ' selected' : '' }}@endisset>ADEN</option>
                <option value="DEN" @isset($escalation){{ old('l3_escalation_role', $escalation->l3_escalation_role) == 'DEN' ? ' selected' : '' }}@else{{ old('l3_escalation_role') == 'DEN' ? ' selected' : '' }}@endisset>DEN</option>
                <option value="SDEN" @isset($escalation){{ old('l3_escalation_role', $escalation->l3_escalation_role) == 'SDEN' ? ' selected' : '' }}@else{{ old('l3_escalation_role') == 'SDEN' ? ' selected' : '' }}@endisset>SDEN</option>
            </select>
    
            @error('l3_escalation_role')
    
                <div class="invalid-feedback">{{ $message }}</div>
    
            @enderror
    
        </div>
    
    </div>
    
</div>


<div class="col-12">

    <button class="btn green-btn" type="submit">

        @isset($user)

            <i class="mr-1" data-feather="edit"></i> Update Escalation

        @else

            <i class="mr-1" data-feather="save"></i> Save Escalation

        @endisset

    </button>

</div>