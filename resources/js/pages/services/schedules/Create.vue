<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import ServiceFrequency from '@/components/schedules/ServiceFrequency.vue';

const props = defineProps({
    scheduleConfig: Object
});




</script>
<template>
    <AppLayout>
        <Card>
            <CardHeader>
                <CardTitle>Schedules</CardTitle>
            </CardHeader>
            <CardContent>

                <ServiceFrequency :scheduleConfig="scheduleConfig" />

            </CardContent>
        </Card>
    </AppLayout>
</template>
