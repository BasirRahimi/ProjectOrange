<template>
    <div id="pageNav">
        <a href="#" @click.prevent="updatePage(currentPage - 1)">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="hidden-nav-pages prev" v-if="navItems.hiddenPrev.length">
            <div class="dots">...</div>
            <div class="pages">
                <a
                    v-for="pageNumber in navItems.hiddenPrev"
                    href="#"
                    @click.prevent="updatePage(pageNumber)">
                    {{ pageNumber }}
                </a>
            </div>
        </div>
        <a
            v-for="pageNumber in navItems.visiblePages"
            href="#"
            @click.prevent="updatePage(pageNumber)"
            :class="{ 'fw-bold': pageNumber === currentPage }">
            {{ pageNumber }}
        </a>
        <div class="hidden-nav-pages next" v-if="navItems.hiddenNext.length">
            <div class="dots">...</div>
            <div class="pages">
                <a
                    v-for="pageNumber in navItems.hiddenNext"
                    href="#"
                    @click.prevent="updatePage(pageNumber)">
                    {{ pageNumber }}
                </a>
            </div>
        </div>
        <a href="#" @click.prevent="updatePage(currentPage + 1)">
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</template>
<script setup>
/**
 *  TODO: FIX and IMPLEMENT for CASEFLOWS.
 *  currently, caseflows pagination is hardcoded
 */
import { onMounted } from 'vue';
onMounted(() => {
    // nextTick(() => {
    setTimeout(() => {
        if (nextLinks.value) {
            let nextItemsLength = 0;
            //children[x] must = .pages
            for (let i = 0; i < nextLinks.value.length; i++) {
                console.log(nextLinks.value);
                nextItemsLength += nextLinks.value[i].clientWidth;
            }
            let styleStringNext = `
                    <style>
                        #pageNav .hidden-nav-pages.next:hover {
                            width: ${nextItemsLength}px;
                        }
                    </style>
                `;
            document.querySelector('#pageNav').innerHTML += styleStringNext;
        }
        if (prevLinks.value) {
            let prevItemsLength = 0;
            //children[x] must = .pages
            let prevLinks = hiddenNavPrev.value.children[1].children;
            for (let i = 0; i < prevLinks.length; i++) {
                prevItemsLength += prevLinks[i].clientWidth;
            }
            let styleStringPrev = `
                    <style>
                        #pageNav .hidden-nav-pages.prev:hover {
                            width: ${prevItemsLength}px;
                        }
                    </style>
                `;
            document.querySelector('#pageNav').innerHTML += styleStringPrev;
        }
    }, 2000);
    // });
});
</script>
<style lang="scss" scoped id="caseFlowsStyle">
@import '@sass/vue_sfc.scss';
#pageNav {
    display: flex;
    a {
        color: $gray-600;
        padding: 0 0.25rem;
    }
    .dots {
        padding: 0 0.5rem;
    }
}
.hidden-nav-pages {
    position: relative;
    display: inline-block;
    transition: $transition-base;
    transition-duration: 0.5s;
    width: 24px;

    .pages {
        width: 0;
        overflow: hidden;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        transition: $transition-base;
        transition-duration: 0.5s;
    }

    &:hover {
        .pages {
            width: 100%;
            position: relative;
        }
        .dots {
            display: none;
        }
    }
}
</style>
