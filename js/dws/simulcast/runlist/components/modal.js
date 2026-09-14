window.Runlist.components.modal = {
    template: '#component-modal',
    props: {
        modalsize: String,
        maskFn: Function,
    },
    data: function () {
        return {
            groupListData: {},
        };
    },
    methods: {
        closeModal: function () {
            if (typeof this.maskFn === 'function') {
                this.maskFn();
            }
        },
    },
};
