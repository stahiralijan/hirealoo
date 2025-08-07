<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from "@/components/ui/button";


const props = defineProps({

});




</script>
<template>
    <AppLayout>
        <Card>
            <CardHeader>
                <CardTitle>Schedules</CardTitle>
            </CardHeader>
            <CardContent>

                <ServiceFrequency />

            </CardContent>
        </Card>
    </AppLayout>
</template>
