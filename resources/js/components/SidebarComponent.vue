<template>
  <div class="pb-4">
    <a-menu
      theme="light"
      v-model:selectedKeys="state.selectedKeys"
      class="border-none bg-white"
      mode="inline"
      :open-keys="state.openKeys"
      @openChange="onOpenChange"
    >
      <div class="sidebar-routes bg-white pt-5">
        <InertiaLink :href="route('home')" class="px-2">
          <a-menu-item class="block h-fit" :key="route('home')">
            <HomeOutlined />
            <a-typography-text class="block py-2 whitespace-normal">
              Home
            </a-typography-text>
          </a-menu-item>
        </InertiaLink>
      </div>
    </a-menu>
  </div>
</template>

<script lang="ts" setup>
import { HomeOutlined } from '@ant-design/icons-vue';
import { Link as InertiaLink, usePage } from '@inertiajs/vue3';
import { computed, reactive } from 'vue';

const props = defineProps({
  selected: String,
});

const { value: user } = computed(() => usePage().props.auth.user);

const { selected } = reactive(props);

const routeName = route().current();

const endpoint = selected
  ? selected.replace(`${route().t.url}/`, '')
  : route(routeName).replace(`${route().t.url}/`, '');
const endpointNames = endpoint.split('/');

const initialOpenKeys = endpointNames
  .map((ep) => endpoint.substring(0, endpoint.indexOf(ep)))
  .filter((key) => key);
initialOpenKeys.push(`${endpoint}/`);

const state = reactive({
  rootSubmenuKeys: [],
  openKeys: [...initialOpenKeys],
  selectedKeys: [selected || route(routeName)],
});
const onOpenChange = (openKeys) => {
  const latestOpenKey = openKeys.find(
    (key) => state.openKeys.indexOf(key) === -1,
  );
  if (state.rootSubmenuKeys.indexOf(latestOpenKey) === -1) {
    state.openKeys = openKeys;
  } else {
    state.openKeys = latestOpenKey ? [latestOpenKey] : [];
  }
};

const verificatorRole = 15;
const verificationPayload = {
  assignee_id: user.role.role_number === verificatorRole ? user.id : '',
};
Object.keys(verificationPayload).forEach(
  (k) => verificationPayload[k] === '' && delete verificationPayload[k],
);
</script>
<style>
.ant-menu {
  background: #f8f8f9 !important;
}

div.logo-title {
  height: 32px;
  /* background: rgba(255, 255, 255, 0.2); */
  background: transparent;
  margin: 16px 0;
  text-align: center;
}

.dx-theme-generic-typography a {
  color: black !important;
}

ul.ant-menu-sub {
  border-left: 1px solid rgba(128, 128, 128, 0.3) !important;
  margin-left: 24px !important;
  background-color: #ffffff !important;
}

/* All Routes except Routes with Submenu */
.sidebar-routes > a {
  padding: 0 8px;
}

/* Turn <a> to tailwind: 'text-gray-700' */
a {
  --tw-text-opacity: 1 !important;
  color: rgb(55 65 81 / var(--tw-text-opacity)) !important;
}

li.ant-menu-item,
div.ant-menu-submenu-title {
  padding-left: 18px !important;
}

/* Text Routes */
.ant-menu-title-content {
  font-size: 16px;
  display: flex;
  align-items: center;
}
.ant-menu-sub .ant-menu-submenu-title .ant-menu-title-content,
.ant-menu-item-only-child .ant-menu-title-content {
  font-size: 14px;
}

/* Align Icon to Text Routes */
.ant-menu-title-content > .anticon {
  padding-bottom: 2px;
  width: 24px;
}
</style>
