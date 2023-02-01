let emailConfig = {
    settings: {
        emailFormSelector: null,
        imapSentFolderInputId: null,
        urls: {
            imap: null,
            smtp: null
        }
    },

    init: function (settings) {
        $.extend(this.settings, settings, true);
        this.attachEvents();
        console.log('initialiazing email config')
        return this;
    },

    attachEvents: function () {
        $(document)
            .off('click', '.test-imap')
            .on('click', '.test-imap', (e) => {
                this.testService(e.currentTarget, 'imap');
            })
            .off('click', '.test-smtp')
            .on('click', '.test-smtp', (e) => {
                this.testService(e.currentTarget, 'smtp');
            })
    },
    toggleSenderStatus: function (sender, loading) {
        sender = $(sender);
        if (loading) {
            sender.attr("disabled", "disabled");
            sender.find(".button-text").hide();
            sender.find(".loading-icon").removeClass("collapse");
        } else {
            sender.find(".button-text").show();
            sender.find(".loading-icon").addClass("collapse");
            sender.attr("disabled", null);

        }
    },
    imapCallback: function (data) {
        $('.imap-success').show();
        if (!data.mailboxes || data.mailboxes.length <= 0) {
            console.error('[EmailConfig] Unable to retrieve mailboxes ');
        } else {
            let sentFolder = $('#' + this.settings.imapSentFolderInputId);
            let inboxFolder = $('#' + this.settings.imapInboxFolderInputId);
            let draftFolder = $('#' + this.settings.imapDraftsFolderInputId);
            let trashFolder = $('#' + this.settings.imapTrashFolderInputId);
            console.log(this.settings.imapSentFolderInputId, this.settings.imapInboxFolderInputId, this.settings.imapDraftFolderInputId, this.settings.imapTrashFolderInputId);
            for (let i = 0; i < data.mailboxes.length; i++) {

                if(data.mailboxes[i].toLowerCase() === 'inbox'){
                    inboxFolder.val(data.mailboxes[i]);
                }
                if(data.mailboxes[i].toLowerCase().indexOf('sent') >= 0){
                    sentFolder.val(data.mailboxes[i]);
                }

                if(data.mailboxes[i].toLowerCase().indexOf('drafts') >= 0){
                    draftFolder.val(data.mailboxes[i]);
                }
                if(data.mailboxes[i].toLowerCase().indexOf('trash') >= 0){
                    trashFolder.val(data.mailboxes[i]);
                }



            }
            $('.mailboxes-updated').show();

        }
    },
    testService(sender, service) {
        let form = $(this.settings.emailFormSelector);
        console.log(form, this.settings.emailFormSelector)

        $.ajax({
            url: this.settings.urls[service],
            method: 'POST',
            data: form.serialize(),
            beforeSend: () => {
                this.toggleSenderStatus(sender, true);
                $('#test-error').parent().addClass('collapse');
                $('#test-success').addClass('collapse');

                return true;
            },
            success: (data) => {
                if (data.success) {
                    if (service === "imap") {
                        this.imapCallback(data);
                    } else {
                        $('#test-success').removeClass('collapse');
                    }
                } else {
                    let errors = "";
                    if (data.errors && data.errors.length > 0) {
                        errors = data.errors.join('\n');
                    }
                    let message = 'An error ocurred: ' + "\n" + errors;
                    $('#test-error').html(message).parent().removeClass('collapse');
                    console.log(data.errors)
                }
                this.toggleSenderStatus(sender, false)

            },
            fail: (data) => {
                alert('Error connecting to test tool')
                this.toggleSenderStatus(sender, false)

                console.error(data)
            }
        })

    }
}
