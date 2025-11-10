<script setup lang="ts">
import { Table } from 'ant-design-vue';

type Props = {
  title?: string;
  dataSource: {
    title: string;
    value: string | number | undefined;
  }[];
};

defineProps<Props>();

const columns = [
  {
    title: 'Title',
    dataIndex: 'title',
  },
  {
    title: 'Value',
    dataIndex: 'value',
    width: '60%',
  },
];
</script>

<template>
  <Table
    class="w-full border"
    row-class-name="border-y-0 py-2"
    :data-source="dataSource"
    :columns="columns"
    :show-header="false"
    :pagination="false"
    :bordered="false"
  >
    <template v-if="title" #title>
      <h2 class="text-xl font-medium">{{ title }}</h2>
    </template>
    <template #bodyCell="{ column, text }">
      <template v-if="column.dataIndex === 'title'">
        <p class="font-medium">{{ text }}</p>
      </template>
      <template v-if="column.dataIndex === 'value'">
        <p class="text-right">{{ text }}</p>
      </template>
    </template>
  </Table>
</template>

<style>
.ant-table-title {
  border-bottom: 1px solid #f0f0f0 !important;
}

.border-y-0 > * {
  border-top: 0px !important;
  border-bottom: 0px !important;
}

.py-2 > * {
  padding-top: 8px !important;
  padding-bottom: 8px !important;
}
</style>
