<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { X } from 'lucide-vue-next';
import { DialogClose, DialogContent, DialogOverlay, DialogPortal, DialogRoot, DialogTitle } from 'reka-ui';
import { computed } from 'vue';
import { Item } from './types';

interface props {
    open: boolean;
    item: Item | null;
    errors?: Record<string, string>;
}

const { open, item } = defineProps<props>();

const emit = defineEmits(['close', 'update:open']);

const dialogOpen = computed({
    get: () => open,
    set: (val) => emit('update:open', val),
});

const form = useForm({
    id: null,
    name: '',
});

const submit = () => {
    form.put(route('items.update', item?.id), {
        preserveScroll: true,
        onSuccess: () => emit('close'),
    });
};
</script>

<template>
    <DialogRoot v-model:open="dialogOpen">
        <DialogPortal>
            <DialogOverlay class="data-[state=open]:animate-in data-[state=open]:fade-in fixed inset-0 z-30 bg-black/50" />
            <DialogContent
                class="data-[state=open]:animate-in data-[state=open]:fade-in data-[state=open]:zoom-in fixed top-1/2 left-1/2 z-40 w-full max-w-md -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-lg focus:outline-none"
            >
                <DialogTitle class="text-lg font-semibold text-slate-900">Update Item</DialogTitle>
                <form @submit.prevent="submit" class="gap-4">
                    <div class="text-sm font-medium text-slate-700">Current name: {{ item?.name }}</div>
                    <label for="name" class="mt-2 text-sm text-slate-600">Enter the new name of the item:</label>
                    <div>
                        <input
                            id="name"
                            v-model="form.name"
                            class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                            :class="{ 'border-red-500 ring-red-500 focus:ring-red-500': form.errors?.name }"
                            placeholder="New name"
                        />
                        <p v-if="form.errors?.name" class="mt-1 text-sm text-red-500">{{ form.errors.name }}</p>
                    </div>
                    <div class="mt-6 flex justify-between gap-3">
                        <button
                            as="button"
                            type="button"
                            @click="emit('update:open', false)"
                            :disabled="form.processing"
                            class="rounded-md border border-red-300 bg-slate-100 px-4 py-2 text-sm font-semibold text-red-500 hover:border-red-500 hover:bg-red-500 hover:text-white focus:ring-2 focus:ring-red-500 focus:outline-none"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="rounded-md bg-sky-500 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-600 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                        >
                            {{ form.processing ? 'Saving...' : 'Save' }}
                        </button>
                    </div>
                </form>
                <DialogClose
                    class="absolute top-3 right-3 inline-flex h-7 w-7 items-center justify-center rounded-full text-slate-700 hover:bg-slate-100 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                    aria-label="Close"
                >
                    <X />
                </DialogClose>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>
