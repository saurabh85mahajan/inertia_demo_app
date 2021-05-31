<template>
  <breeze-authenticated-layout>
    <template #header>
      <breeze-heading>Departments</breeze-heading>
    </template>

    <div class="flex items-center justify-end mb-6">
      <breeze-link
        :href="route('departments.create')"
        v-if="$page.props.can.create"
        >Create Department
      </breeze-link>
    </div>
    <breeze-table>
      <template #header>
        <breeze-tc
          @click="sortColumn('id')"
          :sortHeader="true"
          field="id"
          :sortby="sortby"
          :sort="sort"
          >ID</breeze-tc
        >
        <breeze-tc
          @click="sortColumn('name')"
          :sortHeader="true"
          field="name"
          :sortby="sortby"
          :sort="sort"
          >Name</breeze-tc
        >
        <breeze-tc
          @click="sortColumn('email')"
          :sortHeader="true"
          field="email"
          :sortby="sortby"
          :sort="sort"
          >Email</breeze-tc
        >
        <breeze-tc>Phone</breeze-tc>
        <breeze-tc>Actions</breeze-tc>
      </template>
      <tr v-for="d in departments.data" :key="d.id" class="hover:bg-gray-200">
        <breeze-tc>{{ d.id }}</breeze-tc>
        <breeze-tc>{{ d.name }}</breeze-tc>
        <breeze-tc>{{ d.email }}</breeze-tc>
        <breeze-tc>{{ d.phone }}</breeze-tc>
        <breeze-tc>
          <breeze-link
            mode="edit"
            :href="route('departments.edit', d.id)"
            v-if="d.can.edit"
            >Edit</breeze-link
          >
          <breeze-link mode="delete" @click="destroy(d.id)" v-if="d.can.delete"
            >Delete</breeze-link
          >
          <breeze-link mode="view" @click="employees(d.id)">View</breeze-link>
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
    sortby: String,
    sort: String,
  },
  methods: {
    destroy(id) {
      this.$inertia.delete(route("departments.destroy", id), {
        preserveScroll: true,
        preserveState: false,
      });
    },
    employees(id) {
      this.$inertia.visit(route("employees.index"), {
        method: "get",
        data: { department_id: id },
      });
      // this.$inertia.get(route('employees.index'), {department_id: id});
    },
    sortColumn(col) {
      var sort = this.sort;
      if (col == this.sortby) {
        if (this.sort == "asc") {
          sort = "desc";
        } else {
          sort = "asc";
        }
      }

      this.$inertia.get(route("departments.index"), {
        sortby: col,
        sort: sort,
        page: this.departments.current_page,
      });
    },
  },
};
</script>
