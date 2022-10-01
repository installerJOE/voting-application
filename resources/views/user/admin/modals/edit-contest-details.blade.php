<div id="editContestDetailsModal" class="modal fade" role="dialog" aria-labelledby="editContestDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title" id="editContestDetailsModalLabel"> 
                    Edit Contest Base Data
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('admin.contests.updateContestBaseData', ['contest' => $contest])}}" method="POST" id="edit-contest-details-form">
                    @csrf
                    <label> Contest Name </label>
                    <input type="text" class="form-control" name="name" placeholder="e.g. Joe" value="{{old('name') ?? $contest->name}}">

                    <label> Description/Overview </label>
                    <textarea class="form-control" name="description" rows="5">{{old('description') ?? $contest->description}}</textarea>

                    <label> Prize </label>
                    <input type="text" name="prize" value="{{old('prize') ?? $contest->prize}}" class="form-control" placeholder="e.g. Cash Prize of #10,000"/>

                    <label> Total Number of Contestants </label>
                    <input type="number" class="form-control" name="number_of_contestants" value="{{old('number_of_contestants') ?? $contest->contestants_needed}}" placeholder="e.g. 100"/>
                </form>
            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-blue-bg btn-alert-modal" style="float:left" onclick="submitModalForm('edit-contest-details-form')"> 
                    Update Contest
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>