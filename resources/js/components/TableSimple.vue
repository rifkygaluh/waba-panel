<script setup lang="ts">
import { Table } from 'ant-design-vue';
import { ColumnType, TablePaginationConfig } from 'ant-design-vue/es/table';

type Props = {
  pagination?: false | TablePaginationConfig;
  columns: ColumnType[];
  dataSource: any[];
};

defineProps<Props>();
</script>

<template>
  <Table
    :columns="columns"
    :data-source="dataSource"
    :pagination="pagination"
  />
</template>
