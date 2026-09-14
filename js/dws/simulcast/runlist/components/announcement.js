window.Runlist.components.announcement = {
    template: '#component-announcement',
    props: {
        announcement: String,
        limit: {
            type: Number,
            default: 32,
        },
    },
    computed: {
        isAnnouncementMoreLimit: function () {
            return this.announcement.length > this.limit;
        },
        announcementComputed: function () {
            var last = (this.isAnnouncementMoreLimit) ? '...' : '';

            return this.announcement.slice(0, this.limit) + last;
        },
        tooltipData() {
            const template = `
                <div class="tooltip">
                    <div class="tooltip-arrow"></div>
                    <div class="tooltip-inner text-break"></div>
                </div>`;

            return {
                content: this.isAnnouncementMoreLimit ? this.announcement : '',
                template,
            };
        },
    },
};
