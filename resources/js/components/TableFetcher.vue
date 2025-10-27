<script setup lang="ts">
import { Table } from 'ant-design-vue';
import {
  ColumnType,
  TablePaginationConfig,
  TableProps,
} from 'ant-design-vue/es/table';
import { computed } from 'vue';
import { Service, usePagination } from 'vue-request';

type Props = {
  queryData: Service<any, any>;
  columns: ColumnType[];
  pagination?: number;
};

const props = defineProps<Props>();

const {
  data: dataSource,
  run,
  loading,
  current,
  pageSize,
} = usePagination(props.queryData, {
  pagination: {
    currentKey: 'page',
    pageSizeKey: 'results',
  },
});

const pagination = computed(() => ({
  total: 50,
  current: current.value,
  pageSize:
    typeof props.pagination === 'number' ? props.pagination : pageSize.value,
}));

const handleTableChange: TableProps['onChange'] = (
  pagination: TablePaginationConfig,
  filters: any,
  sorter: any,
) => {
  run({
    results: pagination.pageSize,
    page: pagination?.current,
    sortField: sorter.field,
    sortOrder: sorter.order,
    ...filters,
  });
};
</script>

<template>
  <Table
    :columns="columns"
    :pagination="pagination"
    :data-source="dataSource"
    :row-key="(record) => record.login.uuid"
    :loading="loading"
    @change="handleTableChange"
  >
    <template #bodyCell="{ column, record, index }">
      <template v-if="column.dataIndex === 'action'">
        <slot name="action" :record="record" :index="index" />
      </template>
    </template>
  </Table>
</template>
