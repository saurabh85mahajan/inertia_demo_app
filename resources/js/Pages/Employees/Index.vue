<template>
  <breeze-authenticated-layout>
    <template #header>
      <breeze-heading>Employees</breeze-heading>
    </template>

    <div class="flex items-center justify-end mb-6">
      <breeze-link :href="route('employees.create')">New Employee </breeze-link>
    </div>
    <breeze-table>
      <template #header>
        <breeze-tc>ID</breeze-tc>
        <breeze-tc>Name</breeze-tc>
        <breeze-tc>Department</breeze-tc>
        <breeze-tc>Email</breeze-tc>
        <breeze-tc>Actions</breeze-tc>
      </template>
      <tr v-for="e in employees.data" :key="e.id" class="hover:bg-gray-200">
        <breeze-tc>{{ e.id }}</breeze-tc>
        <breeze-tc>{{ e.name }}</breeze-tc>
        <breeze-tc>{{ e.department }}</breeze-tc>
        <breeze-tc>{{ e.email }}</breeze-tc>
        <breeze-tc>
          <breeze-link mode="edit" :href="route('employees.edit', e.id)"
            >Edit</breeze-link
          >
          <breeze-link mode="delete" @click="destroy(e.id)">Delete</breeze-link>
        </breeze-tc>
      </tr>
    </breeze-table>

    <breeze-pagination :links="employees.links" />
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
    employees: Object,
  },
  methods: {
    destroy(id) {
      this.$inertia.delete(route("employees.destroy", id));
    },
  },
};
</script>
