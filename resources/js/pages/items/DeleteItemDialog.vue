<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import {
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogOverlay,
    AlertDialogPortal,
    AlertDialogRoot,
    AlertDialogTitle,
} from 'reka-ui';
import { computed } from 'vue';
import { Item } from './types';

interface props {
    open: boolean;
    item: Item | null;
}

const { open, item } = defineProps<props>();

const emit = defineEmits(['close', 'update:open']);

const dialogOpen = computed({
    get: () => open,
    set: (val) => emit('update:open', val),
});

const form = useForm({});

function handleDeleteItem() {
    form.delete(route('items.destroy', item?.id), {
        preserveScroll: true,
        onSuccess: () => emit('close'),
    });
}
</script>

<template>
    <AlertDialogRoot :open="dialogOpen">
        <AlertDialogPortal>
            <AlertDialogOverlay class="data-[state=open]:animate-in data-[state=open]:fade-in fixed inset-0 z-30 bg-black/50" />
            <AlertDialogContent
                class="data-[state=open]:animate-in data-[state=open]:fade-in data-[state=open]:zoom-in fixed top-1/2 left-1/2 z-40 w-full max-w-md -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-lg focus:outline-none"
            >
                <AlertDialogTitle class="text-lg font-semibold text-slate-900"> Are you absolutely sure? </AlertDialogTitle>
                <AlertDialogDescription class="mt-4 text-sm leading-normal text-slate-600">
                    This action cannot be undone. This will permanently delete your item: <span class="font-bold">{{ item?.name }}</span>
                </AlertDialogDescription>
                <div class="mt-6 flex justify-end gap-3">
                    <AlertDialogCancel
                        as="button"
                        type="button"
                        @click="emit('update:open', false)"
                        class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-100 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                    >
                        Cancel
                    </AlertDialogCancel>
                    <AlertDialogAction
                        class="rounded-md bg-red-500 px-4 py-2 text-sm font-semibold text-white hover:bg-red-600 focus:ring-2 focus:ring-red-500 focus:outline-none"
                        @click="handleDeleteItem"
                    >
                        {{ form.processing ? 'Deleting...' : 'Delete' }}
                    </AlertDialogAction>
                </div>
            </AlertDialogContent>
        </AlertDialogPortal>
    </AlertDialogRoot>
</template>
