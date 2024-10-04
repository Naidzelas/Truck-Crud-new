<template>
    <div class="flex-col">
        <div
            class="flex flex-col w-full bg-[#103135] h-fit pb-4 rounded-t-lg pr-1 pl-1"
        >
            <div class="text-white text-2xl text-center mt-2 mb-2">
                {{ pageVariables.transport.unit_number }}
            </div>
            <div class="bg-white h-0.5 w-full"></div>
            <!-- Items -->
            <TruckItem
                :mainTruck="pageVariables.transport.unit_number"
            ></TruckItem>
            <label for="note" class="text-white mt-3 ml-2">Notes</label>
            <input @focusout="submit(pageVariables.transport.id)" name="note" v-model="note" ref="noteInput" type="text" class="w-[92%] self-center rounded p-1 mt-3 h-fit">
        </div>
        <div class="flex mt-1 space-x-2">
            <Link
                :href="route('destroy', transport.id)"
                :data="transport"
                method="delete"
                as="button"
                type="button"
                class="bg-[#103135] flex-1 h-5 flex justify-center items-center rounded-bl-lg cursor-pointer hover:bg-red-900"
            >
                <Icon icon="fa6-solid:trash" class="text-white size-3"></Icon>
            </Link>
            <Link
                href="/sub_unit"
                :data="transport"
                method="get"
                as="button"
                type="button"
                class="bg-[#103135] flex-1 h-5 flex justify-center items-center rounded-br-lg cursor-pointer hover:bg-yellow-600"
            >
                <Icon icon="ri:edit-fill" class="text-white size-4"></Icon>
            </Link>
        </div>
    </div>
</template>

<script setup>
import TruckItem from "./TruckItem.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

let pageVariables = defineProps({ transport: Object, subunits: Object });

let note = ref(pageVariables.transport.notes);

function submit(id){
    router.post(route('update'), {
        _method: 'patch',
        note: note.value,
        id: id,
    })
}
</script>
