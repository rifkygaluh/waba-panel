<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import benefitRules from '@/routes/benefit-rules';
import { useRuleStore } from '@/stores/rule';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { store } from './api/Create';
import InformationForm from './components/InformationForm.vue';
import ItemsForm from './components/ItemsForm.vue';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Benefit Rules',
    href: benefitRules.index().url,
  },
  {
    title: 'Create',
  },
];

const rule = useRuleStore();
</script>

<template>
  <Head title="Benefit Rules" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
      <Card class="px-6">
        <h1 class="text-xl">Create a new rule of your own!</h1>
      </Card>
      <Card class="px-6">
        <InformationForm />
      </Card>
      <Card class="px-6">
        <Suspense>
          <ItemsForm :submit="store" />
        </Suspense>
      </Card>
    </div>
  </AppLayout>
</template>
