import { InertiaLinkProps } from '@inertiajs/vue3';
import { DefaultOptionType } from 'ant-design-vue/es/select';
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
  if (!isNaN(parseInt(endpoints[endpoints.length - 1]))) {
    endpoints.pop();
    return toUrl(urlToCheck) === endpoints.join('/');
  }
  return toUrl(urlToCheck) === currentUrl;
}

export function toUrl(href: NonNullable<InertiaLinkProps['href']>) {
  return typeof href === 'string' ? href : href?.url;
}

export function filterOption(
  input: string,
  option: DefaultOptionType | undefined,
) {
  const inputParts = input
    .toUpperCase()
    .split(' ')
    .filter((part) => part);
  if (inputParts.length >= 2) {
    return inputParts
      .map(
        (inputPart) =>
          option?.label.toUpperCase().indexOf(inputPart.toUpperCase()) >= 0,
      )
      .every((match) => match);
  }
  return option?.label.toUpperCase().indexOf(input.toUpperCase()) >= 0;
}

export function doubleViewersGuard(parentId: string) {
  const viewers = document
    .getElementById(parentId)
    ?.querySelectorAll('.viewer-container.viewer-backdrop');
  if (viewers && viewers?.length > 1) {
    viewers[1].remove();
  }
}
