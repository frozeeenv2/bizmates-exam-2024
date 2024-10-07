<script setup>
import Card from "./card.vue";
import { ref, watch } from "vue";
import HorizontalSlider from "./horizontal-slider.vue";

const props = defineProps({
    id: Number,
});
const touristSpots = ref([]);
const isLoading = ref(true);

function fetchSpots() {
    isLoading.value = true;

    axios
        .get(`/api/spots/${props.id}`)
        .then((res) => {
            touristSpots.value = res.data.features;
        })
        .finally(() => {
            isLoading.value = false;
        });
}

watch(
    () => props.id,
    () => {
        fetchSpots();
    }
);

fetchSpots();
</script>

<template>
    <div>
        <div class="text-xs uppercase text-gray-400 mb-2">Tourist Spots</div>
        <HorizontalSlider v-show="isLoading">
            <Card
                v-for="(item, itemIndex) in [1, 2, 3, 4, 5, 6, 7]"
                :key="`spot-item-${itemIndex}`"
                class="animate-pulse"
            >
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <div class="font-semibold">&nbsp;</div>
                        <div class="text-gray-500">&nbsp;</div>
                    </div>

                    <a class="block mt-8" target="_blank">&nbsp;</a>
                </div>
            </Card>
        </HorizontalSlider>

        <HorizontalSlider v-show="!isLoading">
            <Card
                v-for="(item, itemIndex) in touristSpots"
                :key="`spot-item-${itemIndex}`"
            >
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <div class="font-semibold">
                            {{ item.properties.name }}
                        </div>
                        <div class="text-gray-500">
                            {{ item.properties.address_line2 }}
                        </div>
                    </div>

                    <a
                        :href="`https://www.google.com/maps?q=${item.properties.lat},${item.properties.lon}`"
                        class="block mt-8"
                        target="_blank"
                        >View in google maps</a
                    >
                </div>
            </Card>
        </HorizontalSlider>
    </div>
</template>
