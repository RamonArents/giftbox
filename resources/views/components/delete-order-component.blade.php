<!--modal for deleting a password-->
<div class="modal fade" id="deleteOrderModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure you want to delete this order?</p>
                <form action="{{ action('AdminController@deleteOrder', ['id' => $id]) }}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="Delete">
                    <button type="button" class="btn btn-secondary closebutton" data-dismiss="modal">Close</button>
                </form>

            </div>
        </div>
    </div>
</div>