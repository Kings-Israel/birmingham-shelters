<div>
    <form wire:submit.prevent="submitAssessmentDate" method="POST">
        <div class="row">
            <div class="col-sm-6">
                <input type="date" wire:model.defer="assessment_date"
                    id="date" name="assessment_date" required style="border-radius: 2px;" />
                <x-input-error class="m-t-2" for="assessmet.date" />
            </div>

            <div class="col-sm-6">
                <button class="rounded btn btn-theme btn-sm" type="submit" style="margin-left: 20px">
                    Set Date
                </button>
            </div>
        </div>
    </form>
</div>