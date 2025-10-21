<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { MailOutlined, UserOutlined, LockOutlined } from '@ant-design/icons-vue';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <GuestLayout>

    <Head title="Register" />

    <a-form @submit.prevent="submit">
      <a-form-item label="Name" name="name" :rules="[{ required: true, message: 'Please input your name!' }]">
        <a-input v-model:value="form.name">
          <template #prefix>
            <UserOutlined class="site-form-item-icon" />
          </template>
        </a-input>
      </a-form-item>

      <a-form-item label="Email" name="email" :rules="[{ required: true, message: 'Please input your email!' }]">
        <a-input v-model:value="form.email">
          <template #prefix>
            <MailOutlined class="site-form-item-icon" />
          </template>
        </a-input>
      </a-form-item>

      <a-form-item label="Password" name="password"
        :rules="[{ required: true, message: 'Please input your password!' }]">
        <a-input v-model:value="form.password" type="password">
          <template #prefix>
            <LockOutlined class="site-form-item-icon" />
          </template>
        </a-input>
      </a-form-item>

      <a-form-item label="Password" name="password_confirmation"
        :rules="[{ required: true, message: 'Please input your password confirmation!' }]">
        <a-input v-model:value="form.password_confirmation" type="password">
          <template #prefix>
            <LockOutlined class="site-form-item-icon" />
          </template>
        </a-input>
      </a-form-item>

      <div class="flex items-center justify-end mt-4">
        <Link :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Already registered?
        </Link>

        <a-button type="primary" html-type="submit" class="ml-4 bg-blue-500 text-white">
          Register
        </a-button>
      </div>
    </a-form>
  </GuestLayout>
</template>
