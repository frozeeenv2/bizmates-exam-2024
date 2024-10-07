<script setup>
import { inject, ref, onMounted } from "vue";
import WeatherListing from "./components/weather-listing.vue";
import SpotsListing from "./components/spots-listing.vue";
import moment from "moment-timezone";

const activeCityId = ref(1);

const country = inject("countryData");

onMounted(() => {
    activeCityId.value = country.cities[0].id;
});
</script>

<template>
    <main class="flex flex-col justify-between h-screen py-12 p-4">
        <div class="w-full max-w-[1400px] mx-auto md:flex justify-between">
            <div class="text-center md:text-left">
                <div
                    class="flex justify-center md:justify-start items-center space-x-2"
                >
                    <div>
                        <img
                            src="https://flagcdn.com/h240/jp.png"
                            class="w-[40px] rounded"
                        />
                    </div>
                    <h3 class="text-4xl font-semibold">Japan</h3>
                </div>
                <div class="mt-2 text-gray-400">
                    {{
                        moment()
                            .tz("Asia/Tokyo")
                            .format("dddd, MMMM D, YYYY, hh:mm A")
                    }}
                </div>
            </div>
            <div class="text-right flex md:block">
                <div
                    class="hidden md:block text-xs uppercase text-gray-400 mb-2"
                >
                    Featured Cities
                </div>
                <div
                    v-for="city in country.cities"
                    :key="`city-${city.id}`"
                    class="p-1 text-gray-500 hover:text-white cursor-pointer"
                    :class="{
                        'text-red-500 hover:text-red-500':
                            activeCityId == city.id,
                    }"
                    @click="
                        () => {
                            activeCityId = city.id;
                        }
                    "
                >
                    {{ city.name }}
                </div>
            </div>
        </div>

        <div class="space-y-10 md:space-y-16 w-full max-w-[1400px] mx-auto">
            <SpotsListing :id="activeCityId" />
            <WeatherListing :id="activeCityId" />
        </div>

        <Teleport to="body">
            <div>
                <img
                    class="absolute top-0 left-0 w-full h-full object-cover opacity-[3%] -z-[1]"
                    src="https://www.celebritycruises.com/blog/content/uploads/2021/03/what-is-japan-known-for-mt-fuji-hero.jpg"
                />
            </div>
        </Teleport>
    </main>
</template>
