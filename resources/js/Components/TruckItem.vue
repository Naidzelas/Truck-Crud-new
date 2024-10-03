<template>
    <div v-for="(subunit, key) in subunits">
        <div v-for="plan in subunit">
            <!-- plan done -->
            <div
                v-if="
                    key == mainTruck &&
                    Date.parse(today) > Date.parse(plan.end_date)
                "
                class="flex space-x-4 bg-white pr-4 mt-4 mr-2 ml-2"
            >
                <Icon icon="mdi:truck" class="size-8 flex-1"></Icon>
                <div class="text-lg text-[#103135] flex-1">
                    {{ plan.subunit }}
                </div>
                <Icon icon="fa6-solid:road-circle-check" class="size-8"></Icon>
            </div>
            <!-- current plan -->
            <div
                v-if="
                    key == mainTruck &&
                    Date.parse(today) > Date.parse(plan.start_date) &&
                    Date.parse(today) < Date.parse(plan.end_date)
                "
                class="flex space-x-4 bg-white pr-4 mt-4 mr-2 ml-2 rounded-md"
            >
                <Icon icon="mdi:truck" class="size-8 flex-1"></Icon>
                <div class="text-lg text-[#103135] flex-1">
                    {{ plan.subunit }}
                </div>
                <Icon icon="fa6-solid:road" class="size-8"></Icon>
            </div>
            <!-- if plan not started -->
            <div
                v-if="
                    key == mainTruck &&
                    Date.parse(today) < Date.parse(plan.start_date)
                "
                class="flex space-x-4 bg-white pr-4 mt-4 mr-2 ml-2"
            >
                <Icon icon="mdi:truck" class="size-8 flex-1"></Icon>
                <div class="text-lg text-[#103135] flex-1">
                    {{ plan.subunit }}
                </div>
                <Icon icon="fa6-solid:road-circle-xmark" class="size-8"></Icon>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject } from "vue";
defineProps({
    mainTruck: String,
});

let subunits = inject("subunits");
let today = new Date();
</script>