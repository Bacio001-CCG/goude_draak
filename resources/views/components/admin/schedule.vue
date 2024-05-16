<script setup>
import { computed } from "vue";

const props = defineProps({
    days: Array,
    employees: Array,
    se: Array,
    tables: Array,
});

const daysNames = [
    "Maandag",
    "Dinsdag",
    "Woensdag",
    "Donderdag",
    "Vrijdag",
    "Zaterdag",
    "Zondag",
];

const csrf = computed(() => {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
});

const employeeEmails = computed(() => {
    const emails = {};
    props.employees.forEach(emp => {
        emails[emp.id] = emp.email;
    });
    return emails;
});

</script>

<template>
    <form action="schedule" method="post">
        <input type="hidden" name="_token" :value="csrf" />
        <h1 class="text-center my-5 font-bold">Agenda voor deze week.</h1>
        <div class="flex flex-col gap-5">
            <div v-for="table in props.tables">
                <h1 class="text-center font-bold my-2">
                    Tafel {{ table.name }}
                </h1>
                <div
                    class="w-full grid grid-cols-7 h-[8rem] bg-white rounded shadow divide-x"
                >
                    <div
                        class="w-full h-full p-2"
                        v-for="(day, index) in props.days"
                    >
                        <div class="relative h-full">
                            <h1 class="text-center tracking-wider font-bold">
                                {{ daysNames[index] }}
                            </h1>
                            <h2 class="text-center tracking-wider">
                                {{ day }}
                            </h2>
                            <p v-for="schedule in props.se">
                                <h1 v-if="schedule.table_id == table.id && schedule.date == day" class="text-center truncate">
                                    {{employeeEmails[schedule.employee_id]}}
                                </h1>
                            </p>

                            <select
                                class="w-full absolute bottom-0"
                                :name="table.id + '/' + day"
                            >   
                                <option value="0">Kies een medewerker</option>
                                <option
                                    v-for="employee in props.employees"
                                    :value="employee.id"
                                >
                                    {{ employee.email }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button
            type="submit"
            class="bg-blue-500 px-5 py-1 rounded text-white mt-5"
        >
            Opslaan
        </button>
    </form>
</template>
