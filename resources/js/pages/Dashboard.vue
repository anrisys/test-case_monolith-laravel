<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { SquarePen, Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';
import CreateItemDialog from './items/CreateItemDialog.vue';
import DeleteItemDialog from './items/DeleteItemDialog.vue';
import { Item } from './items/types';
import UpdateItemDialog from './items/UpdateItemDialog.vue';

interface Flash {
    success?: string;
    error?: string;
}

const { flash } = usePage().props as unknown as { flash: Flash };

defineProps<{
    items: Item[];
}>();

const dialogs = ref({
    create: { open: false },
    update: { open: false, item: null as Item | null },
    delete: { open: false, item: null as Item | null },
});

// Handlers
const openCreateItemDialog = () => {
    dialogs.value.create.open = true;
};
const openUpdateItemDialog = (item: Item) => {
    dialogs.value.update.item = item;
    dialogs.value.update.open = true;
};
const openDeleteItemDialog = (item: Item) => {
    dialogs.value.delete.item = item;
    dialogs.value.delete.open = true;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Dialogs -->
        <CreateItemDialog v-model:open="dialogs.create.open" />
        <UpdateItemDialog v-model:open="dialogs.update.open" :item="dialogs.update.item" @close="dialogs.update.open = false" />
        <DeleteItemDialog v-model:open="dialogs.delete.open" :item="dialogs.delete.item" @close="dialogs.delete.open = false" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- Success Message -->
            <div v-if="flash?.success" class="rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700">
                {{ flash?.success }}
            </div>
            <div class="flex flex-col justify-between sm:flex-row">
                <Heading :title="'Your items'" />
                <button
                    @click="openCreateItemDialog"
                    type="button"
                    class="inline-flex h-9 items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-100 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                >
                    Create new item
                </button>
            </div>
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-300">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-300">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-300">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-600 dark:bg-gray-700">
                            <tr v-if="items.length == 0">
                                <td colspan="3" class="px-6 py-4 text-center whitespace-nowrap text-gray-500 dark:text-gray-300">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                            ></path>
                                        </svg>
                                        <span class="mt-2 text-sm font-medium">Currently, you have no saved items</span>
                                        <button
                                            @click="openCreateItemDialog"
                                            class="inline-flex h-9 items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-100 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                                        >
                                            Create your first item
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-else v-for="item in items" :key="item.id" class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-mono text-sm whitespace-nowrap text-gray-500 dark:text-gray-300">{{ item.id }}</td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900 dark:text-gray-100">{{ item.name }}</td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-300">
                                    <div class="flex items-center space-x-2">
                                        <button
                                            @click="openUpdateItemDialog(item)"
                                            type="button"
                                            class="rounded-full p-2 text-blue-500 transition-colors hover:bg-blue-50 hover:text-blue-700 dark:hover:bg-blue-900/30 dark:hover:text-blue-400"
                                        >
                                            <SquarePen stroke-width="2" :size="20" />
                                        </button>
                                        <button
                                            @click="openDeleteItemDialog(item)"
                                            type="button"
                                            class="rounded-full p-2 text-red-500 transition-colors hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-900/30 dark:hover:text-red-400"
                                        >
                                            <Trash2 stroke-width="2" :size="20" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
