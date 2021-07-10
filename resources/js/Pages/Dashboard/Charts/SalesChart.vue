<template>
  <canvas id="salesChart"></canvas>
</template>

<script>
import Chart from "chart.js/auto";

export default {
  data() {
    return {
      chartData: {
        type: "bar",
        data: {
          labels: [],
          datasets: [
            {
              label: "Total Sales",
              data: [],
              borderWidth: 1,
              backgroundColor: "red",
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
    const salesChart = "salesChart";
    new Chart(salesChart, this.chartData);
  },
};
</script>