<div class="modal" id="preview-document-modal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <!-- On shown event will fill title -->
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 d-flex">
                <iframe style="flex: 1; width: 100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <a href="#" target="_blank" class="btn btn-sm btn-outline-info text-body external-preview">
                    Open in new window <i class="ti-new-window ml-5"></i>
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#preview-document-modal').on('show.bs.modal', event => {
        const { documentUrl, documentType } = event.relatedTarget.dataset;

        $(event.target).find('.modal-title').text(documentType);
        $(event.target).find('iframe').prop('src', documentUrl);
        $(event.target).find('.external-preview').prop('href', documentUrl);
    });

</script>
@endpush
