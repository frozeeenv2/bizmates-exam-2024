<script setup>
import { ref, useTemplateRef } from "vue";

const showLeftShadow = ref(false);
const showRightShadow = ref(true);
const scrollContainerRef = useTemplateRef("containerScroll");

function renderShadow() {
    showLeftShadow.value = scrollContainerRef.value.scrollLeft > 10;
    showRightShadow.value =
        scrollContainerRef.value.scrollLeft <=
        scrollContainerRef.value.scrollLeftMax - 10;
}

function handleClickToScroll(amount = 500) {
    scrollContainerRef.value.scrollBy({
        left: amount,
        behavior: "smooth",
    });
}
</script>
<template>
    <div class="relative">
        <div
            v-show="showLeftShadow"
            class="absolute left-0 top-0 h-full w-[25px] md:w-[125px]"
            style="
                background: linear-gradient(to left, rgba(0, 0, 0, 0), #0b131e);
            "
        ></div>
        <div
            v-show="showLeftShadow"
            class="absolute top-2/4 -translate-y-2/4 left-4 bg-white/10 rounded-full flex items-center justify-center cursor-pointer hover:bg-white/25 active:bg-white/30 transition-all opacity-0 md:opacity-100 active:scale-95"
            @click="handleClickToScroll(-500)"
        >
            <svg
                class="rotate-180"
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="32"
                viewBox="0 0 24 24"
            >
                <path
                    fill="#feffff"
                    d="m6.59 6.84l5.66 5.66l-5.66 5.66l-.7-.71l4.95-4.95l-4.95-4.95zm4 0l5.66 5.66l-5.66 5.66l-.7-.71l4.95-4.95l-4.95-4.95z"
                />
            </svg>
        </div>

        <div
            ref="containerScroll"
            @scroll="renderShadow"
            class="flex space-x-4 overflow-x-auto no-scrollbar rounded-xl"
        >
            <slot />
        </div>

        <div
            v-show="showRightShadow"
            class="absolute top-2/4 -translate-y-2/4 right-5 z-10 bg-white/10 rounded-full flex items-center justify-center cursor-pointer hover:bg-white/25 active:bg-white/30 transition-all opacity-0 md:opacity-100 active:scale-95"
            @click="handleClickToScroll(500)"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="32"
                viewBox="0 0 24 24"
            >
                <path
                    fill="#feffff"
                    d="m6.59 6.84l5.66 5.66l-5.66 5.66l-.7-.71l4.95-4.95l-4.95-4.95zm4 0l5.66 5.66l-5.66 5.66l-.7-.71l4.95-4.95l-4.95-4.95z"
                />
            </svg>
        </div>

        <div
            v-show="showRightShadow"
            class="absolute right-0 top-0 h-full w-[25px] md:w-[125px]"
            style="
                background: linear-gradient(
                    to right,
                    rgba(0, 0, 0, 0),
                    #0b131e
                );
            "
        ></div>
    </div>
</template>
