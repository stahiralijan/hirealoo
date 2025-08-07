<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { PlusIcon } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';

const onNavigateToCreate = () => router.visit(route('schedules.create'));
</script>
<template>
    <AppLayout>
        <Card>
            <CardHeader>
                <CardTitle>Schedules</CardTitle>
            </CardHeader>
            <CardContent>
                Schedule details
            </CardContent>
            <CardFooter>
                <Button @click="onNavigateToCreate">
                    <PlusIcon class="w-4 h-4" />
                    Add a new Schedule
                </Button>
            </CardFooter>
        </Card>
    </AppLayout>
</template>
