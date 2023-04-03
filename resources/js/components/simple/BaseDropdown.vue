<template>
    <component class="dropdown" :is="props.tag" ref="dropdownRef">
        <base-button
            data-bs-toggle="dropdown"
            aria-expanded="false"
            type="link"
            class="dropdown-toggle nav-link"
            :class="{ 'no-caret': props.hideArrow }">
            {{ props.title }}
            <span class="caret" v-if="!props.hideArrow"></span>
        </base-button>
        <ul class="dropdown-menu m-0 dropdown-menu-end" :class="menuClasses">
            <slot></slot>
        </ul>
    </component>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { Dropdown as BsDropdown } from '~bootstrap';

const props = defineProps({
    title: {
        type: String,
        description: 'Dropdown title'
    },
    icon: {
        type: String,
        description: 'Icon for dropdown title'
    },
    hideArrow: {
        type: Boolean,
        description: 'Whether dropdown arrow should be hidden'
    },
    menuClasses: {
        type: [String, Object],
        description: 'Dropdown menu classes'
    },
    tag: {
        type: String,
        default: 'li',
        description: 'Dropdown html tag (e.g div, li etc)'
    }
});

const dropdownRef = ref(null);
let dropdownInstance = null;

onMounted(() => {
    dropdownInstance = new BsDropdown(
        dropdownRef.value.querySelector('.dropdown-toggle')
    );
});
</script>

<style>
.dropdown {
    list-style-type: none;
}

.dropdown .dropdown-toggle {
    cursor: pointer;
}
</style>
