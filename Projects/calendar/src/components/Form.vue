<script setup>
import {onMounted, ref, watch} from 'vue'
import CalendarSvg from '@/assets/img/undraw_calendar.svg'
const name= ref('')
const input= ref('')
const daySpan= ref('')
const addState=ref(true)
const emit = defineEmits(['eventData','submitEdit'])
const props = defineProps({
    day:String,
    editEvent: Object
})
let index=0
function submitForm(e){
    if(addState.value){
let emitName=name.value
    let emitDay=daySpan.value.textContent
    let emitData = {
        id: index++,
        name: emitName,
        day:emitDay
    }
emit('eventData', emitData);
      addState.value = true
name.value='';
}else{
    let newName=name.value;
        emit('submitEdit',{id:props.editEvent.id, name:newName});
      addState.value = true
name.value='';
    }
    
}


onMounted(() => {
  watch(
    () => props.editEvent,
    (newVal) => {
      addState.value = false
       name.value=newVal.name;
      console.log(name.value)
    }
  )
})

</script>
<template>
  <div class="flex gap-24 w-full px-4">
    <form class="flex w-full" @submit.prevent="submitForm">
      
      <div class="w-full grid relative border relative border-gray-300 rounded-lg p-4">
        <span class="font-bold pb-4 text-2xl text-gray-700">Add Event</span>
        <span class="text-gray-500 font-semibold absolute top-4 right-4" ref="daySpan">{{day || 'Monday'}}</span>
        <input v-model="name"  :focused="day"
          type="text" ref="input" 
          placeholder="Enter new event here..."
          class="px-8 py-4 border rounded-xl border-gray-300 w-full outline-0"
        />
        <button v-if="addState" class="cursor-pointer px-8 hover:bg-white hover:border hover:text-gray-700 hover:border-gray-700 transition-all duration-300 py-2 bg-red-500 text-white rounded-lg my-4">Save</button>
        <button v-if="!addState" class="cursor-pointer px-8 hover:bg-white hover:border hover:text-gray-700 hover:border-gray-700 transition-all duration-300 py-2 bg-gray-500 text-white rounded-lg my-4">Update</button>
      </div>
    </form>
  </div>
</template>
