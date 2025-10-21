<template>
  <a-layout class="mx-auto! min-h-screen! bg-white!">
    <!-- <a-layout-header class="h-20 bg-inherit flex items-center justify-between">
      <ApplicationLogo />
    </a-layout-header> -->
    <slot />
    <a-layout-footer class="bg-inherit text-center">
      Algostudio © {{ currentYear === 2025 ? currentYear : `2025-${currentYear}` }}
    </a-layout-footer>
  </a-layout>
</template>

<script setup>
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const currentYear = new Date().getFullYear();
</script>
