<div class="dashboard-wraper">
    <form class="form-submit" action="#" method="POST" wire:submit.prevent="save">
        <h4>Change Password</h4>
        <div class="submit-section">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" class="form-control" name="current_password"
                        wire:model.defer="current_password" autocomplete="current-password" required>
                    <x-input-error class="m-t-2" for="current_password" />
                </div>

                <div class="form-group col-md-6">
                    <label for="account-password">New Password</label>
                    <input type="password" id="account-password" class="form-control" name="password"
                        wire:model.defer="password" autocomplete="new-password" required>
                    <x-input-error class="m-t-2" for="password" />
                </div>

                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                        wire:model.defer="password_confirmation" autocomplete="new-password" required>
                    <x-input-error class="m-t-2" for="password_confirmation" />
                </div>
            </div>

            <div class="row">
                <div class="d-flex justify-content-end align-items-center">
                    @if($show_message)
                        <div wire:poll.2000ms="dismiss_message" class="fs-5 text-black mr-2">Saved.</div>
                    @endif

                    <div>
                        <button type="submit" class="btn btn-dark">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
