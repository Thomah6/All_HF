<script setup>
import { computed, ref } from 'vue'
const props = defineProps({
    events: Array,
})
const emit = defineEmits(['currentDay','suppr','editEvent'])
const currentDay = ref('')
function add(text) {
    currentDay.value = text
    emit('currentDay', currentDay.value)
}
const eventsMon = computed(
    () => {
        return props.events.filter((event) => event.day === 'Monday')
    }
)
const eventsTue = computed(
    () => {
        return props.events.filter((event) => event.day === 'Tuesday')
    }
)
const eventsWed = computed(
    () => {
        return props.events.filter((event) => event.day === 'Wednesday')
    }
)
const eventsThurs = computed(
    () => {
        return props.events.filter((event) => event.day === 'Thursday')
    }
)
const eventsFri = computed(
    () => {
        return props.events.filter((event) => event.day === 'Friday')
    }
)
const eventsSat = computed(
    () => {
        return props.events.filter((event) => event.day === 'Saturday')
    }
)
const eventsSun = computed(
    () => {
        return props.events.filter((event) => event.day === 'Sunday')
    }
)
</script>
<template>
    <!-- {{ currentDay }} -->
    <div class="w-full mx-auto overflow-hidden overflow-x-scroll rounded-t-2xl my-14">
        <table class="rounded-xl border-collapse border border-gray-300 w-full text-center">
            <thead class="bg-gray-200">
                <tr class="">
                    <td colspan="7" class="py-2">
                        <h1 class="text-3xl font-bold">Calendar</h1>
                    </td>
                    
                </tr>
            </thead>
            <tbody>
                <tr class="font-semibold">
                    <td class="border border-gray-300 py-2">Monday</td>
                    <td class="border border-gray-300">Tuesday</td>
                    <td class="border border-gray-300">Wednesday</td>
                    <td class="border border-gray-300">Thursday</td>
                    <td class="border border-gray-300">Friday</td>
                    <td class="border border-gray-300">Saturday</td>
                    <td class="border border-gray-300">Sunday</td>
                </tr>
                <tr>
                    <td class="border border-gray-300">
                        <div class="eventsContainer grid">
                            <div v-for="event in eventsMon" :key="event.id"
                                class="pb-8 relative ring-2 ring-green-300 border-white border rounded-lg p-4 m-4 bg-green-600 text-white">
                                <span>{{event.name}}</span>
                                <i @click="emit('editEvent', event)" class="bx bx-edit cursor-pointer absolute bottom-2 left-2"></i>
                                <i @click="emit('suppr', event.id)" class="bx bx-trash cursor-pointer absolute bottom-2 right-2"></i>
                            </div>


                        </div>
                        <button @click="() => { add('Monday') }"
                            class="border-2 mx-auto w-[100px] py-2 cursor-pointer rounded-lg border-dashed text-red-400 my-4 border-red-400">
                            <i class="bx bx-plus"></i>
                        </button>
                    </td>

                    <td class="border border-gray-300">
                        <div class="eventsContainer grid">
                            <div v-for="event in eventsTue" :key="event.id"
                                class="pb-8 relative ring-2 ring-red-300 border-white border rounded-lg p-4 m-4 bg-red-600 text-white">
                                <span>{{event.name}}</span>
                                <i @click="emit('editEvent', event)" class="bx bx-edit cursor-pointer absolute bottom-2 left-2"></i>
                                <i @click="emit('suppr', event.id)" class="bx bx-trash cursor-pointer absolute bottom-2 right-2"></i>
                            </div>


                        </div>
                        <button @click="() => { add('Tuesday') }"
                            class="border-2 mx-auto w-[100px] py-2 cursor-pointer rounded-lg border-dashed text-red-400 my-4 border-red-400">
                            <i class="bx bx-plus"></i>
                        </button>
                    </td>

                    <td class="border border-gray-300">
                        <div class="eventsContainer grid">
                            <div v-for="event in eventsWed" :key="event.id"
                                class="pb-8 relative ring-2 ring-gray-300 border-white border rounded-lg p-4 m-4 bg-gray-600 text-white">
                                <span>{{event.name}}</span>
                                <i @click="emit('editEvent', event)" class="bx bx-edit cursor-pointer absolute bottom-2 left-2"></i>
                                <i @click="emit('suppr', event.id)" class="bx bx-trash cursor-pointer absolute bottom-2 right-2"></i>
                            </div>


                        </div>
                        <button @click="() => { add('Wednesday') }"
                            class="border-2 mx-auto w-[100px] py-2 cursor-pointer rounded-lg border-dashed text-red-400 my-4 border-red-400">
                            <i class="bx bx-plus"></i>
                        </button>
                    </td>

                    <td class="border border-gray-300">
                        <div class="eventsContainer grid">
                            <div v-for="event in eventsThurs" :key="event.id"
                                class="pb-8 relative ring-2 ring-blue-300 border-white border rounded-lg p-4 m-4 bg-blue-600 text-white">
                                <span>{{event.name}}</span>
                                <i @click="emit('editEvent', event)" class="bx bx-edit cursor-pointer absolute bottom-2 left-2"></i>
                                <i @click="emit('suppr', event.id)" class="bx bx-trash cursor-pointer absolute bottom-2 right-2"></i>
                            </div>


                        </div>
                        <button @click="() => { add('Thursday') }"
                            class="border-2 mx-auto w-[100px] py-2 cursor-pointer rounded-lg border-dashed text-red-400 my-4 border-red-400">
                            <i class="bx bx-plus"></i>
                        </button>
                    </td>

                    <td class="border border-gray-300">
                        <div class="eventsContainer grid">
                            <div v-for="event in eventsFri" :key="event.id"
                                class="pb-8 relative ring-2 ring-purple-300 border-white border rounded-lg p-4 m-4 bg-purple-600 text-white">
                                <span>{{event.name}}</span>
                                <i @click="emit('editEvent', event)" class="bx bx-edit cursor-pointer absolute bottom-2 left-2"></i>
                                <i @click="emit('suppr', event.id)" class="bx bx-trash cursor-pointer absolute bottom-2 right-2"></i>
                            </div>


                        </div>
                        <button @click="() => { add('Friday') }"
                            class="border-2 mx-auto w-[100px] py-2 cursor-pointer rounded-lg border-dashed text-red-400 my-4 border-red-400">
                            <i class="bx bx-plus"></i>
                        </button>
                    </td>

                    <td class="border border-gray-300">
                        <div class="eventsContainer grid">
                            <div v-for="event in eventsSat" :key="event.id"
                                class="pb-8 relative ring-2 ring-green-300 border-white border rounded-lg p-4 m-4 bg-green-600 text-white">
                                <span>{{event.name}}</span>
                                <i @click="emit('editEvent', event)" class="bx bx-edit cursor-pointer absolute bottom-2 left-2"></i>
                                <i @click="emit('suppr', event.id)" class="bx bx-trash cursor-pointer absolute bottom-2 right-2"></i>
                            </div>


                        </div>
                        <button @click="() => { add('Saturday') }"
                            class="border-2 mx-auto w-[100px] py-2 cursor-pointer rounded-lg border-dashed text-red-400 my-4 border-red-400">
                            <i class="bx bx-plus"></i>
                        </button>
                    </td>

                    <td class="border border-gray-300">
                        <div class="eventsContainer grid">
                            <div v-for="event in eventsSun" :key="event.id"
                                class="pb-8 relative ring-2 ring-gray-300 border-white border rounded-lg p-4 m-4 bg-gray-600 text-white">
                                <span>{{event.name}}</span>
                                <i @click="emit('editEvent', event)" class="bx bx-edit cursor-pointer absolute bottom-2 left-2"></i>
                                <i @click="emit('suppr', event.id)" class="bx bx-trash cursor-pointer absolute bottom-2 right-2"></i>
                            </div>


                        </div>
                        <button @click="() => { add('Sunday') }"
                            class="border-2 mx-auto w-[100px] py-2 cursor-pointer rounded-lg border-dashed text-red-400 my-4 border-red-400">
                            <i class="bx bx-plus"></i>
                        </button>
                    </td>
                   
                </tr>
            </tbody>
        </table>
    </div>
</template>
