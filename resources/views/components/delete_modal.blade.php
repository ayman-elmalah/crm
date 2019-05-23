<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:50px;">
    <div class="modal-dialog" style="margin-top:50px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">{{ __('lang.warning') }}</h4> </div>
            <div class="modal-body">
                <p>{{ __('lang.are_you_sure') }}</p>
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="delete_modal">
                    @csrf
                    <input type="hidden" name="_method" value="delete" />
                    <button type="submit" class="btn btn-success waves-effect">{{ __('lang.confirm') }}</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">{{ __('lang.cancel') }}</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
