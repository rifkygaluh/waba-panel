import { InertiaLinkProps } from '@inertiajs/vue3';
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs));
}

export function urlIsActive(
  urlToCheck: NonNullable<InertiaLinkProps['href']>,
  currentUrl: string,
) {
  const endpoints = currentUrl.split('/');
  if (typeof parseInt(endpoints[endpoints.length - 1]) === 'number') {
    endpoints.pop();
    return toUrl(urlToCheck) === endpoints.join('/');
  }
  return toUrl(urlToCheck) === currentUrl;
}

export function toUrl(href: NonNullable<InertiaLinkProps['href']>) {
  return typeof href === 'string' ? href : href?.url;
}
