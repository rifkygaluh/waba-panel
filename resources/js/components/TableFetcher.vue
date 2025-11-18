<script setup lang="ts">
import { Table } from 'ant-design-vue';
import {
  ColumnType,
  TablePaginationConfig,
  TableProps,
} from 'ant-design-vue/es/table';
import { computed, reactive } from 'vue';
import { Service, usePagination } from 'vue-request';

type Props = {
  queryData: Service<any, any>;
  columns: ColumnType[];
  pagination?: number;
};

type Result = {
  total: number;
  pageSize: number;
  current: number;
};

const props = defineProps<Props>();

const table = reactive<Result>({
  total: 0,
  pageSize: 1,
  current: 1,
});

const {
  data: dataSource,
  run,
  loading,
} = usePagination(props.queryData, {
  onSuccess: (data) => {
    table.total = data.total;
    table.pageSize = data.per_page;
    table.current = data.current_page;
  },
  pagination: {
    currentKey: 'page',
    pageSizeKey: 'results',
  },
});

const pagination = computed(() => ({
  total: table.total,
  current: table.current,
  pageSize:
    typeof props.pagination === 'number' ? props.pagination : table.pageSize,
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
    :data-source="dataSource?.data || []"
    :row-key="(record) => record.id || record.login.uuid"
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
