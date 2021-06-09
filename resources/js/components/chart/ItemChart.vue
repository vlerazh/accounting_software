<template>
    <div >
        <div class="panel-body">
            <canvas id="myChart" height="100"></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js'
    import axios from 'axios'
    export default {
        name:'CustomerChart',
        data() {
            return {
               
            }
        },
        mounted() {
            this.drawChart();
        },
        methods: {
            drawChart() {
                axios.get('http://127.0.0.1:8000/chartCustomers').then(response=>{
                     let ctx = document.getElementById("myChart");
                
                    let myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: response.data.months,
                            datasets: [{
                                    label: "Customers",
                                    data: response.data.customer_count,
                                    backgroundColor: "rgba(54,73,93,.5)",
                                    borderColor: "#36495d",
                                    borderWidth: 3
                                },
                            ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: response.data.max
                                    }
                                }]
                            }
                        }
                    });
                })
               
            },
        }
    }
</script>
