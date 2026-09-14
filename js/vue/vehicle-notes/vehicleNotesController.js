class VehicleNotesController {
    constructor() {}

    methods = {
        getNote () {
            const data = {
                oper: this.getOper,
                ajax_controller: this.ajaxController,
            };

            data[this.requestParamName] = this.vehicleId;

            $.ajax({
                url: this.ajaxUrl,
                type: 'post',
                data,
                dataType: 'json',
                success: (result) => {
                    if (result.data) {
                        this.noteValue = result.data.note;
                    } else if (result.errors && Array.isArray(result.errors)) {
                        result.errors.forEach(error => {
                            window.jalert(error.title, 'error');
                        });
                    }
                },
                error: (jqXHR, textStatus) => {
                    window.jalert(textStatus, 'error');
                },
                complete: () => {
                    if (this.noteValue === null) {
                        this.isNecessaryToAddToWatchlist = true;
                    }

                    this.isInProgress = false;
                },
            });
        },
        cancelNote () {
            this.noteResult = this.noteValue;
        },
        saveNote () {
            const data = {
                oper: this.saveOper,
                ajax_controller: this.ajaxController,
                note: this.noteResult,
            };

            if (!this.noteResult && !this.noteValue) {
                return;
            }

            data[this.requestParamName] = this.vehicleId;
            this.noteValue = this.noteResult;

            $.ajax({
                url: this.ajaxUrl,
                type: 'post',
                data: data,
                dataType: 'json',
                success: (result) => {
                    if (this.isNecessaryToAddToWatchlist) {
                        this.$emit('note-saved', this.vehicleId, this.noteResult);
                        $('body').trigger('watchAdd', this.vehicleId);
                    }

                    if (result.errors && Array.isArray(result.errors)) {
                        result.errors.forEach(error => {
                            window.jalert(error.title, 'error');
                        });
                    }
                },
                error: (jqXHR, textStatus) => {
                    window.jalert(textStatus, 'error');
                },
            });
        },
        openNote () {
            this.noteResult = this.noteValue;
        },
    }

    props = {
        vehicleId: {
            type: [String, Number],
            required: true,
        },
        withLabel: {
            type: Boolean,
            default: false,
        },
        requestParamName: {
            type: String,
            default: 'vehicleId',
        },
        getOper: {
            type: String,
            default: 'get',
        },
        saveOper: {
            type: String,
            default: 'save',
        },
    }

    computed = {
        hasNoteClassComputed() {
            return this.noteValue ? 'has-note' : '';
        },
    }

    data = function () {
        return {
            noteResult: '',
            noteValue: '',
            isInProgress: true,
            ajaxController: 'Vehicle/Note',
            ajaxUrl: '/ajax',
            isNecessaryToAddToWatchlist: false,
        };
    }

    created = function () {
        this.getNote();
    }
}
