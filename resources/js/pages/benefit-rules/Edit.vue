<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import benefitRules from '@/routes/benefit-rules';
import { useRuleStore } from '@/stores/rule';
import { type BreadcrumbItem } from '@/types';
import { Rule } from '@/types/rule';
import { Head } from '@inertiajs/vue3';
import InformationForm from './components/InformationForm.vue';
import ItemsForm from './components/ItemsForm.vue';

type Props = {
  rule: Rule;
};

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Benefit Rules',
    href: benefitRules.index().url,
  },
  {
    title: 'Edit',
  },
  {
    title: props.rule.id.toString(),
  },
];

const rule = useRuleStore();
rule.setRule(props.rule);
</script>

<template>
  <Head title="Benefit Rules" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
      <Card class="px-6">
        <h1 class="text-xl">Edit your own fantastic rule!</h1>
      </Card>
      <Card class="px-6">
        <InformationForm />
      </Card>
      <Card class="px-6">
        <ItemsForm />
      </Card>
    </div>
  </AppLayout>
</template>
