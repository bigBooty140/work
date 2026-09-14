class VehicleNotesPopover extends VehicleNotesController {
    template = `
        <v-popover>
            <span
                v-if="isInProgress"
                class="fa fa-spinner fa-spin"
            >
            </span>
            <span
                v-else
                class="vehicle-notes-btn"
                :class="hasNoteClassComputed"
                @click="openNote"
            >
                    <i class="fa fa-pencil"></i><span v-if="withLabel" class="note-btn-text">Note</span>
                </span>
            <template slot="popover">
                <div class="vehicle-notes-tooltip">
                    <span>Enter Note</span>
                    <textarea rows="3" v-model="noteResult"></textarea>
                    <div class="vehicle-notes-btns">
                        <div
                            v-close-popover
                            class="save-btn"
                            @click="saveNote"
                        >
                            SAVE
                        </div>
                        <div
                            v-close-popover
                            class="cancel-btn"
                            @click="cancelNote"
                        >
                            CANCEL
                        </div>
                    </div>
                </div>
            </template>
        </v-popover>
    `;
}
