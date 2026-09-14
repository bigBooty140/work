window.Runlist.components.booksheet = {
    template: '#component-booksheet',
    props: {
        documents: Array,
    },
    data: function () {
        return {
            showModal: false,
            documentNumber: 0,
        };
    },
    computed: {
        documentUrl() {
            return this.documents[this.documentNumber].url;
        },
        isNextDisabled() {
            return this.documentNumber >= this.documents.length - 1;
        },
    },
    methods: {
        openModal: function () {
            this.showModal = true;
        },
        closeModal: function () {
            this.showModal = false;
        },
        nextDocument() {
            if (this.isNextDisabled) {
                return;
            }

            this.documentNumber ++;
        },
        prevDocument() {
            if (!this.documentNumber) {
                return;
            }

            this.documentNumber --;
        },
    },
};
