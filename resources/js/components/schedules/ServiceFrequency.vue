<script lang="ts">
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

const form = useForm(route('schedules.store'), {
    frequency: 'forntightly',
    specif_time_windows: [],
    exact_time: [],
});

const onSubmitSchedule = () => form.submit();
</script>
<template>

    <form class="w-2/3 space-y-6" @submit.prevent="onSubmitSchedule">
        <FormField v-slot="{ componentField }" type="radio" name="type">
            <FormItem class="space-y-3">
                <FormLabel>Notify me about...</FormLabel>

                {{ form }}

                <FormControl>
                    <RadioGroup v-model="form.frequency" class="flex flex-col space-y-1" v-bind="componentField">
                        <FormItem class="flex items-center space-y-0 gap-x-3">
                            <FormField type="radio" name="weekly">
                                <FormControl>
                                    <RadioGroupItem id="weekly" value="weekly" />
                                </FormControl>
                                <FormLabel class="font-normal">
                                    Weekly
                                </FormLabel>
                            </FormField>
                        </FormItem>
                        <FormItem class="flex items-center space-y-0 gap-x-3">
                            <FormControl>
                                <RadioGroupItem id="forntightly" value="forntightly" />
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
            <FormField v-for="day in days" v-slot="{ value, handleChange }" :key="day.id" type="checkbox"
                :value="day.id" :unchecked-value="false" name="days">
                <FormItem class="flex flex-row items-start space-x-3 space-y-0">
                    <FormControl>
                        <Checkbox @update:model-value="handleChange" />
                    </FormControl>
                    <FormLabel class="font-normal">
                        {{ day.label }}
                    </FormLabel>
                </FormItem>
            </FormField>
        </div>

        <FormItem>
            <Button @click="onSubmitSchedule">
                Create a Schedule
            </Button>
        </FormItem>
    </form>
</template>
