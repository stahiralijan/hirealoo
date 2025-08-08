<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import { Checkbox } from '@/components/ui/checkbox';
import {
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form";
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { CircleMinus, CircleX, CrossIcon, PlusCircle } from 'lucide-vue-next';
import { watch } from 'vue';

const props = defineProps({
    scheduleConfig: Object
})

const days = [
    {
        id: "monday",
        label: "Monday",
    },
    {
        id: "tuesday",
        label: "Tuesday",
    },
    {
        id: "wednesday",
        label: "Wednesday",
    },
    {
        id: "thursday",
        label: "Thursday",
    },
    {
        id: "friday",
        label: "Friday",
    },
    {
        id: "saturday",
        label: "Saturday",
    },
    {
        id: "sunday",
        label: "Sunday",
    },
    {
        id: "specific-time-windows",
        label: "Specify time window(s)"
    },
    {
        id: "exact-time",
        label: "Set exact time"
    }
] as const

const form = useForm({
    frequency: 'fortnightly',
    monday: false,
    tuesday: false,
    wednesday: false,
    thursday: false,
    friday: false,
    saturday: false,
    sunday: false,
    specific_time: false,
    has_exact_time: false,
    specific_time_windows: [{
        index: 0,
        start_time: '',
        end_time: '',
    }],
    exact_time:'',
});

const onAddTimeWindow = () => {
    form.specific_time_windows.push({
        index: form.specific_time_windows.length,
        start_time: '',
        end_time: '',
    });
}

const onRemoveTimeWindow = (index: number) => {
    form.specific_time_windows.splice(index, 1);

    for(let i = 0; i < form.specific_time_windows.length; i++) {
        form.specific_time_windows[i].index = i;
    }
}

const onSubmitSchedule = () => form.post(route('schedules.store'));

watch(form, (newValue) => {
    console.log(newValue.specific_time_windows.value)
    if (newValue.specific_time.value === false) {
        newValue.specific_time_windows.value = [{
            index: 0,
            start_time: '',
            end_time: '',
        }];
    }
});
</script>
<template>

    <form class="w-2/3 space-y-6" @submit.prevent="onSubmitSchedule">
        <FormField v-slot="{ componentField }" type="radio" name="frequency">
            <FormItem class="space-y-3">
                <FormLabel>Notify me about...</FormLabel>

                {{ form }}

                <FormControl>
                    <RadioGroup v-model="form.frequency" class="flex flex-col space-y-1" v-bind="componentField">
                        <FormItem class="flex items-center space-y-0 gap-x-3">
                            <FormControl>
                                <RadioGroupItem id="weekly" value="weekly" />
                            </FormControl>
                            <FormLabel class="font-normal">
                                Weekly
                            </FormLabel>
                        </FormItem>
                        <FormItem class="flex items-center space-y-0 gap-x-3">
                            <FormControl>
                                <RadioGroupItem id="fortnightly" value="fortnightly" />
                            </FormControl>
                            <FormLabel class="font-normal">
                                Fortnightly
                            </FormLabel>
                        </FormItem>
                        <FormItem class="flex items-center space-y-0 gap-x-3">
                            <FormControl>
                                <RadioGroupItem id="none" value="none" />
                            </FormControl>
                            <FormLabel class="font-normal">
                                None
                            </FormLabel>
                        </FormItem>
                        <FormItem class="flex items-center space-y-0 gap-x-3">
                            <FormControl>
                                <RadioGroupItem id='custom' value="custom" />
                            </FormControl>
                            <FormLabel class="font-normal">
                                Custom
                            </FormLabel>
                        </FormItem>
                    </RadioGroup>
                </FormControl>
                <FormMessage />
            </FormItem>

        </FormField>

        <div v-if="form.frequency === 'custom'">
            <FormField type="checkbox" :value="form.monday" :unchecked-value="false" name="monday">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0">
                    <FormControl>
                        <Checkbox v-model="form.monday" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        Monday
                    </FormLabel>
                </FormItem>
            </FormField>

            <FormField type="checkbox" :value="form.tuesday" :unchecked-value="false" name="tuesday">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <FormControl>
                        <Checkbox v-model="form.tuesday" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        Tuesday
                    </FormLabel>
                </FormItem>
            </FormField>
            <FormField type="checkbox" :value="form.wednesday" :unchecked-value="false" name="wednesday">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <FormControl>
                        <Checkbox v-model="form.wednesday" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        Wednesday
                    </FormLabel>
                </FormItem>
            </FormField>
            <FormField type="checkbox" :value="form.thursday" :unchecked-value="false" name="thursday">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <FormControl>
                        <Checkbox v-model="form.thursday" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        Thursday
                    </FormLabel>
                </FormItem>
            </FormField>

            <FormField type="checkbox" :value="form.friday" :unchecked-value="false" name="friday">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <FormControl>
                        <Checkbox v-model="form.friday" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        Friday
                    </FormLabel>
                </FormItem>
            </FormField>

            <FormField type="checkbox" :value="form.saturday" :unchecked-value="false" name="saturday">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <FormControl>
                        <Checkbox v-model="form.saturday" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        Saturday
                    </FormLabel>
                </FormItem>
            </FormField>

            <FormField type="checkbox" :value="form.sunday" :unchecked-value="false" name="sunday" class="mt-3">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <FormControl>
                        <Checkbox v-model="form.sunday" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        Sunday
                    </FormLabel>
                </FormItem>
            </FormField>

            <FormField type="checkbox" :value="form.specific_time" :unchecked-value="false" name="specific_time"
                class="mt-3">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <FormControl>
                        <Checkbox v-model="form.specific_time" id="specific_time" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        Specific time window(s)
                    </FormLabel>
                </FormItem>
            </FormField>

            <div v-if="form.specific_time">
                <FormItem v-for="stime in form.specific_time_windows"
                    class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <Input type="time" v-model="form.specific_time_windows[stime.index].start_time" />
                    <span> to </span>
                    <Input type="time" v-model="form.specific_time_windows[stime.index].end_time" />
                    <Button type="button" @click="onAddTimeWindow" v-if="stime.index === 0">
                        <PlusCircle />
                    </Button>
                    <Button type="button" variant="outline" @click="onRemoveTimeWindow" v-if="stime.index > 0">
                        <CircleX class="text-red-600" />
                    </Button>
                </FormItem>
            </div>

            <FormField type="checkbox" :value="form.has_exact_time" :unchecked-value="false" name="has_exact_time"
                class="mt-3">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <FormControl>
                        <Checkbox v-model="form.has_exact_time" id="has_exact_time" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        Exact time
                    </FormLabel>
                </FormItem>
            </FormField>

            <div v-if="form.has_exact_time">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0 mt-2">
                    <Input type="time" v-model="form.exact_time" class="w-50" />
                </FormItem>
            </div>
        </div>

        <FormItem>
            <Button @click="onSubmitSchedule">
                Create a Schedule
            </Button>
        </FormItem>
    </form>
</template>
