<template>
    <div class="flex justify-center p-36">
        <div class="flex flex-col w-full">
            <div
                class="mt-16 mb-32 text-center text-6xl tracking-wide font-semibold font-mono"
            >
                CREATE PLAN
            </div>
            <form @submit.prevent="form.post('sub_unit')">
                <div class="flex space-x-4 justify-end">
                    <Link
                        href="/"
                        method="get"
                        as="button"
                        type="button"
                        class="bg-[#956E6E] w-32 pt-1 pb-1 h-fit self-end mb-2 text-white font-semibold text-xl tracking-wide align-middle hover:bg-[#684c4c]"
                        >BACK</Link
                    >
                    <button
                        type="submit"
                        class="bg-[#956E6E] w-32 pt-1 pb-1 h-fit self-end mb-2 text-white font-semibold text-xl align-middle hover:bg-[#684c4c]"
                    >
                        SAVE
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
                                    v-model="date"
                                    :enable-time-picker="false"
                                    :format-locale="lt"
                                    dateFormat="yy/mm/dd"
                                    range
                                    name="date"
                                    class="mt-2"
                                ></DatePicker>
                            </div>
                        </div>
                        <div v-if="er.transport" class="text-red-500 animate-pulse mt-1 font-bold">{{ er.transport }}</div>
                        <div v-if="er.subunit" class="text-red-500 animate-pulse mt-1 font-bold">{{ er.subunit }}</div>
                        <div v-if="er.date" class="text-red-500 animate-pulse mt-1 font-bold">{{ er.date }}</div>
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
                                :key="availableTransport.unit_number"
                            >
                                <!-- available transport -->
                                <div
                                    v-if="
                                        availableTransport.unit_number !=
                                            transport &&
                                        isAvailable(
                                            availableTransport.unit_number
                                        )
                                    "
                                >
                                    <input
                                        type="radio"
                                        @input="
                                            form.subunit =
                                                availableTransport.unit_number
                                        "
                                        name="subunit"
                                        :id="
                                            'subunit-' +
                                            availableTransport.unit_number
                                        "
                                        class="peer sr-only"
                                    />
                                    <label
                                        :for="
                                            'subunit-' +
                                            availableTransport.unit_number
                                        "
                                        class="flex bg-[#F2F2F2] space-x-4 p-4 2 text-gray-800 border border-gray-800 rounded-lg cursor-pointer peer-checked:border-[#4F0062] peer-checked:bg-[#f6e6fa] peer-checked:text-[#4F0062] hover:text-black hover:bg-gray-200"
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
                                        class="peer hidden"
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
                                :href="route('sub_unit.destroy', plan.id)"
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
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, onMounted, watch, computed } from "vue";
import DatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { lt } from "date-fns/locale";

let pageVariables = defineProps({
    transport: String,
    transportsUnits: Object,
    availableTransports: Object,
});

const date = ref([]);
const form = useForm({
    date: [],
    transport: pageVariables.transport,
    subunit: null,
});

const page = usePage();
const er = computed(() =>page.props.errors);

onMounted(() => {
    const startDate = new Date();
    const endDate = new Date(new Date().setDate(startDate.getDate() + 7));
    date.value = [startDate, endDate];
    form.date = date.value;
    firstDate = computed(() => form.date[0]);
    secondDate = computed(() => form.date[1]);
});

watch(date, (newDate) => {
    form.date = newDate;
    firstDate = form.date[0];
    secondDate = form.date[1];
});

const format = (date) => {
    if (date && date.length >= 2) {
        return `${date[0].toLocaleDateString(
            "lt-LT"
        )} - ${date[1].toLocaleDateString("lt-LT")}`;
    } else {
        return "Invalid date range";
    }
};

let firstDate = computed(() => form.date[0]);
let secondDate = computed(() => form.date[1]);

const isAvailable = (truck) => {
    if (pageVariables.transportsUnits[truck]) {
        let start = new Date(
            Object.entries(pageVariables.transportsUnits[truck])[0][1][
                "start_date"
            ]
        );
        let end = new Date(
            Object.entries(pageVariables.transportsUnits[truck])[0][1][
                "end_date"
            ]
        );
        if (firstDate && secondDate) {
            if (Math.min(end, secondDate) - Math.max(start, firstDate) <= 0) {
                return true;
            } else {
                return false;
            }
        } else {
            console.error("First date or second date is not defined.");
            return false;
        }
    }
    return true;
};
</script>
