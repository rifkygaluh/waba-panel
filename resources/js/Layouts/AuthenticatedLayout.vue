<template>
  <Head :title="title || 'Admin'" />
  <a-config-provider
    :theme="{
      token: {
        fontFamily: '',
      },
    }"
  >
    <a-layout class="h-full min-h-full max-h-full max-w-full">
      <a-layout-sider
        theme="light"
        v-model:collapsed="collapsed"
        :trigger="null"
        collapsible
        :breakpoint="breakpoint || 'xl'"
        width="250px"
        collapsed-width="0"
        class="sticky top-0 left-0 overflow-y-auto overflow-x-hidden h-screen z-20 bg-white"
      >
        <sidebar-component :selected="sidebarActive" />
      </a-layout-sider>
      <a-layout>
        <a-layout-header
          class="flex items-center justify-between bg-white p-l-[50px] text-left z-10"
          style="position: sticky; top: 0;"
        >
          <menu-unfold-outlined
            v-if="collapsed"
            class="trigger"
            @click="setCollapse"
          />
          <menu-fold-outlined
            v-else
            class="trigger"
            @click="setCollapse"
          />
          <div class="flex space-x-6">
            <a-dropdown :trigger="['click']">
              <a class="ant-dropdown-link" @click.prevent>
                <a-button type="primary" shape="circle" size="large">
                  <template #icon><UserOutlined /></template>
                </a-button>
              </a>
              <template #overlay>
                <a-menu>
                  <a-menu-item key="0">
                    {{ $page.props.auth.user.name }} - {{ $page.props.auth.user.role.name }}
                  </a-menu-item>
                  <a-menu-divider />
                  <a-menu-item key="1" v-if="$page.props.auth.user.role.role_number == '-1'">
                    <InertiaLink :href="`/role-permission/list`">List Role and Permission</InertiaLink>
                  </a-menu-item>
                  <a-menu-item key="2" v-if="$page.props.auth.user.role.role_number == '-1'">
                    <InertiaLink :href="`/role-permission`">Manage Role and Permission</InertiaLink>
                  </a-menu-item>
                  <a-menu-item key="3">
                    <a href="/logout">Logout</a>
                  </a-menu-item>
                </a-menu>
              </template>
            </a-dropdown>
          </div>
        </a-layout-header>
        <main>
          <slot />
        </main>
      </a-layout>
    </a-layout>
  </a-config-provider>
</template>
<script setup>
import { MenuFoldOutlined, MenuUnfoldOutlined, UserOutlined } from '@ant-design/icons-vue';
import { ref } from 'vue';
import { Head, Link as InertiaLink } from '@inertiajs/vue3';
import SidebarComponent from '@/Components/SidebarComponent.vue';

const props = defineProps({
  title: String,
  sidebarActive: String,
  breakpoint: String,
  collapse: Function,
});

const collapsed = ref(false);
const setCollapse = () => {
  collapsed.value = !collapsed.value;
  if (props.collapse) {
    props.collapse();
  }
};

</script>
<style>
header span.anticon {
  padding: 5px;
  font-size: 18px;
}

.ant-btn {
    display: flex;
    align-items: center;
    justify-content: center;
}

.ant-modal-confirm-btns {
    display: flex;
}

.ant-popconfirm .ant-popover-buttons {
    display: flex;
}

.ant-descriptions-view .ant-descriptions-item-label span {
    font-weight: bold;
    font-size: 16px;
}

.ant-modal-footer {
    display: flex;
}
</style>
