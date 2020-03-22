<template>
    <div class="navigation shadow rounded">
        <div class="widget-title">TOOLS</div>
        <p class="note">Below are some useful tools for you to use to help you complete each section.</p>
        <div class="doc-list mb-3">
            <a class="doc" href="#">
                <span class="status"><i class="fas fa-chevron-up"></i></span>
                <span class="doc-name">Jump to top</span>
            </a>
            <a class="doc" href="#" @click.prevent="showReminderForm = true">
                <span class="status"><i class="fas fa-bookmark"></i></span>
                <span class="doc-name">Set reminder</span>
                <span v-if="showReminderForm" @click.stop="showReminderForm = false">x</span>
            </a>
            <create-reminder v-show="showReminderForm" class="py-2"></create-reminder>
        </div>
        <a href="#" class="btn btn-primary w-100">Next Section</a>
    </div>
</template>

<script>
import CreateReminder from '../CreateReminder';
export default {
    name: 'Tools',
    components: {
        CreateReminder
    },
    data() {
        return {
            showReminderForm: false
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@/_variables.scss';

.navigation {
    padding: 24px;
    background-color: $white;
}
.widget-title {
    font-weight: 600;
    margin-bottom: 16px;
}
.note {
    color: $gray-500;
}
.doc-list {
    .doc {
        padding: 8px 0;
        display: flex;
        align-items: center;
        color: $body-color;
        transition: .25s;

        .status {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            border-radius: 50%;
            border: 1px solid;
            border-color: $body-color;
            box-sizing: border-box;
            text-align: center;
            width: 24px;
            height: 24px;
            transition: .25s;
            .fas {
                font-size: 10px;
                color: $body-color;
            }
        }
        
        &:hover {
            color: $primary;
            text-decoration: none;
            .status {
                background-color: $primary;
                border-color: $primary;
                color: $white;
                .fas {
                    color: $white;
                }
            }
        }
        .doc-name {
            flex-grow: 1;
        }
    }
}
</style>