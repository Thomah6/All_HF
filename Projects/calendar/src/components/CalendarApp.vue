<script setup>
import {ref} from 'vue'
import Form from '@/components/Form.vue'
import Calendar from '@/components/Calendar.vue'
const events = ref(JSON.parse(localStorage.getItem('events') || '[]'))

const currentDay=ref('')
const editt=ref({})

function edi(ev){
let id= ev.id
events.value[id].name=ev.name
localStorage.setItem('events', JSON.stringify(events.value))
}
function add(name){
    console.log(events.value)
    events.value.push(name)
    localStorage.setItem('events', JSON.stringify(events.value))
}
function del(id){
    events.value=events.value.filter((event)=>event.id!=id)
        localStorage.setItem('events', JSON.stringify(events.value))

}
</script>
<template>
        <div class="">
            <span class="mb-4 block text-gray-700"><router-link to="/myapp" class="  underline"> <span class="">MyApp</span></router-link> > MyCalendar</span>
  <Form @submitEdit="(ev)=>{edi(ev)}" :editEvent="editt" @eventData="(name)=>{add(name)}" :day="currentDay" />
            <Calendar @editEvent="(evente)=>{editt=evente}" @suppr="(id)=>{del(id)}" @currentDay="(day)=>currentDay=day" :events="events" />
            
        
</div>
</template>