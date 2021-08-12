<div>
    <form wire:submit.prevent="submitFeedback" method="POST">
        <div class="form-submit">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <textarea wire:model.defer="feedback.message"
                        placeholder="Write your feedback" id="feedback-message" name="message"
                        class="form-control ht-50" required></textarea>
                    <x-input-error class="m-t-2" for="feedback.message" />
                </div>

                <div class="col-sm-12 form-group">
                    <button class="rounded btn btn-theme-light-2" type="submit">
                        Submit Feedback
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
