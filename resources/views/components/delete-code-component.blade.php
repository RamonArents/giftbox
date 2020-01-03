<!--modal for deleting a code-->
<div class="modal fade" id="deleteCodeModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure you want to delete this code?</p>
                <form action="{{ action('AdminController@deleteCode', ['id' => $id]) }}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="Delete">
                    <button type="button" class="btn btn-secondary closebutton" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>