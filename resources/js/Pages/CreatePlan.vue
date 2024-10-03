<template>
    <div class="flex justify-center p-36">
        <div class="flex flex-col w-full">
            <div class="mt-16 mb-32 text-center text-6xl">Create plan</div>
            <form @submit.prevent="form.post('sub_unit')">
                <div class="flex space-x-4 justify-end">
                    <Link
                        href="/"
                        method="get"
                        as="button"
                        type="button"
                        class="bg-[#956E6E] w-32 h-8 self-end mb-2 text-white font-semibold text-xl"
                        >Back</Link
                    >
                    <button
                        type="submit"
                        class="bg-[#956E6E] w-32 h-8 self-end mb-2 text-white font-semibold text-xl"
                    >
                        Save
                    </button>
                </div>
                <div class="bg-[#600000] w-full h-1 mb-8"></div>
                <div class="grid grid-cols-2">
                    <div class="flex flex-col">
                        <div class="flex space-x-5">
                            <div class="flex flex-col">
                                <label
                                    for="transport"
                                    class="font-semibold text-xl"
                                    >Transport</label
                                >
                                <input
                                    name="transport"
                                    class="mt-2 h-9 w-32 p-1 pl-4 rounded-md border border-gray-300 bg-gray-100"
                                    :value="pageVariables.transport"
                                    disabled
                                />
                            </div>
                            <div class="flex flex-col">
                                <label for="date" class="font-semibold text-xl"
                                    >Date</label
                                >
                                <DatePicker
                                    :format="format"
                                    v-model="form.date"
                                    :enable-time-picker="false"
                                    :format-locale="lt"
                                    dateFormat="yy/mm/dd"
                                    range
                                    name="date"
                                    class="mt-2"
                                ></DatePicker>
                            </div>
                        </div>
                    </div>
                    <!-- fun part -->
                    <div>
                        <label for="subunits" class="font-semibold text-xl"
                            >Available subunits</label
                        >
                        <div
                            name="subunits"
                            class="grid grid-cols-6 gap-4 mt-2"
                        >
                            <div
                                v-for="availableTransport in pageVariables.availableTransports"
                            >
                                <!-- available transport -->
                                <div
                                    v-if="
                                        availableTransport.unit_number !=
                                        transport
                                        
                                    "
                                >
                                    <input
                                        type="radio"
                                        @input="form.subunit = availableTransport.unit_number"
                                        name="subunit"
                                        class="peer"
                                    />
                                    <label
                                        for="subunit"
                                        class="flex bg-[#F2F2F2] space-x-4 p-4 2 text-gray-800 border border-gray-800 rounded-lg cursor-pointer peer-checked:border-[#4F0062] peer-checked:text-[#4F0062] hover:text-black hover:bg-gray-200"
                                    >
                                        <Icon
                                            icon="mdi:truck"
                                            class="size-6"
                                        ></Icon>
                                        <div>
                                            {{ availableTransport.unit_number }}
                                        </div>
                                    </label>
                                </div>
                                <!-- if same transprot disabled -->
                                <div v-else>
                                    <input
                                        type="radio"
                                        name="subunit"
                                        class="peer"
                                        disabled
                                    />
                                    <label
                                        for="subunit"
                                        class="flex bg-[#F2F2F2] space-x-4 p-4 2 text-gray-400 border border-gray-800 rounded-lg"
                                    >
                                        <Icon
                                            icon="mdi:truck"
                                            class="size-6"
                                        ></Icon>
                                        <div>
                                            {{ availableTransport.unit_number }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end fun part -->
                </div>
            </form>
            <div class="felx mt-20">
                <div class="flex flex-col">
                    <label for="transport" class="font-semibold text-xl"
                        >Created plans</label
                    >
                    <div v-for="(transportUnit, key) in transportsUnits">
                        <div
                            v-for="plan in transportUnit"
                            class="flex space-x-10"
                        >
                            <div>{{ plan.main_truck }}</div>
                            <div>{{ key }}</div>
                            <div>
                                {{ plan.start_date + " - " + plan.end_date }}
                            </div>
                            <Link
                                :href="
                                    route(
                                        'sub_unit.destroy',
                                        plan.id
                                    )
                                "
                                :data="plan"
                                method="delete"
                                as="button"
                                type="button"
                                class="felx-1"
                            >
                                <Icon
                                    icon="fa6-solid:trash"
                                    class="text-red-800"
                                ></Icon>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, useForm, router } from "@inertiajs/vue3";
import { ref, onMounted, watch } from "vue";
import DatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { lt } from "date-fns/locale";

let pageVariables = defineProps({
    transport: String,
    transportsUnits: Object,
    availableTransports: Object,
});

const date = ref();
const form = useForm({
    date: [],
    transport: pageVariables.transport,
    subunit: null,
});


onMounted(() => {
    const startDate = new Date();
    const endDate = new Date(new Date().setDate(startDate.getDate() + 7));
    date.value = [startDate, endDate];
});

watch(date, (newDate) => {
    form.date = newDate;
});

const format = (date) => {
    if (date && date.length >= 2) {
        return `${date[0].toLocaleDateString("lt-LT")} - ${date[1].toLocaleDateString("lt-LT")}`;
    } else {
        return "Invalid date range";
    }
};

// let dates = form.date;
// console.log(dates);
// function checkSomething(test){
//     // console.log(pageVariables.transportsUnits[test]);
//     let object = pageVariables.transportsUnits;
//     // console.log(Object.entries(object)[1][1][0]['start_date']);
//     console.log(toRaw(result));
//     return true;
// }

</script>
