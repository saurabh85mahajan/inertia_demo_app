<template>
  <canvas id="customersChart"></canvas>
</template>

<script>
import Chart from "chart.js/auto";

export default {
  data() {
    return {
      chartData: {
        type: "line",
        data: {
          labels: [],
          datasets: [
            {
              label: "Total Customers",
              data: [],
              fill: true,
              borderWidth: 1,
              backgroundColor: "skyblue",
              tension: 0.1,
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          animation: false,
        },
      },
    };
  },
  props: {
    labels: Array,
    values: Array,
  },
  mounted() {
    this.chartData.data.labels = this.labels;
    this.chartData.data.datasets[0].data = this.values;
    const salesChart = "customersChart";
    new Chart(salesChart, this.chartData);
  },
};
</script>