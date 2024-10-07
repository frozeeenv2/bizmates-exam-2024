<script setup>
import Card from "./card.vue";
import HorizontalSlider from "./horizontal-slider.vue";
import { onMounted, ref, watch } from "vue";
import moment from "moment-timezone";

const props = defineProps({
    id: Number,
});
const weatherList = ref([]);
const isLoading = ref(false);

function kelvinToCelcuis(temp) {
    return Math.round(temp - 273.15);
}

function fetchWeather() {
    isLoading.value = true;

    axios
        .get(`/api/weather/${props.id}`)
        .then((res) => {
            weatherList.value = res.data.list;
        })
        .finally(() => {
            isLoading.value = false;
        });
}

watch(
    () => props.id,
    () => {
        fetchWeather();
    }
);

fetchWeather();
</script>

<template>
    <div>
        <div class="text-xs uppercase text-gray-400 mb-2">Weather Forecast</div>
        <HorizontalSlider v-show="isLoading">
            <Card
                v-for="(item, itemIndex) in weatherList"
                :key="`weather-item-${itemIndex}`"
                class="animate-pulse"
            >
                <div class="font-semibold">&nbsp;</div>
                <div class="mt-6"></div>
                <div class="text-gray-500">&nbsp;</div>
                <div class="font-semibold text-4xl">&nbsp;</div>
                <div>&nbsp;</div>
            </Card>
        </HorizontalSlider>

        <HorizontalSlider v-show="!isLoading">
            <Card
                v-for="(item, itemIndex) in weatherList"
                :key="`weather-item-${itemIndex}`"
            >
                <div class="space-x-2">
                    <span class="font-semibold">{{
                        moment(item.dt_txt).tz("Asia/Tokyo").fromNow()
                    }}</span>
                    <span class="text-[9px] text-gray-500">{{
                        moment(item.dt_txt).tz("Asia/Tokyo").format("LLL")
                    }}</span>
                </div>
                <div class="mt-6"></div>
                <div class="text-gray-500">
                    {{ item.weather[0].description }}
                </div>
                <div class="font-semibold text-4xl">
                    {{ kelvinToCelcuis(item.main.temp) }} °
                </div>
                <div>
                    Feels like {{ kelvinToCelcuis(item.main.feels_like) }} °
                </div>
            </Card>
        </HorizontalSlider>
    </div>
</template>
