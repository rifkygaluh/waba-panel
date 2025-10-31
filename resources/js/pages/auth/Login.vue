<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import login from '@/routes/auth/login';
import { request } from '@/routes/password';
import { Head, useForm } from '@inertiajs/vue3';
import { Form, FormItem, message } from 'ant-design-vue';
import { LoaderCircle } from 'lucide-vue-next';

const props = defineProps<{
  errors: Record<string, string>;
  status?: string;
  canResetPassword?: boolean;
  canRegister?: boolean;
}>();

const form = useForm({
  email: undefined as string | undefined,
  password: undefined as string | undefined,
});

const handleLogin = () => {
  form.post(login.store.url(), {
    onError: () => {
      message.error(props.errors.auth);
    },
    onFinish: () => {
      form.reset('password');
    },
  });
};
</script>

<template>
  <AuthBase
    title="Log in to your account"
    description="Enter your email and password below to log in"
  >
    <Head title="Log in" />

    <div
      v-if="status"
      class="mb-4 text-center text-sm font-medium text-green-600"
    >
      {{ status }}
    </div>

    <Form layout="vertical" class="flex flex-col gap-6" @submit="handleLogin()">
      <FormItem label="Email address" class="mb-0!">
        <Input
          id="email"
          type="email"
          name="email"
          required
          autofocus
          :tabindex="1"
          autocomplete="email"
          placeholder="email@example.com"
          v-model:model-value="form.email"
        />
      </FormItem>

      <div class="grid gap-2">
        <div class="flex items-center justify-between">
          <TextLink
            v-if="canResetPassword"
            :href="request()"
            class="text-sm"
            :tabindex="5"
          >
            Forgot password?
          </TextLink>
        </div>
        <FormItem label="Password" class="mb-0!">
          <Input
            id="password"
            type="password"
            name="password"
            required
            :tabindex="2"
            autocomplete="current-password"
            placeholder="Password"
            v-model:model-value="form.password"
          />
        </FormItem>
      </div>

      <div class="flex items-center justify-between">
        <Label for="remember" class="flex items-center space-x-3">
          <Checkbox id="remember" name="remember" :tabindex="3" />
          <span>Remember me</span>
        </Label>
      </div>

      <Button
        type="submit"
        class="mt-4 w-full"
        :tabindex="4"
        :disabled="form.processing"
        data-test="login-button"
      >
        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
        Log in
      </Button>
    </Form>
  </AuthBase>
</template>
