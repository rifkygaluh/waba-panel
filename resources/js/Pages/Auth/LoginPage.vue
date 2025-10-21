<template>
  <GuestLayout>
    <Head title="Login" />
    <a-layout-content class="flex items-center justify-center bg-white">
      <a-form class="w-[512px] mx-auto" :model="form" name="login" @finish="onFinish" @finishFailed="onFinishFailed" layout="vertical">
        <a-typography-title>Login to Dashboard</a-typography-title>
        <a-form-item label="Email" name="email"
          :rules="[{ message: 'Please input your email!' }]">
          <a-input class="min-h-[40px] rounded-lg border-gray-300 text-sm" v-model:value="form.email" />
        </a-form-item>
        <a-form-item label="Password" name="password"
          :rules="[{ message: 'Please input your password!' }]">
          <a-input-password class="min-h-[40px] rounded-lg border-gray-300 text-sm" v-model:value="form.password" />
        </a-form-item>
        <div class="flex justify-between -mt-3 mb-8">
          <a-form-item name="remember" no-style>
            <a-checkbox v-model:checked="form.remember">Remember me</a-checkbox>
          </a-form-item>
        </div>
        <a-form-item>
          <a-button
            class="w-full rounded-lg justify-center"
            type="primary"
            size="large"
            @click="onFinish"
          >
            Login
          </a-button>
        </a-form-item>
      </a-form>
    </a-layout-content>
  </GuestLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { notification } from 'ant-design-vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
  errors: {
    type: Object,
  },
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});
const onFinish = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
    onError: (errors) => {
      const errorMessage = (Object.values(errors)[0]);
      notification.error({
        message: 'Login error',
        description: errorMessage,
      });
    },
  });
};
const onFinishFailed = (errorInfo) => {
  console.log('Failed:', errorInfo);
};
</script>
