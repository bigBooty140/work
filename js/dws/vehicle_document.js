$(function () {
    let documentList = [];
    let currentDocument = 0;

    $('.layout-container').on('click.vehicleDocument', '.vehicle-document', (e) => {
        clearDocumentNavigation();
        window.bsDialog(prepareDialogParams(e.target));
    });

    $('body').on('click.modalDocumentNext', '.modal-document-next', () => {
        if (currentDocument >= documentList.length - 1) {
            return;
        }

        currentDocument ++;
        $('.modal-dialog')
            .find('.modal-document-frame')
            .attr('src', documentList[currentDocument].url);

        changeCurrentDocument();
        toggleNavigationButtons();
    });

    $('body').on('click.modalDocumentPrev', '.modal-document-prev', () => {
        if (currentDocument <= 0) {
            return;
        }

        currentDocument --;
        $('.modal-dialog')
            .find('.modal-document-frame')
            .attr('src', documentList[currentDocument].url);

        changeCurrentDocument();
        toggleNavigationButtons();
    })

    function prepareDialogParams(currentDocumentsButton) {
        const data = $(currentDocumentsButton).data();
        let navigationTemplate = `
            <div class="text-center">
                <div class="btn btn-sm btn-default pull-right modal-document-next">Next</div>
                <div class="btn btn-sm btn-default pull-left modal-document-prev disabled">Prev</div>
                <div class="inline btn"><span class="modal-document-number">1</span> / ${data.params.length}</div>
            </div>`;
        const iframeTemplate = `<iframe src="${data.params[0].url}" type="application/pdf" class="modal-document-frame"></iframe>`;

        if (data.params.length < 2) {
            navigationTemplate = '';
        };

        const params = {
            title: data.title,
            content: navigationTemplate + iframeTemplate,
            closeButton: true,
            buttons: {
                Close: '',
            },
        };

        documentList = data.params;

        return params;
    }

    function clearDocumentNavigation() {
        documentList = [];
        currentDocument = 0;
    };

    function changeCurrentDocument() {
        $('.modal-dialog')
            .find('.modal-document-number')
            .html(currentDocument + 1);

    };

    function toggleNavigationButtons() {
        const $dialog = $('.modal-dialog');
        const $nextButton = $dialog.find('.modal-document-next');
        const $prevButton = $dialog.find('.modal-document-prev');
        const DISABLED_CLASS = 'disabled';

        $prevButton.toggleClass(
            DISABLED_CLASS,
            currentDocument <= 0
        );

        $nextButton.toggleClass(
            DISABLED_CLASS,
            currentDocument >= documentList.length - 1
        );
    };
});
