<!--modal for deleting an order-->
<div class="modal fade" id="deleteOrderModal{{ $id }}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Weet u zeker dat u deze order wil verwijderen?</p>
                <form action="{{ action('AdminController@deleteOrder', ['id' => $id]) }}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="Verwijderen">
                    <button type="button" class="btn btn-secondary closebutton" data-dismiss="modal">Sluiten</button>
                </form>
            </div>
        </div>
    </div>
</div>