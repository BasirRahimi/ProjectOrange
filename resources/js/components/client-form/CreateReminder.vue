<template>
    <form @submit.prevent="submitForm">
        <b-modal
            :id="`${rand}modal`"
            centered
            size="lg"
            hide-footer
            hide-header>
            <div class="d-flex mb-4">
                <div class="flex-grow-1"><strong>SET REMINDER</strong></div>
                <div class="pointer" @click="$bvModal.hide(`${rand}modal`)">
                    <strong>x</strong>
                </div>
            </div>
            <p class="text-gray-500">
                We understand that we ask for a lot of information throughout
                our forms, which may not always be immediately accessible to
                you.<br /><br />To address this, we allow you to create
                reminders for yourself for whichever reason you may need.<br />Whether
                it’s to find a certain document or other information, create a
                reminder for yourself here.
            </p>
            <div class="mb-4">
                <label :for="`${rand}modalsubject`">Subject</label>
                <input
                    type="text"
                    class="form-control"
                    :id="`${rand}modalsubject`"
                    placeholder="National insurance number"
                    v-model="subject" />
            </div>
            <div class="mb-4 notes">
                <label :for="`${rand}modalnotes`">Notes</label>
                <textarea
                    :id="`${rand}modalnotes`"
                    class="form-control"
                    v-model="notes"
                    placeholder="Check storage for John’s national insurance number"
                    rows="5"></textarea>
            </div>
            <button
                @click="submitForm"
                class="btn btn-primary m-auto d-block"
                style="width: 150px">
                Save
            </button>
        </b-modal>

        <div class="mb-4">
            <label :for="`${rand}subject`">Subject</label>
            <input
                type="text"
                class="form-control"
                :class="{ 'form-control-sm': small }"
                :id="`${rand}subject`"
                placeholder="National insurance number"
                v-model="subject" />
        </div>
        <div class="mb-4 notes">
            <label :for="`${rand}notes`">Notes</label>
            <textarea
                :id="`${rand}notes`"
                class="form-control"
                :class="{ 'form-control-sm': small }"
                v-model="notes"
                placeholder="Check storage for John’s national insurance number"
                rows="5"></textarea>
            <span class="expand" @click="$bvModal.show(`${rand}modal`)"
                ><i class="fas fa-external-link-alt"></i
            ></span>
        </div>
        <button
            type="submit"
            class="btn btn-primary w-100"
            :class="{ 'btn-sm': small }">
            Save
        </button>
    </form>
</template>

<script>
export default {
    name: 'CreateReminder',
    props: ['small'],
    data() {
        return {
            rand: Math.floor(Math.random() * 100),
            subject: '',
            notes: ''
        };
    },
    methods: {
        submitForm() {
            let _self = this;
            axios
                .post(`/reminders/${_self.$store.state.client.id}`, {
                    subject: _self.subject,
                    notes: _self.notes
                })
                .then((response) => {
                    console.log(response);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

label {
    font-weight: bold;
}

.notes {
    position: relative;

    textarea {
        resize: none;
    }

    .expand {
        color: $gray-500;
        position: absolute;
        bottom: 5px;
        right: 5px;
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        content: '\f35d';
        cursor: pointer;
    }
}

.modal-header {
    height: 0px;
}
</style>
