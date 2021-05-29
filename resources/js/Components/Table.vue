<template>
  <table class="w-full whitespace-nowrap">
    <thead>
      <tr class="font-bold text-left">
        <slot name="header" />
      </tr>
    </thead>
    <tbody>
      <slot/>
    </tbody>
  </table>
</template>