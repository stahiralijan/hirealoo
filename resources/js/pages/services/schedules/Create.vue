<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { toTypedSchema } from "@vee-validate/zod"
import { useForm } from "vee-validate"
import { h } from "vue"
import * as z from "zod"

import { Button } from "@/components/ui/button"
import {
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form"
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group"

const formSchema = toTypedSchema(z.object({
    type: z.enum(["weekly", "fornightly", "none", "custom"], {
        required_error: "You need to select a notification type.",
    }),
}))

const { handleSubmit } = useForm({
    validationSchema: formSchema,
})

const onSubmitSchedule = () => {};
</script>
<template>
    <AppLayout>
        <Card>
            <CardHeader>
                <CardTitle>Schedules</CardTitle>
            </CardHeader>
            <CardContent>

                <form class="w-2/3 space-y-6" @submit.prevent="onSubmitSchedule">
                    <FormField v-slot="{ componentField }" type="radio" name="type">
                        <FormItem class="space-y-3">
                            <FormLabel>Notify me about...</FormLabel>

                            <FormControl>
                                <RadioGroup class="flex flex-col space-y-1" v-bind="componentField">
                                    <FormItem class="flex items-center space-y-0 gap-x-3">
                                        <FormControl>
                                            <RadioGroupItem value="weekly" />
                                        </FormControl>
                                        <FormLabel class="font-normal">
                                            Weekly
                                        </FormLabel>
                                    </FormItem>
                                    <FormItem class="flex items-center space-y-0 gap-x-3">
                                        <FormControl>
                                            <RadioGroupItem value="fornightly" />
                                        </FormControl>
                                        <FormLabel class="font-normal">
                                            Fortnightly
                                        </FormLabel>
                                    </FormItem>
                                    <FormItem class="flex items-center space-y-0 gap-x-3">
                                        <FormControl>
                                            <RadioGroupItem value="none" />
                                        </FormControl>
                                        <FormLabel class="font-normal">
                                            None
                                        </FormLabel>
                                    </FormItem>
                                    <FormItem class="flex items-center space-y-0 gap-x-3">
                                        <FormControl>
                                            <RadioGroupItem value="custom" />
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
                </form>
            </CardContent>
            <CardFooter>
                <Button @click="onSubmitSchedule">
                    Create a Schedule
                </Button>
            </CardFooter>
        </Card>
    </AppLayout>
</template>
