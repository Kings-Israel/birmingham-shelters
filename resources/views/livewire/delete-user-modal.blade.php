{{-- Delete User Confirmation Modal --}}
<div wire:ignore class="modal" id="delete-user-confirmation-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Permanently Delete User Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <p>Are you sure you want to <strong>permanently</strong> delete user record? They will no longer have accesss to the system.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger-gradiant" wire:click.prevent="delete">Yes, I'm sure.</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('#delete-user-confirmation-modal').on('show.bs.modal', event => {
            const { userId } = event.relatedTarget.dataset;
            @this.set('user_id', userId);
        });
    </script>
@endpush
