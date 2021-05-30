<template>
  <breeze-authenticated-layout>
    <template #header>
      <breeze-heading>Departments</breeze-heading>
    </template>

    <div class="flex items-center justify-end mb-6">
      <breeze-link :href="route('departments.create')"
        >Create Department
      </breeze-link>
    </div>
    <breeze-table>
      <template #header>
        <breeze-tc>ID</breeze-tc>
        <breeze-tc>Name</breeze-tc>
        <breeze-tc>Email</breeze-tc>
        <breeze-tc>Phone</breeze-tc>
        <breeze-tc>Actions</breeze-tc>
      </template>
      <tr v-for="d in departments.data" :key="d.id" class="hover:bg-gray-200">
        <breeze-tc>{{ d.id }}</breeze-tc>
        <breeze-tc>{{ d.name }}</breeze-tc>
        <breeze-tc>{{ d.email }}</breeze-tc>
        <breeze-tc>{{ d.phone }}</breeze-tc>
        <breeze-tc>
          <breeze-link :href="route('departments.edit', d.id)"
            >Edit</breeze-link
          >
        </breeze-tc>
      </tr>
    </breeze-table>

    <breeze-pagination :links="departments.links" />
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeTc from "@/Components/TableColumn";
import BreezeTable from "@/Components/Table";
import BreezePagination from "@/Components/Pagination";
import BreezeLink from "@/Components/AnchorLink";
import BreezeHeading from "@/Components/Heading";

export default {
  components: {
    BreezeAuthenticatedLayout,
    BreezeTc,
    BreezeTable,
    BreezePagination,
    BreezeLink,
    BreezeHeading,
  },

  props: {
    departments: Object,
  },
};
</script>
