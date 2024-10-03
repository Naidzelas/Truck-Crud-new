<template>
    <div class="flex justify-center p-36">
        <div class="flex flex-col w-full">
            <div class="mt-16 mb-32 text-center text-6xl">Active transport</div>
            <Link
                href="/create"
                method="get"
                as="button"
                type="button"
                class="bg-[#956E6E] w-32 h-8 self-end mb-2 text-white text-xl"
                :only="['transports']"
                >Seed data</Link
            >
            <div class="bg-[#600000] w-full h-1/2 mb-8"></div>
            <div class="grid grid-cols-6 gap-10 self-center">
                <TransportPlan
                    v-for="transport in pageVariables.transports"
                    :transport="transport"
                ></TransportPlan>
            </div>
        </div>
    </div>
</template>

<script setup>
import TransportPlan from "../Components/TransportPlan.vue";
import { Link } from "@inertiajs/vue3";
import { provide } from "vue";

let pageVariables = defineProps({ transports: Object, subunitData: Object });

provide('subunits', pageVariables.subunitData);
</script>
