<div id="updateProfileBioDataModal" class="modal fade" role="dialog" aria-labelledby="updateProfileBioDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title" id="updateProfileBioDataModalLabel"> 
                    Edit Personal Data
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('user.updateBioData')}}" method="POST" id="update-biodata-form">
                    @csrf
                    <label> Full Name </label>
                    <input type="text" class="form-control" name="name" placeholder="e.g. Joe" value="{{old('name') ?? Auth::user()->name}}">

                    {{-- <label> Date of Birth </label>
                    <input type="date" class="form-control" name="date_of_birth" value="{{Auth::user()->date_of_birth}}"> --}}

                    <label> Gender </label>
                    <select class="form-control" name="gender">
                        <option value="male"> Male </option>
                        <option value="female"> Female </option>
                    </select>

                    <label> Phone Contact </label>
                    <input type="text" class="form-control" name="phone_number" value="{{old('phone_number') ?? Auth::user()->phone_number}}" placeholder="e.g. +234 80 2992 3948">
                </form>
            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-blue-bg btn-alert-modal" style="float:left" onclick="updateBioData()"> 
                    Update Profile
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function updateBioData(){
        document.getElementById('update-biodata-form').submit();
    }
</script>