<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="mt-4 p-4 border border-gray-300 rounded">
      <div class="flex justify-end">
        <breeze-link mode="view" @click="getWeeklySales()">
          Weekly
        </breeze-link>
        <breeze-link mode="view" @click="getMonthlySales()">
          Monthly
        </breeze-link>
      </div>

      <div class="mt-4">
        <div class="w-full h-64">
          <sales-chart :labels="sales.date" :values="sales.count"></sales-chart>
        </div>
      </div>
    </div>

    <div class="lg:flex">
      <div class="mt-4 p-4 border border-gray-300 rounded w-full lg:w-1/2">
        <div class="flex justify-end">
          <breeze-link mode="view" @click="getWeeklyCustomers()">
            Weekly
          </breeze-link>
          <breeze-link mode="view" @click="getMonthlyCustomers()">
            Monthly
          </breeze-link>
        </div>

        <div class="mt-4">
          <div class="w-full h-64">
            <customers-chart
              :labels="customers.date"
              :values="customers.count"
            ></customers-chart>
          </div>
        </div>
      </div>

      <div
        class="mt-4 p-4 border border-gray-300 rounded w-full lg:w-1/2 lg:ml-2"
      >
        <div class="flex justify-end">
          <breeze-link mode="view" @click="getWeeklyTraffic()">
            Weekly
          </breeze-link>
          <breeze-link mode="view" @click="getMonthlyTraffic()">
            Monthly
          </breeze-link>
        </div>

        <div class="mt-4">
          <div class="w-full h-64">
            <traffic-chart
              :labels="traffic.date"
              :values="traffic.count"
            ></traffic-chart>
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeLink from "@/Components/AnchorLink";
import SalesChart from "./Charts/SalesChart.vue";
import CustomersChart from "./Charts/CustomersChart.vue";
import TrafficChart from "./Charts/TrafficChart.vue";

export default {
  components: {
    BreezeAuthenticatedLayout,
    BreezeLink,
    SalesChart,
    CustomersChart,
    TrafficChart,
  },

  props: {
    auth: Object,
    errors: Object,
    sales: Object,
    customers: Object,
    traffic: Object,
  },
  methods: {
    getWeeklySales() {
      return this.$inertia.get(
        this.route("dashboard"),
        { period: "weekly" },
        { only: ["sales"], preserveScroll: true }
      );
    },
    getMonthlySales() {
      return this.$inertia.get(
        this.route("dashboard"),
        { period: "monthly" },
        { only: ["sales"], preserveScroll: true }
      );
    },
    getWeeklyCustomers() {
      return this.$inertia.get(
        this.route("dashboard"),
        { period: "weekly" },
        { only: ["customers"], preserveScroll: true }
      );
    },
    getMonthlyCustomers() {
      return this.$inertia.get(
        this.route("dashboard"),
        { period: "monthly" },
        { only: ["customers"], preserveScroll: true }
      );
    },
    getWeeklyTraffic() {
      return this.$inertia.get(
        this.route("dashboard"),
        { period: "weekly" },
        { only: ["traffic"], preserveScroll: true }
      );
    },
    getMonthlyTraffic() {
      return this.$inertia.get(
        this.route("dashboard"),
        { period: "monthly" },
        { only: ["traffic"], preserveScroll: true }
      );
    },
  },
};
</script>
